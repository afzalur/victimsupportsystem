
<div class="widget widget-table">
	
	<div class="widget-header">						
		<h3>
			<i class="icon-th-list"></i>
			entities							
		</h3>
	</div> <!-- /widget-header -->
	
	<div class="widget-content">
								
		
		<table class="table table-striped table-bordered table-highlight" id="example">
			<thead>
				<tr>
					<?php	foreach ($fields as $key => $field) : ?>
					<th><?php echo $key; ?></th>
					<?php endforeach; ?> 
					<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 0;
				foreach ($data as $value): ?>
					<tr>
						<?php	foreach ($fields as $key => $field) : ?>
						<td>
							<?php 
							if(isset($value[$key]) && !empty($value[$key]) && $field != 'file' ) {
								echo $value[$key];
							}
							elseif (isset($value[$key]) && !empty($value[$key]) && $field == 'file' && $value[$key]['size'] ) {
								echo $this->Html->link(__($value[$key]['name']), '/uploads/'.$value[$key]['name'], array('class'=>'btn btn-info'));
							}
							else {
								echo '--';
							} 
							?>
						</td>
						<?php endforeach; ?> 
						<td class="actions">
							<?php echo $this->Html->link(__('Edit'), array('action' => 'editData',$id,$value['_id']), array('class'=>'btn btn-info')); ?>
							<?php //echo $this->Html->link(__('Delete'), array('controller'=>'fields','action' => 'add',$id,$value['_id']), array('class'=>'btn btn-info')); ?>
							<?php echo $this->Form->postLink(__('Delete'), array('action' => 'deleteData', $id, $value['_id']), array('class'=>'btn btn-danger'), __('Are you sure you want to delete # %s?', $value['_id'])); ?>
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
		<li><?php echo $this->Html->link(__('Add new entry '), array('action' => 'addData',$id), array('class'=>'btn btn-inverse')); ?></li>
    </ul>
</div>
<?php $this->end() ?>
