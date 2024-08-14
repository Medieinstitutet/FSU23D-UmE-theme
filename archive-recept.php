<?php get_header(); ?>

<h1>Alla recept</h1>
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