<?php
// Register Menus
function theme_register_menus() {
    register_nav_menus(
        array(
            'primary_menu' => 'Primary Menu', // Primary navigation menu
        )
    );
}
add_action('init', 'theme_register_menus');

// Enqueue Styles
function my_theme_enqueue_styles() {
    // Enqueue the custom style
    wp_enqueue_style('custom-style', get_template_directory_uri() . '/assets/css/style1.css');
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');
// Enqueue fontawesome
function enqueue_fontawesome() {
    wp_enqueue_style(
        'fontawesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css',
        array(),
        null
    );
}
add_action('wp_enqueue_scripts', 'enqueue_fontawesome');

// Enqueue fontawesome
function enqueue_jspdf() {
    wp_enqueue_style(
        'jspdf',
        'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js',
        array(),
        null
    );
}
add_action('wp_enqueue_scripts', 'enqueue_jspdf');

// Enqueue Scripts
function theme_enqueue_scripts() {
    // Enqueue the JS files
    wp_enqueue_script('typingspeed-script1', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), null, true);
    wp_enqueue_script('typingspeed-script2', get_template_directory_uri() . '/assets/js/app.js', array('jquery'), null, true);
    wp_enqueue_script('typingspeed-script3', get_template_directory_uri() . '/assets/js/test.js', array('jquery'), null, true);

    // Localize script for scrolling functionality
    wp_localize_script('typingspeed-script1', 'theme_vars', array(
        'scroll_target' => esc_url(home_url('/#typing-speed')), // Define the scroll target ID here
    ));
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');

// Handle Registration
add_action('admin_post_nopriv_custom_register', 'handle_custom_register');
add_action('admin_post_custom_register', 'handle_custom_register');

function handle_custom_register() {
    if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['name']) && !empty($_POST['university_name']) && !empty($_POST['linkedin_url'])) {
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $password = sanitize_text_field($_POST['password']);
        $university_name = sanitize_text_field($_POST['university_name']);
        $linkedin_url = esc_url_raw($_POST['linkedin_url']);
        
        $userdata = array(
            'user_login' => $email, // Use email as the username
            'user_email' => $email,
            'user_pass'  => $password,
            'first_name' => $name,
            'nickname'   => $name,
        );
        
        $user_id = wp_insert_user($userdata);
        
        if (!is_wp_error($user_id)) {
            // Update additional user meta
            update_user_meta($user_id, 'university_name', $university_name);
            update_user_meta($user_id, 'linkedin_url', $linkedin_url);
            wp_redirect(home_url('/login'));
        } else {
            $error_message = $user_id->get_error_message();
            wp_redirect(home_url('/register?error=' . urlencode($error_message)));
        }
    } else {
        // Handle the case where required fields are missing
        $error_message = 'Please fill in all required fields.';
        wp_redirect(home_url('/register?error=' . urlencode($error_message)));
    }
    exit();
}

// Add fields to user profile
function custom_user_profile_fields($user) {
    ?>
    <h3>Additional Information</h3>
    <table class="form-table">
        <tr>
            <th><label for="university_name">University Name</label></th>
            <td>
                <input type="text" name="university_name" id="university_name" value="<?php echo esc_attr(get_the_author_meta('university_name', $user->ID)); ?>" class="regular-text" />
            </td>
        </tr>
        <tr>
            <th><label for="linkedin_url">LinkedIn URL</label></th>
            <td>
                <input type="url" name="linkedin_url" id="linkedin_url" value="<?php echo esc_attr(get_the_author_meta('linkedin_url', $user->ID)); ?>" class="regular-text" />
            </td>
        </tr>
    </table>
    <?php
}
add_action('show_user_profile', 'custom_user_profile_fields');
add_action('edit_user_profile', 'custom_user_profile_fields');

// Save custom user profile fields
function save_custom_user_profile_fields($user_id) {
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }

    if (isset($_POST['university_name'])) {
        update_user_meta($user_id, 'university_name', sanitize_text_field($_POST['university_name']));
    }

    if (isset($_POST['linkedin_url'])) {
        update_user_meta($user_id, 'linkedin_url', esc_url_raw($_POST['linkedin_url']));
    }
}
add_action('personal_options_update', 'save_custom_user_profile_fields');
add_action('edit_user_profile_update', 'save_custom_user_profile_fields');
// Handle custom login
add_action('admin_post_nopriv_custom_login', 'handle_custom_login');
add_action('admin_post_custom_login', 'handle_custom_login');

function handle_custom_login() {
    // Check if username and password are submitted
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = sanitize_user($_POST['username']);
        $password = $_POST['password'];

        // Perform custom authentication
        $user = wp_authenticate($username, $password);

        if (!is_wp_error($user)) {
            // Authentication successful, log the user in
            wp_set_auth_cookie($user->ID);
            wp_redirect(home_url('/demo')); // Redirect to a custom page after login
            exit;
        } else {
            // Authentication failed, redirect back to login page with error
            $error_message = $user->get_error_message();
            wp_redirect(home_url('/login?login=failed&error=' . urlencode($error_message)));
            exit;
        }
    } else {
        // Handle case where username or password is missing
        wp_redirect(home_url('/login?login=failed&error=missing_credentials'));
        exit;
    }
}

// Add the custom login redirect filter
function custom_login_redirect($redirect_to, $request, $user) {
    // Check if the user is logged in and if there are no errors
    if (isset($user->roles) && is_array($user->roles)) {
        // Redirect to the custom page (e.g., /demo)
        $redirect_to = home_url('/demo'); // Replace with your desired page URL
    } else {
        // Redirect to the login page in case of error
        $redirect_to = wp_login_url();
    }
    return $redirect_to;
}
add_filter('login_redirect', 'custom_login_redirect', 10, 3);



?>
