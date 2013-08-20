

<?php
$error_title = array(' Oh Snap ! ', ' Oooopss !!! ', ' Owaah ! ');

?>

<div id="flashMessage" class="alert alert-error">
    <span class="label label-important"><strong><?php echo __($error_title[rand(0, 2)]); ?></strong></span>
    <?php 
    echo $message; 
    echo $this->Html->link(html_entity_decode('&times;'),'#',array('class'=>'close','data-dismiss'=>'alert'));
    ?>
    
</div>