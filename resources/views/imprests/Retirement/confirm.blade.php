@extends('layouts.authorized')
@section('main_content')


    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Imprest retirement confirmation</div>
            <div class="panel-body">

                                <div id="applicantInfo">
                                    <form style="margin-left:10px;max-height:8px;margin-left: 20px;margin-top:20px;"
                                          class="form-horizontal" method="POST" role="form" action="{{ url('/imprests/retirement/create') }}">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4"
                                                   for="first-name">Department</label>
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
                                                <input class="hidden"
                                                name="chequeNumber" value="{{$imprest->chequeNumber}}">
                                                <input class="hidden"
                                                       name="imprestId" value="{{$imprest->imprestId}}">
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

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Date of
                                                return</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">{{\Carbon\Carbon::parse($retirement->dateOfReturn)->diffForHumans()}}</label>
                                                <input class="hidden"
                                                       name="dateOfReturn" value="{{$retirement->dateOfReturn}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Departed
                                                from</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">{{$imprest->bursar->departedFrom}}</label>
                                                <input class="hidden"
                                                       name="departedFrom" value="{{$retirement->departedFrom}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Departure date</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">{{$retirement->departureDate}}</label>
                                                <input class="hidden"
                                                       name="departureDate" value="{{$retirement->departureDate}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Arrived
                                                at</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">{{$retirement->arrivedAt}}</label>
                                                <input class="hidden"
                                                       name="arrivedAt" value="{{$retirement->arrivedAt}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">No. of
                                                nights</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">{{$retirement->noOfNights}}</label>
                                                <input class="hidden"
                                                       name="noOfNights" value="{{$retirement->noOfNights}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4"
                                                   for="first-name">Rate/Night</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">K {{$retirement->ratePerNight}}</label>
                                                <input class="hidden"
                                                       name="ratePerNight" value="{{$retirement->ratePerNight}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Subsistance
                                                allowance</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">K {{$retirement->subAmount}}</label>
                                                <input class="hidden"
                                                       name="subAmount" value="{{$retirement->subAmount}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Cost on fuel</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">{{$retirement->fuelAmount}}</label>
                                                <input class="hidden"
                                                       name="fuelAmount" value="{{$retirement->fuelAmount}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4"
                                                   for="first-name">{{$retirement->item1}}</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">K {{$retirement->item1Amount}}</label>
                                                <input class="hidden"
                                                       name="item1Amount" value="{{$retirement->item1Amount}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4"
                                                   for="first-name">{{$retirement->item2}}</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">K {{$retirement->item2Amount}}</label>
                                                <input class="hidden"
                                                       name="item2Amount" value="{{$retirement->item2Amount}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4"
                                                   for="first-name">{{$retirement->item3}}</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">K {{$retirement->item3Amount}}</label>
                                                <input class="hidden"
                                                       name="item3Amount" value="{{$retirement->item3Amount}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Other
                                                expenses</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">{{$retirement->other}}</label>
                                                <input class="hidden"
                                                       name="other" value="{{$retirement->other}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Total</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">K {{$total}}</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button type="reset" class="col-md-2 btn btn-danger"> Cancel</button>
                                            <button type="submit" class="col-md-2 btn btn-success">Confirm</button>
                                        </div>


                                    </form>
                                </div>


                <form class="form-vertical" role="form" method="POST"
                      action="{{ url('/imprests/retirement/create/'.$retirement) }}">
                    {{ csrf_field() }}

                    <div id="current">

                        <!--code to be injected based on current user-->

                    </div>


                    <div class="form-group">
                        <button class="btn btn-primary">Print</button>
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


    <!--javascript to determine what input fields to show-->
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



@endsection