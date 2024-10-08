    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <div class="card">
              <div class="card-body">
                  <?php 
                  if(isset($_POST['update']))
                  {
                      $this->db->where('location', 'testimonial')->update('headings',['heading' => $this->input->post('heading')]);
                      $this->session->set_flashdata('success','Updated');
                  }
                  $testi = $this->db->where('location', 'testimonial')->get('headings')->row(); ?>
                  <form class="row" action="" method="POST">
                      <div class="col-12">
                          <label>Heading</label>
                          <div class="form-group mb-0">
                              
                              <!--<input type="text" class="form-control" value="<?=$testi->heading?>" name="heading" >-->
                              <textarea class="textarea" name="heading"><?=$testi->heading?></textarea>
                          </div>
                      </div>
                      <div class="col-12">
                          <button name="update"class="btn btn-success">Update</button>
                      </div>
                  </form>
              </div>
          </div>
        <!-- Main row -->
        <style>
          .custom-select
          {
            background:none;
          }
        </style>
        <?php if(isset($_REQUEST['id']) && $_REQUEST['action'] == 'edit') { 
          $test = $this->db->where('testimonial_id', $_REQUEST['id'])->get('testimonial')->row();
          ?>
        <?php echo form_open_multipart('Abrar/testimonials/'.$_REQUEST['id'], ['class'=>'card']);?>
          <!-- Left col -->
          <div class="card-header">
            <h3 class="card-title">
              Edit Testimonials</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
                <div class="form-group">
                  <input type="text" name='test_name' class="form-control" placeholder="Name" value="<?=$test->test_name?>">
                </div>
                <div class="form-group">
                  <input type="email" name="test_email" class="form-control"  placeholder="Email" value="<?=$test->test_email?>">
                </div>
                <div class="form-group">
                  <textarea name="test_mes" id="" cols="30" rows="4"  placeholder="Comment" class="form-control"><?=$test->test_mes?></textarea>
                </div>
                <div class="form-group">
                  <select name="status" id="status" class="form-control">
                    <option <?=$test->status == 0? 'selected' :''?> value="0">Disable</option>
                    <option <?=$test->status == 1? 'selected' :''?> value="1">Enable</option>
                  </select>
                </div>
                <div class="d-flex justify-content-between">
                  <input type="hidden" name="test_dte" value="<?=date('Y-m-d')?>">
                  <div class="rating" data-rating="0">
                    <label>
                      <input type="radio"<?=$test->test_rating == 1 ? 'checked' : ''?> required name="test_rating" value="1">
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                    </label>
                    <label>
                      <input type="radio"<?=$test->test_rating == 2 ? 'checked' : ''?> required name="test_rating" value="2">
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                    </label>
                    <label>
                      <input type="radio"<?=$test->test_rating == 3 ? 'checked' : ''?> required name="test_rating" value="3">
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>   
                    </label>
                    <label>
                      <input type="radio"<?=$test->test_rating == 4 ? 'checked' : ''?> required name="test_rating" value="4">
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                    </label>
                    <label>
                      <input type="radio"<?=$test->test_rating == 5 ? 'checked' : ''?> required name="test_rating" value="5">
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                    </label>
                  </div>
                  <div class="form-group">
                      <input type="date" class="form-control" name="test_dte" value="<?=$test->test_dte?>">
                  </div>

                  <div class="form-group">
                    <button class="btn btn-success">Submit Review</button>
                  </div>
                </div>
          </div>
        </form>
        <?php } elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'add-new') { 
         
          ?>
        <?php echo form_open_multipart('Abrar/testimonials', ['class'=>'card']);?>
          <!-- Left col -->
          <div class="card-header">
            <h3 class="card-title">
              Add Testimonials</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
                <div class="form-group">
                  <input type="text" name='test_name' class="form-control" placeholder="Name" required>
                </div>
                <div class="form-group">
                  <input type="email" name="test_email" class="form-control"  placeholder="Email" required>
                </div>
                <div class="form-group">
                  <textarea name="test_mes" id="" cols="30" rows="4"  placeholder="Comment" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                  <select name="status" id="status" class="form-control" required>
                    <option value="0">Disable</option>
                    <option value="1">Enable</option>
                  </select>
                </div>
                <div class="d-flex justify-content-between">
                  <input type="hidden" name="test_dte" value="<?=date('Y-m-d')?>">
                  <div class="rating" data-rating="0">
                    <label>
                      <input type="radio" required name="test_rating" value="1">
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                    </label>
                    <label>
                      <input type="radio" required name="test_rating" value="2">
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                    </label>
                    <label>
                      <input type="radio" required name="test_rating" value="3">
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>   
                    </label>
                    <label>
                      <input type="radio" required name="test_rating" value="4">
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                    </label>
                    <label>
                      <input type="radio" required name="test_rating" value="5">
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                    </label>
                  </div>
                  <div class="form-group">
                      <input type="date" class="form-control" name="test_dte" value="<?=date('Y-m-d')?>">
                  </div>
                  <div class="form-group">
                    <button class="btn btn-success">Submit Review</button>
                  </div>
                </div>
          </div>
        </form>
        <?php } else {?>
        <div class="card">
          <!-- Left col -->
          <div class="card-header">
            <h3 class="card-title">
              All Testimonials
            </h3>
            <div class="card-tools">
              <a href="?action=add-new"><i class="fa fa-plus mr-1"></i>Add New</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="table_id">
                  <thead>
                    <tr>
                      <th>S.No.</th>
                      <th>Name</th>
                      <th>Comment</th>
                      <th>Rattings</th>
                      <th>Status</th>
                      <th width="12%">Date Added</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $count = 1;
                    $testimonial = $this->db->get('testimonial')->result();
                    foreach ($testimonial as $test) {?>
                      <tr>
                        <td><?=$count++?></td>
                        <td><?=$test->test_name?></td>
                        <td><?=$test->test_mes?></td>
                        <td><?=$test->test_rating?></td>
                        <td><?=$test->status?></td>
                        <td><?=$test->test_dte?></td>
                        <td>
                          <a href="?id=<?=$test->testimonial_id?>&action=edit" class="btn btn-xs btn-info"><i class="fa fa-edit fa-fw"></i></a>
                          <a href="<?=base_url('Abrar/remove/'.$test->testimonial_id.'/testimonial/testimonial_id')?>" class="btn btn-xs btn-danger remove-btn"><i class="fa fa-trash fa-fw"></i></a>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </section>
      
  </div>
  <!-- /.container-fluid -->
  <?=copyrights()?>
  <!-- /.content -->
  
