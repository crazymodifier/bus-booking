    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        
        <div class="card">
          <!-- Left col -->
          <div class="card-header">
            <h3 class="card-title">
              Tour Images </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <?php
                $count = 1;
                $images = $this->db->where('location', 'tour')->get('gallery')->result();
                foreach ($images as $img) { ?>
                <div class="col-md-3">
                  <?php echo form_open_multipart('Abrar/gallery/tour', ['class'=>'card']);?>
                    <div class=''>
                      <input type="file" name="images-<?=$count?>" id="tour-image-<?=$count?>" class="d-none" accept="images">
                      <label for="tour-image-<?=$count?>" class="d-flex" style="height:200px">
                        <img src="<?=base_url('dist/uploads/'.$img->images)?>" alt="Add Images" class="w-100">
                      </label>
                    </div>
                    <div class="card-footer">
                      <a href="<?=base_url('Abrar/remove/'.$img->id.'/gallery')?>" class="btn btn-danger remove-btn btn-block"><i class="fa fa-trash fa-sm mr-2"></i> Remove</a>
                    </div>
                  </form>
                </div>
              <?php $count++; }?>

              <div class="col-md-3">
                <?php echo form_open_multipart('Abrar/gallery/tour', ['class'=>'card']);?>
                  <div class=''>
                    <input type="file" name="images" id="tour-image" class="d-none file-upload" accept="image/*">
                    <label id="image" for="tour-image" class="d-flex" style="height:200px">
                      <!-- <img src="<?=base_url('dist/img/upload.png')?>" alt="Add Images" class="" width="100"> -->
                      <span class="fa-stack fa-3x m-auto">
                        <i class="fa fa-circle fa-stack-2x text-secondary" aria-hidden="true"></i>
                        <i class="fa fa-plus fa-stack-1x fa-inverse" aria-hidden="true"></i>
                      </span>
                    </label>
                  </div>
                  <div class="card-footer">
                    <div class="row">
                      <div class="col-md-12">
                        <button class='btn btn-success btn-block'>Upload</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
      
  </div>
  <!-- /.container-fluid -->
  <?=copyrights()?>
  <!-- /.content -->
  
