@extends('layouts.authorized')
@section('main_content')


    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Imprest retirement</div>
            <div class="panel-body">

                <details id="details">
                    <summary>Click to view imprest details</summary>
                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading">Imprest details</div>
                            <div class="panel-body">

                                <div id="applicantInfo">
                                    <form style="margin-left:10px;max-height:8px;margin-left: 20px;margin-top:20px;"
                                          class="form-horizontal" role="form">

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
                                            <label class="col-sm-3 col-md-3 col-xs-4"
                                                   for="first-name">Man number</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">{{$imprest->applicantId}}</label>
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
                                                       for="first_name_value">{{\Carbon\Carbon::parse($imprest->updated_at)->toFormattedDateString()}}</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Date of
                                                return</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">{{\Carbon\Carbon::parse($retirement->dateOfreturn)->toFormattedDateString()}}</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Departed
                                                from</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">{{$imprest->bursar->lastName}} {{$imprest->bursar->otherName}} {{$imprest->bursar->firstName}}</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Date</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">{{$retirement->date}}</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Arrived
                                                at</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">{{$retirement->arivedAt}}</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">No. of
                                                nights</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">{{$retirement->noOfNights}}</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4"
                                                   for="first-name">Rate/Night</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">K {{$retirement->ratePerNight}}</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Subsistance
                                                allowance</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">K {{$retirement->subAmount}}</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Fuel</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">{{$retirement->fuelAmount}}</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Amount</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">K {{$retirement->fuelAmount}}</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4"
                                                   for="first-name">{{$retirement->item1}}</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">K {{$retirement->item1Amount}}</label>
                                            </div>
                                        </div>

                                        @if($retirement->item2!=null)
                                            <div class="form-group">
                                                <label class="col-sm-3 col-md-3 col-xs-4"
                                                       for="first-name">{{$retirement->item2}}</label>
                                                <div class="col-sm-6 col-md-6 col-xs-5">
                                                    <label class="text-primary"
                                                           for="first_name_value">K {{$retirement->item2Amount}}</label>
                                                </div>
                                            </div>
                                        @endif

                                        @if($retirement->item3!=null)
                                            <div class="form-group">
                                                <label class="col-sm-3 col-md-3 col-xs-4"
                                                       for="first-name">{{$retirement->item3}}</label>
                                                <div class="col-sm-6 col-md-6 col-xs-5">
                                                    <label class="text-primary"
                                                           for="first_name_value">K {{$retirement->item3Amount}}</label>
                                                </div>
                                            </div>
                                        @endif

                                        @if($retirement->item3!=null)
                                            <div class="form-group">
                                                <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Other
                                                    expenses</label>
                                                <div class="col-sm-6 col-md-6 col-xs-5">
                                                    <label class="text-primary"
                                                           for="first_name_value">{{$retirement->other}}</label>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Total</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">K {{$total}}</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Bursar
                                                comment</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">{{$retirement->bursarComment}}</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Bursar
                                                action</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">
                                                    @if($retirement->bursarApproval==0)
                                                        {{$d='None'}}
                                                    @elseif($retirement->bursarApproval==1)
                                                        {{$d='Approved'}}@else{{$d= 'Rejected'}}
                                                    @endif</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Dean/Head
                                                comment</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">{{$retirement->deanOrHeadComment}}</label>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-xs-4" for="first-name">Dean/Head
                                                action</label>
                                            <div class="col-sm-6 col-md-6 col-xs-5">
                                                <label class="text-primary"
                                                       for="first_name_value">
                                                    @if($retirement->deanOrHeadApproval==0)
                                                        {{$d='None'}}
                                                    @elseif($retirement->deanOrHeadApproval==1)
                                                        {{$d='Approved'}}@else{{$d= 'Rejected'}}
                                                    @endif</label>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="col-sm-3 col-md-3 col-xs-4 btn btn-primary">Print</button>
                                        </div>


                                    </form>
                                </div>


                            </div>


                        </div>
                    </div>
                </details>

                <form class="form-vertical" role="form" method="POST"
                      action="{{ url('/imprests/retirement/edit/'.$retirement->id) }}">
                    {{ csrf_field() }}

                    <div id="current">

                        <!--code to be injected based on current user-->
                        <div class="form-group form-inline">
                            <input type="radio" value="approved" name="approval">Approve<br>
                            <input type="radio" value="rejected" name="approval" checked>Reject<br>
                        </div>

                        <div class="form-group">
                            <label>Comment</label>
                            <input type="text" name="comment">
                        </div>

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