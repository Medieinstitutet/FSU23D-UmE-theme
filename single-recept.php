<?php
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) :
			the_post();

			if($_SERVER['REQUEST_METHOD'] === 'POST') {
				
				$post_id = $post->ID;
				
				$product_ids = json_decode(wp_unslash($_POST['products']), true);
				//$product_ids = get_post_meta(get_the_ID(), 'includedProducts', true);

				foreach($product_ids as $product_id) {
					WC()->cart->add_to_cart( $product_id , 1, 0, array(), array('fromCollection' => $post_id));
				}
			}
			
			?>
				<a href="<?php echo(get_home_url(null, 'recept/')); ?>">Recept</a>
				<h1>
					<?php the_title(); ?>
				</h1>
			<?php
			the_content();

			$terms = get_the_terms( $post->ID, 'main_protein' );

if ( $terms && ! is_wp_error( $terms ) ) : 
    $main_proteins = array();

    foreach ( $terms as $term ) {
        $main_proteins[] = '<a href="'.get_term_link($term).'">'.$term->name.'</a>';
    }
    echo implode( ', ', $main_proteins );
endif;
			

			$product_ids = get_post_meta(get_the_ID(), 'includedProducts', true);
			
			if(!empty($product_ids)) {
				?>
					<h3><?php _e("Recipe contains", "mt") ?></h3>
				<?php
				$total_price = 0;
				foreach($product_ids as $product_id) {
					$product = wc_get_product((int)$product_id);
					echo($product->get_title());
					$total_price += (float)$product->get_price();
				}

				?>
					<form method="POST">
						<input type="hidden" name="products" value="<?php echo(esc_attr(json_encode($product_ids))); ?>" />
						<input type="submit" value="Köp alla produkter" />
						<?php echo(wc_price($total_price)); ?>
					</form>
				<?php
			}
			


		endwhile;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
