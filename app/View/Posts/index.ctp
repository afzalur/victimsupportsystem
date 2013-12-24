<?php foreach($posts as $post): ?>
    <h1><?php echo $post['Post']['title']; ?><h1>
    <p><?php echo $post['Post']['content']; ?><p>
    <p>Posted by: <?php echo $post['Post']['username']; ?><p>
    <hr />
<?php endforeach; ?>