@extends('layouts.app')

@section('content')
<script>
  function returnToPreviousPage() {
  window.history.back(); // Revenir à la page précédente
}
</script> 
<button type="submit" onclick="returnToPreviousPage()">Retour</button> <style>
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
<div class="box-content">
    <div class="box-heading">
        <div class="box-title">
            <h3 class="mb-35">mes offres</h3>
        </div>
        <div class="box-breadcrumb">
            <div class="breadcrumbs">
                <ul>
                    <li> <a class="icon-home" href="index.html">OFFRE</a></li>
                    <li><span>mes offres </span></li>
                </ul>
            </div>
        </div>
    </div>

 





 
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
</div></div>
@endsection
