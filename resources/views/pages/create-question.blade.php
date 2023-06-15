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
                            <h4 class="card-title">{{ __('Create Question') }}</h4>
                        </div>
                        <div class="card-body ">
                            <form class="form" method="POST" action="{{ route('admin.question.create') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group{{ $errors->has('question_title') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-box-2"></i>
                                        </span>
                                    </div>
                                    <input name="question_title" type="text" class="form-control" placeholder="Question Title" value="{{ old('question_title') }}" required autofocus>
                                    @if ($errors->has('question_title'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('question_title') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea name="question_instruction" class="form-control" placeholder="Description"> {{ old('question_instruction') }} Question Instruction</textarea>
                                        </div>
                                        @if ($errors->has('question_instruction'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('question_instruction') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
            
                                <div class="row-12">
                                    <div class="form-group">
                                        <select name="langauge_id" class="form-control">
                                            <option value="{{ old('langauge_id') }}">Select Language For the Question</option>
                                            @foreach ($languages as $language)
                                                <option value="{{ $language->id }}">{{ $language->name }}</option>
                                            @endforeach
                                        </select>
                                        <small>Note: don't leave blank, select language </small>
                                    </div>
                                    @if ($errors->has('langauge_id'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('langauge_id') }}</strong>
                                        </span>
                                   @endif 
                                </div>

                                <div class="row-12">
                                    <div class="form-group">
                                        <select name="langauge_id" class="form-control">
                                            <option value="{{ old('course_id') }}">Select Course For the Question</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}">{{ $course->name }}</option>
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
                                            <option value="{{ old('answered_type') }}">Select Question Answered Type</option>
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

                                <div class="row-12">
                                    <div class="form-group">
                                        <select name="status" class="form-control">
                                            <option value="{{old('media_type')}}">Select Media Type</option>
                                            <option value="image">Image</option>
                                            <option value="audio">Audio</option>
                                            <option value="video">Video</option>
                                        </select>
                                        <small>Note: don't leave blank select a media type </small>
                                    </div>
                                    @if ($errors->has('media_type'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('media_type') }}</strong>
                                        </span>
                                   @endif 
                            </div>


                                
                                <div class="row" style="border: 50px">
                                    
                                    <div class="col-md-12" style="border: 50px">
                                        <div class="form-group" style="border: 50px">
                                            <input type="file" value="{{ old('media_url') }}" name="media_url"  placeholder="Select Image/Audio/Video"  accept="image/*" class="form-control" />
                                        </div>
                                        @if ($errors->has('media_url'))
                                            <span class="invalid-feedback" style="display: block; border:30px" role="alert">
                                                <strong>{{ $errors->first('media_url') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <label class="col-md-3 col-form-label">{{ __('Image') }}</label>

                               
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