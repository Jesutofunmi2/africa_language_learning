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
                <a href="{{ route('admin.question.media') }}" style="float: right">
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
                                IMAGE URL
                            </th>
                            <th>
                                VIDEO URL
                            </th>
                            <th>
                                Action
                            </th>

                            <th>

                            </th>
                        </thead>
                        <tbody>


                            <tr>

                                <td>
                                    <img src="{{ asset($imageUrl) }}" width="40px" height="40px" />
                                    <a href="{{ $imageUrl }}">Link</a>
                                    <input type="hidden" id="myInput" value="{{ $imageUrl }}">

                                </td>


                                <td>
                                    <img src="{{ asset($mediaUrl) }}" width="40px" height="40px" />
                                    <a href="{{ $mediaUrl }}">Link</a>
                                </td>

                                <td>
                                    <button onclick="myFunction()">Copy text</button>
                                </td>

                            </tr>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function myFunction() {
            // Get the text field
            var copyText = document.getElementById("myInput");

            // Select the text field
            copyText.select();
           

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);

            // Alert the copied text
            alert("Copied the text: " + copyText.value);
        }
    </script>
@endsection
