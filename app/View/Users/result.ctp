<?php
	if($search_result){
?>
	
<div class="widget widget-table">		

	<div class="widget-header">						
		<h3>
			<i class="icon-th-list"></i>
			Users							
		</h3>
	</div> <!-- /widget-header -->

	<div class="widget-content">		
		<table class="table table-striped table-bordered table-highlight" id="example">
			<thead>
				<tr>
					<th>#</th>
					<th>Username</th>
					<th>Email Address</th>
					<th><?php echo __('User Type'); ?></th>
				</tr>
			</thead>
			<tbody>
<?php			
	$i = 0;
		foreach ($search_result as $user): {
?>
		<tr class="<?php echo (($i++)%2) ? 'odd' : 'even' ?> gradeX">
			<td><?php echo $i; ?></td>	
			<td><?php echo $user['User']['username']; ?></td>			
			<td><?php echo $user['User']['email']; ?></td>					
			<td><?php echo $user['User']['user_type']; ?></td>				   
		</tr>		
<?php
				}
				endforeach;
?>				
		</tbody>
		</table>
	
<?php
	}
	else	{
		echo "No user found!";
	}
?>




<br><br><br>


<?php
	if($search_entity){
?>

<div class="widget widget-table">
	
	<div class="widget-header">						
		<h3>
			<i class="icon-th-list"></i>
			Entities							
		</h3>
	</div> <!-- /widget-header -->
	
	<div class="widget-content">
								
		
		<table class="table table-striped table-bordered table-highlight" id="example">
			<thead>
				<tr>
					<th><?php echo __(' Entities Name'); ?></th>

				</tr>
			</thead>
			<tbody>
				<?php
				$i = 0;
				foreach ($search_entity as $entity): ?>
					<tr>
						<td><?php echo h($entity['Entity']['entity_name']); ?>&nbsp;</td>

					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>		
		
	</div> <!-- /widget-content -->
		
</div> <!-- /widget -->	

<?php
	}
	else	{
		echo "No entity found!";
	}
?>


