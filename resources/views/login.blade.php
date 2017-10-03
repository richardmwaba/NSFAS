@extends('layouts.unauthorized')
@section('title', 'NFAS | Login')
@section('main_content')
    <div class="row">
       <div class="well well-lg">
           <div class="row">
               <div class="col-sm-12 col-xs-12">
                   <h3 style="text-align: center; margin-bottom: 20px; color: #e5e5e5"><b>FINANCIAL ACCOUNTING SYSTEM</b></h3>
                   <img class="center-block" src="frontend/img/logo.png">
               </div>
               <section class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                   <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                       {{ csrf_field() }}
                       <h4 style="text-align: center; color: #e5e5e5"><b>LOGIN</b></h4>


                       <div class="form-group{{ $errors->has('manNumber') ? ' has-error' : '' }}">
                           <label for="manNumber" class="control-label" style="color: #e5e5e5; ">MAN NUMBER</label>
                           <input  placeholder="Enter Your Man Number" id="manNumber" type="number" class="form-control" name="manNumber" value="{{ old('manNumber') }}">
                           @if ($errors->has('manNumber'))
                               <span class="help-block" style="color: #f0f0f0">
                                    <strong>{{ $errors->first('manNumber') }}</strong>
                                </span>
                           @endif
                       </div>

                       <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                           <label for="password" class="control-label" style="color: #e5e5e5;">PASSWORD</label>
                           <input id="password" type="password" class="form-control" name="password" placeholder="Enter Your Password">
                           @if ($errors->has('password'))
                               <span class="help-block" style="color: #f0f0f0">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                           @endif
                       </div>

                       <div class="form-group">
                           <div class="checkbox">
                               <label style="color: #e5e5e5;">
                                   <input type="checkbox" name="remember">Remember Me
                               </label>
                           </div>
                       </div>

                       <div class="form-group">
                           <button  type="submit" id='auth-submit' class="btn btn-success pull-right" style="color: #e5e5e5;">
                               <i class="fa fa-btn fa-sign-in"></i> Login
                           </button>
                           <a class="btn btn-link" href="{{ url('/password/reset') }}" style="color: #e5e5e5;">Forgot Your Password?</a>
                       </div>

                   </form>
               </section>
           </div>
           <!-- /.row -->
       </div>
       <!-- /.well -->
    </div>
    <!-- /.row -->
@endsection

   {{--<script>--}}
       {{--$('div.alert').not('.alert-important').delay(4000).slideUp(300);--}}
   {{--</script>--}}
