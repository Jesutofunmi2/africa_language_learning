@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'language'
])
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
            
                <div class="col-lg-8 col-md-8 offset-2 mr-auto">
                    <div class="card card-signup text-center">
                        <div class="card-header ">
                            <h4 class="card-title">{{ __('Edit Language') }}</h4>
                        </div>
                        <div class="card-body ">
                            <form class="form" method="POST" action="{{ route('admin.language.update',  $language->id) }}" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-box-2"></i>
                                        </span>
                                    </div>
                                    <input name="name" type="text" class="form-control" placeholder="Name" value="{{ old('name') ?? $language->name }}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <label class="col-md-3 col-form-label">{{ __('Image') }}</label>
                                <input type="file" value="{{ old('image_url') ?? $language->image_url }}" name="image_url" accept="image/*" class="form-control" />
                                       @if ($errors->has('image_url'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('image_url') }}</strong>
                                            </span>
                                        @endif
                                        <img src="{{ asset($language->image_url) }}" width="200px" height="200px" alt="" srcset="">
                                <div class="card-footer ">
                                    <button type="submit" class="btn btn-info btn-round">{{ __('Update') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
             </div>
        </div>
     </div> 
@endsection