<?php get_header(); ?>

  <div class="container newsDetails">

    <?php $cats=get_the_category();
  
    foreach($cats as $cat){
/*check for category having parent or not except category id=1 which is wordpress default category (Uncategorized)*/
        if($cat->category_parent == 0 && $cat->term_id != 1){        
          echo '<a class="backLink" href="'.newsCategoryLink($cat->term_id).'">'.__("< Return to ","sab_lang").$cat->name.'</a>';
          break;
        }
    } ?>   
    
      <?php  if(have_posts()) : while(have_posts()) : the_post(); ?>
                 
                    <h1 class="newsTitle"><?php the_title(); ?></h1>
                    <div class="row">
                       <div class="col-12 col-xl-9">
                        <?php if(has_post_thumbnail()) {
                           the_post_thumbnail('original'); 
                          }?>
                          <div class="newsContent">
                         
                          <?php the_content(); ?>
                        </div>
                      </div>

                      <div class="col-12 col-xl-3">
                        <h2 class="newsSidebarTitle"><?php echo __('Latest News','sab_lang'); ?></h2>
                        <div class="row">
                          <div class="newsItems">
                            <?php 
                                $latestNews_a = array (
                                    'post_type'     => 'post',
                                    'posts_per_page' => '2',
                                    'post__not_in'  =>  array ($post->ID),
                                    'cat'           =>  $cat->term_id,
                                    'orderby'       =>  'date'
                                );

                                $latestNews_q = new WP_Query($latestNews_a);

                                if ($latestNews_q->have_posts()) : while ($latestNews_q->have_posts()) : $latestNews_q->the_post(); ?>
                                  
                                  <a href="<?php the_permalink(); ?>" class="newsItem col-12 col-md-4 col-xl-12">
                                      <div class="newsItemImgHandler">
                                        <?php if (has_post_thumbnail()) {

                                        } ?>
                                      </div>
                                      <h3 class="newsItemTitle"><?php  
                                      $news_title = get_the_title();
                                        if (strlen($news_title) > 35) {
                                         $news_title = substr($news_title, 0, strpos($news_title, ' ', 35));
                                        };
                                        echo $news_title."..."; ?>
                                          
                                        </h3>
                                      <div class="newsItemDesc">
                                        <?php 
                                            $news_exc = get_the_excerpt(); 
                                            $news_exc = substr($news_exc, 0, strpos($news_exc, ' ', 60));

                                              echo $news_exc."...";
                                          ?>

                                      </div>
                                      <div class="newsItemDateAuthor">
                                        <div class="newsItemMeta">
                                          <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo get_the_date('d M Y'); 
                                           if (get_post_meta($post->ID,'source_name')) { 
                                             echo " | <a href='".get_post_meta($post->ID,'source_link')[0]."' target='_blank'>".get_post_meta($post->ID,'source_name')[0]."</a>";
                                              } ?>
                                        </div>
                                      </div>
                                    </a>
  

                                <?php endwhile; wp_reset_postdata(); else: 

                                endif;

                             ?>

                          </div>
                          
                        </div>
                      </div>

                    </div>
                  


                <?php endwhile; endif; ?>
        
      </div>

<?php get_footer(); ?>