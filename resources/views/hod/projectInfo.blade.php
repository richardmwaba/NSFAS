@extends('layouts.authorized')

@section('title', 'Projects')
@section('heading','Projects information')

@section('content')
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">project info</div>

                <div class="panel-body">
                    <table class="table-striped responsive-utilities" data-toggle="table" data-show-refresh="false"
                           data-show-toggle="true" data-show-columns="true" data-search="true"
                           data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name"
                           data-sort-order="desc" style="font-size: small">
                        <thead>
                        <tr>
                            <th data-field="state" data-checkbox="true">Count</th>
                            <th data-field="ProjectName" data-sortable="true">Project Name</th>
                            <th data-field="description" data-sortable="true">Description</th>
                            <th data-field="projectCoordinator" data-sortable="true">Coordinator</th>
                            <th data-field="startDate" data-sortable="true">Start Date</th>
                            <th data-field="endDate" data-sortable="true">End date</th>
                            <th data-field="income" data-sortable="true">Income</th>
                            <th data-field="allocatedBudget" data-sortable="true">Budget</th>
                            @if(Auth::user()->access_level_id != 'OT')
                            <th data-field="approved" data-sortable="true">Budget Status</th>
                            @endif
                            <th data-field="moreInfo" data-sortable="true">More Budget Info</th>
                        </tr>
                        </thead>
                        @foreach( $record as $rcd)
                            <tr>
                                <td data-field="state" data-checkbox="true"></td>
                                <td> @if(isset($rcd)) {{ $rcd->projectName }} @endif </td>
                                <td> @if(isset($rcd)) {{ $rcd->description }} @endif </td>
                                <td> @if(isset($rcd)) {{ $rcd->projectCoordinator }} @endif </td>
                                <td> @if(isset($rcd)) {{ $rcd->startDate }} @endif </td>
                                <td> @if(isset($rcd)) {{ $rcd->endingDate }} @endif </td>
                                <td> @if(isset($rcd->totalAmount->incomeAcquired)) K{{ $rcd->totalAmount->incomeAcquired }}.00 @endif </td>
                                <td> @if(isset($rcd))
                                        @if($rcd->budget->approved  == 0)
                                            @if($rcd->totalAmount->proposedBudget != $rcd->budget->actualProjectBudget)
                                                @if(Auth::user()->access_level_id != 'OT')
                                                <span style="color: red; ">Budget not submitted</span>
                                                @endif
                                            @else
                                                @if(isset($rcd->totalAmount->proposedBudget)) K{{ $rcd->totalAmount->proposedBudget }}.00 @endif
                                            @endif

                                        @endif
                                        @if( $rcd->budget->approved  == 1 )
                                            @if(isset($rcd->totalAmount->proposedBudget)) K{{ $rcd->totalAmount->proposedBudget }}.00 @endif
                                        @else
                                                @if(isset($rcd->totalAmount->proposedBudget))
                                                    @if($rcd->totalAmount->proposedBudget >= $rcd->budget->actualProjectBudget)

                                                    @else
                                                        <div class="btn-group">
                                                            <a href="{{ route('/projectBudget', ['id' => $rcd->id]) }}" class="btn btn-sm btn-link" >Add Budget items</a>
                                                        </div>
                                                    @endif
                                                @endif
                                        @endif
                                     @endif
                                </td>
                                @if(Auth::user()->access_level_id != 'OT')
                                <td> @if(isset($rcd))
                                        @if($rcd->budget->approved == 0)
                                            @if($rcd->totalAmount->proposedBudget == $rcd->budget->actualProjectBudget)
                                                <div class="btn-group">
                                                    <a type="button" href="{{ route('/approvalProjectBudget', ['id' => $rcd->id]) }}" class="btn btn-sm btn-link"><span style="color: orangered; ">Approve</span></a>
                                                </div>
                                            @else


                                                <span style="color: red; ">Budget not submitted</span>

                                            @endif
                                            @if(isset($rcd->totalAmount->incomeAcquired) AND isset($rcd->totalAmount->proposedBudget))

                                            @else
                                                @if(!isset($rcd->totalAmount->incomeAcquired) AND !isset($rcd->totalAmount->proposedBudget))
                                                    <span style="color: brown; ">Income and Budget not submitted</span>
                                                @elseif(!isset($rcd->totalAmount->incomeAcquired) And isset($rcd->totalAmount->proposedBudget))
                                                    <span style="color: red; ">Add Income</span>
                                                @elseif(isset($rcd->totalAmount->incomeAcquired) And !isset($rcd->totalAmount->proposedBudget))
                                                    {{--<span style="color: red; ">Budget not submitted</span>--}}
                                                @endif
                                            @endif
                                        @else
                                            <span style="color: darkgreen; ">Approved</span>
                                        @endif
                                    @endif
                                </td>
                                @endif
                                <td> @if(isset($rcd))
                                        <div class="btn-group">
                                            <a href="{{ route('/projectBudgetDetails', ['id' => $rcd->id]) }}" class="btn btn-sm btn-link"><i class="fa fa-info-circle fa-fw text-success"></i><span class="text-success">More details</span></a>
                                        </div>
                                    @endif
                                </td>
                                {{--@if( $rcd->completed == 1 )--}}
                                    {{--<td class="text-success ">Yes</td>--}}
                                {{--@else--}}
                                    {{--<td class="text-danger"> No</td>--}}
                                {{--@endif--}}
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
    <!-- /.row -->
@endsection

@section('scripts')
    @parent
    <!-- Custom Table JavaScript -->
    <script>
        !function ($) {
            $(document).on("click", "ul.nav li.parent > a > span.icon", function () {
                $(this).find('em:first').toggleClass("glyphicon-minus");
            });
            $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
        }(window.jQuery);

        $(window).on('resize', function () {
            if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
        });
        $(window).on('resize', function () {
            if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
        })
    </script>
    <!-- /.Custom Table JavaScript -->
@endsection