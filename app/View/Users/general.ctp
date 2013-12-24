<div class="widget widget-table">		
	<div class="widget-content">		
		<table class="table table-striped table-bordered table-highlight" id="example">
			<thead>
				<tr>
					<th>#</th>
					<th>Username</th>
					<th>Email Address</th>
					<?php if($this->Session->read('Auth.User.user_type') == 'General'){ ?>
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
					<?php if($this->Session->read('Auth.User.user_type') == 'General'){ ?>				
					<td>
						<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['_id']), array('class'=>'btn btn-info')); ?>
						<?php echo $this->Html->link(__('Change Password'), array('action' => 'change_password', $user['User']['_id']), array('class'=>'btn btn-primary')); ?>
						
						
					</td>
					<?php } ?>	
				</tr>		
				<?php
			}
				endforeach;
				?>
			</tbody>
		</table>

<!--		
<div class="paging">
</div>				
-->



		
		
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