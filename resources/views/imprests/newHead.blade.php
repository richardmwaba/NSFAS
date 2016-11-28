@extends('layouts.authorized')
@section('main_content')


    <div class="row">
        <form class="form-vertical" role="form" method="POST" action="{{ url('imprests/create') }}">
            <div class="panel panel-default">
                <div class="panel-heading">Imprest</div>
                <div class="panel-body">
                    {{ csrf_field() }}

                    <div class="row">
                        <form role="form">

                            <div class="col-sm-6 col-md-6">
                                <div id="current">


                                </div>

                                <div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <button type="submit" class="btn btn-danger"> Cancel</button>
                                </div>

                            </div>


                            <div class="col-sm-6 col-md-6">
                                <div style="height: 800px;" class="panel panel-default pre-scrollable">
                                    <!-- <div class="panel-heading">Imprest</div> !-->
                                    <div class="panel-body">


                                        <fieldset id="all" disabled>

                                            <em><h4>The Head of Applicants Unit</h4></em>

                                            <div id="HD">

                                                <em><h4>The Applicant</h4></em>


                                                <!-- <div class="form-group">
                                                     <label for="Copied_To">Name</label>
                                                     <select class="form-control" value="" name="imprestId">
                                                         foreach($imprests as $imprests)
                                                         <option>{$imprests->purpose}}</option>
                                                     </select>
                                                     endforeach
                                                 </div>

                                                 -->

                                                <fieldset disabled>
                                                    <div class="form-group">
                                                        <label for="From">Department</label>
                                                        <!-- Add school, unit or dept accroding to form from acccounts-->
                                                        <input type="text" class="form-control" value=""
                                                               name="department"
                                                               placeholder="{{Auth::user()->department->departmentName}}">

                                                        <label for="Subject">Man Number</label>
                                                        <input type="number" class="form-control" name="manNumber"
                                                               value="{{Auth::user()->manNumber}}"
                                                               placeholder="">
                                                        <label for="Subject">Names</label>
                                                        <input type="text" class="form-control"
                                                               value="{{Auth::user()->firstName}}"
                                                               placeholder="{{Auth::user()->firstName}} {{Auth::user()->otherName}} {{Auth::user()->lastName}}">
                                                    </div>
                                                </fieldset>


                                                <div class="form-group">
                                                    <label for="Date_Sent">Amount of Imprest required </label>
                                                    <input type="number" class="form-control" name="amount"
                                                           placeholder="Enter amount here">
                                                </div>

                                                <select class="form-control"
                                                        placeholder="Password"
                                                        name="budgetLine" id="budgetLine">
                                                    <option>Select a budget line</option>
                                                    @foreach($budgets as $budget)
                                                        <option value="{{$budget->id}}">{{$budget->name}}</option>
                                                        <option>Other</option>
                                                    @endforeach

                                                </select>

                                                <div class="form-group">
                                                    <label for="Copied_To">Purpose</label>
                                                    <select class="form-control"
                                                            name="purpose">
                                                        @foreach($budgets as $budget)
                                                            @foreach($budget->items as $item)
                                                                <option value="{{$item->item_id}}"
                                                                        placeholder="{{$item->item_id}}">{{$item->description}}</option>
                                                            @endforeach
                                                        @endforeach
                                                        <option value="">Other</option>
                                                    </select>

                                                </div>

                                                <!-- <div class="form-group">
                                                    <label for="Copied_To">Purpose</label>
                                                    <input type="text" class="form-control" value="" name="purpose" placeholder="Description of use">
                                                </div> -->

                                            </div>

                                            <div class="form-group">
                                                <label><input name="approvedByHead" value="1"
                                                              type="checkbox" checked>Approve?</label>
                                            </div>

                                            <div class="form-group">
                                                <label for="Copied_To">Comment</label>
                                                <input type="text" class="form-control"
                                                       value="" name="commentFromHead"
                                                       placeholder="Your comment. Leave blank otherwise">
                                            </div>

                                        </fieldset>


                                        <fieldset id="AC" disabled>

                                            <em><h4>The Accountant</h4></em>


                                            <div id="budgetLine" class="form-group">

                                                <label for="Copied_To">Budget Line</label>
                                                <input id="budgetLineD" name="budgetLine" class="form-control"
                                                       type="text"
                                                       value="">
                                            </div>

                                            <div class="form-group">
                                                <a href="#" class="btn btn-link" role="button" data-toggle="modal"
                                                   data-target="#changePass" onclick="" id="">Change budget
                                                    line?</a>
                                            </div>
                                            <div id="demo" class="collapse">

                                            </div>


                                            <!-- Change password modal -->
                                            <form id="budgetLine" class="form-horizontal" role="form">
                                                {!! csrf_field() !!}
                                                <div class="modal fade" id="changePass" role="dialog">
                                                    <div class="modal-dialog modal-md">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button id="close" type="button" class="close"
                                                                        data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title text-primary">New budget
                                                                    line</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">

                                                                        <div id="budgetLine"
                                                                             class="form-group">
                                                                            <label>Budget line</label>
                                                                            <select class="form-control"
                                                                                    placeholder="Password"
                                                                                    name="newBudgetLine"
                                                                                    id="newBudgetLine" type="">
                                                                                <option>Select new budget line</option>

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <div class="col-md- ">

                                                                        <a onclick="changeBudgetLine()"
                                                                           class="btn btn-default">save
                                                                        </a>

                                                                        <!--</div>
                                                                        <div class="">-->
                                                                        <button type="reset"
                                                                                class="btn btn-default">Cancel
                                                                        </button>
                                                                    </div>

                                                                    <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.Change password modal-->
                                            </form>

                                            <div class="row">
                                                <div class="form-group">

                                                    <label class="col-md-12 control-label" for="Copied_To">Balance of
                                                        imprest on
                                                        applicants
                                                        account</label>
                                                    <span class="col-md-4 col-md-offset-1 input-group-addon">K</span>
                                                    <input value="" type="text" class="col-md-4"
                                                           name="Copied_To">
                                                    <span class="col-md-4 input-group-addon">.00</span>


                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-12 control-label"
                                                           for="Copied_To">Budget</label>
                                                    <span class="col-md-4 col-md-offset-1 input-group-addon">K</span>
                                                    <input value="" type="number" class="col-md-4"
                                                           name="Copied_To">
                                                    <span class="col-md-4 input-group-addon">.00</span>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-12 control-label" for="Copied_To">Actual
                                                        YTD(K)</label>
                                                    <span class="col-md-4 col-md-offset-1 input-group-addon">K</span>
                                                    <input value=""
                                                           placeholder="" type="number"
                                                           class="col-md-4" name="Copied_To">
                                                    <span class="col-md-4 input-group-addon">.00</span>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-12 control-label"
                                                           for="Copied_To">Balance</label>
                                                    <span class="col-md-4 col-md-offset-1 input-group-addon">K</span>
                                                    <input type="number"
                                                           value=""
                                                           placeholder=""
                                                           class="col-md-4" name="Copied_To">
                                                    <span class="col-md-4 input-group-addon">.00</span>
                                                </div>

                                            </div>

                                            <div class="form-group form-inline">
                                                <label class="" for="Copied_To"><input type="checkbox" value="1"
                                                                                       class="checkbox"
                                                                                       name="cashAvailable"> Is cash
                                                    available? </label>
                                            </div>


                                            <div class="form-group form-inline">
                                                <label class="" for="Copied_To"><input type="checkbox" value="1"
                                                                                       class="checkbox"
                                                                                       name="bursarRecommendation"
                                                                                       placeholder="Description of use">
                                                    Recommend this imprest?</label>
                                            </div>

                                            <div class="form-group">
                                                <label for="Copied_To">Comment</label>
                                                <input type="text" class="form-control" value=""
                                                       name="commentFromBursar"
                                                       placeholder="Your comment. Leave blank otherwise">
                                            </div>

                                            <div class="form-group">
                                                <label for="Copied_To">Date Outstanding imprest obtained</label>
                                                <input type="date">
                                            </div>

                                        </fieldset>

                                        <fieldset id="DN" disabled>
                                            <em><h4>Dean or Director</h4></em>


                                            <div class="form-group">
                                                <label><input name="authorisedByDean" value="1" type="checkbox">
                                                    Authorise?</label>
                                            </div>


                                            <div class="form-group">
                                                <label for="Copied_To">Amount Authorised</label>
                                                <input type="number" value="" class="form-control"
                                                       name="authorisedAmount"
                                                       placeholder="">
                                            </div>

                                            <div class="form-group">
                                                <label for="Copied_To">Comment</label>
                                                <input type="text" class="form-control" value="" name="commentFromDean"
                                                       placeholder="Your comment. Leave blank otherwise">
                                            </div>

                                        </fieldset>
                                        </fieldset>


                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <script type="text/javascript">

                window.onload = function () {
                    if (window.jQuery) {
                        // jQuery is loaded
                        document.getElementById("current").innerHTML = document.getElementById("{{Auth::user()->accessLevelId}}").innerHTML;
                        document.getElementById("{{Auth::user()->accessLevelId}}").innerHTML = '';

                    } else {
                        location.reload();
                    }
                }

            </script>

            <script type="text/javascript">
                function other() {

                    alert('Hi');
                    var v = " <input type=\"text\" class=\"form-control\" name=\"Copied_To\" placeholder=\"Description of use\"> ";

                    document.getElementById("current").innerHTML = v;

                }

            </script>

            <script>

                function changeBudgetLine() {

                    document.getElementById("budgetLineD").value = document.getElementById().value;

                }

            </script>

        </form>
    </div>



@endsection