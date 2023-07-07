@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'teacher',
])
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-md-8 offset-2 mr-auto">
                    <div class="card card-signup text-center">
                        <div class="card-header ">
                            <h4 class="card-title">{{ __('Update Teacher') }}</h4>
                        </div>
                        <div class="card-body ">
                            <form class="form" method="POST" action="{{ route('admin.teacher.update', $teacher->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row-12">
                                    <div class="form-group">
                                        <select name="school_id" class="form-control">
                                            <option value="{{ old('school_id') }}">{{$teacher->school->name}}</option>
                                            @foreach ($schools as $school)
                                            <option value="{{ $school->id }}">{{ $school->name }}</option>
                                             @endforeach

                                        </select>
                                        <small>Note: don't leave blank, select School </small>
                                    </div>
                                    @if ($errors->has('school_id'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('school_id') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-box-2"></i>
                                        </span>
                                    </div>
                                    <input name="name" type="text" class="form-control" placeholder="Name"
                                        value="{{ old('name')?? $teacher->name }}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-box-2"></i>
                                        </span>
                                    </div>
                                    <input name="email" type="text" class="form-control" placeholder="Email"
                                        value="{{ old('email') ?? $teacher->email  }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea name="address" class="form-control" placeholder="Address"> {{ old('aaddress') ?? $teacher->address}} </textarea>
                                        </div>
                                        @if ($errors->has('address'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <label class="col-md-3 col-form-label">{{ __('Teacher Logo') }}</label>
                                <input type="file" value="{{ old('image_url') }}" name="image_url"
                                    placeholder="Select Image" accept="image/*" class="form-control" />
                                @if ($errors->has('image_url'))
                                    <span class="invalid-feedback" style="display: block; border:30px" role="alert">
                                        <strong>{{ $errors->first('image_url') }}</strong>
                                    </span>
                                @endif
                                <img src="{{ asset($teacher->image_url) }}" width="200px" height="200px" alt="" srcset="">
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
