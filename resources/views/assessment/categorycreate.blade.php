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
                                    <h4>Create Assessment Category</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form action="{{route('post.assessment.category.create')}}" method="POST">
                                @csrf
                                @if ($message = \Session::get('success'))

                                    <div class="alert alert-success alert-block">

                                        <button type="button" class="close" data-dismiss="alert">×</button>

                                        <strong>{{ $message }}</strong>

                                    </div>
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
                                    <div class="form-group col-md-6">
                                        <label for="">What do you want to Measure</label>
                                        <select class="form-control" name="measure" required >
                                            <option>Select Efficieny or Effectiveness</option>
                                            @foreach($measure as $key=> $list)
                                                <option class="text-capitalize" value="{{$list}}">{{$key}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">Assessment Type</label>
                                        <select class="form-control" name="assessid" required >
                                            <option>Select Assessment Type</option>
                                            @foreach($type as $list)
                                                <option class="text-capitalize" value="{{$list->id}}">{{$list->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="form-row mb-3">
                                    <div class="form-group col-md-6">
                                        <label for="">Select KPI been measured</label>
                                        <select class="form-control" name="kpiid" required >
                                            <option>Select KPI</option>
                                            @foreach($kpi as $list)
                                                <option class="text-capitalize" value="{{$list->id}}">{{$list->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="title">Description</label>
                                        <input type="text" name="description" class="form-control" required value="{{old('description')}}" id="description" placeholder="Description">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3 btn-lg">Add Category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--  END CONTENT AREA  -->

@endsection
