<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Gaggify.me - Your Gags Portal!</title>
    <?php echo Asset::css('bootstrap.css'); ?>
    <?php echo Asset::css('bootstrap-responsive.min.css') ?>
    <?php echo Asset::css('style.css') ?>
    <?php echo Asset::js('jquery-1.9.1.min.js') ?>
    <?php echo Asset::js('bootstrap.min.js') ?>
    <?php //echo Asset::js('bootstrap-modal.js') ?>
    <?php echo Asset::js('gag.js') ?>

</head>
<body class="home">
    <?php echo $header ?>
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

    <?php echo $footer ?>


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
							'id': 'elem-'+i
							 
						}).html(
						$('<img />').attr('src',image.preview).width(200).height(Math.round(image.height/image.width*200)).after(
							$('<p></p>').html(image.title)
                                                    ).addClass('cover')
					).addClass('gag-item').attr({
                                                'data-content': "And here's some amazing content. It's very engaging. right?",
                                                'title': 'Zardari Rocks!',
                                                'data-toggle': 'popover',
                                                'href': '#',
                                                'data-original': "A Title",
                                                'rel': "poppver"
                                        })
                                 )
			);
        }

        // Add image HTML to the page.
        $('#tiles').append(html);
$('.gag-item').popover();
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
