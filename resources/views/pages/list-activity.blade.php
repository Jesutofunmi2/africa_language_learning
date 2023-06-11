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
                            <th>
                                Title
                            </th>
                            <th>
                                Type
                            </th>
                            <th>
                                Date
                            </th>
                            <th>
                                User
                            </th>
                            <th>
                                Image
                            </th>
                            <th>
                                Action
                            </th>
                            <th>
                                
                            </th>
                        </thead>
                        <tbody>
                            
                            @foreach ($activities as $activity)
                                <tr>
                                    <td>
                                        {{ $activity->title }}
                                    </td>
                                    <td>
                                        {{ $activity->type }}
                                    </td>
                                    <td>
                                        {{ $activity->date }}
                                    </td>
                                    <td>
                                        {{ $activity->user ? $activity->admin->fullname : ''  }}
                                    </td>
                                    <td>
                                        <img src="{{ asset($activity->image_url) }}" width="40px" height="40px" />
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.activity.show', $activity->id) }}" class="btn">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.activity.destroy', $activity->id) }}" onsubmit="return confirm('Are you sure you want to delete activity?')" method="post">
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