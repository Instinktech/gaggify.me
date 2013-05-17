<h2>Listing Gags</h2>
<br>
<?php if ($gags): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($gags as $gag): ?>		<tr>

			<td><?php echo $gag->name; ?></td>
			<td>
				<?php echo Html::anchor('gag/view/'.$gag->id, 'View'); ?> |
				<?php echo Html::anchor('gag/edit/'.$gag->id, 'Edit'); ?> |
				<?php echo Html::anchor('gag/delete/'.$gag->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Gags.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('gag/create', 'Add new Gag', array('class' => 'btn btn-success')); ?>

</p>
