<nav id="site-navigation" class="main-navigation nav-main sticky-top">
    <div class="container">
        <div class="nav-header">

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
                    <p class="site-description"><?php echo $themetwo_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                                ?></p>
                <?php endif; ?>
            </div><!-- .site-branding -->

            <div id="toggle-menu" class="toggle-menu">
                <span id="button-toggle" class="button-toggle">
                    <i class="menu-icon bi bi-list text-white"></i>
                </span>
            </div>
        </div>

        <div id="content-menu" class="content-menu">
            <div class="container">
                <div class="content-menu-header">

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
                            <p class="site-description"><?php echo $themetwo_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                                        ?></p>
                        <?php endif; ?>
                    </div><!-- .site-branding -->

                    <span id="button-close" class="button-close">
                        <i class="close-icon bi bi-x-lg text-white"></i>
                    </span>
                </div>

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
            </div>
        </div>

    </div>
</nav><!-- #site-navigation -->