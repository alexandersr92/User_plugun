<?php
global $wpdb;
$table = $wpdb->prefix . 'options';
$endpoint = $wpdb->get_results("SELECT option_value from $table WHERE option_name = 'userPlugin_endpoint'")[0]->option_value;
$cache = $wpdb->get_results("SELECT option_value from $table WHERE option_name = 'userPlugin_cache'")[0]->option_value;
$theme = $wpdb->get_results("SELECT option_value from $table WHERE option_name = 'userPlugin_theme'")[0]->option_value;

?>
<div class="container">
    <div id="notifications"></div>
    <h2>Hello, <?= wp_get_current_user()->display_name ?> Welcome to plugin configurations</h2>
    <hr>
    <table class="form-table" role="presentation">

        <tbody>
            <tr>
                <th scope="row"><label for="endpoint">Custom endpoint<span class="dashicons dashicons-id" aria-hidden="true"></span></label></th>
                <td>
                    <input name="endpoint" type="text" id="endpoint" class="regular-text" value="<?= $endpoint ?>">
                    <p class="description" id="tagline-description">Do you need refrest your permalinks, just click <a href="/wp-admin/options-permalink.php">HERE</a> and then click on save.</p>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="cache">Cache storage time<span class="dashicons dashicons-clock" aria-hidden="true"></span></label></th>

                <td>
                    <input name="cache" type="number" id="cache" class="regular-text" value="<?= $cache ?>">
                    <p class="description" id="tagline-description">Enter the days you want the data cache to be stored.</p>
                </td>
            </tr>



            <tr>
                <th scope="row"><label for="theme">Theme<span class="dashicons dashicons-art" aria-hidden="true"></span></label></th>
                <td>
                    <select id="theme" name="theme">
                        <?php
                        if ($theme == 'dark') {
                        ?>
                            <option value="light">Light</option>
                            <option value="dark" selected>Dark</option>
                        <?php
                        } else {
                        ?>
                            <option value="light" selected>Light</option>
                            <option value="dark">Dark</option>
                        <?php
                        }
                        ?>


                    </select>
                </td>
            </tr>

    </table>
    <button class="button button-primary" id="saveSetting">Save Data</button>
</div>