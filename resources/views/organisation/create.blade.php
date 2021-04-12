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
                                    <h4>Add Organisation</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            @if($orgcount < $clientorg)
                                <form action="{{route('post.organisation.create')}}" method="POST">
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
                                    <div class="form-group col-md-4">
                                        <label for="inputState">Sector</label>
                                        <select id="inputState" class="form-control" name="sectorid">
                                            <option selected>Choose...</option>
                                            @foreach($sectors as $list)
                                                <option value="{{$list->id}}">{{$list->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="firstName">Organisation Name</label>
                                        <input type="text" class="form-control" id="name" value="{{old('name')}}" name="name" placeholder="Organisation name">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputState">State (office location)</label>
                                        <select id="inputState" class="form-control" name="stateid">
                                            <option selected>Choose...</option>
                                            @foreach($states as $list)
                                                <option value="{{$list->id}}">{{$list->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row mb-3">
                                    <div class="form-group col-md-12">
                                        <label for="inputCity">Address (office location)</label>
                                        <input type="text" class="form-control" id="address" name="address" value="{{old('address')}}">
                                    </div>
                                </div>

                                <div class="widget-header" style="padding: 0 !important; margin:10px 0 20px">
                                        <h4 style="padding: 0 !important;">Admin Details</h4>
                                        <hr style="margin: 0 !important;">
                                    </div>
                                <div class="form-row mb-3">
                                    <div class="form-group col-md-4">
                                        <label for="fname">First Name</label>
                                        <input type="text" class="form-control" id="fname" value="{{old('fname')}}" name="fname" placeholder="Enter First name">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="fname">Last Name</label>
                                        <input type="text" class="form-control" id="lname" value="{{old('lname')}}" name="lname" placeholder="Enter Last name">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="gender">Gender</label>
                                        <select id="inputState" class="form-control" name="gender">
                                            <option selected>Choose...</option>
                                            @foreach($gender as $list)
                                                <option value="{{$list}}">{{$list}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row mb-3">
                                    <div class="form-group col-md-4">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" id="phone" value="{{old('phone')}}" name="phone" placeholder="Phone">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" value="{{old('email')}}" name="email" placeholder="Enter Email">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="staffno">Staff Number</label>
                                        <input type="text" class="form-control" id="staffno" name="staffno" value="{{old('staffno')}}" placeholder="Enter Staff Number">
                                    </div>
                                </div>
                                <div class="form-row mb-4">
                                    <div class="form-group col-md-4">
                                        <label for="jobtitle">Job Title</label>
                                        <input type="text" class="form-control" id="jobtitle" value="{{old('jobtitle')}}" name="jobtitle" placeholder="Enter Job Title">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="gradelevel">Grade Level</label>
                                        <input type="text" class="form-control" id="gradelevel" value="{{old('gradelevel')}}" name="gradelevel" placeholder="Enter Grade Level">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="jobdesc">Job Description</label>
                                        <input type="text" class="form-control" id="jobdesc" name="jobdesc" placeholder="Enter Job Description">
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-primary mt-3 btn-lg">Add Organisation</button>
                            </form>
                            @else
                                <h5 class="text-center text-capitalize text-danger">Sorry you have exceeded the number of organisations you can create </h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
