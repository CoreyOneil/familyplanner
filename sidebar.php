<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package familyplanner
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	//error_log("Sidebar is inactive");
	return;
}
?>

<aside id="secondary" class="widget-area">
	<nav id="site-navigation" class="main-navigation">
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'familyplanner' ); ?></button>
			<div class="nav-logo">
				<img src=<?php echo get_stylesheet_directory_uri() . "/img/logo.png"; ?> alt="Family Planner Logo">
			</div>	

			<div class= "nav-tittle">
				<h4>Simplified</h4>
				<h4>Organized</h4>
				<h4>Family Time</h4>
			</div>
			<?php
			wp_nav_menu ([
				'theme_location' => 'sidebar',
				'menu_id'        => 'nav-sidebar',
			]);
			?>
	</nav><!-- #site-navigation -->
	
	<?php dynamic_sidebar( 'search-function' ); ?>
</aside><!-- #secondary -->
