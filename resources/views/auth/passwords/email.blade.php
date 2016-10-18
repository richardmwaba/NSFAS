@extends('layouts.unauthorized')

<!-- Main Content -->
@section('main_content')
    <div class="well well-lg">
        <div class="row">
            <div class="col-sm-12">
                <h4 style="text-align: center; margin-bottom: 20px;">FINANCIAL ACCOUNTING SYSTEM</h4>
                <img class="center-block" src="../frontend/img/logo.png">
            </div>
            <section class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

                        <h6 style="text-align: center;">RESET PASSWORD</h6>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">E-MAIL ADDRESS</label>
                                <input placeholder="Enter your email" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-envelope"></i> Send Password Reset Link
                                </button>
                        </div>
                    </form>
            </section>
        </div>
    </div>
</div>
@endsection
