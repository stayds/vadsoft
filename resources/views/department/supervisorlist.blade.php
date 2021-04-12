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
                                    <h4>Department Supervisors</h4>
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
                                        <th>Grade Level</th>
                                        <th>Job title</th>
                                        <th>Gender</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($department as $key=> $list)
                                        <tr>
                                            <td>{{ $key + $department->firstItem() }}</td>
                                            <td>{{$list->staffno}}</td>
                                            <td><a href="#">{{$list->fname}} {{$list->lname}}</a></td>
                                            <td class="text-center">{{$list->name}}</td>
                                            <td>{{$list->gradelevel}}</td>
                                            <td>{{$list->jobtitle}}</td>
                                            <td>{{$list->gender}}</td>
                                            <td><a href="{{route('department.supervisor.disable',['id'=>$list->id,'userid'=>$list->userid])}}" class="btn btn-danger btn-sm"> Remove </a></td>
                                        </tr>
                                    @empty
                                        <tr><div class="text-danger text-center text-capitalize font-weight-bold font-15">
                                                No Department Supervisors have been created at the moment
                                            </div>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                <br>
                                {{ $department->links() }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>



@endsection
