<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	</div><!-- #main .wrapper -->	
</div><!-- #page -->
<div class="footer-wrap"><footer id="colophon" role="contentinfo">
<?php if ( is_active_sidebar( 'footer-widget' ) ) : ?>
		<div id="secondary" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'footer-widget' ); ?>
		</div><!-- #secondary -->
	<?php endif; ?>
		<?php /*?><div class="site-info">
			<?php do_action( 'twentytwelve_credits' ); ?>
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentytwelve' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'twentytwelve' ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentytwelve' ), 'WordPress' ); ?></a>
		</div><?php */?><!-- .site-info -->
        <a class="tutorlink" href="http://localhost/UKOpenColleges/tutor_login">Tutor Login</a>
	</footer><!-- #colophon --></div>

<?php wp_footer(); ?>
</body>
</html>