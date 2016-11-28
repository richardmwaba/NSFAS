@extends('layouts.authorized')
@section('main_content')


    <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Imprest retirement</div>
                <div class="panel-body">

                        <details id="details">
                            <div class="row">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Imprest details</div>
                                    <div class="panel-body">

                                        <div id="applicantInfo">
                                                <form  style="margin-left:10px;max-height:8px;margin-left: 20px;margin-top:20px;" class="form-horizontal" role="form">

                                                    <div class="form-group">
                                                        <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Department</label>
                                                        <div class="col-sm-6 col-md-6 col-xs-5">
                                                            <label class="text-primary"
                                                                   for="first_name_value">{{$imprest->owner->department->departmentName}}</label>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="col-sm-3 col-md-3 col-xs-4"
                                                               for="first-name">Name</label>
                                                        <div class="col-sm-6 col-md-6 col-xs-5">
                                                            <label class="text-primary"
                                                                   for="first_name_value">{{$imprest->owner->firstName}} {{$imprest->owner->lastName}} {{$imprest->owner->otherName}}</label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Amount
                                                            of Imprest advanced</label>
                                                        <div class="col-sm-6 col-md-6 col-xs-5">
                                                            <label class="text-primary"
                                                                   for="first_name_value">K {{$imprest->authorisedAmount}}</label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Cheque
                                                            No</label>
                                                        <div class="col-sm-6 col-md-6 col-xs-5">
                                                            <label class="text-primary"
                                                                   for="first_name_value">{{$imprest->chequeNumber}}</label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Date
                                                            obtained</label>
                                                        <div class="col-sm-6 col-md-6 col-xs-5">
                                                            <label class="text-primary"
                                                                   for="first_name_value">{{\Carbon\Carbon::parse($imprest->updated_at)->diffForHumans()}}</label>
                                                        </div>
                                                    </div>

                                                </form>
                                        </div>


                                    </div>


                                </div>
                            </div>
                        </details>

                    <form class="form-vertical" role="form" method="POST" action="{{ url('/imprests/retirement/create') }}">
                        {{ csrf_field() }}

                        <div id="current">
                            <fieldset id="OT">
                                <em><h4>Subsistance allowance</h4></em>

                                <div class="row">

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="Date_Sent">Date of return</label>
                                            <input type="date" value="{{Carbon\Carbon::now()}}" class="form-control"
                                                   name="dateOfReturn"
                                                   placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="Date_Sent">Departed from</label>
                                            <input type="text"
                                                   value="{{$imprest->bursar->lastName}} {{$imprest->bursar->otherName}} {{$imprest->bursar->firstName}}"
                                                   class="form-control" name="departedFrom"
                                                   placeholder="">
                                        </div>
                                    </div>


                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="Date_Sent">Date</label>
                                            <input type="date" value="{{$imprest->created_at}}"
                                                   placeholder="{{\Carbon\Carbon::parse($imprest->created_at)->diffForHumans()}}"
                                                   class="form-control" name="departureDate">
                                            <input type="hidden" value="{{$imprest->imprestId}}" name="imprestId">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="Date_Sent">Arrived at</label>
                                            <input type="text" value="" class="form-control" name="arrivedAt"
                                                   placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="Date_Sent">#nights</label>
                                            <input type="number" class="form-control" name="noOfNights"
                                                   placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="Date_Sent">Rate/Night</label>
                                            <input type="number" value="" class="form-control" name="ratePerNight"
                                                   placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="Date_Sent">Amount</label>
                                            <input type="number" value="" class="form-control" name="subAmount"
                                                   placeholder="K">
                                        </div>
                                    </div>

                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="Date_Sent">Fuel</label>
                                            <input type="text" value="" class="form-control" name="fuel"
                                                   placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="Date_Sent">Amount</label>
                                            <input type="number" value="" class="form-control" name="fuelAmount"
                                                   placeholder="K">
                                        </div>
                                    </div>

                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="Date_Sent">Other expenses</label>
                                            <input type="text" value="" class="form-control" name="item1"
                                                   placeholder="">
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="Date_Sent"></label>
                                            <input type="number" value="" class="form-control" name="item1Amount"
                                                   placeholder="K">
                                        </div>
                                    </div>

                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="Date_Sent"></label>
                                            <input type="text" value="" class="form-control" name="item2"
                                                   placeholder="">
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="Date_Sent"></label>
                                            <input type="number" value="" class="form-control" name="item2Amount"
                                                   placeholder="K">
                                        </div>
                                    </div>

                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="Date_Sent"></label>
                                            <input type="text" value="" class="form-control" name="item3"
                                                   placeholder="">
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="Date_Sent"></label>
                                            <input type="number" value="" class="form-control" name="item3Amount"
                                                   placeholder="K">
                                        </div>
                                    </div>

                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="Date_Sent">Other expenses</label>
                                            <textarea name="other" id="field" onkeyup="countChar(this)" rows="5"
                                                      cols="90" placeholder="Type here if field not enough"></textarea>
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
                                        <div class="form-group">
                                            <label for="Date_Sent"></label>
                                            <input type="number" value="" class="form-control" name="otherAmount"
                                                   placeholder="K">
                                        </div>
                                    </div>

                                    <div class="col-md-10">
                                        <em><h4>Cash balance</h4></em>
                                        <div class="form-group form-inline">
                                            <label>Recept No.</label>
                                            <input class="form-control" type="number" name="receiptNo">

                                            <label>Amount recoverable.</label>
                                            <input class="form-control" type="number" name="recoverableAmount">
                                        </div>
                                    </div>
                                </div>


                            </fieldset>
                        </div>


                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="submit" class="btn btn-danger"> Cancel</button>
                        </div>

                </div>
            </div>
    </div>
    </form>
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