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

                    <div class="newsItemMeta">
                      <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo get_the_date('d M Y'); 
                       if (get_post_meta($post->ID,'source_name')) { 
                         echo " | <a href='".get_post_meta($post->ID,'source_link')[0]."' target='_blank'>".get_post_meta($post->ID,'source_name')[0]."</a>";
                          } ?>
                    </div>
                    </div>
                </div> 
            
        <?php endwhile; endif; ?>    
            
        </div>
            
   <?php paginate(); ?>

        
    </div>


<?php get_footer(); ?>