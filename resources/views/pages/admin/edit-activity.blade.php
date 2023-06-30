@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'profile'
])

@section('content')
    <div class="content">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
       
        <div class="row">
       
            <div class="col-md-10 offset-1">
                <div id="form-body">
                    <p>
                    </p>
                    <form class="col-md-12" action="{{ route('admin.activity.update', $activity->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div id="form-container" class="card">
                           
                            <div class="card-body">
                                <h5>User(s) Activity Date is: <span id="evt-date">{{ $activity->date }}</span></h5>
     
                                <div class="row">
                                    <label class="col-md-3 col-form-label">{{ __('Title') }}</label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="text" name="title" value="{{ old('title') ?? $activity->title }}" class="form-control" placeholder="Activity title" required>
                                        </div>
                                        @if ($errors->has('title'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                @if ($activity->type == 'global')
                                <div class="row">
                                    <label class="col-md-3 col-form-label">{{ __('User') }}</label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <select name="user_id" onchange="userChange()" class="form-control" id="user_id">
                                                <option value="{{ old('user_id') ?? null}}"> Select User</option>
                                                @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->lastname }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($errors->has('user_id'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('user_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                @endif
                                
                                <div class="row">
                                    <label class="col-md-3 col-form-label">{{ __('Image') }}</label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="file" value="{{ old('image') }}" name="image" accept="image/*" class="form-control" />
                                        </div>
                                        @if ($errors->has('image'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                   
                                </div>

                                <div class="row">
                                    <div class="col-md-9 offset-3">
                                        <img src="{{ $activity->image_url }}" width="200px" height="200px" alt="" srcset="">
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-md-3 col-form-label">{{ __('Description') }}</label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <textarea name="description" class="form-control" placeholder="Description"> {{ old('description') ?? $activity->description }}</textarea>
                                        </div>
                                        @if ($errors->has('description'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" id="submit_button" class="btn btn-info btn-round">{{ $activity->type == 'global' ? __('Update for global users') : __('Update Activity') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function userChange () {
            user_id = document.getElementById('user_id').value;
            submit_button = document.getElementById('submit_button');

            if(user_id != null) {
                submit_button.innerHTML = 'Update for selected user'
            }
            if(user_id == null || user_id == '') {
                submit_button.innerHTML = 'Update for global users'
            }
           
        }
    </script>
@endsection