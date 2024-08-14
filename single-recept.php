<?php
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) :
			the_post();
			
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
					<h3>Receptet innehåller</h3>
				<?php
				foreach($product_ids as $product_id) {
					$product = wc_get_product($product_id);
					echo($product->get_title());
				}
			}
			


		endwhile;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
