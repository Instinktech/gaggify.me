<h2>Editing Gag</h2>
<br>

<?php echo render('gag/_form'); ?>
<p>
	<?php echo Html::anchor('gag/view/'.$gag->id, 'View'); ?> |
	<?php echo Html::anchor('gag', 'Back'); ?></p>
