@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'dashboard'
])

@section('content')
    <div class="content">
        <div class="row">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <div class="col-lg-8 col-md-8 offset-2 col-sm-12">
                <h4 class="title">{{ __('Create Activity') }}</h4>
                <h6 class="title">{{ __('select a date to create activity') }}</h6>
                <div id="cal-wrap">
                    <!-- (A) PERIOD SELECTOR -->
                    <div id="cal-date">
                      <select id="cal-mth"></select>
                      <select id="cal-yr"></select>
                    </div>
              
                    <!-- (B) CALENDAR -->
                    <div id="cal-container"></div>
              
                    <!-- (C) EVENT FORM -->
                    <div id="form-body" class="invisible">
                        <p>
                        </p>
                        <form class="col-md-12" action="{{ route('admin.activity.create') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div id="form-container" class="card">
                               
                                <div class="card-body">
                                    <h5>User(s) Activity Date is: <span id="evt-date">{{ old('date') }}</span></h5>
                                    <div class="row">
                                        <label class="col-md-3 col-form-label">{{ __('Date') }}</label>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="date" readonly id="a_date" name="date" value="{{ old('date') }}" class="form-control" required>
                                            </div>
                                            @if ($errors->has('date'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-3 col-form-label">{{ __('Title') }}</label>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="Activity title" required>
                                            </div>
                                            @if ($errors->has('title'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-3 col-form-label">{{ __('User') }}</label>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <select name="user_id" class="form-control">
                                                    <option value="{{ old('user_id') }}">Select User</option>
                                                    @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->lastname }}</option>
                                                    @endforeach
                                                </select>
                                                <small>Note: leave blank for global activity</small>
                                            </div>
                                            @if ($errors->has('user_id'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('user_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-md-3 col-form-label">{{ __('Type') }}</label>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <select name="type" class="form-control">
                                                    <option value="{{ old('type') }}">Select Type</option>
                                                    @foreach ($types as $type)
                                                        <option value="{{ $type }}">{{ $type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @if ($errors->has('type'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('type') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

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
                                        <label class="col-md-3 col-form-label">{{ __('Description') }}</label>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <textarea name="description" class="form-control" placeholder="Description"> {{ old('description') }}</textarea>
                                            </div>
                                            @if ($errors->has('description'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-info btn-round">{{ __('Create Activity') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <form id="cal-event" class="invisible">
                      <h1 id="evt-head"></h1>
                      
                      <input id="evt-close" type="button" value="Close"/>
                      <input id="evt-del" type="button" value="Delete"/>
                      <input id="evt-save" type="submit" value="Save"/>
                    </form>
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
