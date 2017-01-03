@extends('layouts.authorized')

@section('title', 'Budget')
@section('heading','Budget information for 16/17 academic year')

@section('content')
    <div class="panel panel-default">
        <div class="row">
            <div class="row">
                {{--<div class="col-sm-12">--}}
                    {{--<img class="center-block" style="margin-bottom: 10px; margin-top: 10px; " src="{{ URL::asset('frontend/img/logo.png') }}">--}}
                {{--</div>--}}
                <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-11" >
                    <form class="form-horizontal" role="form" style="margin-left: 20px;margin-top: 20px" method="POST"
                          action="{{ url('/addProject') }}">
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
                            <label class="col-sm-3 col-md-3 col-xs-4" for="last-name"> Proposed Budget:</label>
                            <div class="col-sm-6 col-md-6 col-xs-5">
                                <label class="text-primary" for="last_name_value">
                                    {{--@if(!isset($info))--}}
                                        {{--{{ $data->last_name }}--}}
                                    {{--@else--}}
                                        {{--{{ $info->last_name }}--}}
                                    {{--@endif--}}
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="first-name"> Allocated Budget:</label>
                            <div class="col-sm-6 col-md-6 col-xs-5">
                                <label class="text-primary" for="">
                                    {{--@if(!isset($info))--}}
                                        {{--{{ $data->first_name }}--}}
                                    {{--@else--}}
                                        {{--{{ $info->first_name }}--}}
                                    {{--@endif--}}
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="other-names"> Used amount as of today:</label>
                            <div class="col-sm-6 col-md-6 col-xs-5">
                                <label class="text-primary" for="other_names_value">
                                    {{--@if(!isset($info))--}}
                                        {{--{{ $data->other_names }}--}}
                                    {{--@else--}}
                                        {{--{{ $info->other_names }}--}}
                                    {{--@endif--}}
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="man-#"> Remaining amount:</label>
                            <div class="col-sm-6 col-md-6 col-xs-5">
                                <label class="text-primary" for="man_#_value">
                                    {{--@if(!isset($info))--}}
                                        {{--{{ $data->man_number }}--}}
                                    {{--@else--}}
                                        {{--{{ $info->man_number }}--}}
                                    {{--@endif--}}
                                </label>
                            </div>
                        </div>

                        {{--<div class="form-group{{ $errors->has('endDate') ? ' has-error' : '' }}">--}}
                            {{--<label for="endDate" class="col-md-3">End Date</label>--}}
                            {{--<div class="col-md-8">--}}
                                {{--<input id="endDate" type="date" class="form-control" name="endDate" value="">--}}
                                {{--@if ($errors->has('startDate'))--}}
                                    {{--<span class="help-block"><strong>{{ $errors->first('endDate') }}</strong></span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<div class="col-xs-4 col-sm-3 col-md-offset-7 col-md-2">--}}
                                {{--<button type="submit" class="btn btn-default">Add</button>--}}
                            {{--</div>--}}
                            {{--<div class="col-xs-4 col-sm-3 col-md-2">--}}
                                {{--<button type="reset" class="btn btn-default pull-right">Cancel</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </form>
                    <!-- /.form -->
                </div>
            </div>
        </div>
    </div>
@endsection