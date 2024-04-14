<?php
/*
Plugin Name: IDD Calculator
Description: A shipping calculator plugin for WordPress.
Version: 1.0
Author: IDD
*/

// Add admin menu items
function idd_calculator_admin_menu() {
    add_menu_page(
        'IDD Calculator',
        'IDD Calculator',
        'manage_options',
        'idd-calculator',
        'idd_calculator_admin_page',
        'dashicons-calculator',
        6
    );

    // Add submenu for settings
    add_submenu_page(
        'idd-calculator',
        'IDD Calculator Settings',
        'Settings',
        'manage_options',
        'idd-calculator-settings',
        'idd_calculator_settings_page'
    );

    // Add submenu for instructions
add_submenu_page(
    'idd-calculator',
    'IDD Calculator Instructions',
    'Instructions',
    'manage_options',
    'idd-calculator-instructions',
    'idd_calculator_instructions_page'
);

}
add_action('admin_menu', 'idd_calculator_admin_menu');

// Function to display instructions page content
function idd_calculator_instructions_page() {
    ?>
    <div class="wrap">
        <h1>IDD Calculator Instructions</h1>
        <h1>Instructions on how to use the IDD Calculator plugin:</h1>
        <h4>
        It's an plugin for Storage & Moving calculator that makes calculations through two variables:
        <br>
        <br>
        <strong>STORAGE:</strong>
        <br>
        STORAGE_COST_PER_MONTH = TOTAL_CF * defult price Storage_Cost_CF_Month + SPECIAL_ITEMS_COST_PER_MONTH
        <br>
        <br>
        <strong>MOVING:</strong>
        <br>
        STORAGE_MOVE_IN = TOTAL_CF * defult price Move_Cost_CF + SPECIAL_ITEMS_MOVE_COST + DISTANCE_MILES * defult price Move Cost Mile (after First Miles Excluded )
        <br>
        <br>
        <br>
        <br>
        </h4>
        <h2>After installing the plugin, you need to enter details on the settings page:</h2>
        <h3 style="font-size: 1.1em;">General settings:</h3>
        <ol>
            <li>on the field <strong>API Key (Google Sheets, Google Maps)</strong> add google api, activate the services:</li>
            <ul style="list-style: disc !important; margin-left: 10px;">
               <li>Google Sheets API</li>
               <li>Maps JavaScript API</li>
               <li>Geocoding API</li>
               <li>Places API</li>
               <li>Places API (New)</li>
               <li>Directions API</li>
               <li>Distance Matrix API</li>
            </ul>
            <li>on the field <strong>Sheets ID</strong> add the ID of the sheet that contains the products you want to save in the database and display to users , The sheet must be in the following format:</li>
            <ul style="list-style: disc !important; margin-left: 10px; ">
               <li>
               <table style="border-color: #000 !important; border-spacing: 10px;">
               <thead>
               <tr>
               <th>1</th>
               <th>2</th>
               <th>3</th>
               <th>4</th>
               </tr>
               </thead>
               <tbody>
               <tr>
               <td>Name</td>
               <td>Volume</td>
               <td>special Storage Cost Price</td>
               <td>special Move Cost Price</td>
               </tr>
               </tbody>
               </table>
               </li>
               <li>The third and fourth columns enter values only if the product is special</li>
               <ul style="list-style: disc !important; margin-left: 10px;">
               <li>on the third columns Add the price per volume unit (per month)</li>
               <ul style="list-style: disc !important; margin-left: 10px;">
               <li>STORAGE_COST_PER_MONTH = TOTAL_CF * defult price Cost_CF_Month + <strong>SPECIAL_ITEMS_COST_PER_MONTH</strong></li>
               </ul>
               <li>on the fourth columns Add the price per mile</li>
               <ul style="list-style: disc !important; margin-left: 10px;">
               <li>STORAGE_MOVE_IN = TOTAL_CF * defult price Move_Cost_CF + <strong>SPECIAL_ITEMS_MOVE_COST</strong> + DISTANCE_MILES *$3 (after first 15 miles)</li>
               </ul>
               </ul>
            </ul>
            <li>on the field <strong>Tab Name</strong> add the Tab of the sheet that contains the products</li>
            <li>on the field <strong>defult price Storage_Cost_CF_Month</strong> Add the global price of the regular products</li>
            <ul style="list-style: disc !important; margin-left: 10px;">
                <li>STORAGE_COST_PER_MONTH = TOTAL_CF * <strong>defult price Cost_CF_Month</strong> + SPECIAL_ITEMS_COST_PER_MONTH</li>
            </ul>
            <li>on the field <strong>Storage_Address</strong> Add the location of the strage that needs it to calculate the distance from the customer's house to the strage</li>
            <li>on the field <strong>defult price Move_Cost_CF</strong> Add the price per mile (this is only for the regular products)</li>
            <ul style="list-style: disc !important; margin-left: 10px;">
                <li>STORAGE_MOVE_IN = TOTAL_CF * <strong>defult price Move_Cost_CF</strong> + SPECIAL_ITEMS_MOVE_COST + DISTANCE_MILES *$3 (after first 15 miles)</li>
            </ul>
            <li>on the field <strong>First Miles Excluded</strong> Adding first miles is excluded</li>
            <ul style="list-style: disc !important; margin-left: 10px;">
                <li>STORAGE_MOVE_IN = TOTAL_CF * defult price Move_Cost_CF + SPECIAL_ITEMS_MOVE_COST + DISTANCE_MILES *$3 <strong>(after first 15 miles)</strong></li>
            </ul>  
            <li>on the field <strong>defult price Move Cost Mile</strong> Add the price per mile (this is only for the regular products)</li>
            <ul style="list-style: disc !important; margin-left: 10px;">
                <li>STORAGE_MOVE_IN = TOTAL_CF * defult price Move_Cost_CF + SPECIAL_ITEMS_MOVE_COST + DISTANCE_MILES * <strong>defult price Move Cost Mile</strong> (after first 15 miles)</li>
            </ul>  
            <li>on the field <strong>Min CF Move Threshold</strong> Add the minimum volume to move</li>
            <li>on the field <strong>defult price Min CF Move</strong> Add The minimum price to move if the total volume is less than <strong>Min CF Move Threshold</strong></li>
            <li>on the field <strong>Min Distance LD</strong> The maximum distance that will be displayed notification</li>
            <li>on the field <strong>total Price Range</strong> when displaying move cost, add range - current cost + <strong>total Price Range</strong></li>

        </ol>
        <br>
        <br>
        <h3 style="font-size: 1.1em;">notifications settings:</h3>
        <ol>
            <li>on the field <strong>special Move Cost notification</strong> add notification you want to display if special items included</li>
            <li>on the field <strong>Exceptions for Move Cost notification</strong> add notification you want to display if Total_CF <= <strong>Min CF Move Threshold</strong></li>
            <li>on the field <strong>max Distace Miles notification</strong> add notification you want to display if DISTANCE_MILES > <strong>Min Distance LD</strong></li>
            <li>on the field <strong>Insterstate notification</strong> add notification you want to display If INTERSTATE</li>
        </ol>
        <br>
        <br>
        <h3 style="font-size: 1.1em;">style settings:</h3>
        <ol>
            <li>Add values to the fields if you want to override the style of the theme</li>
        </ol>
        <br>
        <br>
        <h2>To display storage calculator:</h2>
        <ol>
            <li>Place the shortcode <code>[idd_storage_calculator]</code> inside your Contact Form 7 form.</li>
            <li>Add two fields to your email template (or sheets):</li>
            <ul style="list-style: disc !important; margin-left: 10px;">
                <li>Items: <code>[calculator-table-content]</code></li>
                <li>Price for storage: <code>[storage-price]</code></li>
                <li>Origin Address: <code>[origin_address]</code></li>
                <li>Distance: <code>[mils]</code> </li>
                <li>Price for moveing: <code>[move-price]</code></li>
                <li>Total Price: <code>[total-price]</code> </li>
            </ul>
            <li>to display the filds on thank you page (using <strong>Redirection for Contact Form 7 plugin)</strong>:</li>
            <ul style="list-style: disc !important; margin-left: 10px;">
                <li>Storage items: [calculator_storage_get_param] (This is different from the other parameters we present through a short code that fetches the information from local storage)</li>
                <li>Total storage Price: [get_param param="storage-price"]</li>
                <li>Origin Address: [get_param param="origin_address"]</li>
                <li>Distance: [get_param param="mils"]</li>
                <li>Total moveing Price [get_param param="move-price"]</li>
                <li>Total price: [get_param param="total-price"]</li>
            </ul>
        </ol>
        <br>
        <br>
        <h2>To display moving calculator:</h2>
        <ol>
            <li>Place the shortcode <code>[idd_moving_calculator]</code> inside your Contact Form 7 form.</li>
            <li>Add two fields to your email template (or sheets):</li>
            <ul style="list-style: disc !important; margin-left: 10px;">
                <li>Items: <code>[calculator-table-content]</code></li>
                <li>Origin Address: <code>[origin_address]</code></li>
                <li>Distance Address: <code>[destination_address]</code></li>
                <li>Distance: <code>[mils]</code> </li>
                <li>Price for moveing: <code>[move-price]</code></li>
            </ul>
            <li>to display the filds on thank you page (using <strong>Redirection for Contact Form 7 plugin)</strong>:</li>
            <ul style="list-style: disc !important; margin-left: 10px;">
                <li>Storage items: [calculator_moving_get_param] (This is different from the other parameters we present through a short code that fetches the information from local storage)</li>
                <li>Origin Address: [get_param param="origin_address"]</li>
                <li>Distance Address: [get_param param="destination_address"]</li>
                <li>Distance: [get_param param="mils"]</li>
                <li>Total moveing Price [get_param param="move-price"]</li>
            </ul>
        </ol>
    </div>
    <?php
}

