	
	<div class="span8">
  		
  		<div id="horizontal" class="widget widget-form">
  			
  			<div class="widget-header">	      				
  				<h3>
  					<i class="icon-pencil"></i>
  					User Entry	      					
					</h3>	
			</div> <!-- /widget-header -->
			
			<div class="widget-content">
				
						<?php   echo $this->Form->create('Field',array('class'=>'form-horizontal')); ?>
						<?php   $this->Form->victimDefaults(); ?>
						<?php
						//$this->Form->inputDefaults(array('error'=>array('attributes'=>array('class'=>'system negative'))));
						?>
							<fieldset>
							<?php
								echo $this->Form->input('entity_id');
							?>
							</fieldset>
							<fieldset>
								<div class="control-group">
				                    <div class="controls">
				                        <?php   echo $this->Form->button('Go',array('class'=>'btn btn-success input-xlarge')); ?>
				                    </div>
				                </div>
							</fieldset>
						<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>