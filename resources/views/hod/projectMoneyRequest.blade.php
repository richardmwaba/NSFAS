@extends('layouts.authorized')

@section('title', 'Project money | Request')
@section('heading',' Money request for '.$projects->projectName .' project')

@section('content')

    <div class="panel panel-default">
        <div class="row">
            <div class="row">
                <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-11" >
                    <form class="form-horizontal" role="form" style="margin-left: 20px;margin-top: 20px" method="POST"
                          action="{{ url('/projectMoneyRequest/' .$projects->id) }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                            <label for="date" class="col-md-3">Today's Date </label>
                            <div class="col-md-8">
                                <input id="date" readonly type="text" class="form-control" name="date" value="{{ date('d-m-Y')  }}">
                                @if ($errors->has('date'))
                                    <span class="help-block"><strong>{{ $errors->first('date') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('beneficiary') ? ' has-error' : '' }}">
                            <label for="beneficiary" class="col-md-3">Beneficiary</label>
                            <div class="col-md-8">
                                <input id="beneficiary" readonly type="text" class="form-control" name="beneficiary"
                                       value="{{ $projects->projectCoordinator }}">
                                @if ($errors->has('beneficiary'))
                                    <span class="help-block"><strong>{{ $errors->first('beneficiary') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('budgetLine') ? ' has-error' : '' }}">
                            <label for="budgetLine" class="col-md-3">Budget Line</label>
                            <div class="col-md-8">
                                <input id="budgetLine" readonly type="text" class="form-control" name="budgetLine"
                                       value="{{ $projects->budget->budgetName }}">
                                @if ($errors->has('budgetLine'))
                                    <span class="help-block"><strong>{{ $errors->first('budgetLine') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('purpose') ? ' has-error' : '' }}">
                            <label for="purpose" class="col-md-3">Purpose</label>
                            <div class="col-md-8">
                                <textarea id="purpose"
                                          placeholder="Description of the purpose : Amount it shall cost "
                                          rows="4" class="form-control" name="purpose"></textarea>
                                @if ($errors->has('purpose'))
                                    <span class="help-block"><strong>{{ $errors->first('purpose') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('requestedAmount') ? ' has-error' : '' }}">
                            <label for="requestedAmount" class="col-md-3">Amount (Kwacha)</label>
                            <div class="col-md-8">
                                <input id="requestedAmount" placeholder="Total amount " type="text" class="form-control"
                                       name="requestedAmount" value="{{old('requestedAmount')}}">
                                @if ($errors->has('requestedAmount'))
                                    <span class="help-block"><strong>{{ $errors->first('requestedAmount') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-4 col-sm-3 col-md-offset-7 col-md-2">
                                <button type="submit" class="btn btn-default">Submit</button>
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