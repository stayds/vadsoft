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
                                    <h4>List of Staff members</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-4">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Staff No.</th>
                                            <th>Name</th>
                                            <th>Department</th>
                                            <th>Email</th>
{{--                                            <th>Grade Level</th>--}}
                                            <th>Job title</th>
                                            <th>Gender</th>
                                            <th>State</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($staff as $key=> $list)
                                        <tr>
                                            <td>{{ $key + $staff->firstItem() }}</td>
                                            <td>{{$list->staffno}}</td>
                                            <td><a href="#">{{$list->fname}} {{$list->lname}}</a></td>
                                            <td class="text-center">{{$list->dept}}</td>
                                            <td>{{$list->email}}</td>
{{--                                            <td>{{$list->gradelevel}}</td>--}}
                                            <td>{{$list->jobtitle}}</td>
                                            <td>{{$list->gender}}</td>
                                            <td>{{$list->state}}</td>
                                            <td>
                                                <a href="{{route('get.staff.disable',['id'=>$list->id])}}" class="btn btn-{{$list->status == 1 ? "danger": "success"}} btn-sm">
                                                    {{$list->status == 1 ? "Disable": "Enable"}}
                                                </a>
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
                                <br>
                                {{ $staff->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



@endsection
