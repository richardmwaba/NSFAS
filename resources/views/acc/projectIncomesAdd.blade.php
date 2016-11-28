@extends('layouts.authorized')

@section('title', 'Project | Income')
@section('heading','Add an Income for '.$projects->projectName .' project')

@section('content')

    <div class="panel panel-default">
        <div class="row">
            <div class="row">
                <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-11" >
                    <form class="form-horizontal" role="form" style="margin-left: 20px;margin-top: 20px" method="POST"
                          action="{{ url('/projectIncomes/' .$projects->id) }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('amountReceived') ? ' has-error' : '' }}">
                            <label for="amountReceived" class="col-md-3">Amount Received</label>
                            <div class="col-md-8">
                                <input id="amountReceived" placeholder="Enter amount " type="text" class="form-control" name="amountReceived" value="{{ old('amountReceived') }}">
                                @if ($errors->has('amountReceived"'))
                                    <span class="help-block"><strong>{{ $errors->first('amountReceived') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('receivedFrom') ? ' has-error' : '' }}">
                            <label for="receivedFrom" class="col-md-3">Received From</label>
                            <div class="col-md-8">
                                <input id="receivedFrom" type="text" class="form-control" name="receivedFrom" value="{{old('receivedFrom')}}">
                                @if ($errors->has('receivedFrom'))
                                    <span class="help-block"><strong>{{ $errors->first('receivedFrom') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('receiptNumber') ? ' has-error' : '' }}">
                            <label for="receiptNumber" class="col-md-3">Receipt Number</label>
                            <div class="col-md-8">
                                <input id="receiptNumber" type="text" class="form-control" name="receiptNumber" value="{{old('receiptNumber')}}">
                                @if ($errors->has('receiptNumber'))
                                    <span class="help-block"><strong>{{ $errors->first('receiptNumber') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('dateReceived') ? ' has-error' : '' }}">
                            <label for="dateReceived" class="col-md-3">Date Received</label>
                            <div class="col-md-8">
                                <input id="dateReceived" type="date" class="form-control" name="dateReceived" value="{{ old('dateReceived') }}">
                                @if ($errors->has('dateReceived'))
                                    <span class="help-block"><strong>{{ $errors->first('dateReceived') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-4 col-sm-3 col-md-offset-7 col-md-2">
                                <button type="submit" class="btn btn-default">Add</button>
                            </div>
                            <div class="col-xs-4 col-sm-3 col-md-2">
                                <button type="reset" class="btn btn-default pull-right">Cancel</button>
                            </div>
                        </div>
                    </form>
                    <!-- /.form -->
                </div>
            </div>
        </div>
    </div>


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
                                <td> @if(isset($rcd)) k{{ $rcd->amountReceived }}.00 @endif </td>
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