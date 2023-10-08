@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card no-export">
                <div class="card-header d-flex align-items-center">
                    <span class="panel-title">{{ _lang('Contritbutions') }}</span>
                    <a class="btn btn-primary btn-xs ml-auto" data-title="{{ _lang('Add New Expense') }}"
                        href="{{ route('contributions.create') }}"><i class="ti-plus"></i>&nbsp;{{ _lang('Add New') }}</a>
                </div>
                <div class="card-body">
                    <table id="contribution_table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{ _lang('Member') }}</th>
                                <th>{{ _lang('Reference No.') }}</th>
                                <th>{{ _lang('Capital Buildup') }}</th>
                                <th>{{ _lang('Emergency Funds') }}</th>
                                <th>{{ _lang('Mortuary Funds') }}</th>
                                <th>{{ _lang('Date') }}</th>
                                <th>{{ _lang('Notes') }}</th>
                                <th class="text-center">{{ _lang('Action') }}</th>
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

            "use strict";

            var contribution_table = $('#contribution_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('admin/contributions/get_table_data') }}',
                "columns": [{
                    data: 'member',
                    name: 'member'
                }, {
                    data: 'reference_no',
                    name: 'reference_no'
                }, {
                    data: 'capital_buildup',
                    name: 'capital_buildup'
                }, {
                    data: 'emergency_funds',
                    name: 'emergency_funds'
                }, {
                    data: 'mortuary_funds',
                    name: 'mortuary_funds'
                }, {
                    data: 'payment_date',
                    name: 'payment_date'
                }, {
                    data: 'notes',
                    name: 'notes'
                }, {
                    data: 'action',
                    name: 'action'
                }],
                responsive: true,
                "bStateSave": true,
                "bAutoWidth": false,
                "ordering": false,
                "language": {
                    "decimal": "",
                    "emptyTable": "{{ _lang('No Data Found') }}",
                    "info": "{{ _lang('Showing') }} _START_ {{ _lang('to') }} _END_ {{ _lang('of') }} _TOTAL_ {{ _lang('Entries') }}",
                    "infoEmpty": "{{ _lang('Showing 0 To 0 Of 0 Entries') }}",
                    "infoFiltered": "(filtered from _MAX_ total entries)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "{{ _lang('Show') }} _MENU_ {{ _lang('Entries') }}",
                    "loadingRecords": "{{ _lang('Loading...') }}",
                    "processing": "{{ _lang('Processing...') }}",
                    "search": "{{ _lang('Search') }}",
                    "zeroRecords": "{{ _lang('No matching records found') }}",
                    "paginate": {
                        "first": "{{ _lang('First') }}",
                        "last": "{{ _lang('Last') }}",
                        "previous": "<i class='ti-angle-left'></i>",
                        "next": "<i class='ti-angle-right'></i>",
                    }
                },
                drawCallback: function() {
                    $(".dataTables_paginate > .pagination").addClass("pagination-bordered");
                },

            });
            $(document).on("ajax-screen-submit", function () {
                contribution_table.draw();
            });
        })(jQuery);
    </script>
@endsection
