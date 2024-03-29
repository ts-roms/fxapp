@php
    $deposit_requests = request_count('deposit_requests', true);
    $withdraw_requests = request_count('withdraw_requests', true);
    $member_requests = request_count('member_requests', true);
    $pending_loans = request_count('pending_loans', true);
@endphp

<li>
    <a href="{{ route('dashboard.index') }}"><i class="ti-dashboard"></i><span>{{ _lang('Dashboard') }}</span></a>
</li>

<li>
    <a href="{{ route('branches.index') }}"><i class="fas fa-building"></i><span>{{ _lang('Branches') }}</span></a>
</li>

<li>
    <a href="javascript: void(0);"><i class="fas fa-user-friends"></i><span>{{ _lang('Members') }}
            {!! xss_clean($member_requests) !!}</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        <li class="nav-item"><a class="nav-link" href="{{ route('members.index') }}">{{ _lang('View Members') }}</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="{{ route('members.create') }}">{{ _lang('Add Member') }}</a></li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('members.pending_requests') }}">
                {{ _lang('Member Requests') }}
                {!! xss_clean($member_requests) !!}
            </a>
        </li>
    </ul>
</li>

<li>
    <a href="javascript: void(0);"><i class="fas fa-hand-holding-usd"></i><span>{{ _lang('Loans') }}
            {!! xss_clean($pending_loans) !!}</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        <li class="nav-item"><a class="nav-link" href="{{ route('loans.index') }}">{{ _lang('All Loans') }}</a></li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('loans.filter', 'pending') }}">
                {{ _lang('Pending Loans') }}
                {!! xss_clean($pending_loans) !!}
            </a>
        </li>
        <li class="nav-item"><a class="nav-link"
                href="{{ route('loans.filter', 'active') }}">{{ _lang('Active Loans') }}</a></li>
        <li class="nav-item"><a class="nav-link"
                href="{{ route('loans.admin_calculator') }}">{{ _lang('Loan Calculator') }}</a></li>
        <li class="nav-item"><a class="nav-link"
                href="{{ route('loan_products.index') }}">{{ _lang('Loan Products') }}</a></li>
    </ul>
</li>

<li><a href="{{ route('loan_payments.index') }}"><i
            class="fas fa-receipt"></i><span>{{ _lang('Repayments') }}</span></a></li>
<li><a href="{{ route('contributions.index') }}"><i
            class="fas fa-file-invoice"></i><span>{{ _lang('Contributions') }}</span></a></li>

<li>
    <a href="javascript: void(0);"><i class="fas fa-landmark"></i><span>{{ _lang('Accounts') }}</span><span
            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        <li class="nav-item"><a class="nav-link"
                href="{{ route('savings_accounts.index') }}">{{ _lang('All Accounts') }}</a></li>
        <li class="nav-item"><a class="nav-link"
                href="{{ route('interest_calculation.calculator') }}">{{ _lang('Interest Calculation') }}</a></li>
        <li class="nav-item"><a class="nav-link"
                href="{{ route('savings_products.index') }}">{{ _lang('Account Types') }}</a></li>
    </ul>
</li>


<li>
    <a href="javascript: void(0);"><i class="fas fa-wallet"></i><span>{{ _lang('Transactions') }}</span><span
            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        <li class="nav-item"><a class="nav-link"
                href="{{ route('transactions.create') }}">{{ _lang('New Transaction') }}</a></li>
        <li class="nav-item"><a class="nav-link"
                href="{{ route('transactions.index') }}">{{ _lang('Transaction History') }}</a></li>
        <li class="nav-item"><a class="nav-link"
                href="{{ route('transaction_categories.index') }}">{{ _lang('Transaction Categories') }}</a></li>
    </ul>
</li>

<li>
    <a href="javascript: void(0);"><i class="fas fa-money-bill-wave"></i><span>{{ _lang('Expense') }}</span><span
            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        <li class="nav-item"><a class="nav-link" href="{{ route('expenses.index') }}">{{ _lang('All Expense') }}</a>
        </li>
        <li class="nav-item"><a class="nav-link"
                href="{{ route('expense_categories.index') }}">{{ _lang('Expense Categories') }}</a></li>
    </ul>
