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
                                Course
                             </th>
                             <th>
                                Language
                             </th>
                             <th>
                                Media
                             </th>
                             <th>
                                Image
                             </th>
                             <th>
                                Status
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
                            
                            @foreach ($questions as $question)
                                <tr>
                                    <td>
                                        {{ $question->title }}
                                    </td>
                                    <td>
                                        {{ $question->course->title }}
                                    </td>
                                    <td>
                                        {{ $question->language->name }}
                                    </td>
                                    <td>
                                       <a href="{{$question->media_url}}"> Media Link</a>
                                            
                                      
                                    </td>

                                    <td>
                                        <img src="{{ asset($question->image_url) }}" width="40px" height="40px" />
                                    </td>

                                    <td>
                                        {{ $question->status}}
                                    </td>
        
                                    <td>
                                        {{ $question->created_at->diffForHumans() }}
                                    </td>
                              
                                    <td>
                                        <a href="{{ route('admin.question.show', $question->id) }}" class="btn">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.question.destroy', $question->id) }}" onsubmit="return confirm('Are you sure you want to delete Question ?')" method="post">
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