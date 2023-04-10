<form class="ajax-screen-submit" autocomplete="false"
    action="{{ action('ContributionController@update', $id) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input name="_method" type="hidden" value="PATCH">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="" class="control-label">{{ _lang('Member') }}</label>
                <div class="input-group">
                    <input type="text" class="form-control"
                        value="{{ $contribution->member->first_name . ' ' . $contribution->member->last_name }}"
                        id="member_name" name="member_name" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label">{{ _lang('REF No.') }}</label>
                <div class="input-group">
                    <input type="text" class="form-control" value="{{ $contribution->reference_no }}"
                        id="reference_no" name="reference_no" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label">{{ _lang('Capital BuildUp') }}</label>
                <div class="input-group">
                    <input type="text" class="form-control" value="{{ $contribution->capital_buildup }}"
                        id="capital_buildup" name="capital_buildup" required>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label">{{ _lang('Emergency Funds') }}</label>
                <div class="input-group">
                    <input type="text" class="form-control" value="{{ $contribution->emergency_funds }}"
                        id="emergency_funds" name="emergency_funds" required>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label">{{ _lang('Mortuary Funds') }}</label>
                <div class="input-group">
                    <input type="text" class="form-control" value="{{ $contribution->mortuary_funds }}"
                        id="mortuary_funds" name="mortuary_funds" required>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label">{{ _lang('Notes') }}</label>
                <div class="input-group">
                    <input type="text" class="form-control" value="{{ $contribution->notes }}" id="notes"
                        name="notes">
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary float-right"><i
                        class="ti-check-box"></i>&nbsp;{{ _lang('Update') }}</button>
            </div>
        </div>
    </div>

</form>
