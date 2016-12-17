@extends('layouts.hod_template')
@section('title', 'HoD Edit')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading"> Edit User</div>

                    <div class="panel-body">
                        <div class="col-md-12">
                            <form class="form-horizontal" role="form" method="POST"
                                  action="{{ url('/store_edited_user/'.$user->man_number) }}">
                                {!! csrf_field() !!}

                                <div class="row">
                                    <div class="form-group col-md-6{{ $errors->has('man_number') ? ' has-error' : '' }}">
                                        <label>Man Number</label>
                                        <input class="form-control" placeholder="{{$user->man_number}}" name="man_number" value="">
                                        @if ($errors->has('man_number'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('man_number') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6{{ $errors->has('position') ? ' has-error' : '' }}">
                                        <label>Position</label>
                                        <select class="form-control" name="position">
                                            <option value="">{{$user->position}}</option>
                                            <option> Contracts Officer</option>
                                            <option> Dean of School</option>
                                            <option> Academic Staff</option>
                                            <option> Support Staff</option>
                                        </select>
                                        @if ($errors->has('position'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label>E-mail Address</label>
                                        <input class="form-control" placeholder="{{$user->email}}" name="email" value="">
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                        <div class="row">
                            <div class="form-group">
                                <label class="col-sm-4 col-md-5 col-xs-6" for="check">Select if application has been
                                    received:</label>
                                <div class="col-sm-2 col-md-2 col-xs-6">
                                    <label id="demo">
                                        <input id="received" type="checkbox" value="" onchange="contractUpdate(this)"
                                        <?php
                                                $position = Auth()->user()->position;
                                                $tracking = $user->contract_tracking;
                                                switch($position){

                                                    case "Contracts Officer":
                                                        if($tracking == "Contracts Office")
                                                            echo 'checked';
                                                        break;
                                                    case "Head of Department":
                                                        if($tracking=="HOD's Office" OR $tracking == "Contracts Office" OR $tracking == "Dean's Office" OR $tracking == "Waiting for Dean's acknowledgement" OR $tracking=="Waiting for Contracts Officer's acknowledgement")
                                                           echo 'checked';
                                                        break;
                                                    case "Dean of School":
                                                        if($tracking == "Contracts Office" OR $tracking == "Dean's Office" OR $tracking == "Waiting for Dean's acknowledgement" OR $tracking=="Waiting for Contracts Officer's acknowledgement")
                                                            echo 'checked';
                                                        break;
                                                    default :
                                                        if($tracking != "Not available")
                                                            echo 'checked';
                                                        break;
                                                }
                                                ?> >
                                        <!--Include modal here to show after the check box is checked-->
                                    </label>
                                </div>
                                </div>

                            <div class="form-group">
                                <label class="col-sm-4 col-md-5 col-xs-6" for="check">Select if application has been
                                    submitted:</label>
                                <div class="col-sm-2 col-md-2 col-xs-6">
                                    <label id="demo">
                                        <input type="checkbox" id="submitted" value="" onchange="contractUpdate(this)"
                                        <?php
                                                $position = Auth()->user()->position;
                                                $tracking = $user->contract_tracking;
                                                switch($position){

                                                    case "Contracts Officer":
                                                            echo 'checked';
                                                        break;
                                                    case "Head of Department":
                                                        if($tracking == "Waiting for Dean's acknowledgement" OR $tracking == "Dean's Office" OR $tracking == "Waiting for Contracts Officer's acknowledgement" OR $tracking=="Contracts Office")
                                                            echo 'checked';
                                                        break;
                                                    case "Dean of School":
                                                        if($tracking == "Dean's Office" OR $tracking == "Waiting for Contracts Officer's acknowledgement" OR $tracking=="Contracts Office")
                                                        echo 'checked';
                                                        break;
                                                    default :
                                                        if($tracking != "Not available")
                                                            echo 'checked';
                                                        break;

                                                } ?> >
                                        <!--Include modal here to show after the check box is checked-->
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                <!--
                                <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>

                                <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
                                    <button onclick="remindUser()" class="btn btn-default">Request contract</button>
                                </div>


                                <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
                                    <a href="{url('/contract/'.$user->man_number)}}" class="btn btn-success">Update contract </a>
                                </div>
                                -->

                                    <button type="submit" class="btn btn-primary">Save</button>

                                    <label ><a href="{{url('/contract/'.$user->man_number)}}" class="btn btn-success">Update contract </a></label>


                                    <label onclick="remindUser()" class="btn btn-info">Request contract</label>

                            </div>
                            </div>


                        </form>


                    </div>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

    <script>
        function contractUpdate(cb) {
            //check browser support for ajax
            var xhttp;
            if (window.XMLHttpRequest) {
                xhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            if(confirm("Are you sure you want to continue?")) {

                if(cb.checked) {
                    if(cb.id == "submitted") {
                        xhttp.open("GET", "{{url('/contract_submitted/'.$user->man_number)}}", true);
                        xhttp.send();
                    }else{
                        xhttp.open("GET", "{{url('/contract_received/'.$user->man_number)}}", true);
                        xhttp.send();
                    }
                }else {
                    xhttp.open("GET", "{{url('/contract_not_received/'.$user->man_number)}}", true);
                    xhttp.send();
                    document.getElementById('contract_tracking').innerHTML = "In progress...";
                }

            } else {
                //Some other code
            }
            //confirm("Are you sure?");
        }

    </script>
    <script>
        function remindUser() {
            //check browser support for ajax
            var xhttp;
            if (window.XMLHttpRequest) {
                xhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xhttp.open("GET", "{{url('remind_user/'.$user->man_number)}}", true);
            xhttp.send();
            alert('Email reminder sent');
        }
    </script>

@endsection