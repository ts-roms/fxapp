@php
    $deposit_requests = request_count('deposit_requests', true);
    $withdraw_requests = request_count('withdraw_requests', true);
    $member_requests = request_count('member_requests', true);
    $pending_loans = request_count('pending_loans', true);
    $permissions = permission_list();
@endphp

<li>
    <a href="{{ route('dashboard.index') }}"><i class="ti-dashboard"></i> <span>{{ _lang('Dashboard') }}</span></a>
</li>

@if (in_array('branches.index', $permissions))
    <li>
        <a href="{{ route('branches.index') }}"><i class="fas fa-building"></i><span>{{ _lang('Branches') }}</span></a>
    </li>
@endif

<li>
    <a href="javascript: void(0);"><i class="fas fa-user-friends"></i><span>{{ _lang('Members') }}
            {!! xss_clean($member_requests) !!}</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        @if (in_array('members.index', $permissions))
            <li class="nav-item"><a class="nav-link" href="{{ route('members.index') }}">{{ _lang('View Members') }}</a>
            </li>
        @endif

        @if (in_array('members.create', $permissions))
            <li class="nav-item"><a class="nav-link" href="{{ route('members.create') }}">{{ _lang('Add Member') }}</a>
            </li>
        @endif

        @if (in_array('members.pending_requests', $permissions))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('members.pending_requests') }}">{{ _lang('Member Requests') }}
                    {!! xss_clean($member_requests) !!}</a>
            </li>
        @endif
    </ul>
</li>

<li>
    <a href="javascript: void(0);"><i class="fas fa-hand-holding-usd"></i><span>{{ _lang('Loans') }}
            {!! xss_clean($pending_loans) !!}</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        @if (in_array('loans.index', $permissions))
            <li class="nav-item"><a class="nav-link" href="{{ route('loans.index') }}">{{ _lang('All Loans') }}</a>
            </li>
        @endif

        @if (in_array('loans.filter', $permissions))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('loans.filter', 'pending') }}">
                    {{ _lang('Pending Loans') }}
                    {!! xss_clean($pending_loans) !!}
                </a>
            </li>
        @endif

        @if (in_array('loans.filter', $permissions))
            <li class="nav-item"><a class="nav-link"
                    href="{{ route('loans.filter', 'active') }}">{{ _lang('Active Loans') }}</a></li>
        @endif

        <li class="nav-item"><a class="nav-link"
                href="{{ route('loans.admin_calculator') }}">{{ _lang('Loan Calculator') }}</a></li>
        @if (in_array('loan_products.index', $permissions))
            <li class="nav-item"><a class="nav-link"
                    href="{{ route('loan_products.index') }}">{{ _lang('Loan Products') }}</a></li>
        @endif
    </ul>
</li>

@if (in_array('loan_payments.index', $permissions))
    <li><a href="{{ route('loan_payments.index') }}"><i
                class="fas fa-receipt"></i><span>{{ _lang('Repayments') }}</span></a></li>
@endif

@if (in_array('contributions.index', $permissions))
    <li><a href="{{ route('contributions.index') }}"><i
                class="fas fa-file-invoice"></i><span>{{ _lang('Contributions') }}</span></a></li>
@endif

<li>
    <a href="javascript: void(0);"><i class="fas fa-landmark"></i><span>{{ _lang('Accounts') }}</span><span
            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        @if (in_array('savings_accounts.index', $permissions))
            <li class="nav-item"><a class="nav-link"
                    href="{{ route('savings_accounts.index') }}">{{ _lang('All Accounts') }}</a></li>
        @endif

        @if (in_array('interest_calculation.calculator', $permissions))
            <li class="nav-item"><a class="nav-link"
                    href="{{ route('interest_calculation.calculator') }}">{{ _lang('Interest Calculation') }}</a></li>
        @endif
    </ul>
</li>

<li>
    <a href="javascript: void(0);"><i class="fas fa-coins"></i><span>{{ _lang('Deposit') }}
            {!! xss_clean($deposit_requests) !!}</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        @if (in_array('deposit_requests.create', $permissions))
            <li class="nav-item"><a class="nav-link"
                    href="{{ route('transactions.create') }}?type=deposit">{{ _lang('Deposit Money') }}</a></li>
        @endif

        @if (in_array('deposit_requests.index', $permissions))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('deposit_requests.index') }}">
                    {{ _lang('Deposit Requests') }}
                    {!! xss_clean($deposit_requests) !!}
                </a>
            </li>
        @endif
    </ul>
</li>

<li>
    <a href="javascript: void(0);"><i class="fas fa-money-check"></i><span>{{ _lang('Withdraw') }}
            {!! xss_clean($withdraw_requests) !!}</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        @if (in_array('withdraw_requests.create', $permissions))
            <li class="nav-item"><a class="nav-link"
                    href="{{ route('transactions.create') }}?type=withdraw">{{ _lang('Withdraw Money') }}</a></li>
        @endif
        @if (in_array('withdraw_requests.index', $permissions))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('withdraw_requests.index') }}">
                    {{ _lang('Withdraw Requests') }}
                    {!! xss_clean($withdraw_requests) !!}
                </a>
            </li>
        @endif
    </ul>
</li>

