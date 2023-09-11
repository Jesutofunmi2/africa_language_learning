@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'topic'
])
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
            
                <div class="col-lg-8 col-md-8 offset-2 mr-auto">
                    <div class="card card-signup text-center">
                        <div class="card-header ">
                            <h4 class="card-title">{{ __('Edit Topic') }}</h4>
                        </div>
                        <div class="card-body">
                            <form class="form" method="POST" action="{{ route('admin.topic.update', $topic->id ) }}" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="input-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-box-2"></i>
                                        </span>
                                    </div>
                                    <input name="title" type="text" class="form-control" placeholder="Course name" value="{{ old('title') ?? $topic->title }}" required autofocus>
                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea name="description" class="form-control" placeholder="Description"> {{ old('description')  ?? $topic->description}}</textarea>
                                        </div>
                                        @if ($errors->has('description'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row-12">
                                    <div class="form-group">
                                        <select name="section_id" class="form-control">
                                            <option value="{{ old('section_id') }}">{{$topic->section->title ?? null }}</option>
                                           
                                            @foreach ($sections as $section)
                                                <option value="{{ $section->id }}">{{ $section->title }}</option>
                                            @endforeach
                                    
                                        </select>
                                        <small>Note: don't leave blank, select section </small>
                                    </div>
                                    @if ($errors->has('section_id'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('section_id') }}</strong>
                                        </span>
                                    @endif 
                                </div>

                                <div class="row-12">
                                    <div class="form-group">
                                        <select name="type" class="form-control">
                                            <option value="{{ old('type') }}">{{ $topic->type }}</option>
                                                <option value="sectional">Sectional</option>
                                                <option value="standalone">StandAlone</option>
                                           
                                        </select>
                                        <small>Note: don't leave blank, select type </small>
                                    </div>
                                    @if ($errors->has('type'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif 
                                </div>

                                <div class="row-12">
                                    <div class="form-group">
                                        <select name="question_type" class="form-control">
                                            <option value="{{ old('question_type') }}">Question Type</option>
                                                <option value="puzzle">Puzzle</option>
                                                <option value="single">Single</option>
                                                <option value="multiple">Multiple</option>
                                           
                                        </select>
                                        <small>Note: don't leave blank, select Question type </small>
                                    </div>
                                    @if ($errors->has('question_type'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('question_type') }}</strong>
                                        </span>
                                    @endif 
                                </div>

                                <label class="col-md-3 col-form-label">{{ __('Content(Optional)') }}</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea name="content" class="form-control" placeholder="Content"> {{ old('content') ?? $topic->content }}</textarea>
                                        </div>
                                        @if ($errors->has('content'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('content') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <label class="col-md-3 col-form-label">{{ __('Objective(Optional)') }}</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea name="objective" class="form-control" placeholder="Objective"> {{ old('objective') ?? $topic->objective }}</textarea>
                                        </div>
                                        @if ($errors->has('objective'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('objective') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <label class="col-md-3 col-form-label">{{ __('Media Url') }}</label>
                                <input type="file" value="{{ old('image_url')  ?? $topic->image_url }}" name="image_url" accept="image/* audio/* video/*" class="form-control" />
                                      @if ($errors->has('image_url'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('image_url') }}</strong>
                                            </span>
                                        @endif

                                        <a href="{{ asset($topic->image_url) }}">Media Url </a>
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