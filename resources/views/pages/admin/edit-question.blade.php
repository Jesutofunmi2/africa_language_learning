@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'question'
])
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
            
                <div class="col-lg-8 col-md-8 offset-2 mr-auto">
                    <div class="card card-signup text-center">
                        <div class="card-header ">
                            <h4 class="card-title">{{ __('Edit Question') }}</h4>
                        </div>
                        <div class="card-body ">
                            <form class="form" method="POST" action="{{ route('admin.question.update', $question->id ) }}" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="input-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-box-2"></i>
                                        </span>
                                    </div>
                                    <input name="title" type="text" class="form-control" placeholder="Title" value="{{ old('title') ?? $question->title }}" required autofocus>
                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea name="instruction" class="form-control" placeholder="Instruction"> {{ old('instruction') ?? $question->instruction }} </textarea>
                                        </div>
                                        @if ($errors->has('instruction'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('instruction') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
            
                                <div class="row-12">
                                    <div class="form-group">
                                        <select name="language_id" class="form-control">
                                            <option value="{{ old('language_id') ?? $question->language->id  }}"> {{ $question->language->name }} </option>
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
                                        <select name="course_id" class="form-control">
                                            <option value="{{ old('course_id') ?? $question->course->id  }}"> {{ $question->course->title }}</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                                            @endforeach
                                        </select>
                                        <small>Note: don't leave blank, select Course </small>
                                    </div>
                                    @if ($errors->has('course_id'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('course_id') }}</strong>
                                        </span>
                                    @endif 
                                </div>
                                
                                <div class="row-12">
                                    <div class="form-group">
                                        <select name="answered_type" class="form-control">
                                            <option value="{{ old('answered_type') ?? $question->answered_type }}">{{ $question->answered_type }}</option>
                                                <option value="single">Single</option>
                                                <option value="multiple">Multiple</option>
                                                <option value="puzzle">Puzzle</option>
                                                <option value="text">Text</option>
                                           
                                        </select>
                                        <small>Note: don't leave blank, select Answered Type </small>
                                    </div>
                                    @if ($errors->has('answered_type'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('answered_type') }}</strong>
                                        </span>
                                    @endif 
                                </div>


                                <label class="col-md-3 col-form-label">{{ __('Media Upload') }}</label>
                                <input type="file" value="{{ old('media_url')  }}" name="media_url"  placeholder="Select Audio/Video" accept="image/*,audio/*,video/*"   class="form-control" />
                                @if ($errors->has('media_url'))
                                <span class="invalid-feedback" style="display: block; border:30px" role="alert">
                                    <strong>{{ $errors->first('media_url') }}</strong>
                                </span>
                               @endif
                               <a href="{{ $question->media_url }}"> Media Link </a>

                                <label class="col-md-3 col-form-label">{{ __('Image') }}</label>
                                <input type="file" value="{{ old('image_url') }}" name="image_url"  placeholder="Select Image"  accept="image/*"  class="form-control" />
                                      @if ($errors->has('image_url'))
                                            <span class="invalid-feedback" style="display: block; border:30px" role="alert">
                                                <strong>{{ $errors->first('image_url') }}</strong>
                                            </span>
                                        @endif
                                        <img src="{{ asset($question->image_url) }}" width="200px" height="200px" alt="" srcset="">
                               
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