<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/inc/app_top.php';
$obituary = new Obituary($mysqli);
$listings = $obituary->get_listings();

$meta_subtitle = ' | Caring for your pet like a member of the family';
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/header_html.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/header_nav.php";
?>
<div>
	<section id="faqs" class="sections-bg bottom-shadow">
		<div class="container">
		<div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <h1>Frequently Asked Questions</h1>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div id="accordion">
                  <h3>Where are you located?</h3>
                  <div>
                    <p>
                    Our address is 2500 State Highway 66 East, Rockwall, TX, 75087.  Our building is located behind 
                    Rest Haven Funeral Home & Memorial Park, on the west property line.  Please call 972-772-5671 for directions 
                    if you are not familiar with our location.
                    </p>
                  </div>
                  <h3>What are your hours of operation?</h3>
                  <div>
                    <p>
                    Our office hours are Monday through Friday, 8:00 am to 5:00 pm.  We are available on Saturdays from 
                    8:00 am to 4:00 pm, by appointment only.  Our services are available outside of these hours as needed, 
                    and at an additional cost.
                    </p>
                  </div>
                  <h3>Can I tour your facility?</h3>
                  <div>
                    <p>
                    Absolutely!  We are proud of our state-of-the-art facility and welcome the opportunity to show you the 
                    caring and professional environment we provide for the pet families we serve.
                    </p>
                  </div>
                  <h3>Will you come get my pet, or should I bring my pet to you?</h3>
                  <div>
                    <p>
                    We will bring your pet into our care either at your home or at the Veterinary Clinic. 
                    If you would rather bring your pet to our office, we ask that you call ahead so we can 
                    ensure that one of our professional staff is available to meet with you.
                    </p>
                  </div>
                  <h3>What exactly is cremation, and how does it work?</h3>
                  <div>
                    <p>
                    Cremation is a means of final disposition and is an alternative to burial.  
                    It is a heating and mechanical process that reduces the pet remains to bone 
                    fragments of unidentifiable dimensions.
                    </p>
                  </div>
                  <h3>What is a private cremation?</h3>
                  <div>
                    <p>
                    With a private cremation, pets are cremated alone and are the only body within 
                    the cremation chamber. Pet parents will receive their pet's cremated remains, 
                    and only their pet's cremated remains.
                    </p>
                  </div>
                  <h3>What is a communal cremation?</h3>
                  <div>
                    <p>
                    A communal cremation is one in which multiple pet remains are present in the 
                    cremation chamber.  There is no separation of the pet remains during the communal 
                    cremation process, and the pet’s cremated remains are not returned to the owner.
                    </p>
                  </div>
                  <h3>Can I witness my pet’s cremation?</h3>
                  <div>
                    <p>
                    Yes, witnessed cremations can be scheduled with advance notice.  We have a beautiful 
                    facility with a viewing room for families who choose to witness their pet’s cremation. 
                    Most witnessed cremations are scheduled first thing in the morning.
                    </p>
                  </div>
                  <h3>What if I want to say a final goodbye, or have a memorial service for my pet?</h3>
                  <div>
                    <p>
                    We understand how difficult it is to say goodbye.  Our beautiful facility provides 
                    a comfortable environment where you can take that extra time to say goodbye to your pet.  
                    We also have areas, both inside and outside, that are suitable for a memorial service or a time of remembrance.
                    </p>
                  </div>
                  <h3>How will my pet’s cremated remains be returned to me?</h3>
                  <div>
                    <p>
                    As a part of our private cremation service, we will return your pet’s cremated remains to you 
                    in one of our standard urns.  However, for an additional cost, you may choose from our wide selection 
                    of custom urns.  You can view our urn selections either in our showroom, or <a href="http://peturncatalog.com/catalog/index.php?distributor_id=1155pmcs" target="_blank">online</a>.
                    </p>
                  </div>
                  <h3>What forms of payment do you accept?</h3>
                  <div>
                    <p>
                    We accept cash, checks and all major credit cards.  Payment is due when services are rendered.
                    </p>
                  </div>
                </div>
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
