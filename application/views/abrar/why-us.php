    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        
        <?php echo form_open_multipart('Abrar/whyus', ['class'=>'card']);?>
          <!-- Left col -->
          <div class="card-header">
            <h3 class="card-title">
              Why Book With Us
              
            </h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#whyus-modal"><i class="fas fa-plus"></i> Add New
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <?php 
            $count = 1;
            foreach ($this->logics->whyUs() as $value) { ?>
            <div class="form-group">
              <label for="">Why Us-<?=$count?></label>
              <input type="text" name="whyus[<?=$count?>]" value="<?=$value->title?>" class="form-control" placeholder="Enter Reason">
            </div>
            <?php $count++; } ?>
          </div>

          <div class="card-footer">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </form>
      </div>
    </section>
      <div class="modal fade" id="whyus-modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header rounded">
							<h5 class="modal-title">
                Add New Why Us
							</h5>
							<span type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</span>
						</div>
            <form class="modal-body" action="<?=base_url('Abrar/whyus/insert')?>" method="POST">
              <div class="form-group">
                <label for="">Why Us</label>
                <input type="text" name="title" class="form-control" placeholder="Enter Reason">
              </div>
              <div class="form-group text-center">
                <button type="submit" class="btn btn-success">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>  
    </div>
  <!-- /.container-fluid -->
  <?=copyrights()?>
  <!-- /.content -->
  
