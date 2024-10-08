<!-- Default box -->
  <div class="p-3">
    <div class="">
        <div class="mb-3">
          <div class="row">
            <div class="col-sm-6">
              <h3 class="d-inline-block d-sm-none"><?=$products->product_name?></h3>
              <div class="col-12">
                <img src="dist/uploads/<?=$products->product_front_img?>" class="product-image img-thumbnail object-contain-center" alt="Product Image" height="400">
              </div>
              <div class="col-12 product-image-thumbs">
                <div class="product-image-thumb active"><img src="dist/uploads/<?=$products->product_front_img?>" alt="Product Image"></div>
                <?php
                if ($products->product_back_img) {?>
                <div class="product-image-thumb" ><img src="dist/uploads/<?=$products->product_back_img?>" alt="Product Image"></div>
                <?php } elseif ($products->product_set_img) {?>
                <div class="product-image-thumb" ><img src="dist/uploads/<?=$products->product_set_img?>" alt="Product Image"></div>
                <?php } ?>
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="mb-2"><?=$products->product_name?></h3>
              <p class="mb-2"><?=$products->product_description?></p>
              <h3 class="mb-0"><small>
              <?php 
              if ($products->offer) 
              {
                echo'<span class="text-muted"><del><i class="fa fa-rupee-sign fa-xs mr-1"></i>'.number_format($products->old_price,2).'</del></span>';
                echo('<span class="text-success mx-2 fa-xs">'.$products->offer.'% Off</span>');
              }?>
              </small></h3>
              <h3 class="mb-0"><small><i class="fa fa-rupee-sign mr-2 fa-sm"></i><?=number_format($products->product_price,2) .' + '.$products->product_gst ?>% GST</small></h3>
              <hr>
              <div class="card card-orange card-outline">
                <div class="card-header">
                  Product Details
                </div>
                <div class="card-body p-0">
                  <table class="table">
                    <tr>
                      <th>Category</th>
                      <td><a href="all?q=<?=$products->product_category?>"><?=$products->product_category?></a></td>
                    </tr>
                    <tr>
                      <th>Fabric</th>
                      <td><?=$products->product_fabric?></td>
                    </tr>
                    <tr>
                      <th>Clothes Design</th>
                      <td><?=$products->product_design?></td>
                    </tr>
                    <tr>
                      <th>Color</th>
                      <td><a href=""><?=$products->product_color?></a></td>
                    </tr>
                    <tr>
                      <th>Size</th>
                      <td><?=$products->product_size?></td>
                    </tr>
                    <tr>
                      <th>Ideal For</th>
                      <td><a href=""><?=$products->product_for?></a></td>
                    </tr>
                  </table>
                </div>
              </div>
              
              <form action="Checkout/addToCart" method="POST">
                <input type="hidden" name="id" value="<?=bin2hex($products->product_id)?>">
                <?php 
                if ($products->product_stock > 0) {?>
                <p class="mb-2"><b>Note: </b>Please order between <?=$products->product_min?> and <?=$products->product_max < $products->product_stock ? $products->product_max : $products->product_stock ?> products. </p>
                <div class="mt-2 d-flex">
                  <input type="number" name="qty" id="qty" value="<?=$products->product_min?>" min="<?=$products->product_min?>" max="<?=$products->product_max < $products->product_stock ? $products->product_max : $products->product_stock ?>"  class="form-control w-25" placeholder="Quantity">
                  <button class="btn btn-success mx-2">
                    <i class="fas fa-shopping-cart mr-2"></i> 
                    Buy Now
                  </button>
                </div>
                <?php } else { ?>
                <h2 class="text-danger">Out Of Stock</h2>
                <?php } ?>
              </form>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      <?php $related = $this->products->categoryProducts($products->product_category ,25, 'Activated',0);?>
      
      <section>
        <div class="card rounded-0">
          <div class="card-body">
            <div class="mb-3">
              <h3>Related Products</h3>
            </div>
            <div>
            <div class="slider-5">
              <?php
                foreach ($related as $product) { 
                ?>
              <div class="p-2 pb-3 h-100">
                <a href="products?name=<?=urlencode($product->product_name)?>&id=<?=bin2hex($product->product_id)?>">
                  <div class="card h-100 mb-0">
                    <?php
                    if ($product->offer) {
                      echo'<div class="ribbon-wrapper">
                      <div class="ribbon bg-warning">
                      '.$product->offer.' % Off
                      </div>
                    </div>';
                    }
                    ?>
                    <div class="card-image">
                      <img src="dist/uploads/<?=$product->product_front_img?>" alt="" height="250" class="w-100 rounded-top">
                    </div>
                    <div class="card-body px-2 py-1">
                      <div class="text-truncate"><?=$product->product_name?></div>
                    </div>
                    <div class="pb-2 px-2 d-flex justify-content-between">
                      <div style="line-height:1">
                      <?php 
                      if ($product->offer) 
                      {
                        echo'<span><i class="fa fa-rupee-sign fa-xs mr-1"></i>'.number_format($product->product_price,2).'</span><br>
                        <span class="text-muted"><del><i class="fa fa-rupee-sign fa-xs mr-1"></i>'.number_format($product->old_price,2).'</del></span>';
                      }
                      else {
                        echo'<span><i class="fa fa-rupee-sign fa-xs mr-1"></i>'.number_format($product->product_price,2).'</span>';
                      }?>
                      </div>            
                      <span class="btn btn-success btn-sm"><i class="fa fa-shopping-cart fa-xs mr-1"></i>Buy Now</span>
                    </div>
                  </div>
                </a>
              </div>
              <?php } ?>
            </div>
            </div>
          </div>
        </div>
      </section> 

      <section>
        <div class="card rounded-0">
          <div class="card-body">
            <div class="mb-3">
              <h3>Featured Products</h3>
            </div>
            <div>
            <div class="slider-5">
              <?php
                $featured = $this->db->where('product_status','Activated')->where('product_tranding', 1)->limit(25,0)->get('products')->result();
                foreach ($featured as $product) {
                ?>
              <div class="p-2 pb-3 h-100">
                <a href="products?name=<?=urlencode($product->product_name)?>&id=<?=bin2hex($product->product_id)?>">
                  <div class="card h-100 mb-0">
                    <?php
                    if ($product->offer) {
                      echo'<div class="ribbon-wrapper">
                      <div class="ribbon bg-warning">
                      '.$product->offer.' % Off
                      </div>
                    </div>';
                    }
                    ?>
                    <div class="card-image">
                      <img src="dist/uploads/<?=$product->product_front_img?>" alt="" height="250" class="w-100 rounded-top">
                    </div>
                    <div class="card-body px-2 py-1">
                      <div class="text-truncate"><?=$product->product_name?></div>
                    </div>
                    <div class="pb-2 px-2 d-flex justify-content-between">
                      <div style="line-height:1">
                      <?php 
                      if ($product->offer) 
                      {
                        echo'<span><i class="fa fa-rupee-sign fa-xs mr-1"></i>'.number_format($product->product_price,2).'</span><br>
                        <span class="text-muted"><del><i class="fa fa-rupee-sign fa-xs mr-1"></i>'.number_format($product->old_price,2).'</del></span>';
                      }
                      else {
                        echo'<span><i class="fa fa-rupee-sign fa-xs mr-1"></i>'.number_format($product->product_price,2).'</span>';
                      }?>
                      </div>            
                      <span class="btn btn-success btn-sm"><i class="fa fa-shopping-cart fa-xs mr-1"></i>Buy Now</span>
                    </div>
                  </div>
                </a>
              </div>
              <?php } ?>
            </div>
            </div>
          </div>
        </div>
      </section>    
    </div>
  </div>
  <!-- /.card -->