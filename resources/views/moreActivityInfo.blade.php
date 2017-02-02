@extends('layouts.authorized')

@section('title', 'Activity')
@section('heading','More Information')

@section('content')
    <div class="panel panel-default">
        <div class="row">
            <div class="row">
                <div class="btn-group">
                    <a href="{{url('/redirectBack')}}" class="btn btn-md btn-link"><i class="fa fa-chevron-circle-left fa-fw text-primary">
                        </i><span class="text-primary">Previous Page ..</span></a>
                </div>
                <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-11" >
                    <form class="form-horizontal" role="form" style="margin-left: 20px;margin-top: 20px" method="POST"
                          action="#">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="indicatorOfSuccess">Indicator Of Success:</label>
                            <div class="col-sm-6 col-md-6 col-xs-5">
                                <label class="text-primary" for="indicatorOfSuccess">
                                    @if(isset($activity))
                                        {{ $activity->indicatorOfSuccess}}
                                    @endif
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="targetOfIndicator">Target Of Indicator:</label>
                            <div class="col-sm-6 col-md-6 col-xs-5">
                                <label class="text-primary" for="">
                                    @if(isset($activity))
                                        {{ $activity->targetOfIndicator}}
                                    @endif
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="baselineOfIndicator">Baseline Of Indicator:</label>
                            <div class="col-sm-6 col-md-6 col-xs-5">
                                <label class="text-primary" for="baselineOfIndicator">
                                    @if(isset($activity))
                                        {{ $activity->baselineOfIndicator}}
                                    @endif
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="last-name">Source Of Funding:</label>
                            <div class="col-sm-6 col-md-6 col-xs-5">
                                <label class="text-primary" for="amount">
                                    @if(isset($activity))
                                        {{ $activity->sourceOfFunding}}
                                    @endif
                                </label>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="last-name">Staff Responsible:</label>
                            <div class="col-sm-6 col-md-6 col-xs-5">
                                <label class="text-primary" for="staffResponsible">
                                    @if(isset($activity))
                                        {{ $activity->staffResponsible}}
                                    @endif
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="last-name">Percentage Achieved:</label>
                            <div class="col-sm-6 col-md-6 col-xs-5">
                                <label class="text-primary" for="percentageAchieved">
                                    @if(isset($activity))
                                        {{ $activity->percentageAchieved}}
                                    @endif
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="last-name">Time Frame:</label>
                            <div class="col-sm-6 col-md-6 col-xs-5">
                                <label class="text-primary" for="amount">
                                    @if(isset($activity))
                                        @if($activity->firstQuarter == 1)
                                            <h5><i class="fa fa- fa-fw"></i>First Quarter</h5>
                                        @endif
                                        @if($activity->secondQuarter == 1)
                                                <h5><i class="fa fa- fa-fw"></i>Second Quarter</h5>
                                        @endif
                                        @if($activity->thirdQuarter == 1)
                                                <h5><i class="fa fa- fa-fw"></i>Third Quarter</h5>
                                        @endif
                                        @if($activity->fourthQuarter == 1)
                                                <h5><i class="fa fa- fa-fw"></i>Fourth Quarter</h5>
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