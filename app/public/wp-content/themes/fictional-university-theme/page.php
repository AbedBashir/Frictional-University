<!-- This file is to display single page content -->
<?php 
    while (have_posts()){
        the_post(); ?>
        <h2><?php the_title() ?></h2>    
        <p><?php the_content() ?></p>
<?php
}
?>