<body id="top">
<div class="wrapper">
<nav class="navbar navbar-default navbar-fixed-top yamm">
    <div class="container">
		<?
        if( $_SESSION['client_id'] ) {
            ?><div class="obit-links_link icon-logout link_logout">Log Out</div><?
        } elseif( $page == 'obituaries' ) {
			?><div class="obit-links_link icon-logout link_client-login">Log In</div><?
		}
        ?>
        <div class="clearfix"></div>
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll yamm">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand page-scroll" href="/"><img src="img/Pet-Memories-Logo.png" alt="Pet Memories Cremation Services"/></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav pull-right">
                  <!-- Media Example -->
                <li class="hidden"><a href="#page-top"></a></li>
                <li><a href="/#ourservices">SERVICES</a></li>
                <li><a href="/#urns">URNS</a></li>
                <li><a href="/obituaries/">OBITUARIES</a></li>
                <li><a href="/#testimonials">TESTIMONIALS</a></li>
                <li><a href="/#contactus">CONTACT</a></li>
                </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>