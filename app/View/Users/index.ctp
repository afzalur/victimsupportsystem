<?php
/*********************************************************************
 * Copyright (C) 2013 TerraTech Limited (www.terratech.com.bd)
 *
 * This file is part of victimDb project.
 *
 * victimDb can not be copied and/or distributed without the express
 * permission of TerraTech Limited
**********************************************************************/
?>
		    <div class="span6">
	      		
	      		<div class="widget widget-table">
						
					<div class="widget-content">					
						
						
						<table class="table table-striped table-bordered table-highlight" id="example">
							<thead>
								<tr>
									<th>#</th>
									<th>Username</th>
									<th>Email Address</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 0;
								foreach ($users as $value) {
									?>
									<tr class="<?php echo (($i++)%2) ? 'odd' : 'even' ?> gradeX">
										<td><?php echo $i; ?></td>	
										<td><?php echo $value['User']['username']; ?></td>			
										<td><?php echo $value['User']['email']; ?></td>								
									</tr>		
									<?php
								}
								?>
							</tbody>
						</table>
						
						
					</div> <!-- /widget-content -->
						
				</div> <!-- /widget -->	
				
		    </div> <!-- /span12 -->
		    
		    