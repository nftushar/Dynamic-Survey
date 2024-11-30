<div class="wrap">
    <h1>Survey Voting Tracking</h1>
    <?php if ( empty( $votes ) ) : ?>
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
    <?php endif; ?>
</div>
