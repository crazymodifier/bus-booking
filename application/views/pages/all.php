<main>
  
    <?php
      if(isset($_GET['q']))
      {
        $products= $this->db->from('products')
              ->like('product_for', $_GET['q'],'none')
              ->or_like('product_type', $_GET['q'])
              ->or_like('product_category', $_GET['q'])
              ->or_like('product_color', $_GET['q'].'__', 'after')
              ->or_like('product_style', $_GET['q'])
              ->or_like('product_name', $_GET['q'])
              ->get()->result();?>
      <div class="container-fluid py-5">
        <div class="row">
            <?php
            if($products)
            {
              foreach ($products as $product) { 
                if($product->product_status == 'Activated'){
                ?>
              <div class="p-2 pb-3 h-100 col-md-2">
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
              <?php } }
            }
            else
            {
              echo '<div class="col-12 display-3 text-center">
                <i class="far fa-frown fa-lg"></i><br>
              No Results Found</div>';
            } 
            echo'</div>
      </div>';
            }
            else
            {
              echo '<div class="container py-5">'.$content.'</div>';
            }?>
        
            
</main>