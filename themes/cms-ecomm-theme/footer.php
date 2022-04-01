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
		<nav id="site-navigation" class="secondary-navigation">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-footer',
					'menu_id'        => 'footer-menu',
				)
			);
			?>
		</nav><!-- #site-navigation -->
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
