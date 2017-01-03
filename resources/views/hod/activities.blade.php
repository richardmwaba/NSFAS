@extends('layouts.authorized')

@section('title', 'Department Budget | proposal')
@section('heading','Add activities to the objectives ')
@section('page_css')
   <style>
       .modal{
           position: absolute;
       }
       .modal-body{
           max-height: 400px;
           overflow-y: auto;
       }
   </style>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">add activities</div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-hover table-bordered table-striped"
                         style="font-size: small"
                          data-show-refresh="false"
                         data-show-toggle="true" data-show-columns="true" data-search="true"
                         data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name"
                         data-sort-order="desc"
                  >
                    <thead>
                    <tr>
                        <th data-field="strategicDirections" data-sortable="true">Strategic Directions</th>
                        <th data-field="objective" data-sortable="true">Objective</th>
                        <th data-field="addActivities" data-sortable="true">Add Activities</th>
                        <th data-field="moreInfo" data-sortable="true">More Activities Info</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($records as $record)
                    <tr data-objectiveid="{{ $record->id }}"  data-strategicid="{{ $record->strategic_directions->id }}"
                        data-strategicdirection ="{{ $record->strategic_directions->strategy }}"
                        data-objectivebody ="{{ $record->objective }}">
                        <td>{{ $record->strategic_directions->strategy }}</td>
                        <td>{{ $record->objective }}</td>
                        <td><a href="#" class="add-activity fa fa-plus-circle fa-fw text-success">add</a></td>
                        <td> <div class="btn-group">
                                <a href="#" class="btn btn-sm btn-link"><i class="fa fa-info-circle fa-fw text-success">
                                    </i><span class="text-success">More details</span></a></div>
                        </td>
                    </tr>
                    @endforeach
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>
{{--</div>--}}

<div id="activity-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="activity-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Add an Activity</h4>
            </div>
            <div class="modal-body ">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-offset-1 col-lg-10 col-md-offset-1 col-md-10 col-md-offset-1 col-xs-10 " >
                                <form onkeyup="autoUpdate();"  role="form"  method="POST" action="#">{!! csrf_field() !!}
                                    <div class="form-group">
                                        <label for="strategy" >Strategic Directions </label>
                                        <input id="strategy"  readonly type="text" class="form-control" name="strategy" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="objective" >Objective </label>
                                        <input id="objective" readonly type="text" class="form-control" name="objective" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="activityName" >Activity</label>
                                        <textarea class="form-control" name="activityName" id="activityName" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="successIndicator" >Indicator of Success</label>
                                        <input id="successIndicator" type="text" class="form-control"
                                               name="successIndicator" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="targetOfIndicator" >Target Of Indicator</label>
                                        <input id="targetOfIndicator" type="text" class="form-control"
                                               name="targetOfIndicator" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="baselineOfIndicator" >Baseline Of Indicator</label>
                                        <input id="baselineOfIndicator" type="text" class="form-control"
                                               name="baselineOfIndicator" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="staffResponsible" >Staff Responsible</label>
                                        <input id="staffResponsible" type="text" class="form-control"
                                               name="staffResponsible" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="percentageAchieved" >Percentage Achieved</label>
                                        <input id="percentageAchieved" type="text" class="form-control"
                                               name="percentageAchieved" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="timeFrame" >Time Frame</label>
                                        <p>Check the time frame for this activity!</p>
                                        <div class="checkbox">
                                            <label><input type="checkbox" id="firstQuarter" value="">First Quarter</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" id="secondQuarter" value="">Second Quarter</label>
                                        </div>
                                        <div class="checkbox ">
                                            <label><input type="checkbox" id="thirdQuarter"  value="" >Third Quarter</label>
                                        </div>

                                        <div class="checkbox ">
                                            <label><input type="checkbox"  id="fourthQuarter" value="" >Fourth Quarter</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="sourceOfFunding" >Source Of Funding</label>
                                        <input id="sourceOfFunding" type="text" class="form-control" name="sourceOfFunding" value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="ItemDescription" >Item Description</label>
                                        <input id="ItemDescription" type="text" class="form-control" name="itemDescription" value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="quantity" >Quantity</label>
                                        <input id="quantity" type="text" class="form-control" name="quantity" value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="pricePerUnit" >Price Per Unit</label>
                                        <input id="pricePerUnit" type="text" class="form-control" name="pricePerUnit" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="cost" >cost (kwacha) </label>
                                        <input id="cost" type="text" class="form-control" name="cost" value="">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save-activity">save</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    var token = '{{Session::token()}}';
    var urlPostActivity = "{{route('/saveActivity')}}";
</script>
@endsection

<script type="text/javascript">
    function autoUpdate() {
        var total = 0;
        var quantity = document.getElementById('quantity').value;
        var costPerUnit = document.getElementById('pricePerUnit').value;
        var amount = parseInt(costPerUnit);

        if (quantity && amount ){
            total = quantity * amount;
            document.getElementById('cost').value = total ;
        }

    }
</script>
