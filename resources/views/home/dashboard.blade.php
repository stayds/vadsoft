@extends('layouts.master')


@section('content')


    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="row layout-top-spacing">

                @include('home.aggregate')
                <br>
                @include('home.staff')
                <br>
                @include('home.department')
{{--                <br>--}}
{{--                @include('home.unit')--}}
                @include('home.supervisor')
                @include('home.supervisorstaff')
            </div>

        </div>
    </div>



@endsection
