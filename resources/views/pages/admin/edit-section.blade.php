@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'section'
])
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
            
                <div class="col-lg-8 col-md-8 offset-2 mr-auto">
                    <div class="card card-signup text-center">
                        <div class="card-header ">
                            <h4 class="card-title">{{ __('Create Section') }}</h4>
                        </div>
                        <div class="card-body">
                            <form class="form" method="POST"  action="{{ route('admin.section.update', $section->id ) }}" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="input-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-box-2"></i>
                                        </span>
                                    </div>
                                    <input name="title" type="text" class="form-control" placeholder="Title" value="{{ old('title')?? $section->title }}" required autofocus>
                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="row-12">
                                    <div class="form-group">
                                        <select name="course_id" class="form-control">
                                            <option value="{{ old('course_id') }}">{{$section->course->title ?? 'Select Course'}}</option>
                                           
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                                            @endforeach
                                    
                                        </select>
                                        <small>Note: don't leave blank, select course </small>
                                    </div>
                                    @if ($errors->has('course_id'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('course_id') }}</strong>
                                        </span>
                                    @endif 
                                </div>

                                <div class="row-12">
                                    <div class="form-group">
                                        <select name="level" class="form-control">
                                            <option value="{{ old('level') }}">{{$section->level ?? 'Select leve'}}</option>
                                            <option value="beginner">Beginners</option>
                                            <option value="intermediate">Intermediate</option>
                                            <option value="advanced">Advanced</option>
                                    
                                        </select>
                                        <small>Note: don't leave blank, select level </small>
                                    </div>
                                    @if ($errors->has('level'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('level') }}</strong>
                                        </span>
                                    @endif 
                                </div>

                                <div class="row-12">
                                    <div class="form-group">
                                        <select name="category" class="form-control">
                                            <option value="">{{$section->category ?? 'Select Category'}}</option>
                                            <option value="bronze">Bronze</option>
                                            <option value="silver">Silver</option>
                                            <option value="gold">Gold</option>
                                    
                                        </select>
                                        <small>Note: don't leave blank, select category </small>
                                    </div>
                                    @if ($errors->has('category'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('category') }}</strong>
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
     @if (count($errors) > 0)
     <script>
         document.getElementById('form-body').classList.remove('invisible');
         document.getElementById("form-container").scrollIntoView(true);
     </script>
 @endif
@endsection