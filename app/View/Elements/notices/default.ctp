<div id="flashMessage">
    <?php 
    echo $message; 
    echo $this->Html->link(html_entity_decode('&times;'),'#',array('class'=>'close','data-dismiss'=>'alert'));
    ?>
    
</div>