@extends('layout')
@section('content')
    <div class="ex-form-1 pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3">
                    <div class="text-box mt-5 mb-5">

                        <!-- Sign Up Form -->
                        <form action="{{URL::to('/register')}}" method="POST" >
                            @csrf
                            <h1 style="text-align: center ">ĐĂNG KÝ</h1>
                            <div class="mb-4 form-floating">
                                <input required type="email" name="user_email" class="form-control" id="floatingInput"
                                    placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="mb-4 form-floating">
                                <input required type="text" name="user_name" class="form-control" id="floatingInput2"
                                    placeholder="Your name">
                                <label for="floatingInput">Your name</label>
                            </div>
                            <div class="mb-4 form-floating">
                                <input required type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Password</label>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="mb-4 form-floating">
                                <input required type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password_confirmation" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Confirm Password</label>
                            </div>
                            <button type="submit" class="form-control-submit-button">Sign up</button>
                        </form>
                        <!-- end of sign up form -->

                    </div>
                    <!-- end of text-box -->
                </div>
                <!-- end of col -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container -->
    </div>
@endsection
