<!-- HTML Structure -->
<nav id="site-navigation" class="main-navigation nav sticky-top">
    <div class="nav-header">
        <div class="container">
            <div class="site-branding">
                <?php
                the_custom_logo();
                if (is_front_page() && is_home()) :
                ?>
                    <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                <?php
                else :
                ?>
                    <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
                <?php
                endif;
                $themetwo_description = get_bloginfo('description', 'display');
                if ($themetwo_description || is_customize_preview()) :
                ?>
                    <p class="site-description"><?php echo $themetwo_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                <?php endif; ?>
            </div><!-- .site-branding -->

            <div id="toggle-menu" class="toggle-menu">
                <span id="button-toggle" class="button-toggle">
                    <i class="menu-icon bi bi-list text-white"></i>
                </span>
            </div>
        </div>
    </div>

    <div id="nav-content" class="nav-content">
        <!-- <div class="container"> -->
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'menu-1',
                    'menu_id'        => 'primary-menu',
                    'menu_class'     => 'ul-menu',
                    'container'      => false,
                )
            );
            ?>
        <!-- </div> -->
    </div>
</nav><!-- #site-navigation -->