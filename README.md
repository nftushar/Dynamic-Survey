# Dynamic Survey Plugin

## User Documentation

### Introduction
The **Dynamic Survey Plugin** allows you to create, manage, and track surveys directly from the WordPress admin dashboard. Users can vote on various survey options, and you can easily view and analyze their responses in real-time. This plugin is ideal for gathering feedback, conducting polls, and engaging with your website visitors.

### Key Features
- **Create Surveys**: Easily create surveys with customizable questions.
- **Add Options**: Define multiple options for each survey question.
- **Vote Tracking**: Track votes by users, including the time of the vote, the option selected, and user IP addresses.
- **Admin Dashboard**: Access detailed voting reports, including the survey question, the user who voted, and the vote time. 

### Installation Instructions

#### Upload the Plugin:
1. Download the plugin `.zip` file.
2. In your WordPress admin panel, navigate to **Plugins > Add New**.
3. Click on **Upload Plugin**, then choose the `.zip` file and click **Install Now**.

#### Activate the Plugin:
1. After the plugin is installed, click **Activate** to enable it on your website.

#### Plugin Activation Hook:
- When activated, the plugin will automatically create the necessary database tables for surveys and votes.

### Creating a Survey
Once the plugin is activated, you can start creating surveys:

#### Navigate to Survey Management:
- In the WordPress admin panel, go to **Surveys > Add New Survey**.

#### Add Survey Question:
1. Enter your question in the **Question** field.
2. Click **Publish** to save the survey.

#### Add Survey Options:
1. After publishing your survey, click **Add Survey Options** to define possible answers to the survey question.
2. Add multiple options, each with a descriptive text, and click **Add Option** for each.
3. You can add as many options as needed for your survey.

### Displaying a Survey on Your Site

#### Use a Shortcode:
- After creating a survey, the plugin will generate a unique shortcode for that survey. You can find the shortcode under **Surveys > All Surveys**.
- To display a survey on any post, page, or widget, simply insert the shortcode `[dynamic_survey id="X"]` (replace **X** with the Survey ID).

#### Add Survey to Pages/Posts:
- In any page or post, paste the shortcode where you'd like the survey to appear.

#### Add Survey to Widgets:
- Navigate to **Appearance > Widgets**, and add a **Text Widget** or **Custom HTML Widget**.
- Insert the shortcode in the widget to display the survey in a sidebar or footer area.

### User Voting Process

#### Accessing the Survey:
- Users will see the survey question and available options on the page or post where you inserted the shortcode.

#### Voting:
- Users select an option and submit their vote. If they are logged in, their user ID will be recorded along with their vote.
- If they are not logged in, the user's IP address will be recorded for the vote.

#### Survey Submission:
- After submitting their vote, users will see a confirmation message thanking them for participating.

### Viewing Survey Results

#### Navigate to Survey Tracking:
- In the admin panel, go to **Surveys > Survey Tracking** to view detailed voting data.

#### Track Votes:
- You will see a table displaying all the votes for each survey, including:
  - **Survey Question**: The question of the survey.
  - **User**: The name of the user who voted.
  - **Vote Time**: The date and time when the vote was cast.

#### Export Results:
- You can export the results in CSV format by clicking the **Export** button on the Survey Tracking page.

### Managing Surveys and Votes

#### Edit or Delete Surveys:
- To edit a survey, go to **Surveys > All Surveys**, then click **Edit** under the survey you want to modify.
- To delete a survey, click **Trash**.

#### View Survey Options:
- After creating a survey, you can add or remove options via the **Edit Survey** page. Simply scroll to the **Options** section to manage the options.

#### Track Votes:
- Each vote is recorded along with the user who cast the vote (if logged in) and the time of voting.
- Votes are also associated with a survey option and stored in the database for reporting purposes.

### Admin Tracking Page
The **Survey Voting Tracking** page allows admins to review the details of votes for each survey:

#### Survey Information:
- The page displays the following information:
  - **Survey Question**: The question for which votes are tracked.
  - **User Name**: The name of the user who voted (if registered).
  - **Vote Time**: The timestamp of when the vote was cast.

#### Handling Large Numbers of Votes:
- If your survey receives a high volume of votes, the list of votes may be paginated. You can use WordPress’s default pagination or implement custom pagination to improve performance.

### Important Notes:
- **User Voting Limits**: Each user can vote only once per survey. This is enforced by recording the user's ID (if logged in) or IP address.
- **Data Privacy**: IP addresses are recorded for users who are not logged in. Please ensure your website's privacy policy reflects this.
- **Survey Data Storage**: All survey and vote data is stored in custom database tables, so there is no risk of interfering with default WordPress data.

### Troubleshooting

#### Survey Not Showing on the Frontend:
- Make sure you are using the correct shortcode `[dynamic_survey id="X"]`.
- Ensure that the survey is published and not in draft mode.

#### No Votes Showing on the Admin Tracking Page:
- Make sure that users have participated in the survey. Check that you have surveys that are live and that the survey options are correctly defined.

#### Plugin Conflicts:
- If you experience issues with other plugins, try deactivating other plugins temporarily to check for conflicts.

### Uninstalling the Plugin
If you wish to uninstall the plugin, follow these steps:

#### Deactivate the Plugin:
1. Navigate to **Plugins > Installed Plugins** and click **Deactivate** next to the **Dynamic Survey** plugin.

#### Delete the Plugin:
1. After deactivating, you can delete the plugin from the same page by clicking **Delete**.

#### Database Cleanup (Optional):
- If you want to remove survey-related data from the database, ensure that you manually delete the plugin's tables (`dynamic_surveys`, `dynamic_survey_options`, and `dynamic_survey_votes`) via a database management tool like phpMyAdmin or using WP-CLI.

### Conclusion
The **Dynamic Survey Plugin** makes it easy to create surveys and collect user feedback directly on your WordPress site. By following the steps above, you can create engaging surveys, track votes, and analyze results in your admin dashboard.

For any further support or custom feature requests, feel free to reach out!
