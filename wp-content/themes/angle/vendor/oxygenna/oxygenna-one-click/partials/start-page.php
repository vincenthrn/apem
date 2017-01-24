<div class="wrap">
    <h2><?php _e('Demo Content Setup', 'angle-admin-td'); ?></h2>
    <p>
        From here you will be able to give your new site a quick start by installing the demo content that is provided by the theme.
        You will need to make sure all the items in the pre-flight checklist below are ok before you will be able to install the demo content.
    </p>
    <div id="ajax-errors-here"></div>

    <h3><?php _e('Pre-Flight Checklist', 'angle-admin-td'); ?></h3>

    <table class="widefat importers preflight" style="width:100%;">
        <thead>
            <tr>
                <th scope="row" colspan="2"><?php _e('Your Site Setup', 'angle-admin-td'); ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php _e('PHP Version', 'angle-admin-td'); ?></td>
                <td><?php if (function_exists('phpversion')) echo esc_html(phpversion()); ?></td>
            </tr>
            <tr>
                <td><?php _e('WP Memory Limit', 'angle-admin-td'); ?>:</td>
                <td><?php
                    $memory = $this->ini_to_num(WP_MEMORY_LIMIT);
                    if ($memory < 100663296) {
                        echo '<span class="status-error">' . sprintf(__('%s - We recommend setting memory to at least 96MB. See: <a href="%s">Increasing memory allocated to PHP</a>', 'angle-admin-td'), size_format($memory), 'http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP') . '</span>';
                    } else {
                        echo '<span class="status-ok">' . size_format($memory) . '</span>';
                    }
                ?></td>
            </tr>
            <tr>
                <td><?php _e('WP Max Upload Size','angle-admin-td'); ?>:</td>
                <td><?php echo size_format(wp_max_upload_size()); ?></td>
            </tr>
            <?php if (function_exists('ini_get')) : ?>
                <tr>
                    <td><?php _e('PHP Memory Limit', 'angle-admin-td'); ?>:</td>
                    <td><?php echo size_format($this->ini_to_num(ini_get('memory_limit'))); ?></td>
                </tr>
                <tr>
                    <td><?php _e('PHP Post Max Size','angle-admin-td'); ?>:</td>
                    <td><?php echo size_format($this->ini_to_num(ini_get('post_max_size'))); ?></td>
                </tr>
                <tr>
                    <td><?php _e('PHP Time Limit','angle-admin-td'); ?>:</td>
                    <td><?php echo ini_get('max_execution_time'); ?></td>
                </tr>
                <tr>
                    <td><?php _e('PHP Max Input Vars','angle-admin-td'); ?>:</td>
                    <td><?php echo ini_get('max_input_vars'); ?></td>
                </tr>
            <?php endif; ?>
            <tr>
                <td><?php _e('PHP cURL & fsock','angle-admin-td'); ?>:</td>
                <?php
                    // fsockopen/cURL
                    $posting['fsockopen_curl']['name'] = __('fsockopen/cURL','angle-admin-td');
                    if (function_exists('fsockopen') || function_exists('curl_init')) {
                        if (function_exists('fsockopen') && function_exists('curl_init')) {
                            $posting['fsockopen_curl']['note'] = __('Your server has fsockopen and cURL enabled.', 'angle-admin-td');
                        } elseif (function_exists('fsockopen')) {
                            $posting['fsockopen_curl']['note'] = __('Your server has fsockopen enabled, cURL is disabled.', 'angle-admin-td');
                        } else {
                            $posting['fsockopen_curl']['note'] = __('Your server has cURL enabled, fsockopen is disabled.', 'angle-admin-td');
                        }
                        $posting['fsockopen_curl']['class'] = 'status-ok';
                    } else {
                        $posting['fsockopen_curl']['note'] = __('Your server does not have fsockopen or cURL enabled - PayPal IPN and other scripts which communicate with other servers will not work. Contact your hosting provider.', 'angle-admin-td'). '</mark>';
                        $posting['fsockopen_curl']['class'] = 'status-error';
                    }
                ?>
                <td>
                    <span class="<?php echo $posting['fsockopen_curl']['class']; ?>">
                        <?php echo $posting['fsockopen_curl']['note']; ?>
                    </span>
                </td>
            </tr>
            <?php $active_theme = wp_get_theme(); ?>
            <tr>
                <td><?php _e('Theme Name', 'angle-admin-td'); ?>:</td>
                <td><?php
                    echo $active_theme->Name;
                ?></td>
            </tr>
            <tr>
                <td><?php _e('Theme Version', 'angle-admin-td'); ?>:</td>
                <td><?php
                    echo $active_theme->Version;

                    if (! empty($theme_version_data['version']) && version_compare($theme_version_data['version'], $active_theme->Version, '!='))
                        echo ' &ndash; <strong style="color:red;">' . $theme_version_data['version'] . ' ' . __('is available', 'angle-admin-td') . '</strong>';
                ?></td>
            </tr>
            <tr>
                <td><?php _e('Author URL', 'angle-admin-td'); ?>:</td>
                <td><?php
                    echo $active_theme->{'Author URI'};
                ?></td>
            </tr>
        </tbody>
    </table>

    <br>
    <form id="install-form" method="post" action="admin.php?page=<?php echo THEME_SHORT; ?>-oneclick">
        <h3>OneClick Installer</h3>
        <p class="section-description">Make my site just like the demo site!</p>

        <table class="widefat importers preflight" style="width:100%;">
            <thead>
                <tr>
                    <th><?php _e('Install', 'angle-admin-td'); ?></th>
                    <th><?php _e('Package', 'angle-admin-td'); ?></th>
                    <th><?php _e('Description', 'angle-admin-td'); ?></th>
                    <th><?php _e('Requirements', 'angle-admin-td'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($packages as $key => $install_package): ?>
                    <tr>
                        <td>
                            <label for="users_can_register">
                                <input name="installpackages[]" value="<?php echo $install_package['filename']; ?>" type="checkbox" <?php echo $install_package['checked']; ?> <?php echo $install_package['disabled']; ?>>
                            </label>
                        </td>
                        <td><?php echo $install_package['name'] ?></td>
                        <td><?php echo $install_package['description'] ?></td>
                        <td>
                            <ul>
                                <?php foreach ($install_package['requirements'] as $requirement => $name): ?>
                                    <li>
                                        <?php if (in_array($requirement, $install_package['missing_requirements'])): ?>
                                            <strong style="color:red;">
                                        <?php endif ?>
                                        <?php echo $name; ?>
                                        <?php if (in_array($requirement, $install_package['missing_requirements'])): ?>
                                            (not installed)</strong>
                                        <?php endif ?>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="text-align:center;">
                        <label class="biglabel" for="slowinstall"><input type="checkbox" id="slowinstall" name="slowinstall"> Slow Install - <strong>Select this option if you are on shared hosting like GoDaddy, BlueHost, etc</strong></label>
                        <button name="angle-options[oneclick_setup]" class="one-click">Make Me Beautiful</button>
                    </td>
                </tr>
            </tfoot>
        </table>
        <input type="hidden" name="one_click_status" value="install-page"/>
        <div id="dialog-confirm" class="hidden" title="Install the demo content?">
            <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
                This will install all the demo content onto your current site.  This is best done on a new installation.  Are you sure?
            </p>
        </div>
        <div id="dialog-message" class="hidden" title="Select an install package">
            <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
                You must choose at least one install package.
            </p>
        </div>

    </form>
</div>
