<div class="widget widget-table">	
	<div class="widget-header">						
		<h3>
			<i class="icon-th-list"></i>
			entities							
		</h3>
	</div> <!-- /widget-header -->
	
	<div class="widget-content">
    <div class="entities index">

<?php // echo $user_level; ?>	
	
		<table class="table table-striped table-bordered table-highlight" id="example">
			<thead>
				<tr>
					<th><?php echo __('name'); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 0;
				
				foreach ($entities as $entity): ?>
					<tr>
						<td><?php echo h($entity['Entity']['entity_name']); ?>&nbsp;</td>
						<td class="actions">

<?php if($user_level == '4'){						
echo $this->Html->link(__('View Entries'), array('controller'=>'entities','action' => 'viewData', $entity['Entity']['_id']), array('class'=>'btn btn-info')); ?>
<?php echo $this->Html->link(__('Add Entry'), array('action' => 'addData', $entity['Entity']['_id']), array('class'=>'btn btn-success')); ?>
<?php echo $this->Html->link(__('Add Field'), array('controller'=>'fields','action' => 'add', $entity['Entity']['_id']), array('class'=>'btn btn-warning'));
 ?>
<?php echo $this->Html->link(__('Excel Export'), array('controller'=>'entities','action' => 'viewExcel', $entity['Entity']['_id']), array('class'=>'btn btn-info')); ?>
<?php echo $this->Html->link(__('Import Excel'), array('controller'=>'entities','action' => 'import_excel', $entity['Entity']['_id']), array('class'=>'btn btn-warning')); ?>
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $entity['Entity']['_id']), array('class'=>'btn btn-danger'), __('Are you sure you want to delete # %s?', $entity['Entity']['_id'])); 
}elseif($user_level == '3'){						
echo $this->Html->link(__('View Entries'), array('controller'=>'entities','action' => 'viewData', $entity['Entity']['_id']), array('class'=>'btn btn-info')); ?>
<?php echo $this->Html->link(__('Add Entry'), array('action' => 'addData', $entity['Entity']['_id']), array('class'=>'btn btn-success')); ?>
<?php echo $this->Html->link(__('Add Field'), array('controller'=>'fields','action' => 'add', $entity['Entity']['_id']), array('class'=>'btn btn-warning'));
}elseif($user_level == '2'){						
echo $this->Html->link(__('View Entries'), array('controller'=>'entities','action' => 'viewData', $entity['Entity']['_id']), array('class'=>'btn btn-info')); 
}elseif($user_level == '1'){				
echo $this->Html->link(__('View Entries'), array('controller'=>'entities','action' => 'viewData', $entity['Entity']['_id']), array('class'=>'btn btn-info'));
} ?>

<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $entity['Entity']['_id']), array('class'=>'btn btn-danger'), __('Are you sure you want to delete # %s?', $entity['Entity']['_id'])); ?>

						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		
			<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous'), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next') . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>		
	</div>	
	</div> <!-- /widget-content -->		
</div> <!-- /widget -->	
		    
<?php $this->start('sidebar'); ?>
<div class="actions">
    <ul>
		<li><?php echo $this->Html->link(__('New entity'), array('action' => 'add'), array('class'=>'btn btn-inverse')); ?></li>
    </ul>
</div>
<?php $this->end() ?>