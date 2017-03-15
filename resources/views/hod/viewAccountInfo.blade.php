@extends('layouts.authorized')

@section('title', 'Account details')
@section('heading','Financial summary record for The Department Of '.$departments->departmentName. '')

@section('content')
    <div class="panel panel-default">
        <div class="row">
            <div class="row">
                <div class="btn-group">
                    <a href="#" class="btn btn-md btn-link"><i class="fa fa-print fa-fw text-success">
                        </i><span class="text-success">Print</span></a>
                </div>
                <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-11" >
                    <form class="form-horizontal" role="form" style="margin-left: 20px;margin-top: 20px" method="POST"
                          action="#">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="NRC"> Today's Date:</label>
                            <div class="col-sm-6 col-md-6 col-xs-5">
                                <label class="text-primary" for="TodaysDate">
                                    {{ date('jS F, Y') }}
                                </label>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="last-name">Department Account Name:</label>
                            <div class="col-sm-6 col-md-6 col-xs-5">
                                <label class="text-primary" for="amount">
                                    @if(isset($account))
                                    {{ $account->accountName }}
                                    @endif
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="first-name"> BudgetLine </label>
                            <div class="col-sm-6 col-md-6 col-xs-5">
                                <label class="text-primary" for="">
                                    @if(isset($budget))
                                    {{ $budget->budgetName }}
                                    @endif
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="last-name">School Main Account:</label>
                            <div class="col-sm-6 col-md-6 col-xs-5">
                                <label class="text-primary" for="amount">
                                    @if(isset($budget))
                                    k {{ $budget->schoolIncome }}.00
                                    @endif
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="last-name">Department Income(Received from School main account):</label>
                            <div class="col-sm-6 col-md-6 col-xs-5">
                                <label class="text-primary" for="amount">
                                    @if(isset($budget))
                                    K {{ $budget->departmentIncome }}.00
                                    @endif
                                </label>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="last-name">Department Total Income:</label>
                            <div class="col-sm-6 col-md-6 col-xs-5">
                                <label class="text-primary" for="amount">
                                    @if(isset($account))
                                        @if(isset($account->calculatedTotal->incomeAcquired))
                                             K {{ $account->calculatedTotal->incomeAcquired }}.00
                                        @endif
                                    @endif
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="last-name">Department Total Expenditure:</label>
                            <div class="col-sm-6 col-md-6 col-xs-5">
                                <label class="text-primary" for="amount">
                                    @if(isset($account))
                                        @if(isset($account->calculatedTotal->expenditureAcquired))
                                            K {{ $account->calculatedTotal->expenditureAcquired }}.00
                                        @endif
                                    @endif
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="last-name">Department Balance(As of today):</label>
                            <div class="col-sm-6 col-md-6 col-xs-5">
                                <label class="text-primary" for="amount">
                                    @if(isset($account))
                                        @if(isset($account->calculatedTotal->expenditureAcquired))
                                            K {{ $account->calculatedTotal->incomeAcquired - $account->calculatedTotal->expenditureAcquired }}.00
                                        @endif
                                    @endif
                                </label>
                            </div>
                        </div>

                    </form>
                    <!-- /.form -->
                </div>
            </div>
        </div>
    </div>
@endsection