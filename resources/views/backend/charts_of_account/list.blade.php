@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <span class="panel-title">{{ _lang('Charts Of Account') }}</span>
                    <a href="{{ route('charts_of_account.create') }}" data-title="{{ 'New Charts of Account' }}"
                        class="btn btn-primary btn-xs ml-auto ajax-modal"><i
                            class="ti-plus"></i>&nbsp;{{ _lang('Add New') }}</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hovered" id="charts_of_account_table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Account Type</th>
                                <th>Notes</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js-script')
    <script>
        (function($) {
            'use strict'
            $('#charts_of_account_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('admin/charts_of_account/get_table_data') }}',
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'account_type',
                        name: 'account_type'
                    },
                    {
                        data: 'notes',
                        name: 'notes'
                    },
                    {
                        data: "action",
                        name: "action"
                    }
                ],
                responsive: true,
                bStateSave: true,
                bAutoWidth: false,
                ordering: false,
                language: {
                    decimal: "",
                    emptyTable: "{{ _lang('No Data Found') }}",
                    info: "{{ _lang('Showing') }} _START_ {{ _lang('to') }} _END_ {{ _lang('of') }} _TOTAL_ {{ _lang('Entries') }}",
                    infoEmpty: "{{ _lang('Showing 0 To 0 Of 0 Entries') }}",
                    infoFiltered: "(filtered from _MAX_ total entries)",
                    infoPostFix: "",
                    thousands: ",",
                    lengthMenu: "{{ _lang('Show') }} _MENU_ {{ _lang('Entries') }}",
                    loadingRecords: "{{ _lang('Loading...') }}",
                    processing: "{{ _lang('Processing...') }}",
                    search: "{{ _lang('Search') }}",
                    zeroRecords: "{{ _lang('No matching records found') }}",
                    paginate: {
                        first: "{{ _lang('First') }}",
                        last: "{{ _lang('Last') }}",
                        previous: "<i class='ti-angle-left'></i>",
                        next: "<i class='ti-angle-right'></i>",
                    }
                },
                drawCallback: function() {
                    $(".dataTables_paginate > .pagination").addClass("pagination-bordered");
                },

            });
        })(jQuery)
    </script>
@endsection
