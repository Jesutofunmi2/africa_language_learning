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
                            <h4 class="card-title">{{ __('Create Batch Upload Of Option') }}</h4>
                        </div>
                        <div class="card-body ">
                            <form class="form" method="POST" action="{{ route('admin.option.batchUpload') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row-12">
                                    <div class="form-group">
                                        <select name="language_id" class="form-control">
                                            <option value="{{ old('language_id') }}">Select Language </option>
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
                                            <option value="{{ old('question_id') }}">Select Question </option>
                                            @foreach ($questions as $question)
                                                <option value="{{ $question->id }}">{{ $question->title }}</option>
                                            @endforeach
                                        </select>
                                        <small>Note: don't leave blank, select question </small>
                                    </div>
                                    @if ($errors->has('question_id'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('question_id') }}</strong>
                                        </span>
                                    @endif 
                                </div>

                                <label class="col-md-3 col-form-label">{{ __('Pick Excel') }}</label>
                                 <input type="file" value="{{ old('file') }}" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" class="form-control" />
                                      @if ($errors->has('file'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('file') }}</strong>
                                            </span>
                                        @endif
                                 <a href="{{url('/sample/questionUpload.xlsx')}}">Download sample</a>

                                <div class="card-footer ">
                                    <button type="submit" class="btn btn-info btn-round">{{ __('Upload') }}</button>
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