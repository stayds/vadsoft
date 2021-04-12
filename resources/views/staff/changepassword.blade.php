@extends('layouts.master')

@section('content')

    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="row layout-top-spacing">
                <div class="col-8 offset-2">
                    <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Change Password</h4>
                                    </div>
                                </div>
                            </div>
                            <div id="myloader" class="myloader myhide"></div>
                            <div class="widget-content widget-content-area">
                                <form action="{{route('post.staff.password')}}" method="POST">
                                    @csrf
                                    @if ($message = \Session::get('success'))

                                        <div class="alert alert-success alert-block">

                                            <button type="button" class="close" data-dismiss="alert">×</button>

                                            <strong>{{ $message }}</strong>

                                        </div>
                                    @endif
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul style="margin-bottom: 0;list-style: none">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="form-row mb-3">
                                        <div class="form-group col-md-6">
                                            <label for="firstName">Password</label>
                                            <input type="password" class="form-control" placeholder="Enter Password" name="password" id="password">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="lastName">Confirm Password</label>
                                            <input type="password" class="form-control" placeholder="Enter Confirm Password" name="password_confirmation" id="confirm">
                                        </div>
                                    </div>

                                    <button type="submit" id="editbttn" class="btn btn-primary mt-3 btn-lg float-right">Change Password</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
