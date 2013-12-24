
<div class="widget widget-table">
	
	<div class="widget-header">						
		<h3>
			<i class="icon-th-list"></i>
			Groups							
		</h3>
	</div> <!-- /widget-header -->
	
	<div class="widget-content">
								
		
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
				foreach ($groups as $group): ?>
					<tr>
						<td><?php echo h($group['Group']['name']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link(__('View'), array('action' => 'view', $group['Group']['_id']), array('class'=>'btn btn-info')); ?>
							<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $group['Group']['_id']), array('class'=>'btn btn-primary')); ?>
							<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $group['Group']['_id']), array('class'=>'btn btn-danger'), __('Are you sure you want to delete # %s?', $group['Group']['_id'])); ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		
		
	</div> <!-- /widget-content -->
		
</div> <!-- /widget -->	

		    



<?php $this->start('sidebar'); ?>
<div class="actions">
    <ul>
		<li><?php echo $this->Html->link(__('New Group'), array('action' => 'add'), array('class'=>'btn btn-inverse')); ?></li>
    </ul>
</div>
<?php $this->end() ?>
