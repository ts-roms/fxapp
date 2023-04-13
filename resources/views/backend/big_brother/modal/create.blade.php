<form action="{{ route('big_brother.store') }}" class="ajax-screen-submit" method="post" autocomplete="off"
    enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-lg-12">

            <div class="form-group">
                <label class="control-label">{{ _lang('Account Details') }}</label>
                <select class="form-control auto-select select2" data-selected="{{ old('expense_category_id') }}"
                    name="account_id" required>
                    <option value="">{{ _lang('Select One') }}</option>
                    {{ create_option('expense_categories', 'id', 'name', old('expense_category_id')) }}
                </select>
            </div>

            <div class="form-group">
                <label class="control-label">{{ _lang('Period From') }}</label>
                <input type="text" class="form-control datetimepicker" name="period_from"
                    value="{{ old('period_from', now()) }}" required>
            </div>

            <div class="form-group">
                <label class="control-label">{{ _lang('Period To') }}</label>
                <input type="text" class="form-control datetimepicker" name="period_to"
                    value="{{ old('period_to', now()) }}" required>
            </div>

            <div class="form-group">
                <label class="control-label">{{ _lang('Amount') }}</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="amount-addon">{{ currency(get_base_currency()) }}</span>
                    </div>
                    <input type="text" class="form-control float-field" name="capital" value="{{ old('capital') }}"
                        aria-describedby="amount-addon" required>
                </div>
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i
                        class="ti-check-box"></i>&nbsp;{{ _lang('Submit') }}</button>
            </div>
        </div>
    </div>
</form>
