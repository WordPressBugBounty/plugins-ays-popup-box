<div class="wrap">
    <h1 class="wp-heading-inline">
        <?php
            echo esc_html(get_admin_page_title());
        ?>
    </h1>
    <div style="display:flex;justify-content:center;align-items:center;">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/F8d8_5jDzY4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy"></iframe>
    </div>
    <div class="nav-tab-wrapper">
        <a href="#tab1" class="nav-tab nav-tab-active"><?php echo esc_html__('Reports', "ays-popup-box")?></a>
        <a href="#tab2" class="nav-tab"><?php echo esc_html__('Statistics', "ays-popup-box")?></a>
    </div>
    <div id="tab1" class="ays-pb-tab-content ays-pb-tab-content-active" style="margin-top:15px;">
        <div class="col-sm-12 ays-pro-features-v2-main-box">
            <div class="ays-pro-features-v2-big-buttons-box">
                <a href="https://popup-plugin.com" target="_blank" class="ays-pro-features-v2-upgrade-button">
                    <div class="ays-pro-features-v2-upgrade-icon" style="background-image:url('<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg');" data-img-src="<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg"></div>
                    <div class="ays-pro-features-v2-upgrade-text">
                        <?php echo esc_html__("Upgrade", "ays-popup-box"); ?>
                    </div>
                </a>
            </div>
            <div class="ays-pro-features-v2-small-buttons-box">
                <a href="https://popup-plugin.com" target="_blank" class="ays-pro-features-v2-upgrade-button">
                    <div class="ays-pro-features-v2-upgrade-icon" style="background-image:url('<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg');" data-img-src="<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg"></div>
                    <div class="ays-pro-features-v2-upgrade-text">
                        <?php echo esc_html__("Upgrade", "ays-popup-box"); ?>
                    </div>
                </a>
            </div>
            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . '/images/features/popup-reports-pro.png'?>" alt="PopupBox Reports" style="width:100%;">
        </div>
    </div>
    <div id="tab2" class="ays-pb-tab-content" style="margin-top:15px;">
        <div class="col-sm-12 ays-pro-features-v2-main-box">
            <div class="ays-pro-features-v2-big-buttons-box">
                <a href="https://popup-plugin.com" target="_blank" class="ays-pro-features-v2-upgrade-button">
                    <div class="ays-pro-features-v2-upgrade-icon" style="background-image:url('<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg');" data-img-src="<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg"></div>
                    <div class="ays-pro-features-v2-upgrade-text">
                        <?php echo esc_html__("Upgrade", "ays-popup-box"); ?>
                    </div>
                </a>
            </div>
            <div class="ays-pro-features-v2-small-buttons-box">
                <a href="https://popup-plugin.com" target="_blank" class="ays-pro-features-v2-upgrade-button">
                    <div class="ays-pro-features-v2-upgrade-icon" style="background-image:url('<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg');" data-img-src="<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg"></div>
                    <div class="ays-pro-features-v2-upgrade-text">
                        <?php echo esc_html__("Upgrade", "ays-popup-box"); ?>
                    </div>
                </a>
            </div>
            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . '/images/features/statistics-pro.png'?>" alt="PopupBox Statistics" style="width:100%;" >
        </div>
    </div>
</div>


