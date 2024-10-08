    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        
        <?php echo form_open_multipart('Abrar/admindetails', ['class'=>'card']);?>
          <!-- Left col -->
          <div class="card-header">
            <h3 class="card-title">
              About The Admin</h3>
              <?php $admin = $this->db->get('admin')->row();?>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="">Admin Name</label>
                  <input type="text" name="name" class="form-control" placeholder="" value="<?=isset($admin)?$admin->name:''?>">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="">Admin Email</label>
                  <input type="email" name="email" class="form-control" placeholder="" value="<?=isset($admin)?$admin->email:''?>">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="">Facebook Link</label>
                  <input type="url" name="facebook" class="form-control" placeholder="" value="<?=isset($admin)?$admin->facebook:''?>">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="">Instagram Link</label>
                  <input type="url" name="insta" class="form-control" placeholder="" value="<?=isset($admin)?$admin->insta:''?>">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="">Linkedin Link</label>
                  <input type="url" name="linked" class="form-control" placeholder="" value="<?=isset($admin)?$admin->linked:''?>">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="">Pinterest Link</label>
                  <input type="url" name="pin" class="form-control" placeholder="" value="<?=isset($admin)?$admin->pin:''?>">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="">Website Link</label>
                  <input type="url" name="weblink" class="form-control" placeholder="" value="<?=isset($admin)?$admin->weblink:''?>">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="">Website Name</label>
                  <input type="text" name="webname" class="form-control" placeholder="" value="<?=isset($admin)?$admin->webname:''?>">
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </form>
        
        <?php echo form_open_multipart('Abrar/changepassword', ['class'=>'card']);?>
          <!-- Left col -->
          <div class="card-header">
            <h3 class="card-title">
              Change Password</h3>
              <?php $admin = $this->db->get('admin')->row();?>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="">Old Password</label>
                  <input type="password" required name="old" class="form-control" placeholder="Old Password">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="">New Password</label>
                  <input type="password" required name="password" class="form-control" placeholder="New Password" value="">
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <button type="submit" class="btn btn-success">Change</button>
          </div>
        </form>
      </div>
    </section>
      
  </div>
  <!-- /.container-fluid -->
  <?=copyrights()?>
  <!-- /.content -->
  
