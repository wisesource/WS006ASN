<?php get_header(); ?>

  <div class="container pb-5">
      <?php  if(have_posts()) : while(have_posts()) : the_post(); ?>
                   <div class="col-12">

                       <h1 class="pageTitle"><?php the_title(); ?></h1>
                       <?php the_content(); ?>
                    </div>


                <?php endwhile; endif; ?>
        
      </div>


<?php get_footer(); ?>