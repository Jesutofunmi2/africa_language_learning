@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'option'
])
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
            
                <div class="col-lg-8 col-md-8 offset-2 mr-auto">
                    <div class="card card-signup text-center">
                        <div class="card-header ">
                            <h4 class="card-title">{{ __('Edit Option For Question') }}</h4>
                        </div>
                        <div class="card-body ">
                            <form class="form" method="POST" action="{{ route('admin.option.update', $option->id) }}" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="input-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-box-2"></i>
                                        </span>
                                    </div>
                                    <input name="title" type="text" class="form-control" placeholder="Title" value="{{ old('title') ?? $option->title }}" required autofocus>
                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="row-12">
                                    <div class="form-group">
                                        <select name="language_id" class="form-control">
                                            <option value="{{ old('language_id') ?? $option->language->id }}">{{ $option->language->name}} </option>
                                            @foreach ($languages as $language)
                                                <option value="{{ $language->id }}">{{ $language->name }}</option>
                                            @endforeach
                                        </select>
                                        <small>Note: don't leave blank, select language </small>
                                    </div>
                                    @if ($errors->has('language_id'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('language_id') }}</strong>
                                        </span>
                                   @endif 
                                </div>

                                <div class="row-12">
                                    <div class="form-group">
                                        <select name="question_id" class="form-control">
                                            <option value="{{ old('question_id') ?? $option->question->id }}">{{ $option->question->title}}</option>
                                            @foreach ($questions as $question)
                                                <option value="{{ $question->id }}">{{ $question->title }}</option>
                                            @endforeach
                                        </select>
                                        <small>Note: don't leave blank, select Course </small>
                                    </div>
                                    @if ($errors->has('question_id'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('question_id') }}</strong>
                                        </span>
                                    @endif 
                                </div>
                                

                                <div class="row-12">
                                    <div class="form-group">
                                        <select name="is_correct" class="form-control">
                                            <option value="{{ old('is_correct')?? $option->is_correct }}">Select </option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                        </select>
                                        <small>Note: don't leave blank, select Is correct </small>
                                    </div>
                                    @if ($errors->has('is_correct'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('is_correct') }}</strong>
                                        </span>
                                    @endif 
                                </div>
                                <label class="col-md-3 col-form-label">{{ __('Image') }}</label>
                                <input type="file" value="{{ old('image_url') }}" name="image_url"  placeholder="Select Audio/Video" accept="image/*"   class="form-control" />
                                @if ($errors->has('image_url'))
                                <span class="invalid-feedback" style="display: block; border:30px" role="alert">
                                    <strong>{{ $errors->first('image_url') }}</strong>
                                </span>
                                @endif
                                <img src="{{ asset($option->image_url) }}" width="200px" height="200px" alt="" srcset="">
                                <label class="col-md-3 col-form-label">{{ __('Media') }}</label>

                                <input type="file" value="{{ old('media_url') }}" name="media_url"  placeholder="Select Audio/Video" accept="image/*,audio/*,video/*"   class="form-control" />
                                @if ($errors->has('media_url'))
                                <span class="invalid-feedback" style="display: block; border:30px" role="alert">
                                    <strong>{{ $errors->first('media_url') }}</strong>
                                </span>
                                  @endif
                                  <a href="{{ $option->media_url }}"> Media Link </a>
                                
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
     @if (count($errors) > 0)
     <script>
         document.getElementById('form-body').classList.remove('invisible');
         document.getElementById("form-container").scrollIntoView(true);
     </script>
 @endif
@endsection