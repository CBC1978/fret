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
                <h3 class="mb-35">Details</h3>
            </div>
            <div class="box-breadcrumb">
                <div class="breadcrumbs">
                    <ul>
                        <li> <a class="icon-home" href="index.html">offres</a></li>
                        <li><span>Details</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <section class="section-box mt-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-sm-10 col-10">
                        <div class="box-border-single">
                            <div class="row mt-10">
                                <div class="col-lg-8 col-md-12">
                                    <h3>Transport ouga -bobo</h3>
    
                                </div>
                                <div class="col-lg-4 col-md-10 text-lg-end">
    
                                    <div class="col-md-8"><a class="btn btn-default mr-15" href="#" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm">POSTULER A L'OFFRE</a></div>
                                </div>
                            </div>
                            <div class="border-bottom pt-10 pb-10"></div>
                            <div class="banner-hero banner-image-single mt-10 mb-20"><img src="imgs/page/job-single-2/img.png" alt="jobBox"></div>
                            <div class="job-overview">
                                <h5 class="border-bottom pb-15 mb-30">Details de l'offres</h5>
                                <div class="row">
                                    <div class="col-md-6 d-flex">
                                        <div class="sidebar-icon-item"><img src="imgs/page/job-single/industry.svg" alt="jobBox"></div>
                                        <div class="sidebar-text-info ml-10"><span class="text-description industry-icon mb-10">Industry</span><strong class="small-heading"> Mechanical / Auto / Automotive, Civil / Construction</strong></div>
                                    </div>
                                    <div class="col-md-6 d-flex mt-sm-15">
                                        <div class="sidebar-icon-item"><img src="imgs/page/job-single/job-level.svg" alt="jobBox"></div>
                                        <div class="sidebar-text-info ml-10"><span class="text-description joblevel-icon mb-10">Job level</span><strong class="small-heading">Experienced (Non - Manager)</strong></div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-md-6 d-flex mt-sm-15">
                                        <div class="sidebar-icon-item"><img src="imgs/page/job-single/salary.svg" alt="jobBox"></div>
                                        <div class="sidebar-text-info ml-10"><span class="text-description salary-icon mb-10">Salary</span><strong class="small-heading">$800 - $1000</strong></div>
                                    </div>
                                    <div class="col-md-6 d-flex">
                                        <div class="sidebar-icon-item"><img src="imgs/page/job-single/experience.svg" alt="jobBox"></div>
                                        <div class="sidebar-text-info ml-10"><span class="text-description experience-icon mb-10">Experience</span><strong class="small-heading">1 - 2 years</strong></div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-md-6 d-flex mt-sm-15">
                                        <div class="sidebar-icon-item"><img src="imgs/page/job-single/job-type.svg" alt="jobBox"></div>
                                        <div class="sidebar-text-info ml-10"><span class="text-description jobtype-icon mb-10">Job type</span><strong class="small-heading">Permanent</strong></div>
                                    </div>
                                    <div class="col-md-6 d-flex mt-sm-15">
                                        <div class="sidebar-icon-item"><img src="imgs/page/job-single/deadline.svg" alt="jobBox"></div>
                                        <div class="sidebar-text-info ml-10"><span class="text-description mb-10">Deadline</span><strong class="small-heading">10/08/2022</strong></div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-md-6 d-flex mt-sm-15">
                                        <div class="sidebar-icon-item"><img src="imgs/page/job-single/updated.svg" alt="jobBox"></div>
                                        <div class="sidebar-text-info ml-10"><span class="text-description jobtype-icon mb-10">Updated</span><strong class="small-heading">10/07/2022</strong></div>
                                    </div>
                                    <div class="col-md-6 d-flex mt-sm-15">
                                        <div class="sidebar-icon-item"><img src="imgs/page/job-single/location.svg" alt="jobBox"></div>
                                        <div class="sidebar-text-info ml-10"><span class="text-description mb-10">Location</span><strong class="small-heading">Dallas, Texas Remote Friendly</strong></div>
                                    </div>
                                </div>
                            </div>
                            <div class="content-single">
                                <br><br>
                                <h4>Welcome to AliStudio Team</h4>
                                <p>The AliStudio Design team has a vision to establish a trusted platform that enables productive and healthy enterprises in a world of digital and remote everything, constantly changing work patterns and norms, and the need for organizational resiliency.</p>
                                <p>
                                    The ideal candidate will have strong creative skills and a portfolio of work which demonstrates their passion for illustrative design and typography. This candidate will have experiences in working with numerous different design platforms such as digital
                                    and print forms.
                                </p>
                                <br><br>
                                <h4>Essential Knowledge, Skills, and Experience</h4>
                                <ul>
                                    <li>A portfolio demonstrating well thought through and polished end to end customer journeys</li>
                                    <li>5+ years of industry experience in interactive design and / or visual design</li>
                                    <li>Excellent interpersonal skills</li>
                                    <li>Aware of trends in&#x202F;mobile, communications, and collaboration</li>
                                    <li>Ability to create highly polished design prototypes, mockups, and other communication artifacts</li>
                                    <li>The ability to scope and estimate efforts accurately and prioritize tasks and goals independently</li>
                                    <li>History of impacting shipping products with your work</li>
                                    <li>A Bachelor&rsquo;s Degree in Design (or related field) or equivalent professional experience</li>
                                    <li>Proficiency in a variety of design tools such as Figma, Photoshop, Illustrator, and Sketch</li>
                                </ul>
                            </div>
    
                            <div class="single-apply-jobs">
                                <div class="row align-items-center">
                                    <div class="col-md-5"><a class="btn btn-default mr-15" href="#" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm">POSTULER A L'OFFRE</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
