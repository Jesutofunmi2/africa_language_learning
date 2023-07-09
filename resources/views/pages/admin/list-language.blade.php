@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'profile'
])

@section('content')
    <div class="content">
        <a href="{{ route('admin.language.index')}}" style="float: right">
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
                                Language Name
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
                            
                            @foreach ($languages as $language)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $language->name }}
                                    </td>
                                    <td>
                                        <img src="{{ asset($language->image_url) }}" width="40px" height="40px" />
                                    </td>
                                    <td>
                                        {{ $language->created_at->diffForHumans() }}
                                    </td>
                              
                                    <td>
                                        <a href="{{ route('admin.language.show', $language->id) }}" class="btn">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.language.destroy', $language->id) }}" onsubmit="return confirm('Are you sure you want to delete language?')" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger" type="submit">Delete(PLS, DON'T)</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $languages->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection