@extends('layouts.carrier')

@section('content')
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
<button type="submit" onclick="returnToPreviousPage()">Retour</button>
<div class="box-content">
    <div class="box-heading">
        <div class="box-title">
            <h3 class="mb-35">Ajouter une offre</h3>
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">

                <h5>  {{ session('success') }}</h5>
                    <span aria-hidden="true">&times;</span>

            </div>
            @endif
        </div>
        <div class="box-breadcrumb">
            <div class="breadcrumbs">
                <ul>
                    <li> <a class="icon-home" href="#">OFFRE</a></li>
                    <li><span>Ajoute d'offre</span></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-12 col-xl-12 col-lg-7">
            <div class="section-box">
                <div class="row">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-box">
                                <div class="container">
                                    <div class="panel-white mb-30">
                                        <div class="box-padding bg-postjob">
                                            <h5 class="icon-edu">Faites une offre</h5>
                                            <div class="row mt-30">
                                                <div class="col-lg-9">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group mb-30">
                                                                <label class="font-sm color-text-mutted mb-10">Résumer en 14 mots *</label>
                                                                <input class="form-control" type="text" placeholder="Mettrez que des mots clé">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="form-group mb-30">
                                                                <label class="font-sm color-text-mutted mb-10">Date limite*</label>
                                                                <input class="form-control" type="date" name="">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group mb-30">
                                                                <label class="font-sm color-text-mutted mb-10"> description detaillée de l'offre *</label>
                                                                <textarea class="form-control" name="message" rows="8"> </textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="form-group mb-30">
                                                                <label class="font-sm color-text-mutted mb-10">Type de vehicule <span class="required">*</span></label>
                                                                <select class="form-control">
                                                                    <option value="1">Remote</option>
                                                                    <option value="1">Office</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="form-group mb-30">
                                                                <label class="font-sm color-text-mutted mb-10">Nombre de vehicule</label>
                                                                <input class="form-control" type="text" placeholder="Nombre de vehicule disponible pour l'offre">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="form-group mb-30">
                                                                <label class="font-sm color-text-mutted mb-10">Volume<span class="required">*</span></label>
                                                                <input class="form-control" type="text" placeholder="En metre cube">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="form-group mb-30">
                                                                <label class="font-sm color-text-mutted mb-10">Poids<span class="required">*</span></label>
                                                                <input class="form-control" type="text" placeholder="En Tonnes">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="form-group mb-30">
                                                                <label class="font-sm color-text-mutted mb-10">Prix<span class="required">*</span><span>(En FCFA)</span></label>
                                                                <input class="form-control" type="text" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group mt-10">
                                                                <button class="btn btn-default btn-brand icon-tick">Ajouter nouvelle offre</button>
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
            </div>
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

<style>
    .required {
     color: red;
     margin-left: 4px; /* Espacement entre le texte et l'étoile */
    }

</style>

<script>
    $(document).ready(function() {

        $('.alert').delay(2000).fadeOut(400, function() {
            $(this).alert('close');
        });
    });
</script>
@endsection
