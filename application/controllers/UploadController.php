<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class UploadController extends CI_Controller {
public function __construct() {
parent::__construct();
$this->load->helper('array');
$this->load->helper('url');
$this->load->database('default');
//$this->load->model("UploadModel");
$this->load->helper('form');
}
public function upload_view(){
$this->load->view('upload_view', array('error' => ' ' ));
$this->load->helper('form');
}
public function do_upload(){
$config = array(
'upload_path' => "./upload/",
'allowed_types' => "gif|jpg|png|jpeg|pdf",
'overwrite' => TRUE,
'max_size' => "2048000",
'max_height' => "768",
'max_width' => "1024" );
$this->load->library('upload', $config);
if($this->upload->do_upload())
{
$data = array('upload_data' => $this->upload->data());
$this->load->view('upload_success',$data);
}
if($this->input->post('submit'))
{
$uploadData = $this->upload->data();
$image = $uploadData['file_name'];
$this->BlogModel->saverecords($image);
echo '<script language="javascript">alert("Đã thêm hình ảnh thành công!");</script>';
}
else
{
$error = array('error' => $this->upload->display_errors());
$this->load->view('upload_view', $error);
}
}
}
?>