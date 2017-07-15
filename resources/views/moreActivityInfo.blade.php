@extends('layouts.authorized')

@section('title', 'Activity')
@section('heading','More Information')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="btn-group">
                <a href="{{URL::asset('/viewAll')}}" class="btn btn-md btn-link pull-right"><i class="fa fa-chevron-circle-left fa-fw text-primary">
                    </i><span class="text-primary">Previous Page</span></a>
            </div>
            <form class="form-horizontal" role="form" style="margin-left: 20px;margin-top: 20px" method="POST"
                  action="#">
                {!! csrf_field() !!}

                <div class="row">
                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-xs-4" for="indicatorOfSuccess">Indicator Of Success:</label>
                        <div class="col-sm-6 col-md-6 col-xs-5 text-primary">
                            @if(isset($activity))
                                {{ $activity->indicatorOfSuccess}}
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-xs-4" for="targetOfIndicator">Target Of Indicator:</label>
                        <div class="col-sm-6 col-md-6 col-xs-5 text-primary">
                            @if(isset($activity))
                                {{ $activity->targetOfIndicator}}
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-xs-4" for="baselineOfIndicator">Baseline Of Indicator:</label>
                        <div class="col-sm-6 col-md-6 col-xs-5 text-primary">
                            @if(isset($activity))
                                {{ $activity->baselineOfIndicator}}
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-xs-4" for="last-name">Source Of Funding:</label>
                        <div class="col-sm-6 col-md-6 col-xs-5 text-primary">
                            @if(isset($activity))
                                {{ $activity->sourceOfFunding}}
                            @endif
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-xs-4" for="last-name">Staff Responsible:</label>
                        <div class="col-sm-6 col-md-6 col-xs-5 text-primary">
                            @if(isset($activity))
                                {{ $activity->staffResponsible}}
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-xs-4" for="last-name">Percentage Achieved:</label>
                        <div class="col-sm-6 col-md-6 col-xs-5 text-primary">
                            @if(isset($activity))
                                {{ $activity->percentageAchieved}}
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-xs-4" for="last-name">Time Frame:</label>
                        <div class="col-sm-6 col-md-6 col-xs-5">
                            <label class="text-primary" for="amount">
                                @if(isset($activity))
                                    @if($activity->firstQuarter == 1)
                                        <h5>First Quarter</h5>
                                    @endif
                                    @if($activity->secondQuarter == 1)
                                        <h5>Second Quarter</h5>
                                    @endif
                                    @if($activity->thirdQuarter == 1)
                                        <h5>Third Quarter</h5>
                                    @endif
                                    @if($activity->fourthQuarter == 1)
                                        <h5>Fourth Quarter</h5>
                                    @endif
                                @endif
                            </label>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </form>
            <!-- /.form -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
@endsection