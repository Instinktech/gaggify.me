<?php
$isLogin = \Fuel\Core\Session::instance()->get('me',null) == null ? false : true;
?>
<div id="header">
    <div class="navbar navbar-fixed-top ">
        <div class="navbar-inner">
            <div class="container">
                <a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <a rel="homepage" title="PinStrap" href="/" class="brand" id="x-logo">gaggify.me</a>

                <div class="nav-collapse collapse">
                    <ul class="nav" id="menu-menu">
                        <li class="menu-item active" id="menu-item-128"><a href="/about">Le, About</a></li>
                        <li class="menu-item" id="menu-item-131"><a href="/contact">Le, Contact</a></li>
                    </ul>
                    <a href="#" class="pull-right social-icon"><img src="/assets/img/social/facebook.png" /></a>
                    <a href="#" class="pull-right social-icon"><img src="/assets/img/social/twitter.png" /></a>
                    <a href="#" class="pull-right social-icon"><img src="/assets/img/social/gplus.png" /></a>
                    <a href="#" class="pull-right social-icon"><img src="/assets/img/social/linkedin.png" /></a>
                    <?php
                    if ( !$isLogin): ?>
                        <a data-content="Click me to be a come in by logging in!" data-toggle="popover" data-placement="bottom" rel="popover" href="#login" role="button" data-toggle="modal" class="btn btn-danger pull-right">Y u no gagger?</a>
                    <?php else: ?>
                        <a data-content="I'll take you out of the system!" data-toggle="popover" data-title="Logout" rel="popover" data-placement="bottom" href="/me/logout" role="button" class="btn btn-danger pull-right gag-item">Y u still gagger?</a>
                    <?php endif; ?>

                    <form action="http://bragthemes.com/demo/pinstrap/" id="searchform" method="get" role="search" class="navbar-search pull-right">
                        <input type="text" placeholder="Search" class="search-query" id="s" name="s">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="login" class="modal hide fade fb-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-body">
        <div class="centralize">
            <a href="/me/login?via=facebook"><img src="/assets/img/gagger.png" /></a>
        </div>
    </div>
</div>