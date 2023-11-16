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
                            
                            @foreach ($roles as $role)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $role->name }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.role.show', $role->id) }}" class="btn">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.role.destroy', $role->id) }}" onsubmit="return confirm('Are you sure you want to delete role?')" method="post">
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