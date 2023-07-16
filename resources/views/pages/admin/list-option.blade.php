@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'profile'
])

@section('content')
    <div class="content">
        <a href="{{ route('admin.option.index')}}" style="float: right">
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
                                Option
                            </th>
                             <th>
                                Language
                             </th>
                             <th>
                                Question
                             </th>
                             <th>
                                Media Url
                             </th>
                             <th>
                                Image
                             </th>
                             <th>
                                Is Correct
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
                            
                            @foreach ($options as $option)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $option->title }}
                                    </td>
                                    <td>
                                        {{ $option->language->name }}
                                    </td>
                                    <td>
                                        {{ $option->question->title ?? null }}
                                    </td>
                                    <td>
                                      <a href="{{$option->media_url}}">Link</a>  
                                    </td>
                                    <td>
                                        <img src="{{ asset($option->image_url) }}" width="40px" height="40px" />
                                    </td>
                                    @if($option->is_correct == 1)
                                    <form action="{{ route('admin.option.is_correct_update', $option->id) }}" onsubmit="return confirm('Are you sure you want to update option to wrong option?')" method="post">
                                        @csrf
                                        @method('put')
                                     <td>  <button class="btn btn-success" type="submit">Yes</button></td>
                                    </form>
                                    @else
                                    <td> 
                                        <form action="{{ route('admin.option.is_correct_update', $option->id) }}" onsubmit="return confirm('Are you sure you want to update option to is correct?')" method="post">
                                            @csrf
                                            @method('put')
                                             <button class="btn btn-danger" type="submit">No</button></td>
                                            @endif
                                        </form>
                                    <td>
                                        {{ $option->created_at->diffForHumans() }}
                                    </td>
                              
                                    <td>
                                        <a href="{{ route('admin.option.show', $option->id) }}" class="btn">Edit</a>

                                    </td>
                                    <td>
                                        <form action="{{ route('admin.option.destroy', $option->id) }}" onsubmit="return confirm('Are you sure you want to delete option?')" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="page" value="{{$options->currentPage()}}">
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $options->links() !!}
            </div>
        </div>
    </div>
@endsection