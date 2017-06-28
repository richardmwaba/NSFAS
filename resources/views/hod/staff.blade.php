@extends('layouts.authorized')

@section('title', 'Staff')
@section('heading','Staff Details')

@section('content')
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">staff info</div>

                <div class="panel-body">
                    <table class="table-striped responsive-utilities" data-toggle="table" data-show-refresh="false"
                           data-show-toggle="true" data-show-columns="true" data-search="true"
                           data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name"
                           data-sort-order="desc" style="font-size: small">
                        <thead>
                        <tr>
                            {{--<th data-field="state" data-checkbox="true">Count</th>--}}
                            <th data-field="manNumber" data-sortable="true">Man Number</th>
                            <th data-field="name" data-sortable="true">Name</th>
                            <th data-field="phoneNumber" data-sortable="true">phoneNumber</th>
                            <th data-field="deleteEdit" data-sortable="true">Delete | Edit</th>
                        </tr>
                        </thead>
                        {{--@if(isset($staff))--}}
                        @foreach( $staff as $st)
                        {{--@for($i = 0; $i< count($staff); $i++)--}}
                            <tr>
                                {{--<td data-field="state" data-checkbox="true"></td>--}}
                                <td>
                                    @if(isset($st))
                                        {{ $st->manNumber }}
                                    @endif
                                </td>
                                <td>{{ $st->firstName }} {{ $st->otherName }} {{ $st->lastName }}</td>

                                <td>
                                    @if(isset($st))
                                        {{ $st->phoneNumber }}
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-default btn-xs" href="{{ route('/dltStaff', ['id' => $st->id] ) }}"
                                           type="button" name="toggle" title="delete"><i class="glyphicon glyphicon glyphicon-trash"></i>
                                        </a>

                                        <a href="{{ route('/editStaff', ['id' => $st->id]) }}" class="btn btn-sm btn-link">Edit</a>
                                    </div>
                                </td>
                            </tr>
                        {{--@endfor--}}
                        @endforeach
                        {{--@endif--}}
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