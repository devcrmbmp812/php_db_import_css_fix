<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/inc/app_top.php';
$obituary = new Obituary($mysqli);
$obituary->get_obituary($_REQUEST['id']);

$meta_subtitle = ' | Remembering . . .'; 
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/header_html.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/header_nav.php";
?>
<div class="obit-remember"><div class="container">
    <div class="obit-images pull-left">
    	<img class="img_profile" src="/img/obits/<?=$obituary->obituary['ID']?>/profile.<?=$obituary->obituary['profile']?>">
        <img class="img_small img_swap pull-left active" src="/img/obits/<?=$obituary->obituary['ID']?>/profile.<?=$obituary->obituary['profile']?>">
        <?
		$first = true;
		for( $i = 1; $i < 5; $i++ ) {
			if( $obituary->obituary['photo'.$i] ) {
				?><img class="img_small img_space img_swap pull-left" src="/img/obits/<?=$obituary->obituary['ID']?>/<?=$i.'.'.$obituary->obituary['photo'.$i]?>"><?
				$first = false;
			}
		}
		?>
        <div class="clearfix"></div>
    </div>
    <div class="obit-desc pull-left">
    	<div class="title"><?=$obituary->obituary['firstName'].' '.$obituary->obituary['lastName']?></div>
        <p><? if( $obituary->obituary['intro'] != '' ) echo '"'.$obituary->obituary['intro'].'"'; ?></p>
    </div>
    <div class="obit-links pull-right">
    	<div id="form-condolence" class="obit-links_link icon-condolence popup_trigger">Post Condolences</div>
        <div class="obit-links_link icon-flowers link_flowers">Send Flowers</div>
        <div class="obit-links_link icon-return link_return">Back to List</div>
        <?
		if( $_SESSION['client_id'] ) {
			?>
            <div class="obit-links_link icon-list link_listings">View Your Listings</div>
            <div class="obit-links_link icon-logout link_logout">Log Out</div>
            <?
		}
		?>
    </div>
    <div class="clearfix"></div>
    <div class="obit-info pull-left">
    	<div class="obit-lifespan">
        	<div class="pull-left"><span>BORN:</span><?=date( "F j, Y", strtotime( $obituary->obituary['born'] ) )?></div>
            <div class="pull-right"><span>PASSED:</span><?=date( "l, F j, Y", strtotime( $obituary->obituary['passed'] ) )?></div>
            <div class="clearfix"></div>
        </div>
        <div class="obit-service pull-left">
        	<div class="title">SERVICE</div>
            <div class="col1 pull-left">Date<br>Time<br><br>Location</div>
            <div class="col2 pull-left">
				<?
                echo $obituary->obituary['service_datetime'] ? date( "l - F j, Y", strtotime( $obituary->obituary['service_datetime'] ) ).'<br>'.date( "g:i A", strtotime( $obituary->obituary['service_datetime'] ) ) : 'TBD<br>';
				?>
				<br><br>
				<?
                $google_address = '';
                if( $obituary->obituary['service_business'] ) echo $obituary->obituary['service_business'].'<br>';
                if( $obituary->obituary['service_branch'] ) echo $obituary->obituary['service_branch'].'<br>';
                if( $obituary->obituary['service_address'] ) {
                    echo $obituary->obituary['service_address'].'<br>';
                    $google_address .= $obituary->obituary['service_address'].', ';
                }
                if( $obituary->obituary['service_address2'] ) {
                    echo $obituary->obituary['service_address2'].'<br>';
                    $google_address .= $obituary->obituary['service_address2'].', ';
                }
                if( $obituary->obituary['service_city'] && $obituary->obituary['service_state'] ) {
                    echo $obituary->obituary['service_city'].', '.$obituary->obituary['service_state'].' ';
                    $google_address .= $obituary->obituary['service_city'].', '.$obituary->obituary['service_state'].' ';
                } elseif( $obituary->obituary['service_city'] ) {
                    echo $obituary->obituary['service_city'].' ';
                    $google_address .= $obituary->obituary['service_city'].' ';
                }
                if( $obituary->obituary['service_zip'] ) {
                    echo $obituary->obituary['service_zip'];
                    $google_address .= $obituary->obituary['service_zip'];
                }
                if( $google_address != '' ) {
                    ?><br><a href="http://maps.google.com/?q=<?=urlencode($google_address)?>" target="_blank">Directions</a><?
                }
                ?>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="obit-visitation pull-right">
        	<div class="title">VISITATION</div>
            <div class="col1 pull-left">Date<br>Time<br><br>Location</div>
            <div class="col2 pull-left">
				<?
                echo $obituary->obituary['visitation_datetime'] ? date( "l - F j, Y", strtotime( $obituary->obituary['visitation_datetime'] ) ).'<br>'.date( "g:i A", strtotime( $obituary->obituary['visitation_datetime'] ) ) : 'TBD<br>';
				?>
				<br><br>
				<?
                $google_address = '';
                if( $obituary->obituary['visitation_business'] ) echo $obituary->obituary['visitation_business'].'<br>';
                if( $obituary->obituary['visitation_branch'] ) echo $obituary->obituary['visitation_branch'].'<br>';
                if( $obituary->obituary['visitation_address'] ) {
                    echo $obituary->obituary['visitation_address'].'<br>';
                    $google_address .= $obituary->obituary['visitation_address'].', ';
                }
                if( $obituary->obituary['visitation_address2'] ) {
                    echo $obituary->obituary['visitation_address2'].'<br>';
                    $google_address .= $obituary->obituary['visitation_address2'].', ';
                }
                if( $obituary->obituary['visitation_city'] && $obituary->obituary['visitation_state'] ) {
                    echo $obituary->obituary['visitation_city'].', '.$obituary->obituary['visitation_state'].' ';
                    $google_address .= $obituary->obituary['visitation_city'].', '.$obituary->obituary['visitation_state'].' ';
                } elseif( $obituary->obituary['visitation_city'] ) {
                    echo $obituary->obituary['visitation_city'].' ';
                    $google_address .= $obituary->obituary['visitation_city'].' ';
                }
                if( $obituary->obituary['visitation_zip'] ) {
                    echo $obituary->obituary['visitation_zip'];
                    $google_address .= $obituary->obituary['visitation_zip'];
                }
                if( $google_address != '' ) {
                    ?><br><a href="http://maps.google.com/?q=<?=urlencode($google_address)?>" target="_blank">Directions</a><?
                }
                ?>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <div class="obit-bio">
        	<div class="title">BIO</div>
            <div class="obit-bio_scroll scrolldiv"><p><?=str_replace( "\n", '</p><p>', $obituary->obituary['bio'] )?></p></div>
        </div>
    </div>
    <div class="obit-condolences pull-right">
    	<div class="title">CONDOLENCES</div>
        <div class="obit-condolence-items scrolldiv">
            <?
			if( $condolences = $obituary->get_condolences( $obituary->obituary['ID'] ) ) {
				foreach( $condolences as $key => $data ) {
					?>
                    <div class="obit-condolence_item">
						<?=str_replace( "\n", '<br>', $data['condolence'] )?><br><br>
                        <div>Posted: <?=date( "m-d-y", strtotime( $data['modifiedOn'] ) )?></div>
                        <div>Posted by: <?=$data['name']?></div>
                    </div>
					<?
				}
			}
			?>
        </div>
    </div>
    <div class="clearfix"></div>
</div></div>
<div id="popup_form-condolence" class="popup hidden">
	<div class="popup_close button pull-right">X</div>
    <div class="title">Offer Your Condolences</div>
    <form>
    	<input type="hidden" name="process" value="obituary">
        <input type="hidden" name="proc_type" value="condolence">
        <input type="hidden" name="obituary" value="<?=$obituary->obituary['ID']?>">
        <textarea name="condolence" placeholder="Type your condolence here."></textarea>
        <input type="text" name="name" placeholder="Your Name">
        <div class="comment" style="margin: -20px 0px 15px 0px; text-align: left;">Leave your name blank to post as Anonymous</div>
        <input type="button" class="button post_condolence" value="POST YOUR CONDOLENCE">
    </form>
    </div>
    <div class="clearfix"></div>
</div>
<?
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/footer_site.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/footer_html.php";
?>