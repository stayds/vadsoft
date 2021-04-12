@if($check)
    <div class="layout-px-spacing" id="load">
        <div class="row">
            <div class="col-6">
                <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4 class="text-uppercase">Detail</h4>
                                </div>
                            </div>
                        </div>

                        <div class="widget-content widget-content-area">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <td class="description text-uppercase font-weight-bold">Full Name</td>
                                        <td>{{$profile->fullname()}}</td>
                                    </tr>
                                    <tr>
                                        <td class="description text-uppercase font-weight-bold">Staff No.</td>
                                        <td>{{$profile->staffno}}</td>
                                    </tr>
                                    <tr>
                                        <td class="description text-uppercase font-weight-bold">Grade Level</td>
                                        <td>{{$profile->gradelevel}}</td>
                                    </tr>
                                    <tr>
                                        <td class="description text-uppercase font-weight-bold">No. Of KPI</td>
                                        <td>{{$kpi}}</td>
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
                                    <h4 class="text-uppercase">Average Productivity Index</h4>
                                </div>
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h1 class="text-uppercase text-center">{{$prod_index}}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <td class="description text-uppercase font-weight-bold">0.1 - 0.499</td>
                                        <td>Fair Needs Improvement</td>
                                    </tr>
                                    <tr>
                                        <td class="description text-uppercase font-weight-bold">0.5 - 0.799</td>
                                        <td>Good Need Improvement</td>
                                    </tr>
                                    <tr>
                                        <td class="description text-uppercase font-weight-bold">0.8 - 1.0</td>
                                        <td>Great Sustain Improvement</td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@else
    <div class="layout-px-spacing" id="load">
        <div class="row">
            <div class="col-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4 class=" text-danger text-center">Sorry no record exist for this Staff</h4>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endif
