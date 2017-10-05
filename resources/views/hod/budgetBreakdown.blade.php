@extends('layouts.authorized')
@section('title', 'Project | Income')
@section('heading','Budget for '.$projects->projectName .' project')


@section('content')

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><span style="color: #0b97c4">Current Total Budget for {{ $projects->projectName }} project amounts to {{ "K ".number_format($projects->totalAmount->proposedBudget, "2", ".", ",") }}</span></div>

                <div class="panel-body">

                    <div class="col-lg-12 col-md-12 col-md-12 col-xs-12" >
                        <form class="form-horizontal" role="form" style="margin-top: 0px" method="POST"
                              action="#">
                            <div class="form-group">
                                <button data-target="#addBudgetItemModal" data-toggle="modal" class="btn btn-primary"><span><i class="fa fa-plus-square fa-fw"></i></span>Add Budget Item</button>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 col-lg-2 col-md-2 col-xs-4" for="NRC"> Proposed Amount:</label>
                                <div class="col-sm-6 col-lg-2 col-md-2 col-xs-5 text-primary">
                                    {{ "K ".number_format($projects->budget->netProjectBudget, "2", ".", ",") }}
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-3 col-lg-2 col-md-2 col-xs-4" for="">Received Income Amount:</label>
                                <div class="col-sm-6 col-lg-6 col-md-6 col-xs-5 text-primary">
                                    @if(isset($projects->totalAmount->incomeAcquired))
                                        {{ "K ".number_format($projects->totalAmount->incomeAcquired, "2", ".", ",") }}
                                    @else
                                        <span style="color: red">Not yet received :(</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 col-lg- 2 col-md-2 col-xs-4" for="first-name"> Budget Status:</label>
                                <div class="col-sm-6 col-lg-6 col-md-6 col-xs-5 text-primary">
                                    @if(isset($projects))
                                        @php
                                            switch ($projects->budget->approved)
                                            {
                                                case 0:
                                                   echo 'Adding of budget items incomplete';
                                                break;
                                                case 1:
                                                    echo 'Awaiting HoD\'s approval';
                                                break;
                                                case 2:
                                                    echo 'Approved by HoD';
                                                break;
                                                case 3:
                                                    echo 'Awaiting Dean\'s approval';
                                                break;
                                                case 4:
                                                    echo 'Approved by Dean';
                                                break;
                                                case 5:
                                                    echo 'Awaiting Accountant\'s approval/funding';
                                                break;
                                                case 6:
                                                    echo 'Project complete';
                                                break;
                                            }
                                        @endphp
                                    @endif
                                </div>
                            </div>

                        </form>
                        <!-- /.form -->
                    </div>
                    <!-- col-lg-md-sm-xs -->

                    <table class="table-striped responsive-utilities" data-toggle="table" data-show-refresh="false"
                           data-show-toggle="true" data-show-columns="true" data-search="true"
                           data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name"
                           data-sort-order="desc" style="font-size: small">
                        <thead>
                        <tr>
                            {{--<th data-field="state" data-checkbox="true">Count</th>--}}
                            <th data-field="description" data-sortable="true">Item Description</th>
                            <th data-field="quantity" data-sortable="true">Quantity</th>
                            <th data-field="priceUnit" data-sortable="true">Price per Unit/Quantity</th>
                            <th data-field="cost" data-sortable="true">Total Cost</th>
                            <th data-field="deleteEdit" data-sortable="true">Delete | Edit</th>
                        </tr>
                        </thead>
                        @foreach( $budgetRecords as $budgetRecord)
                            <tr>
                                {{--<td data-field="state" data-checkbox="true"></td>--}}
                                <td> @if(isset($budgetRecord)) {{ $budgetRecord->description }} @endif </td>
                                <td> @if(isset($budgetRecord)) {{ $budgetRecord->quantity }} @endif </td>
                                <td> @if(isset($budgetRecord)) {{ $budgetRecord->pricePerUnit }} @endif </td>
                                <td> @if(isset($budgetRecord)) {{ "K ".number_format($budgetRecord->cost, "2", ".", ",") }} @endif </td>
                                <td>

                                    <button class="btn btn-default btn-xs btn-danger" type="button" data-toggle="modal" title="Delete" data-target="#deleteModal">
                                        <i class="glyphicon glyphicon glyphicon-trash"></i>
                                    </button>

                                    <button class="btn btn-default btn-xs btn-success" type="button" title="Edit" data-toggle="modal" data-target="#editMemberModal"><i class="glyphicon glyphicon glyphicon-edit"></i></button>

                                {{--<form role="form" method="post" action="{{url('/members/deleteMember/'.$member->member_id)}}">--}}
                                {{--{{csrf_field()}}<!--delete confirmation Modal -->--}}
                                {{--<div class="modal fade" id="deleteModal-{{$member->member_id}}" role="dialog">--}}
                                {{--<div class="modal-dialog modal-sm">--}}
                                {{--<div class="modal-content">--}}
                                {{--<div class="modal-header">--}}
                                {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                                {{--<h4 class="modal-title">Confirmation</h4>--}}
                                {{--</div>--}}
                                {{--<div class="modal-body">--}}
                                {{--<p>Are you sure you want to <strong>delete--}}
                                {{--{{$member->first_name}}</strong> from the system?</p>--}}
                                {{--</div>--}}
                                {{--<div class="modal-footer">--}}
                                {{--<button type="submit" class="btn btn-danger">Yes</button>--}}
                                {{--<button type="button" class="btn btn-primary" data-dismiss="modal">--}}
                                {{--Close--}}
                                {{--</button>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div> <!-- end modal -->--}}
                                {{--</form>--}}

                                <!-- Modal for editing member-->
                                {{--<div class="modal fade" id="editMemberModal-{{$member->member_id}}" role="dialog">--}}
                                {{--<div class="modal-dialog modal-md">--}}
                                {{--<div class="modal-content">--}}
                                {{--<div class="modal-header">--}}
                                {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                                {{--<h4 class="modal-title">Edit Member</h4>--}}
                                {{--</div>--}}
                                {{--<div class="modal-body" style="max-height: 500px;overflow-y: scroll;">--}}
                                {{--<div class="row">--}}
                                {{--<form class="" role="form" method="POST"--}}
                                {{--action="{{ url('/members/update/'.$member->member_id) }}">--}}
                                {{--{!! csrf_field() !!}--}}

                                {{--<div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }} col-md-12 col-sm-12 col-xs-12">--}}

                                {{--<label>First Name</label>--}}
                                {{--<input class="form-control" id="first_name" name="first_name" type="text" value={{$member->first_name}}>--}}
                                {{--@if ($errors->has('first_name'))--}}
                                {{--<span class="help-block">--}}
                                {{--<strong>{{ $errors->first('first_name') }}</strong>--}}
                                {{--</span>--}}
                                {{--@endif--}}
                                {{--</div>--}}
                                {{--<div class="form-group{{ $errors->has('middle_name') ? ' has-error' : '' }} col-md-12 col-sm-12 col-xs-12">--}}

                                {{--<label>Middle Name</label>--}}
                                {{--<input class="form-control" id="middle_name" value="{{$member->middle_name}}" name="middle_name" type="text">--}}
                                {{--@if ($errors->has('middle_name'))--}}
                                {{--<span class="help-block">--}}
                                {{--<strong>{{ $errors->first('middle_name') }}</strong>--}}
                                {{--</span>--}}
                                {{--@endif--}}
                                {{--</div>--}}
                                {{--<div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }} col-lg-12 col-md-12 col-sm-12 col-xs-12">--}}

                                {{--<label>Last Name</label>--}}
                                {{--<input class="form-control" id="last_name" name="last_name" type="text" value="{{$member->last_name}}">--}}
                                {{--@if ($errors->has('last_name'))--}}
                                {{--<span class="help-block">--}}
                                {{--<strong>{{ $errors->first('last_name') }}</strong>--}}
                                {{--</span>--}}
                                {{--@endif--}}
                                {{--</div>--}}
                                {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} col-lg-12 col-md-12 col-sm-12 col-xs-12">--}}

                                {{--<label>Email</label>--}}
                                {{--<input class="form-control" id="email" name="email" type="email" value="{{$member->email }}">--}}
                                {{--@if ($errors->has('email'))--}}
                                {{--<span class="help-block">--}}
                                {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                {{--</span>--}}
                                {{--@endif--}}
                                {{--</div>--}}
                                {{--<div class="form-group{{ $errors->has('year') ? ' has-error' : '' }} col-lg-12 col-md-12 col-sm-12 col-xs-12">--}}

                                {{--<label>Year</label>--}}
                                {{--<input class="form-control" name="year"  value="{{$member->year}}" type="text">--}}
                                {{--@if ($errors->has('year'))--}}
                                {{--<span class="help-block">--}}
                                {{--<strong>{{ $errors->first('year') }}</strong>--}}
                                {{--</span>--}}
                                {{--@endif--}}
                                {{--</div>--}}
                                {{--<div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }} col-lg-12 col-md-12 col-sm-12 col-xs-12">--}}

                                {{--<label>Phone Number</label>--}}
                                {{--<input class="form-control" name="phone_number" type="tel" value="{{$member->phone_number }}">--}}
                                {{--@if ($errors->has('phone_number'))--}}
                                {{--<span class="help-block">--}}
                                {{--<strong>{{ $errors->first('phone_number') }}</strong>--}}
                                {{--</span>--}}
                                {{--@endif--}}
                                {{--</div>--}}
                                {{--<div class="form-group{{ $errors->has('status_id') ? ' has-error' : '' }} col-lg-12 col-md-12 col-sm-12 col-xs-12">--}}

                                {{--<label>Status</label>--}}
                                {{--<select id="ddl3" onchange="dropdowns(this,document.getElementById('ddl4'))" class="form-control" name="status_id">--}}
                                {{--<option name="currentValue" value="{{$member->status_id}}">{{$member->status->status_description}}</option>--}}
                                {{--<option value="">-- select one --</option>--}}
                                {{--<option name="Executive" value="1"> Executive Member</option>--}}
                                {{--<option name="Ordinary" value="2"> Member</option>--}}
                                {{--<option name="Exec Alumni" value="3"> Executive Alumni Member</option>--}}
                                {{--<option name="Ordinary Alumni" value="4"> Alumni Member</option>--}}
                                {{--</select>--}}

                                {{--@if ($errors->has('status_id'))--}}
                                {{--<span class="help-block">--}}
                                {{--<strong>{{ $errors->first('status_id') }}</strong>--}}
                                {{--</span>--}}
                                {{--@endif--}}
                                {{--</div>--}}
                                {{--@if($member->status_id == '1')--}}
                                {{--<div id="position" class="form-group{{ $errors->has('position_id') ? ' has-error' : '' }} col-lg-12 col-md-12 col-sm-12 col-xs-12">--}}

                                {{--<label id="position_label">Position</label>--}}
                                {{--<select id="ddl4" class="form-control" name="position_id">--}}
                                {{--<option name="currentValue" value="{{$member->position_id}}">{{$member->position->position_description}}</option>--}}
                                {{--//Content is loaded from an external JavaScript file--}}
                                {{--</select>--}}
                                {{--@if ($errors->has('position_id'))--}}
                                {{--<span class="help-block">--}}
                                {{--<strong>{{ $errors->first('position_id') }}</strong>--}}
                                {{--</span>--}}
                                {{--@endif--}}
                                {{--</div>--}}

                                {{--@endif--}}

                                {{--<button type="submit" class="btn btn-default btn-primary col-lg-offset-9 col-md-offset-9 col-sm-offset-9 col-xs-offset-7">Save</button>--}}
                                {{--<button type="reset" class="btn btn-default btn-danger pull-right" data-dismiss="modal">Cancel</button>--}}
                                {{--</form>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div> <!-- end modal -->--}}
                                <!-- Modal for editing member ends here-->
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    <!-- Modal for adding new buget items-->
                    <div class="modal fade" id="addBudgetItemModal" role="dialog">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">New Budget Item</h4>
                                </div>
                                <div class="modal-body" style="max-height: 500px;overflow-y: scroll;">
                                    <div class="row">
                                        <form class="" onkeyup="autoUpdate()" role="form" method="POST" action="{{ url('/projectBudget/' .$projects->id) }}" enctype="multipart/form-data">
                                            {!! csrf_field() !!}

                                            <div class="form-group{{ $errors->has('budgetLine') ? ' has-error' : '' }}">
                                                <label for="budgetLine" class="col-md-3">Budget Line</label>
                                                <div class="col-md-8">
                                                    <input id="budgetLine" type="text" class="form-control" name="budgetLine" value="{{ $projects->budget->budgetName }}">
                                                    @if ($errors->has('budgetLine'))
                                                        <span class="help-block"><strong>{{ $errors->first('budgetLine') }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                                                <label for="quantity" class="col-md-3">Quantity</label>
                                                <div class="col-md-8">
                                                    <input id="quantity" placeholder="" type="text" class="form-control" name="quantity" value="{{ old('quantity') }}">
                                                    @if ($errors->has('quantity'))
                                                        <span class="help-block"><strong>{{ $errors->first('quantity') }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('costPerUnit') ? ' has-error' : '' }}">
                                                <label for="costPerUnit" class="col-md-3">Price per Unit | Quantity </label>
                                                <div class="col-md-8">
                                                    <input id="costPerUnit" placeholder="" type="text" class="form-control" name="costPerUnit" value="{{ old('costPerUnit') }}">
                                                    @if ($errors->has('costPerUnit'))
                                                        <span class="help-block"><strong>{{ $errors->first('costPerUnit') }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('cost') ? ' has-error' : '' }}">
                                                <label for="cost" class="col-md-3">Cost (Kwacha)</label>
                                                <div class="col-md-8">
                                                    <input id="cost" placeholder="Enter amount" type="text" class="form-control" name="cost" value="{{ old('cost') }}">
                                                    @if ($errors->has('cost'))
                                                        <span class="help-block"><strong>{{ $errors->first('cost') }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                                <label for="description" class="col-md-3">Description</label>
                                                <div class="col-md-8">
                                                    <textarea id="description" rows="4" class="form-control" name="description"></textarea>
                                                    @if ($errors->has('description'))
                                                        <span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>

                                            {{--<div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">--}}
                                            {{--<label for="comments" class="col-md-3">Comments</label>--}}
                                            {{--<div class="col-md-8">--}}
                                            {{--<input id="comments" type="text" class="form-control" name="comments" value="{{ old('comments') }}">--}}
                                            {{--@if ($errors->has('comments'))--}}
                                            {{--<span class="help-block"><strong>{{ $errors->first('comments') }}</strong></span>--}}
                                            {{--@endif--}}
                                            {{--</div>--}}
                                            {{--</div>--}}

                                            <button type="submit" class="btn btn-default btn-primary col-lg-offset-9 col-md-offset-9 col-sm-offset-9 col-xs-offset-7">Save</button>
                                            <button type="reset" class="btn btn-default btn-danger pull-right" data-dismiss="modal">Cancel</button>
                                        </form>
                                        <script type="text/javascript">
                                            function autoUpdate() {

                                                var quantity = document.getElementById('quantity').value;
                                                var costPerUnit = document.getElementById('costPerUnit').value;
                                                var amount = parseInt(costPerUnit);
                                                var  total =0;
                                                if (quantity && amount ){
                                                    total = quantity * amount;
                                                    document.getElementById('cost').value = total ;
                                                }

                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> <!-- end modal -->

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
                    </script> <!--/. script-->

                    <script>
                        function delete_user(user, man) {
                            var xhttp;
                            if (window.XMLHttpRequest) {
                                xhttp = new XMLHttpRequest();
                            } else {
                                // code for IE6, IE5
                                xhttp = new ActiveXObject("Microsoft.XMLHTTP");
                            }
                            if (confirm("Are you sure you want to delete " + user + "?")) {
                                xhttp.open("GET", "{{url('delete_user')}}/" + man, false);
                                xhttp.send();
                                alert(user + " has been deleted!");
                                location.reload();
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
@endsection