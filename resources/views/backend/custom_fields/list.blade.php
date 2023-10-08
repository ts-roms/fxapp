@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card no-export">
                <div class="card-header">
                    <span class="panel-title">{{ _lang('All Custom Fields') }}</span>
                    <a class="btn btn-primary btn-xs float-right ajax-modal" data-title="{{ _lang('Add New Custom Fields') }}"
                        href="{{ route('custom_fields.create') }}"><i class="ti-plus"></i>&nbsp;{{ _lang('Add New') }}</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hovered" id="custom_fields_table">
                        <thead>
                            <tr>
                                <th>{{ _lang('Field Name') }}</th>
                                <th>{{ _lang('Field Belongs To') }}</th>
                                <th>{{ _lang('Field Type') }}</th>
                                <th>{{ _lang('Required') }}</th>
                                <th>{{ _lang('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
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

            var custom_fields_table = $('#custom_fields_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('admin/custom_fields/get_table_data') }}',
                columns: [{
                        data: 'field_label',
                        name: 'field_label'
                    },
                    {
                        data: 'belongs_to',
                        name: 'belongs_to'
                    },
                    {
                        data: 'field_type',
                        name: 'field_type'
                    },
                    {
                        data: 'required',
                        name: 'required'
                    },
                    {
                        data: 'action',
                        name: 'action'
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
            $(document).on("ajax-screen-submit", function () {
                custom_fields_table.draw();
            });
        })(jQuery)
    </script>
@endsection
