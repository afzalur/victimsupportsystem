

<?php
$success_title = array(' Great ! ', ' Yahhooo !!! ', ' Congratulations ! ', ' You Rockz ! ');

?>

<div id="flashMessage" class="alert alert-success">
    <span class="label label-success"><strong><?php echo __($success_title[rand(0, 3)]); ?></strong></span>
    <?php 
    echo $message; 
    echo $this->Html->link(html_entity_decode('&times;'),'#',array('class'=>'close','data-dismiss'=>'alert'));
    ?>
    
</div>