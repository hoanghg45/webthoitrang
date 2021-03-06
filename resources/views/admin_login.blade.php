<!DOCTYPE html>
<html lang="en">
<head>
  <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Trang Admin</title>

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet"/>
  <link href="https://cdn.materialdesignicons.com/3.0.39/css/materialdesignicons.min.css" rel="stylesheet" />

  <!-- PLUGINS CSS STYLE -->
  <link href="public/backend/plugins/toaster/toastr.min.css" rel="stylesheet" />
  <link href="public/backend/plugins/nprogress/nprogress.css" rel="stylesheet" />
  <link href="public/backend/plugins/flag-icons/css/flag-icon.min.css" rel="stylesheet"/>
  <link href="public/backend/plugins/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
  <link href="public/backend/plugins/ladda/ladda.min.css" rel="stylesheet" />
  <link href="public/backend/plugins/select2/css/select2.min.css" rel="stylesheet" />
  <link href="public/backend/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" />

  <!-- SLEEK CSS -->
  <link id="sleek-css" rel="stylesheet" href="public/backend/css/sleek.css" />

  

  <!-- FAVICON -->
  <link href="public/backend/img/favicon.png" rel="shortcut icon" />

  <!--
    HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
  -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="public/backend/plugins/nprogress/nprogress.js"></script>
</head>

</head>
  <body class="bg-light-gray" id="body">
      <div class="container d-flex flex-column justify-content-between vh-100">
      <div class="row justify-content-center mt-5">
        <div class="col-xl-5 col-lg-6 col-md-10">
          <div class="card">
            <div class="card-header bg-primary">
              <div class="app-brand">
                <a href="{{url('/admin')}}">
                  <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30" height="33"
                    viewBox="0 0 30 33">
                    <g fill="none" fill-rule="evenodd">
                      <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                      <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                    </g>
                  </svg>
                  <span class="brand-name">Admin</span>
                </a>
              </div>
            </div>
            <div class="card-body p-5">

              <h4 class="text-dark mb-5">????ng nh???p</h4>
        
              <form action="{{URL::to('/admin-dashboard')}}" method="POST">
                  {{ csrf_field() }}
                <div class="row">
                  <div class="form-group col-md-12 mb-4">
                    <input type="email" class="form-control input-lg" name="admin_email" id="email" aria-describedby="emailHelp" placeholder="Email">
                  </div>
                  <div class="form-group col-md-12 ">
                    <input type="password" class="form-control input-lg" name="admin_password" id="password" placeholder="Password">
                    <br>
                   
                   @php
                    $message = Session::get('message');
                    if($message){
                      echo '<span class="text-alert" style="color:red">'.$message.'</span>';
                      Session::put('message',null);
                    }
                    @endphp
                  
                  </div>
                  
                  <div class="col-md-12">
                    <div class="d-flex my-2 justify-content-between">
                      <div class="d-inline-block mr-3">
                        <label class="control control-checkbox">L??u t??i kho???n
                          <input type="checkbox" />
                          <div class="control-indicator"></div>
                        </label>
                
                      </div>
                      <p><a class="text-blue" href="#">Qu??n m???t kh???u?</a></p>
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">????ng nh???p</button>
                    <p>Don't have an account yet ?
                      <a class="text-blue" href="sign-up.html">Sign Up</a>
                    </p>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="copyright pl-0">
        <p class="text-center">&copy; 2018 Copyright Sleek Dashboard Bootstrap Template by
          <a class="text-primary" href="http://www.iamabdus.com/" target="_blank">Abdus</a>.
        </p>
      </div>
    </div>
</body>
</html>