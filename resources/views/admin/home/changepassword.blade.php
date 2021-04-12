@extends('admin.layout.main')

@section('admin')

    <div class="row">
        <div id="flStackForm" class="col-lg-12 layout-spacing layout-top-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Change Password</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <form action="{{route('post.change.password')}}" method="post">
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

                            <div class="form-group col-md-5">
                                <label>Password</label>
                                <input type="password" class="form-control" id="password" name="password"  required placeholder="Password">
                            </div>
                            <div class="form-group col-md-5">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" id="confirm" name="password_confirmation"  required placeholder="Confirm Password">
                            </div>
                            <div class="form-group col-md-2" style="margin-top: 15px">
                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                            </div>

                        </div>
                        <div id="myloader" class="myloader myhide" style="top: 200px"></div>


                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
