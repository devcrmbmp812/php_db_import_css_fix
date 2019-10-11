<div class="obits_body">
<div class="navbar-filler"></div>
<div class="container">
<div class="page_head">
	<div class="title pull-left">Contact</div>
    <div id="search" class="pull-right mleft">
        <div id="searchbar" class="pull-right">
            <div class="search_icon pointer pull-left"></div>
            <input type="text" id="search_txt" class="pull-left" placeholder="Search Listing">
            <div class="search_clear button pull-right"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="link_archive btn_archive button mleft pull-right"></div>
    <div class="link_active btn_active button mleft pull-right"></div>
    <div class="clearfix"></div>
</div>
<div class="panel_break"></div>
<div>
	<?
	if( is_object( $contact ) ) {
		?><div class="message mbtm"><?=$contact->message?></div><?
	}
	?>
	<form id="contact_form" method="post">
    	<input type="hidden" name="process" value="contact">
        <label>Name</label><input type="text" name="name" value="<?=$_POST['name']?>">
        <label>Email</label><input type="email" class="half" name="email" value="<?=$_POST['email']?>" required>
        <input type="text" class="half pull-right mleft" name="phone" value="<?=$_POST['phone']?>"><label class="narrow pull-right">Phone</label>
        <div class="clearfix"></div>
        <label>Message</label><textarea name="msg" required><?=$_POST['msg']?></textarea>
        <input type="submit" class="btn_send button mtop pull-right" value="">
        <div class="clearfix"></div>
    </form>
</div>
</div>