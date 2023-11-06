@extends('layouts.admin')

@section('content')

<!DOCTYPE html>
<html lang="en">
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
    <link rel="shortcut icon" type="image/x-icon" href="assets/imgs/template/favicon.svg">
    <link href="assets/css/style.css?version=4.1" rel="stylesheet">
    <title>Admin Settings</title>
    <style>
      button[type="submit"] {
          background-color: #007bff;
          color: white;
          border: none;
          padding: 5px 10px;
          border-radius: 5px;
          cursor: pointer;
      }
  
      a {
          color: #007bff;
          text-decoration: none;
      }
  </style>
<script>
  function returnToPreviousPage() {
  window.history.back(); // Revenir à la page précédente
}
</script>
  </head>
  <body>
    <button type="submit" onclick="returnToPreviousPage()"> Retour</button>

    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <header class="header sticky-bar"> 
    <div class="box-heading">
        <div class="box-title">
            <h3 class="mb-35">Settings</h3>
        </div>
    </div>
      <div class="container">
        <div class="main-header">
          <div class="header-left">
            <div class="header-logo"><a class="d-flex" href="index.html"><img alt="jobBox"  src="{{ asset('imgs/page/dashboard/bvf02.png') }}" ></a></div><span class="btn btn-grey-small ml-10">Admin area</span>
          </div>
        
          <div class="header-right">
            <div class="block-signin"><a class="btn btn-default icon-edit hover-up" href="post-job.html">Post Job</a>
              <div class="dropdown d-inline-block"><a class="btn btn-notify" id="dropdownNotify" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static"></a>
                <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end" aria-labelledby="dropdownNotify">
                  <li><a class="dropdown-item active" href="#">10 notifications</a></li>
                  <li><a class="dropdown-item" href="#">12 messages</a></li>
                  <li><a class="dropdown-item" href="#">20 replies</a></li>
                </ul>
              </div>
              <div class="member-login"><img alt=""  src="{{ asset('imgs/page/dashboard/profile.png') }}">
                <div class="info-member"> 
                    <strong class="color-brand-1">
                    @if(Session::has('username'))
                      <p>{{ Session::get('username') }}</p>
                    @endif
                    </strong>
                  <div class="dropdown"><a class="font-xs color-text-paragraph-2 icon-down" id="dropdownProfile" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static">Compte Transporteur</a>
                    <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end" aria-labelledby="dropdownProfile">
                      <li><a class="dropdown-item" href="profile.html">Profiles</a></li>
                      <li><a class="dropdown-item" href="my-resume.html">CV Manager</a></li>
                      <li><a class="dropdown-item" href="login.html">Logout</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <div class="burger-icon burger-icon-white"><span class="burger-icon-top"></span><span class="burger-icon-mid"></span><span class="burger-icon-bottom"></span></div>
    <div class="mobile-header-active mobile-header-wrapper-style perfect-scrollbar">
      <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-content-area">
          <div class="perfect-scroll">
            <div class="mobile-search mobile-header-border mb-30">
              <form action="#">
                <input type="text" placeholder="Search…"><i class="fi-rr-search"></i>
              </form>
            </div>
           
            <div class="mobile-account">
              <h6 class="mb-10">Your Account</h6>
              <ul class="mobile-menu font-heading">
                <li><a href="#">Profile</a></li>
                <li><a href="#">Work Preferences</a></li>
                <li><a href="#">Account Settings</a></li>
                <li><a href="#">Go Pro</a></li>
                <li><a href="page-signin.html">Sign Out</a></li>
              </ul>
              <div class="mb-15 mt-15"> <a class="btn btn-default icon-edit hover-up" href="post-job.html">Post Job</a></div>
            </div>
            <div class="site-copyright">Copyright 2022 &copy; JobBox. <br>Designed by AliThemes.</div>
          </div>
        </div>
      </div>
    </div>
   <main class="main">
      
      <div class="box-content">
            <div class="box-heading">
              <div class="box-title"> 
                <h3 class="mb-35">Setting</h3>
              </div>
              <div class="box-breadcrumb"> 
                <div class="breadcrumbs">
                  <ul> 
                    <li> <a class="icon-home" href="index.html">Accueil</a></li>
                    <li><span>Setting</span></li>
                  </ul>
                </div>
              </div>
            </div>
          <form id="profile-update-form" action="{{ route('admin.parameter.displayAdminSettings') }}" method="post">
              @csrf
              @method('post')

              <div class="row"> 
                  <div class="col-xxl-12 col-xl-8 col-lg-8">
                    <div class="section-box">
                      <div class="container">
                          <div class="panel-white mb-20">
                            <div class="box-padding">

                              <h6 class="color-text-paragraph-2">Update your profile</h6>
                                <div class="box-profile-image"> 
                                <div class="img-profile"> <img src="{{ asset('imgs/page/dashboard/img3.png') }}"  alt="jobBox"></div>
                                <div class="info-profile"> <a class="btn btn-default">Company Logo / Brand</a></div>
                              </div>
                              <div class="row"> 
                                <div class="col-lg-6 col-md-6">
                                  <div class="form-group mb-30"> 
                                    <label class="font-sm color-text-mutted mb-10">Last name *</label>
                                    <input type="text" name="name" id="name" placeholder="Last_name" value="{{ old('name', $user->name) }}">
                                  </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                  <div class="form-group mb-30">
                                    <label class="font-sm color-text-mutted mb-10">first name *</label>
                                    <input type="text" name="first_name" id="first_name" placeholder="First_name" value="{{old('first_name', $user->first_name)}}">
                                  </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                  <div class="form-group mb-30">
                                    <label class="font-sm color-text-mutted mb-10">Company Name *</label>
                                    <input type="text" name="company_name" id="company_name" placeholder="Company_Name" value="@if ($user->fk_shipper_id){{ $user->shipper->company_name }} @else Aucune entreprise associée @endif">
                                  </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                  <div class="form-group mb-30">
                                    <label class="font-sm color-text-mutted mb-10">Email *</label>
                                    <input type="email" name="email" id="email" placeholder="https://alithemes.com" value="{{ old('email', $user->email)}}">
                                  </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                  <div class="form-group mb-30">
                                    <label class="font-sm color-text-mutted mb-10">Contact number</label>
                                    <input type="tel" name="user_phone" id="user_phone" placeholder="01 - 234 567 89" value="{{old('user_phone', $user->user_phone) }}">
                                  </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                  <div class="form-group mb-30">
                                    <label class="font-sm color-text-mutted mb-10">username</label>
                                    <input type="text" name="username" id="username" placeholder="User_Name" value="{{old('username', $user->username)}}">
                                  </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                  <div class="form-group mb-30">
                                    <label class="font-sm color-text-mutted mb-10">Company Name *</label>
                                    <input type="text" name="company_name" id="company_name" placeholder="" value="@if ($user->fk_shipper_id){{ $user->shipper->company_name }} @else Aucune entreprise associée @endif">
                                  </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                  <div class="form-group mb-30">
                                    <label class="font-sm color-text-mutted mb-10">Catégorie </label>
                                    <input type="text" placeholder="ADMIN" value="ADMIN">
                                  </div>
                              </div>
                              <h6 class="color-text-paragraph-2">Contact Information</h6>
                            <div class="row mt-30">
                              <div class="col-lg-6 col-md-6">
                                <div class="form-group mb-30"> 
                                  <label class="font-sm color-text-mutted mb-10">Country</label>
                                  <input  type="text" placeholder="Burkina Faso" value="">
                                </div>
                              </div>
                              <div class="col-lg-6 col-md-6">
                                <div class="form-group mb-30">
                                  <label class="font-sm color-text-mutted mb-10">City</label>
                                  <input  type="text" placeholder="Ouagadougou" value="">
                                </div>
                              </div>
                              <div class="col-lg-6 col-md-6">
                                <div class="form-group mb-30">
                                  <label class="font-sm color-text-mutted mb-10">Complete Address</label>
                                  <input  type="text" name="address" id="address" placeholder="205 Avenue Père Joseph Wresinski, Suite 810, Ouaga, 60601, BF"  value="">
                                </div>
                              </div>
                              <div class="col-lg-6 col-md-6">
                                <div class="form-group mb-30">
                                  <label class="font-sm color-text-mutted mb-10">Find On Map</label>
                                  <input  type="text" placeholder="205 North Michigan Avenue, Suite 810, Chicago, 60601, USA">
                                </div>
                              </div>
                              <div class="col-lg-6 col-md-6">
                                <div class="form-group mb-30"> 
                                  <label class="font-sm color-text-mutted mb-10">Latitude</label>
                                  <input  type="text" placeholder="41.881832">
                                </div>
                              </div>
                              <div class="col-lg-6 col-md-6">
                                <div class="form-group mb-30">
                                  <label class="font-sm color-text-mutted mb-10">Longitude</label>
                                  <input  type="text" placeholder=" -87.623177">
                                </div>
                              </div>
                              <div class="col-lg-12">
                                <div class="form-group mb-30">
                                  <label class="font-sm color-text-mutted mb-10">Google Map</label>
                                  <div class="box-map"> 
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3403.4860084541583!2d-87.62575418429162!3d41.88608087922149!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x880e2ca8b34afe61%3A0x6caeb5f721ca846!2s205%20N%20Michigan%20Ave%20Suit%20810%2C%20Chicago%2C%20IL%2060601%2C%20Hoa%20K%E1%BB%B3!5e1!3m2!1svi!2s!4v1663165156864!5m2!1svi!2s" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-12"> 
                                <div class="form-group mt-10">
                                  <button type="submit" class="btn btn-default btn-brand icon-tick">Save Change</button>
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
          </form>
          <div class="col-xxl-12 col-xl-4 col-lg-4">
            <div class="section-box">
              <div class="container"> 
                <div class="panel-white">
                  <div class="panel-head"> 
                    <h5>Social Network</h5><a class="menudrop" id="dropdownMenu3" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static"></a>
                    <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end" aria-labelledby="dropdownMenu3">
                      <li><a class="dropdown-item active" href="#">Add new</a></li>
                      <li><a class="dropdown-item" href="#">Settings</a></li>
                      <li><a class="dropdown-item" href="#">Actions</a></li>
                    </ul>
                  </div>
                  <div class="panel-body pt-20">
                    <div class="row">
                      <div class="col-lg-12"> 
                        <div class="form-group mb-30"> 
                          <label class="font-sm color-text-mutted mb-10">Facebook</label>
                          <input class="form-control" type="text" placeholder="https://www.facebook.com">
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="form-group mb-30">
                          <label class="font-sm color-text-mutted mb-10">Twitter</label>
                          <input class="form-control" type="text" placeholder="https://twitter.com">
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="form-group mb-30">
                          <label class="font-sm color-text-mutted mb-10">Instagram</label>
                          <input class="form-control" type="text" placeholder="https://www.instagram.com">
                        </div>
                      </div>
                      <div class="col-lg-12"> 
                        <div class="form-group mt-0">
                          <button class="btn btn-default btn-brand icon-tick">Save Change</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

   

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('profile-update-form').addEventListener('submit', function(event) {
                event.preventDefault();

                // Récupérer les données du formulaire
                var formData = new FormData(this);

                // Envoyer les données au serveur en utilisant AJAX
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message === 'Profile updated successfully') {
                        // Mettez à jour l'interface utilisateur pour refléter la réussite
                        alert('Profile updated successfully');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });
        </script>

       {{-- <footer class="footer mt-20">
          <div class="container">
            <div class="box-footer">
              <div class="row">
                <div class="col-md-6 col-sm-12 mb-25 text-center text-md-start">
                  <p class="font-sm color-text-paragraph-2">© 2022 - <a class="color-brand-2" href="https://themeforest.net/item/jobbox-job-portal-html-bootstrap-5-template/39217891" target="_blank">JobBox </a>Dashboard <span> Made by  </span><a class="color-brand-2" href="http://alithemes.com" target="_blank"> AliThemes</a></p>
                </div>
                <div class="col-md-6 col-sm-12 text-center text-md-end mb-25">
                  <ul class="menu-footer">
                    <li><a href="#">About</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Policy</a></li>
                    <li><a href="#">Contact</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </footer> --}}
      </div>
   </main>
    <script src="{{ asset('js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery-3.6.0.min.js') }}" ></script>
    <script src="{{ asset('js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}" ></script>
    <script src="{{ asset('js/plugins/waypoints.js') }}" ></script>
    <script src="{{ asset('js/plugins/magnific-popup.js') }}" ></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}" ></script>
    <script src="{{ asset('js/plugins/select2.min.js') }}" ></script>
    <script src="{{ asset('js/plugins/swiper-bundle.min.js') }}" ></script>
    <script src="{{ asset('js/plugins/jquery.circliful.js') }}" ></script>
    <script src="{{ asset('js/main.js?v=4.1') }}" ></script>
  </body>
</html>

@endsection