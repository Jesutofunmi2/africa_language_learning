@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'profile'
])

@section('content')
    <div class="content">
        <a href="{{ route('admin.topic.index')}}" style="float: right">
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
                                 Name
                            </th>
                             <th>
                                Description
                             </th>
                             <th>
                                Sectional
                             </th>
                             <th>
                                Section
                             </th>
                             <th>
                                Media Url
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
                            
                            @foreach ($topics as $topic)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $topic->title }}
                                    </td>
                                    <td>
                                        {{ $topic->description }}
                                    </td>
                                    <td>
                                        {{ $topic->type }}
                                    </td>
                                    <td>
                                        {{ $topic->section->title??'' }}
                                    </td>
                                    @if($topic->media_type=='image')
                                    <td>
                                        <img src="{{ asset($topic->image_url) }}" width="40px" height="40px" />
                                    </td>
                                    @else
                                    <td>
                                        <a href="{{ asset($topic->image_url) }}">media link</a>
                                    </td>
                                    @endif
                                    <td>
                                        {{ $topic->created_at->diffForHumans() }}
                                    </td>
                              
                                    <td>
                                        <a href="{{ route('admin.topic.show', $topic->id) }}" class="btn">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.topic.destroy', $topic->id) }}" onsubmit="return confirm('Are you sure you want to delete course?')" method="post">
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
                {!! $topics->links() !!}
            </div>
        </div>
    </div>
@endsection