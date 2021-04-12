@if($unitnotice->isNotEmpty())
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
            <div class="table-responsive">
                <table class="table table-bordered mb-4">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Routine</th>
                        <th class="text-center">Date registered</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $count = 0 ?>
                    @foreach($unitnotice as $list)
{{--                        @if($list->created_at->greaterThan($list->next_entry))--}}
                            <tr class="text-capitalize">
                            <td>{{++$count}}</td>
                            <td class=" font-weight-bold">{{$list->name}}</td>
                            <td>{{$list->routine}}</td>
                            <td class="text-center">{{date_format($list->created_at,'d-m-yy')}}</td>
                            <td class="text-center">
                                <a href="{{route('get.measure.unit.entry',['id'=>$list->id])}}" class="btn btn-sm btn-primary"> Make Entry</a>
                            </td>

                        </tr>
{{--                        @endif--}}
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif
