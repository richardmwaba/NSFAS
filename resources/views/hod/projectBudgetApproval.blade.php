@extends('layouts.authorized')

@section('title', 'project | budget-approval')
@section('heading','')

@section('content')
    <div class="panel panel-default">
        <div class="row">
            <div class="row">
                <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-11" >
                    <form class="form-horizontal" role="form" style="margin-left: 20px;margin-top: 20px" method="POST"
                          action="{{ url('/approvalProjectBudget/'.$project->id)}}">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="NRC"> Today's Date: </label>
                            <div class="col-sm-6 col-md-6 col-xs-5">
                                <label class="text-primary" for="TodaysDate">
                                    {{ date('jS F, Y') }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="last-name"> Project Name: </label>
                            <div class="col-sm-6 col-md-6 col-xs-5">
                                <label class="text-primary" for="last_name_value">
                                    {{ $project->projectName }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="first-name"> Coordinator: </label>
                            <div class="col-sm-6 col-md-6 col-xs-5">
                                <label class="text-primary" for="">
                                    {{ $project->projectCoordinator }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="last-name"> Net Budget: </label>
                            <div class="col-sm-6 col-md-6 col-xs-5">
                                <label class="text-primary" for="last_name_value">
                                    K{{ $project->budget->netProjectBudget }}.00
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="last-name">Department Percentage (%): </label>
                            <div class="col-sm-6 col-md-6 col-xs-5">
                                <label class="text-primary" for="last_name_value">
                                    {{$dPercent}}
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="last-name">Department Amount: </label>
                            <div class="col-sm-6 col-md-6 col-xs-5">
                                <label class="text-primary" for="last_name_value">
                                    K{{ $project->budget->departmentAmount }}.00
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="last-name">Unza Percentage (%): </label>
                            <div class="col-sm-6 col-md-6 col-xs-5">
                                <label class="text-primary" for="last_name_value">
                                    {{$uPercent}}
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="last-name">unza Amount: </label>
                            <div class="col-sm-6 col-md-6 col-xs-5">
                                <label class="text-primary" for="last_name_value">
                                    K{{ $project->budget->unzaAmount }}.00
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-xs-4" for="last-name">Actual Budget: </label>
                            <div class="col-sm-6 col-md-6 col-xs-5">
                                <label class="text-primary" for="last_name_value">
                                    K{{ $project->budget->actualProjectBudget }}.00
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-4 col-sm-3 col-md-offset-7 col-md-2">
                                <button type="submit" class="btn btn-success">Approve</button>
                            </div>
                            <div class="col-xs-4 col-sm-3 col-md-2">
                                <button type="reset" class="btn btn-danger pull-right">Decline</button>
                            </div>
                        </div>
                    </form>
                    <!-- /.form -->
                </div>
            </div>
        </div>
    </div>
@endsection