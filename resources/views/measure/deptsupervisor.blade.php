@extends('layouts.master')


@section('content')

    <div id="content" class="main-content">
        <div class="layout-px-spacing" id="load">
            <?php $history = $data->deptstatehistories[0] ?>
                <div id="myloader" class="myloader myhide" style="top: 200px"></div>
            @if($history->approve_effy == 0)
                @include('measure.partial.deptview')
            @elseif($history->approve_effy == 2)
                @include('measure.partial.deptapprove')
            @elseif($history->approve_effy == 1)
                    <div class="row layout-top-spacing" style="margin-top: 100px">
                        <div class="col-8 col-md-8 col-lg-8 col-sm-12 offset-2">
                            <div class="widget-content widget-content-area" id="reject">
                                <p id="" class="text-danger">
                                    Based on your rejection of the data, a mail notifying the change of state has been sent
                                </p>
                            </div>
                        </div>
                    </div>
            @endif
        </div>
    </div>

@endsection

@section('scripts')
    <script>


        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function accessdata(url){
                $.ajax({
                    url: url,
                    method: 'GET',
                    dataType:'json',
                    beforeSend: function() {
                        $('#myloader').removeClass('myhide');
                    },
                    success: function (data) {
                       location.reload();
                    },
                    complete:function(){
                        $('#myloader').addClass('myhide');
                    }
                })
            }


            $("body#myloader").addClass('myhide');

            $('#rej').on('click',function (e) {
                e.preventDefault();
                var url = $(this).attr('href');
                accessdata(url);
            });
            $('#app').on('click',function (e) {
                e.preventDefault();
                var url = $(this).attr('href');
                accessdata(url);
            });


        });
    </script>

@endsection

