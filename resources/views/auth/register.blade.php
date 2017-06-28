@extends('layouts.unauthorized')
@section('title', 'Register')
@section('main_content')
<div class="row">
    <div class="well well-lg">
        <div class="row">
            <div class="col-sm-12">
                <h3 style="text-align: center; margin-bottom: 20px; color: #e5e5e5"><b>FINANCIAL ACCOUNTING SYSTEM</b></h3>
                <img class="center-block" style="margin-bottom: 20px" src="frontend/img/logo.png" alt="Unza logo">
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <section>
                <form class="" role="form" method="POST" action="{{ url('/register') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('accessLevelId') ? ' has-error' : '' }} row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="access_level" style="color: #e5e5e5" class="col-md-3 control-label">Role/Position</label>
                            <div class="col-md-9">
                                <select class="form-control" onchange="showThis(this)" name="accessLevelId">
                                    <option value="">-- Select a role from this list --</option>

                                    @foreach($access_level as $access)
                                        <option value="{{$access->access_level_id}}">{{$access->levelName}}</option>
                                    @endforeach



                                    @if ($errors->has('accessLevelId'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('accessLevelId') }}</strong>
                                    </span>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>


                    <div id="school_field" style="display: none" class="form-group{{ $errors->has('school') ? ' has-error' : '' }} row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="school" style="color: #e5e5e5" class="col-md-3 control-label">School</label>
                            <div class="col-md-9">
                                <select id="ddl" onchange="dropdowns(this,document.getElementById('ddl2'))"
                                        class="form-control" name="school">
                                    <option value="">-- Select school from this list --</option>
                                    <option value="1"> Agriculture</option>
                                    <option value="2"> Education</option>
                                    <option value="3"> Engineering</option>
                                    <option value="4"> Humanities & Social Sciences</option>
                                    <option value="5"> Law</option>
                                    <option value="6"> Medicine</option>
                                    <option value="7"> Mines</option>
                                    <option value="8"> Natural Sciences</option>
                                    <option value="9"> Veterinary Medicine</option>
                                </select>
                            </div>

                            @if ($errors->has('school'))
                                <span class="help-block">
                                                <strong>{{ $errors->first('school') }}</strong>
                                            </span>
                            @endif
                        </div>
                    </div>

                    <div id="department_field" style="display: none" class="form-group{{ $errors->has('department') ? ' has-error' : '' }} row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="department" style="color: #e5e5e5" class="col-md-3 control-label">Department</label>
                            <div class="col-md-9">
                                <select id="ddl2" class="form-control" name="department">

                                </select>
                            </div>
                            <span class="help-block">
                            @if ($errors->has('department'))
                                    <strong>{{ $errors->first('department') }}</strong>
                            </span>
                            @endif
                        </div>

                    </div>

                    <div class="form-group{{ $errors->has('manNumber') ? ' has-error' : '' }} row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="manNumber" style="color: #e5e5e5" class="col-md-3 control-label">Man Number</label>

                            <div class="col-md-9">
                                <input id="manNumber" type="number" class="form-control" name="manNumber" min="0">

                                @if ($errors->has('manNumber'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('manNumber') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }} row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="firstName" style="color: #e5e5e5" class="col-md-3 control-label">First Name</label>

                            <div class="col-md-9">
                                <input id="firstName" type="text" class="form-control" name="firstName" placeholder="Enter First Name">

                                @if ($errors->has('firstName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }} row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="name" style="color: #e5e5e5" class="col-md-3 control-label">Last Name</label>

                            <div class="col-md-9">
                                <input id="lastName" type="text" class="form-control" name="lastName" placeholder="Enter Last Name">

                                @if ($errors->has('lastName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('otherName') ? ' has-error' : '' }} row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="name" style="color: #e5e5e5" class="col-md-3 control-label">Other Name</label>

                            <div class="col-md-9">
                                <input id="otherName" type="text" class="form-control" name="otherName" placeholder="Enter Other Name">

                                @if ($errors->has('otherName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('otherName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="email" style="color: #e5e5e5" class="col-md-3 control-label">Email Address</label>

                            <div class="col-md-9">
                                <input id="email" type="email" class="form-control" name="email" placeholder="Enter email address">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="password" style="color: #e5e5e5" class="col-md-3 control-label">Password</label>

                            <div class="col-md-9">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }} row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="password-confirm" style="color: #e5e5e5" class="col-md-3 control-label">Confirm Password</label>

                            <div class="col-md-9">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-success pull-right">
                                    <i class="fa fa-btn fa-user"></i> Register
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
        </div>
        <!-- /.row -->
    </div>
</div>
<!-- /.row -->

<!-- Script -->
<script>
    function showThis(that) {
        if (that.value === "HD") {
//                                alert("check");
            document.getElementById("school_field").style.display = "block";
            document.getElementById("department_field").style.display = "block";
        }else if(that.value === "DN"){
            document.getElementById("school_field").style.display = "block";
        } else {
            document.getElementById("school_field").style.display = "none";
            document.getElementById("department_field").style.display = "none";
        }
    }
</script>
@endsection
