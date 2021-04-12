@extends('admin.layout.main')

@section('admin')
    <div class="row">
        <div id="flStackForm" class="col-lg-12 layout-spacing layout-top-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Renew Client</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <form action="{{route('post.client.renew')}}" method="post">
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
                            <div class="form-group col-md-4 offset-2">
                                <label>Licence Duration (in Years)</label>
                                <select class="form-control" id="duration" name="duration" required>
                                    <option>Choose...</option>
                                    @foreach($duration as $list)
                                        <option value="{{$list}}">{{$list}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Licence</label>
                                <select class="form-control" id="licence" name="licenceid" required>
                                    <option selected>Choose...</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2" style="margin-top: 15px">
                                <button type="submit" class="btn btn-primary mt-3">Renew</button>
                            </div>
                        </div>
                        <div id="myloader" class="myloader myhide" style="top: 200px"></div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('adminscripts')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function () {

            $('#duration').on('change',function (event) {
                event.preventDefault();
                datax = $(this).children("option:selected").index();
                url = '{{route('get.client.create')}}';
                $.ajax({
                    url:url,
                    method:'GET',
                    data: {
                        data:datax
                    },
                    beforeSend: function() {
                        $('#myloader').removeClass('myhide');
                    },
                    success: function(data){
                        let contents = $('body #licence');
                        contents.html('');
                        contents.append('<option>Choose...</option>');
                        $.each(data,function(i,item){
                            contents.append($('<option>', {
                                value: item.id,
                                text : item.code
                            }))
                        });

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
