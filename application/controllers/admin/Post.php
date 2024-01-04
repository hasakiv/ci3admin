<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Title Page :: Common */
        $this->page_title->push(lang('menu_files'));
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, lang('menu_files'), 'admin/posts');
        // Limited Content
        $this->load->helper('text');
        $this->load->helper('array');
        $this->load->database('default');
        $this->load->model("BlogModel");
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->helper('url', 'form');
        $this->uploadPath = 'photos/';
        $this->load->database();
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
    }
    function detail($url){ 
        $data=$this->BlogModel->get_url($url);
        if($data->num_rows() > 0){
        $x['viewdata']= $data;
        $this->load->view('single',$x);
        }else{
        redirect('admin/blog/index ');
        }
        $datav['rdata']=$this->BlogModel->get_records();
        $this->load->view('blog/related',$datav);
        }

    // Index thêm bài viết mới
    public function index()
    {
        $this->load->helper('text');
        $this->load->helper('url'); 
        
        $this->load->library('pagination');

        $config = array();
        $config['uri_segment'] = 3;
        $config['base_url']    = base_url().'admin/posts/'; 
        $config['total_rows'] = $this->BlogModel->record_count();
        $config["per_page"] = 100;
        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = FALSE;

        $config['full_tag_open'] = '<nav class="my-4"><ul class="pagination pagination-circle justify-content-center">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['attributes'] = ['class' => 'page-link'];
        $config['first_link'] = true;
        $config['last_link'] = true;
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
        $this->data['links'] = $this->pagination->create_links();        
        $this->data['posts'] = $this->BlogModel->get_page($config["per_page"], $page);        
        //$this->load->view('admin/posts/index',$data);         
        
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
            $this->data['error'] = NULL;
            $this->data['category']=$this->BlogModel->display_category();
            //$this->data['posts']=$this->BlogModel->get_records();
            //$this->data['count'] = $this->BlogModel->get_count();
            $this->template->admin_render('admin/posts/index', $this->data);
        }
    }
    public function form_posts()
    {
        $this->load->helper('text');
        
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
            $this->data['error'] = NULL;
            $this->data['category']=$this->BlogModel->display_category();
            $this->data['posts']=$this->BlogModel->get_records();
            $this->data['count'] = $this->BlogModel->get_count();
            $this->template->admin_render('admin/posts/post_add', $this->data);
        }
    }
    // Chức năng thêm bài viết
    public function post_add(){
        
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            //load library
            $this->load->library('upload');
            //Set the config
            $config['upload_path'] = './photos/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2048';
            $config['overwrite'] = TRUE;
            $config['encrypt_name'] = FALSE;
            $config['remove_spaces'] = TRUE;
            $config['max_width']  = '1920';
            $config['max_height']  = '1920';

            $this->upload->initialize($config);

            if(!$this->input->post('submit') || !$this->upload->do_upload('userfile')) {
                echo $this->upload->display_errors();
            } else {
                $uploadData = $this->upload->data(); 
                $uploadedImage = $uploadData['file_name']; 
                $org_image_size = $uploadData['image_width'].'x'.$uploadData['image_height']; 
                 
                $source_path = $this->uploadPath.$uploadedImage; 
                $thumb_path = $this->uploadPath.'thumb/'; 
                $thumb_width = 300; 
                $thumb_height = 250; 
                 
                // Image resize config 
                $config['image_library']    = 'gd2'; 
                $config['source_image']     = $source_path; 
                $config['new_image']         = $thumb_path; 
                $config['maintain_ratio']     = TRUE; 
                $config['width']            = $thumb_width; 
                $config['height']           = $thumb_height; 
                $config['quality']       = 75;
                 
                // Load and initialize image_lib library 
                $this->load->library('image_lib', $config); 
                 
                // Resize image and create thumbnail 
                $this->image_lib->resize();
                $image = $uploadData['file_name']; 

                $title=$this->input->post('title');
                $url=$this->input->post('url');
                $content=$this->input->post('content');
                $category_id=$this->input->post('category_id');
                $data = $this->BlogModel->saverecords($title,$category_id,$url,$content,$image);
                redirect(base_url('admin/posts'));
            }
        } 
    }// --> End else
    function post_save() {
        $title = $this->input->post('title');
        $url = $this->input->post('url');
        $content = $this->input->post('content');
        $category_id = $this->input->post('category_id');
        $image = $this->input->post('image');

        $data = array(
            'title' => $title,
            'url' => $url,
            'content' => $content,
            'category_id' => $category_id,
            'image' => $image,
        );
        $this->load->model('BlogModel');
        $insert = $this->BlogModel->save_post($data);
        echo json_encode($insert);
    }
	
    function post_edit($id){
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
            $this->data['error'] = NULL;
            $data = $this->db->get_where('posts', array('id' => $id))->row();
            
            $this->data['category']=$this->BlogModel->display_category();
            $this->data['data']=$this->BlogModel->post_edit($id);
            $this->template->admin_render('admin/posts/post_edit', $this->data);
            
        }

    }

    function post_update($id){
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $title = $this->input->post('title');
            $url = $this->input->post('url');
            $content = $this->input->post('content');
            $category_id = $this->input->post('category_id');
            $image = $this->input->post('image');
            
                $upPath = $this->uploadPath.'thumb/'; 
                 $config = array(
                'upload_path' => $upPath,
                'allowed_types' => "gif|jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000", 
                'max_height' => "768",
                'max_width' => "1024"
                );
                 
                $this->load->library('upload', $config);
                if(!$this->upload->do_upload('userfile'))
                { 
                    $data['imageError'] =  $this->upload->display_errors();
                }
                else
                {
                    $imageDetailArray = $this->upload->data();
                    $image =  $imageDetailArray['file_name'];
                }

                $data = array(
                    'title' => $title,
                    'url' => $url,
                    'content' => $content,
                    'category_id' => $category_id,
                    'image' => $image,
                );
            
                $this->load->model('BlogModel');
                $insert = $this->BlogModel->update_post($id,$data);
                var_dump($insert);
                if($insert) {
                
                    echo '<script language="javascript">alert("Có lỗi trong quá trình xử lý"); window.location="register.php";</script>';
                //redirect(base_url('admin/posts/add'));
    
                /* Load Template */
                //$this->template->admin_render('admin/posts/post_edit', $this->data);
                }
 
        }

    }

    function post_delete($id){
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();

            /* Data */
            $this->data['error'] = NULL;

            $this->db->where('id', $id);
            $this->db->delete('posts');
            /* Load Template */
            echo '<script language="javascript">alert("Có lỗi trong quá trình xử lý"); window.location="register.php";</script>';
            redirect(base_url('admin/add'));
        }

    }

    // ++++++++++++++++++++++++ End Post Add
        
    public function upload() {
        $this->load->view('admin/posts/upload');
    }   

    // CHỨC NĂNG THÊM CHUYÊN MỤC
    public function category_show() {
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['error'] = NULL;
        $this->data['category']=$this->BlogModel->display_category();
        $this->template->admin_render('category/index', $this->data);

    }

    public function category_ctl() {
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
             /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();

            /* Data */
            $this->data['error'] = NULL;

            /* Load Template */
            $this->template->admin_render('category/insert', $this->data);

            //$this->load->view('category/insert');
            /*if($this->input->post('add_cat'))
                {
                $cat_title=$this->input->post('cat_title');
                $cat_slug=$this->input->post('cat_slug');
                $cat_body=$this->input->post('cat_body');
                $this->BlogModel->save_category($cat_title,$cat_slug,$cat_body);
               
               } */

            }
        } // --> End else
        function category_save() {
            $cat_title = $this->input->post('cat_title');
            $cat_slug = $this->input->post('cat_slug');
            $cat_body = $this->input->post('cat_body');
    
            $data = array(
                'cat_title' => $cat_title,
                'cat_slug' => $cat_slug,
                'cat_body' => $cat_body,
            );
            $this->load->model('BlogModel');
            $insert = $this->BlogModel->save_cat($data);
            echo json_encode($insert);
            }
        // END SAVE CATE
        function cat_edit($cat_id){
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
            $this->data['error'] = NULL;
            //$data['data'] = $this->BlogModel->get_id($id);
            //$this->load->view('admin/posts/post_edit', $data);
            $this->data['data'] = $this->db->get_where('categories', array('cat_id' => $cat_id))->row();
           //$this->load->view('category/edit',array('data'=>$data));
            $this->template->admin_render('category/edit', $this->data);
        }

    }
        
        function cat_update($cat_id){
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();

            /* Data */
            $this->data['error'] = NULL;

            $data=new BlogModel;
            $data->cat_update_model($cat_id);
            $this->session->set_flashdata('success', "Cập nhật thành công"); 
            redirect(base_url('admin/category'));

            /* Load Template */
            //$this->template->admin_render('admin/posts/post_edit', $this->data);
        }

    }
    
    public function search()
	{
	    $keyword = $this->input->post('keyword');
		$data['searchdata']=$this->BlogModel->getSearchKey($keyword);
		$this->load->view('admin/posts/index',$data);
	}

}
