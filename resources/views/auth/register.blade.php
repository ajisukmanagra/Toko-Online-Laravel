<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('login-form-05/fonts/icomoon/style.css') }}">
   
    <link rel="stylesheet" href="{{ asset('login-form-05/css/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('login-form-05/css/bootstrap.min.css') }}">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('login-form-05/css/style.css') }}">

    <title>Login</title>
  </head>
  <body>
  

  <div class="d-md-flex half">
    <div class="bg" style="background-image: url('login-form-05/images/bg_2.jpg');"></div>
    <div class="contents">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12">
            <div class="form-block mx-auto">
              <div class="text-center mb-5">
                <h3 class="text-uppercase">Register to <strong>Magerjajan</strong></h3>
              </div>
              <form action="{{ route('register') }}" method="post">
              @csrf
                <div class="form-group first">
                  <label for="name">{{ __('Name') }}</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Your Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                  @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

                <div class="form-group last mb-3">
                  <label for="email">{{ __('E-Mail Address') }}</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email" placeholder="your-email@gmail.com">
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                
                <div class="form-group last mb-3">
                  <label for="password">{{ __('Password') }}</label>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Your Password">
                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

                <div class="form-group last mb-3">
                  <label for="password-confirm">{{ __('Confirm Password') }}</label>
                  <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Your Password">
                </div>

                <button type="submit" class="btn btn-block py-2 btn-primary">
                  {{ __('Register') }}
                </button>

                <span class="text-center my-3 d-block">or</span>
                
                
                <div class="">
                <a href="{{ route('login') }}" class="btn btn-block py-2 btn-facebook">
                  <span>Kembali Ke Halaman Login</span>
                </a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    
  </div>
    
    

    <script src="{{ asset('login-form-05/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('login-form-05/js/popper.min.js') }}"></script>
    <script src="{{ asset('login-form-05/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('login-form-05/js/main.js') }}"></script>
  </body>
</html>