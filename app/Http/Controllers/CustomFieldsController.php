<?php

namespace App\Http\Controllers;

use App\Models\CustomFields;
use Illuminate\Http\Request;

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

        return view('backend.custom_fields.list');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomFields  $customFields
     * @return \Illuminate\Http\Response
     */
    public function show(CustomFields $customFields)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomFields  $customFields
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomFields $customFields)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomFields  $customFields
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomFields $customFields)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomFields  $customFields
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomFields $customFields)
    {
        //
    }
}
