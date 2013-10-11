<div class="groups form">
<?php echo $this->Form->create('Field'); ?>
	<fieldset>
		<legend><?php echo __('Edit Field'); ?></legend>
	<?php
		echo $this->Form->input('_id',array('type'=>'hidden'));
		echo $this->Form->input('field_name');
		echo $this->Form->input('field_type',array('options' => $types));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>


<?php $this->start('sidebar'); ?>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Entity._id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Entity._id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Entities'), array('action' => 'index')); ?></li>
	</ul>
</div>
<?php $this->end(); ?>