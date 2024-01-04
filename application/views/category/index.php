<?php $this->load->view('admin/posts/header');?>
<div class="content-wrapper">
<section class="content">
	<div class="row">
	
            <div class="table-responsive">
			<table class="table table-bordered">
				<button type="button" class="btn btn-primary"><a href="add-category" style="color:#fff!important">Thêm chuyên mục mới</a></button>
				<thead class="thead-dark">
					<tr>
					<th scope="col">ID</th>
					 <th scope="col">Tiêu đề</th>
					 <th scope="col">Mô tả</th>
					 <th scope="col">Thumbail</th>
				 	</tr>
				</thead>

			 
			<?php
			 foreach($category as $row){
			 ?>
			 <tr>
			 	<td><?php echo $row->cat_id; ?></td>
			 <td>
			 	<a href=' <?php echo base_url();?>category/<?php echo $row->cat_slug;?>'><?php echo $row->cat_title; ?></a>

			 </td>
			 <td><?php
                  $string = word_limiter($row->cat_body, 20);
                  echo $string;
                  ?></td>
			 <td><a href='<?php echo base_url();?>post/<?php echo $row->url;?>'><?php //echo $row->image; ?></a></td>
			 <td><a onclick="return confirm('Are you sure you want to edit this item?');" href="<?php echo base_url(); ?>admin/cat_edit/<?php echo $row->cat_id; ?>">Edit</a></td>
			 <td><a onclick="return confirm('Are you sure you want to delete this item?')" href="<?php echo base_url(); ?>admin/cat_delete/<?php echo $row->cat_id; ?>">Delete</a>
	
			 </td>
			 </tr>
			 <?php
			 }
			 ?>
			 </table>
            </div>
	</div>

</section>
</div>