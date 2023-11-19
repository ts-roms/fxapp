@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-center panel-title">
                    {{ _lang('Bulk Loan Payments') }}
                </div>

                <div class="card-body table-responsive">
                    <form method="post" class="validate" autocomplete="false" action="{{ route('loan_payments.bulk_payment') }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <table id="bulk_loan_repayment" class="table table-hover table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>{{ _lang('Member') }}</th>
                                    <th>{{ _lang('Payment Date') }}</th>
                                    <th>{{ _lang('PETTY_CASH_LOAN') }}</th>
                                    <th>{{ _lang('NEW_FUND_CARAGA_LOAN') }}</th>
                                    <th>{{ _lang('EMERGENCY_LOAN') }}</th>
                                    <th>{{ _lang('Late Penalties') }}</th>
                                    <th>{{ _lang('Note') }}</th>
                                </tr>
                            </thead>
                            @foreach($loans as $loan)
                                 <tr>
                                    <td class="hidden">
                                        <input type="hidden" class="form-control float-field" name="borrower_id[]"
                                            id="borrower_id" value="{{ $loan->borrower->id }}" readonly>
                                    </td>
                                    <td>
                                        <input type="hidden" class="form-control float-field" name="loan_id[]"
                                            id="loan_id" value="{{ $loan->id }}" readonly>

                                        {{ $loan->borrower->first_name . ' ' . $loan->borrower->last_name . ' (' . $loan->loan_id . ')' }}
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control datepicker" name="paid_at[]" id="paid_at" value="{{ old('paid_at') }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm float-field"
                                            placeholder="0.00" name="pc[]" id="petty_cash"
                                            value="{{ old('petty_cash') }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm float-field"
                                            placeholder="0.00" name="nfc[]" id="new_fund_caraga"
                                            value="{{ old('new_fund_caraga') }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm float-field"
                                            placeholder="0.00" name="el[]" id="emergency_loan"
                                            value="{{ old('emergency_loan') }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm float-field"
                                            placeholder="0.00" name="late_penalties[]" id="late_penalties"
                                            value="{{ old('late_penalties') }}">
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

            $('#bulk_loan_repayment').DataTable();

        })(jQuery);
    </script>
@endsection
