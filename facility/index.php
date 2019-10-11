<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/inc/app_top.php';
$obituary = new Obituary($mysqli);
$listings = $obituary->get_listings();

$meta_subtitle = ' | Caring for your pet like a member of the family';
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/header_html.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/header_nav.php";
?>
<div>
	<section id="facility" class="sections-bg bottom-shadow">
		<div class="container">
		<div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" style="margin-bottom:15px;">
            <h1>Our Facility</h1>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <img class="img-responsive" style="margin-top: 20px;" src="/img/location.jpg" />
            </div>
            <div class="col-xs-12 col-sm-5 col-sm-offset-1 col-md-5 col-md-offset-1 col-lg-5 col-lg-offset-1">
    		<h3>About our Facility</h3>
            <p>Located on the grounds of Rest Haven Memorial Park in Rockwall, Texas our modern, state of the art facility 
            is suitable for any cremation tribute you desire.  In our showroom, you will find many choices of memorialization 
            for your beloved pet, and our comfortable facility offers a private viewing area for those who wish to witness 
            the cremation.  The Pet Memories Staff understands the difficulty of losing a pet, and we are here to offer 
            suggestions and answer questions.
            </p>
            </div>
		</div>
		</div><!-- /.container -->
	</section>
	<section id="ourservices" class="sections-bg bottom-shadow">
		<div class="container">
		<div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <h1>Our Services</h1>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
    		<h3>About our Services</h3>
            <p>Pet Memories Cremation Service was developed to operate as a professional service for pet owners for the private cremation of their pets. While we specialize in private individual cremation, we also provide a convenient support service for the communal cremation of deceased pets whose owners do not wish to keep the cremated remains.</p>
            <br>
            <h3>What We Believe</h3>
            <p>
            We believe that any business has a responsibility to serve its community. Pet Memories Cremation Service provides private cremations without charge for service dogs such as seeing eye, search and rescue, State Trooper and local police dogs.
            </p>
            </div>
            <div class="col-xs-12 col-sm-5 col-sm-offset-1 col-md-5 col-md-offset-1 col-lg-5 col-lg-offset-1">
            <h3>Our Services Include</h3>
            <ul class="ourservices list-unstyled">
            <li class="call"><img src="/img/icon-call.png" /><span>Prompt on-call removal of pets at<br>homes and veterinary facilities</span></li>
            <li class="clock"><img src="/img/icon-clock.png" /><span>After hours and weekend services<br>available for an additional cost</span></li>
            <li class="private"><img src="/img/icon-private.png" /><span>Facilities available for viewing/witnessed<br>cremations and private services</span></li>
            <li class="urn"><a href="http://peturncatalog.com/catalog/index.php?distributor_id=1155pmcs" target="_blank"><img src="/img/icon-urn.png" /></a><span>Decorative urns and keepsakes available<br><a href="http://peturncatalog.com/catalog/index.php?distributor_id=1155pmcs" target="_blank">View Online Catalog</a></span></li>
            <li class="people"><img src="/img/icon-people.png" /><span>Professional and caring staff<br>available for consultations</span></li>
            <li class="people"><a href="/faqs"><img src="/img/icon-faqs.png" /></a><span>Do you have a few more questions?<br><a href="/faqs">View our FAQs</a></span></li>
            </ul>
            </div>
		</div>
		</div><!-- /.container -->
	</section>
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/footer_site.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/footer_html.php";
?>
