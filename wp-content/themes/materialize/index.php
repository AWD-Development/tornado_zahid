<?php get_header(); ?>

	<?php

		global $wp_query,$wp_customize;

	    if( isset( $wp_customize ) ) {
	        $breadcrumbs = true;
	        $classes = !(bool)get_theme_mod( 'mythemes-breadcrumbs', true ) ? 'hide' : '';
	    }
	    else{
	        $breadcrumbs = (bool)get_theme_mod( 'mythemes-breadcrumbs', true );
	        $classes = '';
	    }

	    if( $breadcrumbs ){
	?>
	        <div class="mythemes-page-header <?php echo esc_attr( $classes ); ?>">

		      	<div class="container">
		        	<div class="row">

		          		<div class="col s12 m8 l9">
		            		<nav class="mythemes-nav-inline">
		              			<ul class="mythemes-menu">
		                			<?php echo mythemes_breadcrumbs::home(); ?>
		                			<li></li>
		              			</ul>
		            		</nav>
		            		<h1 id="blog-title"><?php echo esc_html( get_theme_mod( 'blog-title' , __( 'Blog' , 'materialize' ) ) ); ?></h1>
		          		</div>

		          		<div class="col s12 m4 l3 mythemes-posts-found">
		                    <div class="found-details">
		                        <?php echo mythemes_breadcrumbs::count( $wp_query ); ?>
		                    </div>
		                </div>

		        	</div>
		      	</div>

		    </div>
	<?php
		}
	?>
        
    <div class="content">
        <div class="container">
            <div class="row">
        
                <?php get_template_part( 'templates/loop' ); ?>

            </div>
        </div>
    </div>

<?php get_footer(); ?>