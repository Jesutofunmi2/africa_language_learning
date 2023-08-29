@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'profile',
])

@section('content')
    <div class="content">

        <div class="row">
            <div class="col-8">

            </div>
            <div class="col-2">
                <form>
                    <div class="input-group no-border">
                        <input type="search" class="form-control" placeholder="Search..." name="search" id="search">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="nc-icon nc-zoom-split"></i>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-2">
                <a href="{{ route('admin.question.index') }}" style="float: right">
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
                                Title
                            </th>
                            <th>
                                Topic
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
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $question->title }}
                                    </td>
                                    <td>
                                        {{ $question->topic->title ?? '' }}
                                    </td>
                                    <td>
                                        {{ $question->language->name ?? '' }}
                                    </td>
                                    <td>
                                        <a href="{{ $question->media_url }}"> Media Link</a>
                                    </td>

                                    <td>
                                        <img src="{{ asset($question->image_url) }}" width="40px" height="40px" />
                                    </td>

                                    <td>
                                        @if ($question->status == true)
                                            <form action="{{ route('admin.question.status', $question->id) }}"
                                                onsubmit="return confirm('Are you sure you want to update Question status ?')"
                                                method="post">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" id="success-id" value="{{ $question->id }}">
                                                <input type="hidden" name="page" value="{{ $questions->currentPage() }}">
                                                <button class="btn btn-success"  id="success" type="submit">Online</button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.question.status', $question->id) }}"
                                                onsubmit="return confirm('Are you sure you want to update Question status ?')"
                                                method="post">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" name="page" value="{{ $questions->currentPage() }}">
                                                <button class="btn btn-danger" type="submit">Offline</button>
                                            </form>
                                        @endif
                                    </td>

                                    <td>
                                        {{ $question->created_at->diffForHumans() }}
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.question.show', $question->id) }}" class="btn">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.question.destroy', $question->id) }}"
                                            onsubmit="return confirm('Are you sure you want to delete Question ?')"
                                            method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="page" value="{{ $questions->currentPage() }}">
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $questions->links() !!}
            </div>
        </div>
    </div>

    <script type="text/javascript">
     
        $('#search').on('keyup', function() {
            search();
        });
        search();

        function search() {
            var keyword = $('#search').val();
            $.post('{{ route('admin.question.search') }}', {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    keyword: keyword
                },
                function(data) {
                    table_post_row(data);
                });
        }

        function status(sid){
            var id = sid;
            var url = '{{ route("admin.question.status", ":id") }}';
            url = url.replace(':id', id);
            console.log(url)
            $.post('url', {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    keyword: keyword
                },
                function(data) {
                   
                });
        }


        function table_post_row(res) {
            console.log(res);
            let htmlView = '';
            if (res.questions.length <= 0) {
                htmlView += `
       <tr>
          <td colspan="40">No data.</td>
       </tr>`;
            }
            for (let i = 0; i < res.questions.length; i++) {
                htmlView += `
        <tr>
           <td>` + (i + 1) + `</td>
              
               <td>` + res.questions[i].title + `</td>
               <td>` + res.questions[i].topic.title + `</td>
               <td>` + res.questions[i].language.name + `</td>
               <td> <a href=` + res.questions[i].media_url + `> Media Link </a> </td>
               <td><img src=` + res.questions[i].image_url +` width="40px" height="40px" /></td>
               <td>`
                                        if (res.questions[i].status == true){
                                            htmlView += `
                                                <button class="btn btn-success"  id="success" >Online</button>`
                                           
                                        }
                                        else{
                                            htmlView += `
                                                <button class="btn btn-danger"  id="danger" >Offline</button>`
                                           
                                        }
                                    `</td>
                                    <td>`+ res.questions[i].created_at + `</td>

            
        </tr>`;
            }
            $('tbody').html(htmlView);
        }

    </script>
@endsection
