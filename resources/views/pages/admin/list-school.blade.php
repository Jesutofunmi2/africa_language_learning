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
                <a href="{{ route('admin.school.index') }}" style="float: right">
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
                                School Name
                            </th>
                            <th>
                                School Number
                            </th>
                            <th>
                                Email
                            </th>

                            <th>
                                Time Left
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
                                        {{ $school->phone_number }}
                                    </td>
                                    <td>
                                        {{ $school->email }}
                                    </td>

                                    <td>
                                        {{ substr($school->future, 14) }}
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
                                        @if ($school->status == true)
                                            <form action="{{ route('admin.school.status', $school->id) }}"
                                                onsubmit="return confirm('Are you sure you want to update status ?')"
                                                method="get">
                                                @csrf
                                                @method('get')

                                                <input type="hidden" name="page" value="{{ $schools->currentPage() }}">
                                                <button class="btn btn-success" id="online">Online</button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.school.status', $school->id) }}"
                                                onsubmit="return confirm('Are you sure you want to update status ?')"
                                                method="get">
                                                @csrf
                                                @method('get')
                                                <input type="hidden" name="page" value="{{ $schools->currentPage() }}">
                                                <button class="btn btn-danger" type="submit">Offline</button>
                                            </form>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.school.filter.show', $school->id) }}" class="btn btn-primary">Analysic</a>
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
