    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        
        <?php echo form_open_multipart('Abrar/about', ['class'=>'card']);?>
          <!-- Left col -->
          <div class="card-header">
            <h3 class="card-title">
              About The City</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="form-group">
              <label for="">Title</label>
              <textarea  name="heading" class="textarea" placeholder="Enter City Title"><?=isset($about)?$about->heading:''?></textarea>
            </div>
            <div class="form-group">
              <label for="">Content</label>
              <textarea class="textarea" name="content" placeholder="Content"><?=isset($about)?$about->content:''?></textarea>
            </div>
          </div>

          <div class="card-footer">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </form>
      </div>
    </section>
      
  </div>
  <!-- /.container-fluid -->
  <?=copyrights()?>
  <!-- /.content -->
  
