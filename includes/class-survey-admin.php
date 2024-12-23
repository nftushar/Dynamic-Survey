<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class SurveyAdmin {
    public function __construct() {
        add_action( 'admin_menu', [ $this, 'register_admin_pages' ] );
        add_action( 'admin_post_create_survey', [ $this, 'handle_create_survey' ] );
        add_action( 'admin_post_delete_survey', [ $this, 'handle_delete_survey' ] );
    }
  
    public function register_admin_pages() {
        // Main menu: Dynamic Survey
        add_submenu_page(
            'tools.php',
            'Dynamic Survey',
            'Dynamic Survey',
            'manage_options',
            'dynamic-survey',
            [ $this, 'render_admin_page' ]
        );
  
        // Submenu: Survey Tracking
        add_submenu_page(
            'tools.php',
            'Survey Tracking',
            'Survey Tracking',
            'manage_options',
            'survey-tracking',
            [ $this, 'render_tracking_page' ]
        );
    }

    public function render_admin_page() {
        global $wpdb;
    
        // Define the surveys table
        $surveys_table = $wpdb->prefix . 'dynamic_surveys';
    
        // Check if the table exists
        if ( $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE %s", $surveys_table ) ) === $surveys_table ) {
            // Fetch surveys data
            $surveys = $wpdb->get_results( "SELECT * FROM $surveys_table", ARRAY_A );
    
            // Include the admin survey page template
            require_once DYNAMIC_SURVEY_PATH . 'templates/admin-survey-page.php';
        } else {
            // Display an error message if the table doesn't exist
            echo '<div class="notice notice-error"><p>' . esc_html__( 'Dynamic Surveys table not found.', 'text-domain' ) . '</p></div>';
        }
    }
    
    public function render_tracking_page() {
        global $wpdb;
    
        // Table names
        $votes_table = $wpdb->prefix . 'dynamic_survey_votes';
        $surveys_table = $wpdb->prefix . 'dynamic_surveys';
        $options_table = $wpdb->prefix . 'dynamic_survey_options';
        $users_table = $wpdb->prefix . 'users';
    
        // Fetch votes along with survey question, voted option, and user info
        $votes = $wpdb->get_results(
            "SELECT 
                v.survey_id, 
                s.question AS survey_question, 
                o.option_text AS voted_option, 
                u.display_name AS user_name, 
                v.user_ip, 
                v.vote_time 
            FROM {$wpdb->prefix}dynamic_survey_votes v
            JOIN {$wpdb->prefix}dynamic_surveys s ON v.survey_id = s.id
            JOIN {$wpdb->prefix}dynamic_survey_options o ON v.option_id = o.id
            LEFT JOIN {$wpdb->users} u ON v.user_id = u.ID
            ORDER BY v.vote_time DESC"
        );
    
        // Log the votes data for debugging (optional)
        error_log('Survey Votes: ' . print_r($votes, true));
    
        // Include the tracking page template
        require_once DYNAMIC_SURVEY_PATH . 'templates/admin-tracking-page.php';
    }
    
    


    public function handle_create_survey() {
        if ( ! current_user_can( 'manage_options' ) || ! check_admin_referer( 'create_survey_nonce' ) ) {
            wp_die( 'Unauthorized action!' );
        }

        global $wpdb;
        $surveys_table = $wpdb->prefix . 'dynamic_surveys';
        $options_table = $wpdb->prefix . 'dynamic_survey_options';

        $question = sanitize_text_field( $_POST['survey_question'] );
        $options = array_map( 'sanitize_text_field', $_POST['survey_options'] );

        $wpdb->insert( $surveys_table, [ 'question' => $question ] );
        $survey_id = $wpdb->insert_id;

        foreach ( $options as $option ) {
            $wpdb->insert( $options_table, [
                'survey_id'   => $survey_id,
                'option_text' => $option,
            ]);
        }

        wp_redirect( admin_url( 'tools.php?page=dynamic-survey&status=created' ) );
        exit;
    }

    public function handle_delete_survey() {
        if ( ! current_user_can( 'manage_options' ) || ! check_admin_referer( 'delete_survey_nonce' ) ) {
            wp_die( 'Unauthorized action!' );
        }

        global $wpdb;
        $surveys_table = $wpdb->prefix . 'dynamic_surveys';

        $survey_id = intval( $_GET['survey_id'] );
        $wpdb->delete( $surveys_table, [ 'id' => $survey_id ] );

        wp_redirect( admin_url( 'tools.php?page=dynamic-survey&status=deleted' ) );
        exit;
    }
}
 