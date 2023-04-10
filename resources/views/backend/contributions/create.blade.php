@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-center panel-title">
                    {{ _lang('Add Contributions') }}
                </div>

                <div class="card-body">
                    <form method="post" class="validate" autocomplete="false" action="{{ route('contributions.store') }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @foreach ($members as $member)
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Member') }}</label>
                                        <div class="input-group">
                                            <input type="hidden" class="form-control float-field" name="member_id[]"
                                                id="member_id" value="{{ $member->id }}" readonly>
                                            <input type="text" class="form-control float-field" name="member_name"
                                                id="member_name"
                                                value="{{ $member->first_name . ' ' . $member->last_name }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Capital BuildUp') }}</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control float-field" placeholder="0.00"
                                                name="capital_buildup[]" id="capital_buildup"
                                                value="{{ old('capital_buildup') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Emergency Funds') }}</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control float-field" placeholder="0.00"
                                                name="emergency_funds[]" id="emergency_funds"
                                                value="{{ old('emergency_funds') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Mortuary Funds') }}</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control float-field" placeholder="0.00"
                                                name="mortuary_funds[]" id="mortuary_funds"
                                                value="{{ old('mortuary_funds') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Notes') }}</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control text-field" placeholder="Notes"
                                                name="notes[]" id="notes" value="{{ old('notes') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary float-right"><i
                                            class="ti-check-box"></i>&nbsp;{{ _lang('Save') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js-script')
    <script>
        $(function() {

            "use strict";


        });
    </script>
@endsection
