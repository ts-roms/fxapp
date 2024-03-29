@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4 class="header-title text-center">{{ _lang('Automatic Deposit Methods') }}</h4>
			</div>
			<div class="card-body">
                <div class="row justify-content-md-center">
                    @foreach($deposit_methods as $deposit_method)
                    @php $currency = $deposit_method->is_crypto == 0 ? currency($deposit_method->currency) : currency(); @endphp
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <img src="{{ asset('backend/images/gateways/'.$deposit_method->image) }}" class="gateway-img"/>
                                <h5 class="mt-3"><b>{{ $deposit_method->name }}</b></h5>
                                <h6 class="pt-1">{{ _lang('Deposit Limit') }} ({{ decimalPlace($deposit_method->minimum_amount, $currency) }} - {{ decimalPlace($deposit_method->maximum_amount, $currency) }})</h6>
                                <h6 class="pt-1">{{ _lang('Deposit Charge') }} ({{ decimalPlace($deposit_method->fixed_charge, $currency) }} + {{ $deposit_method->charge_in_percentage }}%)</h6>
                                <button data-href="{{ route('deposit.automatic_deposit',$deposit_method->id) }}" data-title="{{ _lang('Deposit Via').' '.$deposit_method->name }}" class="btn btn-outline-primary mt-3 stretched-link ajax-modal">{{ _lang('Deposit Now') }}</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
			</div>
		</div>
    </div>
</div>
@endsection