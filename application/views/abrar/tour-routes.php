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
        
        <?php 
        if(isset($_REQUEST['action'])){
        
        
        if(isset($_REQUEST['id']) && $_REQUEST['action'] == 'edit')
        {
            $route = $this->db->where('id', $_REQUEST['id'])->get('tour_routes')->row();
        }
        echo form_open_multipart('Abrar/tour_routes'.(isset($route)?'/'.$route->id:''), ['class'=>'card']);
        ?>
          <div class="card-header">
              <h3 class="card-title">
                  Tour Routes
              </h3>
          </div>
          <div class="card-body">
              <div class="row">
                  <div class="col-lg-8">
                      
                      <div class="form-group">
                          <label for="">Route Name</label>
                          <input type="text" name="name" class="form-control" placeholder="Enter Route Name" value="<?=isset($route)?$route->name:''?>">
                      </div>
                      <div class="form-group">
                          <label for="">Route Schedule</label>
                          <input type="text" name="schedule" class="form-control" placeholder="Enter Route Schedule" value="<?=isset($route)?$route->schedule:''?>">
                      </div>
                      <div class="form-group">
                          <label for="">Route Loop Time</label>
                          <input type="text" name="loop_time" class="form-control" placeholder="Enter Route Loop Time" value="<?=isset($route)?$route->loop_time:''?>">
                      </div>
                      <div class="form-group">
                          <label for="">Route Frequency</label>
                          <input type="text" name="frequency" class="form-control" placeholder="Enter Route Frequency" value="<?=isset($route)?$route->frequency:''?>">
                      </div>
                      <div class="form-group">
                          <label for="">Route Color</label>
                          <input type="color" name="color" class="form-control" placeholder="Enter Route Color" value="<?=isset($route)?$route->color:''?>">
                      </div><div class="form-group">
                          <label for="">Route Icon</label>
                          <input type="text" name="icon" class="form-control" placeholder="Enter Route Icon" value="<?=isset($route)?$route->icon:''?>">
                      </div>
                      <div class="form-group">
                          <label for="">Route Content</label>
                          <textarea name="content" class="textarea"><?=isset($route)?$route->content:''?></textarea>
                      </div>
                  
                  </div>
                  <div class="col-lg-4">
                      <label for="">Route Map</label>
                      <div class='border'>
                        <input type="file" name="images" id="route-image" class="d-none file-upload" accept="image/*">
                        <label for="route-image" id="image" class="d-flex mb-0" style="height:300px">
                          <?php if(isset($route))
                          {
                              echo'<img src="'.base_url('dist/uploads/').$route->map.'" alt="Add Images" class="w-100"> ';
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
                      <th>Name</th>
                      <th>Schedule</th>
                      <th>Content</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $count= 1;
                      $routes = $this->db->get('tour_routes')->result();
                      foreach($routes as $route){
                    ?>
                    <tr>
                        <td><?=$count++?></td>
                        <td><?=$route->name?></td>
                        <td><?=$route->schedule?></td>
                        <td><?=$route->content?></td>
                        <td>
                            <a href="?action=edit&id=<?=$route->id?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
                            <a href="<?=base_url('Abrar/remove/'.$route->id.'/tour_routes')?>" class="btn btn-danger remove-btn"><i class="fa fa-trash"></i></a>
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
  
