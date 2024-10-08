    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        
        <?php
          if (isset($_GET['id'])) {
            $variation = $this->db->where('id', $_GET['id'])->get('package_variation')->row();
            $id=$_GET['id'];
            $package = $this->db->where('variation_id', 'HOHOBT32_var'.$_GET['id'])->where('tourist_type', 'ADULT')->get('hop_package')->row();
          }
          else {
            $id ='';
          }
          echo form_open_multipart('Abrar/packages/'.$id, ['class'=>'card']);?>
          <!-- Left col -->
          <div class="card-header">
            <h3 class="card-title">
              Tour Packages
            </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="form-group">
              <label for="">Title</label>
              <input type="text" name="variation_name" class="form-control" placeholder="Enter Variation Name" value="<?=isset($variation)?$variation->variation_name:''?>">
              <input type="hidden" name="tour_id" value="32">
            </div>
            <div class="form-group">
              <label for="currency">Tour Currency</label>
              <select required="" name="currency" id="currency" class="form-control">
                <option <?=$variation->currency == 0 ?'selected' : ''?> value="0">US Dollar</option>
                <option <?=$variation->currency == 2 ?'selected' : ''?> value="2">EURO</option>
                <option <?=$variation->currency == 1 ?'selected' : ''?> value="1">British Pound</option>
                <option <?=$variation->currency == 3 ?'selected' : ''?> value="3">Australian Dollar</option>
                <option <?=$variation->currency == 5 ?'selected' : ''?> value="5">Singapore Dollar</option>
                <option <?=$variation->currency == 4 ?'selected' : ''?> value="4">Canadian Dollar</option>
                <option <?=$variation->currency == 6 ?'selected' : ''?> value="6">Hong Kong Dollar</option>
                <option <?=$variation->currency == 8 ?'selected' : ''?> value="8">Indian Rupees</option>
              </select>
            </div>
            <div class="row">
              <div class="col-lg">
                <label for="sun" class="">
                  <input type="checkbox" value="1" <?=isset($variation)?($variation->sun == 1 ? 'checked' : ''):''?> name="sun" id="sun" class="mr-2">
                  Sunday
                </label>
              </div>
              <div class="col-lg">
                <label for="mon" class="">
                  <input type="checkbox" value="1" <?=isset($variation)?($variation->mon == 1 ? 'checked' : ''):''?> name="mon" id="mon" class="mr-2">
                  Monday
                </label>
              </div>
              <div class="col-lg">
                <label for="tue" class="">
                  <input type="checkbox" value="1" <?=isset($variation)?($variation->tue == 1 ? 'checked' : ''):''?> name="tue" id="tue" class="mr-2">
                  Tuesday
                </label>
              </div>
              <div class="col-lg">
                <label for="wed" class="">
                  <input type="checkbox" value="1" <?=isset($variation)?($variation->wed == 1 ? 'checked' : ''):''?> name="wed" id="wed" class="mr-2">
                  Wednesday
                </label>
              </div>
              <div class="col-lg">
                <label for="thu" class="">
                  <input type="checkbox" value="1" <?=isset($variation)?($variation->thu == 1 ? 'checked' : ''):''?> name="thu" id="thu" class="mr-2">
                  Thursday
                </label>
              </div>
              <div class="col-lg">
                <label for="fri" class="">
                  <input type="checkbox" value="1" <?=isset($variation)?($variation->fri == 1 ? 'checked' : ''):''?> name="fri" id="fri" class="mr-2">
                  Friday
                </label>
              </div>
              <div class="col-lg">
                <label for="sat" class="">
                  <input type="checkbox" value="1" <?=isset($variation)?($variation->sat == 1 ? 'checked' : ''):''?> name="sat" id="sat" class="mr-2">
                  Saturday
                </label>
              </div>
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
  
