@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card no-export">
                <div class="card-header d-flex align-items-center">
                    <h2 class="panel-title">{{ _lang('Big Brother') }}</h2>
                    <div class="ml-auto d-flex align-items-center">
                        <select name="status" class="select-filter filter-select auto-select mr-1"
                            data-selected="{{ $status }}">
                            <option value="active">{{ _lang('Active') }}</option>
                            <option value="processing">{{ _lang('Processing') }}</option>
                            <option value="closed">{{ _lang('Close') }}</option>
                        </select>
                        <a class="btn btn-primary btn-xs ml-auto ajax-modal" data-title="{{ _lang('Add New Expense') }}"
                            href="{{ route('big_brother.create') }}"><i class="ti-plus"></i>&nbsp;{{ _lang('Add New') }}</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="big_brother_table" class="table table-bordered">
                        <thead>
                            <tr>
                                <td>{{ _lang('Account') }}</td>
                                <td>{{ _lang('Period From') }}</td>
                                <td>{{ _lang('Period To') }}</td>
                                <td>{{ _lang('Capital') }}</td>
                                <td>{{ _lang('Total Expenses') }}</td>
                                <td>{{ _lang('Total Cashback') }}</td>
                                <td>{{ _lang('Action') }}</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-script')
    <script>
        (function($) {
            'use strict';

            var big_brother_table = $('#big_brother_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ url('admin/big_brother/get_table_data') }}',
                    method: "GET",
                    data: function(d) {
                        d._token = $('meta[name="csrf-token"]').attr("content");

                        if ($("select[name=status]").val() != "") {
                            d.status = $("select[name=status]").val();
                        }
                    },
                    error: function(request, status, error) {
                        console.log(request.responseText);
                    },
                },
                columns: [{
                    data: 'account_id',
                    name: 'account_id'
                }, {
                    data: 'period_from',
                    name: 'period_from'
                }, {
                    data: 'period_to',
                    name: 'period_to'
                }, {
                    data: 'capital',
                    name: 'capital'
                }, {
                    data: 'total_expense',
                    name: 'total_expense'
                }, {
                    data: 'total_cashback',
                    name: 'total_cashback'
                }, {
                    data: 'action',
                    name: 'action'
                }],
                responsive: true,
                bStateSave: true,
                bAutoWidth: false,
                ordering: false,
                language: {
                    decimal: '',
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


            $(".select-filter").on("change", function(e) {
                big_brother_table.draw();
            });

            $(document).on("ajax-screen-submit", function() {
                big_brother_table.draw();
            });


        })(jQuery)
    </script>
@endsection
