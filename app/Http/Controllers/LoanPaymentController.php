<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanPayment;
use App\Models\LoanRepayment;
use App\Models\Transaction;
use DataTables;
use DB;
use Illuminate\Http\Request;
use Validator;

class LoanPaymentController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        date_default_timezone_set(get_option('timezone', 'Asia/Dhaka'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.loan_payment.list');
    }

    public function get_table_data()
    {

        $loanpayments = LoanPayment::select('loan_payments.*')
            ->with('loan')
            ->orderBy("loan_payments.id", "desc");

        return Datatables::eloquent($loanpayments)
            ->editColumn('member', function($loan) {
                return $loan->member->first_name . ' ' . $loan->member->last_name;
            })
            ->editColumn('repayment_amount', function ($loanpayment) {
                return decimalPlace($loanpayment->repayment_amount - $loanpayment->interest, currency($loanpayment->loan->currency->name));
            })
            ->addColumn('total_amount', function ($loanpayment) {
                return decimalPlace($loanpayment->total_amount, currency($loanpayment->loan->currency->name));
            })
            ->addColumn('action', function ($loanpayment) {
                return '<form action="' . action('LoanPaymentController@destroy', $loanpayment['id']) . '" class="text-center" method="post">'
                    . '<a href="' . action('LoanController@show', $loanpayment['loan_id']) . '" class="btn btn-success btn-xs"><i class="ti-file"></i>&nbsp;' . _lang('Loan Details') . '</a>&nbsp;'
                    . csrf_field()
                    . '<input name="_method" type="hidden" value="DELETE">'
                    . '<button class="btn btn-danger btn-xs btn-remove" type="submit"><i class="ti-trash"></i>&nbsp;' . _lang('Delete') . '</button>'
                    . '</form>';
            })
            ->setRowId(function ($loanpayment) {
                return "row_" . $loanpayment->id;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $alert_col = 'col-lg-8 offset-lg-2';
        return view('backend.loan_payment.create', compact('alert_col'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'loan_id'          => 'required',
            'paid_at'          => 'required',
            'late_penalties'   => 'nullable|numeric',
            'repayment_amount' => 'required|numeric',
            'due_amount_of'    => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('loan_payments.create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        DB::beginTransaction();

        $repayment = LoanRepayment::find($request->due_amount_of);
        $loan      = Loan::find($request->loan_id);
        $loanpayment                   = new LoanPayment();
        $loanpayment->loan_id          = $request->loan_id;
        $loanpayment->paid_at          = $request->paid_at;
        $loanpayment->late_penalties   = $request->late_penalties ?? 0; //it's optionals
        $loanpayment->interest         = $repayment->interest;
        $loanpayment->repayment_amount = $repayment->amount_to_pay;
        $loanpayment->total_amount     = $repayment->amount_to_pay + $request->late_penalties;
        $loanpayment->remarks          = $request->remarks;
        $loanpayment->repayment_id     = $repayment->id;
        $loanpayment->member_id        = $loan->borrower_id;

        $loanpayment->save();

        //Update Loan Balance
        $repayment->status = 1;
        $repayment->save();

        $loan->total_paid = $loan->total_paid + $repayment->amount_to_pay;
        if ($loan->total_paid >= $loan->applied_amount) {
            $loan->status = 2;
        }
        $loan->save();

        DB::commit();

        if ($request->ajax()) {
           return response()->json(['result' => 'success', 'message' => _lang('Loan Payment Made Sucessfully'), 'data' => $loan, 'table' => '#schedule']);
        }

        return redirect()->route('loan_payments.index')->with('success', _lang('Loan Payment Made Sucessfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $loanpayment = LoanPayment::find($id);
        if (!$request->ajax()) {
            return view('backend.loan_payment.view', compact('loanpayment', 'id'));
        } else {
            return view('backend.loan_payment.modal.view', compact('loanpayment', 'id'));
        }
    }

    public function get_repayment_by_loan_id($loan_id)
    {
        $repayments = LoanRepayment::where('loan_id', $loan_id)
            ->where('status', 0)
            ->get();

        $loan = Loan::find($loan_id);
        $totalRepayment = 0;
        $totalInterest = 0;

        $interestRate = $loan->loan_product->interest_rate;
        $totalDue = $loan->total_payable - $loan->total_paid;

        if ($loan->loan_product->interest_type == 'flat_rate') {
            $totalInterest = (($interestRate / 100) * $totalDue);
        } else if ($loan->loan_product->interest_type == 'fixed_rate') {
            $totalInterest = (($interestRate / 100) * $totalDue);
        } else if ($loan->loan_product->interest_type == 'mortgage') {
            $totalInterest = (($interestRate / 100) * $totalDue) / $loan->loan_product->term;
        } else if ($loan->loan_product->interest_type == 'one_time') {
            $totalInterest = (($interestRate / 100) * $totalDue);
        }
        echo json_encode($repayments);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        $loanpayment = LoanPayment::find($id);

        $transaction = Transaction::find($loanpayment->transaction_id);
        if ($transaction) {
            $transaction->delete();
        }

        //Update Balance
        $repayment         = LoanRepayment::find($loanpayment->repayment_id);
        $repayment->status = 0;
        $repayment->save();

        $loan             = Loan::find($loanpayment->loan_id);
        $loan->total_paid = $loan->total_paid - $repayment->amount_to_pay;
        $loan->save();

        $loanpayment->delete();

        DB::commit();

        return back()->with('success', _lang('Deleted Sucessfully'));
    }

    public function bulkCreateRepayment(Request $request) {

        $loans = Loan::where('status', '1')->get();
        
        return view('backend.loan_payment.bulk_create', compact('loans'));
    }

    public function bulkRepayment(Request $request) {
        DB::beginTransaction();
        $loanId =  $request->input('loan_id');
        foreach($loanId as $key => $value) {
            $loan      = Loan::find($value);
            $loanpayment                   = new LoanPayment();
            $loanpayment->loan_id          = $value;
            $loanpayment->paid_at          = $request->input('paid_at')[$key] ?? date('Y-m-d');
            $loanpayment->late_penalties   = $request->input('late_penalties')[$key] ?? 0; //it's optionals
            $loanpayment->interest         = 0;
            $loanpayment->repayment_amount = ($request->input('pc')[$key] ?? 0) + ($request->input('nfc')[$key] ?? 0) + ($request->input('el')[$key] ?? 0);
            $loanpayment->total_amount     = ($request->input('pc')[$key] ?? 0) + ($request->input('nfc')[$key] ?? 0) + ($request->input('el')[$key] ?? 0) + $request->input('late_penalties')[$key] ?? 0;
            $loanpayment->remarks          = $request->input('notes')[$key];
            $loanpayment->repayment_id     = date('Y-m-d');
            $loanpayment->member_id        = $request->input('borrower_id')[$key];

            $loanpayment->save();

            //Update Loan Balance
            $repayment = LoanRepayment::find($value);
            $repayment->status = 1;
            $repayment->save();

            $loan->total_paid = $loan->total_paid + $repayment->amount_to_pay;
            if ($loan->total_paid >= $loan->applied_amount) {
                $loan->status = 2;
            }
            $loan->save();
        }
        DB::commit();

        \Cache::forget('capital_buildup');
        \Cache::forget('emergency_funds');
        \Cache::forget('mortuary_funds');
        \Cache::forget('notes');


    if ($request->ajax()) {
        return response()->json(['result' => 'success', 'message' => _lang('Loan Payment Made Sucessfully'), 'data' => [], 'table' => '#loan_payments_table']);
     }
     return redirect()->route('loan_payments.index')->with('success', _lang('Loan Payment Made Sucessfully'));
    }
}
