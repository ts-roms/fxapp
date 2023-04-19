<form method="post" autocomplete="off" action="{{ route('charts_of_account.store') }}" class="ajax-screen-submit"
    enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="" class="control-label">{{ _lang('Account Name') }}</label>
                <input type="text" class="form-control" name="name" placeholder="{{ _lang('Account Name') }}" required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">{{ _lang('GL Code') }}</label>
                <input type="text" class="form-control" name="code" placeholder="{{ _lang('GL Code') }}" required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">{{ _lang('Account Type') }}</label>
                <select class="form-control auto-select select2" data-selected="{{ old('account_type_id') }}"
                    name="account_type" required>
                    <option value="" disabled>{{ _lang('Select One') }}</option>
                    {{ charts_of_account_options() }}
                </select>
            </div>
            <div class="form-group">
                <label for="" class="control-label">{{ _lang('Note') }}</label>
                <textarea class="form-control" name="notes" placeholder="{{ _lang('Note') }}"></textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary float-right"><i
                        class="ti-check-box"></i>&nbsp;{{ _lang('Submit') }}</button>
            </div>
        </div>
    </div>
</form>
