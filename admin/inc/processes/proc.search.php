<div class="title">Results Found</div>
<?
$bypass = true;
$obituary = new Obituary( $mysqli );
$results = $obituary->get_results();
if( count( $results ) > 0 ) {
	?>
	<div class="pagescroll">
	<div class="pagescroll-container">
	<?
	$page_total = ceil( count( $results ) / 9 );
	foreach( $results as $key => $data ) {
		?>
		<div class="obit-listings_row link_view clearfix" data-id="<?=$key?>">
			<div class="col1"><?=$data['lastName'].', '.$data['firstName']?></div>
			<div class="col2"><?=date( "l, F j, Y", strtotime( $data['passed'] ) )?></div>
		</div>
		<?
	}
	?>
	<div class="obit-listings_row clearfix"></div>
	</div>
	</div>
	<div class="page_row">
		<div class="page_btn pull-left"><div class="page_prev button hidden">&lt;</div></div>
		<div class="page_info pull-left">Page <span class="page_current">1</span> of <span class="page_total"><?=$page_total?></span></div>
		<div class="page_btn pull-right"><div class="page_next button<? if( $page_total == 1 ) echo ' hidden'; ?>">&gt;</div></div>
		<div class="clearfix"></div>
	</div>
	<?
} else {
	?><div class="message">No search results found.</div><?
}
?>
<div class="button show_listings mtop">SHOW ALL LISTINGS</div>