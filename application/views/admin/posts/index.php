<?php $this->load->view('admin/posts/header');?>
<div class="content-wrapper">
<section class="content">
	<div class="row">
		<div class="col-md-12">
		    <div class="table-responsive">
			<table class="table table-bordered">
				<button type="button" class="btn btn-primary"><a href="<?php echo base_url().'admin/posts/add';?>" style="color:#fff!important">Thêm bài mới</a></button
				<form action="<?php echo base_url();?>/admin/posts/search" method="post">
				<div class="input-group mb-3">
                  <input type="text" name="keyword" class="form-control" placeholder="Search">
                  <div class="input-group-append">
                    <button class="btn btn-success" type="submit">Go</button>
                  </div>
                </div>
				</form>
				
				<thead class="thead-dark">
					<tr>
					<th scope="col">Thứ tự</th>        
					<th scope="col">ID</th>
					 <th scope="col">Tiêu đề</th>
					 <th scope="col">Chuyên mục</th>
					 <th scope="col">Nội dung</th>
					 <th scope="col">Thumbail</th>
				 	</tr>
				</thead>

			 <?php
			 $i=1;
			 foreach($posts as $val => $row){
			 ?>
			 <tbody>
			 <tr>
                    <td>
                    <?php echo $i++;?>
                    </td>
			 	<td><?php echo $row->id; ?></td>
			 <td><a href=' <?php echo base_url();?>post/<?php echo $row->url;?>'><?php echo $row->title; ?></a></td>
			 <td><a href=' <?php echo base_url();?>category/<?php echo $row->cat_slug;?>'><?php echo $row->cat_title; ?></a></td>
			 <td><?php
                  $string = word_limiter($row->content, 20);
                  echo $string;
                  ?></td>
			 <td><a href='<?php echo base_url();?>post/<?php echo $row->url;?>'><?php echo $row->image; ?></a></td>
			 <td><a onclick="return confirm('Are you sure you want to edit this item?');" href="<?php echo base_url(); ?>admin/edit/<?php echo $row->id; ?>">Edit</a></td>
			 <td><a onclick="return confirm('Are you sure you want to delete this item?')" href="<?php echo base_url(); ?>admin/delete/<?php echo $row->id; ?>">Delete</a>
	
			 </td>
			 </tr>
			 </tbody>
			 <?php
			 }
			 ?>
			 </table>
			 <div class="pagination">
				<ul>
				<?php echo $this->pagination->create_links(); ?>
				</ul>
				</div>
			 </div>
			
	</div>
</div>
</section>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
/*$(document).ready(function(){
  $("#submit").click(function(){
  //Get all fields value using jQury
    var title = $("#title").val();
    var category_id = $("#category_id").val();
    var url = $("#url").val();
    var content = $("#cke_content-form").val();
    var image = $("#userfile").val();

        // AJAX Code To Submit Form.
        $.ajax({
        type: "POST",
        url: "http://anhsex2k.xyz/admin/post_save",
        data: $('#action-form').serialize(),
        cache: false,
        success: function(result){
        alert('Dữ liệu đã thêm vào thành công');
        }
        });
  });
}); */
</script>
<?php include 'ckeditor.php';?>