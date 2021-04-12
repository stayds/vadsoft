@extends('layouts.master')


@section('content')

    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="row layout-top-spacing">

                <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>List of Organisations</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-4">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>State</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($org as $key=> $list)
                                        <tr>
                                            <td>{{ $key + $org->firstItem() }}</td>
                                            <td><a href="{{route('get.organisation.edit',['id'=>$list->id])}}">{{$list->name}}</a></td>
                                            <td>{{$list->address}}</td>
                                            <td>{{$list->state}}</td>
                                            <td>
                                                <a href="{{route('get.organisation.disable',['id'=>$list->id])}}" class="btn btn-danger btn-sm"> Disable </a></td>
                                        </tr>
                                    @empty
                                        <tr><div class="text-danger text-center text-capitalize font-weight-bold font-15">
                                                No Records exist at the moment
                                            </div>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                <br>
                                {{ $org->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



@endsection
