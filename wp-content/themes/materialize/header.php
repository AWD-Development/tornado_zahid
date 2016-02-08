<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>

        <?php
            global $wp_customize, $mythemes_header_class;
            $show_header    = false;

            /* FRONT PAGE */
            $on_front_page          = get_theme_mod( 'mythemes-header-front-page', true );
            $is_enb_front_page      = get_option( 'show_on_front' ) == 'page';
            $is_front_page          = $is_enb_front_page && is_front_page();

            /* BLOG PAGE */
            $on_blog_page           = get_theme_mod( 'mythemes-header-blog-page', true );

            if( $is_enb_front_page ){
                $is_blog_page = is_home();
            }
            else{
                $is_blog_page = is_front_page();
            }

            if( $is_front_page && $on_front_page ){
                $show_header = true;
                $mythemes_header_class = 'on-front-page';
            }
            else if( $is_front_page && !$on_front_page ){
                $show_header = false;
                $mythemes_header_class = 'on-front-page';   
            }
            else if( $is_blog_page && $on_blog_page ){
                $show_header = true;
                $mythemes_header_class = 'on-blog-page';
            }
            else if( $is_blog_page && !$on_blog_page ){
                $show_header = false;
                $mythemes_header_class = 'on-blog-page';
            }
            else if( is_singular( 'post' ) ){
                $show_header = get_theme_mod( 'mythemes-header-single-posts', true );
                $mythemes_header_class = 'on-single-posts';
            }
            else if( is_singular( 'page' ) && ! $is_front_page ){
                $show_header = get_theme_mod( 'mythemes-header-single-pages', true );
                $mythemes_header_class = 'on-single-pages';
            }
            else{
                $show_header = get_theme_mod( 'mythemes-header-templates', true );
                $mythemes_header_class = 'on-templates';
            }

            $mythemes_h_class = '';

            /* CUSTOMIZER */
            if( isset( $wp_customize ) ) {
                if( !$show_header ){
                    $mythemes_header_class .= ' hide';
                    $show_header            = true;
                    $mythemes_h_class       = 'mythemes-miss-header-image';
                }
            }
        ?>
        
        <header class="<?php echo esc_attr( $mythemes_h_class ); ?>">

            <nav class="white mythemes-topper" role="navigation">
                <div class="nav-wrapper container">

                    <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="icon-menu"></i></a>

                    <?php global $wp_customize; ?>

                    <!-- LOGO / TITLE / DESCRIPTION -->
                    <?php
                        $blog_title                     = esc_attr( get_bloginfo( 'name' ) );
                        $blog_description               = esc_attr( get_bloginfo( 'description' ) );

                        $mythemes_text                  = true;
                        $mythemes_text_class            = '';

                        /* HEADER CUSTOMIZER */
                        if( isset( $wp_customize ) ) {

                            /* HEADER LOGO */
                            $mythemes_logo              = true;
                            $mythemes_logo_src          = esc_url( get_theme_mod( 'mythemes-blog-logo' , get_template_directory_uri() . '/media/_frontend/img/logo.png' ) );
                            $mythemes_logo_class        = empty( $mythemes_logo_src ) ? 'hide' : '';
                        }

                        /* HEADER FRONTEND */
                        else{

                            /* HEADER LOGO */
                            $mythemes_logo_src          = esc_url( get_theme_mod( 'mythemes-blog-logo' , get_template_directory_uri() . '/media/_frontend/img/logo.png' ) );
                            $mythemes_logo              = !empty( $mythemes_logo_src );
                            $mythemes_logo_class        = '';
                        }

                        echo '<div class="mythemes-blog-identity">';

                        /* BRANDING  */
                        if( $mythemes_logo ){
                            echo '<a class="mythemes-blog-logo ' . esc_attr( $mythemes_logo_class ) . '" href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( $blog_title . ' - ' . $blog_description ) . '" style="margin-top: ' . absint( get_theme_mod( 'mythemes-blog-logo-m-top' ) ) . 'px; margin-bottom: ' . absint( get_theme_mod( 'mythemes-blog-logo-m-bottom' ) ) . 'px;">';
                            echo '<img src="' . esc_url( $mythemes_logo_src ) . '" title="' . esc_attr( $blog_title . ' - ' . $blog_description ) . '"/>';
                            echo '</a>';
                        }

                        /* BLOG TITLE */
                        if( $mythemes_text ){
                            echo '<a class="mythemes-blog-title ' . esc_attr( $mythemes_text_class ) . '" href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( $blog_title . ' - ' . $blog_description ) . '">';
                            bloginfo( 'name' );
                            echo '</a>';
                        }

                        /* BLOG DESCRIPTION */
                        if( $mythemes_text ){
                            echo '<a class="mythemes-blog-description ' . esc_attr( $mythemes_text_class ) . '" href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( $blog_title . ' - ' . $blog_description ) . '">';
                            bloginfo( 'description' );
                            echo '</a>';
                        }

                        echo '</div>';
                    ?>

                    <?php

                        function mythemes_get_menu_childrens( $id )
                        {
                            global $mythemes_curr_ancestor;

                            $pages = get_posts( array(
                                'post_type'     => 'page',
                                'order'         => 'ASC',
                                'post_parent'   => $id
                            ) );

                            $rett = '';

                            if( !empty( $pages ) ){

                                $rett = '<ul class="sub-menu">';

                                foreach( $pages as $p => $item ){

                                    $classes = '';

                                    if( is_page( $item -> ID ) ){
                                        $classes = 'current-menu-item';
                                        $mythemes_curr_ancestor = true;
                                    }

                                    $submenu = mythemes_get_menu_childrens( $item -> ID );

                                    if( !empty( $submenu ) ){
                                        $classes = 'menu-item-has-children';

                                        if( $mythemes_curr_ancestor  ){
                                            $classes .= ' current-menu-ancestor';
                                        }
                                    }

                                    $rett .= '<li class="menu-item ' . esc_attr( $classes ) . '">';
                                    $rett .= '<a href="' . esc_url( get_permalink( $item -> ID ) ) . '" title="' . mythemes_post::title( $item -> ID, true ) . '">' . mythemes_post::title( $item -> ID ) . '</a>';

                                    $rett .= $submenu;

                                    $rett .= '</li>';

                                }

                                $rett .= '</ul>';
                            }

                            return $rett;

                        }

                        global $mythemes_curr_ancestor;

                        $location = get_nav_menu_locations();

                        {   /* NOT COLLAPSED MENU */
                            $args = array(
                                'theme_location'    => 'header',
                                'container_class'   => 'not-collapsed-wrapper',
                                'menu_class'        => 'right hide-on-med-and-down'
                            );

                            if( isset( $location[ 'header' ] ) && $location[ 'header' ] > 0 ){
                                wp_nav_menu( $args );
                            }else{
                                $pages = get_posts( array(
                                    'post_type' => 'page',
                                    'order' => 'ASC'
                                ));
                                
                                if( !empty( $pages ) ){
                                    echo '<div class="not-collapsed-wrapper">';
                                    echo '<ul class="right hide-on-med-and-down">';

                                    foreach( $pages as $p => $item ){
                                        $classes                = '';
                                        $mythemes_curr_ancestor = false;

                                        if( $item -> post_parent > 0 ){
                                            continue;
                                        }

                                        if( is_page( $item -> ID ) ){
                                            $classes = 'current-menu-item';
                                        }

                                        $submenu = mythemes_get_menu_childrens( $item -> ID );

                                        if( !empty( $submenu ) ){
                                            $classes .= ' menu-item-has-children';

                                            if( $mythemes_curr_ancestor  ){
                                                $classes .= ' current-menu-ancestor';
                                            }
                                        }
                                            
                                        echo '<li class="menu-item ' . $classes . '">';
                                        echo '<a href="' . esc_url( get_permalink( $item -> ID ) ) . '" title="' . esc_attr( mythemes_post::title( $item -> ID, true ) ) . '">' . mythemes_post::title( $item -> ID ) . '</a>';
                                        echo $submenu;
                                        echo '</li>';
                                    }
                                    echo '</ul>';
                                    echo '</div>';
                                }
                            }
                        }


                        {   /* COLLAPSED MENU */
                            $args = array(
                                'theme_location'    => 'header',
                                'container_class'   => 'collapsed-wrapper',
                                'menu_class'        => 'side-nav',
                                'menu_id'           => 'nav-mobile'
                            );

                            if( isset( $location[ 'header' ] ) && $location[ 'header' ] > 0 ){
                                wp_nav_menu( $args );
                            }else{
                                $pages = get_posts( array(
                                    'post_type' => 'page',
                                    'order' => 'ASC'
                                ));
                                
                                if( !empty( $pages ) ){
                                    echo '<div class="collapsed-wrapper">';
                                    echo '<ul id="nav-mobile" class="side-nav">';

                                    foreach( $pages as $p => $item ){
                                        $classes = '';

                                        if( is_page( $item -> ID ) ){
                                            $classes = 'current-menu-item';
                                        }
                                            
                                        echo '<li class="menu-item ' . $classes . '">';
                                        echo '<a href="' . esc_url( get_permalink( $item -> ID ) ) . '" title="' . esc_attr( mythemes_post::title( $item -> ID, true ) ) . '">' . mythemes_post::title( $item -> ID ) . '</a>';
                                        echo '</li>';
                                    }

                                    echo '</ul>';
                                    echo '</div>';
                                }
                            }
                        }
                    ?>
                </div>
            </nav>

            <?php
                if( $show_header ){
                    get_template_part( 'templates/header' );
                }
            ?>

        </header>