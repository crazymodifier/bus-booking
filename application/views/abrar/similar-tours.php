    <style>
          .custom-select
          {
            background:none;
          }
        </style>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="card">
              <div class="card-body">
                  <?php 
                  if(isset($_POST['update']))
                  {
                      $this->db->where('location', 'similar-tours')->update('headings',['heading' => $this->input->post('heading'),'button' => $this->input->post('button'),'url' => $this->input->post('url')]);
                      $this->session->set_flashdata('success','Updated');
                  }
                  $testi = $this->db->where('location', 'similar-tours')->get('headings')->row(); ?>
                  <form class="row" action="" method="POST">
                      <div class="col-12">
                          <label>Heading</label>
                          <div class="form-group mb-0">
                              
                              <!--<input type="text" class="form-control" value="<?=$testi->heading?>" name="heading" >-->
                              <textarea class="textarea" name="heading"><?=$testi->heading?></textarea>
                          </div>
                      </div>
                      <div class="col-12">
                          <label>Button</label>
                          <div class="form-group mb-0">
                              
                              <input type="text" class="form-control" value="<?=$testi->button?>" name="button" >
                              <!--<textarea class="textarea" name="button"><?=$testi->button?></textarea>-->
                          </div>
                      </div>
                      <div class="col-12">
                          <label>Link</label>
                          <div class="form-group">
                              
                              <input type="url" class="form-control" value="<?=$testi->url?>" name="url" >
                          </div>
                      </div>
                      <div class="col-12">
                          <button name="update"class="btn btn-success">Update</button>
                      </div>
                  </form>
              </div>
        </div>
        <?php 
        if(isset($_REQUEST['action'])){
        
        
        if(isset($_REQUEST['id']) && $_REQUEST['action'] == 'edit')
        {
            $tours = $this->db->where('id', $_REQUEST['id'])->get('similar_tours')->row();
        }
        echo form_open_multipart('Abrar/similar_tours'.(isset($tours)?'/'.$tours->id:''), ['class'=>'card']);
        ?>
          <div class="card-header">
              <h3 class="card-title">
                  Similar Tours
              </h3>
          </div>
          <div class="card-body">
              <div class="row">
                  <div class="col-lg-8">
                      
                      <div class="form-group">
                          <label for="">Title</label>
                          <input type="text" name="title" class="form-control" placeholder="Enter Title" value="<?=isset($tours)?$tours->title:''?>">
                      </div>
                      <div class="form-group">
                          <label for="">URL</label>
                          <input type="url" name="url" class="form-control" placeholder="Enter URL" value="<?=isset($tours)?$tours->url:''?>">
                      </div>
                      <div class="form-group">
                          <label for="">Activities</label>
                          <input type="number" name="activities" class="form-control" placeholder="Enter Activities" value="<?=isset($tours)?$tours->activities:''?>">
                      </div>
                  </div>
                  <div class="col-lg-4">
                      <label for="">Tour Image</label>
                      <div class='border'>
                        <input type="file" name="images" id="route-image" class="d-none file-upload" accept="image/*">
                        <label for="route-image" id="image" class="d-flex mb-0" style="height:300px">
                          <?php if(isset($tours))
                          {
                              echo'<img src="'.base_url('dist/uploads/').$tours->image.'" alt="Add Images" class="w-100"> ';
                          }
                          else{ ?>
                          <span class="fa-stack fa-3x m-auto">
                            <i class="fa fa-circle fa-stack-2x text-secondary" aria-hidden="true"></i>
                            <i class="fa fa-plus fa-stack-1x fa-inverse" aria-hidden="true"></i>
                          </span>
                          <?php } ?>
                        </label>
                      </div>
                  </div>
              </div>
          </div>
        <div class="card-footer">
            <button class="btn btn-success">Submit</button>
        </div>
        </form>
        
        <?php } else { ?>
        <div class="card">
        <!-- Left col -->
          <div class="card-header">
            <h3 class="card-title">
              Tour Routes</h3>
            <div class="card-tools">
                <a href="?action=add-new" class="text-sm"><i class="fa fa-plus mr-2"></i>Add New</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="table_id">
                  <thead>
                    <tr>
                      <th>S.no.</th>
                      <th>Image</th>
                      <th>Title</th>
                      <th>Activities</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $count= 1;
                      $tours = $this->db->get('similar_tours')->result();
                      foreach($tours as $tour){
                    ?>
                    <tr>
                        <td><?=$count++?></td>
                        <td style="max-width:100px"><?php echo'<img src="'.base_url('dist/uploads/').$tour->image.'" alt="'.$tour->image.'" class="w-100" > ';?></td>
                        <td><?=$tour->title?></td>
                        <td><?=$tour->activities?></td>
                        <td>
                            <a href="?action=edit&id=<?=$tour->id?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
                            <a href="<?=base_url('Abrar/remove/'.$tour->id.'/similar_tours')?>" class="btn btn-danger remove-btn"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php }?>
                  </tbody>
                </table>
              </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </section>
  </div>
  <!-- /.container-fluid -->
  <?=copyrights()?>
  <!-- /.content -->
  
