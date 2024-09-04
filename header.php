<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<?php wp_head(); ?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-57RDJ8PK');</script>
<!-- End Google Tag Manager -->
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
<div>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-57RDJ8PK"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
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