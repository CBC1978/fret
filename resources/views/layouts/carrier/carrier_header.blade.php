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
        <div class="text-center">
          <p class="font-sm text-brand-2">POSTULER A L'OFFRE </p>
          <h2 class="mt-10 mb-5 text-brand-1 text-capitalize">Faites une proposition</h2>
          <p class="font-sm text-muted mb-30">Entrer les des information clair et valide pour multiplier vos chances                    </p>
        </div>
        <form class="login-register text-start mt-20 pb-30" action="{{ route('carrier.announcements.postuler') }}"  method="post">
             @csrf
            <div class="form-group">
            <label class="form-label" for="input-1" >Prix <span class="required">*</span><span>(En FCFA)</span></label>
            <input class="form-control" id="input-1" type="text" required="" name="price" placeholder="votre meilleur offre">
          </div>

          <div class="form-group">
            <label class="form-label" for="des">Description<span class="required">*</span></label>
                <input class="form-control" id="des" type="text" required="" name="description" placeholder="description...">
                <input class="form-control" id="file" name="idUser" value="{{session('userId') }}" type="hidden">
          </div>
{{--          <div class="login_footer form-group d-flex justify-content-between">--}}
{{--            <label class="cb-container">--}}
{{--              <input type="checkbox"><span class="text-small">Conditions generales d'utilisation</span><span class="checkmark"></span>--}}
{{--            </label><a class="text-muted" href="#">En savoir plus</a>--}}
{{--          </div>--}}
          <div class="form-group">
            <button class="btn btn-default hover-up w-100" type="submit" name="login">ENVOYER</button>
          </div>
          <div class="text-muted text-center">Avez vous besoin d'aides? <a href="#">Contactez nous </a></div>
        </form>
      </div>
    </div>
  </div>
</div>
<header class="header sticky-bar">
  <div class="container">
    <div class="main-header">
      <div class="header-left">
        <div class="header-logo">
            <a class="d-flex" {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
            <img alt="jobBox" src="{{ asset('src/imgs/page/dashboard/bvf02.png') }}">
            </a>
        </div>
         <span class="btn btn-grey-small ml-10">
               @if(Session::has('company_name'))
              <p>{{ Session::get('company_name') }}</p>
               @endif
         </span>
      </div>
      {{-- <div class="header-search">
        <div class="box-search">
          <form action="">
            <input class="form-control input-search" type="text" name="keyword" placeholder="Search">
          </form>
        </div>
      </div> --}}

      <div class="header-right">
        <div class="block-signin">
            @if(Session::get('fk_carrier_id') != 0)
                <a class="btn btn-default icon-edit hover-up{{ request()->routeIs('carrier.announcements.create') ? 'active' : '' }}"  href="{{ route('carrier.announcements.create') }}">
                    PUBLIER UNE ANNONCE DE TRANSPORT
                </a>
            @endif
          <div class="dropdown d-inline-block"><a class="btn btn-notify" id="dropdownNotify" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static"></a>
            <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end" aria-labelledby="dropdownNotify">
              <li><a class="dropdown-item active" href="#">10 notifications</a></li>
              <li><a class="dropdown-item" href="#">12 messages</a></li>
              <li><a class="dropdown-item" href="#">20 replies</a></li>
            </ul>
          </div>
          <div class="member-login"><img alt="" src="{{ asset('src/imgs/page/dashboard/profile.png') }}">
            <div class="info-member">
              <strong class="color-brand-1">
                  @if(Session::has('first_name'))
                      <p>{{ Session::get('first_name') }}</p>
                  @endif
              </strong>
              <div class="dropdown">
                  <a class="font-xs color-text-paragraph-2 icon-down" id="dropdownProfile" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static">Transporteur</a>
                  <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end" aria-labelledby="dropdownProfile">
                      <li><a class="dropdown-item" href="{{ route('carrier.profile.affichage') }}">Profil</a></li>
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
  <style>
    .required {
    color: red;         /* couleur étoile */
    margin-left: 4px; /* Espacement entre le texte et l'étoile */
}

</style>
</header>
