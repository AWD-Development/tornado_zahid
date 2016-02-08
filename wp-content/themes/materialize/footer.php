        <footer>
            <?php
                global $wp_customize;

                $are_active_sidebras =  is_active_sidebar( 'footer-first' ) ||
                                        is_active_sidebar( 'footer-second' ) ||
                                        is_active_sidebar( 'footer-third' ) ||
                                        is_active_sidebar( 'footer-fourth' );

                $items_class = '';

                /* WP CUSTOMIZE */
                if( isset( $wp_customize ) ){
                    $items = true;
                    $items_class = !($are_active_sidebras || (bool)get_theme_mod( 'mythemes-default-content', true ) ) ? 'hide' : '';
                }

                /* FRONTEND */
                else{
                    $items = $are_active_sidebras || (bool)get_theme_mod( 'mythemes-default-content', true );
                }
                
                if( $items ){
            ?>
                    <aside class="mythemes-default-content <?php echo esc_attr( $items_class ); ?>">
                        <div class="container">
                            <div class="row">
                                <div class="col s12 m6 l3">
                                    <?php get_sidebar( 'footer-first' ); ?>
                                </div>
                                <div class="col s12 m6 l3">
                                    <?php get_sidebar( 'footer-second' ); ?>
                                </div>
                                <div class="col s12 m6 l3">
                                    <?php get_sidebar( 'footer-third' ); ?>
                                </div>
                                <div class="col s12 m6 l3">
                                    <?php get_sidebar( 'footer-fourth' ); ?>
                                </div>
                            </div>
                        </div>
                    </aside>
            <?php
                }
            ?>

            <div class="mythemes-dark-mask">
                <div class="container mythemes-social">
                    <div class="row">
                        <?php
                            $vimeo      = esc_url( get_theme_mod( 'mythemes-vimeo', 'http://vimeo.com/#' ) );
                            $twitter    = esc_url( get_theme_mod( 'mythemes-twitter', 'http://twitter.com/#' ) );
                            $skype      = esc_url( get_theme_mod( 'mythemes-skype' ) );
                            $renren     = esc_url( get_theme_mod( 'mythemes-renren' ) );
                            $github     = esc_url( get_theme_mod( 'mythemes-github' ) );
                            $rdio       = esc_url( get_theme_mod( 'mythemes-rdio' ) );
                            $linkedin   = esc_url( get_theme_mod( 'mythemes-linkedin' ) );
                            $behance    = esc_url( get_theme_mod( 'mythemes-behance', 'http://behance.com/#' ) );
                            $dropbox    = esc_url( get_theme_mod( 'mythemes-dropbox' ) );
                            $flickr     = esc_url( get_theme_mod( 'mythemes-flickr', 'http://flickr.com/#' ) );
                            $tumblr     = esc_url( get_theme_mod( 'mythemes-tumblr' ) );
                            $instagram  = esc_url( get_theme_mod( 'mythemes-instagram' ) );
                            $vkontakte  = esc_url( get_theme_mod( 'mythemes-vkontakte' ) );
                            $facebook   = esc_url( get_theme_mod( 'mythemes-facebook', 'http://facebook.com/#' ) );
                            $evernote   = esc_url( get_theme_mod( 'mythemes-evernote' ) );
                            $flattr     = esc_url( get_theme_mod( 'mythemes-flattr' ) );
                            $picasa     = esc_url( get_theme_mod( 'mythemes-picasa' ) );
                            $dribbble   = esc_url( get_theme_mod( 'mythemes-dribbble' ) );
                            $mixi       = esc_url( get_theme_mod( 'mythemes-mixi' ) );
                            $stumbl     = esc_url( get_theme_mod( 'mythemes-stumbleupon' ) );
                            $lastfm     = esc_url( get_theme_mod( 'mythemes-lastfm' ) );
                            $gplus      = esc_url( get_theme_mod( 'mythemes-gplus' ) );
                            $gcircle    = esc_url( get_theme_mod( 'mythemes-google-circles' ) );
                            $pinterest  = esc_url( get_theme_mod( 'mythemes-pinterest', 'http://pinterest.com/#' ) );
                            $smashing   = esc_url( get_theme_mod( 'mythemes-smashing' ) );
                            $soundcloud = esc_url( get_theme_mod( 'mythemes-soundcloud' ) );
                            $rss        = esc_url( get_theme_mod( 'mythemes-rss', esc_url( get_bloginfo('rss2_url') ) ) );

                            if( isset( $wp_customize ) ) {
                                
                                $vm_class   = empty( $vimeo ) ? 'hide' : '';
                                $tw_class   = empty( $twitter ) ? 'hide' : '';
                                $sk_class   = empty( $skype ) ? 'hide' : '';
                                $rn_class   = empty( $renren ) ? 'hide' : '';
                                $gt_class   = empty( $github ) ? 'hide' : '';
                                $rd_class   = empty( $rdio ) ? 'hide' : '';
                                $ln_class   = empty( $linkedin ) ? 'hide' : '';
                                $bh_class   = empty( $behance ) ? 'hide' : '';
                                $db_class   = empty( $dropbox ) ? 'hide' : '';
                                $fk_class   = empty( $flickr ) ? 'hide' : '';
                                $tm_class   = empty( $tumblr ) ? 'hide' : '';
                                $in_class   = empty( $instagram ) ? 'hide' : '';
                                $vk_class   = empty( $vkontakte ) ? 'hide' : '';
                                $fb_class   = empty( $facebook ) ? 'hide' : '';
                                $ev_class   = empty( $evernote ) ? 'hide' : '';
                                $ft_class   = empty( $flattr ) ? 'hide' : '';
                                $pc_class   = empty( $picasa ) ? 'hide' : '';
                                $dr_class   = empty( $dribbble ) ? 'hide' : '';
                                $mx_class   = empty( $mixi ) ? 'hide' : '';
                                $st_class   = empty( $stumbl ) ? 'hide' : '';
                                $ls_class   = empty( $lastfm ) ? 'hide' : '';
                                $gp_class   = empty( $gplus ) ? 'hide' : '';
                                $gc_class   = empty( $gcircle ) ? 'hide' : '';
                                $pn_class   = empty( $pinterest ) ? 'hide' : '';
                                $sm_class   = empty( $smashing ) ? 'hide' : '';
                                $sc_class   = empty( $soundcloud ) ? 'hide' : '';
                                $rs_class   = empty( $rss ) ? 'hide' : '';

                                $vimeo      = empty( $vimeo ) ?  esc_url( home_url() ) : $vimeo;
                                $twitter    = empty( $twitter ) ? esc_url( home_url() ) : $twitter;
                                $skype      = empty( $skype ) ? esc_url( home_url() ) : $skype;
                                $renren     = empty( $renren ) ? esc_url( home_url() ) : $renren;
                                $github     = empty( $github ) ? esc_url( home_url() ) : $github;
                                $rdio       = empty( $rdio ) ? esc_url( home_url() ) : $rdio;
                                $linkedin   = empty( $linkedin ) ? esc_url( home_url() ) : $linkedin;
                                $behance    = empty( $behance ) ? esc_url( home_url() ) : $behance;
                                $dropbox    = empty( $dropbox ) ? esc_url( home_url() ) : $dropbox;
                                $flickr     = empty( $flickr ) ? esc_url( home_url() ) : $flickr;
                                $tumblr     = empty( $tumblr ) ? esc_url( home_url() ) : $tumblr;
                                $instagram  = empty( $instagram ) ? esc_url( home_url() ) : $instagram;
                                $vkontakte  = empty( $vkontakte ) ? esc_url( home_url() ) : $vkontakte;
                                $facebook   = empty( $facebook ) ? esc_url( home_url() ) : $facebook;
                                $evernote   = empty( $evernote ) ? esc_url( home_url() ) : $evernote;
                                $flattr     = empty( $flattr ) ? esc_url( home_url() ) : $flattr;
                                $picasa     = empty( $picasa ) ? esc_url( home_url() ) : $picasa;
                                $dribbble   = empty( $dribbble ) ? esc_url( home_url() ) : $dribbble;
                                $mixi       = empty( $mixi ) ? esc_url( home_url() ) : $mixi;
                                $stumbl     = empty( $stumbl ) ? esc_url( home_url() ) : $stumbl;
                                $lastfm     = empty( $lastfm ) ? esc_url( home_url() ) : $lastfm;
                                $gplus      = empty( $gplus ) ? esc_url( home_url() ) : $gplus;
                                $gcircle    = empty( $gcircle ) ? esc_url( home_url() ) : $gcircle;
                                $pinterest  = empty( $pinterest ) ? esc_url( home_url() ) : $pinterest;
                                $smashing   = empty( $smashing ) ? esc_url( home_url() ) : $smashing;
                                $soundcloud = empty( $soundcloud ) ? esc_url( home_url() ) : $soundcloud;
                                $rss        = empty( $rss ) ? esc_url( home_url() ) : $rss;
                            }
                            else{

                                $vm_class   = '';
                                $tw_class   = '';
                                $sk_class   = '';
                                $rn_class   = '';
                                $gt_class   = '';
                                $rd_class   = '';
                                $ln_class   = '';
                                $bh_class   = '';
                                $db_class   = '';
                                $fk_class   = '';
                                $tm_class   = '';
                                $in_class   = '';
                                $vk_class   = '';
                                $fb_class   = '';
                                $ev_class   = '';
                                $ft_class   = '';
                                $pc_class   = '';
                                $dr_class   = '';
                                $mx_class   = '';
                                $st_class   = '';
                                $ls_class   = '';
                                $gp_class   = '';
                                $gc_class   = '';
                                $pn_class   = '';
                                $sm_class   = '';
                                $sc_class   = '';
                                $rs_class   = '';
                            }
                        ?>
                        <div class="col s12">
                            <?php
                                if( !empty( $vimeo ) ){
                                    echo '<a href="' . $vimeo . '" class="btn-floating waves-effect waves-light icon-vimeo ' . esc_attr( $vm_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $twitter ) ){
                                    echo '<a href="' . $twitter . '" class="btn-floating waves-effect waves-light icon-twitter ' . esc_attr( $tw_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $skype ) ){
                                    echo '<a href="' . $skype . '" class="btn-floating waves-effect waves-light icon-skype ' . esc_attr( $sk_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $renren ) ){
                                    echo '<a href="' . $renren . '" class="btn-floating waves-effect waves-light icon-renren ' . esc_attr( $rn_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $github ) ){
                                    echo '<a href="' . $github . '" class="btn-floating waves-effect waves-light icon-github ' . esc_attr( $gt_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $rdio ) ){
                                    echo '<a href="' . $rdio . '" class="btn-floating waves-effect waves-light icon-rdio ' . esc_attr( $rd_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $linkedin ) ){
                                    echo '<a href="' . $linkedin . '" class="btn-floating waves-effect waves-light icon-linkedin ' . esc_attr( $ln_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $behance ) ){
                                    echo '<a href="' . $behance . '" class="btn-floating waves-effect waves-light icon-behance ' . esc_attr( $bh_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $dropbox ) ){
                                    echo '<a href="' . $dropbox . '" class="btn-floating waves-effect waves-light icon-dropbox ' . esc_attr( $db_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $flickr ) ){
                                    echo '<a href="' . $flickr . '" class="btn-floating waves-effect waves-light icon-flickr ' . esc_attr( $fk_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $tumblr ) ){
                                    echo '<a href="' . $tumblr . '" class="btn-floating waves-effect waves-light icon-tumblr ' . esc_attr( $tm_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $instagram ) ){
                                    echo '<a href="' . $instagram . '" class="btn-floating waves-effect waves-light icon-instagram ' . esc_attr( $in_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $vkontakte ) ){
                                    echo '<a href="' . $vkontakte . '" class="btn-floating waves-effect waves-light icon-vkontakte ' . esc_attr( $vk_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $facebook ) ){
                                    echo '<a href="' . $facebook . '" class="btn-floating waves-effect waves-light icon-facebook ' . esc_attr( $fb_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $evernote ) ){
                                    echo '<a href="' . $evernote . '" class="btn-floating waves-effect waves-light icon-evernote ' . esc_attr( $ev_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $flattr ) ){
                                    echo '<a href="' . $flattr . '" class="btn-floating waves-effect waves-light icon-flattr ' . esc_attr( $ft_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $picasa ) ){
                                    echo '<a href="' . $picasa . '" class="btn-floating waves-effect waves-light icon-picasa ' . esc_attr( $pc_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $dribbble ) ){
                                    echo '<a href="' . $dribbble . '" class="btn-floating waves-effect waves-light icon-dribbble ' . esc_attr( $dr_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $mixi ) ){
                                    echo '<a href="' . $mixi . '" class="btn-floating waves-effect waves-light icon-mixi ' . esc_attr( $mx_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $stumbl ) ){
                                    echo '<a href="' . $stumbl . '" class="btn-floating waves-effect waves-light icon-stumbleupon ' . esc_attr( $st_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $lastfm ) ){
                                    echo '<a href="' . $lastfm . '" class="btn-floating waves-effect waves-light icon-lastfm ' . esc_attr( $ls_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $gplus ) ){
                                    echo '<a href="' . $gplus . '" class="btn-floating waves-effect waves-light icon-gplus ' . esc_attr( $gp_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $gcircle ) ){
                                    echo '<a href="' . $gcircle . '" class="btn-floating waves-effect waves-light icon-google-circles ' . esc_attr( $gc_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $pinterest ) ){
                                    echo '<a href="' . $pinterest . '" class="btn-floating waves-effect waves-light icon-pinterest ' . esc_attr( $pn_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $smashing ) ){
                                    echo '<a href="' . $smashing . '" class="btn-floating waves-effect waves-light icon-smashing ' . esc_attr( $sm_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $soundcloud ) ){
                                    echo '<a href="' . $soundcloud . '" class="btn-floating waves-effect waves-light icon-soundcloud ' . esc_attr( $sc_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $rss ) ){
                                    echo '<a href="' . $rss . '" class="btn-floating waves-effect waves-light icon-rss ' . esc_attr( $rs_class ) . '" target="_blank"></a>';
                                }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="mythemes-copyright">
                    <div class="container">
                        <div class="row">
                            <div class="col s12">
                                <p>
                                    <span class="copyright"><?php echo mythemes_validate_copyright( get_theme_mod( 'mythemes-copyright' , sprintf( __( 'Copyright &copy; %s %s. Powered by %s.' , 'materialize' ) , date( 'Y' ) , esc_html( get_bloginfo( 'name' ) ) , '<a href="http://wordpress.org/">WordPress</a>' ) ) ); ?></span>
                                    <span><?php echo mythemes_options::get( 'author-link' ); ?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </footer>

        <?php
            if( isset( $wp_customize ) && mythemes_core::exists_premium() ) {
                echo '<a href="' . esc_url( mythemes_core::theme( 'premium' ) ) . '" target="_blank" class="mythemes-upgrade"><i class="icon-publish"></i>' . __( 'Upgrade to Premium' , 'materialize' ) . '</a>';
            }
        ?>

        <?php wp_footer(); ?>

    </body>
</html>