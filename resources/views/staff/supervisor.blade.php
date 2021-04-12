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
                                    <h4 id="depts">ASSIGN STAFF SUPERVISOR</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form method="POST" action="{{route('post.staff.supervisor')}}">
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
                                        <label for="inputState">Staff</label>
                                        <select id="userid" class="form-control" name="userid" required>
                                            <option selected>Select Staff</option>
                                            @foreach($staff as $list)
                                                <option value="{{$list->id}}">{{$list->fname}} {{$list->lname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                        <div class="form-group col-md-3" style="margin-top: 12px">
                                            <button type="submit" class="btn btn-primary mt-3 btn-lg">Set As Supervisor</button>
                                        </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection

