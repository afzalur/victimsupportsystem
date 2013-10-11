	
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
								//$i = 1;
								//foreach ($fields as $field) {
								//	echo $this->Form->input('existing field '.$i++,array('disabled'=>'disabled','value'=>$field));
								//}

								echo $this->Form->input('field_name');
								echo $this->Form->input('field_type',array('options' => $types));
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
						
						
							<table class="table table-striped table-bordered table-highlight" id="example">
			<thead>
				<tr>
					<th><?php echo __('Field Name'); ?></th>
					<th><?php echo __('Field Type'); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 0;
				foreach ($fields2 as $field2): ?>
					<tr>
						<td><?php echo $field2['Field']['field_name']; ?>&nbsp;</td>
						<td><?php echo $field2['Field']['field_type']; ?>&nbsp;</td>
						<td class="actions">
						<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $field2['Field']['_id']), array('class'=>'btn btn-primary')); ?>
							<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete',$field2['Field']['_id'],$field2['Field']['entity_id']), array('class'=>'btn btn-danger'), __('Are you sure you want to delete # %s?', $field2['Field']['_id'])); ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		
						
			</div>
		</div>
	</div>