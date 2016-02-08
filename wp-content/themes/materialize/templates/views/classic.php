<?php global $post, $posts_total, $posts_index; ?>
<article <?php post_class(); ?>>
    <?php
    	$p_thumbnail = get_post( get_post_thumbnail_id( $post -> ID ) );

        if( has_post_thumbnail( $post -> ID ) && isset( $p_thumbnail -> ID ) ){
    ?>
            <div class="post-thumbnail overflow-wrapper">
                <?php 
                	echo get_the_post_thumbnail( $post -> ID ,  'mythemes-classic' , array(
                		'alt' 	=> mythemes_post::title( $post -> ID, true ),
                	 	'class' => 'img-background effect-scale'
                	 ));
                ?>      
                <a href="<?php echo get_permalink( $post -> ID ); ?>" class="valign-cell-wrapper" title="<?php echo mythemes_post::title( $post -> ID, true ); ?>">
                </a>
                <?php
                    $c_thumbnail = isset( $p_thumbnail -> post_excerpt ) ? esc_html( $p_thumbnail -> post_excerpt ) : null;

                    if( !empty( $c_thumbnail ) ){
                        echo '<div class="valign-bottom-cell-wrapper">';
                        echo '<figcaption class="valign-cell">' . $c_thumbnail . '</figcaption>';
                        echo '</div>';
                    }
                ?>
            </div>
    <?php
        }
    ?>

    <h2 class="post-title">
        <?php if( !empty( $post -> post_title ) ) { ?>

            <a href="<?php the_permalink() ?>" title="<?php echo mythemes_post::title( $post -> ID, true ); ?>"><?php the_title(); ?></a>

        <?php } else { ?>
    
            <a href="<?php the_permalink() ?>"><?php _e( 'Read more about ..' , 'materialize' ) ?></a>
    
        <?php } ?>
    </h2>

    <?php get_template_part( 'templates/meta/top' ); ?>

    <div class="post-content">

        <?php
            $read_more_link =   '<span class="hide-on-small-only">' . __( 'Read More' , 'materialize' ) . '</span>'.
                                '<span class="hide-on-med-and-up">&rarr;</span>';
            if( !empty( $post -> post_excerpt ) ){
                the_excerpt();
                echo '<a href="' . get_permalink( $post -> ID ) . '" class="more-link">';
                echo $read_more_link;
                echo '</a>';
            }
            else{
                the_content( $read_more_link );
            }
        ?>
        
        <div class="clearfix"></div>
    </div>
</article>