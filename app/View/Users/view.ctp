<div class="widget widget-table">
		
	<div class="widget-content">					
		
		
		<table class="table table-striped table-bordered table-highlight" id="example">
			<tbody>
					<tr>
						<td><?php echo __('ID'); ?>
						<td><?php echo $user['User']['_id']; ?></td>	
					</tr>	
					<tr>
						<td><?php echo __('Username'); ?></td>
						<td>
							<?php echo h($user['User']['username']); ?>
							&nbsp;
						</td>
					</tr>
					<tr>
						<td><?php echo __('email'); ?></td>
						<td>
							<?php echo h($user['User']['email']); ?>
							&nbsp;
						</td>
					</tr>
					<tr>
						<td><?php echo __('Created'); ?></td>
						<td>
							<?php echo ($user['User']['created']); ?>
							&nbsp;
						</td>
					</tr>
			</tbody>
		</table>
		
		
	</div> <!-- /widget-content -->
		
</div> <!-- /widget -->	



<?php $this->start('sidebar'); ?>


<?php if($this->Session->read('Auth.User.user_type') == 'Super Admin'){?>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>	
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Chgange Password'), array('action' => 'change_password', $user['User']['_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['_id']), null, __('Are you sure you want to delete # %s?', $user['User']['_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'atd')); ?> </li>
	</ul>	
</div>

<?php }elseif($this->Session->read('Auth.User.user_type') == 'Admin'){?>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>	
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Chgange Password'), array('action' => 'change_password', $user['User']['_id'])); ?> </li>		
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'atd')); ?> </li>
	</ul>	
</div>

<?php }else{} ?>



<?php $this->end(); ?>