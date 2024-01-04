<?php
class BlogModel extends CI_Model
{
/*Hiển thị*/

	function get_records() {
			$this->db->cache_on();
			//$this->output->delete_cache();
			$this->db->order_by('id', 'RANDOM');
			$this->db->limit(100);
			$query = $this->db->select('*')
	          ->from('posts')
	          ->join('categories', 'categories.cat_id = posts.category_id', 'left')
	          ->get();
	        return $query->result();
	    }
	function get_related($cat_id) {
			//$this->db->cache_on();
			$this->output->delete_cache();
			$this->db->order_by('id', 'RANDOM');
			$query = $this->db->select('*')
	          ->from('posts')
	          ->where('category_id', $cat_id)
	          ->limit(15)
	          ->get();
	        return $query->result();
	    }
	function display_records() {
			//$query=$this->db->query("select * from posts");
			$query = $this->db->order_by("id", "desc")->get('posts', 1, 1);
			//$query = $this->db->order_by("id", "desc");
			return $query->result();
	}

	function display_col() {
			$query = $this->db->get('posts');
			return $query->result();
	}
	public function get_count() {
        $query = $this->db->get('posts');
		return $query->result();
	}
		// SEO URL
	/*function get_url($url){ 
		$geturl=$this->db->query("SELECT * FROM posts WHERE url='$url'"); 
		return $geturl; 
		} */
	function get_url($url) {
			//$this->db->cache_on();
			$this->output->delete_cache();
			$this->db->order_by('category_id', 'DESC');
			$query = $this->db->select('*')
	          ->from('posts')
	          ->join('categories', 'categories.cat_id = posts.category_id', 'inner')
	          ->where('url',$url)
	          ->get();
	        return $query->result();
	      }
	/* THÊM BÀI VIẾT MỚI */
	function saverecords($title,$category_id,$url,$content,$image) {
		$query="insert into posts values('','$title',$category_id,'$url','$content', '$image')";
		$this->db->query($query);
	}
	
	public function save_post($data) 
	{
		$query = $this->db->insert('posts', $data);
        return $query;
    }

	function get_id($id) {
			$query = $this->db->select('*')
	          ->from('posts')
	          ->join('categories', 'categories.cat_id = posts.category_id', 'left')
	          ->where('id',$id)
	          ->get();
	        return $query;
	    }
    function post_edit($id)
        {
        $this->db->where('id', $id);
        $query = $this->db->get('posts');
        return $query->row(0);
        }

	public function update_post($id,$data) 
    {
        $this->db->where('id',$id);
        $this->db->update('posts',$data);    
    }
    
    public function get_delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
	// SHOW POST ARCHIVE

	public function get_category($slug) {
		//$this->db->cache_on();
		//$this->output->delete_cache();
		$query = $this->db->select('*')
	          ->from('categories')
	          ->join('posts', 'posts.category_id= categories.cat_id', 'right')
	          ->where('cat_slug',$slug)
	          ->get();
	        return $query->result();
		} 
	/* HIỂN THỊ BÀI VIẾT THEO CHUYÊN MỤC */
	public function display_category() {
		$this->db->cache_on();
		//$this->output->delete_cache();
		$results = array();
	    $this->db->select('*');
	    $this->db->from('categories');
	    $this->db->join('posts', 'posts.category_id= categories.cat_id', 'left');
	    $this->db->group_by("posts.category_id"); // Loại bỏ trùng lặp Category
	    $query = $this->db->get();

	    if($query->num_rows() > 0) {
	        $results = $query->result();
	    }
	    return $results;
	}

	public function cat_update_model($cat_id) 
    {
        $data=array(
        	'cat_id' => $this->input->post('cat_id'),
            'cat_title' => $this->input->post('cat_title'),
            'cat_slug' => $this->input->post('cat_slug'),
            'cat_body'=> $this->input->post('cat_body')
        );
        if($cat_id==0){
            return $this->db->insert('categories',$data);
        }else{
            $this->db->where('cat_id',$cat_id);
            return $this->db->update('categories',$data);
        }        
    }

	function save_category($cat_title,$cat_slug,$cat_body) { 
		$query="insert into categories values('','$cat_title','$cat_slug', '$cat_body')";
		$this->db->query($query);
	}
	
    public function save_cat($data) 
	{
		$query = $this->db->insert('categories', $data);
        return $query;
    }
    
 	/**
 	 * PHÂN TRANG
 	 */
	public function get_page($limit, $start = 1) {  
		//$this->db->cache_on(); 
		$this->output->delete_cache();
		$this->db->order_by("id", "desc");    
		$this->db->limit($limit, $start);  
		$this->db->select('*');
		$this->db->order_by("id", "desc");
		$this->db->from('posts');
		$this->db->join('categories', 'posts.category_id = categories.cat_id', 'left');
		$join_query = $this->db->get();
		if($join_query->num_rows() > 0) {
		    $results = $join_query->result();
		}
		return $results;
	}
	
	public function record_count() {
		 return $this->db->count_all("posts");
	}
	
	
	function search($keyword)
    {
        $this->db->like('title',$keyword);
        $query  =   $this->db->get('posts');
        return $query->result();
    }
    
    /*Save Image*/
    function save_image($image) {
        $query="insert into media values('','$image')";
        $this->db->query($query);
    }
    function get_image() {
			$query = $this->db->get('media');
			return $query->result();
	}
	
	function getSearchKey($keyword) {
        $result = $this->db->like('title', $keyword)
                 ->or_like('author', $key)
                 ->get('posts');
    
        return $result->result();
    } 
}