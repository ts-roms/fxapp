<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contribution;
use App\Models\Member;
use DataTables;
use DB;
use Exception;
use Validator;

class ContributionController extends Controller
{
  //
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    date_default_timezone_set(get_option('timezone', 'Asia/HongKong'));
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('backend.contributions.list');
  }

  public function get_table_data()
  {

    $currency = currency(get_base_currency());

    $contributions = Contribution::orderBy('id', 'desc');

    return Datatables::eloquent($contributions)
      ->editColumn('member', function ($contribution) {
        return '<a href="' . action('MemberController@show', $contribution->member_id) . '">' . $contribution->member->first_name . ' ' . $contribution->member->last_name . '</a>';
      })
      ->editColumn('capital_buildup', function ($contribution) use ($currency) {
        return decimalPlace($contribution->capital_buildup, $currency);
      })
      ->editColumn('emergency_funds', function ($contribution) use ($currency) {
        return decimalPlace($contribution->emergency_funds, $currency);
      })
      ->editColumn('mortuary_funds', function ($contribution) use ($currency) {
        return decimalPlace($contribution->mortuary_funds, $currency);
      })
      ->addColumn('action', function ($contribution) {
        return '<div class="dropdown text-center">'
          . '<button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown">' . _lang('Action')
          . '&nbsp;</button>'
          . '<div class="dropdown-menu">'
          . '<a class="dropdown-item ajax-modal" href="' . action('ContributionController@edit', $contribution->id) . '" data-title="' . $contribution->member->first_name . ' ' . $contribution->member->last_name . '\'s ' . _lang('Contributions') . '"><i class="ti-pencil-alt"></i> ' . _lang('Edit') . '</a>'
          . '<a class="dropdown-item ajax-modal" href="' . action('ContributionController@show', $contribution->id) . '" data-title="' . $contribution->member->first_name . ' ' . $contribution->member->last_name . '\'s ' . _lang('Contributions') . '"><i class="ti-eye"></i>  ' . _lang('View') . '</a>'
          . '<form action="' . action('ContributionController@destroy', $contribution->id) . '" method="post">'
          . csrf_field()
          . '<input name="_method" type="hidden" value="DELETE">'
          . '<button class="dropdown-item btn-remove" type="submit"><i class="ti-trash"></i> ' . _lang('Delete') . '</button>'
          . '</form>'
          . '</div>'
          . '</div>';
      })
      ->setRowId(function ($contribution) {
        return "row_" . $contribution->id;
      })
      ->rawColumns(['action', 'member'])
      ->make(true);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {
    $members = Member::where('status', 1)->get();
    return view('backend.contributions.create', compact('members'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $memberId = $request->input('member_id');

    DB::beginTransaction();
    foreach ($memberId as $key => $value) {
      $contrib = new Contribution();
      $contrib->member_id = $value;
      $contrib->capital_buildup = $request->input('capital_buildup')[$key] ?? 0;
      $contrib->emergency_funds = $request->input('emergency_funds')[$key] ?? 0;
      $contrib->mortuary_funds = $request->input('mortuary_funds')[$key] ?? 0;
      $contrib->reference_no = generate_reference('CMP', 6);
      $contrib->payment_date = date('Y-m-d');
      $contrib->notes = $request->input('notes')[$key];
      $contrib->save();
    }
    DB::commit();

    return redirect()->route('contributions.create')->with('success', _lang('Saved Successfully'));
  }

  /**
   * Display the specified resource.
   * 
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function show(Request $request, $id)
  {
    $contribution = Contribution::find($id);
    if (!$request->ajax()) {
      return back();
    }
    return view('backend.contributions.modal.view', compact('contribution', 'id'));
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
      'capital_buildup' => 'required|numeric',
      'emergency_funds' => 'required|numeric',
      'mortuary_funds'  => 'required|numeric',
    ]);

    if ($validator->fails()) {
      if ($request->ajax()) {
        return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
      } else {
        return redirect()->route('contributions.edit', $id)
          ->withErrors($validator)
          ->withInput();
      }
    }

    DB::beginTransaction();
    $contrib = Contribution::find($id);
    $contrib->capital_buildup = $request->input('capital_buildup');
    $contrib->emergency_funds = $request->input('emergency_funds');
    $contrib->mortuary_funds = $request->input('mortuary_funds');
    $contrib->notes = $request->input('notes');
    $contrib->save();
    DB::commit();

    \Cache::forget('capital_buildup');
    \Cache::forget('emergency_funds');
    \Cache::forget('mortuary_funds');
    \Cache::forget('notes');

    if (!$request->ajax()) {
      return redirect()->route('contributions.index')->with('success', _lang('Updated Successfully'));
    } else {
      return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('Updated Successfully'), 'data' => $contrib, 'table' => '#contribution_table']);
    }
  }


  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Request $request, $id)
  {
    $contribution = Contribution::find($id);
    if (!$request->ajax()) {
      return view('backend.contributions.modal.edit', compact('contribution', 'id'));
    }
    return view('backend.contributions.modal.edit', compact('contribution', 'id'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $expense = Contribution::find($id);
    $expense->delete();
    return redirect()->route('contributions.index')->with('success', _lang('Deleted Successfully'));
  }
}
