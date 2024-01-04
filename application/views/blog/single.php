<?php $this->load->view('blog/title-single');?> 
<?php $this->load->view('blog/header');?> 
  <!--Main layout-->
  <main class="main">
    <div class="container main-single">
      <!--Section: News of the day-->
      <section class="border-bottom">
        <div class="row gx-5">
        	<div class="content-single">
				<?php foreach($viewdata as $row){ 
				
				?>
				    <div class="item-post">
				    	<a href="<?php echo base_url();?>">Trang chủ</a> | <a href="<?php echo base_url().'category/'.$row->cat_slug;?> "><?php echo "<span>".$row->cat_title."</span>"; ?></a>
				    <?php echo "<h1>".$row->title."</h1>"; ?>
				    <?php echo "<p>".$row->content."</p>"; ?>
				    </div>
				<?php } 
				
				?>
			</div>
			
