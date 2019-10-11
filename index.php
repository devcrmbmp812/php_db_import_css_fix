<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/inc/app_top.php';
$obituary = new Obituary($mysqli);
$listings = $obituary->get_listings();

$meta_subtitle = ' | Caring for your pet like a member of the family';
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/header_html.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/header_nav.php";
?>
<style type="text/css">.carousel-indicators {display: none;}</style>
<div>
	<header id="home" class="sections-bg section-top-shaddow">
		<div class="container">
		<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 homePageTitle">
					<h1>Caring for your pet like<br>a member of the family</h1>
				</div>
		</div>
		</div>
	</header>
	<section id="ourservices" class="sections-bg bottom-shadow">
		<div class="container">
		<div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <h1>Our Services</h1>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
    		<h3>About our Services</h3>
            <p>Pet Memories Cremation Service was developed to operate as a professional service for pet owners for the private cremation of their pets. While we specialize in private individual cremation, we also provide a convenient support service for the communal cremation of deceased pets whose owners do not wish to keep the cremated remains.</p>
            <p style="margin: 40px 0 50px 0;">
            <a href="/facility" class="btn btn-primary obit-btn" style="width: 100%;">View Our Facility</a>
            </p>
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
	<section id="urns" class="sections-bg bottom-shadow">
		<div class="container">
		<div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <h1>Urns</h1>
            <h2>The price of the cremation includes Choice A. You may upgrade your urn with one of the additional choices.</h2>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
			<div class="urnstyle-a">
            <img class="img-responsive" src="img/urn-a.jpg" />
            <span class="urn-letter">A</span>
            <p>Cedar Urn with Lock<br>or Oak Urn</p>
            </div>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
			<div class="urnstyle-b">
            <img class="img-responsive" src="img/urn-b.jpg" />
            <span class="urn-letter">B</span>
            <p>Paw Print Series<br>(additional cost)</p>
            </div>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
			<div class="urnstyle-c">
            <img class="img-responsive" src="img/urn-c.jpg" />
            <span class="urn-letter">C</span>
            <p>Candle Urns with Photo<br>(additional cost)</p>
            </div>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
			<div class="urnstyle-c">
            <img class="img-responsive" src="img/urn-d.jpg" />
            <span class="urn-letter">D</span>
            <p>Need More Options?<br><a href="http://peturncatalog.com/catalog/index.php?distributor_id=1155pmcs" target="_blank">View Online Catalog</a></p>
            </div>
            </div>
		</div>
		</div><!-- /.container -->
	</section>
	<section id="obituaries" class="sections-bg bottom-shadow">
		<div class="container">
                <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <h1>Obituaries</h1>
                </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 marginTop40">
                                <div id="carousel-390357" class="carousel slide custom-controls-slider">
                                  <!-- Wrapper for slides -->
                                    <div class="carousel-inner">
                                    	<?
										if( count( $listings ) > 0 ) {
											$firstItem = true;
											$itemCount = 1;
											foreach( $listings as $key => $data ) {
												if( $itemCount == 1 ) {
													?>
													<div class="item<? if( $firstItem ) echo ' active'; ?>">
													<div class="row">
													<?
													$firstItem = false;
												}
												?>
												<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 text-center">
													<img class="img-circle img-center img-responsive obit-profile" src="<? echo $data['profile'] ? '/img/obits/'.$key.'/profile.'.$data['profile'] : '/img/pet-obits-generic.png'; ?>" alt="Pet Memories Remembrance">
													<h4 class="obit-name"><b><?=$data['petName']?></b></h4>
													<p class="padding-lg obit-preview-copy">Family: <?=$data['familyName']?><br>Passed:<br><?=date( "F j, Y", strtotime( $data['passed'] ) )?></p>
													<p><a href="/obituaries/index.php?id=<?=$key?>" class="btn btn-primary obit-btn">VIEW</a></p>
												</div>
												<?
												if( $itemCount == 4 ) {
													?></div></div><?
													$itemCount = 1;
												} else {
													$itemCount++;
												}
											}
											if( $itemCount != 1 ) {
												?></div></div><?
											}
										}
										?>
                                    </div>
                                  <!-- Controls -->
                                    <a class="left carousel-control" href="#carousel-390357" data-slide="prev">
                                        <i class="fa fa-angle-left fa-4x"></i> 
                                    </a>
                                    <a class="right carousel-control" href="#carousel-390357" data-slide="next">
                                        <i class="fa fa-angle-right fa-4x"></i> 
                                    </a>
                                </div><!-- /.carousel -->
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                            <a href="obituaries/" class="btn btn-primary obit-btn-lrg">VIEW ALL REMEMBRANCES</a>
                            </div>
                        </div>
                </div>
		</div><!-- /.container -->
	</section>
	<section id="testimonials" class="sections-bg bottom-shadow">
		<div class="container">
		<div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <h1 class="marginbtm30">Testimonials</h1>
                </div>
                    <div id="carousel-example-generic" class="carousel slide custom-controls-slider" data-ride="carousel">
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                      </ol>
                    
                      <!-- Wrapper for slides -->
                      <div class="carousel-inner">
                        <div class="item active">
                          <div class="testimonial-copy">
                          Brent, I wish to thank you very much for taking such good<br>care of Sundance. 
                          I am a disabled veteran who had the proud distinction of having Sundance as a 
                          friend and companion for eleven years. He will be missed terribly. Your courtesy 
                          was so much appreciated.
                            <br><br>
                            <span>-Charles</span> (Pet Parent, Kaufman, TX)</div>
                        </div>
                        <div class="item">
                          <div class="testimonial-copy">
                          Greg and Associates, Thank you so very much for the compassion you all showed 
                          with my sweet Titus and myself last week. You all went above and beyond to assist 
                          me in my time of grief. I pray God grants you all over and abundantly for reflecting 
                          his love to others so well.
                            <br><br>
                            <span>-Brandi</span> (Pet Parent)</div>
                        </div>
                        <div class="item">
                          <div class="testimonial-copy">
                          Greg, We wanted to thank Mitchell for his kind empathy on Friday. It was so greatly 
                          appreciated and it made this difficult time a little less stressful to have such a 
                          nice person take our Kasey. You have all been just what we were hoping to find. I 
                          can never thank you enough.
                            <br><br>
                            <span>-Robin</span> (Pet Parent Rowlett, TX)</div>
                        </div>
                        <div class="item">
                          <div class="testimonial-copy">
                          Pet Memories,
                            We lost our cat Oreo unexpectedly earlier this week and I just wanted to thank 
                            Greg and Marty, who were most kind. Not everyone comprehends how much a family 
                            pet means to the family, but they were remarkably understanding and the service 
                            we got was more than we expected. Again, thank you very much.
                            <br><br>
                            <span>-Blair</span> (Pet Owner)</div>
                        </div>
                        <div class="item">
                          <div class="testimonial-copy">
                          Marty, I want to thank you for your kindness to me and Max on Friday. You’ll never 
                          know how much I appreciate your understanding in my having to do the hardest thing 
                          I’ve ever had to do by having Max put to sleep and your cremating him so I could 
                          always have him with me.
                            <br><br>
                            <span>-Susan</span> (Pet Owner, Mesquite, TX)</div>
                        </div>
                      </div>
                    
                      <!-- Controls -->
                      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <i class="fa fa-angle-left fa-4x"></i> 
                      </a>
                      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <i class="fa fa-angle-right fa-4x"></i> 
                      </a>
                    </div>
		</div>
		</div><!-- /.container -->
	</section>
	<section id="contactus" class="sections-bg bottom-shadow">
		<div class="container">
		<div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <h1>Contact Us</h1>
            <h2>Please feel free to contact us with any questions or concerns you may have</h2>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 marginTop40">
            <div id="gmap"><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3348.5534677770643!2d-96.424191!3d32.936394!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xefdbf1d89bd212e6!2sPet+Memories+Cremation+Services!5e0!3m2!1sen!2sus!4v1410890295248" width="487" height="300" frameborder="0" style="border:0"></iframe></div>
            <div class="address">
            <h4>PET MEMORIES</h4>
            <ul class="list-inline">
            <li class="icon-address"><i class="fa fa-map-marker fa-fw"></i> 2500 Hwy. 66 E<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rockwall, TX 75087</li>
            <li class="icon-phone"><i class="fa fa-phone fa-fw"></i> 972-772-5671</li>
            <li class="icon-fax"><i class="fa fa-fax fa-fw"></i> 972-771-1912</li>
            </ul>
            </div>
            </div>
            <div class="col-xs-12 col-sm-5 col-sm-offset-1 col-md-5 col-md-offset-1 col-lg-5 col-lg-offset-1 marginTop40">
            <div id="formHome_msg" class="form_message hidden"></div>
            <div id="formHome_content">
                    <form id="formHome" novalidate>
                        <div class="row">
                                <div class="form-group">
                                    <input type="text" class="form-control first" placeholder="Name *" name="name" id="name" required data-validation-required-message="Please enter your name." />
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control email" placeholder="Email *" name="email" id="email" required data-validation-required-message="Please enter your email address.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control phone" placeholder="Phone *" name="phone" id="phone" required data-validation-required-message="Please enter your phone number.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <textarea rows="6" class="form-control" placeholder="Your Message *" name="message" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            <div class="clearfix"></div>
                                <div id="success"></div>
                                <button type="submit" class="btn btn-primary obit-btn width100">Send Message</button>
                        </div>
                    </form>
                    </div>
            <div class="wearelocated">Our facility is located behind Rest Haven Memorial Park in Rockwall, Texas. From I30 E, 
            exit 3549 and go North (left). Take a left at Hwy 66. Rest Haven Memorial Park will be on the right side. Pet Memories 
            is located in the Northwest corner of the park.</div>
            </div>
		</div>
		</div><!-- /.container -->
	</section>
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/footer_site.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/footer_html.php";
?>
