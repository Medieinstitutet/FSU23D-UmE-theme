<?php get_header(); ?>
<?php
		while ( have_posts() ) :
			the_post();
			
			?>
				<div class="centered-site-area">
					<?php the_post_thumbnail(); ?>
				</div>
				<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
				
				<h1>
					<?php the_title(); ?>
				</h1>
			<?php
			the_content();
			?>
			</main>
			</div>
			<?php
		
		endwhile;
		?>
<?php
get_footer();