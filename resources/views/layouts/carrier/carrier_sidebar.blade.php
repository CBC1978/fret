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
                   <a class="dashboard2 {{ request()->routeIs('shipper.announcements.index') ? 'active' : '' }}" href="{{ route('shipper.announcements.index') }}">
                       <img src="{{ asset('src/imgs/page/dashboard/recruiters.svg') }}" alt="jobBox">
                       <span class="name">Offres de fret</span>
                   </a>
                 </li>
                 <li>
                  <a class="dashboard2 {{ request()->routeIs('carrier.announcements.user') ? 'active' : '' }}" >
                    <img src="{{ asset('src/imgs/page/dashboard/recruiters.svg') }}" alt="jobBox">
                    <span class="name">Mes offres de transports</span>
                  </a>
                  <ul class="sub-menu">
                    <li>
                      <a href="{{ route('carrier.announcements.user') }}">Offres reçues</a>
                    </li>
                    <li>
                      <a href="{{ route('carrier.announcements.useroffer') }}">Offres non reçues</a>
                    </li>
                  </ul>
               </li>
                 <li>
                   <a class="dashboard2 {{ request()->routeIs('carrier.announcements.carrier_myrequest') ? 'active' : '' }}" href="{{ route('carrier.announcements.carrier_myrequest') }}">
                       <img src="{{ asset('src/imgs/page/dashboard/recruiters.svg') }}" alt="jobBox">
                       <span class="name">Mes offres de frets</span>
                   </a>
                 </li>
                 <li>
                   <a class="dashboard2 {{ request()->routeIs('carrier.announcements.contract') ? 'active' : '' }}" href="{{ route('carrier.announcements.contract') }}">
                       <img src="{{ asset('src/imgs/page/dashboard/recruiters.svg') }}" alt="jobBox">
                       <span class="name">Contrat</span>
                   </a>
                 </li>
{{--                 <li>--}}
{{--                   <a class="dashboard2" href="#">--}}
{{--                       <img src="{{ asset('src/imgs/page/dashboard/jobs.svg') }}" alt="jobBox">--}}
{{--                       <span class="name">Statistiques</span>--}}
{{--                   </a>--}}
{{--                 </li>--}}
{{--                 <li>--}}
{{--                   <a class="dashboard2 {{ request()->routeIs('carrier.parameter.displayCarrierSettings') ? 'active' : '' }}" href="{{ route('carrier.parameter.displayCarrierSettings') }}">--}}
{{--                       <img src="{{ asset('src/imgs/page/dashboard/settings.svg') }}" alt="jobBox">--}}
{{--                       <span class="name">Paramètres</span>--}}
{{--                   </a>--}}
{{--                 </li>--}}
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
                 <div class="menu-box {{ request()->routeIs('shipper.announcements.index') ? 'active' : '' }}">
                   <a href="{{ route('shipper.announcements.index') }}">
                     <img src="{{ asset('src/imgs/page/dashboard/recruiters.svg') }}" alt="jobBox">
                     <span class="name">Offres de fret</span>
                   </a>
                 </div>
               </li>
               <li>
                  <a class="dashboard2 {{ request()->routeIs('carrier.announcements.user') ? 'active' : '' }}" >
                    <img src="{{ asset('src/imgs/page/dashboard/recruiters.svg') }}" alt="jobBox">
                    <span class="name">Mes offres de transports</span>
                  </a>
                  <ul class="sub-menu">
                    <li>
                      <a href="{{ route('carrier.announcements.user') }}">Offres reçues</a>
                    </li>
                    <li>
                      <a href="{{ route('carrier.announcements.useroffer') }}">Offres non reçues</a>
                    </li>
                  </ul>
               </li>

               <li>
                 <div class="menu-box {{ request()->routeIs('carrier.announcements.carrier_myrequest') ? 'active' : '' }}">
                     <a href="{{ route('carrier.announcements.carrier_myrequest') }}">
                         <img src="{{ asset('src/imgs/page/dashboard/recruiters.svg') }}" alt="jobBox">
                         <span class="name">Mes offres de frets</span>
                     </a>
                 </div>
             </li>
             <li>
                 <div class="menu-box {{ request()->routeIs('carrier.announcements.contract') ? 'active' : '' }}">
                     <a href="{{ route('carrier.announcements.contract') }}">
                         <img src="{{ asset('src/imgs/page/dashboard/recruiters.svg') }}" alt="jobBox">
                         <span class="name">Contrat</span>
                     </a>
                 </div>
             </li>
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
