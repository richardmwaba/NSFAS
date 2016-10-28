@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('access_level_id') ? ' has-error' : '' }}">
                            <label for="access_level_id" class="col-md-4 control-label">System Admin</label>

                            <div class="col-md-6">
                                <input id="access_level_id" type="text" class="form-control" name="access_level_id" value="SA">

                                @if ($errors->has('access_level_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('access_level_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('manNumber') ? ' has-error' : '' }}">
                            <label for="manNumber" class="col-md-4 control-label">manNumber</label>

                            <div class="col-md-6">
                                <input id="manNumber" type="number" class="form-control" name="manNumber" value="">

                                @if ($errors->has('manNumber'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('manNumber') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
                            <label for="firstName" class="col-md-4 control-label">firstName</label>

                            <div class="col-md-6">
                                <input id="firstName" type="text" class="form-control" name="firstName" value="{{ old('firstName') }}">

                                @if ($errors->has('firstName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">lastName</label>

                            <div class="col-md-6">
                                <input id="lastName" type="text" class="form-control" name="lastName" value="{{ old('lastName') }}">

                                @if ($errors->has('lastName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('otherName') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">otherName</label>

                            <div class="col-md-6">
                                <input id="otherName" type="text" class="form-control" name="otherName" value="{{ old('otherName') }}">

                                @if ($errors->has('otherName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('otherName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
