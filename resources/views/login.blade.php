@extends('layouts.unauthorized')
@section('main_content')
       <div class="well well-lg">
           <div class="row">
               <div class="col-sm-12">
                   <h4 style="text-align: center; margin-bottom: 20px;">FINANCIAL ACCOUNTING SYSTEM</h4>
                   <img class="center-block" src="frontend/img/logo.png">
               </div>
               <section class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                   <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                       {{ csrf_field() }}
                       <h6 style="text-align: center;">LOGIN</h6>


                       <div class="form-group{{ $errors->has('manNumber') ? ' has-error' : '' }}">
                           <label for="email" class="control-label" style="color:#fff; ">MAN NUMBER</label>
                           <input  placeholder="Enter your man number" id="manNumber" type="number" class="form-control" name="manNumber" value="{{ old('manNumber') }}">
                           @if ($errors->has('manNumber'))
                               <span class="help-block" style="color: #cc0000">
                                    <strong>{{ $errors->first('manNumber') }}</strong>
                                </span>
                           @endif
                       </div>

                       <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                           <label for="password" class="control-label" style="color: #fff;">PASSWORD</label>
                           <input id="password" type="password" class="form-control" name="password" placeholder="password">
                           @if ($errors->has('password'))
                               <span class="help-block" style="color: #cc0000">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                           @endif
                       </div>

                       <div class="form-group">
                           <div class="checkbox">
                               <label style="color: #fff;">
                                   <input type="checkbox" name="remember">Remember Me
                               </label>
                           </div>
                       </div>

                       <div class="form-group">
                           <button  type="submit" id='auth-submit' class="btn btn-success pull-right">
                               <i class="fa fa-btn fa-sign-in"></i> Login
                           </button>
                           <a class="btn btn-link" href="{{ url('/password/reset') }}" style="color:#fff;">Forgot Your Password?</a>
                       </div>

                   </form>
               </section>
           </div>
       </div>
   </div>
@endsection

   {{--<script>--}}
       {{--$('div.alert').not('.alert-important').delay(4000).slideUp(300);--}}
   {{--</script>--}}
