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
                                    <h4>Key Performance Index List</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-4">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Title</th>
                                        <th>Routine</th>
{{--                                        <th>Description</th>--}}
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($kpi as $key=>$data)
                                        <tr>
                                            <td>{{ $key + $kpi->firstItem() }}</td>
                                            <td>{{$data->title}}</td>
                                            <td class="text-capitalize">{{$data->routine}}</td>
{{--                                            <td>{{$data->description}}</td>--}}
                                            <td>{{$data->getFormattedDateAttribute()}}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <div class="text-danger text-center text-capitalize font-weight-bold font-15">
                                                No Record exist
                                            </div>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                {{ $kpi->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--  END CONTENT AREA  -->

@endsection
