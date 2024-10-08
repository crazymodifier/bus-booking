<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-outline card-orange">
          <div class="card-header">
            <h3 class="card-title">
              Coupon Code
            </h3>
            <div class="card-tools">
              <a href="coupan-write" class="btn btn-xs btn-success">Add New</a>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Promo Message</th>
                    <th>Coupon Code</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Discount</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $count = 1;
                  $coupons = $this->db->get('coupon')->result();
                  foreach ($coupons as $coupon) {?>
                  <tr>
                    <td><?=$count++?></td>
                    <td><?=$coupon->promo?></td>
                    <td><?=$coupon->code?></td>
                    <td><?=$coupon->startDate?></td>
                    <td><?=$coupon->endDate?></td>
                    <td><?=$coupon->discount?> (<?=$coupon->type?>)</td>
                    <td><?=$coupon->status?></td>
                    <td>
                      <a href="coupon-write?id=<?=$coupon->id?>&action=view" class="btn btn-warning btn-sm"><i class="fa-sm fa fa-eye fa-fw"></i></a>
                      <a href="coupon-write?id=<?=$coupon->id?>" class="btn btn-info btn-sm"><i class="fa-sm fa fa-pen fa-fw"></i></a>
                      <a href="<?=base_url('Abrar/remove/'.$coupon->id.'/coupon')?>" class="btn btn-danger btn-sm remove-btn"><i class="fa-sm fa fa-trash fa-fw"></i></a>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
  <!-- /.container-fluid -->
  <?=copyrights()?>
  <!-- /.content -->