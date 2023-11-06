<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="msapplication-TileColor" content="#0E0E0E">
<meta name="template-color" content="#0E0E0E">
<link rel="manifest" href="manifest.json" crossorigin>
<meta name="msapplication-config" content="browserconfig.xml">
<meta name="description" content="Index page">
<meta name="keywords" content="index, page">
<meta name="author" content="">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('src/dashboard/imgs/template/favicon.svg') }}">
<link href="{{ asset('src/css/style.css?version=4.1') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


</head>
<body>
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
          <div class="preloader-inner position-relative">
            <div class="text-center"><img src="{{asset('src/assets/imgs/template/loading.gif')}}" alt="jobBox"></div>
          </div>
        </div>
      </div>

      <main class="main">
        <div class="box-content">
          <div class="row">
            <div class="col-lg-12">
              <div class="section-box">
                <div class="container">
                  <div class="panel-white mb-10">
                    <div class="box-padding">
                      <div class="login-register">
                        <div class="row login-register-cover pb-250">
                          <div class="col-lg-6 col-md-4 col-sm-12 mx-auto">
                            <div class="form-login-cover">
                              <div class="text-center">
                                <h2 class="mt-10 mb-5 text-brand-1">Confirmation</h2>
                                <p class="font-sm text-muted mb-30">Un code a été envoyé dans votre email</p>
                                    <form class="login-register text-start mt-20" method="post" action="{{ route('otpVerify') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label class="form-label" for="otp">CODE</label>
                                            <input class="form-control @error('otp') is-invalid @enderror" id="otp" type="text" required="" name="otp" placeholder="Entrez le code de confirmation">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-brand-1 hover-up w-100" type="submit" name="submit"> Valider</button>
                                        </div>

                                    </form>
                                    @if(session('error_message'))
                                        <div class="alert alert-danger mt-3">
                                            {{ session('error_message') }}
                                        </div>
                                        <script>
                                          // JavaScript pour faire disparaître le message d'erreur après un délai
                                          window.addEventListener('DOMContentLoaded', function () {
                                              var errorMessage = document.getElementById('error-message');

                                              // Vérifiez si le message d'erreur est présent
                                              if (errorMessage) {
                                                  setTimeout(function() {
                                                      errorMessage.style.display = 'none';
                                                  }, 6000); // Disparaître après 6 secondes (6000 millisecondes)
                                              }
                                          });
                                        </script>
                                    @endif
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
    </main>
</body>
<script src="{{ asset('src/js/vendor/modernizr-3.6.0.min.js') }}"></script>
<script src="{{ asset('src/js/vendor/jquery-3.6.0.min.js') }}"></script>
<script src="{{asset('src/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>
<script src="{{asset('src/js/vendor/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('src/js/plugins/waypoints.js')}}"></script>
<script src="{{asset('src/js/plugins/magnific-popup.js')}}"></script>
<script src="{{asset('src/js/plugins/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('src/js/plugins/select2.min.js')}}"></script>
<script src="{{asset('src/js/plugins/swiper-bundle.min.js')}}"></script>
<script src="{{asset('src/js/plugins/jquery.circliful.js')}}"></script>
<script src="{{asset('src/js/plugins/charts/index.js')}}"></script>
<script src="{{asset('src/js/plugins/charts/xy.js')}}"></script>
<script src="{{asset('src/js/plugins/charts/Animated.js')}}"></script>
<script src="{{asset('src/js/plugins/armcharts5-script.js')}}"></script>
<script src="{{asset('src/js/main.js?v=4.1')}}"></script>
</html>
