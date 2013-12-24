
    <script src="<?php echo $this->base;?>/js/smartpaginator.js" type="text/javascript"></script>
    <link href="<?php echo $this->base;?>/css/smartpaginator.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
        $(document).ready(function () {
            $('#green').smartpaginator({ totalrecords: <?php echo $cnt;?>, recordsperpage: 20, datacontainer: 'mt', dataelement: 'tr', initval: 0, next: 'Next', prev: 'Prev', first: 'First', last: 'Last', theme: 'green' });
	});
   </script>
      <style type="text/css">
        body
        {
            padding: 20px;
        }
		.widget-content
		{
		 width:700px;
		}
        #wrapper
        {
            margin: auto;
            width: 800px;
        }
        .contents
        {
            width: 91%; /*height: 150px;*/
            margin: 0;
        }
        .contents > p
        {
            padding: 8px;
        }
        .table
        {
            width: 100%;
            border-right: solid 1px #000;
        }
        .table th, .table td
        {
            width: 16%;
            height: 20px;
            padding: 4px;
            text-align: left;
        }
        .table th
        {
            border-left: solid 1px #000;
        }
        .table td
        {
            border-left: solid 1px #000;
            border-bottom: solid 1px #DDD;
        }
        .header
        {
            background-color: #000;
            color: White;
        }
        #divs
        {
            margin: 0;
            height: 200px;
            font: verdana;
            font-size: 14px;
            background-color: White;
        }
        #divs > div
        {
            width: 98%;
            padding: 8px;
        }
        #divs > div p
        {
            width: 95%;
            padding: 8px;
        }
        ul.tab
        {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        ul.tab li
        {
            display: inline;
            padding: 10px;
            color: White;
            cursor: pointer;
        }
        #container
        {
            width: 100%;
            border: solid 1px red;
        }
    </style>
   
<div class="widget widget-table">
	
	<div class="widget-header">						
		<h3>
			<i class="icon-th-list"></i>
			entities							
		</h3>
	</div> <!-- /widget-header -->
	
	 <div class="widget-content">
								
		  <table id="mt" cellpadding="0" cellspacing="0" border="0" class="table">
			<thead>
				  <tr class="header">
					<?php	foreach ($fields as $key => $field) : ?>
					<th><?php echo $key; ?></th>
					<?php endforeach; ?> 
					<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 1;
				
				//print_r();
				//echo $numUsers = sizeof($data );
				$k=0;
				foreach ($data as $value): ?>
					<tr>
						<?php	foreach ($fields as $key => $field) : ?>
						<td>
							<?php //echo $i=$i++.'.';
							if(isset($value[$key]) && !empty($value[$key]) && $field != 'file' ) {
								echo $value[$key];
								
							}
							elseif (isset($value[$key]) && !empty($value[$key]) && $field == 'file' && $value[$key]['size'] ) {
								echo $this->Html->link(__($value[$key]['name']), '/uploads/'.$value[$key]['name'], array('class'=>'btn btn-info'));
							}
							else {
								echo '--';
							} 
							
							$k=$k+1;
							?>
						</td>
						<?php endforeach; ?> 
						<td class="actions" nowrap="nowrap">
							<?php echo $this->Html->link(__('Edit'), array('action' => 'editData',$id,$value['_id']), array('class'=>'btn btn-info')); ?>
							<?php //echo $this->Html->link(__('Delete'), array('controller'=>'fields','action' => 'add',$id,$value['_id']), array('class'=>'btn btn-info')); ?>
							<?php echo $this->Form->postLink(__('Delete'), array('action' => 'deleteData', $id, $value['_id']), array('class'=>'btn btn-danger'), __('Are you sure you want to delete # %s?', $value['_id'])); ?>
						</td>
					</tr>
				<?php endforeach; // echo $k;?>
			</tbody>
		</table>
		 <div id="green" style="padding-bottom:10px; margin: auto;">
         </div>
		
	</div> <!-- /widget-content -->
		
</div> <!-- /widget -->	

		    



<?php //$this->start('sidebar'); ?>
<!--
<div class="actions">
    <ul>
		<li><?php echo $this->Html->link(__('Add new entry '), array('action' => 'addData',$id), array('class'=>'btn btn-inverse')); ?></li>
    </ul>
</div>-->
<?php //$this->end() ?>
