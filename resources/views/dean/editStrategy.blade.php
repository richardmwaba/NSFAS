@extends('layouts.authorized')

@section('title', 'Strategic Directions| add')
@section('heading','STRATEGIC DIRECTIONS | Activity based work plan and budget')

@section('content')
    <div class="panel panel-default">
        <div class="row">
            <div class="row">
                <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-11" >
                    <form class="form-horizontal" role="form" style="margin-left: 20px;margin-top: 20px" method="POST"
                          action="{{ url('/editStrategicDirections') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('academicYear') ? ' has-error' : '' }}">
                            <label for="academicYear" class="col-md-3">Academic Year</label>
                            <div class="col-md-8">
                                <input id="academicYear" placeholder="2016/2017" type="text" class="form-control" name="academicYear"
                                       value="{{ $record->academicYear }}">
                                <input type="hidden" name="id" value="{{$record->id}}">
                                @if ($errors->has('academicYear'))
                                    <span class="help-block"><strong>{{ $errors->first('academicYear') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('strategy') ? ' has-error' : '' }}">
                            <label for="strategy" class="col-md-3">Strategy</label>
                            <div class="col-md-8">
                                <textarea id="strategy" rows="4" class="form-control" name="strategy">{{$record->strategy }}</textarea>
                                @if ($errors->has('strategy'))
                                    <span class="help-block"><strong>{{ $errors->first('strategy') }}</strong></span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-4 col-sm-3 col-md-offset-7 col-md-2">
                                <button type="submit" class="btn btn-default">update</button>
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