@extends('layouts.authorized')
@section('title', 'Edit')
@section('heading','Edit')
@section('content')
    <div class="panel panel-default">
        <div class="row">
            <div class="row">
                <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-11" >
                    <form onkeyup="autoUpdate();"  class="form-horizontal" role="form" style="margin-left: 20px;margin-top: 20px" method="POST"
                          action="{{ url('/update/'.$estimate->id ) }}">
                        {!! csrf_field() !!}
                        <div class="form-group{{ $errors->has('itemDescription') ? ' has-error' : '' }}">
                            <label for="itemDescription" class="col-md-3" >Item Description</label>
                            <div class="col-md-8">
                                <input class="form-control" name="itemDescription" placeholder="" value="{{ $estimate->itemDescription }}">
                                @if ($errors->has('itemDescription'))
                                    <span class="help-block"><strong>{{ $errors->first('itemDescription') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                            <label for="quantity" class="col-md-3" >Quantity</label>
                            <div class="col-md-8">
                                <input id="quantity" type="text" class="form-control" name="quantity" value="{{ $estimate->quantity }}">
                                @if ($errors->has('quantity'))
                                    <span class="help-block"><strong>{{ $errors->first('quantity') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('pricePerUnit') ? ' has-error' : '' }}">
                            <label for="pricePerUnit" class="col-md-3" >Price Per Unit</label>
                            <div class="col-md-8">
                                <input id="pricePerUnit" type="text" class="form-control" name="pricePerUnit" value="{{ $estimate->pricePerUnit }}">
                                @if ($errors->has('pricePerUnit'))
                                    <span class="help-block"><strong>{{ $errors->first('pricePerUnit') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('cost') ? ' has-error' : '' }}">
                            <label for="cost" class="col-md-3" >Cost (kwacha) </label>
                            <div class="col-md-8">
                                <input id="cost" type="text" class="form-control" name="cost" value="{{ $estimate->cost }}">
                                @if ($errors->has('cost'))
                                    <span class="help-block"><strong>{{ $errors->first('cost') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-4 col-sm-3 col-md-offset-7 col-md-2">
                                <button type="submit" class="btn btn-default">Update</button>
                            </div>
                            <div class="col-xs-4 col-sm-3 col-md-2">
                                <button type="reset" class="btn btn-default pull-right">Cancel</button>
                            </div>
                        </div>
                    </form>
                    <!-- /.form -->
                </div>
            </div>
        </div>
    </div>
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

