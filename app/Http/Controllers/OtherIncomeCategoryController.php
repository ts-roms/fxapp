<?php

namespace App\Http\Controllers;

use App\Models\OtherIncomeCategory;
use Illuminate\Http\Request;
use Validator;

class OtherIncomeCategoryController extends Controller
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
        $other_income_categories = OtherIncomeCategory::all()->sortBy('name');
        return view('backend.other_income_category.list', compact('other_income_categories'));
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
            return view('backend.other_income_category.modal.create');
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
            'name'  => 'required',
            'color' => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('expense_categories.create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $other_income_category              = new OtherIncomeCategory();
        $other_income_category->name        = $request->input('name');
        $other_income_category->color       = $request->input('color');
        $other_income_category->description = $request->input('description');

        $other_income_category->save();

        $other_income_category->color = '<div class="rounded-circle color-circle" style="background:' . $other_income_category->color . '"></div>';

        if (!$request->ajax()) {
            return redirect()->route('other_income_categories.create')->with('success', _lang('Saved Successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Saved Successfully'), 'data' => $other_income_category, 'table' => '#other_income_categories_table']);
        }
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'color' => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('other_income_categories.edit', $id)
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $other_income_category              = OtherIncomeCategory::find($id);
        $other_income_category->name        = $request->input('name');
        $other_income_category->color       = $request->input('color');
        $other_income_category->description = $request->input('description');

        $other_income_category->save();

        $other_income_category->color = '<div class="rounded-circle color-circle" style="background:'. $other_income_category->color .'"></div>';

        if (!$request->ajax()) {
            return redirect()->route('other_income_categories.index')->with('success', _lang('Updated Successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('Updated Successfully'), 'data' => $other_income_category, 'table' => '#other_income_categories_table']);
        }

    }

      /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $other_income_category = OtherIncomeCategory::find($id);
        if (!$request->ajax()) {
            return back();
        } else {
            return view('backend.other_income_category.modal.edit', compact('other_income_category', 'id'));
        }

    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $other_income_category = OtherIncomeCategory::find($id);
        $other_income_category->delete();
        return redirect()->route('other_income_categories.index')->with('success', _lang('Deleted Successfully'));
    }
}
