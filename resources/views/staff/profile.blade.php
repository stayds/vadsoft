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
                                    <h4>Profile Details</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            @include('staff.profiledetail')
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
                                        <h4>Edit Profile</h4>
                                    </div>
                                </div>
                            </div>
                            <div id="myloader" class="myloader myhide"></div>
                            <div class="widget-content widget-content-area">
                                <form action="{{route('post.staff.profile')}}" id="editfrm">
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
                                            <label for="firstName">First name</label>
                                            <input type="text" class="form-control" value="{{$staff->fname}}" name="fname" id="firstName">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="lastName">Last name</label>
                                            <input type="text" class="form-control" value="{{$staff->lname}}" name="lname" id="lastName">
                                        </div>
                                    </div>
                                    <div class="form-row mb-3">
                                        <div class="form-group col-md-6">
                                            <label for="lastName">Staff Number</label>
                                            <input type="text" class="form-control" value="{{$staff->staffno}}" name="staffno" id="staffno">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="lastName">Gradelevel</label>
                                            <input type="text" class="form-control" value="{{$staff->gradelevel}}" name="gradelevel" id="gradelevel">
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
