@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'profile'
])

@section('content')
    <div class="content">
        <a href="{{ route('admin.course.index')}}" style="float: right">
            <p>{{ __('Add') }}</p>
        </a>
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
                                Course Name
                            </th>
                             <th>
                                Description
                             </th>
                             <th>
                                Image
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
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $course->title }}
                                    </td>
                                    <td>
                                        {{ $course->description }}
                                    </td>
                                    <td>
                                        <img src="{{ asset($course->image_url) }}" width="40px" height="40px" />
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
                {!! $courses->links() !!}
            </div>
        </div>
    </div>
@endsection