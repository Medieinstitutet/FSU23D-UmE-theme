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

            ?>
            <form method="POST">
                <input name="title" />
                <textarea name="description"></textarea>
                <select name="products[]" multiple>
                    <option value="23">Ris</option>
                    <option value="25">Lax</option>
                </select>
                <input type="submit" />
            </form>
            <?php
		endwhile;
		?>

<?php
get_footer();
