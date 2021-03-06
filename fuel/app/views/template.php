<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
    <?php echo Asset::css('bootstrap.css'); ?>
    <?php echo Asset::css('bootstrap-responsive.min.css') ?>
    <?php echo Asset::css('style.css') ?>
    <?php echo Asset::js('jquery-1.9.1.min.js') ?>
    <?php echo Asset::js('bootstrap.min.js') ?>
    <?php echo Asset::js('holder.js') ?>
    <?php echo Asset::js('gag.js') ?>
</head>
<body>
<?php echo $header ?>
	<div id="main">
        <div class="container">
            <div class="row">
                <div class="span16">
                    <?php if (Session::get_flash('success')): ?>
                        <div class="alert-message success">
                            <p>
                                <?php echo implode('</p><p>', e((array) Session::get_flash('success'))); ?>
                            </p>
                        </div>
                    <?php endif; ?>
                    <?php if (Session::get_flash('error')): ?>
                        <div class="alert-message error">
                            <p>
                                <?php echo implode('</p><p>', e((array) Session::get_flash('error'))); ?>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="span16">
                    <?php echo $content; ?>
                </div>
            </div>
            <!--
		<footer>
			<p class="pull-right">Page rendered in {exec_time}s using {mem_usage}mb of memory.</p>
			<p>
				<a href="http://fuelphp.com">FuelPHP</a> is released under the MIT license.<br>
				<small>Version: <?php echo e(Fuel::VERSION); ?></small>
			</p>
		</footer>
		-->
            <?php echo $footer ?>
        </div>
	</div>
</body>
</html>
