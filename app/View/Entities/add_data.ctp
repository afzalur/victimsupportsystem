	
	<div class="span8">
  		
  		<div id="horizontal" class="widget widget-form">
  			
  			<div class="widget-header">	      				
  				<h3>
  					<i class="icon-pencil"></i>
  					User Entry	      					
					</h3>	
			</div> <!-- /widget-header -->
			
			<div class="widget-content">				
						<?php   echo $this->Form->create('Entity',array('type' => 'file', 'class'=>'form-horizontal')); ?>
						<?php   $this->Form->victimDefaults(); ?>
							<fieldset>
							<?php
							foreach ($fields as $key => $value) {
								$setting = null;
								switch ($value) {
									case 'number':
										$setting = array(
											'type'=>'number'
											);
										break;

									case 'date':
										$setting = array(
											'type'=>'date',
											'class' => 'span2 input-small'
											);
										break;

									case 'file':
										$setting = array(
											'type'=>'file',
											);
										break;
									
									default:
										$setting = array(
											'type'=>'text'
											);
										break;
								}
								echo $this->Form->input($key, $setting);
							}
							?>
							</fieldset>
							<fieldset>
								<div class="control-group">
				                    <div class="controls">
				                        <?php   echo $this->Form->button('Add to '.$entity,array('class'=>'btn btn-success input-xlarge')); ?>
				                    </div>
				                </div>
							</fieldset>
						<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>