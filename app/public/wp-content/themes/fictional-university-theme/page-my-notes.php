<!-- This file is to display single page content -->
<?php get_header();

if(!is_user_logged_in()) {
        wp_redirect(esc_url(site_url('/')));
        exit;
    }

    while (have_posts()){
        the_post(); 
        pageBanner();
        ?>

    <div class="container container--narrow page-section">
        <div class="create-note">
            <h2 class="headline headline--medium">Create New Note</h2>
            <input class="new-note-title" type="text" placeholder="Title">
            <textarea class="new-note-body" placeholder="Your Note Here"></textarea>
            <span class="submit-note">Create Note</span>
            <span class="note-limit-message">Note Limit Reached. Delete An Existing Note To Make Room For A New One.</span>
        </div>

        <ul class="min-list link-list" id="my-notes">
            <?php 
                $userNotes = new WP_Query(array(
                    'post_type' => 'note',
                    'post_per_page' => -1,
                    'author' => get_current_user_id()
                ));

                while($userNotes -> have_posts()) {
                    $userNotes->the_post(); 
                    
                ?>
                    <li class="" data-id="<?php the_ID(); ?>">
                        <input class="note-title-field" value="<?php echo str_replace('Private: ', '' ,esc_attr(get_the_title())); ?>" readonly>
                        <span class="edit-note"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</span>
                        <span class="delete-note"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</span>
                        <textarea class="note-body-field" readonly><?php echo esc_textarea(wp_strip_all_tags(get_the_content())); ?></textarea>
                        <span class="update-note btn btn--blue btn--small"><i class="fa fa-arrow-right" aria-hidden="true"></i> Save</span>
                    </li>
            <?php 
                }
            ?>
        </ul>
    </div>
<?php
}
?>

<?php get_footer(); ?>