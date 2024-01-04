  <!--Main layout-->
  <main class="main-home">
    <div class="container main-content">

      <!--Section: Content-->
      <section class="second">
        <div class="row gx-5">
          <?php foreach($data as $row){ ?>
            <div class="col-lg-4 col-md-12 post-item">

              <!-- News block -->
              <div>
                <!-- Featured image -->
                <div class="bg-image" data-mdb-ripple-color="light">
                  <?php 
                  echo '<a href="post/'.$row->url.'">';
                  ?>
                  <img src="<?php echo base_url('photos/thumb/'.$row->image);?>" class="img-fluid thumb-post"></a>
                  <?php echo '</a></h2>';?>
                </div>

                <!-- Article data -->
                <div class="row">
                  <div class="col-6">
                    <a href="<?php echo base_url();?>category/<?php echo $row->cat_slug;?>" class="text-info">
                      <?php echo $row->cat_title;?>
                    </a>
                  </div>

                  <div class="col-6 text-end">
                    <span></span>
                  </div>
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

      <!-- Pagination -->
      <?php echo $this->pagination->create_links(); ?>
    </div>
  </main>
  <!--Main layout-->
  <!--Footer-->
  <footer class="bg-light text-lg-start">