<?php foreach ($users as $user): ?>
    <tr>
        <td><?php echo $user['User']['id']; ?></td>
        <td>
            <?php echo $html->link($user['User']['username'],'/users/display/'.$user['User']['id']);?>
                </td>
        <td><?php // echo $user['User']['email']; ?></td>
    </tr>
<?php endforeach; ?>