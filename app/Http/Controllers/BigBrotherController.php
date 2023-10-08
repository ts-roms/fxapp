<?php

namespace App\Http\Controllers;

use App\Models\BigBrother;
use App\Models\Expense;
use App\Models\OtherIncome;
use DataTables;
use DB;
use Illuminate\Http\Request;
use Validator;

class BigBrotherController extends Controller
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
        //
        $status = 'active';
        $totalActive = count(BigBrother::where('status', 'active')->get());

        DB::beginTransaction();
        $bb = BigBrother::where('status', 'active')->first();
        $bb->capital = (BigBrother::where('status', 'active')->sum('capital') + OtherIncome::sum('amount')) - Expense::sum('amount');
        $bb->total_expense = Expense::sum('amount');
        $bb->total_cashback = OtherIncome::sum('amount');
        $bb->save();
        DB::commit();
        return view('backend.big_brother.list', compact('status', 'totalActive'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        if (!$request->ajax()) {
            return back();
        } else {
            return view('backend.big_brother.modal.create');
        }
    }

    public function get_table_data(Request $request)
    {
        $currency = currency(get_base_currency());

        $bigBrother = BigBrother::orderBy('id', 'desc');

        return DataTables::eloquent($bigBrother)

            ->editColumn('capital', function ($bb) use ($currency) {
                return decimalPlace($bb->capital, $currency);
            })
            ->editColumn('total_expense', function ($bb) use ($currency) {
                return decimalPlace($bb->total_expense, $currency);
            })
            ->editColumn('total_cashback', function ($bb) use ($currency) {
                return decimalPlace($bb->total_cashback, $currency);
            })
            ->addColumn('action', function ($bb) {
                return '<div class="dropdown text-center">'
                    . '<button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown">' . _lang('Action')
                    . '&nbsp;</button>'
                    . '<div class="dropdown-menu">'
                    . '<a class="dropdown-item ajax-modal" href="' . action('BigBrotherController@edit', $bb->id) . '" data-title="' . _lang('Update Cash in Bank Funds') . '"><i class="ti-pencil-alt"></i> ' . _lang('Edit') . '</a>'
                    . '<a class="dropdown-item ajax-modal" href="' . action('BigBrotherController@show', $bb->id) . '" data-title="' . _lang('Cash in Bank Fund Details') . '"><i class="ti-eye"></i>  ' . _lang('View') . '</a>'
                    . '<form action="' . action('BigBrotherController@closeAccount', $bb->id) . '" method="post">'
                    . csrf_field()
                    . '<input name="_method" type="hidden" value="PUT">'
                    . '<button class="dropdown-item " type="submit"><i class="ti-shield"></i> ' . _lang('Closed') . '</button>'
                    . '</form>'
                    . '<form action="' . action('BigBrotherController@destroy', $bb->id) . '" method="post">'
                    . csrf_field()
                    . '<input name="_method" type="hidden" value="DELETE">'
                    . '<button class="dropdown-item btn-remove" type="submit"><i class="ti-trash"></i> ' . _lang('Delete') . '</button>'
                    . '</form>'
                    . '</div>'
                    . '</div>';
            })
            ->setRowId(function ($bb) {
                return "row_" . $bb->id;
            })
            ->rawColumns(['capital', 'action'])
            ->setRowClass(function ($bb) {
                if ($bb->status == 'active') {
                    return 'bg-success';
                } else if ($bb->status == 'processing') {
                    return 'bg-warning';
                } else if ($bb->status == 'closed') {
                    return 'bg-danger';
                }
            })
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'period_from' => 'required',
            'period_to' => 'required',
            'capital' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            }
            return redirect()->route('big_brother.create')
                ->withErrors($validator)
                ->withInput();
        }

        if (count(BigBrother::where('status', 'active')->get()) > 0) {
            return response()->json(['result' => 'error', 'message' => 'Cash on Bank still active']);
        }

        DB::beginTransaction();
        $bigBrother = new BigBrother();
        $bigBrother->account_id = 0; //$request->input('account_id');
        $bigBrother->period_from = $request->input('period_from');
        $bigBrother->period_to = $request->input('period_to');
        $bigBrother->capital = $request->input('capital');
        $bigBrother->user_id = auth()->id();
        $bigBrother->branch_id = 0; //auth()->user()->branch_id;
        $bigBrother->save();
        DB::commit();

        if (!$request->ajax()) {
            return redirect()->route('big_brother.create')->with('success', _lang('Saved Successfully'));
        }
        return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Saved Successfully'), 'data' => $bigBrother, 'table' => '#big_brother_table']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BigBrother  $bigBrother
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BigBrother $bigBrother)
    {
        //
        if (!$request->ajax()) {
            return back();
        }
        return view('backend.big_brother.modal.view', compact('bigBrother'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BigBrother  $bigBrother
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, BigBrother $bigBrother)
    {
        //
        if (!$request->ajax()) {
            return back();
        }
        return view('backend.big_brother.modal.edit', compact('bigBrother'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BigBrother  $bigBrother
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BigBrother $bigBrother)
    {
        //
        $validator = Validator::make($request->all(), [
            'period_from' => 'required',
            'period_to' => 'required',
            'account_id' => 'required',
            'capital' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            }
            return redirect()->route('big_brother.edit', $bigBrother->id)
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        $bigBrother = BigBrother::find($bigBrother->id);
        $bigBrother->account_id = $request->input('account_id');
        $bigBrother->period_from = $request->input('period_from');
        $bigBrother->period_to = $request->input('period_to');
        $bigBrother->capital = $request->input('capital');
        $bigBrother->save();
        DB::commit();

        if (!$request->ajax()) {
            return redirect()->route('big_brother.create')->with('success', _lang('Updated Successfully'));
        }
        return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('Updated Successfully'), 'data' => $bigBrother, 'table' => '#big_brother_table']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BigBrother  $bigBrother
     * @return \Illuminate\Http\Response
     */
    public function destroy(BigBrother $bigBrother)
    {
        //
        $bigBrother->delete();
        return redirect()->route('big_brother.index')->with('success', _lang('Deleted Successfully'));
    }

    public function closeAccount($id)
    {
        $bigBrother = BigBrother::find($id);
        $bigBrother->status = 'closed';
        $bigBrother->save();

        return redirect()->route('big_brother.create')->with('success', _lang('Updated Successfully'));
    }
}
