<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="msapplication-TileColor" content="#0E0E0E">
<meta name="template-color" content="#0E0E0E">
<meta name="msapplication-config" content="browserconfig.xml">
<meta name="description" content="Index page">
<meta name="keywords" content="index, page">
<meta name="author" content="">
{{--<link rel="shortcut icon" type="image/x-icon" href="{{ asset('src/dashboard/imgs/template/favicon.svg') }}">--}}
<link href="{{ asset('src/css/style.css?version=4.1') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <style>
      body {
          background-color: white;
          margin-top: -150px;
      }
  </style>

</head>
<body>
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
          <div class="preloader-inner position-relative">
{{--            <div class="text-center"><img src="{{ asset('src/assets/imgs/template/loading.gif') }}" alt="jobBox"></div>--}}
          </div>
        </div>
      </div>

      <main class="main">

        <div class="box-content">

          <div class="row">
            <div class="col-lg-12">
              <div class="section-box">
                <div class="container">
                    <div class="box-padding">
                      <div class="login-register">
                        <div class="row login-register-cover">
                          <div class="col-lg-6 col-md-4 col-sm-12 mx-auto">
                            <div class="form-login-cover">
                              <div class="text-center">
                                <p class="font-sm text-brand-2">Se connecter</p>
                                <p class="font-sm text-muted mb-30">Connectez vous et faites de bonnes affaires.</p>
                                <form class="login-register text-start mt-20" method="post" action="{{ route('loginUser') }}">
                                    @if(Session::has('success'))
                                        <div class="alert alert-success"> {{ Session::get('success') }}</div>
                                    @endif
                                    @if(Session::has('fail'))
                                        <div class="alert alert-danger"> {{ Session::get('fail') }}</div>
                                    @endif
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label" for="input-1">Adresse email <span class="text-danger">*</span></label>
                                        <input class="form-control @error('email') is-invalid @enderror" id="input-1" type="email" required autocomplete="email" autofocus name="email" placeholder="Adresse email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="password">Mot de passe  <span class="text-danger">*</span></label>
                                        <input id="password" type="password"   class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"/>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                <div class="login_footer form-group d-flex justify-content-between">
                                  <label class="cb-container">
                                    <input type="checkbox"><span class="text-small">Se souvenir de moi</span><span class="checkmark"></span>
                                  </label><a class="text-muted" href="#">Mot de passe oublié</a>
                                </div>
                                <div class="form-group">
                                  <button class="btn btn-brand-1 hover-up w-100" type="submit" name="login">Connecter</button>
                                </div>
                                <div class="text-muted text-center">Vous n'avez pas de compte ? <a  href="{{ route('register') }}">S'inscrire</a></div>
                              </form>
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
<script src="{{asset('src/js/plugins/jquery.circliful.js')}}"></script>
<script src="{{asset('src/js/main.js?v=4.1')}}"></script>
</html>
