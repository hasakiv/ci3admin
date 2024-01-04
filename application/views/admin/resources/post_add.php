<!DOCTYPE html>  
<html>
<head>
<title>Thêm bài viết</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<?php echo form_open_multipart('post_controller/post_add');?>
<form method="post" class="form">

      <div class="form-group">
          <label for="title">Tiêu đề </label>
          <input type="text" name="title" class="form-control" id="title">
      </div>

      <div class="form-group">
          <label for="url">URL </label>
          <input type="text" name="url" class="form-control" id="url">
      </div>

      <div class="form-group">
          <label for="content">Content </label>
          <textarea name="content" class="form-control noidung" id="content" class="md-textarea form-control" rows="3"></textarea>
      </div>

      <div class="form-group">
          <label for="url">Ảnh </label>
          <input type="file" name='userfile' class="form-control" id="image" type="hidden" name="size" value="1000000">
      </div>

      <div class="form-group">
          <input type="submit" name="submit" class="form-control" id="submit" value="Save Data">
      </div>
  
</form>
</div>
</body>
</html>