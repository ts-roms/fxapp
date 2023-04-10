<table class="table table-bordered">
	<tr><td>{{ _lang('Expense Date') }}</td><td>{{ $other_income->other_income_date }}</td></tr>
	<tr><td>{{ _lang('Expense Category') }}</td><td>{{ $other_income->other_income_category->name }}</td></tr>
	<tr><td>{{ _lang('Amount') }}</td><td>{{ decimalPlace($other_income->amount, currency()) }}</td></tr>
	<tr><td>{{ _lang('Reference') }}</td><td>{{ $other_income->reference }}</td></tr>
	<tr><td>{{ _lang('Branch') }}</td><td>{{ $other_income->branch->name }}</td></tr>
	<tr><td>{{ _lang('Note') }}</td><td>{{ $other_income->note }}</td></tr>
	<tr>
		<td>{{ _lang('Attachment') }}</td>
		<td>
		@if($other_income->attachment != '')
		 	<a href="{{ asset('uploads/media/'.$other_income->attachment) }}" target="_blank">{{ $other_income->attachment }}</a>
		@endif
		</td>
	</tr>
	<tr><td>{{ _lang('Created By') }}</td><td>{{ $other_income->created_by->name }} ({{ $other_income->created_at }})</td></tr>
	<tr><td>{{ _lang('Updated By') }}</td><td>{{ $other_income->updated_by->name }} ({{ $other_income->updated_at }})</td></tr>
</table>

