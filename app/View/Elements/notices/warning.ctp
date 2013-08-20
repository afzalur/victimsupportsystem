<div id="flashMessage" class="alert alert-block">
    <span class="label label-warning"><strong><?php echo __('Warning! '); ?></strong></span>
    <?php 
    echo $message; 
    echo $this->Html->link(html_entity_decode('&times;'),'#',array('class'=>'close','data-dismiss'=>'alert'));
    ?>
    
</div>