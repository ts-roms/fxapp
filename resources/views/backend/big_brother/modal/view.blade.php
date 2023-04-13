<div class="row">
    <div class="col-lg-12">

        <div class="form-group">
            <label class="control-label">{{ _lang('Account Details') }}</label>
            <input type="text" class="form-control" name="account_id" value="{{ $bigBrother->account_id }}" readonly>
        </div>
        <div class="form-group">
            <label class="control-label">{{ _lang('Period From') }}</label>
            <input type="text" class="form-control" name="period_from"
                value="{{ $bigBrother->period_from }}" readonly>
        </div>

        <div class="form-group">
            <label class="control-label">{{ _lang('Period To') }}</label>
            <input type="text" class="form-control" name="period_to"
                value="{{ $bigBrother->period_to }}" readonly>
        </div>

        <div class="form-group">
            <label class="control-label">{{ _lang('Amount') }}</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="amount-addon">{{ currency(get_base_currency()) }}</span>
                </div>
                <input type="text" class="form-control float-field" name="capital" value="{{ $bigBrother->capital }}"
                    aria-describedby="amount-addon" readonly>
            </div>
        </div>
    </div>
</div>
