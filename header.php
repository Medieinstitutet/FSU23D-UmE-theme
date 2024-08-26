<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
<div>
    <?php
        $line_items = WC()->cart->get_cart_contents();

        $collections = array();

        foreach($line_items as $line_item) {
            //var_dump($line_item);
            $product_id = $line_item['product_id'];
            
            $fromCollection = 0;
            if(isset($line_item['fromCollection'])) {
                $fromCollection = $line_item['fromCollection'];
            }

            if(!isset($collections[$fromCollection])) {
                $collections[$fromCollection] = array();
            }
            
            $collections[$fromCollection][] = array('product_id' => $product_id, 'quantity' => $line_item['quantity']);


            
        }

        foreach($collections as $collection_id => $line_items) {
            if($collection_id !== 0) {
                ?><h3><a href="<?php echo(get_permalink($collection_id)); ?>">Produkter från receptet <?php
                    $current_post = get_post($collection_id);
                    echo($current_post->post_title);
                ?></a></h3><?php
            }
            else {
                ?><h3>Produkter utan kollektion</h3><?php
            }

            foreach($line_items as $line_item) {
                ?><div>
                    <?php echo($line_item['quantity']); ?>x 
                    <?php
                        $product_id = $line_item['product_id'];
                        $product = wc_get_product($product_id);
                        ?><a href="<?php echo(get_permalink($product_id)); ?>">
                            <?php echo($product->get_title()); ?>
                         </a>
                </div><?php
            }
        } 
    ?>
</div>