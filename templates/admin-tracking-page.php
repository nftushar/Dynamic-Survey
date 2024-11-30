<div class="wrap">
    <h1>Survey Voting Tracking</h1>
    <?php if ( empty( $votes ) ) :
        
//         $user_ip = $_SERVER['REMOTE_ADDR']; // Capture the user's IP address
// error_log('User IP: ' . $user_ip);  // Log the IP address for debugging

        
        ?>
        <p>No votes found.</p>
    <?php else : ?>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Survey</th>
                    <th>Voted Option</th>
                    <th>User</th>
                     
                    <th>Vote Time</th>
                </tr>
            </thead>

            
            <tbody>
                <?php foreach ( $votes as $vote ) : ?>
                    <tr>
                        <td><?php echo esc_html( $vote->survey_question ); ?></td>
                        <td><?php echo esc_html( $vote->voted_option ); ?></td>
                        <td><?php echo esc_html( $vote->user_name ?? 'Guest' ); ?></td> 
                        <td><?php echo esc_html( $vote->vote_time ); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Export to CSV button -->
        <form method="post" action="">
            <?php wp_nonce_field( 'export_survey_nonce' ); ?>
            <input type="submit" name="export_survey_results" value="Export to CSV" class="button-primary" />
        </form>
    <?php endif; ?>
</div>
