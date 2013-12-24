<?php
	echo $this->Form->create('User',array('controller'=>'users','action' => 'result'));
	echo $this->Form->input('username');
	echo $this->Form->end('Search');
?> 