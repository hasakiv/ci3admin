<?php 
function related_post($cat_id) {
    $path = APPPATH.'models/BlogModel.php';
    include $path;
    get_related($cat_id);
    var_dump($info);
}