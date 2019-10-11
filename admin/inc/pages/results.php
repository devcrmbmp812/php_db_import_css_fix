<?
$listing = new Obituary( $mysqli );
$records = $listing->get_admin_results( $_REQUEST['search'] );
?>
<div class="obits_body">
<div class="navbar-filler"></div>
<div class="container">
<div class="page_head">
	<div class="title pull-left">Search Results</div>
    <div id="search" class="pull-right">
        <div id="searchbar" class="pull-right">
            <div class="search_icon pointer pull-left"></div>
            <input type="text" id="search_txt" class="pull-left" placeholder="Search Listing">
            <div class="search_clear button pull-right"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="link_active btn_active button mright pull-right"></div>
    <div class="clearfix"></div>
</div>
<div class="table mtop">
	<div class="table_head">
        <div class="cell_name pull-left">NAME (last, first)</div>
        <div class="cell_date pull-left">PASSED ON</div>
        <div class="cell_approval pull-left">APPROVAL</div>
        <?
        $actions = array( 'archive', 'delete', 'edit' );
		foreach( $actions as $a ) {
			?><div class="cell_action pull-right"><?=strtoupper($a)?></div><?
		}
		?>
        <div class="clearfix"></div>
    </div>
    <div class="table_body">
    	<?
		$i = 0;
		foreach( $records as $key => $data ) {
			?>
            <div id="listing-<?=$key?>" class="table_row<? if( $i & 1 ) echo ' zebra'; ?>">
                <div class="cell_name pull-left"><?=$data['lastName'].', '.$data['firstName']?></div>
                <div class="cell_date pull-left"><? if( $data['passed'] ) echo date( 'l, F j, Y', strtotime($data['passed']) ); ?></div>
                <div class="cell_approval pull-left"></div>
                <?
                foreach( $actions as $aKey => $a ) {
					$exclude = ( $a == 'archive' && $data['status'] != 'Active' ) ? true: false;
					?>
					<div class="pull-right<? if( $aKey == 0 ) echo ' cell_action'; ?>">
						<div class="icon_<?=$a?> link_action_<?=$a?><?  if( $exclude ) echo ' invisible'; ?>"></div>
					</div>
					<?
                }
                ?>
                <div class="clearfix"></div>
            </div>
            <?
			$i++;
		}
		while( $i < 10 ) {
			?><div class="table_row<? if( $i & 1 ) echo ' zebra'; ?>"></div><?
			$i++;	
		}
		?>
    </div>
</div>
<div class="link_logout btn_logout button pull-right"></div>
<div class="link_contact btn_help button mright pull-right"></div>
<?
if( $_SESSION['lv_admin'] ) {
	?><div class="link_sysadmin btn_sysadmin button mright pull-right"></div><?
}
?>
<div class="clearfix"></div>
</div>