</li>

<li>
    <a href="javascript: void(0);"><i class="fas fa-hand-holding-usd"></i><span>{{ _lang('Other Income') }}</span><span
            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        <li class="nav-item"><a class="nav-link"
                href="{{ route('other_income.index') }}">{{ _lang('All Other Income') }}</a></li>
        <li class="nav-item"><a class="nav-link"
                href="{{ route('other_income_categories.index') }}">{{ _lang('Other Income Categories') }}</a></li>
    </ul>
</li>

<li>
    <a href="javascript: void(0);"><i class="fas fa-hand-holding-usd"></i><span>{{ _lang('Cash in Bank') }}</span><span
            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        <li class="nav-item"><a class="nav-link"
                href="{{ route('big_brother.index') }}">{{ _lang('Cash in Bank Funds') }}</a></li>
    </ul>
</li>

<li>
    <a href="javascript: void(0);"><i
            class="fas fa-hand-holding-usd"></i><span>{{ _lang('Charts Of Account') }}</span><span
            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        <li class="nav-item"><a class="nav-link"
                href="{{ route('charts_of_account.index') }}">{{ _lang('All Charts Of Account') }}</a></li>
    </ul>
</li>


<li>
    <a href="javascript: void(0);"><i class="ti-user"></i><span>{{ _lang('User Management') }}</span><span
            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">{{ _lang('All Users') }}</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="{{ route('roles.index') }}">{{ _lang('User Roles') }}</a>
        </li>
        <li class="nav-item"><a class="nav-link"
                href="{{ route('permission.index') }}">{{ _lang('Access Control') }}</a></li>
    </ul>
</li>

<li>
    <a href="javascript: void(0);"><i class="ti-world"></i><span>{{ _lang('Languages') }}</span><span
            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        <li class="nav-item"><a class="nav-link"
                href="{{ route('languages.index') }}">{{ _lang('All Language') }}</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('languages.create') }}">{{ _lang('Add New') }}</a>
        </li>
    </ul>
</li>

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

<li>
    <a href="javascript: void(0);"><i class="ti-bar-chart"></i><span>{{ _lang('Reports') }}</span><span
            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        <li class="nav-item"><a class="nav-link"
                href="{{ route('reports.account_statement') }}">{{ _lang('Account Statement') }}</a></li>
        <li class="nav-item"><a class="nav-link"
                href="{{ route('reports.members_report') }}">{{ _lang('Members Report') }}</a></li>
        <li class="nav-item"><a class="nav-link"
                href="{{ route('reports.account_balances') }}">{{ _lang('Account Balance') }}</a></li>
        <li class="nav-item"><a class="nav-link"
                href="{{ route('reports.loan_report') }}">{{ _lang('Loan Report') }}</a></li>
        <li class="nav-item"><a class="nav-link"
                href="{{ route('reports.loan_due_report') }}">{{ _lang('Loan Due Report') }}</a></li>
        <li class="nav-item"><a class="nav-link"
                href="{{ route('reports.transactions_report') }}">{{ _lang('Transaction Report') }}</a></li>
        <li class="nav-item"><a class="nav-link"
                href="{{ route('reports.expense_report') }}">{{ _lang('Expense Report') }}</a></li>
        <li class="nav-item"><a class="nav-link"
                href="{{ route('reports.other_income_report') }}">{{ _lang('Other Income Report') }}</a></li>
        <li class="nav-item"><a class="nav-link"
                href="{{ route('reports.revenue_report') }}">{{ _lang('Revenue Report') }}</a></li>
    </ul>
</li>

<li>
    <a href="javascript: void(0);"><i class="ti-settings"></i><span>{{ _lang('System Settings') }}</span><span
            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        <li class="nav-item"><a class="nav-link"
                href="{{ route('settings.update_settings') }}">{{ _lang('General Settings') }}</a></li>
        <li class="nav-item"><a class="nav-link"
                href="{{ route('currency.index') }}">{{ _lang('Supported Currency') }}</a></li>
        <li class="nav-item"><a class="nav-link"
                href="{{ route('database_backups.list') }}">{{ _lang('Database Backup') }}</a></li>
    </ul>
</li>
