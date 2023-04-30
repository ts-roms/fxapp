@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="cart">
                <div class="card-header">
                    <div class="panel-title">{{ _lang('Members Report') }}</div>
                </div>

                <div class="card-body">
                    <div class="report-params">
                        <form action="{{ route('reports.members_report') }}" class="validate" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Status') }}</label>
                                        <select class="form-control auto-select"
                                            data-selected="{{ isset($status) ? $status : old('status') }}" name="status">
                                            <option value="">{{ _lang('All') }}</option>
                                            {{ member_status() }}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Branch') }}</label>
                                        <select class="form-control auto-select"
                                            data-selected="{{ isset($branch) ? $branch : old('branch') }}" name="branch">
                                            <option value="">{{ _lang('All') }}</option>
                                            {{ create_option('branches', 'id', 'name', old('branch')) }}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">

                                    <button type="submit" class="btn btn-light btn-xs btn-block mt-26"><i
                                            class="ti-filter"></i>&nbsp;{{ _lang('Filter') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="report-header">
                        <h4>{{ _lang('Members Report') }}</h4>
                    </div>

                    <table class="table table-bordered report-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Branch</th>
                                <th>Contacts</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($report_data))
                                @foreach ($report_data as $member)
                                    <tr>
                                        <td>{{ $member->member_no }}</td>
                                        <td>{{ $member->first_name . ' ' . $member->last_name }}</td>
                                        <td>{{ $member->address . ', ' . $member->city . ', ' . $member->state . ', ' . $member->zip}}</td>
                                        <td>{{ $member->branch->name }}</td>
                                        <td>{{ $member->mobile . '/' . $member->email }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
