@extends('layouts.authorized')
@section('main_content')


    <div class="row">
        <form class="form-vertical" role="form" method="POST" action="{{ url('/imprest/update') }}">
            <div class="panel panel-default">
                <div class="panel-heading">Imprest</div>
                <div class="panel-body">
                {{ csrf_field() }}

                <div class="row">
                    <form role="form">

                    <div  class="col-sm-6 col-md-6">
                        <div id="current">



                        </div>

<div>
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="submit" class= "btn btn-danger"> Cancel</button>
</div>

                    </div>




                    <div class="col-sm-6 col-md-6">
                        <div style="height: inherit" class="panel panel-default pre-scrollable">
                                    <!-- <div class="panel-heading">Imprest</div> !-->
                                    <div class="panel-body">


                        <fieldset id="all" disabled>

                            <fieldset id="HD">
                                <em><h4>Part III: Head Of applicants Unit</h4></em>

                            <div class="checkbox">
                                <label><input type="checkbox"> Approved/Not Approved</label>
                            </div>

                            <div class="form-group">
                                <label for="Copied_To">Comment</label>
                                <input type="text" class="form-control" name="Copied_To" placeholder="Description of use">
                            </div>

                            <div class="form-group">
                                <label for="Copied_To">Date Outstanding imprest obtained</label>
                                <input type="text" class="form-control" name="Copied_To" placeholder="Description of use">
                            </div>
                            </fieldset>

                            <div id="OT" >

                            <em><h4>Applicant</h4></em>


                           <!-- <div class="form-group">
                                <label for="Copied_To">Name</label>
                                <select class="form-control" value="" name="imprestId">
                                    foreach($imprests as $imprest)
                                    <option>{$imprest->purpose}}</option>
                                </select>
                                endforeach
                            </div> -->

                                <fieldset disabled>
                            <div class="form-group" >
                                <label for="From">Department</label> <!--Add school, unit or dept accroding to form from acccounts-->
                                <input type="text" class="form-control" value="" name="department" placeholder="{Auth::user()->department->departmentName}}">

                                <label for="Subject">Man Number</label>
                                <input type="number" class="form-control" name="manNumber" value="{{Auth::user()->manNumber}}" placeholder="{{Auth::user()->manNumber}}">
                            </div>
                                    </fieldset>


                            <div class="form-group">
                                <label for="Date_Sent">Amount of Imprest required </label>
                                <input type="number" class="form-control" name="amount" value="" placeholder="Enter Kwacha">
                            </div>

                            <div class="form-group">
                                <label for="Copied_To">Purpose</label>
                                <input type="text" class="form-control" value="" name="purpose" placeholder="Description of use">
                            </div>

                            <div class="form-group">
                                <label for="Date_Sent">Date</label>
                                <input type="date" class="form-control" value="" name="Date_Sent" placeholder="{{\Carbon\Carbon::now()->format('m/d/Y')}}">
                            </div>

                            </div>




<fieldset id="BS" disabled>

                            <em><h4>Part II: For The Department  Bursar</h4></em>


                            <div class="form-group">
                                <label for="Copied_To">Balance of imprest on applicants account</label>
                                <input type="text" class="form-control" name="Copied_To" placeholder="Description of use">
                            </div>

                            <div class="form-group">
                                <label for="Copied_To">Date Outstanding imprest obtained</label>
                                <input type="text" class="form-control" name="Copied_To" placeholder="Description of use">
                            </div>
                            <div class="form-group">
                                <label for="Copied_To">Budget Line</label>
                                <input type="text" class="form-control" name="Copied_To" placeholder="Description of use">
                            </div>

                            <div class="form-group">
                                <label for="Copied_To">Budget</label>
                                <input type="text" class="form-control" name="Copied_To" placeholder="Description of use">
                            </div>

                            <div class="form-group">
                                <label for="Copied_To">Actual YTD(K)</label>
                                <input type="text" class="form-control" name="Copied_To" placeholder="Description of use">
                            </div>

                            <div class="form-group">
                                <label for="Copied_To">Balance</label>
                                <input type="text" class="form-control" name="Copied_To" placeholder="Description of use">
                            </div>

                            <div class="form-group">
                                <label for="Copied_To">Cash Availabe</label>
                                <input type="text" class="form-control" name="Copied_To" placeholder="Description of use">
                            </div>

                            <div class="form-group">
                                <label for="Copied_To">Imprest Recommended</label>
                                <input type="text" class="form-control" name="Copied_To" placeholder="Description of use">
                            </div>

                            <div class="form-group">
                                <label for="Copied_To">Date</label>
                                <input type="date" class="form-control" name="Copied_To" placeholder="Description of use">
                            </div>
    </fieldset>

                            <fieldset id="HD" disabled>
                                        <em><h4>Part IV: Authorisation by dean/Director</h4></em>



                                        <div class="checkbox">
                                            <label><input type="checkbox"> Authorised/ Not Approved</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="Copied_To">Comments</label>
                                            <input type="text" class="form-control" name="Copied_To" placeholder="Description of use">
                                        </div>


                                        <div class="form-group">
                                            <label for="Copied_To">Amount Authorisation</label>
                                            <input type="text" class="form-control" name="Copied_To" placeholder="Description of use">
                                        </div>

                                        <div class="form-group">
                                            <label for="Copied_To">Date</label>
                                            <input type="date" class="form-control" name="Copied_To" placeholder="Description of use">
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

    window.onload = function() {
        if (window.jQuery) {
            // jQuery is loaded
            document.getElementById("current").innerHTML = document.getElementById("{{Auth::user()->accessLevelId}}").innerHTML;
            document.getElementById("{{Auth::user()->accessLevelId}}").innerHTML = '';

        } else {
            location.reload();
        }
    }

    jQuery.prepend('hi');
    $(function(){

        $('#current').onload(function () {
            alert({{Auth::user()->access_level_id}});

        })

    });

</script>
        </form>
    </div>



@endsection