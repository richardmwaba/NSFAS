@extends('layouts.authorized')
@section('title', 'Project | Income')
@section('heading','Incomes for '.$projects->projectName .' project')


@section('content')

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Project Incomes for {{ $projects->projectName }}</div>

                <div class="panel-body">
                    <table class="table-striped responsive-utilities" data-toggle="table" data-show-refresh="false"
                           data-show-toggle="true" data-show-columns="true" data-search="true"
                           data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name"
                           data-sort-order="desc" style="font-size: small">
                        <thead>
                        <tr>
                            <th data-field="state" data-checkbox="true">Count</th>
                            <th data-field="ProjectName" data-sortable="true">Received Amount</th>
                            <th data-field="projectCoordinator" data-sortable="true">Date Received</th>
                            <th data-field="startDate" data-sortable="true">Received From</th>
                            <th data-field="endDate" data-sortable="true">Receipt Number</th>
                        </tr>
                        </thead>
                        @foreach( $incomes as $rcd)
                            <tr>
                                <td data-field="state" data-checkbox="true"></td>
                                <td> @if(isset($rcd)) {{ "K ".number_format($rcd->amountReceived, "2", ".", ",") }} @endif </td>
                                <td> @if(isset($rcd)) {{ $rcd->dateReceived }} @endif </td>
                                <td> @if(isset($rcd)) {{ $rcd->giver }} @endif </td>
                                <td> @if(isset($rcd)) {{ $rcd->receiptNumber }} @endif </td>
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
@endsection