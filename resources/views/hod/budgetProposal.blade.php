@extends('layouts.authorized')

@section('title', 'Department Budget | proposal')
@section('heading','CAUTION: Add objectives only to Strategic Directions applying to your Department.')

@section('content')
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Strategic Directions</b></div>
                <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th data-field="school" data-sortable="true">School</th>
                            <th data-field="strategyName" data-sortable="true">Strategic Directions</th>
                            <th data-field="link" data-sortable="true">Add Objectives</th>
                            <th data-field="moreInfo" data-sortable="true">Objectives more Info</th>
                        </tr>
                        </thead>
                        @foreach( $stBudgetPlan as $plan)
                            <tr data-strategyid="{{ $plan->id }}"  data-strategy="{{ $plan->strategy }}" >
                                <td > @if(isset($plan)) {{ $plan->school->schoolName }} @endif </td>
                                <td > @if(isset($plan)) {{ $plan->strategy }} @endif </td>
                                <td> @if(isset($plan))
                                        <a href="#" class="add-objective fa fa-plus-circle fa-fw text-success">add</a>
                                    @endif
                                </td>
                                <td> @if(isset($plan))
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-sm btn-link"><i class="fa fa-info-circle fa-fw text-success">
                                                </i><span class="text-success">More details</span></a></div>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </table>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="add-obj-modal">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Add an Objective</h4>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group">
                            <label for="body" >Strategic Directions </label>
                                <input id="strategy" type="text" class="form-control" name="strategy" value="">
                        </div>

                        <div class="form-group">
                            <label for="body" >Objective</label>
                            <textarea class="form-control" name="modal-objective" id="modal-objective" rows="4"></textarea>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="modal-save">save</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
        var token = '{{Session::token()}}';
        var urlSaveObjective= "{{route('/saveObjective')}}";
    </script>
@endsection
