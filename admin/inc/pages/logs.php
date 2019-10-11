<?
$listing = new Listing( $mysqli );
$pg_num = $_REQUEST['pg'] ? $_REQUEST['pg']: 1;
$logging = $listing->get_logging( $pg_num );
?>
<div class="obits_body">
<div class="navbar-filler"></div>
<div class="container">
<div class="page_head">
	<div class="title blue pull-left">Activity Log</div>
    <div class="link_active btn_active button pull-right"></div>
    <?
	if( $_SESSION['lv_admin'] ) {
		?><div class="link_sysadmin btn_sysadmin button mright pull-right"></div><?
	}
	?>
    <div class="clearfix"></div>
</div>
<div class="table mtop">
	<div class="table_head">
    	<div class="cell_logname pull-left">NAME (last, first)</div>
        <div class="cell_logtype pull-left">ACTION</div>
        <div class="cell_logname pull-left">EDITED BY</div>
        <div class="cell_logdate pull-left">EDIT DATE/TIME</div>
        <div class="clearfix"></div>
    </div>
    <div class="table_body">
    	<?
		$i = 0;
		foreach( $logging as $key => $data ) {
			?>
            <div id="log-<?=$key?>" class="table_row<? if( $i & 1 ) echo ' zebra'; ?>">
                <div class="cell_logname pull-left"><?=$data['lastName'].', '.$data['firstName'] ?></div>
                <div class="cell_logtype pull-left"><?=$data['action'] ?></div>
                <div class="cell_logname pull-left"><?=$listing->users[$data['userID']] ?></div>
                <div class="cell_logdate pull-left"><?=date( 'F j, Y - g:ia', strtotime($data['modifiedOn']) )?></div>
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
				?><div class="arrow_right link_logsnext pull-right" data-id="<?=($pg_num+1)?>"></div><?
			}
			?>
            <div class="pg_total pull-right">of <a class="link_logslast blue" data-id="<?=$listing->pages?>"><?=$listing->pages?></a> pages</div>
            <div id="pg_current" class="pg_current pull-right"><?=$pg_num?></div>
            <?
            if( $pg_num > 1 ) {
				?><div class="arrow_left link_logsprev pull-right" data-id="<?=($pg_num-1)?>"></div><?
			}
			?>
            <div class="clearfix"></div>
        </div>
        <?
	}
	?>
</div>
<div class="link_active btn_active button pull-right"></div>
<?
if( $_SESSION['lv_admin'] ) {
    ?><div class="link_sysadmin btn_sysadmin button mright pull-right"></div><?
}
?>
<div class="clearfix mbtm_big"></div>
</div>