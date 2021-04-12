@extends('layouts.master')


@section('content')


    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="row layout-top-spacing">

                <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Unit Measurement Parameter</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form action="{{route('post.measure.unit.entry')}}" method="POST">
                                @csrf
                                <input type="hidden" name="unitstateid" value="{{$data->id}}">
                                <input type="hidden" name="routine" value="{{$data->routine}}">
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
                                        <p class="text-capitalize">{{$data->question}}</p>
                                    </div>
                                </div>
                                <div class="form-row mb-3">
                                    <div class="form-group col-md-4">
                                        <label for="title">Daily Hours Worked</label>
                                        <input type="number" name="daily_hours" class="form-control" required value="{{old('daily_hours')}}" id="daily_hours" placeholder="Enter Daily Hours">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="title">Total Number Days</label>
                                        <input type="number" name="total_num" class="form-control" required value="{{old('total_num')}}" id="total_num" placeholder="Enter Total Number">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="title">Achieved</label>
                                        <input type="number" name="achievedeff" class="form-control" required value="{{old('achievedeff')}}" id="achievedeff" placeholder="Enter Achieved value">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mt-3 btn-lg">Add Measure</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--  END CONTENT AREA  -->

@endsection
