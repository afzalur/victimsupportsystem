<?php
class PostsController extends AppController {
    var $name = 'Posts';

    public function index() {
        $posts = $this->Post->find('all', array(
            // 'conditions'=>array('User.visible'=>1),
            'order'=>array('User.created'=>'DESC'),
            'fields'=>array('User.username','User.email','User.user_type')
        ));
        $this->set('posts', $posts);
    }
	
/*
	function admin_index($id=null) {
        $posts = $this->Post->find('all', array(
            'conditions'=>array('Post.visible'=>1),
            'order'=>array('Post.created'=>'DESC'),
            'fields'=>array('Post.title','Post.content','Post.username')
        ));
        $this->set('posts', $posts);
    }
*/	
}
?>