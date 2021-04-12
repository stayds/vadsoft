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
                                    <h4>DEPARTMENT</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form method="POST" action="{{route('post.department.create')}}">
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
                                @if(isset($org))
                                    <div class="form-row mb-3">

                                    <div class="form-group col-md-4">
                                        <label for="DeptName">Organisation</label>
                                        <select id="inputState" class="form-control" name="organid" required>
                                            <option selected>Choose...</option>
                                            @foreach ($org as $list)
                                                <option value="{{$list->id}}">{{$list->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="DeptName">Name of Department</label>
                                        <input type="text" class="form-control" name="name" value="{{old('name')}}" required id="DeptName" placeholder="Department name">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="DeptDesc">Department Description</label>
                                        <input type="text" class="form-control" name="description" value="{{old('description')}}" required id="DeptDesc" placeholder="Department description">
                                        @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                    <div class="form-row mb-3">
                                    <div class="form-group col-md-6">
                                        <label for="DeptDesc">Office Address</label>
                                        <input type="text" name="address" value="{{old('address')}}" required class="form-control" id="DeptDesc" placeholder="Office Address">
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="DeptName">State</label>
                                        <select id="inputState" class="form-control" name="stateid" required>
                                            <option selected>Choose...</option>
                                            @foreach ($states as $list)
                                                <option value="{{$list->id}}">{{$list->name}}</option>
                                            @endforeach
                                        </select>                                    </div>

                                </div>
                                @else
                                    <div class="form-row mb-3">

                                        <div class="form-group col-md-4">
                                            <label for="DeptName">Name of Department</label>
                                            <input type="text" class="form-control" name="name" value="{{old('name')}}" required id="DeptName" placeholder="Department name">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror

                                        </div>

                                        <div class="form-group col-md-8">
                                            <label for="DeptDesc">Department Description</label>
                                            <input type="text" class="form-control" name="description" value="{{old('description')}}" required id="DeptDesc" placeholder="Department description">
                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row mb-3">
                                        <div class="form-group col-md-4">
                                            <label for="DeptName">State</label>
                                            <select id="inputState" class="form-control" name="stateid" required>
                                                <option selected>Choose...</option>
                                                @foreach ($states as $list)
                                                    <option value="{{$list->id}}">{{$list->name}}</option>
                                                @endforeach
                                            </select>                                    </div>
                                        <div class="form-group col-md-8">
                                            <label for="DeptDesc">Office Address</label>
                                            <input type="text" name="address" value="{{old('address')}}" required class="form-control" id="DeptDesc" placeholder="Office Address">
                                            @error('address')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                                <button type="submit" class="btn btn-primary mt-3 btn-lg">Add Department</button>
                            </form>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>

@endsection