// Admin page content
function idd_calculator_admin_page() {
    ?>
    <div class="wrap">
        <h1>IDD Calculator</h1>
        <button id="fetch-data">Fetch Data from Google Sheets</button>
        <button id="save-data">Save Data to Database</button>
        <table id="idd-table" class="wp-list-table widefat striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Volume</th>
                    <th>Price</th>
                    <th>Special Move Cost</th> <!-- Added column -->
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <script>
        // Function to fetch data from Google Sheets
        function fetchDataFromSheets(startRow, ignoreCache) {
            let url = '<?php echo admin_url('admin-ajax.php'); ?>?action=idd_calculator_fetch_data_from_sheets';
            
            url += '&start_row=' + startRow;
            
            if (ignoreCache) {
                url += '&ignore_cache=1';
            }

            fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                displayDataInTable(data.values);
            })
            .catch(error => console.error('Error fetching data:', error));
        }

        // Function to display data in table
        function displayDataInTable(data) {
            const tableBody = document.querySelector('#idd-table tbody');
            tableBody.innerHTML = '';
            data.forEach(row => {
                const [name, volume, price, specialMoveCost] = row; // Extracting the new column value
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>${name}</td>
                    <td>${volume}</td>
                    <td>${price}</td>
                    <td>${specialMoveCost}</td> <!-- Displaying the new column value -->
                `;
                tableBody.appendChild(newRow);
            });
        }

        // Function to save data to database
        function saveDataToDatabase() {
            fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=idd_calculator_save_data_to_database', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Data saved successfully!');
                } else {
                    alert('Failed to save data: ' + data.message);
                }
            })
            .catch(error => console.error('Error saving data:', error));
        }

        document.getElementById('fetch-data').addEventListener('click', () => {
            fetchDataFromSheets(2, true); 
        });

        document.getElementById('save-data').addEventListener('click', () => {
            saveDataToDatabase();
        });

        window.addEventListener('load', () => {
            fetchDataFromSheets(2, false); 
        });
    </script>
    <?php
}

// AJAX handler to fetch data from Google Sheets
function idd_calculator_fetch_data_from_sheets() {
    $start_row = isset($_GET['start_row']) ? intval($_GET['start_row']) : 1;
    
    $ignore_cache = isset($_GET['ignore_cache']) && $_GET['ignore_cache'] == 1;

    if ($ignore_cache) {
        delete_transient('idd_calculator_google_sheets_data');
    }

    $data = get_transient('idd_calculator_google_sheets_data');

    if (false === $data) {
        // Fetch data from Google Sheets
        $api_key = get_option('idd_calculator_api_key');
        $sheets_id = get_option('idd_calculator_sheets_id');
        $range = get_option('idd_calculator_range');
        $url = "https://sheets.googleapis.com/v4/spreadsheets/$sheets_id/values/$range?majorDimension=ROWS&key=$api_key&range=A$start_row:D"; // Changed range to include the new column

        $response = wp_remote_get($url);

        if (!is_wp_error($response)) {
            $body = wp_remote_retrieve_body($response);
            $data = json_decode($body, true);
            if (isset($data['values'])) {
                set_transient('idd_calculator_google_sheets_data', $data, 3600);
            }
        }
    }

    wp_send_json($data);
}
add_action('wp_ajax_idd_calculator_fetch_data_from_sheets', 'idd_calculator_fetch_data_from_sheets');

// Function to save data from Google Sheets to the database
function idd_calculator_save_data_to_database() {
    global $wpdb;

    $api_key = get_option('idd_calculator_api_key');
    $sheets_id = get_option('idd_calculator_sheets_id');
    $range = get_option('idd_calculator_range');
    $url = "https://sheets.googleapis.com/v4/spreadsheets/$sheets_id/values/$range?majorDimension=ROWS&key=$api_key&range=A2:D"; // Changed range to include the new column

    $response = wp_remote_get($url);

    if (!is_wp_error($response)) {
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);
        if (isset($data['values'])) {
            $table_name = $wpdb->prefix . 'idd_calculator_data'; 

            // Check if table exists, if not, create it
            if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
                // Table does not exist, create it
                $create_table_query = "CREATE TABLE $table_name (
                                        id INT NOT NULL AUTO_INCREMENT,
                                        name VARCHAR(255),
                                        volume INT,
                                        price DECIMAL(10, 2),
                                        specialMoveCost DECIMAL(10, 2), -- Added the new column
                                        PRIMARY KEY (id)
                                      )";
                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
                dbDelta($create_table_query);
            }

            $wpdb->query("TRUNCATE TABLE $table_name");

            foreach ($data['values'] as $row) {
                $name = $row[0];
                $volume = $row[1];
                $price = isset($row[2]) ? $row[2] : get_option('idd_calculator_defult_price'); 
                $specialMoveCost = isset($row[3]) ? $row[3] : 0; // New column value, defaulting to 0 if not provided

                $result = $wpdb->insert($table_name, array(
                    'name' => $name,
                    'volume' => $volume,
                    'price' => $price,
                    'specialmovecost' => $specialMoveCost
                ));
                
                if ($result === false) {
                    error_log('Failed to insert row: ' . print_r($row, true)); 
                }
            }
            
            wp_send_json(array('success' => true));
        } else {
            wp_send_json(array('success' => false, 'message' => 'No data fetched from Google Sheets'));
        }
    } else {
        wp_send_json(array('success' => false, 'message' => 'Error fetching data from Google Sheets'));
    }
}

add_action('wp_ajax_idd_calculator_save_data_to_database', 'idd_calculator_save_data_to_database');


// Settings page content
function idd_calculator_settings_page() {
    ?>
    <div class="wrap">
        <h1>IDD Calculator Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('idd_calculator_settings_group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">API Key (Google Sheets, Google Maps):</th>
                    <td><input type="text" name="idd_calculator_api_key" value="<?php echo get_option('idd_calculator_api_key'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Sheets ID:</th>
                    <td><input type="text" name="idd_calculator_sheets_id" value="<?php echo get_option('idd_calculator_sheets_id'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Tab Name:</th>
                    <td><input type="text" name="idd_calculator_range" value="<?php echo get_option('idd_calculator_range'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">defult price Storage_Cost_CF_Month:</th>
                    <td><input type="text" name="idd_calculator_defult_price" value="<?php echo get_option('idd_calculator_defult_price'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Storage_Address :</th>
                    <td><input type="text" name="storage_address" value="<?php echo get_option('storage_address'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">defult price Move_Cost_CF:</th>
                    <td><input type="text" name="defult_price_move_cost_cf" value="<?php echo get_option('defult_price_move_cost_cf'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">First Miles Excluded:</th>
                    <td><input type="text" name="first_miles_excluded" value="<?php echo get_option('first_miles_excluded'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">defult price Move Cost Mile :</th>
                    <td><input type="text" name="defult_price_move_cost_mile" value="<?php echo get_option('defult_price_move_cost_mile'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Min CF Move Threshold:</th>
                    <td><input type="text" name="min_cf_move_threshold" value="<?php echo get_option('min_cf_move_threshold'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">defult price Min CF Move:</th>
                    <td><input type="text" name="defult_price_min_cf_move_price" value="<?php echo get_option('defult_price_min_cf_move_price'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Min Distance LD:</th>
                    <td><input type="text" name="min_distance_ld" value="<?php echo get_option('min_distance_ld'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">total Price Range:</th>
                    <td><input type="text" name="total_price_range" value="<?php echo get_option('total_price_range'); ?>" /></td>
                </tr>
                <tr valign="top">
                <th scope="row"><strong>notifications:</strong></th>
                </tr>
                <tr valign="top">
                    <th scope="row">special Move Cost notification:</th>
                    <td><input type="text" name="special_move_cost_notification" value="<?php echo get_option('special_move_cost_notification'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Exceptions for Move Cost notification:</th>
                    <td><input type="text" name="exceptions_for_move_cost_notification" value="<?php echo get_option('exceptions_for_move_cost_notification'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">max Distace Miles notification:</th>
                    <td><input type="text" name="max_distace_miles_notification" value="<?php echo get_option('max_distace_miles_notification'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Insterstate notification:</th>
                    <td><input type="text" name="inster_states_notification" value="<?php echo get_option('inster_states_notification'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">user added special items notification:</th>
                    <td><input type="text" name="special_items_notification" value="<?php echo get_option('special_items_notification'); ?>" /></td>
                </tr>
                <tr valign="top">
                <th scope="row"><strong>style:</strong></th>
                </tr>
                <tr valign="top">
                    <th scope="row">margin between inputs:</th>
                    <td><input type="text" name="idd_margin_con" value="<?php echo get_option('idd_margin_con'); ?>" class="idd_margin_con" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">prise/mil font siza:</th>
                    <td><input type="text" name="idd_price_font_size" value="<?php echo get_option('idd_price_font_size'); ?>" class="idd_price_font_size" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">prise/mil color:</th>
                    <td><input type="text" name="idd_price_color" value="<?php echo get_option('idd_price_color'); ?>" class="idd_price_color" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">color for lable:</th>
                    <td><input type="text" name="idd_lable_color" value="<?php echo get_option('idd_lable_color'); ?>" class="iidd_lable_color" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">lable font siza:</th>
                    <td><input type="text" name="idd_lable_font_size" value="<?php echo get_option('idd_lable_font_size'); ?>" class="idd_lable_font_size" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Color for inputs border:</th>
                    <td><input type="text" name="idd_inputs_border_color" value="<?php echo get_option('idd_inputs_border_color'); ?>" class="idd_inputs_border_color" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Background color for Quantity buttons:</th>
                    <td><input type="text" name="idd_background_quantity_btn" value="<?php echo get_option('idd_background_quantity_btn'); ?>" class="idd_background_quantity_btn" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">+ / - color for Quantity buttons:</th>
                    <td><input type="text" name="idd_color_quantity_btn" value="<?php echo get_option('idd_color_quantity_btn'); ?>" class="idd_color_quantity_btn" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Color for table background:</th>
                    <td><input type="text" name="idd_table_background_color" value="<?php echo get_option('idd_table_background_color'); ?>" class="idd_table_background_color" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Color header table background:</th>
                    <td><input type="text" name="idd_header_table_background_color" value="<?php echo get_option('idd_header_table_background_color'); ?>" class="idd_header_table_background_color" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Color for table border:</th>
                    <td><input type="text" name="idd_table_border_color" value="<?php echo get_option('idd_table_border_color'); ?>" class="idd_table_border_color" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Color for table text:</th>
                    <td><input type="text" name="idd_table_text_color" value="<?php echo get_option('idd_table_text_color'); ?>" class="idd_table_text_color" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">table text font size:</th>
                    <td><input type="text" name="idd_table_text_font" value="<?php echo get_option('idd_table_text_font'); ?>" class="idd_table_text_font" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">color for table hr:</th>
                    <td><input type="text" name="idd_table_hr_color" value="<?php echo get_option('idd_table_hr_color'); ?>" class="idd_table_hr_color" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">table hr font size:</th>
                    <td><input type="text" name="idd_table_hr_font" value="<?php echo get_option('idd_table_hr_font'); ?>" class="idd_table_hr_font" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Color for notifications:</th>
                    <td><input type="text" name="idd_notification_color" value="<?php echo get_option('idd_notification_color'); ?>" class="idd_notification_color" /></td>
                </tr>
                </tr>
                    <tr valign="top">
                    <th scope="row">notifications fonr size:</th>
                    <td><input type="text" name="idd_font_size_notification" value="<?php echo get_option('idd_font_size_notification'); ?>" class="idd_font_size_notification" /></td>
                </tr>
            </table>
            <style>
                .form-table input[type="text"] {
                  width: 50%;
                }
                .form-table th{
                    width: 10%;
                }
            </style>    
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Register settings
function idd_calculator_register_settings() {
    register_setting('idd_calculator_settings_group', 'idd_calculator_api_key');
    register_setting('idd_calculator_settings_group', 'idd_calculator_sheets_id');
    register_setting('idd_calculator_settings_group', 'idd_calculator_range');
    register_setting('idd_calculator_settings_group', 'idd_calculator_defult_price');
    register_setting('idd_calculator_settings_group', 'storage_address');
    register_setting('idd_calculator_settings_group', 'defult_price_move_cost_cf');
    register_setting('idd_calculator_settings_group', 'first_miles_excluded');
    register_setting('idd_calculator_settings_group', 'defult_price_move_cost_mile');
    register_setting('idd_calculator_settings_group', 'min_cf_move_threshold');
    register_setting('idd_calculator_settings_group', 'defult_price_min_cf_move_price');
    register_setting('idd_calculator_settings_group', 'min_distance_ld');
    register_setting('idd_calculator_settings_group', 'total_price_range');
    

    register_setting('idd_calculator_settings_group', 'special_move_cost_notification');
    register_setting('idd_calculator_settings_group', 'exceptions_for_move_cost_notification');
    register_setting('idd_calculator_settings_group', 'max_distace_miles_notification');
    register_setting('idd_calculator_settings_group', 'inster_states_notification');
    register_setting('idd_calculator_settings_group', 'special_items_notification');


    register_setting('idd_calculator_settings_group', 'idd_margin_con');
    register_setting('idd_calculator_settings_group', 'idd_price_font_size');
    register_setting('idd_calculator_settings_group', 'idd_price_color');
    register_setting('idd_calculator_settings_group', 'idd_lable_color');
    register_setting('idd_calculator_settings_group', 'idd_lable_font_size');
    register_setting('idd_calculator_settings_group', 'idd_inputs_border_color');
    register_setting('idd_calculator_settings_group', 'idd_background_quantity_btn');
    register_setting('idd_calculator_settings_group', 'idd_color_quantity_btn');
    register_setting('idd_calculator_settings_group', 'idd_table_background_color');
    register_setting('idd_calculator_settings_group', 'idd_header_table_background_color');
    register_setting('idd_calculator_settings_group', 'idd_table_border_color');

    
    register_setting('idd_calculator_settings_group', 'idd_table_text_color');
    register_setting('idd_calculator_settings_group', 'idd_table_text_font');
    register_setting('idd_calculator_settings_group', 'idd_table_hr_color');
    register_setting('idd_calculator_settings_group', 'idd_table_hr_font');
    register_setting('idd_calculator_settings_group', 'idd_notification_color');
    register_setting('idd_calculator_settings_group', 'idd_font_size_notification');

}
add_action('admin_init', 'idd_calculator_register_settings');




// Shortcode to display product table with quantity input and calculator table
function idd_calculator_product_table_shortcode() {
    ob_start();
    global $wpdb;

    $table_name = $wpdb->prefix . 'idd_calculator_data'; // Get the table name with the appropriate WordPress prefix
    $data = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
    ?>
    <div class="idd-product-table">
        <div id="pro-container">
        <div id="address-container">
        <label class="cal_lable" >Pickup Address</label>
        <input type="text" name="origin_address" id="origin_address">
        </div>    
        <label class="cal_lable">Items</label>
        <div style="display: flex;">
        <div style="width: 100%;"><input type="text" id="search-input" placeholder="Search by name..."></div>
        <div style="align-content: center; position: absolute; right: 0px; transform: translate(-50%, 35%);"><span id="clear-search" class="clear-search-icon">&#x2716;</span></div>
        </div>
        
        <div class="table_div" id="table_div" style="display: none;">
        <table class="wp-list-table widefat striped" id="idd-table" style="display: none; margin-top: 0px !important; margin-bottom: 0px !important;">
            <thead>
                <tr>
                    <th>Name</th>
                    <th style="display: none;">Volume</th>
                    <th style="display: none;">Price</th>
                    <th style="display: none;">specialMoveCost</th>
                    <th style="width: 90px;">Quantity</th> 
                </tr>
            </thead>
            <tbody id="idd-product-table-body">
                <?php foreach ($data as $row) : ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td style="display: none;"><?php echo $row['volume']; ?></td>
                        <td style="display: none;"><?php echo $row['price']; ?></td>
                        <td style="display: none;"><?php echo $row['specialMoveCost']; ?></td>
                        <td>
                        <div class="quantity buttons_added" style="display: flex; float: right;" >
                        <input type="button" value="-" class="minus" onclick="decreaseQuantity(this)">
                        <input style="width: 30px;" type="number" class="quantity-input" value="0" min="0" max="999" onchange="updateCalculator(this)">
                        <input type="button" value="+" class="plus" onclick="increaseQuantity(this)">
                        </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
        </div>

        <p class="cal_lable">If you did not find the product in the list, you can add it by <a id="add-product-link">clicking here</a></p>
        <div id="add-product-container" style="display: none;">
         <input type="text" id="new-product-name" placeholder="Enter product name">
         <button id="add-product-btn" style="width: 50px;">Add</button>
        </div>

        <div id="pro-cal-container">
        <label id="cal-table-title" style="margin-top:50px; display: none;">Your list</label>
<table class="wp-list-table widefat striped" id="idd-calculator" style="display: none; margin-bottom: 0px !important; margin-top: 0px !important;">
    <thead>
        <tr>
            <th>Name</th>
            <th style="display: none;">Volume</th>
            <th style="display: none;">Price</th>
            <th style="display: none;">specialMoveCost</th>
            <th style="width: 90px;">Quantity</th>
            <th style="width: 60px;">Price</th>
        </tr>
    </thead>
    <tbody id="idd-calculator-body">
       
    </tbody>
</table>
</div>
<div id="quantity-container" style="display: none; align-items: center;">
    <div><label style="width: max-content !important;">Quantity:</label></div>
    <div><input type="text" id="sum-quantity" class="sumquantity" name="sum-quantity" style=" border: unset; padding: 0px;  padding-left: 5px !important; background: unset; height: unset !important;" readonly></div>
</div> 
<div id="volume-container" style="display: none; align-items: center; margin-top: -20px;">
    <div><label style="width: max-content !important; ">Total Volume:</label></div>
    <div><input type="text" id="sum-volume" class="sumvolume" name="sum-volume" style="border: unset; padding: 0px;  padding-left: 5px !important; background: unset; height: unset !important;" readonly></div>
</div> 

<div id="pro-cal-container">
    <!-- Existing content -->

    <!-- Insert the special items table here -->
    <label class="special_cal_lable" id="cal-special-table-title" style="display: none; margin-top:50px;">Your Special Items list</label>
    <table class="wp-list-table widefat striped" id="special-items-table" style="display: none; margin-bottom: 0px !important; margin-top: 0px !important;">
        <thead>
            <tr>
                <th>Name</th>
                <th style="width: 90px;">Quantity</th>
            </tr>
        </thead>
        <tbody id="special-items-table-body">
            <!-- Special items table body content will be added dynamically -->
        </tbody>
    </table>
</div>
<div id="quantity-special-container" style="display: none; align-items: center;">
    <div><label style="width: max-content !important;">Quantity:</label></div>
    <div><input type="text" id="sum-special-quantity" class="sumspecialquantity" name="sum-special-quantity" style=" border: unset; padding: 0px;  padding-left: 5px !important; background: unset; height: unset !important;" readonly></div>
</div> 










       <textarea id="calculator-special-table-content" name="calculator-special-table-content" rows="10" cols="50" style="display: none; height: unset !important;" readonly></textarea>
       <textarea id="calculator-table-content" name="calculator-table-content" rows="10" cols="50" style="display: none; height: unset !important;" readonly></textarea>
        

  

        <div id="mils-container" style="display: none; align-items: center;  margin-top:50px;">
        <div><label style="width: max-content !important;">Distance:</label></div>
        <div><input type="text" id="mils" name="mils" style=" border: unset; padding: 0px;  padding-left: 5px !important; background: unset; height: unset !important;" readonly></div>
        </div> 

        <div id="quantity-specialandregular-container" style="display: none; align-items: center;">
        <div><label style="width: max-content !important;">Total quantity:</label></div>
        <div><input type="text" id="SumSpecialAndRegularQuantity" class="SumSpecialAndRegularQuantity" name="SumSpecialAndRegularQuantity" style=" border: unset; padding: 0px;  padding-left: 5px !important; background: unset; height: unset !important;" readonly></div>
        </div> 
        <ul class="price_bullets" style="margin-left: 15px;">
        <li id="sum-q-container" style="display: none;  align-items: center; margin-bottom: -20px !important">
        <div style="align-items: center; display: flex;">
        <div><label style="width: max-content !important;">Quantity:</label></div>
        <div><input type="text" id="sum-CfAndQuantity" class="sum-CfAndQuantity" name="sum-CfAndQuantity" style=" border: unset; padding: 0px;  padding-left: 5px !important; background: unset; height: unset !important;" readonly></div>
        </div>
        </li>
        <li id="special-q" style="display: none;  align-items: center;">
        <div style=" align-items: center; display: flex;">
        <div><label style="width: max-content !important;">Quantity:</label></div>
        <div><input type="text" id="sum-totalspecial-quantity" class="sumspecialquantity" name="sum-totalspecial-quantity" style=" border: unset; padding: 0px;  padding-left: 5px !important; background: unset; height: unset !important;" readonly></div>
        </div> 
        </li>
        </ul>

        <div id="total-storageandmove-price" style="display: none; align-items: center;">
        <div><label style="width: max-content !important;">Estimated Cost:</label></div>
        <div> <input type="text" id="total-move-storage-price" name="total-price" style="border: unset; padding: 0px;  padding-left: 5px !important; background: unset; height: unset !important;" readonly></div>
        </div> 
        <ul class="price_bullets" style="margin-left: 15px;">
        <li id="sum-container" style="display: none; align-items: center; margin-bottom: -20px !important">
        <div style="align-items: center; display: flex;">
        <div><label style="width: max-content !important;">Estimated Storage Cost:</label></div>
        <div><input type="text" id="sum" name="storage-price" style="border: unset; padding: 0px;  padding-left: 5px !important; background: unset; height: unset !important;" readonly></div>
        </div>
        </li>
        <li id="move-price-container" style="display: none; align-items: center;">
        <div style=" align-items: center; display: flex;">
        <div><label style="width: max-content !important;">Estimated Move Cost:</label></div>
        <div> <input type="text" id="move-price" name="move-price" style="border: unset; padding: 0px;  padding-left: 5px !important; background: unset; height: unset !important;" readonly></div>
        </div> 
        </li>
        </ul>



   

        <div id="notification-bullets-container" style="display: none; align-items: center;"><div><label>Notifications:</label></div></div> 
        <ul class="notification_bullets" style="margin-top: 0px !important; margin-left: 15px;">
        <li id="specialMoveCostnotification" style="display: none;"><?php echo get_option('special_move_cost_notification'); ?></li>
        <li id="ExceptionsforMoveCost" style="display: none;"><?php echo get_option('exceptions_for_move_cost_notification'); ?></li>
        <li id="maxDistaceMiles" style="display: none;"><?php echo get_option('max_distace_miles_notification'); ?></li>
        <li id="Insterstate" style="display: none;"><?php echo get_option('inster_states_notification'); ?></li>
        <li id="userSpecialItems" style="display: none;"><?php echo get_option('special_items_notification'); ?></li>
        </ul> 
    </div>
    <style>
        .minus,.plus,.special-minus,.special-plus{
            color: <?php echo get_option('idd_color_quantity_btn'); ?>;
            background: <?php echo get_option('idd_background_quantity_btn'); ?>;
            border-color: <?php echo get_option('idd_background_quantity_btn'); ?>;
            font-size: 18px !important;
        }
    .idd-product-table input[type="text"],
    .idd-product-table input[type="number"],
    .idd-product-table textarea,
    .idd-product-table select,
    .idd-product-table .wp-list-table th,
    .idd-product-table .wp-list-table td,
    .idd-calculator input[type="text"],
    .idd-calculator input[type="number"],
    .idd-calculator textarea,
    .idd-calculator select,
    .idd-calculator .wp-list-table th,
    .idd-calculator .wp-list-table td {
        border-color: <?php echo get_option('idd_inputs_border_color'); ?>;
    }
    thead tr th {
        background: <?php echo get_option('idd_header_table_background_color'); ?>;

    }
    table#idd-table tr,table#idd-calculator tr,table#special-items-table tr{
        background: <?php echo get_option('idd_table_background_color'); ?>;
        color: <?php echo get_option('idd_table_text_color'); ?>;
        font-size: <?php echo get_option('idd_table_text_font'); ?> !important;

    }
    .notification_bullets{
        color: <?php echo get_option('idd_notification_color'); ?>;
        font-size: <?php echo get_option('idd_font_size_notification'); ?> !important;

    }
    .price_bullets{
        margin-top: -20px !important;
    }
    .table_div{
        max-height: 300px !important;
        overflow-y: auto;
        box-shadow: 0px 10px 15px -3px rgba(0,0,0,0.1);
        border: 1px solid <?php echo get_option('idd_table_border_color'); ?> !important;
        background: <?php echo get_option('idd_table_background_color'); ?>;
        position: absolute !important;
        width: 100% !important;
        z-index: 9999;
    }
    .cal_lable{
        font-size: <?php echo get_option('idd_lable_font_size'); ?> !important;
        color: <?php echo get_option('idd_lable_color'); ?> !important;
        margin-top: <?php echo get_option('idd_margin_con'); ?> !important;
    }
    th {
    text-align: left;
    color: <?php echo get_option('idd_table_hr_color'); ?> !important;
    font-size: <?php echo get_option('idd_table_hr_font'); ?> !important;
    }
    #sum,#sum-volume,#sum-quantity,#mils,#move-price,#total-move-storage-price{
        color: <?php echo get_option('idd_price_color'); ?> !important;
        font-size: <?php echo get_option('idd_price_font_size'); ?> !important;
    }

    
    table{
        border: 1.5px solid <?php echo get_option('idd_table_border_color'); ?> !important;

    }
    tr{
        border-bottom: 1px solid <?php echo get_option('idd_table_border_color'); ?> !important;

    }

    input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

input[type=number] {
  -moz-appearance: textfield;
}
</style>

    <script>


document.getElementById('add-product-link').addEventListener('click', function() {
    document.getElementById('add-product-container').style.display = 'flex';
});


document.getElementById('add-product-btn').addEventListener('click', function() {
    const newProductName = document.getElementById('new-product-name').value;
    if (newProductName.trim() !== '') {

        const event = new CustomEvent('new-product-added', { detail: newProductName });
        document.dispatchEvent(event);
        

        document.getElementById('add-product-container').style.display = 'none';
    }
});

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('add-product-btn').addEventListener('click', function(event) {
        event.preventDefault(); 
        const newProductName = document.getElementById('new-product-name').value.trim();
        if (newProductName !== '') {
            createSpecialItemsTable();
            addSpecialItemRow(newProductName);
            document.getElementById('new-product-name').value = ''; 
            document.getElementById('add-product-container').style.display = 'flex';
            document.getElementById('userSpecialItems').style.display = '';
            document.getElementById('special-items-table').style.display = '';
            document.getElementById('notification-bullets-container').style.display = '';
            document.getElementById('quantity-specialandregular-container').style.display = 'flex';
            document.getElementById('special-q').style.display = '';

            updateTextarea(); // Update textarea content after adding a new product
        }
    });
});

function createSpecialItemsTable() {
    if (!document.getElementById('special-items-table')) {
        const specialItemsTitle = document.createElement('label');
        specialItemsTitle.className = 'special_cal_lable';
        specialItemsTitle.id = 'cal-special-table-title';
        specialItemsTitle.textContent = 'Your Special Items list';

        const specialItemsContainer = document.createElement('div');
        specialItemsContainer.id = 'special-items-container';

        specialItemsContainer.appendChild(specialItemsTitle);

        const specialItemsTable = document.createElement('table');
        specialItemsTable.id = 'special-items-table';
        specialItemsTable.className = 'wp-list-table widefat striped';
        specialItemsTable.style.display = '';

        const tableHeader = document.createElement('thead');
        tableHeader.innerHTML = `
            <tr>
                <th>Name</th>
                <th style="width: 90px;">Quantity</th>
            </tr>
        `;

        const tableBody = document.createElement('tbody');
        tableBody.id = 'special-items-table-body';

        specialItemsTable.appendChild(tableHeader);
        specialItemsTable.appendChild(tableBody);
        specialItemsContainer.appendChild(specialItemsTable);

        const addProductContainer = document.getElementById('add-product-container');
        addProductContainer.insertAdjacentElement('afterend', specialItemsContainer);
    }
}

function addSpecialItemRow(productName) {
    const specialItemsTableBody = document.getElementById('special-items-table-body');
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td>${productName}</td>
        <td>
            <div class="special-quantity buttons_added" style="display: flex; float: right;">
                <input type="button" value="-" class="special-minus" onclick="decreasespecialQuantity(this)">
                <input style="width: 30px;" type="number" class="quantity-special-input" value="1" min="0" max="999" onchange="updateCalculator(this)">
                <input type="button" value="+" class="special-plus" onclick="increasespecialQuantity(this)">
            </div>
        </td>
    `;
    specialItemsTableBody.appendChild(newRow);
    updateTextarea(); // Update textarea content after adding a new row
}

function updateTextarea() {
    const specialItemsTableBody = document.getElementById('special-items-table-body');
    const textareaContent = [];
    let specialquantitySum = 0; 

    specialItemsTableBody.querySelectorAll('tr').forEach(row => {
        const productName = row.querySelector('td:first-child').innerText;
        const quantity = row.querySelector('.quantity-special-input').value;
        const sumqspecialuantity = parseInt(row.querySelector('.quantity-special-input').value);

        specialquantitySum += sumqspecialuantity;
        if (quantity > 0) {
            textareaContent.push(`⬤ ${productName} | Quantity: ${quantity}`);
        } else {
            row.remove();
        }

    });

        // Check if the table body is empty
    if (specialItemsTableBody.children.length === 0) {
        document.getElementById('special-items-table').style.display = 'none';
        document.getElementById('userSpecialItems').style.display = 'none';
        document.getElementById('quantity-special-container').style.display = 'none';
        document.getElementById('cal-special-table-title').style.display = 'none';
        document.getElementById('notification-bullets-container').style.display = 'none';

        

    } else {
        document.getElementById('special-items-table').style.display = '';
        document.getElementById('userSpecialItems').style.display = '';
        document.getElementById('quantity-special-container').style.display = 'flex';
        document.getElementById('cal-special-table-title').style.display = '';
        document.getElementById('notification-bullets-container').style.display = '';

    }

    document.getElementById('calculator-special-table-content').value = textareaContent.join('\n');
   
    document.getElementById('sum-special-quantity').value = specialquantitySum + " Special Items"; 
    updateSum();

}


// Function to increase the quantity
function increasespecialQuantity(input) {
    var quantityInput = input.parentNode.querySelector('.quantity-special-input');
    var currentValue = parseInt(quantityInput.value);
    quantityInput.value = currentValue + 1;
    updateTextarea(); // Update textarea content after decreasing quantity

}

// Function to decrease the quantity
function decreasespecialQuantity(input) {
    var quantityInput = input.parentNode.querySelector('.quantity-special-input');
    var currentValue = parseInt(quantityInput.value);
    if (currentValue > 0) {
        quantityInput.value = currentValue - 1;
    }else{
        document.getElementById('userSpecialItems').style.display = 'none';
    }
    updateTextarea(); 
}


function updateCalculator(element) {
    updateTextarea(); // Update textarea content after any change in the calculator
}

function savespecialFormData() {
    const tablespecialContent = document.getElementById('calculator-special-table-content').value;
    localStorage.setItem('calculatorStorageSpecialFormData', tablespecialContent);
}


document.addEventListener('input', function() {
    savespecialFormData();
});










        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('search-input').addEventListener('input', function() {
                const filterText = this.value;
                if (filterText) {
                    document.getElementById('idd-table').style.display = '';
                    document.getElementById('table_div').style.display = '';

                    filterTable(filterText);
                } else {
                    document.getElementById('idd-table').style.display = 'none';
                    document.getElementById('table_div').style.display = 'none';

                }
            });
        });

        // Function to filter table rows based on input
        function filterTable(filterText) {
            const rows = document.querySelectorAll('#idd-product-table-body tr');
            rows.forEach(row => {
                const nameCell = row.querySelector('td:first-child');
                if (nameCell.innerText.toLowerCase().includes(filterText.toLowerCase())) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
        

        document.addEventListener('DOMContentLoaded', function() {

             document.getElementById('clear-search').addEventListener('click', function() {

        document.getElementById('search-input').value = '';

        document.getElementById('idd-table').style.display = 'none';
        document.getElementById('table_div').style.display = 'none';

          });
        });

        document.addEventListener('click', function(event) {
   
          if (!event.target.closest('#search-input') && !event.target.closest('#idd-table')) {

            document.getElementById('search-input').value = '';

            document.getElementById('idd-table').style.display = 'none';
            document.getElementById('table_div').style.display = 'none';

          }
        });        

// Function to increase the quantity
function increaseQuantity(input) {
    var quantityInput = input.parentNode.querySelector('.quantity-input');
    var currentValue = parseInt(quantityInput.value);
    quantityInput.value = currentValue + 1;
    updateCalculator(quantityInput); // Trigger updateCalculator after updating the quantity

    // Update the quantity in the second table
    const name = input.closest('tr').querySelector('td:first-child').innerText;
    const calculatorQuantityInput = document.querySelector(`#idd-calculator-body tr[data-name="${name}"] .quantity-input`);
    if (calculatorQuantityInput) {
        calculatorQuantityInput.value = currentValue + 1;
        updateCalculator(calculatorQuantityInput); // Trigger updateCalculator for the corresponding row in the second table
    }
}

// Function to decrease the quantity
function decreaseQuantity(input) {
    var quantityInput = input.parentNode.querySelector('.quantity-input');
    var currentValue = parseInt(quantityInput.value);
    if (currentValue > 0) {
        quantityInput.value = currentValue - 1;
        updateCalculator(quantityInput); // Trigger updateCalculator after updating the quantity

        // Update the quantity in the second table
        const name = input.closest('tr').querySelector('td:first-child').innerText;
        const calculatorQuantityInput = document.querySelector(`#idd-calculator-body tr[data-name="${name}"] .quantity-input`);
        if (calculatorQuantityInput) {
            calculatorQuantityInput.value = currentValue - 1;
            updateCalculator(calculatorQuantityInput); // Trigger updateCalculator for the corresponding row in the second table
        }
    }
}


// Function to update calculator table
function updateCalculator(input) {
    const quantityInput = input.parentNode.querySelector('.quantity-input');
    const quantity = parseInt(quantityInput.value);
    const row = input.parentNode.parentNode.parentNode; // Adjusted to match the new HTML structure

    const name = row.querySelector('td:first-child').innerText;
    const volume = parseFloat(row.querySelector('td:nth-child(2)').innerText);
    const price = parseFloat(row.querySelector('td:nth-child(3)').innerText);
    const specialMoveCost = parseFloat(row.querySelector('td:nth-child(4)').innerText);
    let total;

    document.getElementById('idd-calculator').style.display = '';
    document.getElementById('cal-table-title').style.display = '';
    document.getElementById('move-price-container').style.display = '';

    document.getElementById('sum-container').style.display = '';
    document.getElementById('sum-q-container').style.display = '';
    document.getElementById('total-storageandmove-price').style.display = 'flex';

    document.getElementById('volume-container').style.display = 'flex';
    document.getElementById('quantity-container').style.display = 'flex';
    document.getElementById('quantity-specialandregular-container').style.display = 'flex';

    // Check if the price is equal to the default price
    const defaultPrice = parseFloat("<?php echo get_option('idd_calculator_defult_price'); ?>");
    if (price === defaultPrice) {
        total = volume * price * quantity;
    } else {
        total = price * quantity;
    }

    // If quantity is 0, remove the row from the calculator
    if (quantity === 0) {
        const calculatorRow = document.querySelector(`#idd-calculator-body tr[data-name="${name}"]`);
        if (calculatorRow) {
            calculatorRow.remove();
        }
        if (document.querySelectorAll('#idd-calculator-body tr').length === 0) {
            document.getElementById('idd-calculator').style.display = 'none';
            document.getElementById('cal-table-title').style.display = 'none';
            document.getElementById('move-price-container').style.display = 'none';
            document.getElementById('total-storageandmove-price').style.display = 'none';

            document.getElementById('volume-container').style.display = 'none';
            document.getElementById('quantity-container').style.display = 'none';
            document.getElementById('sum-container').style.display = 'none';
            document.getElementById('sum-q-container').style.display = 'none';

        }
        calculatePrice();
        updateSum();
        updateSpecialMoveCostNotification();
        updateExceptionsforMoveCost();
        displayTotalPrice();
        return;
    }

    // Check if the row already exists in the calculator table
    const calculatorRow = document.querySelector(`#idd-calculator-body tr[data-name="${name}"]`);
    if (calculatorRow) {
        calculatorRow.querySelector('.quantity').value = quantity;
        calculatorRow.querySelector('.total').innerText = '$' + parseInt(total);
    } else {
        const calculatorBody = document.getElementById('idd-calculator-body');
        const newRow = document.createElement('tr');
        newRow.setAttribute('data-name', name);
        newRow.innerHTML = `
            <td>${name}</td>
            <td style="display: none;">${volume}</td>
            <td style="display: none;">${price}</td>
            <td style="display: none;">${specialMoveCost}</td>
            <td>
            <div class="quantity buttons_added" style="display: flex; float: right;" >
        <input type="button" value="-" class="minus" onclick="decreaseQuantity(this)">
        <input style="width: 30px;" type="number" class="quantity-input" value="${quantity}" min="0" max="999" onchange="updateCalculator(this)">
        <input type="button" value="+" class="plus" onclick="increaseQuantity(this)">
    </div>
            </td>
            <td class="total" style="float: right;">$${total}</td>`;
        calculatorBody.appendChild(newRow);
    }

    updateSum();
    calculatePrice();
    updateSpecialMoveCostNotification();
    updateExceptionsforMoveCost();
    displayTotalPrice();
}



function updateProductTable() {
    const inputs = document.querySelectorAll('#idd-product-table-body .quantity');
    inputs.forEach(input => {
        if (input.value === '0') {
            input.parentNode.parentNode.remove();
        }
    });
    calculatePrice(); 
}

// Function to update the special move cost notification
function updateSpecialMoveCostNotification() {
    const specialMoveCostNotification = document.getElementById('specialMoveCostnotification');
    const notificationbulletscontainer = document.getElementById('notification-bullets-container');

    const rows = document.querySelectorAll('#idd-calculator-body tr');
    let specialMoveSelected = false;
    rows.forEach(row => {
        const specialMoveCost = parseFloat(row.querySelector('td:nth-child(4)').innerText);
        if (specialMoveCost !== 0) {
            specialMoveSelected = true;
        }
    });
    if (specialMoveSelected) {
        specialMoveCostNotification.style.display = '';
        notificationbulletscontainer.style.display = '';

    } else {
        specialMoveCostNotification.style.display = 'none';
        notificationbulletscontainer.style.display = 'none';

    }
}
// Function to update total sum and volume sum
function updateSum() {
    const totals = document.querySelectorAll('#idd-calculator-body .total');

    let sum = 0;
    let volumeSum = 0; 
    let quantitySum = 0; 
    let tableContent = ''; 
    totals.forEach(total => {
        const value = parseFloat(total.innerText.replace('$', '')); 
        if (!isNaN(value)) {
            sum += value;
            const row = total.parentNode;
            const volume = parseFloat(row.querySelector('td:nth-child(2)').innerText); 
            const specialMoveCost = parseFloat(row.querySelector('td:nth-child(4)').innerText); 
            const quantity = row.querySelector('.quantity').value;
            const quantityforcal = parseInt(row.querySelector('.quantity').value);

            if (specialMoveCost === 0) {
                volumeSum += volume * quantity; 
            }
            quantitySum += quantityforcal;
            const name = row.querySelector('td:first-child').innerText;
            tableContent += `⬤ ${name} | Quantity: ${quantity} | ${total.innerText}\n`; 
        }
    });
    


    var specialQuantity = parseInt(document.getElementById('sum-special-quantity').value.replace(' Special Items', ''));
    var regularQuantity = quantitySum; 

   if (!isNaN(specialQuantity)) {
      document.getElementById('SumSpecialAndRegularQuantity').value = parseInt(document.getElementById('sum-special-quantity').value.replace(' Special Items', '')) + quantitySum + " Items";
   } else {
      document.getElementById('SumSpecialAndRegularQuantity').value = "";
   }






    document.getElementById('sum').value = '$' + sum.toFixed(2) + " / month"; 
    document.getElementById('calculator-table-content').value = tableContent; 
    document.getElementById('sum-volume').value = volumeSum + " CF"; 
    document.getElementById('sum-quantity').value = quantitySum + " Items"; 
    document.getElementById('sum-CfAndQuantity').value = quantitySum + " Items" + " (" + volumeSum + " CF" +")"; 
    //document.getElementById('SumSpecialAndRegularQuantity').value = parseInt(document.getElementById('sum-special-quantity').value.replace(' Special Items', '')) + quantitySum + " Items"; 
    document.getElementById('sum-totalspecial-quantity').value = document.getElementById('sum-special-quantity').value ; 


}


// Function to autocomplete origin address 
function autocompleteAddress() {
    const input = document.getElementById('origin_address');
    const options = {
        types: ['address'] 
    };
    const autocomplete = new google.maps.places.Autocomplete(input, options);
    autocomplete.addListener('place_changed', function() {
        const place = autocomplete.getPlace();
        if (!place.geometry) {
            console.error('Place not found');
            return;
        }
        calculateDistance();
        updateSpecialMoveCostNotification();
    updateExceptionsforMoveCost();
    checkLocationAgainstStorage();
    displayTotalPrice();
        console.log('Formatted Address:', place.formatted_address);
        console.log('Latitude:', place.geometry.location.lat());
        console.log('Longitude:', place.geometry.location.lng());
    });
}




function calculateDistance() {
    const origin = document.getElementById('origin_address').value;
    const destination = "<?php echo get_option('storage_address'); ?>";
    const minDistanceLD = parseFloat("<?php echo get_option('min_distance_ld'); ?>");
    const service = new google.maps.DistanceMatrixService();
    document.getElementById('mils-container').style.display = 'flex';


    service.getDistanceMatrix(
        {
            origins: [origin],
            destinations: [destination],
            travelMode: 'DRIVING',
            unitSystem: google.maps.UnitSystem.IMPERIAL
        },
        (response, status) => {
            if (status === 'OK') {
                const distanceMeters = response.rows[0].elements[0].distance.value;
                const distanceMiles = distanceMeters * 0.000621371; 


                if (distanceMiles >= minDistanceLD) {
                    document.getElementById('maxDistaceMiles').style.display = '';
                    document.getElementById('notification-bullets-container').style.display = '';

                } else {
                    document.getElementById('maxDistaceMiles').style.display = 'none';
                    document.getElementById('notification-bullets-container').style.display = 'none';

                }
                const distanceText = distanceMiles.toFixed(2) + ' mi';
                document.getElementById('mils').value = distanceText;
                
               
                
                calculatePrice();
            } else {
                console.error('Error:', status);
            }
        }
        
    );

}
document.getElementById('origin_address').addEventListener('change', calculateDistance);


function checkLocationAgainstStorage() {
    const userAddress = document.getElementById('origin_address').value;
    const storageAddress = "<?php echo get_option('storage_address'); ?>";

    // Perform Geocoding to get the country of the user's address
    const geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'address': userAddress }, function(results, status) {
        if (status === 'OK') {
            const userCountry = results[0].address_components.find(component => component.types.includes('country')).short_name;
            
            // Perform Geocoding to get the country of the storage address
            geocoder.geocode({ 'address': storageAddress }, function(results, status) {
                if (status === 'OK') {
                    const storageCountry = results[0].address_components.find(component => component.types.includes('country')).short_name;
                    
                    // Compare the countries
                    if (userCountry !== storageCountry) {
                        document.getElementById('Insterstate').style.display = '';
                        document.getElementById('notification-bullets-container').style.display = '';

                    } else {
                        document.getElementById('Insterstate').style.display = 'none';
                        document.getElementById('notification-bullets-container').style.display = 'none';

                    }
                } else {
                    console.error('Geocode was not successful for the storage address:', status);
                }
            });
        } else {
            console.error('Geocode was not successful for the user address:', status);
        }
    });
}


// Load Google Maps Places API with the provided API key
function loadGoogleMapsAPI() {
    const api_key = "<?php echo get_option('idd_calculator_api_key'); ?>";

    const script = document.createElement('script');
    script.src = `https://maps.googleapis.com/maps/api/js?key=${api_key}&libraries=places&callback=autocompleteAddress`;
    script.defer = true;
    document.body.appendChild(script);
}

document.addEventListener('DOMContentLoaded', loadGoogleMapsAPI);

function calculatePrice() {
    const rows = document.querySelectorAll('#idd-calculator-body tr');
    const distanceMiles = parseFloat(document.getElementById('mils').value.replace(' mi', ''));
    const defaultPricePerMile = parseFloat("<?php echo get_option('defult_price_move_cost_mile'); ?>");
    const FirstMilesExcluded = parseFloat("<?php echo get_option('first_miles_excluded'); ?>");
    const defultpriceMinCFMove = parseFloat("<?php echo get_option('defult_price_min_cf_move_price'); ?>");
    const MinCFMoveThreshold = parseFloat("<?php echo get_option('min_cf_move_threshold'); ?>");

    let moveprice = 0
    const sumvolume = parseFloat(document.getElementById('sum-volume').value.replace(' CF', ''));
    if(distanceMiles <= FirstMilesExcluded){
        moveprice = 0;
    } else{
        moveprice = (distanceMiles * defaultPricePerMile);

    }
    let totalPrice = 0;
    let price = 0;
    let specialPrice = 0;
    let specialMoveCostNotification = document.getElementById('specialMoveCostnotification');
    rows.forEach(row => {
        const specialMoveCost = parseFloat(row.querySelector('td:nth-child(4)').innerText);
        const quantity = parseInt(row.querySelector('.quantity').value);
        const defaultPricePerCF = parseFloat("<?php echo get_option('defult_price_move_cost_cf'); ?>");
        if (specialMoveCost === 0) {
            if(sumvolume <= MinCFMoveThreshold){
               price = defultpriceMinCFMove;
            }else{
                price = (sumvolume * defaultPricePerCF) ;
            }              
        } else {
            specialPrice = (specialMoveCost * quantity);
        }
    });

    totalPrice += price + moveprice + specialPrice;


    const totalPriceRange = parseInt("<?php echo get_option('total_price_range'); ?>");


    const movePriceField = document.getElementById('move-price');
    movePriceField.value = isNaN(totalPrice) ? '' : '$' + totalPrice.toFixed(2) + ' ⇄ ' + '$'+ parseInt(totalPrice + totalPriceRange);
    updateSpecialMoveCostNotification();
    updateExceptionsforMoveCost();
    displayTotalPrice();

}
// Call calculatePrice whenever the quantity changes
document.getElementById('idd-calculator').addEventListener('input', function(event) {
    if (event.target.classList.contains('quantity')) {
        calculatePrice();
    }
});
document.getElementById('origin_address').addEventListener('change', calculatePrice);

// Function to update the exceptions for move cost notification
function updateExceptionsforMoveCost() {
    const ExceptionsforMoveCost = document.getElementById('ExceptionsforMoveCost');
        const notificationbulletscontainer = document.getElementById('notification-bullets-container');
    const MinCFMoveThreshold = parseFloat("<?php echo get_option('min_cf_move_threshold'); ?>");
    const sumvolume = parseFloat(document.getElementById('sum-volume').value.replace(' CF', ''));

    if (sumvolume <= MinCFMoveThreshold) {
        ExceptionsforMoveCost.style.display = '';
                notificationbulletscontainer.style.display = '';

    } else {
        ExceptionsforMoveCost.style.display = 'none';
                notificationbulletscontainer.style.display = 'none';

    }
}

document.getElementById('move-price').addEventListener('input', updateExceptionsforMoveCost);




function displayTotalPrice() {
    const sumWithSuffix = document.getElementById('sum').value;
    const sumWithoutSuffix = sumWithSuffix.replace(' / month', '');
    const sum = parseFloat(sumWithoutSuffix.replace('$', ''));
    
    const movePrice = parseFloat(document.getElementById('move-price').value.replace('$', ''));
    const totalPriceField = document.getElementById('total-move-storage-price');
    const totalPrice = sum + movePrice;
    const totalPriceRange = parseInt("<?php echo get_option('total_price_range'); ?>");

    totalPriceField.value = isNaN(totalPrice) ? '' : '$' + totalPrice.toFixed(2) + ' ⇄ ' + '$'+ parseInt(totalPrice + totalPriceRange ) ;
}


document.getElementById('sum').addEventListener('input', displayTotalPrice);
document.getElementById('move-price').addEventListener('input', displayTotalPrice);

function saveFormData() {
    const tableContent = document.getElementById('calculator-table-content').value;
    localStorage.setItem('calculatorFormData', tableContent);
}


document.addEventListener('input', function() {
    saveFormData();
});



        updateSum();
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('idd_storage_calculator', 'idd_calculator_product_table_shortcode');


function calculator_storage_get_param() {
    ob_start();
?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Retrieve data from localStorage
            const formData = localStorage.getItem('calculatorFormData');
            const tableParamInput = document.getElementById('calculator_get_storage_table_param');

            // Display the data
            document.getElementById('calculator-form-data').innerText = formData || '';
            if (tableParamInput) {
                tableParamInput.value = formData || '';
            }
        });
    </script>

    <div id="calculator-form-data"></div>
