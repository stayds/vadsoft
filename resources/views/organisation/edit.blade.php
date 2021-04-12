@extends('layouts.master')


@section('content')

    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="row layout-top-spacing">
                <div class="col-6">
                    <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4 class="text-capitalize">{{$org->name}} Details</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-4">
                                        <tbody>
                                        <tr>
                                            <td class="description text-uppercase font-weight-bold">Name</td>
                                            <td class="font-weight-bold text-capitalize">{{$org->name}}</td>
                                        </tr>
                                        <tr>
                                            <td class="description text-uppercase font-weight-bold">Sector</td>
                                            <td>{{$org->sector}}</td>
                                        </tr>
                                        <tr>
                                            <td class="description text-uppercase font-weight-bold">Contact</td>
                                            <td>{{$org->fname}} {{$org->lname}}</td>
                                        </tr>
                                        <tr>
                                            <td class="description text-uppercase font-weight-bold">Phone</td>
                                            <td>{{$org->phone}}</td>
                                        </tr>
                                        <tr>
                                            <td class="description text-uppercase font-weight-bold">Email</td>
                                            <td>{{$org->email}}</td>
                                        </tr>
                                        <tr>
                                            <td class="description text-uppercase font-weight-bold">State</td>
                                            <td>{{$org->state}}</td>
                                        </tr>
                                        <tr>
                                            <td class="description text-uppercase font-weight-bold">Address</td>
                                            <td>{{$org->address}}</td>
                                        </tr>
                                        <tr>
                                            <td class="description text-uppercase font-weight-bold">Date</td>
                                            <td>{{date_format($org->created_at,'d-m-yy')}}</td>
                                        </tr>

                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Edit {{$org->name}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div id="myloader" class="myloader myhide"></div>
                            <div class="widget-content widget-content-area">
                                <form action="{{route('post.organisation.edit')}}" method="POST" id="editfrm">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$org->id}}" required>
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
                                        <div class="form-group col-md-12">
                                            <label for="firstName">Name</label>
                                            <input type="text" class="form-control" value="{{$org->name}}" name="name" id="name">
                                        </div>
                                    </div>
                                    <div class="form-row mb-3">
                                        <div class="form-group col-md-12">
                                            <label for="lastName">Address</label>
                                            <input type="text" class="form-control" value="{{$org->address}}" name="address" id="address">
                                        </div>
                                    </div>

                                    <button type="submit" id="editbttn" class="btn btn-primary mt-3 btn-lg float-right">Edit Profile</button>
                                </form>
                            </div>

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

            $('#editbttn').on('click',function () {
                var form = $('editfrm');
                var url = form.attr('action');
                $.ajax({
                    url: url,
                    method:"POST",
                    data:{
                        data:form.serialize()
                    },
                    method: 'post',
                    dataType:'json',
                    beforeSend: function() {
                        $('#myloader').removeClass('myhide');
                    },
                    success: function (data) {
                    },
                    complete:function(){
                        $('#myloader').addClass('myhide');
                    }
                })
            });
        });
    </script>

@endsection
