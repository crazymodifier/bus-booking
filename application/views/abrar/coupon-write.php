<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-outline card-orange">
          <div class="card-header">
            <h3 class="card-title">
              Coupon Control Panel
            </h3>
          </div>
          <?php 
          $id = isset($_GET['id']) ? $_GET['id'] :'';
          $coupon = $this->db->where('id', $id)->get('coupon')->row();
          if($coupon)
          {
              $code = $coupon->code;
              $discount = $coupon->discount;
              $amount = $coupon->amount;
              $startDate = $coupon->startDate;
              $endDate = $coupon->endDate;
              $status = $coupon->status;
              $promo = $coupon->promo;
          }
          else
          {
              $code = $discount = $amount = $product_id = $startDate = $endDate = $status = $promo='';
          }
          ?>
          <form action="<?=base_url('Abrar/addCoupon/'.$id)?>" method="POST">
            <div class="card-body">
              <div class="card">
                <div class="card-header bg-light">
                  <h3 class="card-title">
                    Add & Update Coupons
                  </h3>
                </div>
                <div class="card-body"> 
                  <div class="form-group">
                    <label>Promotion Message</label>
                    <input type="text" name="promo" placeholder="Promotion Message" class='form-control' required value="<?=$promo?>">
                  </div>
                  <div class="form-group">
                    <label>Coupon Code</label>
                    <input type="text" name="code" placeholder="Coupon Code" class='form-control' required value="<?=$code?>">
                  </div>
                  <div class="form-group">
                    <label>Select Coupon Type</label>
                    <select class="form-control" name="type" required>
                      <option>Percentage</option>
                      <option>Fixed Price</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Discount</label>
                    <input type="text" name="discount" required placeholder="Discount" class='form-control' value="<?=$discount?>">
                  </div>
                  <div class="form-group">
                    <label>Minimum Order Amount</label>
                    <input type="text" name="amount" required placeholder="Amount" class='form-control' value="<?=$amount?>">
                  </div>
                  <div class="form-group">
                    <label>Start Date</label>
                    <input type="date" name="startDate" required placeholder="Amount" class='form-control' value="<?=$startDate?>">
                  </div>
                  <div class="form-group">
                    <label>End Date</label>
                    <input type="date" name="endDate" required placeholder="Amount" class='form-control' value="<?=$endDate?>">
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status" required>
                      <option <?=$status == 'Enable' ? 'selected':''?>>Enable</option>
                      <option <?=$status == 'Disable' ? 'selected':''?>>Disable</option>
                    </select>
                  </div>
                </div>
                <div class="card-footer">
                  <button class="btn btn-success">Apply Now</button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
  <!-- /.container-fluid -->
  <?=copyrights()?>
  <!-- /.content -->