    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        
        <?php echo form_open_multipart('Abrar/about', ['class'=>'card']);?>
          <!-- Left col -->
          <div class="card-header">
            <h3 class="card-title">
              SEO Management</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="form-group">
              <label for="">Title</label>
              <input type="text" name="title" class="form-control" placeholder="Enter Page Title" value="<?=isset($about)?$about->title:''?>">
            </div>
            <!--<div class="form-group">-->
            <!--  <label for="">Meta Title</label>-->
            <!--  <input type="text" name="metaTitle" class="form-control" placeholder="Enter Page Meta Title" value="<?=isset($about)?$about->metaTitle:''?>">-->
            <!--</div>-->

            <div class="form-group">
              <label for="">Meta Keywords</label>
              <textarea name="metaKeywords" id="meta_keywords" cols="30" rows="3" class="form-control"  placeholder="Enter Meta Keywords"><?=isset($about)?$about->metaKeywords:''?></textarea>  
            </div>

            <div class="form-group">
              <label for="">Meta Description</label>
              <textarea name="metaDescription" id="meta_description" cols="30" rows="5" class="form-control"  placeholder="Enter Meta Description"><?=isset($about)?$about->metaDescription:''?></textarea>  
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
  
