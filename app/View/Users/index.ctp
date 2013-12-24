
<div class="widget widget-table">		
	<div class="widget-content">		
		<table class="table table-striped table-bordered table-highlight" id="example">
			<thead>
				<tr>
					<th>#</th>
					<th>Username</th>
					<th>Email Address</th>
					<th><?php echo __('User Type'); ?></th>
					<th><?php echo __('User Level'); ?></th>
    				<?php if($this->Session->read('Auth.User.user_type') == 'Super Admin' || $this->Session->read('Auth.User.user_type') == 'Admin'){ ?>
					<th><?php echo __('Actions'); ?></th>
					<?php } ?>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 0;
				foreach ($users as $user): {
					?>
					<tr class="<?php echo (($i++)%2) ? 'odd' : 'even' ?> gradeX">
						<td><?php echo $i; ?></td>	
						<td><?php echo $user['User']['username']; ?></td>			
						<td><?php echo $user['User']['email']; ?></td>					
						<td><?php echo $user['User']['user_type']; ?></td>
						<td><?php echo $user['User']['user_level']; ?></td>
						
				    	<?php if($this->Session->read('Auth.User.user_type') == 'Super Admin'){ ?>				
				    	<td>
							<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['_id']), array('class'=>'btn btn-info')); ?>
							<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['_id']), array('class'=>'btn btn-primary')); ?>
							<?php echo $this->Html->link(__('Level'), array('action' => 'level', $user['User']['_id']), array('class'=>'btn btn-success')); ?>
							<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['_id']), array('class'=>'btn btn-danger'), __('Are you sure you want to delete # %s?', $user['User']['_id'])); ?>
						</td>
				    	<?php } elseif($this->Session->read('Auth.User.user_type') == 'Admin'){ ?>				
				    	<td>
							<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['_id']), array('class'=>'btn btn-info')); ?>
							<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['_id']), array('class'=>'btn btn-primary')); ?>
							<?php echo $this->Html->link(__('Level'), array('action' => 'level', $user['User']['_id']), array('class'=>'btn btn-success')); ?>
							
						</td>
				    	<?php } ?>	
						
						
					</tr>		
					<?php
				}
				endforeach;
				?>
			</tbody>
		</table>
		
<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
	));
	?>	
</p>

<div class="paging">
	<?php echo $this->Paginator->prev('<< ' . __('previous'), array(), null, array('class'=>'disabled'));?> | 
	<?php echo $this->Paginator->numbers();?> |
	<?php echo $this->Paginator->next(__('next') . ' >>', array(), null, array('class' => 'disabled'));?>
</div>				

		
		
</div> <!-- /widget-content -->		
</div> <!-- /widget -->	

<?php $this->start('sidebar'); ?>
<div class="actions">
    <ul>
    	<?php if($this->Session->read('Auth.User.user_type') == 'Super Admin'){ ?>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add'), array('class'=>'btn btn-inverse')); ?></li>
		<?php } ?>
    </ul>
</div>
<?php $this->end(); ?>