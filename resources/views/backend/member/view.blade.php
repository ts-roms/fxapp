@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4 col-lg-3">
            <ul class="nav flex-column nav-tabs settings-tab" role="tablist">
                @if ($member->status == 'blacklisted')
                    <li class="nav-item bg-danger">
                        <a class="nav-link text-center text-white bg-red"
                            href="#">{{ Str::ucfirst($member->status) }}</a>
                    </li>
                @endif
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#member_details"><i
                            class="ti-user"></i>&nbsp;{{ _lang('Member Details') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#account_overview"><i
                            class="ti-credit-card"></i>&nbsp;{{ _lang('Account Overview') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#transaction-history"><i
                            class="ti-view-list-alt"></i>{{ _lang('Transactions') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#member_loans"><i
                            class="ti-agenda"></i>&nbsp;{{ _lang('Loans') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#member_contributions"><i
                            class="ti-agenda"></i>&nbsp;{{ _lang('Contributions') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#kyc_documents"><i
                            class="ti-files"></i>&nbsp;{{ _lang('KYC Documents') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#custom_fields_meta"><i
                            class="ti-files"></i>&nbsp;{{ _lang('Custom Fields') }}</a></li>
                <li class="nav-item d-none"><a class="nav-link" data-toggle="tab" href="#email"><i
                            class="ti-email"></i>&nbsp;{{ _lang('Send Email') }}</a></li>
                <li class="nav-item d-none"><a class="nav-link" data-toggle="tab" href="#sms"><i
                            class="ti-comment-alt"></i>&nbsp;{{ _lang('Send SMS') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ action('MemberController@edit', $member->id) }}"><i
                            class="ti-pencil-alt"></i>&nbsp;{{ _lang('Edit Member Details') }}</a></li>
            </ul>
        </div>

        <div class="col-md-8 col-lg-9">
            <div class="tab-content">
                <div id="member_details" class="tab-pane active">
                    <div class="card">
                        <div class="card-header">
                            <span class="header-title">{{ _lang('Member Details') }}</span>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <td colspan="2" class="profile_picture text-center">
                                        <img src="{{ profile_picture($member->photo) }}" class="thumb-image-md">
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ _lang('First Name') }}</td>
                                    <td>{{ $member->first_name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ _lang('Last Name') }}</td>
                                    <td>{{ $member->last_name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ _lang('Business Name') }}</td>
                                    <td>{{ $member->business_name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ _lang('Member No') }}</td>
                                    <td>{{ $member->member_no }}</td>
                                </tr>
                                <tr>
                                    <td>{{ _lang('Branch') }}</td>
                                    <td>{{ $member->branch->name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ _lang('Email') }}</td>
                                    <td>{{ $member->email }}</td>
                                </tr>
                                <tr>
                                    <td>{{ _lang('Mobile') }}</td>
                                    <td>{{ $member->country_code . $member->mobile }}</td>
                                </tr>
                                <tr>
                                    <td>{{ _lang('Gender') }}</td>
                                    <td>{{ ucwords($member->gender) }}</td>
                                </tr>
                                <tr>
                                    <td>{{ _lang('City') }}</td>
                                    <td>{{ $member->city }}</td>
                                </tr>
                                <tr>
                                    <td>{{ _lang('State') }}</td>
                                    <td>{{ $member->state }}</td>
                                </tr>
                                <tr>
                                    <td>{{ _lang('Zip') }}</td>
                                    <td>{{ $member->zip }}</td>
                                </tr>
                                <tr>
                                    <td>{{ _lang('Address') }}</td>
                                    <td>{{ $member->address }}</td>
                                </tr>
                                <tr>
                                    <td>{{ _lang('Credit Source') }}</td>
                                    <td>{{ $member->credit_source }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div id="account_overview" class="tab-pane">
                    <div class="card">
                        <div class="card-header">
                            <span class="header-title">{{ _lang('Account Overview') }}</span>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-nowrap">{{ _lang('Account Number') }}</th>
                                            <th class="text-nowrap">{{ _lang('Account Type') }}</th>
                                            <th>{{ _lang('Currency') }}</th>
                                            <th class="text-right">{{ _lang('Balance') }}</th>
                                            <th class="text-nowrap text-right">{{ _lang('Loan Guarantee') }}</th>
                                            <th class="text-nowrap text-right">{{ _lang('Current Balance') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (get_account_details($member->id) as $account)
                                            <tr>
                                                <td>{{ $account->account_number }}</td>
                                                <td class="text-nowrap">{{ $account->savings_type->name }}</td>
                                                <td>{{ $account->savings_type->currency->name }}</td>
                                                <td class="text-nowrap text-right">
                                                    {{ decimalPlace($account->balance, currency($account->savings_type->currency->name)) }}
                                                </td>
                                                <td class="text-nowrap text-right">
                                                    {{ decimalPlace($account->blocked_amount, currency($account->savings_type->currency->name)) }}
                                                </td>
                                                <td class="text-nowrap text-right">
                                                    {{ decimalPlace($account->balance - $account->blocked_amount, currency($account->savings_type->currency->name)) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="transaction-history" class="tab-pane">
                    <div class="card">
                        <div class="card-header">
                            <span class="header-title">{{ _lang('Transactions') }}</span>
                        </div>

                        <div class="card-body">
                            <table id="transactions_table" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ _lang('Date') }}</th>
                                        <th>{{ _lang('Member') }}</th>
                                        <th>{{ _lang('Account Number') }}</th>
                                        <th>{{ _lang('Amount') }}</th>
                                        <th>{{ _lang('Debit/Credit') }}</th>
                                        <th>{{ _lang('Type') }}</th>
                                        <th>{{ _lang('Status') }}</th>
                                        <th class="text-center">{{ _lang('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--End Transaction Table-->

                <div id="member_loans" class="tab-pane">
                    <div class="card">
                        <div class="card-header">
                            <span class="header-title">{{ _lang('Loans') }}</span>
                        </div>

                        <div class="card-body">
                            <table id="loans_table" class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>{{ _lang('Loan ID') }}</th>
                                        <th>{{ _lang('Loan Product') }}</th>
                                        <th class="text-right">{{ _lang('Applied Amount') }}</th>
                                        <th class="text-right">{{ _lang('Total Payable') }}</th>
                                        <th class="text-right">{{ _lang('Amount Paid') }}</th>
                                        <th class="text-right">{{ _lang('Due Amount') }}</th>
                                        <th>{{ _lang('Release Date') }}</th>
                                        <th>{{ _lang('Status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($member->loans as $loan)
                                        <tr>
                                            <td><a href="{{ route('loans.show', $loan->id) }}">{{ $loan->loan_id }}</a>
                                            </td>
                                            <td>{{ $loan->loan_product->name }}</td>
                                            <td class="text-right">
                                                {{ decimalPlace($loan->applied_amount, currency($loan->currency->name)) }}
                                            </td>
                                            <td class="text-right">
                                                {{ decimalPlace($loan->total_payable, currency($loan->currency->name)) }}
                                            </td>
                                            <td class="text-right">
                                                {{ decimalPlace($loan->total_paid, currency($loan->currency->name)) }}</td>
                                            <td class="text-right">
                                                {{ decimalPlace($loan->total_payable - $loan->total_paid, currency($loan->currency->name)) }}
                                            </td>
                                            <td>{{ $loan->release_date }}</td>
                                            <td>
                                                @if ($loan->status == 0)
                                                    {!! xss_clean(show_status(_lang('Pending'), 'warning')) !!}
                                                @elseif($loan->status == 1)
                                                    {!! xss_clean(show_status(_lang('Approved'), 'success')) !!}
                                                @elseif($loan->status == 2)
                                                    {!! xss_clean(show_status(_lang('Completed'), 'info')) !!}
                                                @elseif($loan->status == 3)
                                                    {!! xss_clean(show_status(_lang('Cancelled'), 'danger')) !!}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div id="member_contributions" class="tab-pane">
                    <div class="card">
                        <div class="card-header d-flex">
                            <span class="header-title">{{ _lang('Contributions') }}</span>
                            <a class="btn btn-primary btn-xs ml-auto ajax-modal" data-title="Add Contributions for {{ $member->first_name }}"
                                href="{{ route('members.create_contribution', $member->id) }}"><i
                                    class="ti-plus"></i>&nbsp;{{ _lang('Add New') }}</a>
                        </div>

                        <div class="card-body">
                            <table id="contributions_table" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ _lang('Date') }}</th>
                                        <th>{{ _lang('REF No.') }}</th>
                                        <th>{{ _lang('Capital BuildUp') }}</th>
                                        <th>{{ _lang('Emergency Funds') }}</th>
                                        <th>{{ _lang('Mortuary Funds') }}</th>
                                        <th>{{ _lang('Notes') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($member->contributions as $contribution)
                                        <tr>
                                            <td>{{ $contribution->payment_date }}</td>
                                            <td>{{ $contribution->reference_no }}</td>
                                            <td>{{ decimalPlace($contribution->capital_buildup, currency()) }}
                                            </td>
                                            <td>{{ decimalPlace($contribution->emergency_funds, currency()) }}</td>
                                            <td>{{ decimalPlace($contribution->mortuary_funds, currency()) }}</td>
                                            <td>{{ $contribution->notes }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2">{{ _lang('Total Paid') }}</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!--End Transaction Table-->

                <div id="kyc_documents" class="tab-pane">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h4 class="header-title">
                                {{ _lang('Documents of') . ' ' . $member->first_name . ' ' . $member->last_name }}</h4>
                            <a class="btn btn-primary btn-xs ml-auto ajax-modal"
                                data-title="{{ _lang('Add New Document') }}"
                                href="{{ route('member_documents.create', $member->id) }}"><i
                                    class="ti-plus"></i>&nbsp;{{ _lang('Add New') }}</a>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>{{ _lang('Document Name') }}</th>
                                        <th>{{ _lang('Document File') }}</th>
                                        <th>{{ _lang('Submitted At') }}</th>
                                        <th>{{ _lang('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($member->documents as $document)
                                        <tr>
                                            <td>{{ $document->name }}</td>
                                            <td><a target="_blank"
                                                    href="{{ asset('uploads/documents/' . $document->document) }}">{{ $document->document }}</a>
                                            </td>
                                            <td>{{ date('d M, Y H:i:s', strtotime($document->created_at)) }}</td>
                                            <td class="text-center">
                                                <span class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle btn-xs" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        {{ _lang('Action') }}
                                                    </button>
                                                    <form
                                                        action="{{ action('MemberDocumentController@destroy', $document->id) }}"
                                                        method="post">
                                                        {{ csrf_field() }}
                                                        <input name="_method" type="hidden" value="DELETE">

                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a href="{{ action('MemberDocumentController@edit', $document->id) }}"
                                                                data-title="{{ _lang('Update Document') }}"
                                                                class="dropdown-item dropdown-edit ajax-modal"><i
                                                                    class="ti-pencil-alt"></i>&nbsp;{{ _lang('Edit') }}</a>
                                                            <button class="btn-remove dropdown-item" type="submit"><i
                                                                    class="ti-trash"></i>&nbsp;{{ _lang('Delete') }}</button>
                                                        </div>
                                                    </form>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--End KYC Documents Tab-->

                <div id="custom_fields_meta" class="tab-pane">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <span class="header-title">{{ _lang('Custom Fields') }}</span>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="custom_fields_table">
                                <thead>
                                    <tr>
                                        <th>Field</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($member->custom_fields_meta as $field)
                                        <tr>
                                            <td>{{ $field->value }}</td>
                                            <td>{{ $field->value }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- End Custom Fields -->

                <div id="email" class="tab-pane">
                    <div class="card">
                        <div class="card-header">
                            <span class="header-title">{{ _lang('Send Email') }}</span>
                        </div>

                        <div class="card-body">
                            <form method="post" class="validate" autocomplete="off"
                                action="{{ route('members.send_email') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">{{ _lang('User Email') }}</label>
                                            <input type="email" class="form-control" name="user_email"
                                                value="{{ $member->email }}" required="" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">{{ _lang('Subject') }}</label>
                                            <input type="text" class="form-control" name="subject"
                                                value="{{ old('subject') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">{{ _lang('Message') }}</label>
                                            <textarea class="form-control" rows="8" name="message" required>{{ old('message') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block"><i
                                                    class="ti-check-box"></i>&nbsp;{{ _lang('Send') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--End Send Email Tab-->

                <div id="sms" class="tab-pane">
                    <div class="card">
                        <div class="card-header">
                            <span class="header-title">{{ _lang('Send SMS') }}</span>
                        </div>

                        <div class="card-body">
                            <form method="post" class="validate" autocomplete="off"
                                action="{{ route('members.send_sms') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">{{ _lang('User Mobile') }}</label>
                                            <input type="text" class="form-control" name="phone"
                                                value="{{ $member->country_code . $member->mobile }}" required=""
                                                readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">{{ _lang('Message') }}</label>
                                            <textarea class="form-control" name="message" required>{{ old('message') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block"><i
                                                    class="ti-check-box"></i>&nbsp;{{ _lang('Send') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--End Send SMS Tab-->

            </div>
        </div>
    </div>
@endsection

@section('js-script')
    <script>
        (function($) {

            "use strict";

            $('#transactions_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('admin/members/get_member_transaction_data/' . $member->id) }}',
                "columns": [{
                        data: 'trans_date',
                        name: 'trans_date'
                    },
                    {
                        data: 'member.first_name',
                        name: 'member.first_name'
                    },
                    {
                        data: 'account.account_number',
                        name: 'account.account_number'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'dr_cr',
                        name: 'dr_cr'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: "action",
                        name: "action"
                    },
                ],
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
                }

            });

            $('.nav-tabs a').on('shown.bs.tab', function(event) {
                var tab = $(event.target).attr("href");
                var url = "{{ route('members.show', $member->id) }}";
                history.pushState({}, null, url + "?tab=" + tab.substring(1));
            });

            @if (isset($_GET['tab']))
                $('.nav-tabs a[href="#{{ $_GET['tab'] }}"]').tab('show');
            @endif

            $("a[data-toggle=\"tab\"]").on("shown.bs.tab", function(e) {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            });

            $('#contributions_table').DataTable({
                processing: true,
                responsive: true,
                bStateSave: true,
                bAutoWidth: false,
                ordering: false,
                paging: true,
                lengthMenu: [5, 10, 25, 50],
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
                footerCallback: function(row, data, start, end, display) {
                    let api = this.api();
                    let intVal = function(i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ? i : 0
                    }


                    let capital_buildup = api.column(2).data().reduce(function(a, b) {
                        return intVal(a) + intVal(b.slice(1));
                    }, 0);
                    let emergency_funds = api.column(3).data().reduce(function(a, b) {
                        return intVal(a) + intVal(b.slice(1));
                    }, 0);
                    let mortuary_funds = api.column(4).data().reduce(function(a, b) {
                        return intVal(a) + intVal(b.slice(1));
                    }, 0);

                    $(api.column(2).footer()).html('₱ ' + parseFloat(capital_buildup).toFixed(2));
                    $(api.column(3).footer()).html('₱ ' + parseFloat(emergency_funds).toFixed(2));
                    $(api.column(4).footer()).html('₱ ' + parseFloat(mortuary_funds).toFixed(2));
                },
                drawCallback: function() {
                    $(".dataTables_paginate > .pagination").addClass("pagination-bordered");
                }
            });

            $('#custom_fields_table').DataTable({
                processing: true,
                responsive: true,
                bStateSave: true,
                bAutoWidth: false,
                ordering: false,
                paging: true,
                lengthMenu: [5, 10, 25, 50],
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
                }
            });

        })(jQuery);
    </script>
@endsection
