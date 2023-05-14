<?php 
    if(!isset($_GET['id_slide']) || $_GET['id_slide']==NULL) {
    }
    else {
        $id = $_GET['id_slide'];
        $result = xoaanhslide($conn,$id);
    }
?>