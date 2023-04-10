<form method="post" class="ajax-screen-submit" autocomplete="off"
    action="{{ action('OtherIncomeController@update', $id) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input name="_method" type="hidden" value="PATCH">
    <div class="row">
        <div class="col-md-12">

            <div class="form-group">
                <label class="control-label">{{ _lang('Reference') }}</label>
                <input type="text" class="form-control" name="reference" value="{{ $other_income->reference }}"
                    readonly>
            </div>

            <div class="form-group">
                <label class="control-label">{{ _lang('Date') }}</label>
                <input type="text" class="form-control datetimepicker" name="other_income_date"
                    value="{{ $other_income->getRawOriginal('other_income_date') }}" required>
            </div>

            <div class="form-group">
                <label class="control-label">{{ _lang('Other Income Category') }}</label>
                <select class="form-control auto-select select2"
                    data-selected="{{ $other_income->other_income_category_id }}" name="other_income_category_id"
                    required>
                    <option value="">{{ _lang('Select One') }}</option>
                    {{ create_option('other_income_categories', 'id', 'name', $other_income->other_income_category_id) }}
                </select>
            </div>

            <div class="form-group">
                <label class="control-label">{{ _lang('Amount') }}</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="amount-addon">{{ currency(get_base_currency()) }}</span>
                    </div>
                    <input type="text" class="form-control float-field" name="amount"
                        value="{{ $other_income->amount }}" aria-describedby="amount-addon" required>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label">{{ _lang('Note') }}</label>
                <textarea class="form-control" name="notes">{{ $other_income->notes }}</textarea>
            </div>

            <div class="form-group">
                <label class="control-label">{{ _lang('Attachment') }}</label><br />
                <input type="file" name="attachment"
                    data-default-file="{{ $other_income->attachment != null ? asset('uploads/media/' . $other_income->attachment) : '' }}">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary float-right"><i
                        class="ti-check-box"></i>&nbsp;{{ _lang('Update') }}</button>
            </div>
        </div>
</form>
