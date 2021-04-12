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
                        <h4>List of Departments</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="table-responsive">
                    <table class="table table-bordered mb-4">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Description</th>
{{--                            <th>Units</th>--}}
                            <th>Staff</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($depts as $key=> $list)
                        <tr>
                            <td>{{ $key + $depts->firstItem() }}</td>
                            <td>{{$list->dept}}</td>
                            <td>{{$list->description}}</td>
{{--                            <td>{{$list->unit}}</td>--}}
                            <td>{{$list->staff}}</td>
                            <td>{{$list->getFormattedDateAttribute()}}</td>
                            <td>
                                @if($list->staff < 1)
                                <a href="{{route('get.department.disable',['id'=>$list->id])}}" class="btn btn-{{$list->status == 1 ? "danger":"success"}} btn-sm">
                                    <i class="fa fa-delete"></i>
                                    {{$list->status === 1 ? "Disable":"Enable"}}
                                </a>
                                @else
                                    <a href="#" class="btn btn-primary btn-sm">
                                        <i class="fa fa-delete"></i>In use
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @empty
                            <tr><div class="text-danger text-center text-capitalize font-weight-bold font-15">
                                    No Records exist at the moment
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
