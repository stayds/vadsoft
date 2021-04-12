@extends('admin.layout.main')

@section('admin')
<div class="row">
    @if(!is_null($client))
        <div id="profile"  class="col-lg-6 layout-spacing layout-top-spacing">
        @include('admin.client.profile')
        </div>
        <div id="myloader" class="myloader myhide" style="top: 200px"></div>
        <div id="flStackForm" class="col-lg-6 layout-spacing layout-top-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Edit Client Details</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <form action="{{route('post.client.update')}}" method="post">
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
                        <input type="hidden" name="id" value="{{$client->id}}" required>
                        <div class="form-row mb-3">
                            <div class="form-group col-md-6">
                                <label>Sector</label>
                                <select class="form-control" name="sectorid" required>
                                    <option>Choose...</option>
                                    @foreach($sector as $list)
                                        <option @if($list->id === $client->sectorid) selected @endif value="{{$list->id}}">{{$list->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Client Name</label>
                                <input type="text" class="form-control" id="cname" value="{{$client->name}}" name="name" aria-describedby="emailHelp1" required placeholder="Client Name">
                            </div>

                        </div>
                        <div id="myloader" class="myloader myhide" style="top: 200px"></div>
                        <div class="form-row mb-3">
                            <div class="form-group col-md-6">
                                <label>Number of Organisations</label>
                                <input type="number" class="form-control" name="organ" required value="{{$client->organ}}" id="num" placeholder="Number of Organisation">
                            </div>
                            <div class="form-group col-md-6">
                                <label>State</label>
                                <select class="form-control" name="stateid" required>
                                    <option>Choose State...</option>
                                    @foreach($state as $list)
                                        <option @if($list->id === $client->stateid) selected @endif value="{{$list->id}}">{{$list->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="form-row mb-3">
                            <div class="form-group col-md-12">
                                <label>Address</label>
                                <input type="text" class="form-control" id="address" name="address" required value="{{$client->address}}" placeholder="Address">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="col-lg-6 layout-spacing layout-top-spacing">
            <div class="col-12 layout-spacing">
                <div class="widget-three">
                    
                    <div class="widget-content">
                       <h4 class="text-center text-danger">No client detail exist at the moment</h4>
                    </div>
                </div>
            </div>
        </div>
  
    @endif
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
