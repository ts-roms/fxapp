<form method="post" class="ajax-screen-submit" autocomplete="off" action="{{ route('loan_payments.store') }}"
    enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-lg-12">

            <div class="form-group">
                <label class="control-label">{{ _lang('Payment Date') }}</label>
                <input type="hidden" value="{{ $repayment->id }}" id="due_amount_of" name="due_amount_of" />
                <input type="text" class="form-control datetimepicker" name="paid_at" id="paid_at"
                    value="{{ old('paid_at') }}" required>
            </div>
            <div class="form-group">
                <label class="control-label">{{ _lang('Loan ID') }}</label>
                <input type="hidden" id="loan_id" name="loan_id" value="{{ $repayment->loan_id }}" />
                <input type="text" class="form-control" name="reference_no" id="reference_no"
                    value="{{ $loan->loan_id }}" readonly>
            </div>
            <div class="form-group">
                <label class="control-label">{{ _lang('Due Amount Date') }}</label>
                <input type="text" class="form-control" name="repayment_date" id="repayment_date"
                    value="{{ $repayment->repayment_date }}" readonly>
            </div>
            <div class="form-group">
                <label class="control-label">{{ _lang('Repayment Amount') }}</label>
                <input type="text" class="form-control" name="repayment_amount" id="repayment_amount"
                    value="{{ $repayment->amount_to_pay }}" readonly>
            </div>
            <div class="form-group">
                <label class="control-label">{{ _lang('Total Amount') }}</label>
                <input type="text" class="form-control" name="total_amount" id="total_amount"
                    value="{{ $repayment->amount_to_pay }}">
            </div>
            <div class="form-group">
                <label class="control-label">{{ _lang('Remarks') }}</label>
                <textarea class="form-control" name="remarks">{{ old('remarks') }}</textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i
                        class="ti-check-box"></i>&nbsp;{{ _lang('Submit') }}</button>
            </div>

        </div>
    </div>
</form>
