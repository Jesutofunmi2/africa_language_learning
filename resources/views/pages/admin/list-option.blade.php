@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'profile'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-8">

            </div>
            <div class="col-2">
            <form>
                <div class="input-group no-border">
                    <input type="search" class="form-control" placeholder="Search..." name="searchoption" id="searchOption">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="nc-icon nc-zoom-split"></i>
                        </div>
                    </div>
                </div>
            </form>
            </div>
            <div class="col-2">
                <a href="{{ route('admin.option.index')}}" style="float: right">
                    <p>{{ __('Add') }}</p>
                </a>
            </div>
        </div>
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
                        <tbody class="allDataOption">
                            
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
                                    <form action="{{ route('admin.option.is_correct_update', $option->id) }}" onsubmit="return confirm('Are you sure you want to update option to wrong option?')" method="get">
                                        @csrf
                                        @method('get')
                                     <td>  <button class="btn btn-success" type="submit">Yes</button></td>
                                    </form>
                                    @else
                                    <td> 
                                        <form action="{{ route('admin.option.is_correct_update', $option->id) }}" onsubmit="return confirm('Are you sure you want to update option to is correct?')" method="get">
                                            @csrf
                                            @method('get')
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
                                        <form action="{{ route('admin.option.destroy', $option->id) }}" onsubmit="return confirm('Are you sure you want to delete option?')" method="get">
                                            @csrf
                                            @method('get')
                                            <input type="hidden" name="page" value="{{$options->currentPage()}}">
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tbody id="ContentOption" class="searchDataOption">

                       </tbody>
                    </table>
                </div>
                {!! $options->links() !!}
            </div>
        </div>
    </div>

    <script type="text/javascript">

        $('#searchOption').on('keyup', function() {
             $valueoption = $(this).val();

             if($valueoption)
             {
                $('.searchDataOption').show();
                $('.allDataOption').hide();
             }
             else
             {
                $('.searchDataOption').hide();
                $('.allDataOption').show();
             }
             
             $.ajax({
                type: 'get',
                url: '{{route('admin.options.search')}}',
                data:{'option':$valueoption},
                success:function(data)
                {
                    console.log(data)
                    $('#ContentOption').html(data);
                }
             });
        });

    </script>
@endsection