<?php
    return ob_get_clean();
}
add_shortcode('calculator_storage_get_param', 'calculator_storage_get_param');

function calculator_special_storage_get_param() {
    ob_start();
?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Retrieve data from localStorage
            const formData = localStorage.getItem('calculatorStorageSpecialFormData');
            const tableParamInput = document.getElementById('calculator_get_storage_specia_table_param');

            // Display the data
            document.getElementById('calculator-storage-special-form-data').innerText = formData || '';
            if (tableParamInput) {
                tableParamInput.value = formData || '';
            }
        });
    </script>

    <div id="calculator-storage-special-form-data"></div>
<?php
    return ob_get_clean();
}
add_shortcode('calculator_special_storage_get_param', 'calculator_special_storage_get_param');


// Shortcode to display product table with quantity input and calculator table
function idd_moving_calculator_product_table_shortcode() {
    ob_start();
    global $wpdb;

    $table_name = $wpdb->prefix . 'idd_calculator_data'; // Get the table name with the appropriate WordPress prefix
    $data = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
    ?>
    <div class="idd-product-table">
        <div id="pro-container">
        <div id="origin-container">
        <label class="cal_lable" >Origin Address</label>
        <input type="text" name="origin_address" id="origin_address">
        </div> 
        <div id="address-container">
        <label class="cal_lable" >Destination Address</label>
        <input type="text" name="destination_address" id="destination_address">
        </div> 



        

        
        <label class="cal_lable">Items</label>
        <div style="display: flex;">
        <div style="width: 100%;"><input type="text" id="search-input" placeholder="Search by name..."></div>
        <div style="align-content: center; position: absolute; right: 0px; transform: translate(-50%, 35%);"><span id="clear-search" class="clear-search-icon">&#x2716;</span></div>
        </div>
        <div class="table_div" id="table_div" style="display: none;">
        <table class="wp-list-table widefat striped" id="idd-table" style="display: none; margin-top: 0px !important; margin-bottom: 0px !important;">
            <thead>
                <tr>
                    <th>Name</th>
                    <th style="display: none;">Volume</th>
                    <th style="display: none;">Price</th>

                    <th style="display: none;">specialMoveCost</th>
                    <th style="width: 90px;">Quantity</th> 
                </tr>
            </thead>
            <tbody id="idd-product-table-body">
                <?php foreach ($data as $row) : ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td style="display: none;"><?php echo $row['volume']; ?></td>
                        <td style="display: none;"><?php echo $row['price']; ?></td>
                        <td style="display: none;"><?php echo $row['specialMoveCost']; ?></td>
                        <td>
                        <div class="quantity buttons_added" style="display: flex; float: right;" >
                        <input type="button" value="-" class="minus" onclick="decreaseQuantity(this)">
                        <input style="width: 30px;" type="number" class="quantity-input" value="0" min="0" max="999" onchange="updateCalculator(this)">
                        <input type="button" value="+" class="plus" onclick="increaseQuantity(this)">
                        </div>                       
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
        </div>


        <p class="cal_lable">If you did not find the product in the list, you can add it by <a id="add-product-link">clicking here</a></p>
        <div id="add-product-container" style="display: none;">
         <input type="text" id="new-product-name" placeholder="Enter product name">
         <button id="add-product-btn" style="width: 50px;">Add</button>
        </div>


        <div id="pro-cal-container">
        <label id="cal-table-title" style="margin-top:50px; display: none;">Your list</label>
<table class="wp-list-table widefat striped" id="idd-calculator" style="display: none; margin-bottom: 0px !important; margin-top: 0px !important;">
    <thead>
        <tr>
            <th>Name</th>
            <th style="display: none;">Volume</th>
            <th style="display: none;">Price</th>
            <th style="display: none;">specialMoveCost</th>
            <th style="width: 90px;">Quantity</th>
            <th style="display: none;">Price</th>
        </tr>
    </thead>
    <tbody id="idd-calculator-body">
       
    </tbody>
</table>
</div>
<div id="quantity-container" style="display: none; align-items: center; ">
    <div><label style="width: max-content !important;">Quantity:</label></div>
    <div><input type="text" id="sum-quantity" class="sumquantity" name="sum-quantity" style=" border: unset; padding: 0px;  padding-left: 5px !important; background: unset; height: unset !important;" readonly></div>
</div> 
<div id="volume-container" style="display: none; align-items: center; margin-top: -20px;">
    <div><label style="width: max-content !important;">Total Volume:</label></div>
    <div><input type="text" id="sum-volume" class="sumvolume" name="sum-volume" style=" border: unset; padding: 0px;  padding-left: 5px !important; background: unset; height: unset !important;" readonly></div>
</div> 


<div id="pro-cal-container">
    <!-- Existing content -->

    <!-- Insert the special items table here -->
    <label class="special_cal_lable" id="cal-special-table-title" style="display: none; margin-top:50px;">Your Special Items list</label>
    <table class="wp-list-table widefat striped" id="special-items-table" style="display: none; margin-bottom: 0px !important; margin-top: 0px !important;">
        <thead>
            <tr>
                <th>Name</th>
                <th style="width: 90px;">Quantity</th>
            </tr>
        </thead>
        <tbody id="special-items-table-body">
            <!-- Special items table body content will be added dynamically -->
        </tbody>
    </table>
</div>
<div id="quantity-special-container" style="display: none; align-items: center;">
    <div><label style="width: max-content !important;">Quantity:</label></div>
    <div><input type="text" id="sum-special-quantity" class="sumspecialquantity" name="sum-special-quantity" style=" border: unset; padding: 0px;  padding-left: 5px !important; background: unset; height: unset !important;" readonly></div>
</div> 


<div id="mils-container" style="display: none; align-items: center; margin-top:50px;">
        <div><label style="width: max-content !important;">Distance:</label></div>
        <div><input type="text" id="mils" name="mils" style=" border: unset; padding: 0px;  padding-left: 5px !important; background: unset; height: unset !important;" readonly></div>
        </div> 

        <div id="quantity-specialandregular-container" style="display: none; align-items: center;">
        <div><label style="width: max-content !important;">Total quantity:</label></div>
        <div><input type="text" id="SumSpecialAndRegularQuantity" class="SumSpecialAndRegularQuantity" name="SumSpecialAndRegularQuantity" style=" border: unset; padding: 0px;  padding-left: 5px !important; background: unset; height: unset !important;" readonly></div>
        </div> 
        <ul class="price_bullets" style="margin-left: 15px;" >
        <li id="sum-q-container" style="display: none;  align-items: center; margin-bottom: -20px !important">
        <div style="align-items: center; display: flex;">
        <div><label style="width: max-content !important;">Quantity:</label></div>
        <div><input type="text" id="sum-CfAndQuantity" class="sum-CfAndQuantity" name="sum-CfAndQuantity" style=" border: unset; padding: 0px;  padding-left: 5px !important; background: unset; height: unset !important;" readonly></div>
        </div>
        </li>
        <li id="special-q" style="display: none;  align-items: center;">
        <div style=" align-items: center; display: flex;">
        <div><label style="width: max-content !important;">Quantity:</label></div>
        <div><input type="text" id="sum-totalspecial-quantity" class="sumspecialquantity" name="sum-totalspecial-quantity" style=" border: unset; padding: 0px;  padding-left: 5px !important; background: unset; height: unset !important;" readonly></div>
        </div> 
        </li>
        </ul>

        
<div id="move-price-container" style="display: none; align-items: center;">
        <div><label style="width: max-content !important;">Estimated Move Cost:</label></div>
        <div> <input type="text" id="move-price" name="move-price" style="border: unset; padding: 0px;  padding-left: 5px !important; background: unset; height: unset !important;" readonly></div>
</div> 


        <div id="notification-bullets-container" style="display: none; align-items: center;"><div><label>Notifications:</label></div></div> 
        <ul class="notification_bullets" style="margin-top: 0px !important; margin-left: 15px;">
        <li id="specialMoveCostnotification" style="display: none;"><?php echo get_option('special_move_cost_notification'); ?></li>
        <li id="ExceptionsforMoveCost" style="display: none;"><?php echo get_option('exceptions_for_move_cost_notification'); ?></li>
        <li id="maxDistaceMiles" style="display: none;"><?php echo get_option('max_distace_miles_notification'); ?></li>
        <li id="Insterstate" style="display: none;"><?php echo get_option('inster_states_notification'); ?></li>
        <li id="userSpecialItems" style="display: none;"><?php echo get_option('special_items_notification'); ?></li>
        </ul> 


       <textarea id="calculator-special-table-content" name="calculator-special-table-content" rows="10" cols="50" style="display: none; height: unset !important;" readonly></textarea>

        <textarea id="calculator-table-content" name="calculator-table-content" rows="10" cols="50" style="display: none; height: unset !important;" readonly></textarea>
        
       
    </div>
    <style>
        .minus,.plus,.special-minus,.special-plus{
            color: <?php echo get_option('idd_color_quantity_btn'); ?>;
            background: <?php echo get_option('idd_background_quantity_btn'); ?>;
            border-color: <?php echo get_option('idd_background_quantity_btn'); ?>;
            font-size: 18px !important;
        }
    .idd-product-table input[type="text"],
    .idd-product-table input[type="number"],
    .idd-product-table textarea,
    .idd-product-table select,
    .idd-product-table .wp-list-table th,
    .idd-product-table .wp-list-table td,
    .idd-calculator input[type="text"],
    .idd-calculator input[type="number"],
    .idd-calculator textarea,
    .idd-calculator select,
    .idd-calculator .wp-list-table th,
    .idd-calculator .wp-list-table td {
        border-color: <?php echo get_option('idd_inputs_border_color'); ?>;
    }
    thead tr th{
        background: <?php echo get_option('idd_header_table_background_color'); ?>;

    }
    table#idd-table tr,table#idd-calculator tr,table#special-items-table tr{
        background: <?php echo get_option('idd_table_background_color'); ?>;
        color: <?php echo get_option('idd_table_text_color'); ?>;
        font-size: <?php echo get_option('idd_table_text_font'); ?> !important;

    }
    .notification_bullets{
        color: <?php echo get_option('idd_notification_color'); ?>;
        font-size: <?php echo get_option('idd_font_size_notification'); ?> !important;

    }
    .table_div{
        max-height: 300px !important;
        overflow-y: auto;
        box-shadow: 0px 10px 15px -3px rgba(0,0,0,0.1);
        border: 1px solid <?php echo get_option('idd_table_border_color'); ?> !important;
        background: <?php echo get_option('idd_table_background_color'); ?>;
        position: absolute !important;
        width: 100% !important;
        z-index: 9999;
    }
    .cal_lable{
        font-size: <?php echo get_option('idd_lable_font_size'); ?> !important;
        color: <?php echo get_option('idd_lable_color'); ?> !important;
        margin-top: <?php echo get_option('idd_margin_con'); ?> !important;

    }
    th {
    text-align: left;
    color: <?php echo get_option('idd_table_hr_color'); ?> !important;
    font-size: <?php echo get_option('idd_table_hr_font'); ?> !important;
    }
    #sum,#sum-volume,#sum-quantity,#mils,#move-price{
        color: <?php echo get_option('idd_price_color'); ?> !important;
        font-size: <?php echo get_option('idd_price_font_size'); ?> !important;
    }
   
    table{
        border: 1.5px solid <?php echo get_option('idd_table_border_color'); ?> !important;

    }
    tr{
        border-bottom: 1px solid <?php echo get_option('idd_table_border_color'); ?> !important;

    }
    .price_bullets{
        margin-top: -20px !important;
    }
    input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

