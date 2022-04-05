@extends('layout')
@section('content')
<div class="ex-form-1 pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 offset-xl-3">
                <div class="text-box mt-5 mb-5">

                    <!-- Sign Up Form -->
                    <form>
                        <h1 style="text-align: center ">ĐĂNG KÝ</h1>
                        <div class="mb-4 form-floating">
                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="mb-4 form-floating">
                            <input type="text" class="form-control" id="floatingInput2" placeholder="Your name">
                            <label for="floatingInput">Your name</label>
                        </div>
                        <div class="mb-4 form-floating">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Tôi đồng ý với những điều khoản<a href="privacy.html">Xem điều khoản</a></label>
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