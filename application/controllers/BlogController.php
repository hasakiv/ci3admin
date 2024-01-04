<?php
class BlogController extends CI_Controller
{
	public function __construct()
	{

		parent::__construct();
		$this->load->database();
		$this->load->model('BlogModel');
		$this->load->helper('url');
		$this->load->library('pagination');
		$this->load->helper('functions');
	}
	
	/* Trang chủ */
	public function index() {
		$this->load->helper('url'); 
		
		$this->load->library('pagination');

		$config = array();
		$config['base_url']    = base_url().'page'; 
		$config['total_rows'] = $this->BlogModel->record_count();
		$config["per_page"] = 12;
		$config['use_page_numbers'] = TRUE;
		$config['page_query_string'] = FALSE;

		$config['full_tag_open'] = '<nav class="my-4"><ul class="pagination pagination-circle justify-content-center">';
		$config['full_tag_close'] = '</ul></nav>';
		$config['attributes'] = ['class' => 'page-link'];
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		$this->pagination->initialize($config);        
		$data['links'] = $this->pagination->create_links();        
		$data['data'] = $this->BlogModel->get_page($config["per_page"], $page);        
		$this->load->view('blog/index',$data);
	}

	function detail($url){ 
		$datav['viewdata']=$this->BlogModel->get_url($url);  
	    $this->load->view('blog/title-single',$datav);

		$data['viewdata']=$this->BlogModel->get_url($url);  
	    $this->load->view('blog/single',$data); 
	    
        foreach($data['viewdata'] as $i) {
        	$cat_id = $i->category_id;
        	$result['result']=$this->BlogModel->get_related($cat_id);
        	$this->load->view('blog/related',$result);
        }
        //$data['data']=$this->BlogModel->get_related($cat_id);
        
        //$this->load->view('blog/related',$data);
	    
}

	public function display_footer()
		{
		$result['viewdata']=$this->BlogModel->get_records();
		$this->load->view('blog/footer',$result);
		}

	public function display_category($slug) {
		$data['loop_post']=$this->BlogModel->get_category($slug);
		$this->load->view('blog/archive',$data);
		$this->load->view('blog/footer');
		}

    // SEARCH
    function search()
    {
        $keyword    =   $this->input->post('keyword');
        $data['results']    =   $this->BlogModel->search($keyword);
        $this->load->view('blog/result_view',$data);
    }
}
?>