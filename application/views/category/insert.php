<?php $this->load->view('admin/posts/header');?>
<div class="content-wrapper">
<section class="content">
    <div class="row">        
            <div class="col-md-12">
          <form method="post" id="action-form">
              <table class="table table-bordered">
        <tr>
            
          <td><input type="text" name="cat_title" class="form-control" placeholder="Tên chuyên mục"/></td>
        </tr>
          <tr>
          <td><input type="text" name="cat_slug" class="form-control" placeholder="Url"/></td>
        </tr>
        <tr>
          <td><input type="text" name="cat_body" class="form-control" placeholder="Mô tả"/></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><button type="submit" name="add_cat" id="submit" value="Lưu dữ liệu"/>Save</button></td>
        </tr>
      </table>
        
          </form>
</div>
</div>
</section>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#submit").click(function(){
  //Get all fields value using jQury
    var cat_title = $("#cat_title").val();
    var cat_slug = $("#cat_slug").val();
    var cat_body = $("#cat_body").val();

    // validation for enter all fields in HTML form
    if(cat_title==''||cat_slug=='' || cat_body=='')
      {
      alert("Please Fill All Fields");
      }
      else
      {
        // AJAX Code To Submit Form.
        $.ajax({
        type: "POST",
        url: "<?php echo base_url();?>/admin/save_category",
        data: $('#action-form').serialize(),
        cache: false,
        success: function(result){
        alert('Dữ liệu đã thêm vào thành công');
        }
        });
      }
    return false;
  });
});
</script>