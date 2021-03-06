<?php
/**
 * Partial template for content in page.php
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header><!-- .entry-header -->

	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<div class="entry-content">
		<!--learning objectives-->
		<div class="row" id="learning-row">
			<?php echo get_learning_objectives();?>
			<?php echo acf_fetch_introduction();?>
		</div>
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<?php the_content(); ?>
				<?php echo acf_fetch_next_page(); ?>
			</div>
		</div>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->
	<div class="extras-footer">
		<div class="row">
			<?php echo get_extra_resources();?>
		</div>
	</div>

	<footer class="entry-footer">

		<?php edit_post_link( __( 'Edit', 'understrap' ), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
