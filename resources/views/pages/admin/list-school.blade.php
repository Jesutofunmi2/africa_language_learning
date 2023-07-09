@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'profile'
])

@section('content')
    <div class="content">
        <a href="{{ route('admin.school.index')}}" style="float: right">
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
                                School ID
                             </th>
                             <th>
                                Address
                             </th>
                             <th>
                                LGA
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
                            
                            @foreach ($schools as $school)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $school->name }}
                                    </td>
                                    <td>
                                        {{ $school->school_id }}
                                    </td>
                                    <td>
                                        {{ $school->address }}
                                    </td>
                                    <td>
                                        {{ $school->lga }}
                                    </td>
                                    <td>
                                        <img src="{{ asset($school->image_url) }}" width="40px" height="40px" />
                                    </td>
        
                                    <td>
                                        {{ $school->created_at->diffForHumans() }}
                                    </td>
                              
                                    <td>
                                        <a href="{{ route('admin.school.show', $school->id) }}" class="btn">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.school.destroy', $school->id) }}" onsubmit="return confirm('Are you sure you want to delete School ?')" method="post">
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
                {!! $schools->links() !!}
            </div>
        </div>
    </div>
@endsection