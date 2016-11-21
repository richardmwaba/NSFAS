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

                            <div class="col-sm-6 col-md-12">
                                <div id="current">
                                    <fieldset id="OT">
                                        <em><h4>Subsistance allowance</h4></em>

                                        <div class="row">
                                        <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="Date_Sent">Departed from</label>
                                            <input type="text" value="{{$imprest->bursar->lastName}} {{$imprest->bursar->otherName}} {{$imprest->bursar->firstName}}" class="form-control" name="departedFrom"
                                                   placeholder="" disabled>
                                        </div>
                                            </div>

                                            <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="Date_Sent">Date of return</label>
                                            <input type="text" value="{{\Carbon\Carbon::now()}}" class="form-control" name="departedFrom"
                                                   placeholder="" disabled>
                                            </div>
                                                </div>


                                            <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="Date_Sent">Date</label>
                                            <input type="text" value="{{\Carbon\Carbon::parse($imprest->created_at)->diffForHumans()}}" class="form-control" name="departedFrom"
                                                   placeholder="" disabled>
                                        </div>
                                                </div>

                                            <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="Date_Sent">Arrived at</label>
                                            <input type="text" value="" class="form-control" name="arrivedAt"
                                                   placeholder="" disabled>
                                        </div>
                                                </div>

                                            <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="Date_Sent">No. of nights</label>
                                            <input type="number" value="" class="form-control" name="NoOfNights"
                                                   placeholder="" disabled>
                                        </div>
                                                </div>

                                            <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="Date_Sent">Rate/Night</label>
                                            <input type="number" value="" class="form-control" name="ratePerNight"
                                                   placeholder="" disabled>
                                        </div>
                                                </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="Date_Sent">Amount</label>
                                                    <input type="number" value="" class="form-control" name="ratePerNight"
                                                           placeholder="" disabled>
                                                </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="Date_Sent">Fuel</label>
                                                        <input type="number" value="" class="form-control" name="ratePerNight"
                                                               placeholder="" disabled>
                                                    </div>
                                            </div>




                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <button type="submit" class="btn btn-danger"> Cancel</button>
                                </div>

                                        </fieldset>

                            </div>
                                </div>



                            <div class="col-sm-6 col-md-6">

                                <div class="form-group">
                                <label for="Date_Sent">Other expenses</label>
                                <textarea rows="5" cols="60" placeholder="Type here"></textarea rows="5" cols="60">

                                    </div>

                                </div>

                        </form>
                    </div>
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

        </form>
    </div>



@endsection