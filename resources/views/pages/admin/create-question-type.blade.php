@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'questionType',
])
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-md-8 offset-2 mr-auto">
                    <div class="card card-signup text-center">
                        <div class="card-header ">
                            <h4 class="card-title">{{ __('Create Language') }}</h4>
                        </div>
                        <div class="card-body ">
                            <form class="form" method="POST" action="{{ route('admin.question.type.create') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-box-2"></i>
                                        </span>
                                    </div>
                                    <input name="name" type="text" class="form-control" placeholder="name"
                                        value="{{ old('name') }}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="row-12">
                                    <div class="form-group">
                                        <select name="topic_id" class="form-control">
                                            <option value="{{ old('topic_id') }}">Select Topic</option>
                                            @foreach ($topics as $topic)
                                                <option value="{{ $topic->id }}">{{ $topic->title }}</option>
                                            @endforeach
                                          
                                        </select>
                                        <small>Note: don't leave blank, select Topic</small>
                                    </div>
                                    @if ($errors->has('topic_id'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('topic_id') }}</strong>
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
@endsection
