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
                                    <h4>Add Assessment Type</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form action="{{route('post.assessment.create')}}" method="POST">
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
                                @if(is_array($organ))
                                    <div class="form-row mb-3">
                                    <div class="form-group col-md-4">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="{{old('title')}}" placeholder="Title">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="">Assessment</label>
                                        <select class="form-control" name="type" required >
                                            <option>Select ...</option>
                                            @foreach($type as $key => $list)
                                                <option value="{{$list}}">{{$key}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Organisation</label>
                                        <select class="form-control" name="organid" required >
                                            <option>Select ...</option>
                                            @foreach($organ as  $list)
                                                <option value="{{$list->id}}">{{$list->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @else
                                    <div class="form-row mb-3">
                                        <div class="form-group col-md-6">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="{{old('title')}}" placeholder="Title">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="">Assessment</label>
                                            <select class="form-control" name="type" required >
                                                <option>Select ...</option>
                                                @foreach($type as $key => $list)
                                                    <option value="{{$list}}">{{$key}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                <button type="submit" class="btn btn-primary mt-3 btn-lg">Add Assessment Type</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--  END CONTENT AREA  -->

@endsection
