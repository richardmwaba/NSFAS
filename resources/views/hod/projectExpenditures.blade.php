@extends('layouts.authorized')
@section('title', 'Project | Expenditures')
@section('heading','Projects Expenditures')

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
                            {{--<th data-field="state" data-checkbox="true">Count</th>--}}
                            <th data-field="ProjectName" data-sortable="true">Project Name</th>
                            <th data-field="projectCoordinator" data-sortable="true">Coordinator</th>
                            @if(Auth::user()->access_level_id != 'OT')
                            <th data-field="department" data-sortable="true">Department</th>
                            @endif
                            <th data-field="description" data-sortable="true">Description</th>
                            <th data-field="Budget" data-sortable="true">Budget</th>
                            <th data-field="expenditure" data-sortable="true">Expenditure</th>
                            <th data-field="expenditureStatus" data-sortable="true">Status</th>
                            <th data-field="info" data-sortable="true">More Info</th>
                            <th data-field="startDate" data-sortable="true">Start Date</th>
                            <th data-field="endDate" data-sortable="true">End date</th>
                        </tr>
                        </thead>
                        @foreach( $projects as $project)
                            {{--@if($project->budget->approved == 1)--}}
                            <tr>
                                {{--<td data-field="state" data-checkbox="true"></td>--}}
                                <td> @if(isset($project)) {{ $project->projectName }} @endif </td>
                                <td> @if(isset($project)) {{ $project->projectCoordinator }} @endif </td>
                                @if(Auth::user()->access_level_id != 'OT')
                                <td> @if(isset($project)) {{ $project->departments->departmentName }} @endif </td>
                                @endif
                                <td> @if(isset($project)){{ $project->description }} @endif </td>
                                <td> @if(isset($project)) K{{ $project->budget->actualProjectBudget }}.00 @endif </td>
                                <td> @if(isset($project))
                                        @if(Auth::user()->access_level_id == 'HD')
                                           @foreach($project->expenditures() as $expend)
                                            @if(isset($project))
                                                @if($expend->approvedByHOD == 0)
                                                    <div class="btn-group">
                                                        <a href="{{ route('/requestApproval', ['id' => $project->id]) }}" class="btn btn-sm btn-link"><i class="fa fa- fa-fw text-success"></i><span class="text-success">Approve</span></a>
                                                    </div>
                                                @else
                                                    @if($expend->approvedByDN == 1)
                                                        <span style="color: green; ">Dean has approved</span>
                                                    @else
                                                        <span style="color: green; ">Awaiting Deans approval</span>
                                                    @endif
                                                @endif
                                            @else
                                                <span style="color: orangered; ">No request sent</span>
                                            @endif
                                            @endforeach
                                        @elseif(Auth::user()->access_level_id == 'AC')

                                        @elseif(Auth::user()->access_level_id == 'DN')

                                        @else
                                            <div class="btn-group">
                                                <a href="{{ route('/requestForMoney', ['id' => $project->id]) }}" class="btn btn-sm btn-link"><i class="fa fa-money fa-fw text-success"></i><span class="text-success">Request</span></a>
                                            </div>
                                        @endif
                                     {{--@endif--}}
                                </td>
                                 <td>
                                     @if(Auth::user()->access_level_id == 'HD')

                                         @if(isset($project->expenditures->amountPaid))
                                             @if($project->expenditures->approvedByHOD == 0)
                                                 <span style="color: red; ">Awaiting your approval</span>
                                             @else
                                                 @if($project->expenditures->approvedByDN == 1)
                                                     <span style="color: green; ">Dean has approved</span>
                                                 @else
                                                     <span style="color: green; ">You have approved</span>
                                                 @endif
                                             @endif
                                         @else
                                             <span style="color: orangered; ">No request sent</span>
                                         @endif

                                     @elseif(Auth::user()->access_level_id == 'DN')


                                     @elseif(Auth::user()->access_level_id == 'AC')

                                     @endif
                                 </td>
                                @endif
                                <td> @if(isset($project))
                                        <div class="btn-group">
                                            <a href="{{ route('/projectBudgetDetails', ['id' => $project->id]) }}" class="btn btn-sm btn-link"><i class="fa fa-info-circle fa-fw text-success"></i><span class="text-success">More details</span></a>
                                        </div>
                                     @endif
                                </td>
                                <td> @if(isset($project)){{$project->startDate}} @endif </td>
                                <td> @if(isset($project)){{$project->endingDate  }}@endif </td>
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
