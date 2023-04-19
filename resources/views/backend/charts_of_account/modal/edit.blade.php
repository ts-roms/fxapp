<form method="post" autocomplete="off" action="{{ action('ChartsOfAccountController@update', $charts_of_account) }}"
    class="ajax-screen-submit" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input name="_method" type="hidden" value="PATCH">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="" class="control-label">{{ _lang('Account Name') }}</label>
                <input type="text" class="form-control" name="name" placeholder="{{ _lang('Account Name') }}"
                    value="{{ $charts_of_account->name }}" required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">{{ _lang('GL Code') }}</label>
                <input type="text" class="form-control" name="code" placeholder="{{ _lang('GL Code') }}"
                    value="{{ $charts_of_account->code }}" required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">{{ _lang('Account Type') }}</label>
                <select class="form-control auto-select select2" data-selected="{{ $charts_of_account->account_type }}"
                    name="account_type" required>
                    <option value="" disabled>{{ _lang('Select One') }}</option>
                    {{ charts_of_account_options(old('account_type')) }}
                </select>
            </div>
            <div class="form-group">
                <label for="" class="control-label">{{ _lang('Note') }}</label>
                <textarea class="form-control" name="notes" placeholder="{{ _lang('Note') }}">{{ $charts_of_account->notes }}</textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary float-right"><i
                        class="ti-check-box"></i>&nbsp;{{ _lang('Submit') }}</button>
            </div>
        </div>
    </div>
</form>
