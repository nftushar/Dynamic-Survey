<?php
function handle_survey_results_export() {
    // Check if the form has been submitted
    if (isset($_POST['export_survey_results'])) {
        // Verify the nonce for security
        if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'export_survey_nonce')) {
            die('Nonce verification failed.');
        }

        // Get the survey ID from the form
        $survey_id = isset($_POST['survey_id']) ? intval($_POST['survey_id']) : 0;

        if ($survey_id > 0) {
            global $wpdb;

            // Define table names
            $votes_table = $wpdb->prefix . 'dynamic_survey_votes';
            $options_table = $wpdb->prefix . 'dynamic_survey_options';

            // Query survey results
            $results = $wpdb->get_results(
                $wpdb->prepare(
                    "SELECT o.option_name, COUNT(v.option_id) as vote_count
                    FROM $votes_table v
                    LEFT JOIN $options_table o ON v.option_id = o.option_id
                    WHERE v.survey_id = %d
                    GROUP BY v.option_id",
                    $survey_id
                )
            );

            if ($results) {
                // Send CSV headers
                header('Content-Type: text/csv');
                header('Content-Disposition: attachment; filename="survey_results_' . $survey_id . '.csv"');

                // Open output stream for CSV
                $output = fopen('php://output', 'w');

                // Add header row to CSV
                fputcsv($output, ['Option', 'Votes']);

                // Add data rows
                foreach ($results as $row) {
                    fputcsv($output, [$row->option_name, $row->vote_count]);
                }

                // Close output stream
                fclose($output);
                exit();
            } else {
                wp_die('No results found for this survey.');
            }
        }
    }
}
add_action('admin_init', 'handle_survey_results_export');
