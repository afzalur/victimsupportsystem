	
	<div class="span8">
  		
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
								echo $this->Form->input('group_id');
								echo $this->Form->input('email');
								echo $this->Form->input('password');
							?>
							</fieldset>
							<fieldset>
								<div class="control-group">
				                    <div class="controls">
				                        <?php   echo $this->Form->button('Create User',array('class'=>'btn btn-success input-xlarge')); ?>
				                    </div>
				                </div>
							</fieldset>
						<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>