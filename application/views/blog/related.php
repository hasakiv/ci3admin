<div class="related-post">
	<h2 style="clear:both">Bài viết liên quan:</h2>
	        <ul>
			<?php foreach($result as $row){ ?>
                <li>
				<a href="<?php echo base_url().'post/'.$row->url;?>"><?php echo  $row->title; ?></a>
				</li>
			<?php } ?>
			</ul>

		</div>
	</section>
	</div>
</main>
<?php $this->load->view('blog/footer');?>