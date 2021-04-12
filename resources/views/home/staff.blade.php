   @if($staffnotice->isNotEmpty())
        <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>Staff Measurement Parameter</h4>
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
                        <th class="text-center">Date registered</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $count = 0 ?>
                    @foreach($staffnotice as $list)
                        {{--                        @if($list->created_at->greaterThan($list->next_entry))--}}
                        <tr class="text-capitalize">
                            <td>{{++$count}}</td>
                            <td class=" font-weight-bold">{{$list->question_effy}}</td>
                            <td class="text-center">{{date_format($list->created_at,'d-m-yy')}}</td>
                            <td class="text-center">
                                @if($list->approve_effy === null || $list->approve_effy == 1)
                                    <a href="{{route('get.measure.staff.entry',['id'=>$list->id,'type'=>1])}}" class="btn btn-sm btn-primary"> Efficiency</a>
                                @endif
                                @if($list->approve_effv === null || $list->approve_effv == 1)
                                    <a href="{{route('get.measure.staff.entry',['id'=>$list->id,'type'=>2])}}" class="btn btn-sm btn-primary"> Effectiveness</a>
                                @endif
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
