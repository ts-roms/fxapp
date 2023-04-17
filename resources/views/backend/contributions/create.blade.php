@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-center panel-title">
                    {{ _lang('Add Contributions') }}
                </div>

                <div class="card-body table-responsive">
                    <form method="post" class="validate" autocomplete="false" action="{{ route('contributions.store') }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>{{ _lang('Member') }}</th>
                                    <th>{{ _lang('Capital BuildUp') }}</th>
                                    <th>{{ _lang('Emergency Funds') }}</th>
                                    <th>{{ _lang('Mortuary Funds') }}</th>
                                    <th>{{ _lang('Note') }}</th>
                                </tr>
                            </thead>
                            @foreach ($members as $member)
                                <tr>
                                    <td>
                                        <input type="hidden" class="form-control float-field" name="member_id[]"
                                            id="member_id" value="{{ $member->id }}" readonly>

                                        {{ $member->first_name . ' ' . $member->last_name }}
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm float-field"
                                            placeholder="0.00" name="capital_buildup[]" id="capital_buildup"
                                            value="{{ old('capital_buildup') }}" required>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm float-field"
                                            placeholder="0.00" name="emergency_funds[]" id="emergency_funds"
                                            value="{{ old('emergency_funds') }}" required>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm float-field"
                                            placeholder="0.00" name="mortuary_funds[]" id="mortuary_funds"
                                            value="{{ old('mortuary_funds') }}" required>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm text-field"
                                            placeholder="Notes" name="notes[]" id="notes" value="{{ old('notes') }}">
                                    </td>
                                </tr>
                            @endforeach
                        </table>
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
