@extends('layouts.authorized')

@section('title', 'Account | Income')
@section('heading','Add an Income for '.$account->accountName .' account')

@section('content')
    <div class="panel panel-default">
        <div class="row">
            <div class="row">
                <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-11" >
                    <form class="form-horizontal" role="form" style="margin-left: 20px;margin-top: 20px" method="POST"
                          action="{{ url('/accountIncomes/' .$account->id) }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('amountReceived') ? ' has-error' : '' }}">
                            <label for="amountReceived" class="col-md-3">Amount Received</label>
                            <div class="col-md-8">
                                <input id="amountReceived" type="text" class="form-control" name="amountReceived"
                                       value="{{old('amountReceived')}}">
                                @if ($errors->has('amountReceived'))
                                    <span class="help-block"><strong>{{ $errors->first('amountReceived') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('receivedFrom') ? ' has-error' : '' }}">
                            <label for="receivedFrom" class="col-md-3">Received From</label>
                            <div class="col-md-8">
                                <input id="receivedFrom" type="text" class="form-control" name="receivedFrom"
                                       value="{{old('receivedFrom')}}">
                                @if ($errors->has('receivedFrom'))
                                    <span class="help-block"><strong>{{ $errors->first('receivedFrom') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('receiptNumber') ? ' has-error' : '' }}">
                            <label for="receiptNumber" class="col-md-3">Receipt Number</label>
                            <div class="col-md-8">
                                <input id="receiptNumber" type="text" class="form-control" name="receiptNumber"
                                       value="{{old('receiptNumber')}}">
                                @if ($errors->has('receiptNumber'))
                                    <span class="help-block"><strong>{{ $errors->first('receiptNumber') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('dateReceived') ? ' has-error' : '' }}">
                            <label for="dateReceived" class="col-md-3">Date Received</label>
                            <div class="col-md-8">
                                <input id="dateReceived" type="date" class="form-control" name="dateReceived"
                                       value="{{ old('dateReceived') }}">
                                @if ($errors->has('dateReceived'))
                                    <span class="help-block"><strong>{{ $errors->first('dateReceived') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-4 col-sm-3 col-md-offset-7 col-md-2">
                                <button type="submit" class="btn btn-default">Add</button>
                            </div>
                            <div class="col-xs-4 col-sm-3 col-md-2">
                                <button type="reset" class="btn btn-default pull-right">Cancel</button>
                            </div>
                        </div>
                    </form>
                    <!-- /.form -->
                </div>
            </div>
        </div>
    </div>
@endsection