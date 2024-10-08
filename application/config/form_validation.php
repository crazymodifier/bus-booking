<?php
  $config = array(
    'listing' => array(
      array(
        'field' => 'product_price',
        'label' => 'Product Price',
        'rules' => 'required|numeric',
        'errors'=> array(
          'required' => '%s Must be field',
          'numeric' => '%s allowed only numeric values'
        )
      ),
      array(
        'field' => 'product_weight',
        'label' => 'Product Weight',
        'rules' => 'required|numeric',
        'errors'=> array(
          'required' => '%s Must be field',
          'numeric' => '%s allowed only numeric values'
        )
      )
    )
  );  
  $config['error_prefix'] = '<div class="alert alert-danger alert-dismissible d-block fade show" role="alert"><i class="fa fa-exclamation-circle mr-2"></i>';
  $config['error_suffix'] = '<span type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </span>
</div>';
?>