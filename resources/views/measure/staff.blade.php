@extends('layouts.master')


@section('content')


    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="row layout-top-spacing">

                <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Staff Measurement Parameter</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form action="{{route('post.measure.staff')}}" method="POST">
                                @csrf
                                @if ($message = \Session::get('success'))

                                    <div class="alert alert-success alert-block">

                                        <button type="button" class="close" data-dismiss="alert">×</button>

                                        <strong>{{ $message }}</strong>

                                    </div>
                                    <input type="hidden" name="measureid" value="{{\Session::get('data')}}">
                                @endif
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul style="margin-bottom: 0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="form-row mb-3">
                                    <div class="form-group col-md-4">
                                        <label for="">What do you want to measure</label>
                                        <select class="form-control" name="measuretypeid" required >
                                            <option>Select</option>
                                            @foreach($measure as $list)
                                                <option class="text-capitalize" value="{{$list->id}}">{{$list->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="">KPI</label>
                                        <select class="form-control" name="kpiid" required >
                                            <option>Select KPI</option>
                                            @foreach($kpi as $list)
                                                <option class="text-capitalize" value="{{$list->id}}">{{$list->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Assessment Type</label>
                                        <select class="form-control" name="assessid" required >
                                            <option>Select</option>
                                            @foreach($type as $list)
                                                <option class="text-capitalize" value="{{$list->id}}">{{$list->title}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="form-row mb-3">
                                    <div class="form-group col-md-4">
                                        <label for="">Contact</label>
                                        <select class="form-control" name="userid" required >
                                            <option>Select Staff</option>
                                            @foreach($user as $list)
                                                <option class="text-capitalize" value="{{$list->id}}">{{$list->fname}} {{$list->lname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="title">Expectation</label>
                                        <input type="number" name="expectedeff" class="form-control" required value="{{old('expectedeff')}}" id="expectedeff" placeholder="Enter Expectation">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="title">Expected Hours Worked</label>
                                        <input type="number" name="expected_hour" class="form-control" required value="{{old('expected_hour')}}" id="expected_work" placeholder="Enter Expected Hours worked">
                                    </div>




                                </div>
                                <div class="form-row mb-3">
{{--                                    <div class="form-group col-md-4">--}}
{{--                                        <label for="title">Labour</label>--}}
{{--                                        <input type="number" name="labour" class="form-control" required value="{{old('labour')}}" id="labour" placeholder="Labour">--}}
{{--                                    </div>--}}
                                    <div class="form-group col-md-4">
                                        <label for="title">Total Number of Days</label>
                                        <input type="number" name="total_num" class="form-control" required value="{{old('total_num')}}" id="total_num" placeholder="Total Number of Days">
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label for="title">Specify Question</label>
                                        <input type="text" name="question" class="form-control" required value="{{old('question')}}" id="question" placeholder="Enter Question">
                                    </div>
{{--                                    <div class="form-group col-md-6">--}}
{{--                                        <label for="title">Description</label>--}}
{{--                                        <input type="text" name="description" class="form-control" required value="{{old('description')}}" id="description" placeholder="Description">--}}
{{--                                    </div>--}}
                                </div>

                                <button type="submit" class="btn btn-primary mt-3 btn-lg">Add Measure</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--  END CONTENT AREA  -->
    @if($state->isNotEmpty())
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">

                    <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Details List</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-4">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Type</th>
                                            <th>Staff</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($state as $key=> $list)
                                            <tr>
                                                <td>{{ $key + $state->firstItem() }}</td>
                                                <td class="text-capitalize">{{$list->type}}</td>
                                                <td>{{$list->fname}} {{$list->lname}}</td>
                                                <td>{{$list->description}}</td>
                                                <td>{{date_format($list->created_at,'Y-m-d')}}</td>
                                                <td><a href="{{route('get.staff.measure.delete',['id'=>$list->id])}}" class="btn btn-danger btn-sm"> Delete </a></td>
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
                                    {{ $state->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endif

@endsection
