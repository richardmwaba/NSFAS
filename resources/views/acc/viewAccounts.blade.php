@extends('layouts.authorized')
@section('title', 'Accounts')
@section('heading','Accounts Info')

@section('content')
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Accounts Details</b></div>
                <div class="panel-body">

                    <div class="panel-body">
                        <div class="btn-group">
                            <a href="{{ route('viewSchoolAccounts') }}" class="btn btn-md btn-link"><i class="fa fa-print fa-fw text-success">
                                </i><span class="text-success">Print</span></a>
                        </div>
                    <table class="table-striped responsive-utilities" data-toggle="table" data-show-refresh="false"
                           data-show-toggle="true" data-show-columns="true" data-search="true"
                           data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name"
                           data-sort-order="desc" style="font-size: small">
                        <thead>
                        <tr>
                            <th data-field="accountsName" data-sortable="true">Account Name</th>
                            {{--<th data-field="budgetLine" data-sortable="true">Budget Line</th>--}}
                            <th data-field="income" data-sortable="true">Total Income</th>
                            <th data-field="expenditures" data-sortable="true">Expenditures</th>
                            <th data-field="balance" data-sortable="true">Balance</th>
                        </tr>
                        </thead>
                        @foreach( $accounts as $account)
                            <tr>
                                <td> @if(isset($account)){{ $account->accountName }} @endif </td>
                                {{--<td> @if(isset($account)){{ $account->budget->budgetName}} @endif </td>--}}
                                <td> @if(isset($account)) K {{ $account->calculatedTotal->incomeAcquired }}.00  @endif </td>
                                <td> @if(isset($account)) K {{ $account->calculatedTotal->expenditureAcquired }}.00  @endif </td>
                                <td> @if(isset($account))
                                        K {{ $account->calculatedTotal->incomeAcquired - $account->calculatedTotal->expenditureAcquired }}.00
                                    @endif </td>
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
