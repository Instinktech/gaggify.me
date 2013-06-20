<h2>Viewing #<?php echo $gag->id; ?></h2>

<p>
	<strong>Name:</strong>
	<?php echo $gag->title; ?></p>

<?php echo Html::anchor('gag/edit/'.$gag->id, 'Edit'); ?> |
<?php echo Html::anchor('gag', 'Back'); ?>