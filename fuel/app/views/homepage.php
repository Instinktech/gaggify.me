<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Gaggify.me - Your Gags Portal!</title>
    <?php echo Asset::css('bootstrap.min.css'); ?>
    <?php echo Asset::css('bootstrap-responsive.min.css') ?>
    <?php echo Asset::css('style.css') ?>
    <?php echo Asset::js('jquery-1.9.1.min.js') ?>
    <?php echo Asset::js('bootstrap.min.js') ?>
    <?php //echo Asset::js('bootstrap-modal.js') ?>
    <?php echo Asset::js('gag.js') ?>
    <?php //echo Asset::js('jquery.hoverfold.js') ?>

</head>
<body class="home">
    <div id="header">
        <div class="navbar navbar-fixed-top ">
            <div class="navbar-inner-white">
                <div class="container">
                    <a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <a rel="homepage" title="PinStrap" href="http://bragthemes.com/demo/pinstrap/" class="brand">gaggify.me</a>


                    <div class="nav-collapse collapse">
                        <ul class="nav" id="menu-menu">
                            <li class="menu-item active" id="menu-item-128"><a href="http://bragthemes.com/demo/pinstrap/blog/">About</a></li>
                            <li class="menu-item" id="menu-item-131"><a href="http://bragthemes.com/demo/pinstrap/left-sidebar/">Contact</a></li>
                        </ul>			
              			<input type="button" value="Y u no gagger?" class="btn btn-danger pull-right" data-toggle="modal" data-target="#myModal" />
                        <form action="http://bragthemes.com/demo/pinstrap/" id="searchform" method="get" role="search" class="navbar-search pull-right">
                            <input type="text" placeholder="Search" class="search-query" id="s" name="s">
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <div id="container">

        <div id="main" role="main">
				<!--<div id="grid" class="main">
				<div class="view">
					<div class="view-back">
						<span data-icon="A">566</span>
						<span data-icon="B">124</span>
						<a href="http://www.flickr.com/photos/ag2r/5439506585/in/photostream">&rarr;</a>
					</div>
					<img src="images/1.jpg" /> </div>-->
				
                         <!-- Modal -->
			<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="login-form" style="margin:0 auto; width:500px; min-height:170px;">
				  <h2 style="min-height:60px;">Login</h2>
				  	  <button class="btn btn-info" type="submit">Login With Facebook</button>
				  	  <button class="btn btn-info" type="submit">Login With twitter</button>
				  	  <label></label><label></label>
					</form>
				</div>
			  </div>
			  
            <ul id="tiles">
                <!-- These is where we place content loaded from the Wookmark API -->
            </ul>

            <div id="loader">
                <div id="loaderCircle"></div>
            </div>

        </div>

    </div>
    <div id="footer">
        <div class="navbar navbar-fixed-bottom ">
            <div class="navbar-inner">
                <div class="container">

                </div>
            </div>
        </div>
    </div>


<?php echo Asset::js('jquery.wookmark.min.js') ?>
<!-- Once the page is loaded, initalize the plug-in. -->
<script type="text/javascript">
    var handler = null;
    var page = 1;
    var isLoading = false;
    var apiURL = 'http://www.wookmark.com/api/json/popular'

    // Prepare layout options.
    var options = {
        autoResize: true, // This will auto-update the layout when the browser window is resized.
        container: $('#tiles'), // Optional, used for some extra CSS styling
        offset: 2, // Optional, the distance between grid items
        itemWidth: 210 // Optional, the width of a grid item
    };

    /**
     * When scrolled all the way to the bottom, add more tiles.
     */
    function onScroll(event) {
        // Only check when we're not still waiting for data.
        if(!isLoading) {
            // Check if we're within 100 pixels of the bottom edge of the broser window.
            var closeToBottom = ($(window).scrollTop() + $(window).height() > $(document).height() - 100);
            if(closeToBottom) {
                loadData();
            }
        }
    };

    /**
     * Refreshes the layout.
     */
    function applyLayout() {
        // Create a new layout handler.
        handler = $('#tiles li');
        handler.wookmark(options);
    };

    /**
     * Loads data from the API.
     */
    function loadData() {
        isLoading = true;
        $('#loaderCircle').show();

        $.ajax({
            url: apiURL,
            dataType: 'jsonp',
            data: {page: page}, // Page parameter to make sure we load new data
            success: onLoadData
        });
    };

    /**
     * Receives data from the API, creates HTML for images and updates the layout
     */
    function onLoadData(data) {
        isLoading = false;
        $('#loaderCircle').hide();

        // Increment page index for future calls.
        page++;

        // Create HTML for the images.
        var html = '';
        var i=0, length=data.length, image;
        for(; i<length; i++) {
			image = data[i];
			$('#tiles').append(
				$('<li></li>').html(
					$('<a></a>').attr({
							'id': 'elem-'+i,
							 
						}).html(
						$('<img />').attr('src',image.preview).width(200).height(Math.round(image.height/image.width*200)).after(
							$('<p></p>').html(image.title)
						)
					)
				)
			);
        }

        // Add image HTML to the page.
        $('#tiles').append(html);

        // Apply layout.
        applyLayout();
    };

    $(document).ready(new function() {
        // Capture scroll event.
        $(document).bind('scroll', onScroll);

        // Load first data from the API.
        loadData();
    });
</script>
</body>
</html>
