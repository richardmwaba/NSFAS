@extends('layouts.authorized')

@section('title', 'Account details')
@section('heading','Financial summary record for The Department Of '.$departments->departmentName. '')

@section('content')
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><b>Account Information</b></div>
            <div class="panel-body">
                <div class="btn-group pull-right">
                    <a href="#" class="btn btn-md btn-link"><i class="fa fa-print fa-fw text-success">
                        </i><span class="text-success">Print</span></a>
                </div>
                <div class="col-lg-12 col-md-12 col-md-12 col-xs-12" >
                    <form class="form-horizontal" role="form" style="margin-top: 0px" method="POST"
                          action="#">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="NRC"> Today's Date:</label>
                            <div class="col-sm-6 col-md-6 col-xs-5 text-primary">
                                {{ date('jS F, Y') }}
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="last-name">Department Account Name:</label>
                            <div class="col-sm-6 col-md-6 col-xs-5 text-primary">
                                @if(isset($account))
                                    {{ $account->accountName }}
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="first-name"> Budget Line:</label>
                            <div class="col-sm-6 col-md-6 col-xs-5 text-primary">
                                @if(isset($budget))
                                    {{ $budget->budgetName }}
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="last-name">School Main Account:</label>
                            <div class="col-sm-6 col-md-6 col-xs-5 text-primary">
                                @if(isset($budget))
                                    K{{ $budget->schoolIncome }}.00
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="last-name">Department Income (Received from School main account):</label>
                            <div class="col-sm-6 col-md-6 col-xs-5 text-primary">
                                @if(isset($budget))
                                    K{{ $budget->departmentIncome }}.00
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="last-name">Department Total Income:</label>
                            <div class="col-sm-6 col-md-6 col-xs-5 text-primary">
                                @if(isset($account))
                                    @if(isset($account->calculatedTotal->incomeAcquired))
                                        K{{ $account->calculatedTotal->incomeAcquired }}.00
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="last-name">Department Total Expenditure:</label>
                            <div class="col-sm-6 col-md-6 col-xs-5 text-primary">
                                @if(isset($account))
                                    @if(isset($account->calculatedTotal->expenditureAcquired))
                                        K{{ $account->calculatedTotal->expenditureAcquired }}.00
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="last-name">Department Balance (As of today):</label>
                            <div class="col-sm-6 col-md-6 col-xs-5 text-primary">
                                @if(isset($account))
                                    @if(isset($account->calculatedTotal->expenditureAcquired))
                                        K{{ $account->calculatedTotal->incomeAcquired - $account->calculatedTotal->expenditureAcquired }}.00
                                    @endif
                                @endif
                            </div>
                        </div>

                    </form>
                    <!-- /.form -->
                </div>
                <!-- col-lg-md-sm-xs -->

            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.row -->
@endsection