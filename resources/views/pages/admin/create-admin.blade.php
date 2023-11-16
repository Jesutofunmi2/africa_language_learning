@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'admin',
])

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-md-8 offset-2 mr-auto">
                    <div class="card card-signup text-center">
                        <div class="card-header ">
                            <h4 class="card-title">{{ __('Create Admin') }}</h4>

                        </div>
                        <div class="card-body ">
                            <form class="form" method="POST" action="{{ route('admin.register.post') }}">
                                @csrf
                                <div class="input-group{{ $errors->has('firstname') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-single-02"></i>
                                        </span>
                                    </div>
                                    <input name="firstname" type="text" class="form-control" placeholder="First name"
                                        value="{{ old('firstname') }}" required autofocus>
                                    @if ($errors->has('firstname'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('firstname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-group{{ $errors->has('lastname') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-single-02"></i>
                                        </span>
                                    </div>
                                    <input name="lastname" type="text" class="form-control" placeholder="Last name"
                                        value="{{ old('lastname') }}" required autofocus>
                                    @if ($errors->has('lastname'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('lastname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-email-85"></i>
                                        </span>
                                    </div>
                                    <input name="email" type="email" class="form-control" placeholder="Email" required
                                        value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-key-25"></i>
                                        </span>
                                    </div>
                                    <input name="password" type="password" class="form-control" placeholder="Password"
                                        required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-key-25"></i>
                                        </span>
                                    </div>
                                    <input name="confirm_password" type="password" class="form-control"
                                        placeholder="Password confirmation" required>
                                    @if ($errors->has('confirm_password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('confirm_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="card-footer ">
                                    <button type="submit" class="btn btn-info btn-round">{{ __('Register') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
