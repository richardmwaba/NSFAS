@extends('layouts.authorized')
@section('main_content')
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$user->firstName}}</div>

                    <div class="panel-body">
                        <div class="col-md-9">
                            <form class="form-horizontal" role="form" style="margin-left: 20px;margin-top: 20px">
                                <div class="form-group">
                                    <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">First Name:</label>
                                    <div class="col-sm-6 col-md-6 col-xs-5">
                                        <label class="text-primary" for="first_name_value">{{$user->firstName}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 col-md-3 col-xs-4" for="middle-name">Other Name:</label>
                                    <div class="col-sm-6 col-md-6 col-xs-5">
                                        <label class="text-primary" for="middle_name_value">{{$user->otherNames}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 col-md-3 col-xs-4" for="last-name"> Last Name:</label>
                                    <div class="col-sm-6 col-md-6 col-xs-5">
                                        <label class="text-primary" for="last_name_value">{{$user->lastName}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 col-md-3 col-xs-4" for="e-mail"> Email Address:</label>
                                    <div class="col-sm-6 col-md-6 col-xs-5">
                                        <label class="text-primary" for="e-mail_value">{{$user->email}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 col-md-3 col-xs-4" for="man-number"> Man Number:</label>
                                    <div class="col-sm-6 col-md-6 col-xs-5">
                                        <label class="text-primary" for="man-number_value">{{$user->manNumber}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 col-md-3 col-xs-4" for="phone-number"> Phone Number:</label>
                                    <div class="col-sm-6 col-md-6 col-xs-5">
                                        <label class="text-primary" for="phone_number_value">{{$user->phoneNumber}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-8 col-md-9 col-xs-6">
                                        <a href="{{url('edit_profile')}}" class="btn btn-info btn-sm" role="button">Edit profile</a>
                                    </div>
                                </div>

                            </form>
                            <!-- /.form -->
                        </div>

                        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                            <form action="{{route('account.save')}}" method="post" enctype="multipart/form-data">
                                @if(Storage::disk("local")->has(Auth::user()->firstName. '-' .Auth::user()->id.'001'.'.jpg'))
                                    <section class="row new-post">
                                        <div class="col-md-6 col-md-offset-3">
                                            <img src="{{route('account.image',[ 'filename'=>Auth::user()->firstName. '-'
                                    .Auth::user()->id.'001'.'.jpg'])}}" alt=""
                                                 class="img-responsive img-circle">
                                        </div>
                                    </section>
                                @endif

                                <div class="form-group">
                                    <input class="form-control" type="file" name="image" id="image">
                                </div>
                                <button class="btn btn-sm btn-success" type="submit">Upload</button>
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                            </form>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
@endsection
