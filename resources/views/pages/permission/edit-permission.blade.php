@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'permission'
])
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
            
                <div class="col-lg-8 col-md-8 offset-2 mr-auto">
                    <div class="card card-signup text-center">
                        <div class="card-header ">
                            
                            <h4 class="card-title">{{ __('Edit Permission') }}</h4>
                        </div>
                        <div class="card-body ">
                            
                            <form class="form" method="POST" action="{{ route('admin.role.update', $permissions ) }}" >
                                @method('put')
                                @csrf
                                <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-box-2"></i>
                                        </span>
                                    </div>
                                    <input name="name" type="text" class="form-control" placeholder="Permission Name" value="{{ old('name') ?? $permissions->name}}" required autofocus>
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
                            <h2 class="text-2xl font-semibold">Roles</h2>
                            <div class="flex space-x-2 mt-4 p-2">
                                @if ($permissions->roles)
                                    @foreach ($permissions->roles as $permission_role)
                                        <form class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md" method="POST"
                                            action="{{ route('admin.permissions.roles.remove', [$permissions->id, $permission_role->id]) }}"
                                            onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-success btn-round" >{{ $permission_role->name }}</button>
                                        </form>
                                    @endforeach
                                @endif
                            </div>
                            <div class="max-w-xl mt-6">
                                <form method="POST" action="{{ route('admin.permissions.roles', $permissions->id) }}">
                                    @csrf
                                    <div class="sm:col-span-6">
                                        <label for="role" class="block text-sm font-medium text-gray-700">Roles</label>
                                        <select id="role" name="role" autocomplete="role-name" class="form-control"
                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('role')
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