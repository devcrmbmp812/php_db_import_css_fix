<form id="login" method="post">
    <input type="hidden" name="process" value="login">
    <label class="pull-left">Name</label>
    <input type="text" class="pull-right" name="name" value="<?=$_POST['name']?>" required>
    <div class="clearfix"></div>
    <label class="pull-left">Email</label>
    <input type="email" class="pull-right" name="email" value="<?=$_POST['email']?>" required>
    <div class="clearfix"></div>
    <label class="pull-left">Confirm Email</label>
    <input type="email" class="pull-right" name="conf_email" value="<?=$_POST['conf_email']?>" required>
    <div class="clearfix"></div>
    <input type="submit" class="button pull-right" name="submit" value="REQUEST PASSWORD">
    <div class="clearfix"></div>
    <a class="link_login pull-right red">Return to login</a>
    <div class="clearfix"></div>
</form>
<div class="fclear"></div>