<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/inc/app_top.php';
$obituary = new Obituary($mysqli);
$listings = $obituary->get_listings();
$meta_subtitle = ' | Caring for your pet like a member of the family';
$page = 'obituaries';
include_once $_SERVER['DOCUMENT_ROOT'] . '/inc/header_html.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/inc/header_nav.php';
$display_active = false;
if( $_REQUEST['id'] ) {
	$obituary->get_obituary( $_REQUEST['id'] );
	if( $obituary->obituary['approvedOn'] ) $display_active = true;
}
?>
<div class="obits_body">
<div class="navbar-filler"></div>
<div id="active_listing" class="container<? if( !$display_active ) echo ' hidden'; ?>">
	<?
	if( $display_active ) {
		include $_SERVER['DOCUMENT_ROOT'] . '/obituaries/modules/listing.php';
	}
	?>
</div>
<div id="all_listings" class="container">
    <div class="double-stripe"><span class="listing_header">Complete Listings</span></div>
    <?
	if( count( $listings ) > 0 ) {
		$itemCount = 1;
		foreach( $listings as $key => $data ) {
			?>
			<div class="listing-preview pull-left" data-id="<?=$key?>">
            	<div class="listing-main">
                    <div class="img-container pull-left">
                        <?
                        if( $data['profile'] ) {
                            ?><img src="/img/obits/<?=$key?>/profile.<?=$data['profile']?>"><?
                        }
                        ?>
                    </div>
                    <div class="listing-detail pull-left">
                        <div class="listing-name"><?=$data['petName']?></div>
                        <div class=""><?=$data['familyName']?></div>
                    </div>
					<div class="clearfix"></div>
                </div>
                <div><?=date( "F j, Y", strtotime( $data['passed'] ) )?></div>
                <div class="listing-link">VIEW LISTING</div>
			</div>
			<?
			if( $itemCount < 4 ) {
				?><div class="listing-space pull-left"></div><?
			}
			if( $itemCount == 4 ) {
				$itemCount = 1;
			} else {
				$itemCount++;
			}
		}
	} else {
		?><div class="message">No remembrances found.</div><?
	}
    ?>
    <div class="clearfix"></div>
    <div class="text-center"><div class="btn btn-primary obit-btn-lrg link_<? echo $_SESSION['client_id'] ? 'listings' : 'client-login'; ?>"><? if( !$_SESSION['client_id'] ) echo 'LOGIN AND '; ?>CREATE A REMEMBRANCE</div></div>
</div>
<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/footer_site.php";
include_once $_SERVER['DOCUMENT_ROOT'] . '/inc/footer_html.php';
?>
