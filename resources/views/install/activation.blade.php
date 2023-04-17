@extends('install.layout')

@section('content')
    <div class="card">
        <div class="card-header bg-dark text-white text-center">Activation</div>
        <div class="card-body">
            @if (\Session::has('error'))
                <div class="alert alert-danger">
                    <span>{{ \Session::get('error') }}</span>
                </div>
            @endif
            <form action="{{ url('install/activate') }}" method="POST" autocomplete="false">
                {{ csrf_field() }}
                <div class="text-center">
                    <div class="form-group text-center">
                        <h4>Please enter your activation code</h4>
                        <input type="text" class="form-control text-center" name="code" id="code"
                            placeholder="Activation Code" value="{{ $activation_code }}" />
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" id="next-button" class="btn btn-install">Activate</button>
                </div>
            </form>
        </div>
    </div>
@endsection
