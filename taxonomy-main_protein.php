<?php
	get_header(); 

	$term = get_queried_object();
    $term_name = $term->name;
	$term_description = term_description( $term->term_id, $term->taxonomy );
?>

<h1>Recept med huvudprotein <?php echo(esc_html($term_name)); ?></h1>
<div class="description">
<?php echo($term_description); ?>
</div>
<?php
		while ( have_posts() ) :
			the_post();
			
			?>
				<a href="<?php the_permalink(); ?>">
				<h3>
					<?php the_title(); ?>
				</h3>
				</a>
			<?php
		
		endwhile;
		?>
<?php
get_footer();