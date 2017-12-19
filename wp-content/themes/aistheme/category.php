 <?php get_header(); ?>

    <div class="newsSection container">
         <h1 class="pageTitle"><?php single_cat_title( '', true ); ?></h1>
        
             <div class="row">
            
    <?php if(have_posts()): while(have_posts()): the_post(); ?> 

              <div class="newsItem col-12 col-md-6 col-xl-3">

                    <?php if ( has_post_thumbnail() ) : ?>
                      <div class="thumbHolder">
                        <a class="thumbLink" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                            <?php the_post_thumbnail('thumbnail'); ?>
                        </a>
                      </div>
                    <?php endif; ?>

                    <div class="newsContent">
                      <?php get_template_part('template-parts/social') ?>
                    <h3 class="newsTitle"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php 
                        $news_title = get_the_title();
                        if (strlen($news_title) > 35) {
                         $news_title = substr($news_title, 0, strpos($news_title, ' ', 35));
                        };
                        echo $news_title."...";
                    ?></a></h3>
                    <?php 
                      $news_exc = get_the_excerpt(); 
                      $news_exc = substr($news_exc, 0, strpos($news_exc, ' ', 60));

                        echo $news_exc."...";
                    ?>

                   
                    </div>
                </div> 
            
        <?php endwhile; endif; ?>    
            
        </div>
   

        
    </div>


<?php get_footer(); ?>