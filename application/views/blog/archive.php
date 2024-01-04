<?php $this->load->view('blog/title-archive.php');?>
<?php $this->load->view('blog/header');?>
  <!--Main layout-->
  <div class="gap-space"></div>
<div class="desc-box" style="margin-top:20px;margin-bottom:20px">
<div class="container">
<?php 
	foreach($loop_post as $key => $row){ 
    	    $cat_title = $row->cat_title;
    		$string = $row->cat_body;
    		$newArray = (explode(',', $string));
    		$title_arr = (explode(',', $cat_title));
		} 
		echo '<h2>'.$title_arr[0].'</h2>';

		$result = array_unique($newArray);
			foreach($result as $value){ 
			echo $value;
		}
?>    
</div>    
</div>

  <main class="archive">
    <div class="container main-archive">
<!--Section: Content-->
      <section class="second">
        <div class="row">
          <?php foreach($loop_post as $row){ ?>
          <div class="col-lg-4 col-md-12 post-item">
          	
            <!-- News block -->
            <div>
              <!-- Featured image -->
              <div class="bg-image" data-mdb-ripple-color="light">
                <?php 
                echo '<a href="post/'.$row->url.'">';
                ?>
                <img src="<?php echo base_url('photos/'.$row->image);?>" class="img-fluid thumb-post"></a>
                <?php echo '</a></h2>';?>
              </div>

              <!-- Article title and description -->
              <a href="" class="text-dark">
                <h5><a href="<?php echo base_url().'post/'.$row->url;?>"><?php echo $row->title;?></a></h5>
                <p>
                  <?php
                  $string = word_limiter($row->content, 20);
                  echo $string;
                  ?>
                </p>
              </a>

            </div>
            <!-- News block -->
            
          </div>
          <?php } ?>

        </div>
      </section>
      <!--Section: Content-->
  </div>
</main>