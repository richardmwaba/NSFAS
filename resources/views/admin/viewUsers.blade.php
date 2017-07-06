@extends('layouts.authorized')

@section('title', 'View Users')
@section('heading','View Current System Users')

@section('content')
    {!! method_field('DELETE') !!}

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"> <b>Current Users</b></div>

                <div class="panel-body">

                    <table class="table-striped responsive-utilities" data-toggle="table" data-show-refresh="false"
                           data-show-toggle="true" data-show-columns="true" data-search="true"
                           data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name"
                           data-sort-order="desc" style="font-size: small">
                        <thead>
                        <tr>
                            <th data-field="manNumber" data-sortable="true">Man Number</th>
                            <th data-field="firstName" data-sortable="true"> First Name</th>
                            <th data-field="middleName" data-sortable="true"> Last Name</th>
                            <th data-field="lastName" data-sortable="true"> Other Name</th>
                            <th data-field="email" data-sortable="true"> Email</th>
                            <th data-field="accessLevel" data-sortable="true"> Access Level</th>
                            <th data-field="department" data-sortable="true"> Department</th>
                            <th data-field="school" data-sortable="true"> School</th>
                            <th data-field="phoneNumber" data-sortable="true">Phone Number</th>
                            <th data-field="deleteEdit" data-sortable="true">Delete | Edit</th>
                        </tr>
                        </thead>
                        @foreach($users as $member)
                            <tr>
                                <td>
                                    @if(isset($users))
                                        {{$member->manNumber}}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($users))
                                        {{$member->firstName}}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($users))
                                        {{$member->lastName}}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($users))
                                        {{$member->otherName}}
                                    @else
                                        <?php echo 'N/A';?>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($users))
                                        {{$member->email}}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($users))
                                        {{$member->access_level->levelName}}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($users))
                                        {{$member->department->departmentName}}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($users))
                                        {{$member->school->schoolName}}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($users))
                                        {{$member->phoneNumber}}
                                    @endif
                                </td>
                                <td>

                                    <button class="btn btn-default btn-xs btn-danger" type="button" data-toggle="modal" title="Delete" data-target="#deleteModal-{{$member->manNumber}}">
                                        <i class="glyphicon glyphicon glyphicon-trash"></i>
                                    </button>

                                    <button class="btn btn-default btn-xs btn-primary" type="button" title="Edit" data-toggle="modal" data-target="#editMemberModal-{{$member->manNumber}}"><i class="glyphicon glyphicon glyphicon-edit"></i></button>

                                    <form role="form" method="post" action="{{url('/admin/deleteUser/'.$member->manNumber)}}">
                                    {{csrf_field()}}<!--delete confirmation Modal -->
                                        <div class="modal fade" id="deleteModal-{{$member->manNumber}}" role="dialog">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Confirmation</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to <strong><span class="text-danger">delete</span>
                                                            {{$member->firstName}} {{$member->lastName}}</strong> from the system?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">Yes</button>
                                                        <button type="button" class="btn btn-primary" data-dismiss="modal">
                                                            No
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end modal -->
                                    </form>

                                    <!-- Modal for editing member-->
                                    <div class="modal fade" id="editMemberModal-{{$member->manNumber}}" role="dialog">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Edit Details for {{$member->firstName}} {{$member->lastName}}</h4>
                                                </div>
                                                <div class="modal-body" style="max-height: 500px;overflow-y: scroll;">
                                                    <div class="row">
                                                        <form class="" role="form" method="POST"
                                                              action="{{ url('/admin/update/'.$member->manNumber) }}">
                                                            {!! csrf_field() !!}

                                                            <div class="form-group{{ $errors->has('manNumber') ? ' has-error' : '' }} col-md-12 col-sm-12 col-xs-12">

                                                                <label>Man Number</label>
                                                                <input class="form-control" id="manNumber" name="manNumber" type="number" value={{$member->manNumber}}>
                                                                @if ($errors->has('manNumber'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('manNumber') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>

                                                            <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }} col-md-12 col-sm-12 col-xs-12">

                                                                <label>First Name</label>
                                                                <input class="form-control" id="firstName" name="firstName" type="text" value={{$member->firstName}}>
                                                                @if ($errors->has('firstName'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('firstName') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }} col-md-12 col-sm-12 col-xs-12">

                                                                <label>Last Name</label>
                                                                <input class="form-control" id="lastName" value="{{$member->lastName}}" name="lastName" type="text">
                                                                @if ($errors->has('lastName'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('lastName') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group{{ $errors->has('otherName') ? ' has-error' : '' }} col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                                                <label>Other Names</label>
                                                                <input class="form-control" id="otherName" name="otherName" type="text" value="{{$member->otherName}}">
                                                                @if ($errors->has('otherName'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('otherName') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                                                <label>Email</label>
                                                                <input class="form-control" id="email" name="email" type="email" value="{{$member->email }}">
                                                                @if ($errors->has('email'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('email') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group{{ $errors->has('access_level_id') ? ' has-error' : '' }} col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <label>Access Level</label>
                                                                <select class="form-control" onchange="showThis(this)" name="access_level_id">
                                                                    <option value="{{$member->access_level_id}}">{{$member->access_level->levelName}}</option>

                                                                    @foreach($access_level as $access)
                                                                        <option value="{{$access->access_level_id}}">{{$access->levelName}}</option>
                                                                    @endforeach

                                                                    @if ($errors->has('access_level_id'))
                                                                        <span class="help-block">
                                                                            <strong>{{ $errors->first('access_level_id') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            @if($member->access_level_id === 'SA')
                                                            <div id="school_field" style="display: none" class="form-group{{ $errors->has('schools_id') ? ' has-error' : '' }} col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                                            </div>
                                                            @else
                                                                <div id="school_field" class="form-group{{ $errors->has('schools_id') ? ' has-error' : '' }} col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                    <label>School</label>
                                                                    <select id="ddl" onchange="dropdowns(this,document.getElementById('ddl2'))"
                                                                            class="form-control" name="schools_id">
                                                                        <option value="{{$member->schools_id}}">{{$member->school->schoolName}}</option>
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

                                                                    @if ($errors->has('schools_id'))
                                                                        <span class="help-block">
                                                                        <strong>{{ $errors->first('schools_id') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                            @endif
                                                            @if($member->access_level_id === 'HD' OR $member->access_level_id === 'OT')
                                                            <div id="department_id" class="form-group{{ $errors->has('departments_id') ? ' has-error' : '' }} col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <label>Department</label>
                                                                <select id="ddl2" class="form-control" name="departments_id">
                                                                    <option value="{{$member->departments_id}}">{{$member->department->departmentName}}</option>

                                                                </select>

                                                                @if ($errors->has('departments_id'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('departments_id') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            @endif
                                                            <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }} col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                                                <label>Phone Number</label>
                                                                <input class="form-control" name="phone_number" type="tel" value="{{$member->phone_number }}">
                                                                @if ($errors->has('phone_number'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>

                                                            <button type="submit" class="btn btn-sm btn-success col-lg-offset-9 col-md-offset-9 col-sm-offset-9 col-xs-offset-7">Save</button>
                                                            <button type="reset" class="btn btn-sm btn-danger pull-right" data-dismiss="modal">Cancel</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end modal -->
                                    <!-- Modal for editing member ends here-->
                                </td>
                            </tr>
                            {{--@endfor--}}
                        @endforeach
                    </table>

                    <script>
                        $(function () {
                            $('#hover, #striped, #condensed').click(function () {
                                var classes = 'table';

                                if ($('#hover').prop('checked')) {
                                    classes += ' table-hover';
                                }
                                if ($('#condensed').prop('checked')) {
                                    classes += ' table-condensed';
                                }
                                $('#table-style').bootstrapTable('destroy')
                                    .bootstrapTable({
                                        classes: classes,
                                        striped: $('#striped').prop('checked')
                                    });
                            });
                        });

                        function rowStyle(row, index) {
                            var classes = ['active', 'success', 'info', 'warning', 'danger'];

                            if (index % 2 === 0 && index / 2 < classes.length) {
                                return {
                                    classes: classes[index / 2]
                                };
                            }
                            return {};
                        }
                    </script>
                    <!--/. script-->

                    <script>
                        function showThis(that) {
                            if (that.value === "SA") {
//                                alert("check");
                                document.getElementById("school_field").style.display = "none";
                                document.getElementById("department_field").style.display = "none";
                            }else if(that.value === "PO"){
                                document.getElementById("department_field").style.display = "none";
                            }else if(that.value === "AC"){
                                document.getElementById("department_field").style.display = "none";
                            }else if(that.value === "DN"){
                                document.getElementById("department_field").style.display = "none";
                            } else {
                                document.getElementById("school_field").style.display = "block";
                                document.getElementById("department_field").style.display = "block";
                            }
                        }
                    </script>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->


@endsection