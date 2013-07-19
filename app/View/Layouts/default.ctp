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
					
					<img src="./img/avatar.jpg" alt="avatar">
					
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
				
					<ul class="dropdown-menu">
						<li><?php echo $this->Html->link('Super Admin', array('controller' => 'users', 'action' => 'index', 'Super Admin')); ?></li>
						<li><?php echo $this->Html->link('Admin', array('controller' => 'users', 'action' => 'index', 'Admin')); ?></li>
						</ul>    				
				</li>
				
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
						<i class="icon-copy"></i>
						Entity Data Management
						<b class="caret"></b>
					</a>					
					
				</li>
				
				<li class="dropdown">					
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-external-link"></i>
						Configuration 
						<b class="caret"></b>
					</a>										
				</li>	
			
			</ul>
			
			
			<ul class="nav pull-right">
		
				<li class="">
					<form class="navbar-search pull-left">
						<input type="text" class="search-query" placeholder="Search">
						<button class="search-btn"><i class="icon-search"></i></button>
					</form>	    				
				</li>
				
			</ul>
			
		</div> <!-- /.nav-collapse -->
		
	</div> <!-- /.container -->
	
</div> <!-- /#nav -->


<div id="content">
		
	<div class="container">
		
		<div id="page-title" class="clearfix">
			
			<ul class="breadcrumb">
			  <li>
			    <a href="/">Home</a> <span class="divider">/</span>
			  </li>
			  <li>
			    <a href="#">Components</a> <span class="divider">/</span>
			  </li>
			  <li class="active">Table Styles</li>
			</ul>
			
		</div> <!-- /.page-title -->
	
		
		
		<div class="row">
			
			
		    <div class="span12">
				<?php echo $this->Session->flash(); ?>
		    </div>

			<?php echo $this->fetch('content'); ?>
		    
		    <div class="span6">
	      		
	      		<div class="widget widget-table">
					
					<div class="widget-content">
						
						<table class="table table-bordered table-striped">
					        <thead>
					          <tr>
					            <th>#</th>
					            <th>First Name</th>
					            <th>Last Name</th>
					            <th>Username</th>
					          </tr>
					        </thead>
					        <tbody>
					          <tr>
					            <td>1</td>
					            <td>Michael</td>
					            <td>Jordan</td>
					            <td>@mjordan</td>
					          </tr>
					          <tr>
					            <td>2</td>
					            <td>Magic</td>
					            <td>Johnson</td>
					            <td>@mjohnson</td>
					          </tr>
					          <tr>
					            <td>3</td>
					            <td>Larry</td>
					            <td>the Bird</td>
					            <td>@twitter</td>
					          </tr>
					          <tr>
					            <td>4</td>
					            <td>Charles</td>
					            <td>Barkley</td>
					            <td>@cbark</td>
					          </tr>
					          <tr>
					            <td>5</td>
					            <td>Karl</td>
					            <td>Malone</td>
					            <td>@kmalone</td>
					          </tr>
					        </tbody>
					      </table>
						
						
					</div> <!-- /widget-content -->
						
				</div> <!-- /widget -->	
						
						
				
		    </div> <!-- /span6 -->
		    
		    
		    
		    <div class="span6">
	      		
	      		<div class="widget widget-table">
					
					<div class="widget-content">
						
						<table class="table table-bordered table-striped table-highlight">
					        <thead>
					          <tr>
					            <th>#</th>
					            <th>First Name</th>
					            <th>Last Name</th>
					            <th>Username</th>
					          </tr>
					        </thead>
					        <tbody>
					          <tr>
					            <td>1</td>
					            <td>Michael</td>
					            <td>Jordan</td>
					            <td>@mjordan</td>
					          </tr>
					          <tr>
					            <td>2</td>
					            <td>Magic</td>
					            <td>Johnson</td>
					            <td>@mjohnson</td>
					          </tr>
					          <tr>
					            <td>3</td>
					            <td>Larry</td>
					            <td>the Bird</td>
					            <td>@twitter</td>
					          </tr>
					          <tr>
					            <td>4</td>
					            <td>Charles</td>
					            <td>Barkley</td>
					            <td>@cbark</td>
					          </tr>
					          <tr>
					            <td>5</td>
					            <td>Karl</td>
					            <td>Malone</td>
					            <td>@kmalone</td>
					          </tr>
					        </tbody>
					      </table>
						
						
					</div> <!-- /widget-content -->
						
				</div> <!-- /widget -->	
				
		    </div> <!-- /span6 -->
		    
		    
		    
		    
		    
		    
		    <div class="span12">
	      		
	      		<div class="widget widget-table">
						
					<div class="widget-header">						
						<h3>
							<i class="icon-th-list"></i>
							Responsive Table 							
						</h3>
						<small>(Resize to view)</small>
					</div> <!-- /widget-header -->
					
					<div class="widget-content">
						
						
						
						
						<table class="table table-striped table-bordered responsive">
							<thead>
								<tr>
									<th>Rendering engine</th>
									<th>Browser</th>
									<th>Platform(s)</th>
									<th>Engine version</th>
									<th>CSS grade</th>
								</tr>
							</thead>
							<tbody>
								<tr class="odd gradeX">
									<td>Trident</td>
									<td>Internet
										 Explorer 4.0</td>
									<td>Win 95+</td>
									<td class="center"> 4</td>
									<td class="center">X</td>
								</tr>
								<tr class="even gradeC">
									<td>Trident</td>
									<td>Internet
										 Explorer 5.0</td>
									<td>Win 95+</td>
									<td class="center">5</td>
									<td class="center">C</td>
								</tr>
								<tr class="odd gradeA">
									<td>Trident</td>
									<td>Internet
										 Explorer 5.5</td>
									<td>Win 95+</td>
									<td class="center">5.5</td>
									<td class="center">A</td>
								</tr>
								<tr class="even gradeA">
									<td>Trident</td>
									<td>Internet
										 Explorer 6</td>
									<td>Win 98+</td>
									<td class="center">6</td>
									<td class="center">A</td>
								</tr>
								<tr class="gradeA">
									<td>Gecko</td>
									<td>Camino 1.0</td>
									<td>OSX.2+</td>
									<td class="center">1.8</td>
									<td class="center">A</td>
								</tr>
								<tr class="gradeA">
									<td>Gecko</td>
									<td>Camino 1.5</td>
									<td>OSX.3+</td>
									<td class="center">1.8</td>
									<td class="center">A</td>
								</tr>
								<tr class="gradeA">
									<td>Gecko</td>
									<td>Netscape 7.2</td>
									<td>Win 95+ / Mac OS 8.6-9.2</td>
									<td class="center">1.7</td>
									<td class="center">A</td>
								</tr>
								<tr class="gradeA">
									<td>Gecko</td>
									<td>Netscape Browser 8</td>
									<td>Win 98SE+</td>
									<td class="center">1.7</td>
									<td class="center">A</td>
								</tr>
								<tr class="gradeA">
									<td>Gecko</td>
									<td>Mozilla 1.6</td>
									<td>Win 95+ / OSX.1+</td>
									<td class="center">1.6</td>
									<td class="center">A</td>
								</tr>
								<tr class="gradeA">
									<td>Gecko</td>
									<td>Mozilla 1.7</td>
									<td>Win 98+ / OSX.1+</td>
									<td class="center">1.7</td>
									<td class="center">A</td>
								</tr>
								
						
							</tbody>
						</table>
						
						
					</div> <!-- /widget-content -->
						
				</div> <!-- /widget -->	
				
		    </div> <!-- /span12 -->
		    
		    
		    
		</div> <!-- /row -->
		
		
		
		
	</div> <!-- /.container -->
	
</div> <!-- /#content -->



<div id="footer">	
		
	<div class="container">
		
		&copy; 2012 Propel UI, all rights reserved.
		
	</div> <!-- /.container -->		
	
</div> <!-- /#footer -->




</body>
	<?php echo $this->element('sql_dump'); ?>
</html>












 	
  	

