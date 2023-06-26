@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'school'
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
                            <form class="form" method="POST" action="{{ route('admin.school.create') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-box-2"></i>
                                        </span>
                                    </div>
                                    <input name="title" type="text" class="form-control" placeholder="Title" value="{{ old('title') }}" required autofocus>
                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea name="instruction" class="form-control" placeholder="Instruction"> {{ old('instruction') }} </textarea>
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
                                        <select name="answered_type" class="form-control">
                                            <option value="{{ old('answered_type') }}">Select Answered Type</option>
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
                                <input type="file" value="{{ old('media_url') }}" name="media_url"  placeholder="Select Audio/Video" accept="image/*,audio/*,video/*"   class="form-control" />
                                @if ($errors->has('media_url'))
                                <span class="invalid-feedback" style="display: block; border:30px" role="alert">
                                    <strong>{{ $errors->first('media_url') }}</strong>
                                </span>
                               @endif
                                

                                <label class="col-md-3 col-form-label">{{ __('Image') }}</label>
                                <input type="file" value="{{ old('image_url') }}" name="image_url"  placeholder="Select Image"  accept="image/*"  class="form-control" />
                                      @if ($errors->has('image_url'))
                                            <span class="invalid-feedback" style="display: block; border:30px" role="alert">
                                                <strong>{{ $errors->first('image_url') }}</strong>
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