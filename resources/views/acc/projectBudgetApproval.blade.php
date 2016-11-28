@extends('layouts.authorized')

@section('title', 'Budget')
@section('heading','')

@section('content')
    <div class="panel panel-default">
        <div class="row">
            <div class="row">
                <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-11" >
                    <form class="form-horizontal" role="form" style="margin-left: 20px;margin-top: 20px" method="POST"
                          action="{{ url('/projectBudgetApproval/'. $id) }}">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="date"> Today's Date:</label>
                            <div class="col-sm-6 col-md-6 col-xs-5">
                                <label class="text-primary display-block" for="TodaysDate">
                                    {{ date('jS F, Y') }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="proposedBudget"> Proposed Budget: </label>
                            <div class="col-sm-6 col-md-6 col-xs-5">
                                <label class="text-primary" for="proposedBudget">
                                   K{{ $total }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="income"> Income:</label>
                            <div class="col-sm-6 col-md-6 col-xs-5">
                                <label class="text-primary" for="">@if(isset($sum)) {{ $sum }} @endif </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-3 col-md-3 col-xs-4">
                                <button type="submit" class="btn btn-success">Approve ?</button>
                            </div>
                            {{--<div class="col-sm-3 col-md-3 col-xs-4">--}}
                                {{--<button type="reset" class="btn btn-danger pull-right">Refuse</button>--}}
                            {{--</div>--}}
                        </div>
                    </form>
                    <!-- /.form -->
                </div>
            </div>
        </div>
    </div>
@endsection

