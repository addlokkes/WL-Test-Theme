<?php
get_header();
?>

<?php

$terms = wp_get_post_terms($post->ID, array('cars', 'category'));
$output = '';
foreach ( $terms as $term ) { ?>
	<h2><?php echo $term->name; ?></h2>
	<?php	}

$args = array('post_type' => 'cars', 'posts_per_page' => 10);
$loop = new WP_Query($args);

while ($loop->have_posts() ) : $loop->the_post(); ?>

	<a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
	
	<?php echo '<div class="entry-content">';
	the_content();
	echo '</div>';
endwhile;
?>

<?php
get_footer();