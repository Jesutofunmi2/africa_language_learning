@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'filter',
])

@section('content')
    <div class="content">
        <div class="row">
            
        <div class="col-md-2 offset-0.5">
         <b> School Name:</b><h2> {{$school_name[0]['name']}} </h2>

        </div>

        <div class="col-md-2 offset-0.5">
            <b> School Address:</b><h2> {{$school_name[0]['address']}} </h2>
   
           </div>

           <div class="col-md-6 offset-0.5">
            <b> School Email:</b><h2> {{$school_name[0]['email']}} </h2>
   
           </div>

           <div class="col-md-2">
            <b> School Logo:</b> <img src="{{ asset($school_name[0]['image_url']) }}" width="50px" height="50px" /> 
   
           </div>
           <div class="col-md-2">
            <b> School Phone:</b> <h2> {{$school_name[0]['phone']}} </h2>
   
           </div>
        </div>
        <div class="row">
           
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-vector text-danger"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <a href="{{ route('admin.school.student.list', $school_name[0]['id'] ) }}">
                                        <p class="card-category">Students</p>
                                    </a>
                                    <p class="card-title">{{ $students }}
                                    <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>

                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-vector text-danger"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <a href="{{ route('admin.teacher.list') }}">
                                        <p class="card-category">Classs</p>
                                    </a>
                                    <p class="card-title">{{ $classes }}
                                    <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>

                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-globe text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <a href="{{ route('admin.teacher.list') }}">
                                        <p class="card-category">Arms</p>
                                    </a>
                                    <p class="card-title">{{ $class_arms }}
                                    <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>

                    </div>
                </div>
            </div>



            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-globe text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <a href="{{ route('admin.school.teacher.list', $school_name[0]['id'] ) }}">
                                        <p class="card-category">Teachers</p>
                                    </a>
                                    <p class="card-title">{{ $teachers }}
                                    <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">         
         
        
        </div>

        <div id="container"></div>

    </div>

    @push('scripts')
        <script>
            Highcharts.chart('container', {

                chart: {
                    type: 'column'
                },

                title: {
                    text: 'School Data',
                    align: 'left'
                },

                xAxis: {
                    categories: ['Gold', 'Silver', 'Bronze']
                },

                yAxis: {
                    allowDecimals: false,
                    min: 0,
                    title: {
                        text: 'Count medals'
                    }
                },

                tooltip: {
                    format: '<b>{key}</b><br/>{series.name}: {y}<br/>' +
                        'Total: {point.stackTotal}'
                },

                plotOptions: {
                    column: {
                        stacking: 'normal'
                    }
                },

                series: [{
                    name: 'Norway',
                    data: [148, 133, 124],
                    stack: 'Europe'
                },{
                    name: 'Canada',
                    data: [77, 72, 80],
                    stack: 'North America'
                }]
            });
        </script>
    @endpush
@endsection
