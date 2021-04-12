@extends('admin.layout.main')

@section('admin')
    <div class="row">
        <div id="flStackForm" class="col-lg-12 layout-spacing layout-top-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Generate Licence</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <form action="{{route('post.licence.create')}}" method="post">
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
                                <label>Licence Duration</label>
                                <select class="form-control" name="duration" required>
                                    <option>Choose...</option>
                                    @foreach($duration as $list)
                                        <option value="{{$list}}">{{$list}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-5">
                                <label>Number of Licence to Generate</label>
                                <input type="number" class="form-control" id="num_licence" value="{{old('num_licence')}}" name="num_licence" aria-describedby="emailHelp1" placeholder="Enter Number to Generate">
                            </div>
                            <div class="form-group col-md-2" style="margin-top: 15px">
                                <button type="submit" class="btn btn-primary mt-3">Generate</button>
                            </div>

                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
