@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'school',
])
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-md-8 offset-2 mr-auto">
                    <div class="card card-signup text-center">
                        <div class="card-header ">
                            <h4 class="card-title">{{ __('Create School') }}</h4>
                        </div>
                        <div class="card-body ">
                            <form class="form" method="POST" action="{{ route('admin.school.create') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row-12">
                                    <div class="form-group">
                                        <select name="state" class="form-control">
                                            <option value="{{ old('state') }}">Select State</option>
                                            <option value="fct abuja">FCT Abuja</option>

                                        </select>
                                        <small>Note: don't leave blank, select State </small>
                                    </div>
                                    @if ($errors->has('state'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('state') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="row-12">
                                    <div class="form-group">
                                        <select name="lga" class="form-control">
                                            <option value="{{ old('lga') }}">Select LGA</option>
                                            <option value="abaji">Abaji</option>
                                            <option value="garki">Municapal</option>
                                            <option value="bwari">Bwari</option>
                                            <option value="gwagwalada">Gwagwalada</option>
                                            <option value="kuje">Kuje</option>
                                            <option value="kwali">Kwali</option>

                                        </select>
                                        <small>Note: don't leave blank, select LGA</small>
                                    </div>
                                    @if ($errors->has('lga'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('lga') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-box-2"></i>
                                        </span>
                                    </div>
                                    <input name="name" type="text" class="form-control" placeholder="School Name"
                                        value="{{ old('name') }}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-box-2"></i>
                                        </span>
                                    </div>
                                    <input name="password" type="password" class="form-control" placeholder="Password"
                                        value="{{ old('password') }}" required autofocus>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-box-2"></i>
                                        </span>
                                    </div>
                                    <input name="email" type="text" class="form-control" placeholder="School Email"
                                        value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="input-group{{ $errors->has('school_name') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-box-2"></i>
                                        </span>
                                    </div>
                                    <input name="school_name" type="text" class="form-control" placeholder="Admin Name"
                                        value="{{ old('school_name') }}" required autofocus>
                                    @if ($errors->has('school_name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('school_name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="row-12">
                                    <div class="form-group">
                                        <select name="type" class="form-control">
                                            <option value="{{ old('type') }}">Select LGA</option>
                                            <option value="unity-school">Unity School</option>
                                            <option value="non-unity-school">Non Unity School</option>
                                        </select>
                                        <small>Note: don't leave blank, select School Category</small>
                                    </div>
                                    @if ($errors->has('type'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="row-12">
                                    <div class="form-group">
                                        <select name="country" class="form-control">
                                            <option value="{{ old('country') }}">Select Country</option>
                                            <option value="nigeria">Nigeria</option>
                                            <option value="gabon">Gabon</option>
                                        </select>
                                        <small>Note: don't leave blank, select School Country</small>
                                    </div>
                                    @if ($errors->has('type'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('country') }}</strong>
                                        </span>
                                    @endif
                                </div>



                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input name="phone_number" type="number" class="form-control"
                                                placeholder="Phone Number" value="{{ old('phone_number') }}" required
                                                autofocus>
                                        </div>
                                        @if ($errors->has('phone_number'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('phone_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input name="no_of_pupil" type="number" class="form-control"
                                                placeholder="No of pupil" value="{{ old('no_of_pupil') }}" required
                                                autofocus>
                                        </div>
                                        @if ($errors->has('no_of_pupil'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('no_of_pupil') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input name="trial_period_in_days" type="number" class="form-control"
                                                placeholder="Trial period in days" value="{{ old('trial_period_in_days') }}" required
                                                autofocus>
                                        </div>
                                        @if ($errors->has('trial_period_in_days'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('trial_period_in_days') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea name="address" class="form-control" placeholder="Address"> {{ old('aaddress') }} </textarea>
                                        </div>
                                        @if ($errors->has('address'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <label class="col-md-3 col-form-label">{{ __('School Logo') }}</label>
                                <input type="file" value="{{ old('image_url') }}" name="image_url"
                                    placeholder="Select Image" accept="image/*" class="form-control" />
                                @if ($errors->has('image_url'))
                                    <span class="invalid-feedback" style="display: block; border:30px" role="alert">
                                        <strong>{{ $errors->first('image_url') }}</strong>
                                    </span>
                                @endif




                                <div class="card-footer ">
                                    <button type="submit" class="btn btn-info btn-round">{{ __('Save') }}</button>
                                    {{-- <button type="" class="btn btn-danger btn-round">{{ __('Cancel') }}</button> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (count($errors) > 0)
        <script>
            document.getElementById('form-body').classList.remove('invisible');
            document.getElementById("form-container").scrollIntoView(true);
        </script>
    @endif
@endsection
