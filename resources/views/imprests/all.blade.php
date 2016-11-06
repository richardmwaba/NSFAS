@extends('layouts.authorized')
@section('main_content')

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading"> Imprests</div>

                <div class="panel-body">

                    @if(Auth::user()->accessLevelId=='OT' or Auth::user()->accessLevelId=='HD')
                        <div class="form-group">
                            <a href="{{url('/imprests/new')}}" class="btn btn-link">Create new</a>
                        </div>
                    @endif

                    <table class="table">

                        <thead>
                        <tr>
                            <!--<th data-field="state" data-checkbox="true">Count</th>-->
                            <th data-field="name" data-sortable="true">Purpose</th>
                            <th data-field="id" data-sortable="true">Applicant</th>
                            <th data-field="position" data-sortable="true">Amount</th>
                            <th data-field="department" data-sortable="true">Authorised by head</th>
                            <th data-field="school" data-sortable="true">Authorised by Dean</th>
                            <th data-field="renew by" data-sortable="true">Recommended by Bursar</th>
                            <th data-field="contract status" data-sortable="true">isRetired</th>
                            <th data-field="application stage" data-sortable="true">Budget</th>
                            <th data-field="application stage" data-sortable="true">Amount Authorised</th>
                            <th data-field="application stage" data-sortable="true">Created on</th>
                            <th data-field="edit" data-sortable="true">Edit</th>
                        </tr>
                        </thead>

                        @foreach($imprests as $imprest)

                            <?php if ($imprest->authorisedByHead == 1) {
                                $head = "Yes";
                            } else {
                                $head = "No";
                            } ?>

                            <?php if ($imprest->authorisedByDean == 1) {
                                $dean = "Yes";
                            } else {
                                $dean = "No";
                            } ?>

                            <?php if ($imprest->bursarRecommendation == 1) {
                                $bursar = "Yes";
                            } else {
                                $bursar = "No";
                            } ?>

                            <?php if ($imprest->isRetired == 1) {
                                $retired = "Yes";
                            } else {
                                $retired = "No";
                            } ?>

                            <tr>

                                <!--<td data-field="state" data-checkbox="true">{$imprest->id}}</td>-->
                                <td>{{$imprest->item->description}}</td>
                                <td>{{$imprest->owner->firstName}} {{$imprest->owner->lastName}}</td>
                                <td>{{$imprest->amountRequested}}</td>
                                <td>{{$head}}</td>
                                <td>{{$dean}}</td>
                                <td>{{$bursar}}</td>


                                <td>{{$retired}}</td>
                                <td>{{$imprest->budget->name}}</td>
                                <td>{{$imprest->amountAuthorised}}</td>
                                <td>{{\Carbon\Carbon::parse($imprest->created_at)->diffForHumans()}}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{url('/imprests/edit/'.$imprest->imprestId)}}"
                                           class="btn btn-sm btn-link">Edit</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    <!--/. script-->


                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <!-- /#page-wrapper -->

    <!-- Custom Table JavaScript -->
    <!-- /.Custom Table JavaScript -->

@endsection
