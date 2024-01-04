<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Files extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("BlogModel");
        /* Title Page :: Common */
        $this->page_title->push(lang('menu_files'));
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, lang('menu_files'), 'admin/files');
    }


	public function index()
	{
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
            $this->data['images']=$this->BlogModel->get_image();
            /* Load Template */
            $this->template->admin_render('admin/files/index', $this->data);
        }
	}


	public function do_upload()
	{
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Conf */
            $config['upload_path']      = './media/';
            $config['allowed_types']    = 'gif|jpg|png';
            $config['max_size']         = 2048;
            $config['max_width']        = 4096;
            $config['max_height']       = 4096;
            $config['file_ext_tolower'] = TRUE;

            $this->load->library('upload', $config);

            /* Breadcrumbs */
            $this->breadcrumbs->unshift(2, lang('menu_files'), 'admin/files');
            $this->data['breadcrumb'] = $this->breadcrumbs->show();

            if ( ! $this->upload->do_upload('userfile'))
            {
                /* Data */
                $this->data['error'] = $this->upload->display_errors();

                /* Load Template */
                $this->template->admin_render('admin/files/index', $this->data);
            }
            else
            {
                /* Data */
                $this->data['upload_data'] = $this->upload->data();
                $uploadData = $this->upload->data();
                $image = $uploadData['file_name'];
                $this->BlogModel->save_image($image);
                /* Load Template */
                $this->template->admin_render('admin/files/upload', $this->data);
            }
        }
	}
}
