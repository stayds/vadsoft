
<div class="layout-px-spacing">

    <div class="row layout-top-spacing">

        <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4 class="font-weight-bold">{{$name}} Details</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-4">
                            <thead>

                            <tr>
                                <th>Measure</th>
                                <th>Description</th>
                                <th>Expected Hours</th>
                                <th>Expectation</th>
                                <th>Labour</th>
                                <th>Achieved Hours</th>
                                <th>No. of Days</th>
                                <th>Achieved</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $index=0;  ?>
                            @forelse($data as $key => $list)
                                <tr>
                                    <td class="text-capitalize font-weight-bold">{{$list->measuretype->name}}</td>
                                    <td class="text-capitalize">{{$list->description}}</td>
                                    <td>{{$list->expected_hour}}</td>
                                    <td>{{$list->expectedeff}}</td>
                                    @foreach($list->unittatehistories as $result)
                                        @if($index > 0 )
                                            <?php $index *=$result->checkavg;  ?>
                                        @else
                                            <?php $index=$result->checkavg;  ?>
                                        @endif
                                        <td>{{$result->labour}}</td>
                                        <td>{{$result->daily_hours}}</td>
                                        <td>{{$result->total_num}}</td>
                                        <td>{{$result->achievedeff}}</td>
                                <tr>
                                    <th colspan="5"></th>
                                    <th>Input</th>
                                    <th>Output</th>
                                    <th>Check</th>
                                </tr>
                                <tr>
                                    <td colspan="5"></td>
                                    <td>{{$result->checkinput}}</td>
                                    <td>{{$result->checkoutput}}</td>
                                    <td>{{$result->checkavg}}</td>
                                </tr>

                                @endforeach
                                </tr>
                            @empty
                                <tr><td colspan="8" class="text-capitalize text-danger" style="border: none"> No Records exist at the moment</td></tr>

                            @endforelse
                            </tbody>
                        </table>
                        <p class="font-weight-bold" style="font-size: 18px"><span class="text-danger text-capitalize">productivity index:</span> <span>{{$index}}</span> </p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

