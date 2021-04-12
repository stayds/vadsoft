@extends('layouts.main')

@section('login')

    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class="">Forgotten Password</h1>
                        <p class="signup-link recovery">Enter your email address and an email will be sent to you with instructions to reset your password!</p>
                        <form class="text-left" action="{{route('pass.reset')}}" method="post" id="resetf">
                            @csrf
                            <div id="info">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul class="validata">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form">
                                <div id="myloader" class="myloader myhide" style="top: 200px"></div>
                                <div id="email-field" class="field-wrapper input">
                                    <div class="d-flex justify-content-between">
                                        <label for="email">EMAIL</label>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>
                                    <input id="email" name="email" type="text" class="form-control" value="" placeholder="Enter Email Address">
                                </div>

                                <div class="d-sm-flex justify-content-between">

                                    <div class="field-wrapper">
                                        <button type="submit" id="resetb" class="btn btn-primary" value="">Submit</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <p class="float-right mt-4"><a class="text-danger" href="{{route('site')}}">Back to Login</a></p>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script>
        $(function() {
            $('#resetb').click(function(e){
                e.preventDefault();
                let form = $('#resetf');
                let route = form.attr('action');

                $.ajax({
                    url:route,
                    method:'POST',
                    data: form.serialize(),
                    beforeSend: function(){
                        // Show image container
                        $( "#email" ).prop( "disabled", true );
                        $("#myloader").show();
                    },
                    success: function(data){
                        //console.log(data);

                        if(data){
                            let con = '<div class="alert alert-success">Please check your email for password reset instruction</div>'
                            $('div#info').html(con);
                        }
                    },
                    error: function(data){
                        let con = '<div class="alert alert-danger">This email does not exist on this platform</div>'
                        $('div#info').html(con);
                    },
                    complete:function(data){
                        // Hide image container
                        $( "#email" ).prop( "disabled", false ).val('');
                        $("#myloader").hide();
                    }
                })

            })
        });



    </script>

@endsection
