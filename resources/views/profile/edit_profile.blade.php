@extends('layouts.authorized')
@section('main_content')

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$user->firstName}} ({{$user->manNumber}})</div>

                    <div class="panel-body">
                        <div class="col-md-6">
                            <form class="form-horizontal" role="form" method="POST"
                                  action="{{ url('update_profile') }}">
                                {!! csrf_field() !!}

                                <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
                                    <label>First Name</label>

                                    <input class="form-control" name="firstName" placeholder="{{$user->firstName}}" value="{{$user->firstName}}">

                                    @if ($errors->has('firstName'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('firstName') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('otherName') ? ' has-error' : '' }}">
                                    <label>Middle Name</label>

                                    <input class="form-control" name="otherName" placeholder="{{$user->otherName}}" value="{{$user->otherName}}">

                                    @if ($errors->has('otherName'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('otherName') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
                                    <label>Last Name</label>

                                    <input class="form-control" name="lastName" placeholder="{{$user->lastName}}" value="{{$user->lastName}}">

                                    @if ($errors->has('lastName'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('lastName') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label>E-mail Address</label>

                                    <input class="form-control" placeholder="{{$user->email}}" name="email" type="email">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Phone Number</label>

                                    <input class="form-control" placeholder="+260" name="phone_number" value="{{$user->phoneNumber}}">

                                </div>
                                <div class="form-group">
                                    <a href="#" class="btn btn-link" role="button" data-toggle="modal"
                                       data-target="#changePass" onclick="" id="">Change password?</a>
                                </div>
                                <div id="demo" class="collapse">

                                </div>

                                <!--Research on how to compare passwords entered in these fields-->

                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-4">
                                    <button type="reset" class="btn btn-default">Cancel</button>
                                </div>

                            </form>

                            <!-- Change password modal -->
                            <form id="changePassword" class="form-horizontal" role="form">
                                {!! csrf_field() !!}
                                <div class="modal fade" id="changePass" role="dialog">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button id="close" type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title text-primary"> Change Password</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">

                                                        <div id="current_password-group" class="form-group">
                                                            <label>Current Password</label>
                                                            <input class="form-control" placeholder="Password"
                                                                   name="current_password" type="password">
                                                            </div>

                                                        <div id="password-group" class="form-group">
                                                            <label>Enter New Password</label>
                                                            <input class="form-control" placeholder="Password"
                                                                   name="password" type="password">
                                                        </div>

                                                        <div id="password_confirmation-group" class="form-group">
                                                            <label>Confirm New Password</label>
                                                            <input class="form-control" placeholder="Password"
                                                                   name="password_confirmation" type="password">
                                                        </div>
                                                    </div>
                                                </div>

                                            <div class="modal-footer">
                                                <div class="col-md- ">

                                                    <button onclick="changePassword()" class="btn btn-default">save
                                                    </button>

                                                    <!--</div>
                                                    <div class="">-->
                                                    <button type="reset" class="btn btn-default">Cancel</button>
                                                </div>

                                                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                                            </div>
                                        </div>
                                    </div>
                                        </div>
                                </div>
                                <!-- /.Change password modal-->
                            </form>
                            </div>
                        <!-- /.col-md-6-->

                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
                </div>

    <script>
        function changePassword() {
            $(document).ready(function () {

                $("#button").click(function () {
                    $("#demo").toggle();
                });
                // process the form
                $('#changePassword').submit(function (event) {
                    event.preventDefault();


                    var formData = {
                        'current_password': $('input[name=current_password]').val(),
                        'password': $('input[name=password]').val(),
                        'password_confirmation': $('input[name=password_confirmation]').val(),
                        '_token': $('input[name=_token]').val()
                    };
                    // process the form

                    $.ajax({
                                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                                url: '{{ url('change_password')}}', // the url where we want to POST
                                data: formData, // our data object
                                dataType: 'json', // what type of data do we expect back from the server
                                encode: true
                            })
                            // using the done promise callback
                            .done(function (data) {

                                // log data to the console so we can see
                                console.log(data);
                                // here we will handle errors and validation messages
                                // here we will handle errors and validation messages
                                if (!data.success) {

                                    // handle errors for name ---------------
                                    if (data.errors.current_password) {
                                        //$('#current_password-group').removeClass('has-error');
                                        $('#current_password-group').addClass('has-error'); // add the error class to show red input
                                        $('#current_password-group').children('#error').remove();
                                        $('#current_password-group').append('<div id="error" class="help-block">' + data.errors.current_password + '</div>'); // add the actual error message under our input
                                    }


                                    // handle errors for email ---------------
                                    if (data.errors.password) {
                                        $('#password-group').addClass('has-error'); // add the error class to show red input
                                        $('#password-group').children('#error').remove();
                                        $('#password-group').append('<div id="error" class="help-block">' + data.errors.password + '</div>'); // add the actual error message under our input
                                    }

                                    // handle errors for superhero alias ---------------
                                    if (data.errors.password_confirmation) {
                                        $('#password_confirmation-group').addClass('has-error'); // add the error class to show red input
                                        $('#password_confirmation-group').children('#error').remove();
                                        $('#password_confirmation-group').append('<div id="error" id="error" class="help-block">' + data.errors.password_confirmation + '</div>'); // add the actual error message under our input
                                    }

                                } else {

                                    // ALL GOOD! just show the success message!
                                    //$('div.alert').append('<div class="alert alert-success">' + data.message + '</div>');
                                    $("#close").trigger('click');
                                    $("html, body").animate({ scrollTop: 0 }, 5);
                                    window.location.reload(true);
                                    // usually after form submission, you'll want to redirect
                                    // window.location = '/thank-you'; // redirect a user to another page
                                    // for now we'll just alert the user

                                }
                            });
                });
            });
        }
    </script>
@endsection
