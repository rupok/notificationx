<?php 
    $current_tab = get_post_meta( $idd, '_nx_builder_current_tab', true );
    if( ! $current_tab ) {
        $current_tab = 'source_tab';
    }

    $totaltabs = count( $tabs );
    $position = intval( array_search( $current_tab, array_keys( $tabs ) ) + 1 );
?>
<div class="nx-builder-wrapper">

    <div class="nx-builder-header">
        <h1><?php _e( 'NotificationX Quick Builder', 'notificationx' ); ?></h1>
    </div>

    <div class="nx-builder-tab-menu">
    <?php if( ! empty( $tabs ) ) : ?>
        <ul>
            <?php 
                $tid = 1;
                $tabids = array();
                foreach( $tabs as $id => $tab ) {
                    $tabids[] = $id;
                    $active = $current_tab === $id ? ' active' : '';
                    $class = isset( $tab['icon'] ) ? ' nx-has-icon' : '';
                    $class .= $active;
                    if( $position > $tid ){
                        $class .= ' nx-complete';
                    } 
                    ?>
                        <li data-tabid="<?php echo $tid++; ?>" class="<?php echo $class; ?>" data-tab="<?php echo $id; ?>">
                            <?php if( isset( $tab['icon'] ) ) : ?>
                                <span class="nx-menu-icon">
                                    <img src="<?php echo NOTIFICATIONX_ADMIN_URL . 'assets/img/icons/' . $tab['icon']; ?>" alt="<?php echo $tab['title']; ?>">
                                </span>
                            <?php endif; ?>
                            <span class="nx-menu-title"><?php echo $tab['title']; ?></span>
                        </li>
                    <?php
                }
            ?>
        </ul>
    <?php endif; ?>
    </div>

    <div class="nx-builder-content-wrapper nx-metatab-wrapper" data-totaltab="<?php echo $totaltabs; ?>">
        <div class="nx-preloader">
            <img src="<?php echo NOTIFICATIONX_ADMIN_URL . 'assets/img/nx-menu-icon.png'; ?>" alt="">
        </div>
        <div class="nx-metatab-inner-wrapper">
            <form method="post" id="nx-builder-form" action="<?php echo self::get_form_action( '', true ); ?>">
                <input id="nx_builder_current_tab" type="hidden" name="nx_builder_current_tab" value="source_tab">
                <?php 
                    wp_nonce_field( $builder_args['id'], $builder_args['id'] . '_nonce' );
                    $tabid = 1;
                    foreach( $tabs as $id => $tab  ){
                        $active = $current_tab === $id ? ' active ' : '';
                        $sections = NotificationX_Helper::sorter( $tab['sections'], 'priority', 'ASC' );
                        ?>
                        <div id="nx-<?php echo $id ?>" class="nx-builder-content <?php echo $active; ?>">
                        <?php 
                            do_action( 'nx_builder_before_tab', $id, $tab );
                            foreach( $sections as $sec_id => $section ) {
                                /**
                                 * This will go with section_id, and tab_id
                                 */
                                do_action( 'nx_builder_before_section', $sec_id, $section, $id );
                                if( isset( $section['fields'] ) ) : 
                                    $fields = NotificationX_Helper::sorter( $section['fields'], 'priority', 'ASC' );
                                    if( ! empty( $fields ) )  :
                                ?>
                                    <div id="nx-meta-section-<?php echo $sec_id; ?>" class="nx-meta-section">
                                        <h2 class="nx-meta-section-title">
                                            <?php echo $section['title']; ?>    
                                        </h2>
                                        <table>
                                            <?php 
                                                foreach( $fields as $key => $field ) {
                                                    NotificationX_MetaBox::render_meta_field( $key, $field, '', $idd );
                                                }
                                            ?>
                                        </table>
                                    </div>
                                <?php
                                    endif;
                                endif;
                                if( isset( $section['view'] ) ) : 
                                    do_action( 'nx_builder_before_section_view', $sec_id, $section, $id );
                                        call_user_func( $section['view'] );
                                    do_action( 'nx_builder_after_section_view', $sec_id, $section, $id );
                                endif;
                                /**
                                 * This will go with section_id, and tab_id
                                 */
                                do_action( 'nx_builder_after_section', $sec_id, $section, $id );
                            }
                        ?>
                        <input id="publish" style="display:none" class="quick-builder-submit-btn" name="nx_builder_add_submit" type="submit" value="Create Notification">
                        <div class="quick-builder-submit-btn-wrap">
                            <button data-tab="<?php echo isset( $tabids[ $tabid - 1 ] ) ? $tabids[ $tabid - 1 ] : ''; ?>" data-tabid="<?php echo ($tabid - 1); ?>" class="quick-builder-submit-btn nx-quick-builder-btn btn-prev"><?php _e( 'Previous', 'notificationx' ); ?></button>
                            <button data-tab="<?php echo isset( $tabids[ $tabid ] ) ? $tabids[ $tabid ] : ''; ?>" data-tabid="<?php echo ++$tabid; ?>" class="quick-builder-submit-btn nx-quick-builder-btn btn-next">
                                <?php
                                    if( $totaltabs < $tabid ) {
                                        _e( 'Launch', 'notificationx' );
                                    } else {
                                        _e( 'Next', 'notificationx' );
                                    }
                                ?>
                            </button>
                        </div>
                        <?php do_action( 'nx_builder_after_tab', $id, $tab ); ?>
                        </div>
                        <?php
                    }
                ?>
            </form>

        </div>
    </div>
</div>