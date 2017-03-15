@extends('layouts.authorized')
@section('title', 'add | Projects')
@section('heading','')
@section('main_content')


    <form class="form-vertical" role="form" method="POST" action="{{ url('/imprests/create') }}">
        <div class="panel panel-default">
            <div class="panel-heading">Imprest</div>
            <div class="panel-body">
                {{ csrf_field() }}

                <div class="row">

                    <!-- <div class="panel-heading">Imprest</div> !-->
                    <div class="panel-body">

                        <div class="col-md-8 col-lg-offset-1">


                            @if(Auth::user()->access_level_id=='OT')

                                <fieldset id="OT">

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

                                    <fieldset>
                                        <div class="form-group">
                                            <!-- Add school, unit or dept accroding to form from acccounts-->
                                            <input type="hidden" class="form-control"
                                                   value="{{Auth::user()->departments_id}}"
                                                   name="department"
                                                   placeholder="{{Auth::user()->department->departmentName}}">

                                            <label for="Subject">Man Number</label>
                                            <input type="number" class="form-control" name="applicantId"
                                                   value="{{Auth::user()->manNumber}}"
                                                   placeholder="{{Auth::user()->manNumber}}" disabled>
                                            <label for="Subject">Names</label>
                                            <input type="text" class="form-control"
                                                   value="{{Auth::user()->firstName}} {{Auth::user()->otherName}} {{Auth::user()->lastName}}"
                                                   placeholder="{{Auth::user()->firstName}} {{Auth::user()->otherName}} {{Auth::user()->lastName}}"
                                                   disabled>
                                        </div>
                                    </fieldset>


                                    <div class="form-group">

                                        <div class="input-group{{ $errors->has('amountRequested') ? ' has-error' : '' }}">
                                            <label for="Date_Sent">Amount of Imprest required </label>

                                            <div class="input-group">
                                                <span class="input-group-addon">K</span>
                                                <input type="number" value="{{ old('amountRequested') }}"
                                                       class="form-control" name="amountRequested"
                                                       placeholder="Enter amount here">
                                                <span class="input-group-addon">.00</span>
                                            </div>


                                            @if ($errors->has('amountRequested'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('amountRequested') }}</strong>
                                    </span>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-group{{ $errors->has('budgetLine') ? ' has-error' : '' }}">
                                            <label for="Copied_To">Budget line</label>

                                            <div id="bL">
                                                <select class="form-control"
                                                        name="budgetLine" id="budgetLine">
                                                    <option value="">Select a budget line </option>
                                                    @foreach($budgets as $budget)
                                                        <option value="{{$budget->id}}">{{$budget->budgetName}}</option>
                                                    @endforeach

                                                </select>
                                                @if ($errors->has('budgetLine'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('budgetLine') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <div class="form-group{{ $errors->has('purpose') ? ' has-error' : '' }}">
                                            <label for="purpose">Purpose</label>
                                            <select class="form-control"
                                                    name="purpose">
                                                <option value=""
                                                        placeholder="Select an item">Select the purpose
                                                </option>
                                                @foreach($budgets as $budget)
                                                    @foreach($budget->items as $item)
                                                        <option value="{{$item->id}}"
                                                                placeholder="{{$item->item_id}}">{{$item->description}}</option>
                                                    @endforeach
                                                @endforeach
                                                <option value=""
                                                        placeholder="">Other</option>
                                            </select>

                                            @if ($errors->has('purpose'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('purpose') }}</strong>
                                    </span>
                                            @endif
                                        </div>

                                    </div>

                                </fieldset>

                            @else

                                <fieldset id="HD">

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

                                    <fieldset>
                                        <div class="form-group">
                                            <!-- Add school, unit or dept accroding to form from acccounts-->
                                            <input type="hidden" class="form-control"
                                                   value="{{Auth::user()->department->id}}"
                                                   name="department"
                                                   placeholder="{{Auth::user()->department->departmentName}}">

                                        </div>

                                        <div class="form-group">
                                            <label for="Subject">Man Number</label>
                                            <input type="number" class="form-control" name="applicantId"
                                                   value="{{Auth::user()->manNumber}}"
                                                   placeholder="{{Auth::user()->manNumber}}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="Subject">Names</label>
                                            <input type="text" class="form-control"
                                                   value="{{Auth::user()->firstName}} {{Auth::user()->otherName}} {{Auth::user()->lastName}}"
                                                   placeholder="{{Auth::user()->firstName}} {{Auth::user()->otherName}} {{Auth::user()->lastName}}"
                                                   disabled>
                                        </div>
                                    </fieldset>

                                    <div class="form-group">

                                        <div class="input-group{{ $errors->has('amountRequested') ? ' has-error' : '' }}">
                                            <label for="Date_Sent">Amount of Imprest required </label>

                                            <div class="input-group">
                                                <span class="input-group-addon">K</span>
                                                <input type="number" value="{{ old('amountRequested') }}"
                                                       class="form-control" name="amountRequested"
                                                       placeholder="Enter amount here">
                                                <span class="input-group-addon">.00</span>
                                            </div>


                                            @if ($errors->has('amountRequested'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('amountRequested') }}</strong>
                                    </span>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-group{{ $errors->has('budgetLine') ? ' has-error' : '' }}">

                                            <label for="Copied_To">Budget line</label>

                                            <div id="bL">
                                                <select onchange="other(this)" class="form-control"
                                                        name="budgetLine" id="budgetLine">
                                                    <option value="{{ old('budgetLine') }}">Select a budget line
                                                    </option>
                                                    @foreach($budgets as $budget)
                                                        <option value="{{$budget->id}}">{{$budget->budgetName}}</option>
                                                    @endforeach

                                                </select>
                                                @if ($errors->has('budgetLine'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('budgetLine') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <div class="form-group{{ $errors->has('purpose') ? ' has-error' : '' }}">

                                            <label for="Copied_To">Purpose</label>
                                            <select value="" class="form-control"
                                                    name="purpose">
                                                <option value="{{ old('purpose') }}"
                                                        placeholder="Select an item">Select the purpose
                                                </option>
                                                @foreach($budgets as $budget)
                                                    @foreach($budget->items as $item)
                                                        <option value="{{$item->id}}"
                                                                placeholder="{{$item->item_id}}">{{$item->description}}</option>
                                                    @endforeach
                                                @endforeach
                                                        >Other</option>
                                            </select>

                                            @if ($errors->has('purpose'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('purpose') }}</strong>
                                    </span>
                                            @endif
                                        </div>

                                    </div>


                                    <div class="form-group">
                                        <label><input name="authorisedByHead" value="1"
                                                      type="checkbox">Approve?</label>
                                    </div>

                                    <div class="form-group">
                                        <label for="Copied_To">Comment</label>
                                        <input type="text" class="form-control"
                                               name="commentFromHead"
                                               placeholder="Your comment. Leave blank otherwise">
                                    </div>

                                </fieldset>

                            @endif


                            <div>
                                <button type="submit" class="btn btn-success">Submit</button>
                                <button type="submit" class="btn btn-danger"> Cancel</button>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </form>


    <script type="text/javascript">

        window.onload = function () {
            if (window.jQuery) {
                // jQuery is loaded
                document.getElementById("current").innerHTML = document.getElementById("{{Auth::user()->access_level_id}}").innerHTML;
                document.getElementById("{{Auth::user()->access_level_id}}").innerHTML = '';

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

            document.getElementById("budgetLineD").value = document.getElementById().value;

        }

    </script>



@endsection
