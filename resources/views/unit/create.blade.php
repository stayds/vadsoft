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
                                    <h4>UNIT</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form action="{{route('post.unit.create')}}" method="POST">
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
                                    <div class="form-group col-md-4">
                                        <label for="inputState">Department</label>
                                        <select id="organid" class="form-control" name="deptid" >
                                            <option selected>Choose...</option>
                                            @foreach ($dept as $list)
                                                <option value="{{$list->id}}">{{$list->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="unitName">Unit Name</label>
                                        <input type="text" name="name" class="form-control" value="{{old('name')}}" required id="unitName" placeholder="Type Unit name">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="uniDesc">Unit Description</label>
                                        <input type="text" name="description" value="{{old('description')}}" required class="form-control" id="unitDesc" placeholder="Type Unit Description">
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-primary mt-3 btn-lg">Add Unit</button>
                            </form>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>

@endsection
