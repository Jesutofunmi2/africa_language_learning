@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'role',
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
                            <div class="flex flex-col p-2 bg-slate-100">
                                <div>User Name: {{ $user->firstname }}</div>
                                <div>User Email: {{ $user->email }}</div>
                            </div>
                        </div>
                        <div class="mt-6 p-2 bg-slate-100">
                            <h2 class="text-2xl font-semibold">Roles</h2>
                            <div class="flex space-x-2 mt-4 p-2">
                                @if ($user->roles)
                                    @foreach ($user->roles as $user_role)
                                        <form class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md"
                                            method="POST"
                                            action="{{ route('admin.users.roles.remove', [$user->id, $user_role->id]) }}"
                                            onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-success">{{ $user_role->name }}</button>
                                        </form>
                                    @endforeach
                                @endif
                            </div>
                            <div class="max-w-xl mt-6">
                                <form method="POST" action="{{ route('admin.users.roles', $user->id) }}">
                                    @csrf
                                    <div class="sm:col-span-6">
                                        <label for="role" class="block text-sm font-medium text-gray-700">Roles</label>
                                        <select id="role" name="role" autocomplete="role-name"
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
                                <button type="submit" class="btn btn-info rounded-md">Assign</button>
                            </div>
                            </form>
                        </div>
                        <div class="mt-6 p-2 bg-slate-100">
                            <h2 class="text-2xl font-semibold">Permissions</h2>
                            <div class="flex space-x-2 mt-4 p-2">
                                @if ($user->permissions)
                                    @foreach ($user->permissions as $user_permission)
                                        <form class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md"
                                            method="POST"
                                            action="{{ route('admin.users.permissions.revoke', [$user->id, $user_permission->id]) }}"
                                            onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-success">{{ $user_permission->name }}</button>
                                        </form>
                                    @endforeach
                                @endif
                            </div>
                            <div class="max-w-xl mt-6">
                                <form method="POST" action="{{ route('admin.users.permissions', $user->id) }}">
                                    @csrf
                                    <div class="sm:col-span-6">
                                        <label for="permission"
                                            class="block text-sm font-medium text-gray-700">Permission</label>
                                        <select id="permission" name="permission" autocomplete="permission-name"
                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
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
                                <button type="submit" class="btn btn-success rounded-md">Assign</button>
                            </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
