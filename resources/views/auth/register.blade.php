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
                                    <h4>STAFF</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form method="POST" action="{{ route('register') }}">

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
                                        <label for="firstName">First name</label>
                                        <input type="text" class="form-control" id="firstName" placeholder="First name" name="fname" required value="{{old('fname')}}">
                                        @error('fname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="lastName">Last name</label>
                                        <input type="text" class="form-control" name="lname" required value="{{old('lname')}}" id="lastName" placeholder="Last name">
                                        @error('lname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" name="phone" value="{{old('phone')}}" required id="phone" placeholder="Phone">
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row mb-3">
                                    <div class="form-group col-md-4">
                                        <label for="inputState">Gender</label>
                                        <select id="inputState" class="form-control" name="gender" required>
                                            <option selected>Choose...</option>
                                            @foreach ($gender as $list)
                                                <option value="{{$list}}">{{$list}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="Inputemail">Email</label>
                                        <input type="email" class="form-control" name="email" value="{{old('email')}}" required id="Inputemail" placeholder="Email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="StaffNo">Staff Number</label>
                                        <input type="text" class="form-control" name="staffno" value="{{old('staffno')}}" required id="StaffNo" placeholder="Staff number">
                                        @error('staffno')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row mb-3">
                                    <div class="form-group col-md-4">
                                        <label for="inputState">Organisation</label>
                                        <select id="organid" class="form-control" name="organid">
                                            <option selected>Choose...</option>
                                            @foreach ($org as $list)
                                                <option value="{{$list->id}}">{{$list->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputState">Department</label>
                                        <select id="deptid" class="form-control" name="departmentid">
                                            <option selected>Choose...</option>

                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="StaffNo">Job Title</label>
                                        <input type="text" class="form-control" id="jo" placeholder="Jobtitle" name="jobtitle" value="{{old('jobtitle')}}">
                                        @error('jobtitle')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div id="myloader" class="myloader myhide"></div>
                                <div class="form-row mb-3">
                                    <div class="form-group col-md-4">
                                        <label for="grade">Grade/Level</label>
                                        <input type="text" class="form-control" required id="grade" name="gradelevel" value="{{old('gradelevel')}}" placeholder="Grade/Level">
                                        @error('gradelevel')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="jd">Job Description</label>
                                        <input type="text" name="jobdesc" class="form-control" id="jd" placeholder="Job description">
                                        @error('jobdesc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputState">Receive the assesment link</label>
                                        <select id="inputState" class="form-control" name="receive">
                                            <option selected>Choose...</option>
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>

                                </div>
{{--                                <div class="form-row mb-3">--}}
{{--                                    <div class="form-group col-md-4">--}}
{{--                                        <label for="inputState">Role</label>--}}
{{--                                        <select id="inputState" class="form-control" name="roleid">--}}
{{--                                            <option selected>Choose...</option>--}}
{{--                                            @foreach ($role as $list)--}}
{{--                                                <option value="{{$list->id}}">{{$list->name}}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                @else
                                    <div class="form-row mb-3">
                                        <div class="form-group col-md-4">
                                            <label for="firstName">First name</label>
                                            <input type="text" class="form-control" id="firstName" placeholder="First name" name="fname" required value="{{old('fname')}}">
                                            @error('fname')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="lastName">Last name</label>
                                            <input type="text" class="form-control" name="lname" required value="{{old('lname')}}" id="lastName" placeholder="Last name">
                                            @error('lname')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="phone">Phone</label>
                                            <input type="text" class="form-control" name="phone" value="{{old('phone')}}" required id="phone" placeholder="Phone">
                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row mb-3">
                                        <div class="form-group col-md-4">
                                            <label for="inputState">Gender</label>
                                            <select id="inputState" class="form-control" name="gender" required>
                                                <option selected>Choose...</option>
                                                @foreach ($gender as $list)
                                                    <option value="{{$list}}">{{$list}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="Inputemail">Email</label>
                                            <input type="email" class="form-control" name="email" value="{{old('email')}}" required id="Inputemail" placeholder="Email">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="StaffNo">Staff Number</label>
                                            <input type="text" class="form-control" name="staffno" value="{{old('staffno')}}" required id="StaffNo" placeholder="Staff number">
                                            @error('staffno')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row mb-3">
                                        <div class="form-group col-md-4">
                                            <label for="inputState">Department</label>
                                            <select id="deptid" class="form-control" name="departmentid">
                                                <option selected>Choose...</option>
                                                @foreach ($dept as $list)
                                                    <option value="{{$list->id}}">{{$list->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="StaffNo">Job Title</label>
                                            <input type="text" class="form-control" id="jo" placeholder="Jobtitle" name="jobtitle" value="{{old('jobtitle')}}">
                                            @error('jobtitle')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div id="myloader" class="myloader myhide"></div>
                                    <div class="form-row mb-3">
                                        <div class="form-group col-md-4">
                                            <label for="grade">Grade/Level</label>
                                            <input type="text" class="form-control" required id="grade" name="gradelevel" value="{{old('gradelevel')}}" placeholder="Grade/Level">
                                            @error('gradelevel')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="jd">Job Description</label>
                                            <input type="text" name="jobdesc" class="form-control" id="jd" placeholder="Job description">
                                            @error('jobdesc')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputState">Receive the assesment link</label>
                                            <select id="inputState" class="form-control" name="receive">
                                                <option selected>Choose...</option>
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>

                                    </div>
                                @endif
                                <button type="submit" class="btn btn-primary mt-3 btn-lg">Add Staff</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('change','#organid',function () {
                var org = $(this).children('option:selected').val();
                $.ajax({
                    url: "{{route('register')}}",
                    data:{
                        id:org
                    },
                    method: 'GET',
                    dataType:'json',
                    type:'GET',
                    beforeSend: function() {
                        $('#myloader').removeClass('myhide');
                    },
                    success: function (data) {
                       let dept =  $('body #deptid');
                       dept.empty();
                       dept.append('<option>Choose Department</option>')
                        $.each(data, function (i, item) {

                            dept.append($('<option>', {
                                value: item.id,
                                text : item.name
                            }));
                        });
                    },
                    complete:function(){
                        $('#myloader').addClass('myhide');
                    }
                })
            });
        });
    </script>

@endsection

