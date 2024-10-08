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
              $product_id = $coupon->products;
              $startDate = $coupon->startDate;
              $endDate = $coupon->endDate;
              $status = $coupon->status;
          }
          else
          {
              $code = $discount = $amount = $product_id = $startDate = $endDate = $status = '';
          }
          ?>
          <form action="<?=base_url('Abrar/addCoupan/'.$id)?>" method="POST">
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
                    <input type="text" name="promo" placeholder="Promotion Message" class='form-control' required >
                  </div>
                  <div class="form-group">
                    <label>Coupon Code</label>
                    <input type="text" name="code" placeholder="Coupon Code" class='form-control' value="<?=$code?>">
                  </div>
                  <div class="form-group">
                    <label>Select Coupon Type</label>
                    <select class="form-control" name="type">
                      <option>Percentage</option>
                      <option>Fixed Price</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Discount</label>
                    <input type="text" name="discount" placeholder="Discount" class='form-control' value="<?=$discount?>">
                  </div>
                  <div class="form-group">
                    <label>Minimum Order Amount</label>
                    <input type="text" name="amount" placeholder="Amount" class='form-control' value="<?=$amount?>">
                  </div>
                  <div class="form-group">
                    <label>Start Date</label>
                    <input type="date" name="startDate" placeholder="Amount" class='form-control' value="<?=$startDate?>">
                  </div>
                  <div class="form-group">
                    <label>End Date</label>
                    <input type="date" name="endDate" placeholder="Amount" class='form-control' value="<?=$endDate?>">
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                      <option <?=$status == 'Enable' ? 'seleceted':''?>>Enable</option>
                      <option <?=$status == 'Disable' ? 'seleceted':''?>>Disable</option>
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