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
                                    <h4 id="depts">ASSIGN UNIT SUPERVISOR</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form method="POST" action="{{route('post.unit.supervisor')}}">
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
                                    <div class="form-group col-md-6" >
                                        <label for="inputState">Unit</label>
                                        <select id="depts" class="form-control" name="unitid" required>
                                            <option selected>Select Unit</option>
                                            @foreach($unit as $list)
                                                <option value="{{$list->id}}">{{$list->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div id="myloader" class="myloader myhide"></div>
                                    <div class="form-group col-md-6">
                                        <label for="DeptDesc">Staff</label>
                                        <select id="staff" class="form-control" name="userid" required>
                                            <option selected>Choose...</option>

                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3 btn-lg">Set As Supervisor</button>
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

            $(document).on('change','#depts',function () {
                var unit = $(this).children('option:selected').val();
                $.ajax({
                    url: "{{route('get.unit.supervisor')}}",
                    data:{
                        unitid:unit
                    },
                    method: 'GET',
                    dataType:'json',
                    type:'GET',
                    beforeSend: function() {
                        $('#myloader').removeClass('myhide');
                    },
                    success: function (data) {
                        $.each(data, function (i, item) {
                            $('body #staff').append($('<option>', {
                                value: item.id,
                                text : item.fname+' '+item.lname
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