input[type=number] {
  -moz-appearance: textfield;
}
</style>

    <script>

document.getElementById('add-product-link').addEventListener('click', function() {
    document.getElementById('add-product-container').style.display = 'flex';
});


document.getElementById('add-product-btn').addEventListener('click', function() {
    const newProductName = document.getElementById('new-product-name').value;
    if (newProductName.trim() !== '') {

        const event = new CustomEvent('new-product-added', { detail: newProductName });
        document.dispatchEvent(event);
        

        document.getElementById('add-product-container').style.display = 'none';
    }
});

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('add-product-btn').addEventListener('click', function(event) {
        event.preventDefault(); 
        const newProductName = document.getElementById('new-product-name').value.trim();
        if (newProductName !== '') {
            createSpecialItemsTable();
            addSpecialItemRow(newProductName);
            document.getElementById('new-product-name').value = ''; 
            document.getElementById('add-product-container').style.display = 'flex';
            document.getElementById('userSpecialItems').style.display = '';
            document.getElementById('notification-bullets-container').style.display = '';
            document.getElementById('special-items-table').style.display = '';
            document.getElementById('quantity-specialandregular-container').style.display = 'flex';
            document.getElementById('special-q').style.display = '';

            updateTextarea(); // Update textarea content after adding a new product
        }
    });
});

