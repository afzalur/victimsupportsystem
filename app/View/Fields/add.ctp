	
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
								echo $this->Form->input('entity_id',array('type'=>'hidden','value'=>$entity['Entity']['_id']));
								echo $this->Form->input('entity_name',array('readonly'=>'readonly','value'=>$entity['Entity']['entity_name']));
								$i = 1;
								foreach ($fields as $field) {
									echo $this->Form->input('existing field '.$i++,array('disabled'=>'disabled','value'=>$field));
								}

								echo $this->Form->input('field_name');
							?>
							</fieldset>
							<fieldset>
								<div class="control-group">
				                    <div class="controls">
				                        <?php   echo $this->Form->button('Add Field',array('class'=>'btn btn-success input-xlarge')); ?>
				                    </div>
				                </div>
							</fieldset>
						<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>