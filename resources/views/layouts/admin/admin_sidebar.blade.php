<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title></title>
  <style>
    .menu-box {
         padding: 2px;
     }

     .menu-box {
         padding: 0px;
     }

     .menu-box a {
         text-decoration: none;
         color: #333;
         display: block;
     }

     .menu-box a.active {
         font-weight: bold;
     }
     .nav-main-menu{
       position: fixed;
       width: 275px;
       top: 105px;
       /*box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);*/
       left: 0; z-index: 100;
     }

  @media (min-width: 569px) {
    .nav-main-menu {
      width: 216px;
    }
  }

  </style>
</head>
<body>
  <div class="burger-icon burger-icon-white">
    <span class="burger-icon-top"></span>
    <span class="burger-icon-mid"></span>
    <span class="burger-icon-bottom"></span>
  </div>

          <!-- Mobile menu (hidden by default) -->
  <div class="mobile-header-active mobile-header-wrapper-style perfect-scrollbar">
    <div class="mobile-header-wrapper-inner">
      <div class="mobile-header-content-area">
        <div class="perfect-scroll">
                          <!-- Mobile search -->
          <div class="mobile-search mobile-header-border mb-30">
            <form action="#">
              <input type="text" placeholder="Search…"><i class="fi-rr-search"></i>
            </form>
          </div>
          <div class="mobile-menu-wrap mobile-header-border">
            <nav>
              <ul class="main-menu">
                <li>
                  <a class="dashboard2 {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                    <img src="{{ asset('src/imgs/page/dashboard/dashboard.svg') }}" alt="jobBox">
                    <span class="name">Accueil</span>
                  </a>
                </li>
                <li>
                  <a class="dashboard2 {{ request()->routeIs('a_user_gestion') ? 'active' : '' }}" href="{{ route('a_user_gestion') }}">
                    <img src="{{ asset('src/imgs/page/dashboard/candidates.svg') }}" alt="jobBox">
                    <span class="name">Utilisateur </span>
                  </a>
                </li>
                <li>
                  <div class="menu-box">
                    <a>
                        <img src="{{ asset('src/imgs/page/dashboard/candidates.svg') }}" alt="jobBox">
                        <span class="name">Entreprise</span>
                    </a>
                  </div>
                  <ul class="sub-menu">
                    <li>
                        <a href="{{ route('admin.chargeur') }}">
                            Chargeur
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.transporteur') }}">
                            Transporteur
                        </a>
                    </li>
                  </ul>
                </li>
                <li>
                  <div class="menu-offer {{ request()->routeIs('annonces.a_annonce') ? 'active' : '' }}">
                      <a>
                          <img src="{{ asset('src/imgs/page/dashboard/candidates.svg') }}" alt="jobBox">
                          <span class="name">Offres</span>
                      </a>
                    </div>
                    <ul class="sub-menu">
                      <li>
                        <a href="{{ route('annonces.a_annonce') }}">
                              Chargeur(s)
                          </a>
                      </li>
                      <li>
                        <a href="{{ route('annonces.a_annonceTransporter') }}">
                              Transporteur(s)
                          </a>
                      </li>
                  </ul>
                </li>
                  {{--<li><a class="dashboard2 {{ request()->routeIs('admin.parameter.displayAdminSettings') ? 'active' : '' }}" href="{{ route('admin.parameter.displayAdminSettings') }}"><img src="{{ asset('src/imgs/page/dashboard/tasks.svg') }}" alt="jobBox"><span class="name">Paramètres</span></a></li>--}}
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="nav"><a class="btn btn-expanded" id="expandButton"></a>
    <nav class="nav-main-menu" id="mainMenu">
      <ul class="main-menu">
        <li>
          <div class="menu-box {{ request()->routeIs('home') ? 'active' : '' }}">
            <a href="{{ route('home') }}">
              <img src="{{ asset('src/imgs/page/dashboard/dashboard.svg') }}" alt="jobBox">
              <span class="name">Accueil</span>
            </a>
          </div>
        </li>
        <li>
          <div class="menu-box {{ request()->routeIs('a_user_gestion') ? 'active' : '' }}">
            <a class="" href="{{ route('a_user_gestion') }}">
              <img src="{{ asset('src/imgs/page/dashboard/candidates.svg') }}" alt="jobBox">
              <span class="name">Utilisateur</span>
            </a>
          </div>
        </li>
        <li>
          <div class="menu-box">
            <a>
                <img src="{{ asset('src/imgs/page/dashboard/candidates.svg') }}" alt="jobBox">
                <span class="name">Entreprise</span>
            </a>
          </div>
          <ul class="sub-menu">
            <li>
                <a href="{{ route('admin.chargeur') }}">
                    Chargeur
                </a>
            </li>
            <li>
                <a href="{{ route('admin.transporteur') }}">
                    Transporteur
                </a>
            </li>
          </ul>
        </li>

        <li>
        <div class="menu-offer {{ request()->routeIs('annonces.a_annonce') ? 'active' : '' }}">
            <a>
                <img src="{{ asset('src/imgs/page/dashboard/candidates.svg') }}" alt="jobBox">
                <span class="name">Offres</span>
            </a>
          </div>
          <ul class="sub-menu">
            <li>
              <a href="{{ route('annonces.a_annonce') }}">
                    Chargeur(s)
                </a>
            </li>
            <li>
              <a href="{{ route('annonces.a_annonceTransporter') }}">
                    Transporteur(s)
                </a>
            </li>
          </ul>
        </li>

        {{--   <li>
        <a class="dashboard2 {{ request()->routeIs('admin.parameter.displayAdminSettings') ? 'active' : '' }}" href="{{ route('admin.parameter.displayAdminSettings') }}"><img src="{{ asset('src/imgs/page/dashboard/tasks.svg') }}" alt="jobBox"><span class="name">Paramètres </span></a>
        </li>
        --}}
      </ul>
    </nav>
  </div>



  <script>
    const expandButton = document.getElementById('expandButton');
    const mainMenu = document.getElementById('mainMenu');

    expandButton.addEventListener('click', function() {
      if (mainMenu.style.width === '64px') {
        mainMenu.style.width = '275px'; // Reprendre la largeur d'origine
      } else {
        mainMenu.style.width = '64px'; // Ajuster la largeur pour aligner à gauche
      }
    });
  </script>
</body>
</html>
