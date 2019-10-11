<?
if( @$obituary->obituary ) {
	?>
    <h1><?=$obituary->obituary['petName']?></h1>
    <div class="col-side pull-left">
    	<?
		if( $obituary->obituary['profile'] ) {
			?><img src="/img/obits/<?=$obituary->obituary['ID']?>/profile.<?=$obituary->obituary['profile']?>"><?
		}
		?>
        <div class="addthis_toolbox addthis_default_style addthis_32x32_style" addthis:title="Pet Memories | Remembering <?=$obituary->obituary['petName']?>" addthis:url="http://<?=$_SERVER['SERVER_NAME']?>/obituaries/index.php?id=<?=$obituary->obituary['ID']?>">
            <a class="addthis_button_facebook"></a>
            <a class="addthis_button_google_plusone_share"></a>
            <a class="addthis_button_twitter"></a>
            <a class="addthis_button_email"></a>
            <a class="addthis_button_print"></a>
            <a class="addthis_button_more"></a>
        </div>
        <h3>Family:</h3><h4><?=$obituary->obituary['familyName']?></h4>
        <h3>Passed:</h3><h4><?=date( "l, F j, Y", strtotime( $obituary->obituary['passed'] ) )?></h4>
        <div class="obit-links">
            <?
            if( $_SESSION['client_id'] ) {
                if( $_SESSION['client_id'] == $obituary->obituary['client'] ) {
                    ?><div class="obit-links_link icon-condolence link_edit" data-id="<?=$obituary->obituary['ID']?>">Edit This Listing</div><?
                }
                ?>
                <div class="obit-links_link icon-list link_listings">View Your Listings</div>
                <?
            }
            ?>
        </div>
    </div>
    <div class="col-main pull-left">
        <h3>REMEMBERING <span style="text-transform: uppercase;"><?=$obituary->obituary['petName']?></span></h3>
        <p><?=str_replace( "\n", '</p><p>', $obituary->obituary['bio'] )?></p>
    </div>
    <div class="col-side pull-right">
        <?
		if( $obituary->obituary['photo1'] ) {
			?><img src="/img/obits/<?=$obituary->obituary['ID']?>/1.<?=$obituary->obituary['photo1']?>"><?
		}
        if( $obituary->obituary['photo2'] ) {
			?><img src="/img/obits/<?=$obituary->obituary['ID']?>/2.<?=$obituary->obituary['photo2']?>"><?
		}
		?>
    </div>
    <div class="clearfix"></div>
    <?
}
?>