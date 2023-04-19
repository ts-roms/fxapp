<?php

namespace App\Http\Controllers;

use App\Models\CustomFields;
use DataTables;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomFieldsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $custom_fields = CustomFields::all();

        return view('backend.custom_fields.list', compact('custom_fields'));
    }

    public function get_table_data()
    {
        $custom_fields = CustomFields::orderBy('id', 'desc');
        return DataTables::eloquent($custom_fields)
            ->editColumn('field_label', function ($fn) {
                return $fn->field_label . '(' . $fn->field_name . ')';
            })
            ->editColumn('required', function ($fn) {
                return $fn->required == 0 ? 'No' : 'Yes';
            })
            ->addColumn('action', function ($fn) {
                return '<div class="dropdown text-center">'
                    . '<button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown">' . _lang('Action')
                    . '&nbsp;</button>'
                    . '<div class="dropdown-menu">'
                    . '<a class="dropdown-item ajax-modal" href="' . action('CustomFieldsController@edit', $fn->id) . '" data-title="' . _lang('Custom Fields') . '"><i class="ti-pencil-alt"></i> ' . _lang('Edit') . '</a>'
                    . '<a class="dropdown-item ajax-modal" href="' . action('CustomFieldsController@show', $fn->id) . '" data-title="' . _lang('Custom Fields') . '"><i class="ti-eye"></i>  ' . _lang('View') . '</a>'
                    . '<form action="' . action('CustomFieldsController@destroy', $fn->id) . '" method="post">'
                    . csrf_field()
                    . '<input name="_method" type="hidden" value="DELETE">'
                    . '<button class="dropdown-item btn-remove" type="submit"><i class="ti-trash"></i> ' . _lang('Delete') . '</button>'
                    . '</form>'
                    . '</div>'
                    . '</div>';
            })
            ->setRowId(function ($custom_field) {
                return "row_" . $custom_field->id;
            })
            ->rawColumns(['action', 'field_label'])
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
            return view('backend.custom_fields.create');
        }
        return view('backend.custom_fields.modal.create');
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
            'field_name' => 'required',
            'field_label' => 'required',
            'belongs_to' => 'required',
            'field_type' => 'required',
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


        $custom_fields = new CustomFields();
        $custom_fields->field_name = $request->input('field_name');
        $custom_fields->field_label = $request->input('field_label');
        $custom_fields->belongs_to = $request->input('belongs_to');
        $custom_fields->field_type = $request->input('field_type');
        $custom_fields->required = $request->input('required') == 'Yes' ? 1 : 0;
        $custom_fields->field_class = $request->input('field_class') ?? '';
        $custom_fields->created_user_id = auth()->id();
        $custom_fields->save();

        if (!$request->ajax()) {
            return redirect()->route('custom_fields.create')->with('success', _lang('Saved Successfully'));
        }
        return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Saved Successfully'), 'data' => $custom_fields, 'table' => '#custom_fields_table']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomFields  $customFields
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, CustomFields $custom_field)
    {
        //
        if (!$request->ajax()) {
            return back();
        }
        return view('backend.custom_fields.modal.view', compact('custom_field'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomFields  $customFields
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, CustomFields $custom_field)
    {
        //
        if (!$request->ajax()) {
            return back();
        }
        return view('backend.custom_fields.modal.edit', compact('custom_field'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomFields  $customFields
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomFields $custom_field)
    {
        //

        $validator = Validator::make($request->all(), [
            'field_name' => 'required',
            'field_label' => 'required',
            'belongs_to' => 'required',
            'field_type' => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('custom_fields.create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }


        DB::beginTransaction();
        $custom_fields = CustomFields::find($custom_field->id);
        $custom_fields->field_name = $request->input('field_name');
        $custom_fields->field_label = $request->input('field_label');
        $custom_fields->belongs_to = $request->input('belongs_to');
        $custom_fields->field_type = $request->input('field_type');
        $custom_fields->required = $request->input('required') == 'Yes' ? 1 : 0;
        $custom_fields->field_class = $request->input('field_class');
        $custom_fields->save();
        DB::commit();

        if (!$request->ajax()) {
            return redirect()->route('custom_fields.index')->with('success', _lang('Updated Successfully'));
        }
        return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('Updated Successfully'), 'data' => $custom_fields, 'table' => '#custom_fields_table']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomFields  $customFields
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomFields $custom_field)
    {
        //
        $custom_field->delete();
        return redirect()->route('custom_fields.index')->with('success', _lang('Deleted Successfully'));
    }
}
