<div id="horizontal" class="widget widget-form">
		
		<div class="widget-header">	      				
			<h3>
				<i class="icon-pencil"></i>
				User Entry	      					
			</h3>	
	</div> <!-- /widget-header -->
	
	<div class="widget-content">
		
				<?php   echo $this->Form->create('User',array('class'=>'form-horizontal')); ?>
				<?php   $this->Form->victimDefaults(); ?>
				<?php
				//$this->Form->inputDefaults(array('error'=>array('attributes'=>array('class'=>'system negative'))));
				?>
					<fieldset>
					<?php
		                echo $this->Form->input('_id');
		                echo $this->Form->input('username',array('readonly'=>'readonly'));
		                echo $this->Form->input('email',array('readonly'=>'readonly'));
		                echo $this->Form->input('password',array('value'=>''));
		                echo $this->Form->input('retype_password',array('type'=>'password', 'value'=>''));
			        ?>
					</fieldset>
					<fieldset>
						<div class="control-group">
		                    <div class="controls">
		                        <?php   echo $this->Form->button('Change Password',array('class'=>'btn btn-success input-xlarge')); ?>
		                    </div>
		                </div>
					</fieldset>
				<?php echo $this->Form->end(); ?>
	</div>
</div>







<?php $this->start('sidebar'); ?>
<div class="actions">
    <ul>
    	<?php if($this->Session->read('Auth.User.user_type') == 'Super Admin'){ ?>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add'), array('class'=>'btn btn-inverse')); ?></li>
		<?php } ?>
    </ul>
</div>
<?php $this->end(); ?>