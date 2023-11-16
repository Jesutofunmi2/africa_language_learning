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
                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-primary">
                            <th>S/N</th>
                            <th>
                                Name
                            </th>
                            <th>
                                Action
                            </th>
                            <th>
                                
                            </th>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $permission->name }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.permission.show', $permission->id) }}" class="btn">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.permission.destroy', $permission->id) }}" onsubmit="return confirm('Are you sure you want to delete permission?')" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                   
                </div>
            </div>
        </div>
    </div>
@endsection