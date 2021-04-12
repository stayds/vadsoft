@extends('layouts.main')

@section('login')
    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                        <h1 class="">Reset Password</h1>
                        <form class="text-left" method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul class="validata">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form">
                            <div id="email" class="field-wrapper input">
                                <div class="d-flex justify-content-between">
                                    <label for="email">EMAIL</label>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>
                                <input id="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus type="email" class="form-control" placeholder="Enter Email Address">
                            </div>
                            <div id="password" class="field-wrapper input">
                                <div class="d-flex justify-content-between">
                                    <label for="password">Password</label>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                <input id="password" name="password" required autofocus type="password" class="form-control" placeholder="Password">
                            </div>
                            <div id="confirm" class="field-wrapper input">
                                <div class="d-flex justify-content-between">
                                    <label for="confirm">Confirm Password</label>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                <input id="password_confirmation" name="password_confirmation" required autofocus type="password" class="form-control" placeholder="Confirm Password">
                            </div>
                        </div>
                        <div class="d-sm-flex justify-content-between">
                            <div class="field-wrapper">
                                <button type="submit" class="btn btn-primary" value="">Reset Password</button>
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
