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
                                Course Name
                            </th>
                             <th>
                                Language Name
                             </th>
                             <th>
                                Date
                             </th>
                            <th>
                                Action
                            </th>
                            <th>
                                
                            </th>
                        </thead>
                        <tbody>
                            
                            @foreach ($courses as $course)
                                <tr>
                                    <td>
                                        {{ $course->name }}
                                    </td>
                                    <td>
                                        {{ $course->created_at->diffForHumans() }}
                                    </td>
                              
                                    <td>
                                        <a href="{{ route('admin.course.show', $course->id) }}" class="btn">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.course.destroy', $course->id) }}" onsubmit="return confirm('Are you sure you want to delete language?')" method="post">
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