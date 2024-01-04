<?php $this->load->view('blog/header');?>
<div class="container">
	<div class="row">
<div class="search">
	<h2>Bài viết liên quan:</h2>
	<div class="row">
			<?php foreach($results as $row){ ?>
				<div class="col-sm-3 col-md-4">
					    <div class="item-post">
					    	<a href="<?php echo base_url().'post/'.$row->url;?>"><img src="<?php echo base_url('photos/thumb/'.$row->image);?>" class="img-fluid thumb-post"></a>
					    	<a href="<?php echo base_url().'post/'.$row->url;?>"><?php echo "<h4>".$row->title."</h4>"; ?></a>
					    
					    </div>
				</div>
			<?php } ?>
	</div>
</div>
</div>
</div>

		</div>
	</section>
	</div>
</main>
<?php $this->load->view('blog/footer');?>