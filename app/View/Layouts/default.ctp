<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>

    <?php
    echo $this->Html->css(
    	array(
    		'bootstrap',
    		'bootstrap-responsive',
    		'bootstrap-overrides',
    		'ui-lightness/jquery-ui-1.8.21.custom',
    		'slate',
    		'components/signin',
    		'slate-responsive',
    		'custom-style',
    		)
    	);
	//JS files
    echo $this->Html->script(
    	array(
    		'jquery-1.7.2.min',
    		'jquery-ui-1.8.18.custom.min',
    		'jquery.ui.touch-punch.min',
    		//'demos/signin',
    		'bootstrap',
    		//'plugins/datatables/jquery.dataTables',
    		//'plugins/datatables/DT_bootstrap',
    		//'plugins/responsive-tables/responsive-tables',
    		'Slate',
    		//'demos/demo.tables',
    		));
?>


<?php
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');

?>
<script src="//connect.facebook.net/en_US/all.js"></script>
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>

<div id="header">
	
	<div class="container">			
		
		<h1><a href="./">Savar Victims Database</a></h1>			
		
		<div id="info">				
			
			<a href="javascript:;" id="info-trigger">
				<i class="icon-cog"></i>
			</a>
			
			<div id="info-menu">
				
				<div class="info-details">
				
					
					
					<p>
						Welcome back, <?php echo $this->Session->read('Auth.User.username'); ?>
						<br><?php echo $this->Html->link('Logout',array('controller' => 'users' , 'action' => 'revoke')); ?>
					</p>
					
				</div> <!-- /.info-details -->
				
				<div class="info-avatar">
					
					<img src="<?php echo $this->base;?>/img/avatar.jpg" alt="avatar">
					
				</div> <!-- /.info-avatar -->				
			</div> <!-- /#info-menu -->			
		</div> <!-- /#info -->		
	</div> <!-- /.container -->
</div> <!-- /#header -->

<div id="nav">		
	<div class="container">		
		<a href="javascript:;" class="btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        	<i class="icon-reorder"></i>
      	</a>
		
		<div class="nav-collapse">
			
			<ul class="nav">
		
				<li class="nav-icon">
					<a href="./">
						<i class="icon-home"></i>
						<span>Home</span>
					</a>	    				
				</li>
				
				<li class="dropdown active">					
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-th"></i>
						User Management
						<b class="caret"></b>
					</a>	
				<?php if($this->Session->read('Auth.User.user_type')=='Super Admin'){?>
					<ul class="dropdown-menu">
						<li><?php echo $this->Html->link('Super Admin', array('controller' => 'users', 'action' => 'index', 'Super Admin')); ?></li>
						<li><?php echo $this->Html->link('Admin', array('controller' => 'users', 'action' => 'index', 'Admin')); ?></li>
						<li><?php echo $this->Html->link('Users', array('controller' => 'users', 'action' => 'index')); ?></li>					  
					</ul> 
				<?php } elseif($this->Session->read('Auth.User.user_type')=='Admin'){?>
					<ul class="dropdown-menu">						
						<li><?php echo $this->Html->link('Admin', array('controller' => 'users', 'action' => 'index', 'Admin')); ?></li>
						<li><?php echo $this->Html->link('Users', array('controller' => 'users', 'action' => 'index')); ?></li>					  
					</ul> 
				<?php }	else{?>
					<ul class="dropdown-menu">												
						<li><?php echo $this->Html->link('Users', array('controller' => 'users', 'action' => 'general')); ?></li>					  
					</ul> 
				<?php } ?>
				
				</li>
				
				<li class="dropdown">					
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-copy"></i>
						Entity Data Management
						<b class="caret"></b>
					</a>					
					
					<ul class="dropdown-menu">
						<li><?php echo $this->Html->link('Create Entity', array('controller' => 'entities', 'action' => 'add')); ?></li>
						<li><?php echo $this->Html->link('Entity List', array('controller' => 'entities', 'action' => 'index')); ?></li>
						<li><?php echo $this->Html->link('Add Field to an Entity', array('controller' => 'fields', 'action' => 'selectEntity')); ?></li>
					</ul> 
				</li>
				<!--
				<li class="dropdown">					
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-copy"></i>
						Login Management
						<b class="caret"></b>
					</a>	
				
					<ul class="dropdown-menu">
						<li><a href="">Name</a></li>
						<li><a href="">Description</a></li>
						<li><a href="">Help Desk</a></li>
					</ul>    				
				</li>
				
				<li class="dropdown">					
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-external-link"></i>
						Configuration 
						<b class="caret"></b>
					</a>										
				</li>	
				-->			
			</ul>			
			
			<ul class="nav pull-right">
		
				<li class="">
					<?php echo $this->Form->create('User',array('controller'=>'users','action' => 'result'));
					?>
						<!--<input type="text" class="search-query" id="UserUsername" placeholder="Search" name="data[User][username]">
						<!--<button class="search-btn"><i class="icon-search"></i></button>-->
						<?php   echo $this->Form->input('username',array('label'=>'','class'=>'search-query','style'=>'margin-right:50px; width:150px'));
								echo "<span style='float:right; margin-top:-35px'>";
	                            echo $this->Form->end('Go',array('style'=>'float:right; margin-top:-35px'));		
								echo "</span>";
						?>		
				</li>				
			</ul>			
		</div> <!-- /.nav-collapse -->		
	</div> <!-- /.container -->	
</div> <!-- /#nav -->

<div id="content">		
	<div class="container">
		<!--
		<div id="page-title" class="clearfix">
			
			<ul class="breadcrumb">
			  <li>
			   <?php echo $this->Html->getCrumbs(' > ', 'Home');?>
			  </li>
			
			</ul>
			
		</div> --><!-- /.page-title -->		
		
		<div class="row">
		
			<div class="span8">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
			</div>
            <div class="span4">
	      		<div class="widget hightlight">					
					<div class="widget-content">
                		<?php echo $this->fetch('sidebar'); ?>
            		</div>
        		</div>
            </div>
		    
		</div>  <!-- /.row -->  
	</div> <!-- /.container -->	
</div> <!-- /#content -->

<div id="footer">			
	<div class="container">&copy; 2013 Victim Management, All rights reserved.		
	</div> <!-- /.container -->			
</div> <!-- /#footer -->

</body>
	<?php //echo $this->element('sql_dump'); ?>
</html>