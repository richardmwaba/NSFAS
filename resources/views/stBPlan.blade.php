@extends('layouts.authorized')

@section('title', 'Department Budget | proposal')
@section('heading','Activity Based Work Plan and Budget | Strategic Directions. CAUTION: Add objectives only to Strategic Directions applying to your Department!! ')

@section('content')

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Strategic Directions</div>
                <div class="panel-body">
                    <table class="table-striped responsive-utilities" data-toggle="table" data-show-refresh="false"
                           data-show-toggle="true" data-show-columns="true" data-search="true"
                           data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name"
                           data-sort-order="desc" style="font-size: small">
                        <thead>
                        <tr>
                            <th data-field="state" data-checkbox="true">Count</th>
                            <th data-field="school" data-sortable="true">School</th>
                            <th data-field="strategyName" data-sortable="true">Strategic Directions</th>
                            <th data-field="link" data-sortable="true">Add Objectives</th>
                            <th data-field="moreInfo" data-sortable="true">Objectives more Info</th>
                        </tr>
                        </thead>
                        @foreach( $stBudgetPlan as $plan)
                            <tr>
                                <td data-field="state" data-checkbox="true"></td>
                                <td data-id="{{ $plan->id }}"> @if(isset($plan)) {{ $plan->school->schoolName }} @endif </td>
                                <td data-strategy="{{ $plan->strategy }}"> @if(isset($plan)) {{ $plan->strategy }} @endif </td>
                                <td> @if(isset($plan))
                                        {{--<div class="btn-group">--}}
                                            <a href="#" class="btn-add">add</a>
                                          {{--<button class="btn btn-warning btn-xs btn-detail open-modal" value="{{ $plan->id}}">add</button>--}}
                                        {{--</div>--}}
                                    @endif
                                </td>
                                <td> @if(isset($plan))
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-sm btn-link"><i class="fa fa-info-circle fa-fw text-success">
                                                </i><span class="text-success">More details</span></a></div>
                                    @endif
                                </td>

                            </tr>
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
    <div class="modal fade" tabindex="-1" role="dialog" id="btn-add">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Add an Objective</h4>
                </div>
                <div class="modal-body">
                    {{--<form action="">--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="post-body" >Edit post</label>--}}
                            {{--<textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"
                            id="modal-save">save</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection