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
                        <input type="text" value="" class="form-control" placeholder="Search...">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="nc-icon nc-zoom-split"></i>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-2">
                <a href="{{ route('admin.question.type.index') }}" style="float: right">
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
                            <th>S/N</th>
                            <th>
                                 Name
                            </th>
            
                            <th>
                                Topic
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

                            @foreach ($questionTypes as $questionType)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $questionType->name }}
                                    </td>
                                   
                                    <td>
                                        {{ $questionType->topic->title ?? null}}
                                    </td>

                                    <td>
                                        {{ $questionType->created_at->diffForHumans() }}
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.question.type.show', $questionType->id) }}" class="btn">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.question.type.destroy', $questionType->id) }}"
                                            onsubmit="return confirm('Are you sure you want to delete ?')"
                                            method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $questionTypes->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
