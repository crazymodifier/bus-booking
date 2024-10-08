    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <style>
          .custom-select
          {
            background:none;
          }
        </style>
        <div class="card">
          <!-- Left col -->
          <div class="card-header">
            <h3 class="card-title">
              All Customers
            </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="table_id">
                  <thead>
                    <tr>
                      <th>S.No.</th>
                      <th>Customer Name</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th width="12%">Date Added</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $count = 1;
                    $customers = $this->db->order_by('id desc')->get('customer')->result();
                    foreach ($customers as $customer) {?>
                      <tr>
                        <td><?=$count++?></td>
                        <td><?=$customer->name?></td>
                        <td><?=$customer->email?></td>
                        <td><?=$customer->status ? '<span class="badge badge-success">Verified</span>':'<span class="badge badge-warning">Pending</span>'?></td>
                        <td><?=$customer->date_add?></td>
                        <td><a href="<?=base_url('Abrar/remove/'.$customer->id.'/customer')?>" class="btn btn-danger remove-btn"><i class="fa fa-trash"></i></a></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
          </div>
        </div>
      </div>
    </section>
      
  </div>
  <!-- /.container-fluid -->
  <?=copyrights()?>
  <!-- /.content -->
  
