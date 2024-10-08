    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        
        <?php echo form_open_multipart('Abrar/addTour', ['class'=>'card']);?>
          <!-- Left col -->
          <div class="card-header">
            <h3 class="card-title">
              Tour Content</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            
            <div class="form-group">
              <label for="">Tour Name</label>
              <textarea class="textarea" name="name" placeholder="Place some text here"><?=isset($tour)?$tour->name:''?></textarea>
            </div>
            <div class="form-group">
              <label for="">Tour Overview</label>
              <textarea class="textarea" name="overview" placeholder="Place some text here"><?=isset($tour)?$tour->overview:''?></textarea>
            </div>
            <div class="form-group">
              <label for="">Tour Description</label>
              <textarea class="textarea" name="description" placeholder="Place some text here"><?=isset($tour)?$tour->description:''?></textarea>
            </div>
            <div class="form-group">
              <label for="">Tour Highlights</label>
              <textarea class="textarea" name="highlights" placeholder="Place some text here"><?=isset($tour)?$tour->highlights:''?></textarea>
            </div>
            <div class="form-group">
              <label for="">Tour Schedule</label>
              <textarea class="textarea" name="schedule" placeholder="Place some text here"><?=isset($tour)?$tour->schedule:''?></textarea>
            </div>
            <div class="form-group">
              <label for="">Tour Inclusions</label>
              <textarea class="textarea" name="inclusion" placeholder="Place some text here"><?=isset($tour)?$tour->inclusion:''?></textarea>
            </div>
            <div class="form-group">
              <label for="">Tour Exclusions</label>
              <textarea class="textarea" name="exclusion" placeholder="Place some text here"><?=isset($tour)?$tour->exclusion:''?></textarea>
            </div>
            <div class="form-group">
              <label for="">Tour Important Info</label>
              <textarea class="textarea" name="important" placeholder="Place some text here"><?=isset($tour)?$tour->important:''?></textarea>
            </div>
            <div class="form-group">
              <label for="">Tour Cancellation Policy</label>
              <textarea class="textarea" name="cancellation" placeholder="Place some text here"><?=isset($tour)?$tour->cancellation:''?></textarea>
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
  
