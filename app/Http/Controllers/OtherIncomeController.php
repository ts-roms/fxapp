<?php

namespace App\Http\Controllers;

use App\Models\OtherIncome;
use App\Models\BigBrother;
use DataTables;
use DB;
use Illuminate\Http\Request;
use Validator;

class OtherIncomeController extends Controller
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
        $other_income = OtherIncome::all();
        return view('backend.other_income.list', compact('other_income'));
    }

    public function get_table_data()
    {

        $currency = currency(get_base_currency());

        $other_incomes = OtherIncome::select('other_income.*')
            ->with('other_income_category')
            ->orderBy("other_income.id", "desc");

        return DataTables::eloquent($other_incomes)
            ->editColumn('amount', function ($other_income) use ($currency) {
                return decimalPlace($other_income->amount, $currency);
            })
            ->addColumn('action', function ($other_income) {
                return '<div class="dropdown text-center">'
                    . '<button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown">' . _lang('Action')
                    . '&nbsp;</button>'
                    . '<div class="dropdown-menu">'
                    . '<a class="dropdown-item ajax-modal" href="' . action('OtherIncomeController@edit', $other_income->id) . '" data-title="' . _lang('Update Other Income') . '"><i class="ti-pencil-alt"></i> ' . _lang('Edit') . '</a>'
                    . '<a class="dropdown-item ajax-modal" href="' . action('OtherIncomeController@show', $other_income->id) . '" data-title="' . _lang('Other Income Details') . '"><i class="ti-eye"></i>  ' . _lang('View') . '</a>'
                    . '<form action="' . action('OtherIncomeController@destroy', $other_income->id) . '" method="post">'
                    . csrf_field()
                    . '<input name="_method" type="hidden" value="DELETE">'
                    . '<button class="dropdown-item btn-remove" type="submit"><i class="ti-trash"></i> ' . _lang('Delete') . '</button>'
                    . '</form>'
                    . '</div>'
                    . '</div>';
            })
            ->setRowId(function ($other_income) {
                return "row_" . $other_income->id;
            })
            ->rawColumns(['amount', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!$request->ajax()) {
            return back();
        } else {
            return view('backend.other_income.modal.create');
        }
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
            'other_income_date'        => 'required',
            'other_income_category_id' => 'required',
            'amount'              => 'required|numeric',
            'attachment'          => 'nullable|mimes:jpeg,JPEG,png,PNG,jpg,doc,pdf,docx,zip',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('other_income.create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $attachment = '';
        if ($request->hasfile('attachment')) {
            $file       = $request->file('attachment');
            $attachment = time() . $file->getClientOriginalName();
            $file->move(public_path() . "/uploads/media/", $attachment);
        }

        DB::beginTransaction();
        $other_income                      = new OtherIncome();
        $other_income->other_income_date        = $request->input('other_income_date');
        $other_income->other_income_category_id = $request->input('other_income_category_id');
        $other_income->amount              = $request->input('amount');
        $other_income->reference           = $request->input('reference');
        $other_income->notes                = $request->input('notes');
        $other_income->attachment          = $attachment;
        $other_income->created_user_id     = auth()->id();
        $other_income->branch_id           = auth()->user()->branch_id;

        $other_income->save();
        DB::commit();

        if (!$request->ajax()) {
            return redirect()->route('other_income.create')->with('success', _lang('Saved Successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Saved Successfully'), 'data' => $other_income, 'table' => '#other_income_table']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $other_income = OtherIncome::find($id);
        if (!$request->ajax()) {
            return back();
        } else {
            return view('backend.other_income.modal.view', compact('other_income', 'id'));
        }
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $other_income = OtherIncome::find($id);
        if (!$request->ajax()) {
            return back();
        } else {
            return view('backend.other_income.modal.edit', compact('other_income', 'id'));
        }
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'other_income_date'        => 'required',
            'other_income_category_id' => 'required',
            'amount'              => 'required|numeric',
            'attachment'          => 'nullable|mimes:jpeg,JPEG,png,PNG,jpg,doc,pdf,docx,zip',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('other_income.edit', $id)
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        if ($request->hasfile('attachment')) {
            $file       = $request->file('attachment');
            $attachment = time() . $file->getClientOriginalName();
            $file->move(public_path() . "/uploads/media/", $attachment);
        }
        DB::beginTransaction();
        $other_income                      = OtherIncome::find($id);
        $other_income->other_income_date        = $request->input('other_income_date');
        $other_income->other_income_category_id = $request->input('other_income_category_id');
        $other_income->amount              = $request->input('amount');
        $other_income->reference           = $request->input('reference');
        $other_income->notes                = $request->input('notes');
        if ($request->hasfile('attachment')) {
            $other_income->attachment = $attachment;
        }
        $other_income->updated_user_id = auth()->id();

        $other_income->save();
        DB::commit();
        if (!$request->ajax()) {
            return redirect()->route('other_income.index')->with('success', _lang('Updated Successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('Updated Successfully'), 'data' => $other_income, 'table' => '#other_income_table']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $other_income = OtherIncome::find($id);
        $other_income->delete();
        return redirect()->route('other_income.index')->with('success', _lang('Deleted Successfully'));
    }
}
