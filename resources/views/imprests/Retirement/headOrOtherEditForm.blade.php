@extends('layouts.authorized')
@section('main_content')


    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">retirement retirement</div>
            <div class="panel-body">

                <details class="form-group" id="details">
                    <summary>Click here to view retirement details</summary>
                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading">retirement details</div>
                            <div class="panel-body">

                                <div id="applicantInfo">
                                    <form  style="margin-left:10px;max-height:8px;margin-left: 20px;margin-top:20px;" class="form-horizontal" role="form">

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Department</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">{{$retirement->imprest->owner->department->departmentName}}</label>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4"
                                                   for="first-name">Name</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">{{$retirement->imprest->owner->firstName}} {{$retirement->imprest->owner->lastName}} {{$retirement->imprest->owner->otherName}}</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Amount
                                                of retirement advanced</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">K {{$retirement->imprest->authorisedAmount}}</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Cheque
                                                No</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">{{$retirement->imprest->chequeNumber}}</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Date
                                                obtained</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">
                                                    @if($retirement->imprest->expenditure!=null)
                                                    {{\Carbon\Carbon::parse($retirement->imprest->expenditure->created_at)->toFormattedDateString()}}
                                                        @endif
                                                </label>
                                            </div>
                                        </div>

                                    </form>
                                </div>


                            </div>


                        </div>
                    </div>
                </details>

                <form class="form-vertical" role="form" method="POST" action="{{ url('/imprests/retirement/confirm') }}">
                    {{ csrf_field() }}
                    <div id="current">
                        <fieldset id="OT">
                            <em><h4>Subsistance allowance</h4></em>

                            <div class="row">
                                <details class=" form-group col-md-12">
                                    <summary>Click here to include subsistence allowance details if applicable</summary>
                                    <input type="hidden" name="imprestId" value="{{$id}}">
                                    <input type="hidden" name="id" value="{{$id}}">
                                    <input type="hidden" name="chequeNumber" value="{{$retirement->imprest->chequeNumber}}">

                                    <div class="col-md-2">
                                        <div class="form-group{{$errors->has('dateOfReturn') ? 'has-error' : ''}}">
                                            <label for="Date_Sent">Date of return</label>
                                            <input type="date" value="{{$retirement->dateOfReturn}}" class="form-control"
                                                   name="dateOfReturn"
                                                   placeholder="">
                                            @if ($errors->has('dateOfReturn'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('dateOfReturn') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group{{$errors->has('departedFrom') ? 'has-error' : ''}}">
                                            <label for="Date_Sent">Departed from</label>
                                            <input type="text"
                                                   value="{{$retirement->departedFrom}}"
                                                   class="form-control" name="departedFrom"
                                                   placeholder="">
                                            @if ($errors->has('departedFrom'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('departedFrom') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-md-2">
                                        <div class="form-group{{$errors->has('departureDate') ? 'has-error' : ''}}">
                                            <label for="Date_Sent">Date of departure</label>
                                            <input type="date" value="{{$retirement->departureDate}}"
                                                   placeholder="Enter the date of departure"
                                                   class="form-control" name="departureDate">
                                            @if ($errors->has('departureDate'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('departureDate') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group{{$errors->has('arrivedAt') ? 'has-error' : ''}}">
                                            <label for="Date_Sent">Arrived at</label>
                                            <input type="text" value="{{$retirement->arrivedAt}}" class="form-control" name="arrivedAt"
                                                   placeholder="">
                                            @if ($errors->has('arrivedAt'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('arrivedAt') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group{{$errors->has('noOfNights') ? 'has-error' : ''}}">
                                            <label for="Date_Sent">#nights</label>
                                            <input type="number" value="{{$retirement->noOfNights}}" class="form-control" name="noOfNights"
                                                   placeholder="">
                                            @if ($errors->has('noOfNights'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('noOfNights') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group{{$errors->has('ratePerNight') ? 'has-error' : ''}}">
                                            <label for="Date_Sent">Rate/Night</label>
                                            <input type="number" value="{{$retirement->ratePerNight}}" class="form-control" name="ratePerNight"
                                                   placeholder="">
                                            @if ($errors->has('ratePerNight'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('ratePerNight') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group{{$errors->has('subAmount') ? 'has-error' : ''}}">
                                            <label for="Date_Sent">Amount</label>
                                            <input type="number" value="{{$retirement->subAmount}}" class="form-control" name="subAmount"
                                                   placeholder="K">
                                            @if ($errors->has('subAmount'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('subAmount') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                </details>

                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="Date_Sent">Fuel</label>
                                        <input type="text" value="" class="form-control" name="fuel"
                                               placeholder="Cost on fuel" disabled>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Date_Sent">Amount</label>
                                        <input type="number" value="{{$retirement->fuelAmount}}" class="form-control" name="fuelAmount"
                                               placeholder="K">
                                    </div>
                                </div>

                                <div class="col-md-9">
                                    <div class="form-group{{$errors->has('item1') ? 'has-error' : ''}}">
                                        <label for="Date_Sent">Other expenses</label>
                                        <input type="text" value="{{$retirement->item1}}" class="form-control" name="item1"
                                               placeholder="expense 1">
                                        @if ($errors->has('item1'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('item1') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group{{$errors->has('item1Amount') ? 'has-error' : ''}}">
                                        <label for="Date_Sent"></label>
                                        <input type="number" value="{{$retirement->item1Amount}}" class="form-control" name="item1Amount"
                                               placeholder="K">
                                        @if ($errors->has('item1Amount'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('item1Amount') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="Date_Sent"></label>
                                        <input type="text" value="{{$retirement->item2}}" class="form-control" name="item2"
                                               placeholder="expense 2">
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group{{$errors->has('item2Amount') ? 'has-error' : ''}}">
                                        <label for="Date_Sent"></label>
                                        <input type="number" value="{{$retirement->item2Amount}}" class="form-control" name="item2Amount"
                                               placeholder="K">
                                        @if ($errors->has('item2Amount'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('item2Amount') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="Date_Sent"></label>
                                        <input type="text" value="{{$retirement->item3}}" class="form-control" name="item3"
                                               placeholder="expense 3">
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group{{$errors->has('item3Amount') ? 'has-error' : ''}}">
                                        <label for="Date_Sent"></label>
                                        <input type="number" value="{{$retirement->item3Amount}}" class="form-control" name="item3Amount"
                                               placeholder="K">
                                        @if ($errors->has('item3Amount'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('item3Amount') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="Date_Sent">Other expenses</label>
                                        <textarea name="other" id="field" onkeyup="countChar(this)" rows="5"
                                                  cols="90" placeholder="Type here if the above fields are not enough">{{$retirement->other}}</textarea>
                                        <div id="charNum"></div>

                                        <!-- script to count number of characters entered in textarea-->
                                        <script>
                                            function countChar(val) {
                                                var len = val.value.length;
                                                if (len >= 255) {
                                                    val.value = val.value.substring(0, 255);
                                                } else {
                                                    $('#charNum').text(255 - len);
                                                }
                                            }
                                            ;
                                        </script>

                                        <!-- script end-->

                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group{{$errors->has('otherAmount') ? 'has-error' : ''}}">
                                        <label for="Date_Sent"></label>
                                        <input type="number" value="{{$retirement->otherAmount}}" class="form-control" name="otherAmount"
                                               placeholder="Enter total cost of other expenses here">
                                        @if ($errors->has('otherAmount'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('otherAmount') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <em><h4>Cash balance</h4></em>
                                    <details class="form-group">
                                        <summary>Click here to add cash balance details if any</summary>
                                        <div class="form-group{{$errors->has('receiptNo') ? 'has-error' : ''}}">
                                            <label>Recept No.</label>
                                            <input class="form-control" value="{{$retirement->receiptNo}}" type="number" name="receiptNo">
                                            @if ($errors->has('receiptNo'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('receiptNo') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{$errors->has('cashBalanceDate') ? 'has-error' : ''}}">
                                            <label>Date</label>
                                            <input class="form-control" value="{{$retirement->cashBalanceDate}}" type="date" name="cashBalanceDate">
                                            @if ($errors->has('cashBalanceDate'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('cashBalanceDate') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{$errors->has('cashBalanceAmount') ? 'has-error' : ''}}">
                                            <label>Amount</label>
                                            <input class="form-control" value="{{$retirement->cashBalanceAmount}}" type="number" name="cashBalanceAmount" placeholder="K">
                                            @if ($errors->has('cashBalanceAmount'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('cashBalanceAmount') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{$errors->has('recoverableAmount') ? 'has-error' : ''}}">
                                            <label>Amount recoverable.</label>
                                            <input class="form-control" value="{{$retirement->recoverableAmount}}" type="number" name="recoverableAmount" placeholder="K">
                                            @if ($errors->has('recoverableAmount'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('recoverableAmount') }}</strong>
                                    </span>
                                            @endif
                                        </div>

                                    </details>
                                </div>
                            </div>


                        </fieldset>
                    </div>


                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="submit" class="btn btn-danger"> Cancel</button>
                    </div>

                </form>

            </div>
        </div>
    </div>


    <script type="text/javascript">

        window.onload = function () {
            if (window.jQuery) {
                // jQuery is loaded


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



@endsection