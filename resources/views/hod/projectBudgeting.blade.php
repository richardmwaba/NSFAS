@extends('layouts.authorized')
@section('title', 'project | budgeting')
@section('heading','The '. $records->projectName.' project budgeting. '.
 'Remember that your total budget must be less than or equal to K'.$records->budget->actualProjectBudget.'.00 ')


@section('content')
    <div class="panel panel-default">
        <div class="row">
            <div class="row">
                <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-11" >
                    <form  onkeyup="autoUpdate();" class="form-horizontal" role="form" style="margin-left: 20px;margin-top: 20px" method="POST"
                          action="{{ url('/projectBudget/' .$records->id) }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('budgetLine') ? ' has-error' : '' }}">
                            <label for="budgetLine" class="col-md-3">Budget Line</label>
                            <div class="col-md-8">
                                <input id="budgetLine" readonly type="text" class="form-control" name="budgetLine" value="{{ $records->budget->budgetName }}">
                                @if ($errors->has('budgetLine'))
                                    <span class="help-block"><strong>{{ $errors->first('budgetLine') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                            <label for="quantity" class="col-md-3">Quantity</label>
                            <div class="col-md-8">
                                <input id="quantity" placeholder="" type="text" class="form-control" name="quantity" value="{{ old('quantity') }}">
                                @if ($errors->has('quantity'))
                                    <span class="help-block"><strong>{{ $errors->first('quantity') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('costPerUnit') ? ' has-error' : '' }}">
                            <label for="costPerUnit" class="col-md-3">Price per Unit | Quantity </label>
                            <div class="col-md-8">
                                <input id="costPerUnit" placeholder="" type="text" class="form-control" name="costPerUnit" value="{{ old('costPerUnit') }}">
                                @if ($errors->has('costPerUnit'))
                                    <span class="help-block"><strong>{{ $errors->first('costPerUnit') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('cost') ? ' has-error' : '' }}">
                            <label for="cost" class="col-md-3">Cost (Kwacha)</label>
                            <div class="col-md-8">
                                <input id="cost" placeholder="Enter amount" type="text" class="form-control" name="cost" value="{{ old('cost') }}">
                                @if ($errors->has('cost'))
                                    <span class="help-block"><strong>{{ $errors->first('cost') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-3">Description</label>
                            <div class="col-md-8">
                                <textarea id="description" rows="4" class="form-control" name="description"></textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        {{--<div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">--}}
                            {{--<label for="comments" class="col-md-3">Comments</label>--}}
                            {{--<div class="col-md-8">--}}
                                {{--<input id="comments" type="text" class="form-control" name="comments" value="{{ old('comments') }}">--}}
                                {{--@if ($errors->has('comments'))--}}
                                    {{--<span class="help-block"><strong>{{ $errors->first('comments') }}</strong></span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

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

            var quantity = document.getElementById('quantity').value;
            var costPerUnit = document.getElementById('costPerUnit').value;
            var amount = parseInt(costPerUnit);
             var  total =0;
            if (quantity && amount ){
                total = quantity * amount;
                document.getElementById('cost').value = total ;
            }

        }
    </script>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><div style="color: red" class="text-justify">TOTAL BUDGET : <span>K{{ $total->proposedBudget }}.00</span> </div> </div>
                <div class="panel-body">
                    <table class="table-striped responsive-utilities" data-toggle="table" data-show-refresh="false"
                           data-show-toggle="true" data-show-columns="true" data-search="true"
                           data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name"
                           data-sort-order="desc" style="font-size: small">
                        <thead>
                        <tr>
                            <th data-field="state" data-checkbox="true">Count</th>
                            <th data-field="ProjectName" data-sortable="true">Budget Line</th>
                            <th data-field="projectCoordinator" data-sortable="true">Description</th>
                            <th data-field="quantity" data-sortable="true">Quantity</th>
                            <th data-field="priceUnit" data-sortable="true">Price per Unit/Quantity</th>
                            <th data-field="cost" data-sortable="true">Cost</th>
                            <th data-field="deleteEdit" data-sortable="true">Edit</th>
                        </tr>
                        </thead>
                        @foreach( $items as $item)
                            <tr>
                                <td data-field="state" data-checkbox="true"></td>
                                <td> @if(isset($item)) {{ $item->budgetLine }} @endif </td>
                                <td> @if(isset($item)) {{ $item->description }} @endif </td>
                                <td> @if(isset($item)) {{ $item->quantity }} @endif </td>
                                <td> @if(isset($item)) {{ $item->pricePerUnit }} @endif </td>
                                <td> @if(isset($item)) k{{ $item->cost }}.00 @endif </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('/editStaff', ['id' => $item->id]) }}" class="btn btn-sm btn-link">Edit</a>
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