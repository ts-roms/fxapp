@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-lg-12">
      <div class="card no-export">
        <div class="card-header">
          <span class="panel-title">{{ _lang('All Custom Fields') }}</span>
          <a class="btn btn-primary btn-xs float-right ajax-modal" data-title="{{ _lang('Add New Custom Fields') }}" href="{{ route('custom_fields.create') }}"><i class="ti-plus"></i>&nbsp;{{ _lang('Add New') }}</a>
        </div>
        <div class="card-body">
          <table></table>
        </div>
      </div>
    </div>
  </div>
@endsection