@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'media'
])
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
            
                <div class="col-lg-8 col-md-8 offset-2 mr-auto">
                    <div class="card card-signup text-center">
                        <div class="card-header ">
                            <h4 class="card-title">{{ __('Upload Media') }}</h4>
                        </div>
                        <div class="card-body">
                            <form class="form" method="POST" action="{{ route('admin.question.media-create') }}" enctype="multipart/form-data">
                                @csrf

                                <label class="col-md-3 col-form-label">{{ __('Image') }}</label>
                                     <input type="file" value="{{ old('image_url') }}" name="image_url" accept="image/*" class="form-control" />
                                       @if ($errors->has('image_url'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('image_url') }}</strong>
                                            </span>
                                        @endif
                               
                                        <label class="col-md-3 col-form-label">{{ __('Audio/Video') }}</label>
                                        <input type="file" value="{{ old('media_url') }}" name="media_url"  placeholder="Select Audio/Video" accept="image/*,audio/*,video/*"   class="form-control" />
                                        @if ($errors->has('media_url'))
                                        <span class="invalid-feedback" style="display: block; border:30px" role="alert">
                                            <strong>{{ $errors->first('media_url') }}</strong>
                                        </span>
                                    @endif
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
     @if (count($errors) > 0)
     <script>
         document.getElementById('form-body').classList.remove('invisible');
         document.getElementById("form-container").scrollIntoView(true);
     </script>
 @endif
@endsection