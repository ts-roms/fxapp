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
                <input type="text" class="form-control" value="{{ $contribution->reference_no }}" id="reference_no"
                    name="reference_no" readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="control-label">{{ _lang('Capital BuildUp') }}</label>
            <div class="input-group">
                <input type="text" class="form-control" value="{{ $contribution->capital_buildup }}"
                    id="capital_buildup" name="capital_buildup" readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="control-label">{{ _lang('Emergency Funds') }}</label>
            <div class="input-group">
                <input type="text" class="form-control" value="{{ $contribution->emergency_funds }}"
                    id="emergency_funds" name="emergency_funds" readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="control-label">{{ _lang('Mortuary Funds') }}</label>
            <div class="input-group">
                <input type="text" class="form-control" value="{{ $contribution->mortuary_funds }}"
                    id="mortuary_funds" name="mortuary_funds" readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="control-label">{{ _lang('Notes') }}</label>
            <div class="input-group">
                <input type="text" class="form-control" value="{{ $contribution->notes }}" id="notes"
                    name="notes" readonly>
            </div>
        </div>
    </div>
</div>
