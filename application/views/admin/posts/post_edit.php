<?php $this->load->view('admin/posts/ckeditor');?>
<div class="content-wrapper">
<section class="content">
	<div class="row">
		<div class="col-md-12">

		<form method="post" action="<?php echo base_url('admin/update/'.$data->id);?>">
		    <div class="form-group">
              <label for="title">Tiêu đề </label>
              <input type="text" name="title" class="form-control" id="title" value="<?php echo $data->title; ?>">
            </div>
            
            <div class="form-group">
              <label for="url">URL </label>
              <input type="text" name="url" class="form-control" id="url" value="<?php echo $data->url; ?>">
          </div>
          
            <div class="form-group">
              <label for="content">Content </label>
              <textarea name="content" class="form-control noidung" id="content" class="md-textarea form-control" rows="3" value=""><?php echo $data->content; ?></textarea>
          </div>

            <div class="form-group">
		        <select class="form-control" name="category_id" id="category_id" required>
                        <option value="">No Selected</option>
                        <?php foreach($category as $row):?>
                        <option value="<?php echo $row->cat_id;?>"><?php echo $row->cat_title;?></option>
                        <?php endforeach;?>
                </select>
            </div>
            <div class="form-group">                
              <?php foreach($category as $row) {
                $string = $row->cat_title;
                $newArray = (explode(',', $string));
                }
                $result = array_unique($newArray);
                ?>
              <select class="form-control" name="category_id" id="category_id">
              <option value="<?php echo $row->cat_id;?>">
                <?php 
                foreach($result as $value){
                echo $value;
              }
                ?>
                
                </option>
              </select>
              <?php //}?>    
            </div>
            <div class="form-group">
                  <label for="url">Ảnh </label>
                  <input type="file" name='userfile' class="form-control" id="image" type="hidden" name="size" value="<?php echo $data->image; ?>">
              </div>
              

		        <div class="col-md-12 col-md-offset-2 pull-right">
		            <input type="submit" name="save" class="btn" id="submit" data-id="<?php echo $data->id; ?>">
		        </div>
		    
		    
		</form>
    </div>
	</div>
</section>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<?php include 'ckeditor.php';?>
<script>
$(document).ready(function(){
  $("#submit").click(function(e){
      e.preventDefault();
  //Get all fields value using jQury
    var id = $(this).attr('data-id');
    var title = $("#title").val();
     var url = $("#url").val();
    var content = CKEDITOR.instances['content'].getData();
    var category_id = $("#category_id").val();
    var image = $("#image").val();

    // AJAX Code To Submit Form.
    $.ajax({
    type: "POST",
    url: "<?php echo base_url();?>/admin/update/"+id,
    data: {
        title: title,
        url: url,
        content: content,
        category_id: category_id,
        image: image
    },
    cache: false,
    success: function(result){
        console.log(result);
        if(result) {
            alert('Dữ liệu đã thêm vào thành công');
        }
    }
    });

    return false;
  });
});
</script>