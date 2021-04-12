@extends('admin.layout.main')


@section('admin')
        @if(!is_null($client))
        <div class="layout-px-spacing">
            <div class="row layout-top-spacing">
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                    <div class="widget-three">
                        <div class="widget-heading">
                            <h5 class="">{{$client->name}}</h5>

                        </div>
                        <div class="widget-content">
                            <h6><strong>Created Date:</strong> {{$client->getFormattedDateAttribute()}}</h6>
                            <h6><strong>Licence Expiry:</strong> {{date('d/m/Y',strtotime($client->expiry_date))}}</h6>

                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                    <div class="widget-three">
                        <div class="widget-heading">
                            <h5 class="">Organisations</h5>
                        </div>
                        <div class="widget-content">
                            <h4 class="text-center">{{$organ}}</h4>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-12 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="widget-three">
                        <div class="widget-heading">
                            <h5 class="">Registed Staff</h5>
                        </div>
                        <div class="widget-content">
                            <h4 class="text-center">{{$user}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="layout-px-spacing">
            <div class="row layout-top-spacing">
                <div class="col-12 layout-spacing">
                    <div class="widget-three">
                        
                        <div class="widget-content">
                           <h4 class="text-center text-danger">No client has been created</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

@endsection
