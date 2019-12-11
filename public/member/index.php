<?php
	require_once('../../private/initialise.php');
	
	if(!isset($_GET['id'])) {
        redirect_to(url_for('/index.php'));
    }
    $id = $_GET['id'];
	
	redirect_to(url_for('/member/profiles/index.php?id='.$id));
?>