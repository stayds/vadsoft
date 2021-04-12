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
                                    <h4>Report</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form id="staffbttn" action="{{route('get.staff.report')}}">
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
                                        <label for="DeptName">Staff</label>
                                        <select id="userid" class="form-control" name="userid" required>
                                            <option selected>Choose...</option>
                                            @foreach ($staff as $list)
                                                <option value="{{$list->id}}">{{$list->userprofile->fname}} {{$list->userprofile->lname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6" style="margin-top: 12px">
                                        <button type="submit" id="repbttn" class="btn btn-primary mt-3 btn-lg">Generate Report</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <div id="myloader" class="myloader myhide" style="top: 200px"></div>
    <div id="content" class="main-content staffinfo">

    </div>

@endsection

@section('scripts')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function () {

            $('#repbttn').click(function (event) {
                event.preventDefault();
                let form = $('#staffbttn');
                let route = form.attr('action');


                $.ajax({
                    url:route,
                    method:'GET',
                    data: form.serialize(),
                    beforeSend: function() {
                        $('#myloader').removeClass('myhide');
                        $('#userid').attr('disable',true)
                    },
                    success: function(data){
                        let contents = $('.staffinfo');
                        contents.html(data);
                    },
                    error: function(data){

                    },
                    complete:function(){
                        $('#myloader').addClass('myhide');
                    }
                })
            })
        });

    </script>

@endsection
