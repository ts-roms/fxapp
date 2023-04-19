    {{ csrf_field() }}

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="" class="control-label">{{ _lang('Account Name') }}</label>
                <input type="text" class="form-control" name="name" placeholder="{{ _lang('Account Name') }}"
                    value="{{ $charts_of_account->name }}" disabled>
            </div>
            <div class="form-group">
                <label for="" class="control-label">{{ _lang('GL Code') }}</label>
                <input type="text" class="form-control" name="code" placeholder="{{ _lang('GL Code') }}"
                    value="{{ $charts_of_account->code }}" disabled>
            </div>
            <div class="form-group">
                <label for="" class="control-label">{{ _lang('Account Type') }}</label>
                <select class="form-control auto-select select2" data-selected="{{ $charts_of_account->account_type }}"
                    name="account_type" disabled>
                    <option value="" disabled>{{ _lang('Select One') }}</option>
                    {{ charts_of_account_options(old('account_type')) }}
                </select>
            </div>
            <div class="form-group">
                <label for="" class="control-label">{{ _lang('Note') }}</label>
                <textarea class="form-control" name="notes" placeholder="{{ _lang('Note') }}" disabled>{{ $charts_of_account->notes }}</textarea>
            </div>
        </div>
    </div>
