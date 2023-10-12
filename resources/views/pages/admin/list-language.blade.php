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
                <a href="{{ route('admin.language.index') }}" style="float: right">
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
                                Language Name
                            </th>
                            <th>
                                Status
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
                                        @if ($language->status == true)
                                            <form action="{{ route('admin.language.status', $language->id) }}"
                                                onsubmit="return confirm('Are you sure you want to update Language status ?')"
                                                method="get">
                                                @csrf
                                                @method('get')

                                                <input type="hidden" name="page"
                                                    value="">
                                                <button class="btn btn-success" id="online">Online</button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.language.status', $language->id) }}"
                                                onsubmit="return confirm('Are you sure you want to update Language status ?')"
                                                method="get">
                                                @csrf
                                                @method('get')
                                                <input type="hidden" name="page"
                                                    value="">
                                                <button class="btn btn-danger" type="submit">Offline</button>
                                            </form>
                                        @endif
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
                                        <form action="{{ route('admin.language.destroy', $language->id) }}"
                                            onsubmit="return confirm('Are you sure you want to delete language?')"
                                            method="post">
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