function createSpecialItemsTable() {
    if (!document.getElementById('special-items-table')) {
        const specialItemsTitle = document.createElement('label');
        specialItemsTitle.className = 'special_cal_lable';
        specialItemsTitle.id = 'cal-special-table-title';
        specialItemsTitle.textContent = 'Your Special Items list';

        const specialItemsContainer = document.createElement('div');
        specialItemsContainer.id = 'special-items-container';

        specialItemsContainer.appendChild(specialItemsTitle);

        const specialItemsTable = document.createElement('table');
        specialItemsTable.id = 'special-items-table';
        specialItemsTable.className = 'wp-list-table widefat striped';
        specialItemsTable.style.display = '';

        const tableHeader = document.createElement('thead');
        tableHeader.innerHTML = `
            <tr>
                <th>Name</th>
                <th style="width: 90px;">Quantity</th>
            </tr> 
        `;

        const tableBody = document.createElement('tbody');
        tableBody.id = 'special-items-table-body';

        specialItemsTable.appendChild(tableHeader);
        specialItemsTable.appendChild(tableBody);
        specialItemsContainer.appendChild(specialItemsTable);

        const addProductContainer = document.getElementById('add-product-container');
        addProductContainer.insertAdjacentElement('afterend', specialItemsContainer);
    }
}

