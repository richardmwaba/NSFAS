@extends('layouts.authorized')

@section('title', 'add | Projects')
@section('heading','Add a project')

@section('content')
    <div class="panel panel-default">
        <div class="row">
            <div class="row">
                <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-11" >
                    <form   onkeyup="autoUpdate();" class="form-horizontal" role="form" style="margin-left: 20px;margin-top: 20px" method="POST"
                          action="{{ url('/addProject') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('projectName') ? ' has-error' : '' }}">
                            <label for="projectName" class="col-md-3">Project Name</label>
                            <div class="col-md-8">
                                <input id="projectName" placeholder="Project name" type="text" class="form-control" name="projectName" value="{{ old('projectName') }}">
                                @if ($errors->has('projectName'))
                                    <span class="help-block"><strong>{{ $errors->first('projectName') }}</strong></span>
                                @endif
                            </div>
                        </div>

                    @if(Auth::user()->access_level_id == 'OT')
                            <div class="form-group{{ $errors->has('projectCoordinator') ? ' has-error' : '' }}">
                                <label for="projectCoordinator" class="col-md-3">Project Coordinator</label>
                                <div class="col-md-8">
                                    <input id="projectCoordinator" type="text" class="form-control" name="projectCoordinator"
                                           value="{{ Auth::user()->firstName }} {{ Auth::user()->otherName }} {{ Auth::user()->lastName }}">
                                    @if ($errors->has('projectCoordinator'))
                                        <span class="help-block"><strong>{{ $errors->first('projectCoordinator') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="form-group{{ $errors->has('projectCoordinator') ? ' has-error' : '' }}">
                                <label for="projectCoordinator" class="col-md-3">Project Coordinator</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="projectCoordinator" id="projectCoordinator">
                                        <option value="">- Select coordinator -</option>
                                        @foreach( $staff as $st)
                                            <option value="{{ $st->firstName }} {{ $st->otherName }} {{ $st->lastName }}">{{ $st->firstName }}
                                                {{ $st->otherName }} {{ $st->lastName }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('projectCoordinator'))
                                        <span class="help-block"><strong>{{ $errors->first('projectCoordinator') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-3">Description</label>
                            <div class="col-md-8">
                                <textarea id="description" rows="3" class="form-control" name="description"></textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('netProjectBudget') ? ' has-error' : '' }}">
                            <label for="netProjectBudget" class="col-md-3">Net Project Budget</label>
                            <div class="col-md-8">
                                <input id="netProjectBudget" placeholder="Enter Net Project Budget" type="text" class="form-control" name="netProjectBudget" value="{{ old('netProjectBudget') }}">
                                @if ($errors->has('netProjectBudget'))
                                    <span class="help-block"><strong>{{ $errors->first('netProjectBudget') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('departmentPercentage') ? ' has-error' : '' }}">
                            <label for="departmentPercentage" class="col-md-3">Department Percentage</label>
                            <div class="col-md-8">
                                <input id="departmentPercentage" placeholder="Enter percentage" type="text" class="form-control"
                                       name="departmentPercentage" value="{{ old('departmentPercentage') }}">
                                @if ($errors->has('departmentPercentage'))
                                    <span class="help-block"><strong>{{ $errors->first('departmentPercentage') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('unzaPercentage') ? ' has-error' : '' }}">
                            <label for="unzaPercentage" class="col-md-3">UNZA Percentage</label>
                            <div class="col-md-8">
                                <input id="unzaPercentage" placeholder="Enter percentage" type="text" class="form-control"
                                       name="unzaPercentage" value="{{ old('unzaPercentage') }}">
                                @if ($errors->has('unzaPercentage'))
                                    <span class="help-block"><strong>{{ $errors->first('unzaPercentage') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('actualProjectBudget') ? ' has-error' : '' }}">
                            <label for="actualProjectBudget" class="col-md-3">Actual Project Budget</label>
                            <div class="col-md-8">
                                <input id="actualProjectBudget" placeholder="Actual project Budget" type="text" class="form-control" name="actualProjectBudget" value="{{ old('actualProjectBudget') }}">
                                @if ($errors->has('actualProjectBudget'))
                                    <span class="help-block"><strong>{{ $errors->first('actualProjectBudget') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('startDate') ? ' has-error' : '' }}">
                            <label for="startDate" class="col-md-3">Start Date</label>
                            <div class="col-md-8">
                                <input id="startDate" type="date" class="form-control" name="startDate" value="">
                                @if ($errors->has('startDate'))
                                    <span class="help-block"><strong>{{ $errors->first('startDate') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('endDate') ? ' has-error' : '' }}">
                            <label for="endDate" class="col-md-3">End Date</label>
                            <div class="col-md-8">
                                <input id="endDate" type="date" class="form-control" name="endDate" value="">
                                @if ($errors->has('startDate'))
                                    <span class="help-block"><strong>{{ $errors->first('endDate') }}</strong></span>
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

    <script type="text/javascript">
        function autoUpdate() {

            var netProjectBudget = document.getElementById('netProjectBudget').value;
            var net_project_budget = parseInt(netProjectBudget);
            var departmentPercentage = document.getElementById('departmentPercentage').value;
            var unzaPercentage = document.getElementById('unzaPercentage').value;

            if (departmentPercentage && unzaPercentage){

                var dPercentage = (departmentPercentage/100) * net_project_budget;
                var uPercentage = (unzaPercentage/100) * net_project_budget;
                if(dPercentage != 0 && uPercentage !=0){
                    var actualProjectBudget = net_project_budget - (dPercentage + uPercentage );
                    if (actualProjectBudget ){
                        document.getElementById('actualProjectBudget').value = actualProjectBudget;
                    }
                }
            }
        }
    </script>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added projects</div>

                <div class="panel-body">
                    <table class="table-striped responsive-utilities" data-toggle="table" data-show-refresh="false"
                           data-show-toggle="true" data-show-columns="true" data-search="true"
                           data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name"
                           data-sort-order="desc" style="font-size: small">
                        <thead>
                        <tr>
                            {{--<th data-field="state" data-checkbox="true">Count</th>--}}
                            <th data-field="ProjectName" data-sortable="true">Project Name</th>
                            <th data-field="projectCoordinator" data-sortable="true">Project Coordinator</th>
                            <th data-field="startDate" data-sortable="true">Start Date</th>
                            <th data-field="endDate" data-sortable="true">End date</th>
                            <th data-field="deleteEdit" data-sortable="true">Edit</th>
                        </tr>
                        </thead>
                        @foreach( $projects as $rcd)
                            <tr>
                                {{--<td data-field="state" data-checkbox="true"></td>--}}
                                <td> @if(isset($rcd)) {{ $rcd->projectName }} @endif </td>
                                <td> @if(isset($rcd)) {{ $rcd->projectCoordinator }} @endif </td>
                                <td> @if(isset($rcd)) {{ $rcd->startDate }} @endif </td>
                                <td> @if(isset($rcd)) {{ $rcd->endingDate }} @endif </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('/editStaff', ['id' => $rcd->id]) }}" class="btn btn-sm btn-link">Edit</a>
                                    </div>
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