<?php

namespace App\Http\Controllers;

use App\Models\ChartsOfAccount;
use DataTables;
use DB;
use Illuminate\Http\Request;
use Validator;

class ChartsOfAccountController extends Controller
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
        return view('backend.charts_of_account.list');
    }

    public function get_table_data()
    {
        $charts_of_account = ChartsOfAccount::orderBy('id', 'desc');
        return DataTables::eloquent($charts_of_account)
            ->addColumn('action', function ($fn) {
                return "<b>" . $fn->id . "</b>";
            })
            ->addColumn('action', function ($fn) {
                return '<div class="dropdown text-center">'
                    . '<button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown">' . _lang('Action')
                    . '&nbsp;</button>'
                    . '<div class="dropdown-menu">'
                    . '<a class="dropdown-item ajax-modal" href="' . action('ChartsOfAccountController@edit', $fn) . '" data-title="' . _lang('Charts Of Account') . '"><i class="ti-pencil-alt"></i> ' . _lang('Edit') . '</a>'
                    . '<a class="dropdown-item ajax-modal" href="' . action('ChartsOfAccountController@show', $fn->id) . '" data-title="' . _lang('Charts Of Account') . '"><i class="ti-eye"></i>  ' . _lang('View') . '</a>'
                    . '<form action="' . action('ChartsOfAccountController@destroy', $fn->id) . '" method="post">'
                    . csrf_field()
                    . '<input name="_method" type="hidden" value="DELETE">'
                    . '<button class="dropdown-item btn-remove" type="submit"><i class="ti-trash"></i> ' . _lang('Delete') . '</button>'
                    . '</form>'
                    . '</div>'
                    . '</div>';
            })
            ->setRowId(function ($fn) {
                return "row_" . $fn->id;
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
        //
        if (!$request->ajax()) {
            return back();
        }
        return view('backend.charts_of_account.modal.create');
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
            'name'        => 'required',
            'code' => 'required',
            'account_type'              => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('charts_of_account.create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $charts_of_account = new ChartsOfAccount();
        $charts_of_account->parent_id = 0;
        $charts_of_account->allow_manual = 0;
        $charts_of_account->name = $request->input('name');
        $charts_of_account->code = $request->input('code');
        $charts_of_account->account_type = $request->input('account_type');
        $charts_of_account->notes = $request->input('notes');
        $charts_of_account->created_user_id = auth()->id();
        $charts_of_account->save();

        if (!$request->ajax()) {
            return redirect()->route('charts_of_account.create')->with('success', _lang('Saved Successfully'));
        }
        return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Saved Successfully'), 'data' => $charts_of_account, 'table' => '#charts_of_account_table']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChartsOfAccount  $chartsOfAccount
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ChartsOfAccount $charts_of_account)
    {
        //
        if (!$request->ajax()) {
            return back();
        }
        return view('backend.charts_of_account.modal.view', compact('charts_of_account'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChartsOfAccount  $chartsOfAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ChartsOfAccount $charts_of_account)
    {
        //
        if (!$request->ajax()) {
            return back();
        }
        return view('backend.charts_of_account.modal.edit', compact('charts_of_account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChartsOfAccount  $chartsOfAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChartsOfAccount $chartsOfAccount)
    {
        //
        $validator = Validator::make($request->all(), [
            'name'        => 'required',
            'code' => 'required',
            'account_type'              => 'required',
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

        DB::beginTransaction();
        $charts_of_account = ChartsOfAccount::find($chartsOfAccount->id);
        $charts_of_account->name = $request->input('name');
        $charts_of_account->code = $request->input('code');
        $charts_of_account->account_type = $request->input('account_type');
        $charts_of_account->notes = $request->input('notes');
        $charts_of_account->save();
        DB::commit();

        if (!$request->ajax()) {
            return redirect()->route('charts_of_account.index')->with('success', _lang('Updated Successfully'));
        }
        return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('Updated Successfully'), 'data' => $charts_of_account, 'table' => '#charts_of_account_table']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChartsOfAccount  $chartsOfAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChartsOfAccount $chartsOfAccount)
    {
        //
        $chartsOfAccount->delete();
        return redirect()->route('charts_of_account.index')->with('success', _lang('Deleted Successfully'));
    }
}
