@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'course'
])
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
            
                <div class="col-lg-8 col-md-8 offset-2 mr-auto">
                    <div class="card card-signup text-center">
                        <div class="card-header ">
                            <h4 class="card-title">{{ __('Create Course') }}</h4>
                        </div>
                        <div class="card-body ">
                            <form class="form" method="POST" action="{{ route('admin.course.create') }}">
                                @csrf
                                <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-box-2"></i>
                                        </span>
                                    </div>
                                    <input name="name" type="text" class="form-control" placeholder="Course name" value="{{ old('name') }}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                <div class="row-12">
                                        <div class="form-group">
                                            <select name="language_id" class="form-control">
                                                <option value="{{ old('language_id') }}">Select Language</option>
                                                @foreach ($languages as $language)
                                                <option value="{{ $language->id }}">{{ $language->name }}</option>
                                                @endforeach
                                            </select>
                                            <small>Note: don't leave blank language </small>
                                        </div>
                                        @if ($errors->has('language_id'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('language_id') }}</strong>
                                            </span>
                                        @endif
                                </div>

                                <div class="card-footer ">
                                    <button type="submit" class="btn btn-info btn-round">{{ __('Save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
             </div>
        </div>
     </div> 
@endsection