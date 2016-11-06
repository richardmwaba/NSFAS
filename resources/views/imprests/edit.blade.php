@extends('layouts.authorized')
@section('main_content')


    <div class="row">
        <form class="form-vertical" role="form" method="POST" action="{{ url('imprests/update') }}">
            <div class="panel panel-default">
                <div class="panel-heading">Imprest</div>
                <div class="panel-body">
                    {{ csrf_field() }}

                    <div class="row">

                        <div class="col-md-6">
                            <div id="current">


                            </div>

                            <div>
                                <button type="submit" class="btn btn-success">Submit</button>
                                <button type="submit" class="btn btn-danger"> Cancel</button>
                                <input name="id" type="hidden" value="{{$imprest->imprestId}}">
                            </div>

                        </div>


                        <div class=" col-md-6">
                            <div style="max-height: 600px" class="panel panel-default pre-scrollable">
                                <!-- <div class="panel-heading">Imprest</div> !-->
                                <div class="panel-body">

                                    <fieldset class="" id="all" disabled>

                                        <div id="OT">

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
                                                           placeholder="{{$imprest->owner->department->departmentName}}">

                                                    <label for="Subject">Man Number</label>
                                                    <input type="number" class="form-control" name="manNumber"
                                                           value="{{$imprest->applicantId}}"
                                                           placeholder="{{$imprest->applicantId}}">
                                                    <label for="Subject">Names</label>
                                                    <input type="number" class="form-control"
                                                           value="{{$imprest->owner->firstName}}"
                                                           placeholder="{{$imprest->owner->firstName}} {{$imprest->owner->lastName}} {{$imprest->owner->otherName}}">
                                                </div>
                                            </fieldset>


                                            <div class="form-group">
                                                <label for="Date_Sent">Amount of Imprest required </label>
                                                <input type="number" class="form-control" name="amountRequested"
                                                       value="{{$imprest->amountRequested}}"
                                                       placeholder="{{$imprest->amountRequested}}">
                                            </div>

                                            <div class="form-group">

                                                <label for="Copied_To">Budget line</label>

                                                <div id="bL">
                                                    <select class="form-control"
                                                            placeholder="budgetLine"
                                                            name="budgetLine" id="budgetLine">
                                                        <option value="{{$imprest->budget->id}}">{{$imprest->budget->name}}</option>
                                                        @foreach($budgets as $budget)
                                                            <option value="{{$budget->id}}">{{$budget->name}}</option>
                                                        @endforeach

                                                    </select>

                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label for="Copied_To">Purpose</label>
                                                <select class="form-control" value="{{$imprest->purpose}}"
                                                        name="purpose">
                                                    <option value="{{$imprest->item->id}}">{{$imprest->item->description}}</option>
                                                    @foreach($budgets as $budget)
                                                        @foreach($budget->items as $item)
                                                            <option value="{{$item->id}}"
                                                                    placeholder="{{$item->id}}">{{$item->description}}</option>
                                                        @endforeach
                                                    @endforeach
                                                </select>

                                            </div>

                                            <!-- <div class="form-group">
                                                <label for="Copied_To">Purpose</label>
                                                <input type="text" class="form-control" value="" name="purpose" placeholder="Description of use">
                                            </div> -->

                                            <div class="form-group">
                                                <label for="Date_Sent">Date</label>
                                                <input type="text" class="form-control" value="" name="Date_Sent"
                                                       placeholder="{{Carbon\Carbon::parse($imprest->created_at)->diffForHumans()}}">
                                            </div>

                                        </div>

                                        <fieldset id="HD">

                                            <em><h4>The Head of Applicants Unit</h4></em>

                                            <div class="form-group">
                                                <label><input
                                                            onchange="alert('are you sure you want to authorise this imprest?')"
                                                            name="approvedByHead" value="1"
                                                            type="checkbox" <?php if ($imprest->authorisedByHead == true) echo 'checked' ?> >Approve?</label>
                                            </div>

                                            <div class="form-group">
                                                <label for="Copied_To">Comment</label>
                                                <input type="text" class="form-control"
                                                       value="{{$imprest->commentFromHead}}" name="commentFromHead"
                                                       placeholder="Your comment. Leave blank otherwise">
                                            </div>

                                        </fieldset>


                                        <fieldset id="AC" disabled>

                                            <em><h4>The Accountant</h4></em>


                                            <div id="budgetLine" class="form-group">

                                                <label for="Copied_To">Budget Line</label>
                                                <input id="budgetLineD" name="" class="form-control"
                                                       type="text"
                                                       value="{{$imprest->budget->name}}"
                                                       placeholder="{{$imprest->budget->name}}" disabled>
                                            </div>

                                            <div class="form-group">
                                                <a href="#" class="btn btn-link" role="button" data-toggle="modal"
                                                   data-target="#changeBudget" onclick="" id="">Change budget
                                                    line?</a>
                                            </div>
                                            <div id="demo" class="collapse">

                                            </div>


                                            <div class="row">
                                                <div class="form-group">

                                                    <label class="col-md-12 control-label" for="Copied_To">Balance
                                                        of imprest on
                                                        applicants
                                                        account</label>
                                                    <span class="col-md-4 col-md-offset-1 input-group-addon">K</span>
                                                    <input value="@if($imprest->authorisedByDean==1) {{$imprest->imprestBalance}}@else {{$pl = 0}}@endif "
                                                           type="text"
                                                           class="col-md-4"
                                                           name="imprestBalance"
                                                           @if($imprest->busarRecommendation==0)

                                                           {{$pl = $imprest->amountRequested}}

                                                           @else

                                                           {{$pl = $imprest->imprestBalance}}

                                                           @endif placeholder="" disabled>
                                                    <span class="col-md-4 input-group-addon">.00</span>


                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-12 control-label"
                                                           for="Copied_To">Budget</label>
                                                    <span class="col-md-4 col-md-offset-1 input-group-addon">K</span>
                                                    <input value="{{$imprest->item->cost}}"
                                                           placeholder="{{$imprest->item->cost}}" type="number"
                                                           class="col-md-4"
                                                           name="budget" disabled>
                                                    <span class="col-md-4 input-group-addon">.00</span>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-12 control-label" for="Copied_To">Actual
                                                        YTD(K)</label>
                                                    <span class="col-md-4 col-md-offset-1 input-group-addon">K</span>
                                                    <input value="{{$imprest->expenditure->amountPaid}}"
                                                           placeholder="{{$imprest->expenditure->amountPaid}}"
                                                           type="number"
                                                           class="col-md-4" name="actual" disabled>
                                                    <span class="col-md-4 input-group-addon">.00</span>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-12 control-label"
                                                           for="Copied_To">Balance</label>
                                                    <span class="col-md-4 col-md-offset-1 input-group-addon">K</span>
                                                    <input type="number"
                                                           value="{{$imprest->item->cost-$imprest->expenditure->amountPaid}}"
                                                           placeholder="{{$imprest->item->cost-$imprest->expenditure->amountPaid}}"
                                                           class="col-md-4" name="balance" disabled>
                                                    <span class="col-md-4 input-group-addon">.00</span>
                                                </div>

                                            </div>

                                            <div class="form-group form-inline">
                                                <label class="" for="Copied_To"><input type="checkbox" value="1"
                                                                                       class="checkbox"
                                                                                       name="cashAvailable"
                                                                                       <?php if ($imprest->cashAvailable == true) echo 'checked' ?> onchange="alert('Ticking this implies that cash is ready for collection. Do you want to save?')">
                                                    Is cash available? </label>
                                            </div>


                                            <div class="form-group form-inline">
                                                <label class="" for="Copied_To"><input type="checkbox" value="1"
                                                                                       class="checkbox"
                                                                                       name="bursarRecommendation"
                                                                                       placeholder="Description of use"
                                                                                       <?php if ($imprest->bursarRecommendation == true) echo 'checked' ?> onchange="alert('Do you want to save this recommendation?')">
                                                    Recommend this imprest?</label>
                                            </div>

                                            <div class="form-group">
                                                <label for="Copied_To">Comment</label>
                                                <input type="text" class="form-control"
                                                       value="{{$imprest->commentFromBursar}}"
                                                       name="commentFromBursar"
                                                       placeholder="Your comment. Leave blank otherwise">
                                            </div>

                                            <div class="form-group">

                                                <div class="form-group">
                                                    <a href="#" class="btn btn-link" role="button" data-toggle="modal"
                                                       data-target="#cashOut" onclick="" id="">Cash out??</a>
                                                </div>
                                                <div id="demo" class="collapse">

                                                </div>
                                            </div>

                                        </fieldset>

                                        <fieldset id="DN" disabled>
                                            <em><h4>Dean or Director</h4></em>


                                            <div class="form-group">
                                                <label><input name="authorisedByDean"
                                                              onchange="alert('Are you sure you want to authorize this imprest?')"
                                                              value="1"
                                                              type="checkbox" <?php if ($imprest->authorisedByDean == true) echo 'checked' ?>>
                                                    Authorise?</label>
                                            </div>


                                            <div class="form-group">
                                                <label for="Copied_To">Amount Authorised</label>
                                                <input type="number" value="{{$imprest->amountRequested}}"
                                                       class="form-control" name="authorisedAmount"
                                                       placeholder="{{$imprest->amountRequested}}">
                                            </div>


                                            <div class="form-group">
                                                <a style="margin-bottom: 5%" data-toggle="modal" data-target="#comment"
                                                   class="btn btn-link form-control" role="button">Click here to send to
                                                    bursar for recommendation</a>
                                            </div>
                                            <div id="demo" class="collapse">

                                            </div>

                                        </fieldset>
                                    </fieldset>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </form>

        <!-- Send to accountant for recommendation modal -->
        <form class="form-horizontal" role="form" method="POST"
              action="{{url('imprests/recommendation/'.$imprest->imprestId)}}">
            {!! csrf_field() !!}
            <div class="modal fade" id="comment" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button id="close" type="button" class="close"
                                    data-dismiss="modal">&times;</button>
                            <h4 class="modal-title text-primary">Send to bursar for recommendation</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">

                                    <div class="form-group">
                                        <label for="Copied_To">Comment</label>
                                        <input type="text" class="form-control"
                                               value="{{$imprest->commentFromDean}}" name="commentFromDean"
                                               placeholder="Your comment. Leave blank otherwise">
                                    </div>

                                    <input name="id" id="id" type="hidden" value="{{$imprest->imprestId}}">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <div class="col-md- ">

                                    <button type="submit"
                                            class="btn btn-default">send
                                    </button>

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

        <!-- Change budgetLine modal -->
        <form id="newBudgetLineFm" class="form-horizontal" role="form" method="POST"
              action="{{url('/imprests/newBudgetLine/')}}">
            {!! csrf_field() !!}
            <div class="modal fade" id="changeBudget" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button id="closeB" type="button" class="close"
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
                                        <select value="" class="form-control"
                                                placeholder="Password"
                                                name="newBudgetLine"
                                                id="newBudgetLine">
                                            <option value="{{$imprest->budgetLine}}">Select new budget line
                                            </option>
                                            @foreach($budgets as $budget)
                                                <option value="{{$budget->id}}">{{$budget->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <input name="id" id="id" type="hidden" value="{{$imprest->imprestId}}">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <div class="col-md- ">

                                    <button type="submit"
                                            class="btn btn-default">save
                                    </button>

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

        <form id="newBudgetLineFm" class="form-horizontal" role="form" method="POST"
              action="{{url('/imprests/cashOut')}}">
            {!! csrf_field() !!}
            <div class="modal fade" id="cashOut" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button id="closeB" type="button" class="close"
                                    data-dismiss="modal">&times;</button>
                            <h4 class="modal-title text-primary">Cash out</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">

                                    <div class="form-group">
                                        <label>Amount</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">K</span>
                                            <input type="text" name="cost" class="form-control"
                                                   aria-label="Amount (Kwacha)">
                                            <span class="input-group-addon">.00</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Account</label>
                                        <select class="form-control" name="account">
                                            <option>Select an account to withdraw from</option>
                                        </select>

                                    </div>

                                    <div class="form-group">
                                        <label for="Copied_To">Date Outstanding imprest obtained</label>
                                        <input @if($imprest->busarRecommendation == 0){{$d ='date'}} @else {{$d='text'}}@endif type="{{$d}}"
                                               class="form-control" name="dateOutstandingImprest"
                                               placeholder="{{ \Carbon\Carbon::parse($imprest->updated_at)->diffForHumans()}}">
                                    </div>
                                    <input name="id" id="id" type="hidden" value="{{$imprest->imprestId}}">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <div class="col-md- ">

                                    <button type="submit"
                                            class="btn btn-default">save
                                    </button>

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
        function other(v) {

            if (v.value == "other") {
                document.getElementById("bL").innerHTML = "<input class='form-control' type=\"text\" value=\"Enter other budget line\" name=\"budgetLine\" >";
            }

        }

    </script>

    <script>

        function changeBudgetLine() {

            $(document).ready(function () {

                $("#button").click(function () {
                    $("#demo").toggle();

                });
                // process the form
                $('#newBudgetLineFm').submit(function (event) {

                    alert('changed!');
                    event.preventDefault();
                });

                //event.preventDefault();
                $("#closeB").trigger('click');
                $('#budgetLineD').val($('#newBudgetLine :selected').text());//

            });
        }

    </script>


@endsection