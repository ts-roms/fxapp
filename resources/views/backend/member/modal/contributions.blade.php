<form class="ajax-screen-submit" autocomplete="off" method="POST" action="{{ route('members.post_contribution') }}">
    {{ csrf_field() }}
    <input type="hidden" name="member_id" value="{{ $id }}">
    <div class="row px-2">

        <div class="col-md-12">
            <div class="form-group">
                <label for="" class="control-label">{{ _lang('Member\'s Name') }}</label>
                <input type="text" name="name" class="form-control form-control-sm"
                    value={{ $member->first_name . ' ' . $member->last_name }} readonly />
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="" class="control-label">{{ _lang('Payment Date') }}</label>
                <input type="text" name="payment_date" class="form-control form-control-sm datetimepicker" value="">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="" class="control-label">{{ _lang('Capital Buildup') }}</label>
                <input type="text" name="capital_buildup" class="form-control form-control-sm float-field" placeholder="0.00" value="">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="" class="control-label">{{ _lang('Emergency Funds') }}</label>
                <input type="text" name="emergency_funds" class="form-control form-control-sm float-field" placeholder="0.00" value="">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="" class="control-label">{{ _lang('Mortuary Funds') }}</label>
                <input type="text" name="mortuary_funds" class="form-control form-control-sm float-field" placeholder="0.00" value="">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="" class="control-label">{{ _lang('Notes') }}</label>
                <input type="text" name="notes" class="form-control form-control-sm " placeholder="Notes" value="">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary float-right"><i
                        class="ti-check-box"></i>&nbsp;{{ _lang('Submit') }}</button>
            </div>
        </div>

    </div>
</form>
