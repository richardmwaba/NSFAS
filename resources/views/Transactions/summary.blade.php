@extends('layouts.authorized')
@section('main_content')
    <div class="row">

        <div class="panel-default">
            <div class="panel-heading">Summary of transaction</div>
            <div class="panel-body">

                <form class="form-horizontal" role="form"
                      style="margin-left:10px;max-height:8px;margin-left: 20px;margin-top: 20px;" method="POST"
                      action="{{url('cashout/confirm')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Account</label>
                        <div class="col-sm-6 col-md-6 col-xs-5">
                            <label class="text-primary" for="first_name_value">{{$accountName}}</label>
                            <input type="hidden" value="{{$request->account}}" name="account">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Total balance in account</label>
                        <div class="col-sm-6 col-md-6 col-xs-5">
                            <label class="text-primary" for="first_name_value">{{"K ".number_format($balance, "2", ".", ",")}}</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Amount to be withdrawn</label>
                        <div class="col-sm-6 col-md-6 col-xs-5">
                            <label class="text-primary" for="first_name_value">{{"K ".number_format($request->amount, "2", ".", ",")}}</label>
                            <input type="hidden" value="{{$request->amount}}" name="amount">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Balance after withdrawing</label>
                        <div class="col-sm-6 col-md-6 col-xs-5">
                            <label class="text-primary" for="first_name_value">{{"K ".number_format($balance-$request->amount, "2", ".", ",")}}</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Purpose</label>
                        <div class="col-sm-6 col-md-6 col-xs-5">
                            <label class="text-primary" for="first_name_value">{{$imprest->item->description}}</label>
                            <input type="hidden" value="{{$imprest->purpose}}" name="purpose">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Budget line</label>
                        <div class="col-sm-6 col-md-6 col-xs-5">
                            <label class="text-primary" for="first_name_value">{{$imprest->budget->budgetName}}</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Beneficiary</label>
                        <div class="col-sm-6 col-md-6 col-xs-5">
                            <label class="text-primary"
                                   for="first_name_value">{{$imprest->owner->firstName}} {{$imprest->owner->otherName}} {{$imprest->owner->lastName}}</label>
                            <input type="hidden" value="{{$imprest->applicantId}}" name="beneficiary">
                            <input type="hidden" value="{{$imprest->imprestId}}" name="imprestId">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Department</label>
                        <div class="col-sm-6 col-md-6 col-xs-5">
                            <label class="text-primary"
                                   for="first_name_value">{{$imprest->owner->department->departmentName}}</label>
                        </div>
                    </div>

                    <div class="form-group">

                            <button type="submit" class="col-sm-3 col-md-3 col-xs-4 btn btn-success">Confirm</button>

                        <div class="col-sm-6 col-md-6 col-xs-5">
                            <a type="button" href="{{url('imprests/edit/'.$request->id)}}"
                               class="btn btn-info">Change</a>
                        </div>

                    </div>


                </form>
                <form role="form" method="POST" action="{{url('/imprestSummaryPDF/'.$imprest->imprestId)}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="initialBalance" value="{{$balance}}">
                    <input type="hidden" name="accountName" value="{{$accountName}}">
                    <input type="hidden" name="amount" value="{{$request->amount}}">
                    <input type="hidden" name="currentBalance" value="{{$balance-$request->amount}}">
                    <input type="hidden" name="description" value="{{$imprest->item->description}}">
                    <input type="hidden" name="budgetName" value="{{$imprest->budget->budgetName}}">
                    <input type="hidden" name="applicantNames"
                           value="{{$imprest->owner->firstName}} {{$imprest->owner->otherName}} {{$imprest->owner->lastName}}">
                    <input type="hidden" name="department" value="{{$imprest->owner->department->departmentName}}">
                <button type="submit" class="btn btn-primary">Print</button>
                </form>

            </div>

        </div>

    </div>

@endsection