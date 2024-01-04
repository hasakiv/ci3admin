<?php $this->load->view('admin/posts/header');?>
<div class="content-wrapper">
<section class="content">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
		<form method="post" action="<?php echo base_url('admin/cat_update/'.$data->cat_id);?>">
		    <div class="row">

		    	<div class="col-md-8 col-md-offset-2">
		            <div class="form-group">
		                <label class="col-md-3">ID</label>
		                <div class="col-md-9">
		                    <textarea name="cat_id" class="form-control"><?php echo $data->cat_id; ?></textarea>
		                </div>
		            </div>
		        </div>

		        <div class="col-md-8 col-md-offset-2">
		            <div class="form-group">
		                <label class="col-md-3">Tiêu đề</label>
		                <div class="col-md-9">
		                    <input type="text" name="cat_title" class="form-control" value="<?php echo $data->cat_title; ?>">
		                </div>
		            </div>
		        </div>

		        <div class="col-md-8 col-md-offset-2">
		            <div class="form-group">
		                <label class="col-md-3">URL</label>
		                <div class="col-md-9">
		                    <textarea name="cat_slug" class="form-control"><?php echo $data->cat_slug; ?></textarea>
		                </div>
		            </div>
		        </div>

		        <div class="col-md-8 col-md-offset-2">
		            <div class="form-group">
		                <label class="col-md-3">Nội dung</label>
		                <div class="col-md-9">
		                    <textarea name="cat_body" class="form-control"><?php echo $data->cat_body; ?></textarea>
		                </div>
		            </div>
		        </div>

		        <div class="col-md-8 col-md-offset-2 pull-right">
		            <button type="submit" name="save" class="btn">Save</button>
		        </div>
		    </div>
		    
		</form>

	</div>
</section>
</div>
<script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
<script type="text/javascript">

</script>
