@extends('layout')
@section('content')
    <div class="ex-form-1 pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3">
                    <div class="text-box mt-5 mb-5">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <!-- Sign Up Form -->
                        <form action="{{URL::to('/login')}}" method="POST" >
                            @csrf
                            <h1 style="text-align: center ">Đăng Nhập</h1>
                            <div class="mb-4 form-floating">
                                <input required type="email" name="email" class="form-control" id="floatingInput"
                                    placeholder="name@example.com" @error('email') is-invalid @enderror>
                                <label for="floatingInput">Email address</label>
                              
                            </div>
                           
                            <div class="mb-4 form-floating">
                                <input required type="password" class="form-control "
                                    name="password" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Password</label>                              

                            </div>
                            
                            <button type="submit" class="form-control-submit-button">Login</button>
                        </form>
                        <!-- end of sign up form -->

                    </div>
                    <p class="mb-4" style="display: inline;">Bạn chưa có tài khoản?<a class="blue " href="{{url('/sign-up')}}"> Đăng ký</a></p>
                    
                    <!-- end of text-box -->
                </div>
                <!-- end of col -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container -->
    </div>
 
@endsection
