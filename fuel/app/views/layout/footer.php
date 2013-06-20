<div id="footer">
    <div class="navbar navbar-fixed-bottom navbar-inverse">
        <div class="navbar-inner">
            <div class="container">
                <div class="span12">
                    <div class="span7">
                        <div>
                            <a href="#"><img class="social-icon" src="/assets/img/social/followus_facebook.png" /></a>
                            <a href="#"><img class="social-icon" src="/assets/img/social/followus_twitter.png" /></a>
                        </div>
                    </div>

                    <?php
                        $isLogin = \Fuel\Core\Session::instance()->get('me',null) == null ? false : true;
                    ?>
                    <div class="span4 x-welcome">
                        <?php if ($isLogin): ?>
                        <ul class="nav nav-pills pull-right">
                            <li><a href="/me">Dashboard</a></li>
                            <li class="active">
                                <a href="/me/stickies">My Stickies</a>
                            </li>
                            <li><a href="/gag/create">Upload</a></li>
                        </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>