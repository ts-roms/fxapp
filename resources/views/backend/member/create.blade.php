@extends('layouts.app')

@section('content')
    <form method="post" class="validate" autocomplete="off" action="{{ route('members.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">{{ _lang('Add New Member') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('First Name') }}</label>
                                    <input type="text" class="form-control" name="first_name"
                                        value="{{ old('first_name') }}" required placeholder="{{ _lang('First Name') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Last Name') }}</label>
                                    <input type="text" class="form-control" name="last_name"
                                        value="{{ old('last_name') }}" placeholder="{{ _lang('Last Name') }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Member No') }}</label>
                                    <input type="text" class="form-control" name="member_no"
                                        value="{{ generate_reference('EID', 6) }}" required readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Business Name') }}</label>
                                    <input type="text" class="form-control" name="business_name"
                                        value="{{ old('business_name') }}" readonly disabled>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Branch') }}</label>
                                    <select class="form-control select2" name="branch_id">
                                        <option value="">{{ get_option('default_branch_name', 'Main Branch') }}
                                        </option>
                                        {{ create_option('branches', 'id', 'name', auth()->user()->branch_id) }}
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Email') }}</label>
                                    <input type="text" class="form-control" name="email"
                                        placeholder="{{ _lang('Email') }}" value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Country Code') }}</label>
                                    <select class="form-control select2" name="country_code">
                                        <option value="">{{ _lang('Country Code') }}</option>
                                        @foreach (get_country_codes() as $key => $value)
                                            <option value="{{ $value['dial_code'] }}"
                                                {{ old('country_code') == $value['dial_code'] ? 'selected' : '' }}>
                                                {{ $value['country'] . ' (+' . $value['dial_code'] . ')' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Mobile') }}</label>
                                    <input type="text" class="form-control" name="mobile"
                                        placeholder="{{ _lang('Mobile') }}" value="{{ old('mobile') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Gender') }}</label>
                                    <select class="form-control auto-select" data-selected="{{ old('gender') }}"
                                        name="gender">
                                        <option value="">{{ _lang('Select One') }}</option>
                                        <option value="male">{{ _lang('Male') }}</option>
                                        <option value="male">{{ _lang('Female') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('City') }}</label>
                                    <input type="text" class="form-control" name="city"
                                        placeholder="{{ _lang('City') }}" value="{{ old('city') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('State') }}</label>
                                    <input type="text" class="form-control" name="state"
                                        placeholder="{{ _lang('State') }}" value="{{ old('state') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Zip') }}</label>
                                    <input type="text" class="form-control" name="zip"
                                        placeholder="{{ _lang('Zip') }}" value="{{ old('zip') }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Credit Source') }}</label>
                                    <input type="text" class="form-control" name="credit_source"
                                        placeholder="{{ _lang('Credit Source') }}" value="{{ old('credit_source') }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Address') }}</label>
                                    <textarea class="form-control" name="address" placeholder="{{ _lang('Address') }}">{{ old('address') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Photo') }}</label>
                                    <input type="file" class="form-control dropify" name="photo">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i
                                            class="ti-check-box"></i>&nbsp;{{ _lang('Submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($custom_fields->count() > 0)
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="togglebutton">
                                <h4 class="header-title d-flex align-items-center">
                                    {{ _lang('Custom Fields') }}&nbsp;&nbsp;
                                    <input type="checkbox" id="client_login" value="0" name="client_login"
                                        class="d-none">
                                </h4>
                            </div>
                        </div>
                        <div class="card-body" id="custom_field_card">
                            <div class="row">
                                @foreach ($custom_fields as $field)
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">{{ $field->field_label }}</label>
                                            @if ($field->field_type == 'textarea')
                                                <textarea name="{{ $field->field_name }}" class="form-control {{ $field->field_class }}"
                                                    placeholder="{{ $field->field_label }}"></textarea>
                                            @else
                                                <input type="{{ $field->field_type }}" class="{{ $field->field_class }}"
                                                    name="{{ $field->field_name }}" value=""
                                                    placeholder="{{ $field->field_label }}"
                                                    @if ($field->required == 1) required @endif />
                                            @endif

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </form>
@endsection
