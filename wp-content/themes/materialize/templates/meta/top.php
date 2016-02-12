<?php
    global $post,$wp_customize;

    if( isset( $wp_customize ) ) {
        $top_meta = true;
        $classes = !(bool)get_theme_mod( 'top-meta', true ) ? 'hide' : '';
    }
    else{
        $top_meta = (bool)get_theme_mod( 'top-meta', true );
        $classes = '';
    }

    if( $top_meta ){
?>
        <div class="mythemes-top-meta meta <?php echo esc_attr( $classes ); ?>">

            <!-- DATE -->
            <?php
                $t_time = get_post_time( 'Y-m-d', false , $post -> ID  );
                $u_time = get_post_time( esc_attr( get_option( 'date_format' ) ) );
            ?>

            <time datetime="<?php echo esc_attr( $t_time ); ?>"><i class="icon-calendar"></i><?php echo sprintf( __( 'опубліковано %s' , 'materialize' ), $u_time, false, $post -> ID, true ); ?></time>

            <div class="clear"></div>

            <!-- GET FIRST 2 CATEGORIES -->
<!--            --><?php //the_category(); ?>

            <!-- AUTHOR -->
<!--            --><?php //$name = get_the_author_meta( 'display_name' , $post -> post_author ); ?>
<!--            <a class="author waves-effect waves-dark grey lighten-4" href="--><?php //echo esc_url( get_author_posts_url( $post-> post_author ) ); ?><!--" title="--><?php //echo sprintf( __( 'Writed by %s' , 'materialize' ) , esc_attr( $name ) ); ?><!--">-->
<!--                <i class="icon-user-1"></i>--><?php //echo sprintf( __( 'by %s' , 'materialize' ) , esc_html( $name ) ); ?>
<!--            </a>-->

            <!-- COMMENTS -->
            <?php
                if( $post -> comment_status == 'open' ) {
                    $nr = absint( get_comments_number( $post -> ID ) );
                    echo '<a class="comments waves-effect waves-dark grey lighten-4" href="' . esc_url( get_comments_link( $post -> ID ) ) . '">';
                    echo '<i class="icon-comment-5"></i>';
                    echo sprintf( _nx( '%s Comment' , '%s Comments' , absint( $nr ) , 'Number of comment(s) from post meta' , 'materialize' ) , number_format_i18n( $nr ) );
                    echo '</a>';
                }
            ?>
        </div>
<?php
    }
?>