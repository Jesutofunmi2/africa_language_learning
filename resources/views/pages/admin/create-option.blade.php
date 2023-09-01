@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'option',
])
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-md-8 offset-2 mr-auto">
                    <div class="card card-signup text-center">
                        <div class="card-header ">
                            <h4 class="card-title">{{ __('Create Option For Question') }}</h4>
                        </div>
                        <div class="card-body ">
                            <form class="form" method="POST" action="{{ route('admin.option.create') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <table class="table table-bordered" id="dynamicAddRemove">
                                    <tr>
                                        <th>Title</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <div class="input-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                            <td>
                                                <input name="addMoreInputFields[0][title]" type="text"
                                                    class="form-control" placeholder="Title" value="{{ old('title') }}"
                                                    required autofocus>
                                            </td>
                                            <td> <button type="button" name="add" id="dynamic-ar-title"
                                                    class="btn btn-outline-primary"> Add Title</button></td>

                                            @if ($errors->has('title'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </tr>
                                </table>

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
                                            <option value="{{ old('question_id') }}">Select Question</option>
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

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea name="hint" class="form-control" placeholder="Hint"> {{ old('hint') }} </textarea>
                                        </div>
                                        @if ($errors->has('hint'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('hint') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="row-12">
                                    <div class="form-group">
                                        <select name="is_correct" class="form-control">
                                            <option value="{{ old('is_correct') }}">Select Is Correct</option>
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


                                <table class="table table-bordered" id="dynamicAddRemoveImage">
                                    <tr>
                                        <th>IMAGE FILE</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <div class="input-group{{ $errors->has('image_url') ? ' has-danger' : '' }}">
                                            <td>
                                                <input type="file" value="{{ old('image_url') }}" name="addMoreInputFields[0][image_url]"
                                                placeholder="Select Image" accept="image/*" class="form-control" />
                                            </td>
                                            <td> <button type="button" name="add" id="dynamic-ar-image"
                                                    class="btn btn-outline-primary"> Add Image</button></td>

                                                    @if ($errors->has('image_url'))
                                                    <span class="invalid-feedback" style="display: block; border:30px"
                                                        role="alert">
                                                        <strong>{{ $errors->first('image_url') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                    </tr>
                                </table>


                                <table class="table table-bordered" id="dynamicAddRemoveMedia">
                                    <tr>
                                        <th>Video/Audio File</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <div class="input-group{{ $errors->has('media_url') ? ' has-danger' : '' }}">
                                            <td>
                                                <input type="file" value="{{ old('media_url') }}" name="addMoreInputFields[0][media_url]"
                                                placeholder="Select Audio/Video" accept="image/*,audio/*,video/*"
                                                class="form-control" />
                                            </td>
                                            <td> <button type="button" name="add" id="dynamic-ar-media"
                                                    class="btn btn-outline-primary"> Add Media</button></td>

                                                    @if ($errors->has('media_url'))
                                                    <span class="invalid-feedback" style="display: block; border:30px"
                                                        role="alert">
                                                        <strong>{{ $errors->first('media_url') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                    </tr>
                                </table>


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
    <script type="text/javascript">
        var i = 0;
        var ii = 0;
        var iii = 0;
        $("#dynamic-ar-title").on('click', function() {
            ++i;
            $("#dynamicAddRemove").append('<tr><td><input type="text" name="addMoreInputFields[' + i +
                '][title]" placeholder="Enter title" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
            );
        });
        $(document).on('click', '.remove-input-field', function() {
            $(this).parents('tr').remove();
        });

        $("#dynamic-ar-media").on('click', function() {
            ++ii;
            $("#dynamicAddRemoveMedia").append('<tr><td><input type="file" name="addMoreInputFields[' + ii +
                '][media_url]" placeholder="Select Media" class="form-control" accept="image/*,audio/*,video/*" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field-media">Delete</button></td></tr>'
            );
        });
        $(document).on('click', '.remove-input-field-media', function() {
            $(this).parents('tr').remove();
        });

        $("#dynamic-ar-image").on('click', function() {
            ++iii;
            $("#dynamicAddRemoveImage").append('<tr><td><input type="file" name="addMoreInputFields[' + iii +
                '][image_url]" placeholder="Select Image" class="form-control" accept="image/*" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field-image">Delete</button></td></tr>'
            );
        });
        $(document).on('click', '.remove-input-field-image', function() {
            $(this).parents('tr').remove();
        });
    </script>
@endsection
