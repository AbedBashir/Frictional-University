<?php get_header(); ?>

<?php 
  pageBanner(array(
    'title' => 'Search',
    'subtitle' => 'You Searched for &ldquo;' . esc_html(get_search_query(false)) . '&rdquo;.'
  )); 
?>

    <div class="container container--narrow page-section">
      <?php 
        while(have_posts()) {
          the_post();
          get_template_part('template-parts/content' , get_post_type())
        ?>

      <?php
        }
      ?>

      <?php 
        echo paginate_links();
      ?>
    </div>


<?php get_footer(); ?>