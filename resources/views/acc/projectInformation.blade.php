@extends('layouts.authorized')
@section('title', 'Project | Information')
@section('heading','Projects Information')

@section('content')
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Projects Information</b></div>

                <div class="panel-body">
                    <table class="table-striped responsive-utilities" data-toggle="table" data-show-refresh="false"
                           data-show-toggle="true" data-show-columns="true" data-search="true"
                           data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name"
                           data-sort-order="desc" style="font-size: small">
                        <thead>
                        <tr>
                            <th data-field="ProjectName" data-sortable="true">Project Name</th>
                            <th data-field="projectCoordinator" data-sortable="true">Coordinator</th>
                            <th data-field="department" data-sortable="true">Department</th>
                            {{--<th data-field="description" data-sortable="true">Description</th>--}}
                            <th data-field="proposedBudget" data-sortable="true">Budget</th>
                            <th data-field="projectIncomer" data-sortable="true">Total Income</th>
                            <th data-field="startDate" data-sortable="true">Start Date</th>
                            <th data-field="endDate" data-sortable="true">End date</th>
                            {{--<th data-field="approved" data-sortable="true">Budget Status</th>--}}
                        </tr>
                        </thead>
                        @foreach( $projects as $project)
                            {{--@if($project->budget->approved == 1)--}}
                                <tr>
                                    <td> @if(isset($project)) {{ $project->projectName }} @endif </td>
                                    <td> @if(isset($project)) {{ $project->projectCoordinator }} @endif </td>
                                    <td> @if(isset($project)) {{ $project->departments->departmentName }} @endif </td>
                                    <td>
                                        @if(isset($project->totalAmount->proposedBudget)) {{"K ".number_format($project->totalAmount->proposedBudget, "2", ".", ",")}}
                                        @else
                                            <span style="color: red; ">Budget not submitted</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($project->totalAmount->incomeAcquired)) {{"K ".number_format($project->totalAmount->incomeAcquired, "2", ".", ",")}}
                                        @else
                                            <span style="color: red; ">Awaiting Income</span>
                                        @endif
                                    </td>
                                    <td> @if(isset($project)) {{ $project->startDate }} @endif </td>
                                    <td> @if(isset($project)) {{ $project->endingDate }} @endif </td>
                                    {{--<td> @if(isset($project))--}}
                                            {{--@if($project->budget->approved == 0)--}}
                                                {{--@if(isset($project->totalAmount->incomeAcquired) AND isset($project->totalAmount->proposedBudget))--}}
                                            {{--<div class="btn-group">--}}
                                                {{--<a type="button" href="{{ route('/approvalProjectBudget', ['id' => $project->id]) }}" class="btn btn-sm btn-link"><span style="color: orangered; ">Approve</span></a>--}}
                                            {{--</div>--}}
                                                {{--@else--}}
                                                    {{--@if(!isset($project->totalAmount->incomeAcquired) AND !isset($project->totalAmount->proposedBudget))--}}
                                                        {{--<span style="color: brown; ">Income and Budget not submitted</span>--}}
                                                    {{--@elseif(!isset($project->totalAmount->incomeAcquired) And isset($project->totalAmount->proposedBudget))--}}
                                                        {{--<span style="color: red; ">Add Income</span>--}}
                                                    {{--@elseif(isset($project->totalAmount->incomeAcquired) And !isset($project->totalAmount->proposedBudget))--}}
                                                        {{--<span style="color: red; ">Budget not submitted</span>--}}
                                                    {{--@endif--}}
                                                {{--@endif--}}
                                            {{--@else--}}
                                              {{--<span style="color: darkgreen; ">Approved</span>--}}
                                            {{--@endif--}}
                                        {{--@endif--}}
                                    {{--</td>--}}
                                </tr>
                            {{--@endif--}}
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

@endsection
{{--<script>--}}
{{--$(document).ready(function(){--}}
{{--$("#target").on("show.bs.modal", function(e) {--}}
{{--var id = $(e.relatedTarget).data('target-id');--}}
{{--$.get( "/controller/" + id, function( data ) {--}}
{{--$(".modal-body").html(data.html);--}}
{{--});--}}

{{--});--}}
{{--});--}}
{{--</script>--}}