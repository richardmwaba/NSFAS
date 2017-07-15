@extends('layouts.authorized')

@section('title', 'Strategic Directions| add')
@section('heading','Edit Strategic Directions')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                <form class="form-horizontal" role="form" style="margin-top: 10px" method="POST"
                      action="#">
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="form-group{{ $errors->has('academicYear') ? ' has-error' : '' }}">
                            <label for="academicYear" class="col-lg-2 col-md-2 col-sm-3 col-xs-5">Academic Year</label>
                            <div class="col-lg-10 col-md-10 col-sm-9 col-xs-7">
                                <input id="academicYear" placeholder="2016/2017" type="text" class="form-control" name="academicYear"
                                       value="{{ $record->academicYear }}">
                                @if ($errors->has('academicYear'))
                                    <span class="help-block"><strong>{{ $errors->first('academicYear') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('strategy') ? ' has-error' : '' }}">
                            <label for="strategy" class="col-lg-2 col-md-2 col-sm-3 col-xs-5">Strategy</label>
                            <div class="col-lg-10 col-md-10 col-sm-9 col-xs-7">
                                <textarea id="strategy" rows="4" class="form-control" name="strategy">{{$record->strategy }}</textarea>
                                @if ($errors->has('strategy'))
                                    <span class="help-block"><strong>{{ $errors->first('strategy') }}</strong></span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-9 col-sm-9 col-md-11 col-lg-11">
                                <button type="submit" class="btn btn-sm btn-success pull-right">Update</button>
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-1 col-lg-1">
                                <a href="{{URL::asset('/addStrategicDirections')}}" type="reset" class="btn btn-sm btn-danger pull-right">Cancel</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </form>
                <!-- /.form -->
            </div>
            <!-- /.col-lg-md-sm-xs -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
@endsection