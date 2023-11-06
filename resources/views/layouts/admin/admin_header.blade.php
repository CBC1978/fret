<div id="preloader-active">
  <div class="preloader d-flex align-items-center justify-content-center">
    <div class="preloader-inner position-relative">
      <div class="text-center"><img src="{{ asset('src/imgs/template/loading.gif') }}" alt="jobBox"></div>
    </div>
  </div>
</div>
<div class="modal fade" id="ModalApplyJobForm" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content apply-job-form">
      <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="modal-body pl-30 pr-30 pt-50">


      </div>
    </div>
  </div>
</div>
<header class="header sticky-bar">
  <div class="container">
    <div class="main-header">
      <div class="header-left">
        <div class="header-logo"><a class="d-flex" {{ request()->routeIs('home') ? 'active' : '' }} href="{{ route('home') }}"><img alt="jobBox" src="{{ asset('src/imgs/page/dashboard/bvf02.png') }}" ></a></div>
        <span class="btn btn-grey-small ml-10">Admin Account</span>
      </div>
      <div class="header-search">

      </div>

      <div class="header-right">

          <div class="dropdown d-inline-block"><a class="btn btn-notify" id="dropdownNotify" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static"></a>
            <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end" aria-labelledby="dropdownNotify">
              <li><a class="dropdown-item active" href="#">10 notifications</a></li>
              <li><a class="dropdown-item" href="#">12 messages</a></li>
              <li><a class="dropdown-item" href="#">20 replies</a></li>
            </ul>
          </div>
          <div class="member-login"><img alt="" src="{{ asset('src/imgs/page/dashboard/profile.png') }}" >
            <div class="info-member">
              <strong class="color-brand-1">
                  @if(Session::has('username'))
                      <p>{{ Session::get('username') }}</p>
                  @endif
              </strong>
              <div class="dropdown">
                  <a class="font-xs color-text-paragraph-2 icon-down" id="dropdownProfile" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static">Super Admin</a>
                  <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end" aria-labelledby="dropdownProfile">
                      <li><a class="dropdown-item" href="{{ route('admin.profile.affichage') }}">Profil</a></li>
                      <form action="{{ route('logout') }}" method="POST">
                          @csrf
                          <button class="dropdown-item" type="submit">Déconnexion</button>
                      </form>
                  </ul>
              </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
