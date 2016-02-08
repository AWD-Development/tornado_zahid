<?php
	global $wp_customize;

	$default_class = '';

	/* WP CUSTOMIZE */
	if( isset( $wp_customize ) ){
		$default = true;
		$default_class = !(bool)get_theme_mod( 'mythemes-default-content', true ) ? 'hide' : '';
	}

	/* FRONTEND */
	else{
		$default = (bool)get_theme_mod( 'mythemes-default-content', true );
	}

	/* SIDEBAR */
    if ( dynamic_sidebar( 'footer-first' ) ){
        /* IF NOT EMPTY */    
    }

    else if( $default ){
        echo '<div class="widget widget_text mythemes-default-content ' . esc_attr( $default_class ) . '">';
        echo '<h5>' . __( 'Materialize' , 'materialize' ) . '</h5>';
        echo '<div class="textwidget">';
        echo sprintf( __( 'It is a clean white WordPress theme %s with creative material design and %s responsive layout.' , 'materialize' ), '<br/>' , '<br/>' );
        echo '</div>';
        echo '</div>';
    }
?>