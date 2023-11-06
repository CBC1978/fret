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
            <h3 class="mb-35">Ajouter une Offre de Transport</h3>
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
                    <li> <a class="icon-home" href="index.html">Offre de Transport</a></li>
                    <li><span>Ajout d'offre de Transport</span></li>
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
                                            <div class="row mt-30">
                                                <div class="col-lg-9">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <h5 class="">Fait une Offre de Transport</h5>
                                                            <form method="POST" action="{{ route('carrier.announcements.store') }}">
                                                                @csrf
                                                            
                                                                <input type="hidden" name="user_id" value="{{ session('userId') }}">
                                                                <input type="hidden" name="fk_carrier_id" value="{{ session('fk_carrier_id') }}">
                                                            
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group mb-30">
                                                                            <label for="origin">Lieu de départ</label>
                                                                            <select id="origin" class="form-control @error('origin') is-invalid @enderror" name="origin" required>
                                                                                <option value="">Sélectionnez un lieu</option>
                                                                                <option value="Ouagadougou">Ouagadougou</option>
                                                                                <option value="Bobo-Dioulasso">Bobo-Dioulasso</option>
                                                                                <option value="Koudougou">Koudougou</option>
                                                                                <option value="Banfora">Banfora</option>
                                                                                <option value="Dédougou">Dédougou</option>
                                                                                <option value="Ouahigouya">Ouahigouya</option>
                                                                                <option value="Fada N'gourma">Fada N'gourma</option>
                                                                                <option value="Tenkodogo">Tenkodogo</option>
                                                                            </select>
                                                                            @error('origin')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group mb-30">
                                                                            <label for="destination">Lieu de destination</label>
                                                                            <select id="destination" class="form-control @error('destination') is-invalid @enderror" name="destination" required>
                                                                                <option value="">Sélectionnez un lieu</option>
                                                                                <option value="Ouagadougou">Ouagadougou</option>
                                                                                <option value="Bobo-Dioulasso">Bobo-Dioulasso</option>
                                                                                <option value="Koudougou">Koudougou</option>
                                                                                <option value="Banfora">Banfora</option>
                                                                                <option value="Dédougou">Dédougou</option>
                                                                                <option value="Ouahigouya">Ouahigouya</option>
                                                                                <option value="Fada N'gourma">Fada N'gourma</option>
                                                                                <option value="Tenkodogo">Tenkodogo</option>
                                                                            </select>
                                                                            @error('destination')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group mb-30">
                                                                            <label class="font-sm color-text-mutted mb-10">Date limite<span class="required">*</span></label>
                                                                            <input class="form-control" type="date" id="limit_date" name="limit_date" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group mb-30">
                                                                            <label class="font-sm color-text-mutted mb-10">Type de véhicule</label>
                                                                            <select class="form-control" name="vehicule_type" required>
                                                                                <option value="">Sélectionnez un type de véhicule</option>
                                                                                <option value="Porte voiture">Porte voiture</option>
                                                                                <option value="Semi remorque frigo">Semi remorque frigo</option>
                                                                                <option value="Ensemble articulé/citerne">Ensemble articulé/citerne</option>
                                                                                <option value="Ensemble articulé/benne">Ensemble articulé/benne</option>
                                                                                <option value="Ensemble articulé/carrosserie rigide">Ensemble articulé/carrosserie rigide</option>
                                                                                <option value="Ensemble articulé/porte char">Ensemble articulé/porte char</option>
                                                                                <option value="Camion Citerne">Camion Citerne</option>
                                                                                <option value="Camion isole à plateau">Camion isole à plateau</option>
                                                                                <option value="Camion isole à ridelle">Camion isole à ridelle</option>
                                                                                <option value="Semi remorque à ridelle">Semi remorque à ridelle</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group mb-30">
                                                                            <label class="font-sm color-text-mutted mb-10">Poids<span class="required">*</span> <span >(Tonnes)</span> </label>
                                                                            <input class="form-control" type="text" placeholder="En tonnes " name="weight">
                                                                        </div>
                                                                    </div>
                                                                    <!-- Ajoutez d'autres champs côte à côte ici si nécessaire -->
                                                                </div>
                                                                
                        
                                                <div class="form-group">
                                                    <label for="description">Description<span class="required">*</span></label>
                                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required>{{ old('description') }}</textarea>
                                                    @error('description')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                        
                                               
                                                    <button type="submit" class="btn btn-primary">Ajouter l'offre</button>
                                              
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
            
            $('.alert').delay(4000).fadeOut(400, function() {
                $(this).alert('close');
            });
        });
    </script>


@endsection
