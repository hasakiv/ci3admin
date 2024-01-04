<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

            <div class="content-wrapper">
                <section class="content-header">
                    <?php echo $pagetitle; ?>
                    <?php echo $breadcrumb; ?>
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-md-12">


                            <?php echo $error;?>

                            <?php echo form_open_multipart('admin/files/do_upload');?>

                            <input type="file" name="userfile" size="20" />

                            <br /><br />

                            <input type="submit" value="upload" />

                            </form>


                        </div>
                    </div>
                
                Danh sách hình ảnh:
                <div class="table-responsive">
			    <table class="table table-bordered">
                <?php foreach($images as $row){ ?>
                    <thead class="thead-dark">
                    <tr><th scope="col">Ảnh</th>
                        <td><?php echo base_url().'media/'.$row->image;?></td>
                    </tr>
                    </thread>
                <?php }?>
                </table>
                </div>
                </section>
            </div>
