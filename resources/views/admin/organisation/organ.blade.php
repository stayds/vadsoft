@extends('admin.layout.main')

@section('admin')
    <div class="row">
        <div id="flStackForm" class="col-lg-12 layout-spacing layout-top-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Setup Primary Organisation</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <form action="{{route('post.client.organisation.create')}}" method="post">
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
                                <label for="firstName">Organisation Name</label>
                                <input type="text" class="form-control" id="name" value="{{old('name')}}" name="name" required placeholder="Organisation name">
                            </div>

                        </div>
                        <div class="widget-header" style="padding: 0 !important; margin:10px 0 20px">
                            <h4 style="padding: 0 !important;">Admin Details</h4>
                            <hr style="margin: 0 !important;">
                        </div>
                        <div class="form-row mb-3">
                            <div class="form-group col-md-4">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control" id="fname" value="{{old('fname')}}" name="fname" placeholder="Enter First name" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="fname">Last Name</label>
                                <input type="text" class="form-control" id="lname" value="{{old('lname')}}" name="lname" placeholder="Enter Last name" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="gender">Gender</label>
                                <select id="inputState" class="form-control" name="gender" required>
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
                                <input type="text" class="form-control" id="phone" value="{{old('phone')}}" name="phone" placeholder="Phone" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" value="{{old('email')}}" name="email" placeholder="Enter Email" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="staffno">Staff Number</label>
                                <input type="text" class="form-control" id="staffno" name="staffno" value="{{old('staffno')}}" placeholder="Enter Staff Number" required>
                            </div>
                        </div>
                        <div class="form-row mb-4">
                            <div class="form-group col-md-4">
                                <label for="jobtitle">Job Title</label>
                                <input type="text" class="form-control" id="jobtitle" value="{{old('jobtitle')}}" name="jobtitle" placeholder="Enter Job Title" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="gradelevel">Grade Level</label>
                                <input type="text" class="form-control" id="gradelevel" value="{{old('gradelevel')}}" name="gradelevel" placeholder="Enter Grade Level" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="jobdesc">Job Description</label>
                                <input type="text" class="form-control" id="jobdesc" value="{{old('jobdesc')}}" name="jobdesc" placeholder="Enter Job Description" required>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
