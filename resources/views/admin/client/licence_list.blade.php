@extends('admin.layout.main')

@section('admin')
    <div class="row">
        <div id="flStackForm" class="col-lg-12 layout-spacing layout-top-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>List Of Licence</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-4">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Used</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($licence as $key=> $list)
                                <tr>
                                    <td>{{ $key + $licence->firstItem() }}</td>
                                    <td>{{$list->code}}</td>
                                    <td>{{($list->status) ? "Enabled" : "Disabled"}}</td>
                                    <td>{{($list->used) ? "Yes": "No"}}</td>
                                    <td>{{$list->getFormattedDateAttribute()}}</td>
                                    <td>
                                        <a href="{{route('get.licence.status',['id'=>$list->id])}}" class="btn @if($list->status == 1)btn-danger @else btn-success @endif btn-sm">

                                                <i class="fa   fa-delete"></i>{{($list->status == 1) ? "Disable" :"Enable"}}
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr><div class="text-danger text-center text-capitalize font-weight-bold font-15">
                                        No Records exist at the moment
                                    </div>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
