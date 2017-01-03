@extends('layouts.authorized')

@section('title', 'add | Staff')
@section('heading','Add Staff')

@section('content')
<div class="panel panel-default">
    <div class="row">
        <div class="row">
            <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-11" >
                <form class="form-horizontal" role="form" style="margin-left: 20px;margin-top: 20px" method="POST"
                      action="{{ url('/addStaff') }}">
                    {!! csrf_field() !!}

                    <div class="form-group{{ $errors->has('manNumber') ? ' has-error' : '' }}">
                        <label for="man_number" class="col-md-3">Man Number</label>
                        <div class="col-md-8">
                            <input id="man_number" placeholder="man number " type="text" class="form-control" name="manNumber" value="{{ old('manNumber') }}">
                            @if ($errors->has('manNumber'))
                                <span class="help-block"><strong>{{ $errors->first('manNumber') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
                        <label for="firstName" class="col-md-3">First Name</label>
                        <div class="col-md-8">
                            <input id="firstName" placeholder="first name " type="text" class="form-control" name="firstName" value="{{ old('firstName') }}">
                            @if ($errors->has('firstName'))
                            <span class="help-block"><strong>{{ $errors->first('firstName') }}</strong></span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
                        <label for="last_name" class="col-md-3">Last Name</label>
                        <div class="col-md-8">
                            <input id="lastName" placeholder="last name " type="text" class="form-control" name="lastName" value="{{ old('lastName') }}">
                            @if ($errors->has('lastName'))
                            <span class="help-block"><strong>{{ $errors->first('lastName') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('otherName') ? ' has-error' : '' }}">
                        <label for="otherName" class="col-md-3">Other Names</label>
                        <div class="col-md-8">
                            <input id="otherName" placeholder="Optional " type="text" class="form-control" name="otherName" value="{{ old('otherName') }}">
                            @if ($errors->has('otherName'))
                            <span class="help-block"><strong>{{ $errors->first('otherName') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-3">E-Mail Address</label>
                        <div class="col-md-8">
                            <input id="email" type="email" placeholder="email" class="form-control" name="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('phoneNumber') ? ' has-error' : '' }}">
                        <label for="phoneNumber" class="col-md-3">Phone Number</label>
                        <div class="col-md-8">
                            <input id="phoneNumber" placeholder="+260 973797938" type="text" class="form-control" name="phoneNumber" value="{{ old('phoneNumber') }}">
                            @if ($errors->has('phoneNumber'))
                            <span class="help-block"><strong>{{ $errors->first('phoneNumber') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-4 col-sm-3 col-md-offset-7 col-md-2">
                            <button type="submit" class="btn btn-default">Add</button>

                        </div>
                        <div class="col-xs-4 col-sm-3 col-md-2"> <button type="reset" class="btn btn-default pull-right">Cancel</button>
                        </div>
                    </div>
                </form>
                <!-- /.form -->
            </div>
        </div>
    </div>
    </div>
@endsection