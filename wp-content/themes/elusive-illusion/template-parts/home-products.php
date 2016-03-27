<?php
/*
 * @package IllusiveDesign
 * @subpackage Elusive Illusion
 * @since Elusive Illusion 1.0
 */
global $eli_options;
$products = get_eli_products();
//wpprint($products);
if(!empty($products)):
?>
<section id="products-block" class="page-block clearfix">
  <div class="<?php theme_layout_style(); ?>">
    <div class="row">
      <div class="col-xs-12">
        <h3 class="block-title"><?php echo $eli_options['product_block_title'] ?></h3>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-9">
        <div class="row products-grid">
          <?php foreach ($products as $key => $product):
            if(empty($product->featured)) continue; 
            ?>
          <div class="col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-0 col-md-4 product-gcol">
            <div class="thumbnail product-thumb">
              <img src="<?php echo $product->icon ?>" alt="<?php echo $product->title ?>">
              <div class="caption">              
                <p><?php echo ($product->subtitle)? $product->subtitle:$product->title; ?></p>               
              </div>
              <a class="thumbnail-links" href="<?php echo $product->url ?>"></a>
            </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    
    </div>
  </div>
</section>
<?php endif;?>