function addSpecialItemRow(productName) {
    const specialItemsTableBody = document.getElementById('special-items-table-body');
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td>${productName}</td>
        <td>
            <div class="special-quantity buttons_added" style="display: flex; float: right;">
                <input type="button" value="-" class="special-minus" onclick="decreasespecialQuantity(this)">
                <input style="width: 30px;" type="number" class="quantity-special-input" value="1" min="0" max="999" onchange="updateCalculator(this)">
                <input type="button" value="+" class="special-plus" onclick="increasespecialQuantity(this)">
            </div>
        </td>
    `;
    specialItemsTableBody.appendChild(newRow);
    updateTextarea(); // Update textarea content after adding a new row
}


function updateTextarea() {
    const specialItemsTableBody = document.getElementById('special-items-table-body');
    const textareaContent = [];
    let specialquantitySum = 0; 

    specialItemsTableBody.querySelectorAll('tr').forEach(row => {
        const productName = row.querySelector('td:first-child').innerText;
        const quantity = row.querySelector('.quantity-special-input').value;
        const sumqspecialuantity = parseInt(row.querySelector('.quantity-special-input').value);

        specialquantitySum += sumqspecialuantity;
        if (quantity > 0) {
            textareaContent.push(`⬤ ${productName} | Quantity: ${quantity}`);
        } else {
            row.remove();
        }

    });

        // Check if the table body is empty
    if (specialItemsTableBody.children.length === 0) {
        document.getElementById('special-items-table').style.display = 'none';
        document.getElementById('userSpecialItems').style.display = 'none';
        document.getElementById('notification-bullets-container').style.display = 'none';
        document.getElementById('quantity-special-container').style.display = 'none';
        document.getElementById('cal-special-table-title').style.display = 'none';

        

    } else {
        document.getElementById('special-items-table').style.display = '';
        document.getElementById('userSpecialItems').style.display = '';
        document.getElementById('notification-bullets-container').style.display = '';
        document.getElementById('quantity-special-container').style.display = 'flex';
        document.getElementById('cal-special-table-title').style.display = '';

    }

    document.getElementById('calculator-special-table-content').value = textareaContent.join('\n');
   
    document.getElementById('sum-special-quantity').value = specialquantitySum + " Special Items"; 

    updateSum();
}

// Function to increase the quantity
function increasespecialQuantity(input) {
    var quantityInput = input.parentNode.querySelector('.quantity-special-input');
    var currentValue = parseInt(quantityInput.value);
    quantityInput.value = currentValue + 1;
    updateTextarea(); // Update textarea content after decreasing quantity

}

// Function to decrease the quantity
function decreasespecialQuantity(input) {
    var quantityInput = input.parentNode.querySelector('.quantity-special-input');
    var currentValue = parseInt(quantityInput.value);
    if (currentValue > 0) {
        quantityInput.value = currentValue - 1;
    }
    updateTextarea(); 
}


function updateCalculator(element) {
    updateTextarea(); // Update textarea content after any change in the calculator
}

function savespecialFormData() {
    const tablespecialContent = document.getElementById('calculator-special-table-content').value;
    localStorage.setItem('calculatorMovingSpecialFormData', tablespecialContent);
}


document.addEventListener('input', function() {
    savespecialFormData();
});




        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('search-input').addEventListener('input', function() {
                const filterText = this.value;
                if (filterText) {
                    document.getElementById('idd-table').style.display = '';
                    document.getElementById('table_div').style.display = '';

                    filterTable(filterText);
                } else {
                    document.getElementById('idd-table').style.display = 'none';
                    document.getElementById('table_div').style.display = 'none';

                }
            });
        });

        // Function to filter table rows based on input
        function filterTable(filterText) {
            const rows = document.querySelectorAll('#idd-product-table-body tr');
            rows.forEach(row => {
                const nameCell = row.querySelector('td:first-child');
                if (nameCell.innerText.toLowerCase().includes(filterText.toLowerCase())) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        document.addEventListener('click', function(event) {
   
             if (!event.target.closest('#search-input') && !event.target.closest('#idd-table')) {
        
              document.getElementById('search-input').value = '';
        
             document.getElementById('idd-table').style.display = 'none';
             document.getElementById('table_div').style.display = 'none';


             }
        });



        document.addEventListener('DOMContentLoaded', function() {
         document.getElementById('clear-search').addEventListener('click', function() {
    
          document.getElementById('search-input').value = '';
       
          document.getElementById('idd-table').style.display = 'none';
          document.getElementById('table_div').style.display = 'none';

          });
        });


       // Function to increase the quantity
function increaseQuantity(input) {
    var quantityInput = input.parentNode.querySelector('.quantity-input');
    var currentValue = parseInt(quantityInput.value);
    quantityInput.value = currentValue + 1;
    updateCalculator(quantityInput); // Trigger updateCalculator after updating the quantity

    // Update the quantity in the second table
    const name = input.closest('tr').querySelector('td:first-child').innerText;
    const calculatorQuantityInput = document.querySelector(`#idd-calculator-body tr[data-name="${name}"] .quantity-input`);
    if (calculatorQuantityInput) {
        calculatorQuantityInput.value = currentValue + 1;
        updateCalculator(calculatorQuantityInput); // Trigger updateCalculator for the corresponding row in the second table
    }
}

