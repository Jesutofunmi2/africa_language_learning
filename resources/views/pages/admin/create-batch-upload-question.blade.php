@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'question',
])
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-md-8 offset-2 mr-auto">
                    <div class="card card-signup text-center">
                        <div class="card-header ">
                            <h4 class="card-title">{{ __('Create Batch Upload Of Question') }}</h4>
                        </div>
                        <div class="card-body ">
                            <form class="form" method="POST" action="{{ route('admin.question.batchUpload') }}"
                                enctype="multipart/form-data">
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
                                        <select name="topic_id" class="form-control">
                                            <option value="{{ old('topic_id') }}">Select topic </option>
                                            @foreach ($topics as $topic)
                                                <option value="{{ $topic->id }}">{{ $topic->title }}</option>
                                            @endforeach
                                        </select>
                                        <small>Note: don't leave blank, select topic </small>
                                    </div>
                                    @if ($errors->has('topic_id'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('topic_id') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <label class="col-md-3 col-form-label">{{ __('Pick Excel') }}</label>
                                <input type="file" value="{{ old('file') }}" name="file"
                                    accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                                    class="form-control" />
                                @if ($errors->has('file'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                @endif
                                <a href="{{ url('/sample/questionUpload.xlsx') }}">Download sample</a>

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
