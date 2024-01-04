<?php $this->load->view('admin/posts/header');?>
<div class="content-wrapper">
<section class="content">
	<div class="row">
		<div class="col-md-12">
		    
			<?php echo form_open_multipart('admin/Post/post_add');?>
			<form method="post" class="form" id="action-form" enctype="multipart/form-data">

			      <div class="form-group">
			          <label for="title">Tiêu đề </label>
			          <input type="text" name="title" class="form-control slug-input" id="title" onkeyup="ChangeToSlug();">
			      </div>
			      <div class="form-group">
                    <label>Chuyên mục</label>

                    <select class="form-control" name="category_id" id="category_id" required>
                        <option value="">No Selected</option>
                        <?php foreach($category as $row):?>
                        <option value="<?php echo $row->cat_id;?>"><?php echo $row->cat_title;?></option>
                        <?php endforeach;?>
                    </select>
                </div>

			      <div class="form-group">
			          <label for="url">URL </label>
			          <input type="text" name="url" class="form-control slug-output" id="url">
			      </div>

			      <div class="form-group">
			          <label for="content">Content </label>
			          <textarea type="text" name="content" class="form-control noidung" id="content" class="md-textarea form-control" rows="3"></textarea>
			      </div>

			      <div class="form-group">
			          <label for="url">Ảnh </label>
			          <input type="file" name='userfile' class="form-control" id="userfile" type="hidden" name="size" value="1000000">
			      </div>

			      <div class="form-group">
			          <input type="submit" name="submit" class="form-control" id="submit" value="Save Data">
			      </div>
			  
			</form>
	</div>
</div>
</section>
</div>
<script>
function ChangeToSlug()
{
    var title, slug;
 
    //Lấy text từ thẻ input title 
    title = document.getElementById("title").value;
 
    //Đổi chữ hoa thành chữ thường
    slug = title.toLowerCase();
 
    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    //Xóa các ký tự đặt biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, "-");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    //In slug ra textbox có id “slug”
    document.getElementById('url').value = slug;
}
</script>
<?php include 'ckeditor.php';?>
<?php $this->load->view('admin/posts/footer');?>