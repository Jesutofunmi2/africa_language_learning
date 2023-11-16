@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'role'
])
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
            
                <div class="col-lg-8 col-md-8 offset-2 mr-auto">
                    <div class="card card-signup text-center">
                        <div class="card-header ">
                            <h4 class="card-title">{{ __('Edit Role') }}</h4>
                        </div>
                        <div class="card-body ">
                            
                            <form class="form" method="POST" action="{{ route('admin.role.update', $role->id) }}" >
                                @method('put')
                                @csrf
                                <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-box-2"></i>
                                        </span>
                                    </div>
                                    <input name="name" type="text" class="form-control" placeholder="Role Name" value="{{ old('name') ?? $role->name}}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="card-footer ">
                                    <button type="submit" class="btn btn-info btn-round">{{ __('Update') }}</button>
                                </div>
                            </form>
                        </div>
                        <div class="mt-6 p-2 bg-slate-100">
                            <h2 class="text-2xl font-semibold">Role Permissions</h2>
                            <div class="flex space-x-2 mt-4 p-2">
                                @if ($role->permissions)
                                    @foreach ($role->permissions as $role_permission)
                                        <form class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md" method="POST"
                                            action="{{ route('admin.role.permissions.revoke', [$role->id, $role_permission->id]) }}"
                                            onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-success" >{{ $role_permission->name }}</button>
                                        </form>
                                    @endforeach
                                @endif
                            </div>
                            <div class="max-w-xl mt-6">
                                <form method="POST" action="{{ route('admin.role.permissions', $role->id) }}">
                                    @csrf
                                    <div class="sm:col-span-6">
                                        <label for="permission"
                                            class="block text-sm font-medium text-gray-700">Permission</label>
                                        <select id="permission" name="permission" autocomplete="permission-name" class="form-control">
                                            @foreach ($permissions as $permission)
                                                <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('name')
                                        <span class="text-red-400 text-sm">{{ $message }}</span>
                                    @enderror
                            </div>
                            <div class="sm:col-span-6 pt-5">
                                <button type="submit"
                                    class="btn btn-info btn-round">Assign</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
             </div>
        </div>
     </div> 
@endsection