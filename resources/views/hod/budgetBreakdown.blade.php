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
                        </tr>
                        </thead>
                        @foreach( $budgetRecords as $budgetRecord)
                            <tr>
                                {{--<td data-field="state" data-checkbox="true"></td>--}}
                                <td> @if(isset($budgetRecord)) {{ $budgetRecord->description }} @endif </td>
                                <td> @if(isset($budgetRecord)) {{ $budgetRecord->quantity }} @endif </td>
                                <td> @if(isset($budgetRecord)) {{ $budgetRecord->pricePerUnit }} @endif </td>
                                <td> @if(isset($budgetRecord)) {{ "K ".number_format($budgetRecord->cost, "2", ".", ",") }} @endif </td>
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