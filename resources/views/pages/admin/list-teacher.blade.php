@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'profile'
])

@section('content')
    <div class="content">
        
        <a href="{{ route('admin.teacher.index')}}" style="float: right">
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
                            <th>
                                S/N
                            </th>
                            <th>
                                Name
                            </th>
                             <th>
                                School Name
                             </th>
                             <th>
                                Address
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
                        </thead>
                        <tbody>
                            
                            @foreach ($teachers as $teacher)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $teacher->name }}
                                    </td>
                                    <td>
                                        {{ $teacher->school->name?? '' }}
                                    </td>
                                    <td>
                                        {{ $teacher->address }}
                                    </td>
                                  
                                    <td>
                                        <img src="{{ asset($teacher->image_url) }}" width="40px" height="40px" />
                                    </td>
        
                                    <td>
                                        {{ $teacher->created_at->diffForHumans() }}
                                    </td>
                              
                                    <td>
                                        <a href="{{ route('admin.teacher.show', $teacher->id) }}" class="btn">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.teacher.destroy', $teacher->id) }}" onsubmit="return confirm('Are you sure you want to delete Teacher ?')" method="post">
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
                {!! $teachers->links() !!}
            </div>
        </div>
    </div>
@endsection