// Function to decrease the quantity
function decreaseQuantity(input) {
    var quantityInput = input.parentNode.querySelector('.quantity-input');
    var currentValue = parseInt(quantityInput.value);
    if (currentValue > 0) {
        quantityInput.value = currentValue - 1;
        updateCalculator(quantityInput); // Trigger updateCalculator after updating the quantity

        // Update the quantity in the second table
        const name = input.closest('tr').querySelector('td:first-child').innerText;
        const calculatorQuantityInput = document.querySelector(`#idd-calculator-body tr[data-name="${name}"] .quantity-input`);
        if (calculatorQuantityInput) {
            calculatorQuantityInput.value = currentValue - 1;
            updateCalculator(calculatorQuantityInput); // Trigger updateCalculator for the corresponding row in the second table
        }
    }
}


// Function to update calculator table
function updateCalculator(input) {
    const quantityInput = input.parentNode.querySelector('.quantity-input');
    const quantity = parseInt(quantityInput.value);
    const row = input.parentNode.parentNode.parentNode; // Adjusted to match the new HTML structure

    const name = row.querySelector('td:first-child').innerText;
    const volume = parseFloat(row.querySelector('td:nth-child(2)').innerText);
    const price = parseFloat(row.querySelector('td:nth-child(3)').innerText);
    const specialMoveCost = parseFloat(row.querySelector('td:nth-child(4)').innerText);
    let total;

    document.getElementById('idd-calculator').style.display = '';
    document.getElementById('cal-table-title').style.display = '';
    document.getElementById('move-price-container').style.display = 'flex';
    document.getElementById('sum-q-container').style.display = '';

    document.getElementById('volume-container').style.display = 'flex';
    document.getElementById('quantity-container').style.display = 'flex';
    document.getElementById('quantity-specialandregular-container').style.display = 'flex';

    // Check if the price is equal to the default price
    const defaultPrice = parseFloat("<?php echo get_option('idd_calculator_defult_price'); ?>");
    if (price === defaultPrice) {
        total = volume * price * quantity;
    } else {
        total = price * quantity;
    }

    // If quantity is 0, remove the row from the calculator
    if (quantity === 0) {
        const calculatorRow = document.querySelector(`#idd-calculator-body tr[data-name="${name}"]`);
        if (calculatorRow) {
            calculatorRow.remove();
        }
        if (document.querySelectorAll('#idd-calculator-body tr').length === 0) {
            document.getElementById('idd-calculator').style.display = 'none';
            document.getElementById('cal-table-title').style.display = 'none';
            document.getElementById('move-price-container').style.display = 'none';

            document.getElementById('volume-container').style.display = 'none';
            document.getElementById('quantity-container').style.display = 'none';
            document.getElementById('sum-q-container').style.display = 'none';

        }
        calculatePrice();
        updateSum();
        updateSpecialMoveCostNotification();
        updateExceptionsforMoveCost();
        return;
    }

    // Check if the row already exists in the calculator table
    const calculatorRow = document.querySelector(`#idd-calculator-body tr[data-name="${name}"]`);
    if (calculatorRow) {
        calculatorRow.querySelector('.quantity').value = quantity;
        calculatorRow.querySelector('.total').innerText = '$' + total.toFixed(2);
    } else {
        const calculatorBody = document.getElementById('idd-calculator-body');
        const newRow = document.createElement('tr');
        newRow.setAttribute('data-name', name);
        newRow.innerHTML = `
            <td>${name}</td>
            <td style="display: none;">${volume}</td>
            <td style="display: none;">${price}</td>
            <td style="display: none;">${specialMoveCost}</td>
            <td>
            <div class="quantity buttons_added" style="display: flex; float: right;" >
        <input type="button" value="-" class="minus" onclick="decreaseQuantity(this)">
        <input style="width: 30px;" type="number" class="quantity-input" value="${quantity}" min="0" max="999" onchange="updateCalculator(this)">
        <input type="button" value="+" class="plus" onclick="increaseQuantity(this)">
    </div>
            </td>
            <td style="display: none;" class="total">$${total.toFixed(2)}</td>`;
        calculatorBody.appendChild(newRow);
    }

    updateSum();
    calculatePrice();
    updateSpecialMoveCostNotification();
    updateExceptionsforMoveCost();
}



function updateProductTable() {
    const inputs = document.querySelectorAll('#idd-product-table-body .quantity');
    inputs.forEach(input => {
        if (input.value === '0') {
            input.parentNode.parentNode.remove();
        }
    });
    calculatePrice(); 
}

