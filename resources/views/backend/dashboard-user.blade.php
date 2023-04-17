@extends('layouts.app')

@section('content')
    @php $permissions = permission_list(); @endphp
    <div class="row">
        @if (in_array('dashboard.total_customer_widget', $permissions))
            <div class="col-xl-3 col-md-6">
                <div class="card mb-4 primary-card dashboard-card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h5>{{ _lang('Total Members') }}</h5>
                                <h4 class="pt-1 mb-0"><b>{{ $total_customer }}</b></h4>
                            </div>
                            <div>
                                <a href="{{ route('members.index') }}"><i
                                        class="ti-arrow-right"></i>&nbsp;{{ _lang('View') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (in_array('dashboard.deposit_requests_widget', $permissions))
            <div class="col-xl-3 col-md-6">
                <div class="card mb-4 success-card dashboard-card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h5>{{ _lang('Loan Release') }}</h5>
                                <h4 class="pt-1 mb-0"><b>{{ request_count('loan_release') }}</b></h4>
                            </div>
                            <div>
                                <a href="{{ route('loans.filter', 'active') }}"><i
                                        class="ti-arrow-right"></i>&nbsp;{{ _lang('View') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (in_array('dashboard.withdraw_requests_widget', $permissions))
            <div class="col-xl-3 col-md-6">
                <div class="card mb-4 warning-card dashboard-card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h5>{{ _lang('Total Payments') }}</h5>
                                <h4 class="pt-1 mb-0"><b>{{ request_count('total_payments') }}</b></h4>
                            </div>
                            <div>
                                <a href="{{ route('loan_payments.index') }}"><i
                                        class="ti-arrow-right"></i>&nbsp;{{ _lang('View') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (in_array('dashboard.loan_requests_widget', $permissions))
            <div class="col-xl-3 col-md-6">
                <div class="card mb-4 danger-card dashboard-card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h5>{{ _lang('Pending Loans') }}</h5>
                                <h4 class="pt-1 mb-0"><b>{{ request_count('pending_loans') }}</b></h4>
                            </div>
                            <div>
                                <a href="{{ route('loans.index') }}"><i
                                        class="ti-arrow-right"></i>&nbsp;{{ _lang('View') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="row">
        @if (in_array('dashboard.total_customer_widget', $permissions))
            <div class="col-xl-3 col-md-6">
                <div class="card mb-4 success-card dashboard-card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h5>{{ _lang('Big Brother') }}</h5>
                                <h4 class="pt-1 mb-0"><b>{{ decimalPlace($big_brother, currency()) }}</b></h4>
                            </div>
                            <div>
                                <a href="{{ route('big_brother.index') }}"><i
                                        class="ti-arrow-right"></i>&nbsp;{{ _lang('View') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (in_array('dashboard.total_customer_widget', $permissions))
            <div class="col-xl-3 col-md-6">
                <div class="card mb-4 warning-card dashboard-card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h5>{{ _lang('Total Expenses') }}</h5>
                                <h4 class="pt-1 mb-0"><b>{{ decimalPlace($expenses, currency()) }}</b></h4>
                            </div>
                            <div>
                                <a href="{{ route('expenses.index') }}"><i
                                        class="ti-arrow-right"></i>&nbsp;{{ _lang('View') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (in_array('dashboard.total_customer_widget', $permissions))
            <div class="col-xl-3 col-md-6">
                <div class="card mb-4 danger-card dashboard-card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h5>{{ _lang('Total Other Income') }}</h5>
                                <h4 class="pt-1 mb-0"><b>{{ decimalPlace($other_income, currency()) }}</b></h4>
                            </div>
                            <div>
                                <a href="{{ route('other_income.index') }}"><i
                                        class="ti-arrow-right"></i>&nbsp;{{ _lang('View') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (in_array('dashboard.total_customer_widget', $permissions))
            <div class="col-xl-3 col-md-6">
                <div class="card mb-4 primary-card dashboard-card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h5>{{ _lang('Total Interest') }}</h5>
                                <h4 class="pt-1 mb-0"><b>{{ decimalPlace($total_interest, currency()) }}</b></h4>
                            </div>
                            <div>
                                <a href="{{ route('loans.index') }}"><i
                                        class="ti-arrow-right"></i>&nbsp;{{ _lang('View') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    @endif

    <div class="row">
        @if (in_array('dashboard.expense_overview_widget', $permissions))
            <div class="col-md-4 col-sm-5 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center">
                        <span>{{ _lang('Expense Overview') . ' - ' . date('M Y') }}</span>
                    </div>
                    <div class="card-body">
                        <canvas id="expenseOverview"></canvas>
                    </div>
                </div>
            </div>
        @endif

        @if (in_array('dashboard.deposit_withdraw_analytics', $permissions))
            <div class="col-md-8 col-sm-7 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center">
                        <span>{{ _lang('Deposit & Withdraw Analytics') . ' - ' . date('Y') }}</span>
                        <select class="filter-select ml-auto py-0 auto-select" data-selected="{{ base_currency_id() }}">
                            @foreach (\App\Models\Currency::where('status', 1)->get() as $currency)
                                <option value="{{ $currency->id }}" data-symbol="{{ currency($currency->name) }}">
                                    {{ $currency->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="card-body">
                        <canvas id="transactionAnalysis"></canvas>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @if (in_array('dashboard.recent_transaction_widget', $permissions))
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header">
                        {{ _lang('Recent Transactions') }}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ _lang('Date') }}</th>
                                        <th>{{ _lang('Member') }}</th>
                                        <th class="text-nowrap">{{ _lang('Account Number') }}</th>
                                        <th>{{ _lang('Amount') }}</th>
                                        <th class="text-nowrap">{{ _lang('Debit/Credit') }}</th>
                                        <th>{{ _lang('Type') }}</th>
                                        <th>{{ _lang('Status') }}</th>
                                        <th class="text-center">{{ _lang('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recent_transactions as $transaction)
                                        @php
                                            $symbol = $transaction->dr_cr == 'dr' ? '-' : '+';
                                            $class = $transaction->dr_cr == 'dr' ? 'text-danger' : 'text-success';
                                        @endphp
                                        <tr>
                                            <td class="text-nowrap">{{ $transaction->trans_date }}</td>
                                            <td>{{ $transaction->member->name }}</td>
                                            <td>{{ $transaction->account->account_number }}</td>
                                            <td><span
                                                    class="text-nowrap {{ $class }}">{{ $symbol . ' ' . decimalPlace($transaction->amount, currency($transaction->account->savings_type->currency->name)) }}</span>
                                            </td>
                                            <td>{{ strtoupper($transaction->dr_cr) }}</td>
                                            <td>{{ str_replace('_', ' ', $transaction->type) }}</td>
                                            <td>{!! xss_clean(transaction_status($transaction->status)) !!}</td>
                                            <td class="text-center"><a
                                                    href="{{ action('TransactionController@show', $transaction->id) }}"
                                                    target="_blank" class="btn btn-outline-primary btn-xs"><i
                                                        class="ti-arrow-right"></i>&nbsp;{{ _lang('View') }}</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('js-script')
    <script src="{{ asset('backend/plugins/chartJs/chart.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/dashboard.js?v=1.1') }}"></script>
@endsection
