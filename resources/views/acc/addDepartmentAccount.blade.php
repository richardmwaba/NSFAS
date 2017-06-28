@extends('layouts.authorized')

@section('title', 'Add | Account')
@section('heading','Add an account')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST"
                  action="{{ url('/saveDepartmentAccount') }}">
                {!! csrf_field() !!}
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12" >
                        <div class="form-group{{ $errors->has('departmentName') ? ' has-error' : '' }}">
                            <label for="departmentName" class="col-md-2 col-sm-4">Department Name:</label>
                            <div class="col-md-10 col-sm-8">
                                <select class="form-control" name="departmentName" id="departmentName">
                                    <option value="">-- Select a department to add an account to from this list --</option>
                                    @if(isset($departments))
                                        @foreach( $departments as $st)
                                            <option value="{{ $st->id}}">{{ $st->departmentName }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('departmentName'))
                                    <span class="help-block"><strong>{{ $errors->first('departmentName') }}</strong></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /.col-lg-md-sm-xs -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <div class="col-lg-11 col-md-11 col-sm-10  col-xs-9 ">
                                <button type="submit" class="btn btn-sm btn-success pull-right">Add</button>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-3">
                                <button type="reset" class="btn btn-sm btn-danger pull-right">Cancel</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-lg-md-sm-xs-12 -->
                </div>
                <!-- /.row -->

            </form>
            <!-- /.form -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel /.panel-default -->

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Recently Added Accounts</b></div>
                <div class="panel-body">
                    <table class="table-striped responsive-utilities" data-toggle="table" data-show-refresh="false"
                           data-show-toggle="true" data-show-columns="true" data-search="true"
                           data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name"
                           data-sort-order="desc" style="font-size: small">
                        <thead>
                        <tr>
                            {{--<th data-field="state" data-checkbox="true">Count</th>--}}
                            <th data-field="accountName" data-sortable="true">Account Name</th>
                            <th data-field="amount" data-sortable="true">Total Amount Received</th>
                            <th data-field="createdBy" data-sortable="true">Account Created By</th>
                            {{--<th data-field="editDelete" data-sortable="true">Edit / Delete</th>--}}
                        </tr>
                        </thead>
                        @if(isset($records))
                            @foreach( $records as $rcd)
                                <tr>
                                    {{--<td data-field="state" data-checkbox="true"></td>--}}
                                    <td> @if(isset($rcd)) {{ $rcd->accountName }} @endif </td>
                                    <td> @if(isset($rcd)) K {{ $rcd->calculatedTotal->incomeAcquired }}.00 @endif </td>
                                    <td> @if(isset($rcd)) {{ $rcd->user->firstName }} {{ $rcd->user->otherName }} {{ $rcd->user->lastName }}@endif </td>
                                    {{--<td>--}}
                                        {{--<div class="btn-group">--}}
                                            {{--<a href="{{ route('/editStaff', ['id' => $rcd->id]) }}" class="btn btn-sm btn-link">Edit</a>--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                </tr>
                            @endforeach
                        @endif
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
    <!-- /.row -->
@endsection
