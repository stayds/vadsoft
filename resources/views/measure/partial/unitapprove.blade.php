<div class="row layout-top-spacing">
    <div class="col-6">
        <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4 class="text-uppercase">Efficiency Parameters</h4>
                        </div>
                        <div class="offset-1 col-xl-11 col-md-11 col-sm-11 col-11">
                            <p> <strong>Question:</strong> {{$data->question_effy}}</p>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td class="description text-uppercase font-weight-bold">Expected Output</td>
                                <td>{{$data->expected_effy}}</td>
                            </tr>
                            <tr>
                                <td class="description text-uppercase font-weight-bold">Expected Hours</td>
                                <td>{{$data->expected_hour_effy}}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="description text-uppercase font-weight-bold"></td>

                            </tr>
                            <tr>
                                <td class="description text-uppercase font-weight-bold">Achieved Output</td>
                                <td>{{$history->achievedeff_effy}}</td>
                            </tr>
                            <tr>
                                <td class="description text-uppercase font-weight-bold">Labour</td>
                                <td>{{$history->labour_effy}}</td>
                            </tr>
                            <tr>
                                <td class="description text-uppercase font-weight-bold">Daily Hours</td>
                                <td>{{$history->daily_hours_effy}}</td>
                            </tr>
                            <tr>
                                <td class="description text-uppercase font-weight-bold">Number of Days Worked</td>
                                <td>{{$history->total_num_effy}}</td>
                            </tr>

                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-6">
        <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4 class="text-uppercase">Effectiveness Paramenter</h4>
                        </div>
                        <div class="offset-1 col-xl-11 col-md-11 col-sm-11 col-11">
                            <p> <strong>Question:</strong> {{$data->question_effv}}</p>
                        </div>
                    </div>
                </div>
                <div id="myloader" class="myloader myhide"></div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td class="description text-uppercase font-weight-bold">Expected Output</td>
                                <td>{{$data->expected_effv}}</td>
                            </tr>
                            <tr>
                                <td class="description text-uppercase font-weight-bold">Expected Hours</td>
                                <td>{{$data->expected_hour_effv}}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="description text-uppercase font-weight-bold"></td>

                            </tr>
                            <tr>
                                <td class="description text-uppercase font-weight-bold">Achieved Output</td>
                                <td>{{$history->achievedeff_effv}}</td>
                            </tr>
                            <tr>
                                <td class="description text-uppercase font-weight-bold">Labour</td>
                                <td>{{$history->labour_effv}}</td>
                            </tr>
                            <tr>
                                <td class="description text-uppercase font-weight-bold">Daily Hours</td>
                                <td>{{$history->daily_hours_effv}}</td>
                            </tr>
                            <tr>
                                <td class="description text-uppercase font-weight-bold">Number of Days Worked</td>
                                <td>{{$history->total_num_effy}}</td>
                            </tr>

                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-4 offset-4">
        <table class="table table-bordered">
            <tbody>
            <tr style="" class="font-weight-bold">
                <td colspan="2" class="" style="font-size:18px">Productivity Index - <span class="text-danger">{{$history->kpi}}</span></td>

            </tr>
            </tbody>
        </table>
    </div>
</div>
