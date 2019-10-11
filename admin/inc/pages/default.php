<?
$listing = new Obituary( $mysqli );
if( $_REQUEST['view'] && $_REQUEST['view'] != 'Active' ) {
	$view = $_REQUEST['view'];
	$alt_view = 'active';
} else {
	$view = 'Active';
	$alt_view = 'archive';
}
$pg_num = $_REQUEST['pg'] ? $_REQUEST['pg']: 1;
$records = $listing->get_records( $view, $pg_num );
?>
<div class="obits_body">
<div class="navbar-filler"></div>
<div class="container">
<div class="page_head">
	<div class="title pull-left"><?=$view?> Listing</div>
    <div id="search" class="pull-right">
        <div id="searchbar" class="pull-right">
            <div class="search_icon pointer pull-left"></div>
            <input type="text" id="search_txt" class="pull-left" placeholder="Search Listing">
            <div class="search_clear pull-right"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="link_<?=$alt_view?> btn_<?=$alt_view?> button mright pull-right"></div>
    <div class="clearfix"></div>
</div>
<div class="table mtop">
	<div class="table_head">
        <div class="cell_name pull-left">NAME (family, pet)</div>
        <div class="cell_date pull-left">PASSED ON</div>
        <div class="cell_approval pull-left">APPROVAL</div>
        <?
        $actions = array(
					'Active'	=> array( 'archive', 'delete', 'edit' ),
					'Archive'	=> array( 'unarchive', 'delete', 'view' )
				);
		foreach( $actions[$view] as $a ) {
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
                <div class="cell_name pull-left">
					<?
                    if( $_SESSION['lv_admin'] ) {
                        ?>
                        <div class="tooltip hidden">
                        	Created by <? echo ( $data['client'] > 0 ) ? $listing->clients[$data['client']] : 'unknown'; ?> on <?=$data['createdOn']?>.<br>
                            <?
							if( $data['approvedOn'] ) {
								?>Approved by <?=$listing->users[$data['approvedBy']]?> on <?=$data['approvedOn']?>.<?
							}
							?>
                        </div>
						<?
                    }
					echo $data['familyName'].', '.$data['petName'];
                    ?>
                </div>
                <div class="cell_date pull-left"><? echo $data['passed'] ? date( 'l, F j, Y', strtotime($data['passed']) ) : "&nbsp;"; ?></div>
                <div class="cell_approval pull-left">
                	<span class="strong_<? echo $data['approvedOn'] ? 'green' : 'orange'; ?>"><? echo $data['approvedOn'] ? 'Approved' : 'Pending Approval'; ?></span>
                </div>
				<?
                foreach( $actions[$view] as $aKey => $a ) {
                    ?><div class="pull-right<? if( $aKey == 0 ) echo ' cell_action'; ?>"><div class="icon_<?=$a?> link_action_<?=$a?>"></div></div><?
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
    <?
	if( $listing->pages > 1 ) {
		?>
        <div class="table_pg mtop mbtm">
        	<?
            if( $pg_num < $listing->pages ) {
				?><div class="arrow_right link_pagenext pull-right" data-id="<?=$view.'-'.($pg_num+1)?>"></div><?
			}
			?>
            <div class="pg_total pull-right">of <a class="link_pagelast blue" data-id="<?=$view.'-'.$listing->pages?>"><?=$listing->pages?></a> pages</div>
            <div id="pg_current" class="pg_current pull-right"><?=$pg_num?></div>
            <?
            if( $pg_num > 1 ) {
				?><div class="arrow_left link_pageprev pull-right" data-id="<?=$view.'-'.($pg_num-1)?>"></div><?
			}
			?>
            <div class="clearfix"></div>
        </div>
        <?
	}
	?>
</div>
<div class="link_logout btn_logout button pull-right"></div>
<div class="link_contact btn_help button mright pull-right"></div>
<?
if( $_SESSION['lv_admin'] ) {
	?><div class="link_sysadmin btn_sysadmin button mright pull-right"></div><?
}
?>
<div class="clearfix mbtm_big"></div>
</div>