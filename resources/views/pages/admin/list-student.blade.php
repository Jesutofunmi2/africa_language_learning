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
                                Name
                            </th>
                            <th>
                                ID
                            </th>
                            <th>
                                School 
                            </th>
                               
                            <th>
                                Date
                            </th>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $student->full_name }}
                                    </td>
                                    <td>
                                        {{ $student->student_id }}
                                    </td>
                                    <td>
                                        {{ $student->school->name ?? '' }}
                                    </td>

                                    <td>
                                        {{ $student->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $students->links() !!}
            </div>
        </div>
    </div>
@endsection
