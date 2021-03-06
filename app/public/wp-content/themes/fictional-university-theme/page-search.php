<!-- This file is to display single page content -->
<?php get_header(); ?>

<?php 
    while (have_posts()){
        the_post(); 
        pageBanner();
        ?>

    <div class="container container--narrow page-section">

    <?php 
        $theParent = wp_get_post_parent_id(get_the_ID());
        if ($theParent) {
    ?>
    <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
        <a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent) ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParent); ?></a> <span class="metabox__main"><?php echo the_title(); ?></span>
        </p>
    </div>
    <?php
        }
    ?>


    <?php 
        $testArray = get_pages(array(
            'child_of' => get_the_ID()
        ));

        if($theParent || $testArray) { ?>
        <div class="page-links">
        <h2 class="page-links__title"><a href="<?php echo get_permalink($theParent);?> "><?php echo get_the_title($theParent); ?></a></h2>
        <ul class="min-list">
        <?php
            if($theParent) {
                $findChildOf = $theParent;
            } else {
                $findChildOf = get_the_ID();
            }
            
            wp_list_pages(array(
                'title_li'     => NULL,
                'child_of'     => $findChildOf,
                'sort_column'  => 'menu_order'
            ));
        ?>
        </ul>
    </div>
    
    <?php 
    }
    ?>

    <div class="generic-content">
        <form class="search-form" method="get" action="<?php echo esc_url(site_url('/')) ?>">
            <label for="s" class="headline headline--medium">Perfom a new search:</label>
            <div class="search-form-row">
                <input class="s"  type="search" name="s" id="s" placeholder="What are you looking for?">
                <input class="search-submit" type="submit" value="Search">
            </div>
        </form>
    </div>
    </div>
<?php
}
?>

<?php get_footer(); ?>