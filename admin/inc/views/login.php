<form id="login" method="post">
    <input type="hidden" name="process" value="login">
    <label class="pull-left">Username</label>
    <input type="text" class="pull-right" name="user" value="<?
        if( $_COOKIE["zdmplp_username"] ) {
            echo $_COOKIE["zdmplp_username"];
        } elseif( $_POST['user']) {
            echo $_POST['user'];
        }
        ?>">
    <div class="clearfix"></div>
    <label class="pull-left">Password</label>
    <input type="password" class="pull-right" name="pwd">
    <div class="clearfix"></div>
    <input type="submit" class="button pull-right" name="submit" value="LOG IN">
    <div class="clearfix"></div>
    <a class="link_recover pull-right red">Forgot password?</a>
    <div class="clearfix"></div>
</form>
<div class="fclear"></div>