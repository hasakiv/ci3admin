<?php
class BlogModel extends CI_Model {
public function __construct() {
parent::__construct();
}
/*Insert*/
function saverecords($title,$url,$content,$image)
{
$query="insert into posts values('','$title','$url','$content', '$image')";
$this->db->query($query);
}
 
    /*Insert*/
    function save_image($image) {
        $query="insert into media values('','$image')";
        $this->db->query($query);
    }
}
?>