@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'school',
])
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-md-8 offset-2 mr-auto">
                    <div class="card card-signup text-center">
                        <div class="card-header ">
                            <h4 class="card-title">{{ __('Edit School') }}</h4>
                        </div>
                        <div class="card-body ">
                            <form class="form"  method="POST" action="{{ route('admin.school.update',  $school->id) }}"
                                enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="row-12">
                                    <div class="form-group">
                                        <select name="state" class="form-control">
                                            <option value="{{ old('state') ?? $school->state }}">Select State</option>
                                            <option value="fct abuja">FCT Abuja</option>

                                        </select>
                                        <small>Note: don't leave blank, select State </small>
                                    </div>
                                    @if ($errors->has('state'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('state') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="row-12">
                                    <div class="form-group">
                                        <select name="lga" class="form-control">
                                            <option value="{{ old('lga') ?? $school->state }}">Select LGA</option>
                                            <option value="abaji">Abaji</option>
                                            <option value="garki">Garki</option>
                                            <option value="bwari">Bwari</option>
                                            <option value="gwagwalada">Gwagwalada</option>
                                            <option value="kuje">Kuje</option>
                                            <option value="kwali">Kwali</option>

                                        </select>
                                        <small>Note: don't leave blank, select LGA</small>
                                    </div>
                                    @if ($errors->has('lga'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('lga') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-box-2"></i>
                                        </span>
                                    </div>
                                    <input name="name" type="text" class="form-control" placeholder="School Name"
                                        value="{{ old('name') ?? $school->name }}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-box-2"></i>
                                        </span>
                                    </div>
                                    <input name="email" type="text" class="form-control" placeholder="School Email"
                                        value="{{ old('email') ?? $school->email }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="row-12">
                                    <div class="form-group">
                                        <select name="type" class="form-control">
                                            <option value="{{ old('type') ?? $school->type}}">Select LGA</option>
                                            <option value="unity-school">Unity School</option>
                                            <option value="non-unity-school">Non Unity School</option>
                                        </select>
                                        <small>Note: don't leave blank, select School Category</small>
                                    </div>
                                    @if ($errors->has('type'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea name="address" class="form-control" placeholder="Address"> {{ old('aaddress')  ?? $school->address}} </textarea>
                                        </div>
                                        @if ($errors->has('address'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <label class="col-md-3 col-form-label">{{ __('School Logo') }}</label>
                                <input type="file" value="{{ old('image_url')  ?? $school->image_url}}" name="image_url"
                                    placeholder="Select Image" accept="image/*" class="form-control" />
                                @if ($errors->has('image_url'))
                                    <span class="invalid-feedback" style="display: block; border:30px" role="alert">
                                        <strong>{{ $errors->first('image_url') }}</strong>
                                    </span>
                                @endif




                                <div class="card-footer ">
                                    <button type="submit" class="btn btn-info btn-round">{{ __('Update') }}</button>
                                    {{-- <button type="" class="btn btn-danger btn-round">{{ __('Cancel') }}</button> --}}
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
