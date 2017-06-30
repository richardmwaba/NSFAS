@extends('layouts.authorized')

@section('title', 'Add | Accountant')
@section('heading','Add New Accountant')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-11" >
                    <form class="form-horizontal" role="form" style="margin-top: 10px" method="POST"
                          action="{{ url('/addAccountant') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
                            <label for="firstName" class="col-md-3">First Name</label>
                            <div class="col-md-8">
                                <input id="firstName" placeholder="First Name" type="text" class="form-control" name="firstName" value="{{ old('firstName') }}">
                                @if ($errors->has('firstName'))
                                    <span class="help-block"><strong>{{ $errors->first('firstName') }}</strong></span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-3">Last Name</label>
                            <div class="col-md-8">
                                <input id="lastName" placeholder="Last Name" type="text" class="form-control" name="lastName" value="{{ old('lastName') }}">
                                @if ($errors->has('lastName'))
                                    <span class="help-block"><strong>{{ $errors->first('lastName') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('otherName') ? ' has-error' : '' }}">
                            <label for="otherName" class="col-md-3">Other Names</label>
                            <div class="col-md-8">
                                <input id="otherName" placeholder="Last Name (Optional) " type="text" class="form-control" name="otherName" value="{{ old('otherName') }}">
                                @if ($errors->has('otherName'))
                                    <span class="help-block"><strong>{{ $errors->first('otherName') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('manNumber') ? ' has-error' : '' }}">
                            <label for="man_number" class="col-md-3">Man #</label>
                            <div class="col-md-8">
                                <input id="man_number" placeholder="Man Number" type="text" class="form-control" name="manNumber" value="{{ old('manNumber') }}">
                                @if ($errors->has('manNumber'))
                                    <span class="help-block"><strong>{{ $errors->first('manNumber') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-3">E-Mail Address</label>
                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control" name="email" placeholder="someone@email.com">
                                @if ($errors->has('email'))
                                    <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                            <label for="school" class="col-md-3">School</label>
                            <div class="col-md-8">

                                <select class="form-control" name="school" id="school">
                                    <option>-- Select a school from the list --</option>
                                    @foreach($schools as $school)
                                        <option value="{{$school->schoolName}}"> {{$school->schoolName}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('school'))
                                    <span class="help-block"><strong>{{ $errors->first('school') }}</strong></span>
                                @endif

                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-3">Password</label>
                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control" name="password">
                                @if ($errors->has('password'))
                                    <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-3">Confirm Password</label>
                            <div class="col-md-8">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-8 col-sm-9 col-md-9 col-lg-9">
                                <button type="submit" class="btn btn-sm btn-success pull-right">Add</button>
                            </div>
                            <div class="col-xs-4 col-sm-3 col-md-2 col-lg-2">
                                <button type="reset" class="btn btn-sm btn-danger pull-right">Cancel</button>
                            </div>
                        </div>
                    </form>
                    <!-- /.form -->
                </div>
                <!-- col-lg-md-sm-xs -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
@endsection