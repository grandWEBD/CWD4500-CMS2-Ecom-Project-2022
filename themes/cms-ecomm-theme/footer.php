<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CMS2_eCOMM_Theme
 */

?>

	<footer id="colophon" class="site-footer">
		<?php
		// display 3 event posts
		$events_args = array(
			'post_type'		=> array( 'cms_ecomm_event' ),
			'post_status'	=> 'published',
			'posts_per_page'=> 3,
			'order_by'		=> 'rand',
			'post_not_in'	=> array( get_the_ID() )
		);

		$events_query = new WP_Query( $events_args );

		if( $events_query -> have_posts() ){
			?>
			<div class="footerEvents">
				<?php
				while ( $events_query->have_posts() ){
					$events_query->the_post();
					the_post_thumbnail();
					the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
				}
				?>
			</div>
			<?php
			wp_reset_postdata();		
		}
		?>
		<nav id="site-navigation" class="secondary-navigation">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-footer',
					'menu_id'        => 'footer-menu',
				)
			);
			?>
		</nav><!-- #site-navigation secondary -->
		<div class="site-info">
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Copyright, 2: Site. */
				printf( esc_html__( 'Copyright %1$s by %2$s.', 'cms-ecomm' ), '2022', '<a href="'. home_url() .'">CMS ECOMM</a>' );
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
