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
                        <h4>List of Units</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="table-responsive">
                    <table class="table table-bordered mb-4">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name of Unit</th>
                            <th>Description</th>
                            <th>Number of Staff</th>
                            <th>Date of creation</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($units as $key=> $list)
                        <tr>
                            <td>{{ $key + $units->firstItem() }}</td>
                            <td>{{$list->unit}}</td>
                            <td>{{$list->description}}</td>
                            <td class="text-center">{{$list->user}}</td>
                            <td>{{$list->getFormattedDateAttribute()}}</td>
                            <td>
                                <a href="#" class="btn btn-danger">
                                    Delete
                                </a>
                            </td>
                        </tr>
                        @empty
                            <tr><div class="text-danger text-center text-capitalize font-weight-bold font-15">
                                    No Records exist at the moment
                                    <a class="btn btn-info btn-sm" style="margin-bottom: 10px" href="{{route('get.unit.create')}}">Create Unit</a>
                                </div>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>
@endsection