// Function to update the special move cost notification
function updateSpecialMoveCostNotification() {
    const specialMoveCostNotification = document.getElementById('specialMoveCostnotification');
    const notificationbulletscontainer = document.getElementById('notification-bullets-container');

    const rows = document.querySelectorAll('#idd-calculator-body tr');
    let specialMoveSelected = false;
    rows.forEach(row => {
        const specialMoveCost = parseFloat(row.querySelector('td:nth-child(4)').innerText);
        if (specialMoveCost !== 0) {
            specialMoveSelected = true;
        }
    });
    if (specialMoveSelected) {
        specialMoveCostNotification.style.display = '';
        notificationbulletscontainer.style.display = '';
    } else {
        specialMoveCostNotification.style.display = 'none';
        notificationbulletscontainer.style.display = 'none';

    }
}
// Function to update total sum and volume sum
function updateSum() {
    const totals = document.querySelectorAll('#idd-calculator-body .total');
    let sum = 0;
    let volumeSum = 0; 
    let quantitySum = 0; 
    let tableContent = ''; 
    totals.forEach(total => {
        const value = parseFloat(total.innerText.replace('$', '')); 
        if (!isNaN(value)) {
            sum += value;
            const row = total.parentNode;
            const volume = parseFloat(row.querySelector('td:nth-child(2)').innerText); 
            const specialMoveCost = parseFloat(row.querySelector('td:nth-child(4)').innerText); 
            const quantity = row.querySelector('.quantity').value;
            const quantityforcal = parseInt(row.querySelector('.quantity').value);

            if (specialMoveCost === 0) {
                volumeSum += volume * quantity; 
            }
            quantitySum += quantityforcal;
            const name = row.querySelector('td:first-child').innerText;
            tableContent += `⬤ ${name} | Quantity: ${quantity} \n`; 
        }
    });

    var specialQuantity = parseInt(document.getElementById('sum-special-quantity').value.replace(' Special Items', ''));
    var regularQuantity = quantitySum; 

   if (!isNaN(specialQuantity)) {
      document.getElementById('SumSpecialAndRegularQuantity').value = parseInt(document.getElementById('sum-special-quantity').value.replace(' Special Items', '')) + quantitySum + " Items";
   } else {
      document.getElementById('SumSpecialAndRegularQuantity').value = "";
   }


    document.getElementById('calculator-table-content').value = tableContent; 
    document.getElementById('sum-volume').value = volumeSum + " CF"; 
    document.getElementById('sum-quantity').value = quantitySum + " Items"; 
    document.getElementById('sum-CfAndQuantity').value = quantitySum + " Items" + " (" + volumeSum + " CF" +")"; 
    document.getElementById('sum-totalspecial-quantity').value = document.getElementById('sum-special-quantity').value ; 

}


// Function to autocomplete user address
function autocompleteAddress() {
    const input = document.getElementById('destination_address');
    const originInput = document.getElementById('origin_address');
    const options = {
        types: ['address'] 
    };
    const autocomplete = new google.maps.places.Autocomplete(input, options);
    const originAutocomplete = new google.maps.places.Autocomplete(originInput, options);
    
    autocomplete.addListener('place_changed', function() {
        const place = autocomplete.getPlace();
        if (!place.geometry) {
            console.error('Place not found');
            return;
        }
        calculateDistance();
        updateSpecialMoveCostNotification();
        updateExceptionsforMoveCost();
        checkLocationAgainstStorage();
        console.log('Formatted Address:', place.formatted_address);
        console.log('Latitude:', place.geometry.location.lat());
        console.log('Longitude:', place.geometry.location.lng());
    });

    originAutocomplete.addListener('place_changed', function() {
        const place = originAutocomplete.getPlace();
        if (!place.geometry) {
            console.error('Place not found');
            return;
        }
        calculateDistance();
        updateSpecialMoveCostNotification();
        updateExceptionsforMoveCost();
        checkLocationAgainstStorage();
        console.log('Formatted Address:', place.formatted_address);
        console.log('Latitude:', place.geometry.location.lat());
        console.log('Longitude:', place.geometry.location.lng());
    });
}




function calculateDistance() {
    const origin = document.getElementById('destination_address').value;
    const destination = document.getElementById('origin_address').value;
    const minDistanceLD = parseFloat("<?php echo get_option('min_distance_ld'); ?>");
    const service = new google.maps.DistanceMatrixService();
    document.getElementById('mils-container').style.display = 'flex';

    service.getDistanceMatrix(
        {
            origins: [origin],
            destinations: [destination],
            travelMode: 'DRIVING',
            unitSystem: google.maps.UnitSystem.IMPERIAL
        },
        (response, status) => {
            if (status === 'OK') {
                const distanceMeters = response.rows[0].elements[0].distance.value;
                const distanceMiles = distanceMeters * 0.000621371; 


                if (distanceMiles >= minDistanceLD) {
                    document.getElementById('maxDistaceMiles').style.display = '';
                    document.getElementById('notification-bullets-container').style.display = '';

                } else {
                    document.getElementById('maxDistaceMiles').style.display = 'none';
                     document.getElementById('notification-bullets-container').style.display = 'none';

                }
                const distanceText = distanceMiles.toFixed(2) + ' mi';
                document.getElementById('mils').value = distanceText;
                
               
                
                calculatePrice();
            } else {
                console.error('Error:', status);
            }
        }
        
    );

}
document.getElementById('destination_address').addEventListener('change', calculateDistance);
document.getElementById('origin_address').addEventListener('change', calculateDistance);


function checkLocationAgainstStorage() {
    const userAddress = document.getElementById('destination_address').value;
    const storageAddress = document.getElementById('origin_address').value;

    // Perform Geocoding to get the country of the user's address
    const geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'address': userAddress }, function(results, status) {
        if (status === 'OK') {
            const userCountry = results[0].address_components.find(component => component.types.includes('country')).short_name;
            
            // Perform Geocoding to get the country of the storage address
            geocoder.geocode({ 'address': storageAddress }, function(results, status) {
                if (status === 'OK') {
                    const storageCountry = results[0].address_components.find(component => component.types.includes('country')).short_name;
                    
                    // Compare the countries
                    if (userCountry !== storageCountry) {
                        document.getElementById('Insterstate').style.display = '';
                        document.getElementById('notification-bullets-container').style.display = '';

                    } else {
                        document.getElementById('Insterstate').style.display = 'none';
                        document.getElementById('notification-bullets-container').style.display = 'none';
                    }
                } else {
                    console.error('Geocode was not successful for the storage address:', status);
                }
            });
        } else {
            console.error('Geocode was not successful for the user address:', status);
        }
    });
}


// Load Google Maps Places API with the provided API key
function loadGoogleMapsAPI() {
    const api_key = "<?php echo get_option('idd_calculator_api_key'); ?>";

    const script = document.createElement('script');
    script.src = `https://maps.googleapis.com/maps/api/js?key=${api_key}&libraries=places&callback=autocompleteAddress`;
    script.defer = true;
    document.body.appendChild(script);
}

document.addEventListener('DOMContentLoaded', loadGoogleMapsAPI);

function calculatePrice() {
    const rows = document.querySelectorAll('#idd-calculator-body tr');
    const distanceMiles = parseFloat(document.getElementById('mils').value.replace(' mi', ''));
    const defaultPricePerMile = parseFloat("<?php echo get_option('defult_price_move_cost_mile'); ?>");
    const FirstMilesExcluded = parseFloat("<?php echo get_option('first_miles_excluded'); ?>");
    const defultpriceMinCFMove = parseFloat("<?php echo get_option('defult_price_min_cf_move_price'); ?>");
    const MinCFMoveThreshold = parseFloat("<?php echo get_option('min_cf_move_threshold'); ?>");

    let moveprice = 0
    const sumvolume = parseFloat(document.getElementById('sum-volume').value.replace(' CF', ''));
    if(distanceMiles <= FirstMilesExcluded){
        moveprice = 0;
    } else{
        moveprice = (distanceMiles * defaultPricePerMile);

    }
    let totalPrice = 0;
    let price = 0;
    let specialPrice = 0;
    let specialMoveCostNotification = document.getElementById('specialMoveCostnotification');
    rows.forEach(row => {
        const specialMoveCost = parseFloat(row.querySelector('td:nth-child(4)').innerText);
        const quantity = parseInt(row.querySelector('.quantity').value);
        const defaultPricePerCF = parseFloat("<?php echo get_option('defult_price_move_cost_cf'); ?>");
        if (specialMoveCost === 0) {
            if(sumvolume <= MinCFMoveThreshold){
               price = defultpriceMinCFMove;
            }else{
                price = (sumvolume * defaultPricePerCF) ;
            }              
        } else {
            specialPrice = (specialMoveCost * quantity);
        }
    });

    totalPrice += price + moveprice + specialPrice;


    const totalPriceRange = parseInt("<?php echo get_option('total_price_range'); ?>");


    const movePriceField = document.getElementById('move-price');
    movePriceField.value = isNaN(totalPrice) ? '' : '$' + totalPrice.toFixed(2) + ' ⇄ ' + '$'+ parseInt(totalPrice + totalPriceRange);
    updateSpecialMoveCostNotification();
    updateExceptionsforMoveCost();

}
// Call calculatePrice whenever the quantity changes
document.getElementById('idd-calculator').addEventListener('input', function(event) {
    if (event.target.classList.contains('quantity')) {
        calculatePrice();
    }
});
document.getElementById('destination_address').addEventListener('change', calculatePrice);
document.getElementById('origin_address').addEventListener('change', calculatePrice);


// Function to update the exceptions for move cost notification
function updateExceptionsforMoveCost() {
    const ExceptionsforMoveCost = document.getElementById('ExceptionsforMoveCost');
    const notificationbulletscontainer = document.getElementById('notification-bullets-container');
    const MinCFMoveThreshold = parseFloat("<?php echo get_option('min_cf_move_threshold'); ?>");
    const sumvolume = parseFloat(document.getElementById('sum-volume').value.replace(' CF', ''));

    if (sumvolume <= MinCFMoveThreshold) {
        ExceptionsforMoveCost.style.display = '';
        notificationbulletscontainer.style.display = '';
    } else {
        ExceptionsforMoveCost.style.display = 'none';
        notificationbulletscontainer.style.display = 'none';
    }
}

document.getElementById('move-price').addEventListener('input', updateExceptionsforMoveCost);






function saveFormData() {
    const tableContent = document.getElementById('calculator-table-content').value;
    localStorage.setItem('calculatormovingFormData', tableContent);
}


document.addEventListener('input', function() {
    saveFormData();
});



        updateSum();
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('idd_moving_calculator', 'idd_moving_calculator_product_table_shortcode');


function calculator_moving_get_param() {
    ob_start();
?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Retrieve data from localStorage
            const formData = localStorage.getItem('calculatormovingFormData');
            const tableParamInput = document.getElementById('calculator_moving_get_table_param');

            // Display the data
            document.getElementById('calculator-moving-form-data').innerText = formData || '';
            if (tableParamInput) {
                tableParamInput.value = formData || '';
            }
        });
    </script>

    <div id="calculator-moving-form-data"></div>
<?php
    return ob_get_clean();
}
add_shortcode('calculator_moving_get_param', 'calculator_moving_get_param');


function calculator_special_moving_get_param() {
    ob_start();
?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Retrieve data from localStorage
            const formData = localStorage.getItem('calculatorMovingSpecialFormData');
            const tableParamInput = document.getElementById('calculator_get_moving_specia_table_param');

            // Display the data
            document.getElementById('calculator-moving-special-form-data').innerText = formData || '';
            if (tableParamInput) {
                tableParamInput.value = formData || '';
            }
        });
    </script>

    <div id="calculator-moving-special-form-data"></div>
<?php
    return ob_get_clean();
}
add_shortcode('calculator_special_moving_get_param', 'calculator_special_moving_get_param');

