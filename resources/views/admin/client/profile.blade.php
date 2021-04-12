
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>Client Details</h4>
                </div>
            </div>
        </div>
      
        @if(!is_null($client))
        <div class="widget-content widget-content-area">
            <div class="table-responsive">
                <table class="table table-bordered mb-4">
                    <tbody style="font-size: 16px">

                        <tr>
                            <td class="font-weight-bold">Name</td>
                            <td>{{$client->name}}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Organisations</td>
                            <td>{{$client->organisations->count()}}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Staff</td>
                            <td>{{$client->users->count()}}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Sector</td>
                            <td>{{$client->sector->name}}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">State</td>
                            <td>{{$client->state->name}}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Address</td>
                            <td>{{$client->address}}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        @else
        <div class="layout-px-spacing">
            <div class="row layout-top-spacing">
                <div class="col-12 layout-spacing">
                    <div class="widget-three">
                        
                        <div class="widget-content">
                           <h4 class="text-center text-danger">No client has been created</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