<li>
    <a href="javascript: void(0);"><i class="fas fa-wallet"></i><span>{{ _lang('Transactions') }}</span><span
            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        @if (in_array('transactions.create', $permissions))
            <li class="nav-item"><a class="nav-link"
                    href="{{ route('transactions.create') }}">{{ _lang('New Transaction') }}</a></li>
        @endif
        @if (in_array('transactions.index', $permissions))
            <li class="nav-item"><a class="nav-link"
                    href="{{ route('transactions.index') }}">{{ _lang('Transaction History') }}</a></li>
        @endif
    </ul>
</li>

<li>
    <a href="javascript: void(0);"><i class="fas fa-money-bill-wave"></i><span>{{ _lang('Expense') }}</span><span
            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        @if (in_array('expenses.index', $permissions))
            <li class="nav-item"><a class="nav-link"
                    href="{{ route('expenses.index') }}">{{ _lang('All Expense') }}</a></li>
        @endif

        @if (in_array('expense_categories.index', $permissions))
            <li class="nav-item"><a class="nav-link"
                    href="{{ route('expense_categories.index') }}">{{ _lang('Expense Categories') }}</a></li>
        @endif
    </ul>
</li>

<li>
    <a href="javascript: void(0);"><i
            class="fas fa-hand-holding-usd"></i><span>{{ _lang('Other Income') }}</span><span class="menu-arrow"><i
                class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        @if (in_array('other_income.index', $permissions))
            <li class="nav-item"><a class="nav-link"
                    href="{{ route('other_income.index') }}">{{ _lang('All Other Income') }}</a></li>
        @endif
        @if (in_array('other_income_categories.index', $permissions))
            <li class="nav-item"><a class="nav-link"
                    href="{{ route('other_income_categories.index') }}">{{ _lang('Other Income Categories') }}</a>
            </li>
        @endif
    </ul>
</li>

@if (in_array('big_brother.index', $permissions))
    <li>
        <a href="javascript: void(0);"><i
                class="fas fa-hand-holding-usd"></i><span>{{ _lang('Cash in Bank') }}</span><span
                class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
        <ul class="nav-second-level" aria-expanded="false">
            <li class="nav-item"><a class="nav-link"
                    href="{{ route('big_brother.index') }}">{{ _lang('Cash in Bank Funds') }}</a></li>
        </ul>
    </li>
@endif

<li>
    <a href="javascript: void(0);"><i
            class="fas fa-hand-holding-usd"></i><span>{{ _lang('Charts Of Account') }}</span><span
            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        <li class="nav-item"><a class="nav-link"
                href="{{ route('charts_of_account.index') }}">{{ _lang('All Charts Of Account') }}</a></li>
    </ul>
</li>


@if (in_array('custom_fields.index', $permissions))
    <li>
        <a href="javascript: void(0);"><i class="ti-world"></i><span>
                {{ _lang('Custom Fields') }}
                <span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span>
        </a>
        <ul>
            <li class="nav-item"><a class="nav-link"
                    href="{{ route('custom_fields.index') }}">{{ _lang('All Custom Fields') }}</a></li>
        </ul>
    </li>
@endif


<li>
    <a href="javascript: void(0);"><i class="ti-bar-chart"></i><span>{{ _lang('Reports') }}</span><span
            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        @if (in_array('reports.account_statement', $permissions))
            <li class="nav-item"><a class="nav-link"
                    href="{{ route('reports.account_statement') }}">{{ _lang('Account Statement') }}</a></li>
        @endif

        @if (in_array('reports.members_report', $permissions))
            <li class="nav-item"><a class="nav-link"
                    href="{{ route('reports.members_report') }}">{{ _lang('Members Report') }}</a></li>
        @endif

        @if (in_array('reports.account_balances', $permissions))
            <li class="nav-item"><a class="nav-link"
                    href="{{ route('reports.account_balances') }}">{{ _lang('Account Balance') }}</a></li>
        @endif

        @if (in_array('reports.loan_report', $permissions))
            <li class="nav-item"><a class="nav-link"
                    href="{{ route('reports.loan_report') }}">{{ _lang('Loan Report') }}</a></li>
        @endif

        @if (in_array('reports.loan_due_report', $permissions))
            <li class="nav-item"><a class="nav-link"
                    href="{{ route('reports.loan_due_report') }}">{{ _lang('Loan Due Report') }}</a></li>
        @endif

        @if (in_array('reports.transactions_report', $permissions))
            <li class="nav-item"><a class="nav-link"
                    href="{{ route('reports.transactions_report') }}">{{ _lang('Transaction Report') }}</a></li>
        @endif

        @if (in_array('reports.expense_report', $permissions))
            <li class="nav-item"><a class="nav-link"
                    href="{{ route('reports.expense_report') }}">{{ _lang('Expense Report') }}</a></li>
        @endif

        @if (in_array('reports.other_income_report', $permissions))
            <li class="nav-item"><a class="nav-link"
                    href="{{ route('reports.other_income_report') }}">{{ _lang('Other Income Report') }}</a></li>
        @endif

        @if (in_array('reports.revenue_report', $permissions))
            <li class="nav-item"><a class="nav-link"
                    href="{{ route('reports.revenue_report') }}">{{ _lang('Revenue Report') }}</a></li>
        @endif
    </ul>
</li>
