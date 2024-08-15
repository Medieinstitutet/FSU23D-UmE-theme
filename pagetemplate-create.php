<?php
/**
* Template Name: Create page
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

            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $result = wp_insert_post(
                    array(
                        'post_type' => 'recept',
                        'post_title' => $_POST['title'],
                        'post_content' => $_POST['description'],
                        'post_status' => 'publish'
                    )
                );

                $new_id = $result;

                if(isset($_POST['products'])) {
                    update_post_meta($new_id, 'includedProducts', $_POST['products']);
                }
                
            }
            do_action('output_create_form');
		endwhile;
		?>

<?php
get_footer();
