<?php
/**
* Template Name: Home
*/
?>

<?php
get_header(); ?>

		<?php
		while ( have_posts() ) :
			the_post();
			
			?>
				<h1>
					<?php the_title(); ?>
				</h1>
			<?php
			the_content();

            
		endwhile;
		?>
        <h2>Populära recept</h2>
        <?php
            $recipes = get_field('populara_recept');
            
            foreach($recipes as $recipe) {
                ?>
                    <a href="<?php echo(get_permalink($recipe)); ?>">
                        <?php
                            echo($recipe->post_title);
                        ?>
                    </a>
                <?php
            }
        ?>

<?php
get_footer();
