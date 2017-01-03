@extends('layouts.authorized')
@section('main_content')

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">Imprest Reports</div>

                <div class="panel-body">

    <table class="table table-striped responsive-utilities" data-toggle="table" data-show-refresh="false"
           data-show-toggle="true" data-show-columns="true" data-search="true"
           data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name"
           data-sort-order="desc" style="font-size: small">

        <thead>
        <tr>
            <!--<th data-field="state" data-checkbox="true">Count</th>-->
            <th data-field="budget" data-sortable="true">Project Name</th>
            <th data-field="department" data-sortable="true">Department</th>
            <th data-field="renew by" data-sortable="true">Renew By</th>
            <th data-field="startDate" data-sortable="true">Last Withdraw Date</th>
            <th data-field="endDate" data-sortable="true">Project End Date</th>
            <th data-sortable="true">Print</th>
        </tr>
        </thead>

        @foreach( $imprests as $rcd)
            <tr>
                <td> @if(isset($rcd)) {{ $rcd->projectName }} @endif </td>
                <td> @if(isset($rcd)) {{ $rcd->department }} @endif </td>
                <td> @if(isset($rcd)) {{ $rcd->projectCoordinator }} @endif </td>
                <td> @if(isset($rcd)) {{ $rcd->startDate }} @endif </td>
                <td> @if(isset($rcd)) {{ $rcd->endingDate }} @endif </td>

                <td>
                    <div class="btn-group">
                        <a href="{{ route('/projectsPDF/getPdf'. $projects->id) }}" class="btn btn-sm btn-link"><i class="fa fa-info-circle fa-fw text-success"></i><span class="text-success">Print</span></a>
                    </div>

        @endforeach
    </table>


    <!--/. script-->


    </div>
    <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <!-- /#page-wrapper -->

    <!-- Custom Table JavaScript -->

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
    </script>

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