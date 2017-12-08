<?php get_header(); ?>

     <div class="bannerSection">
      <div id="bannerIndicator" class="carousel slide" data-ride="carousel">
         <?php
			$banner_a = array (  
				'post_type' => 'banner',
				'order'     =>  'ASC',
				'posts_per_page'=>  '-1',
			);            
			$banner_q = new WP_Query($banner_a);
		?>
		<ol class="carousel-indicators">
			<?php 
			if ($banner_q->have_posts() && $banner_q->count > 1) {				
				$j=0;				
				while($banner_q->have_posts()) {
					$banner_q->the_post(); ?>					
					<li data-target="#bannerIndicator" data-slide-to="<?php echo $j; ?>"  ></li>
					<?php $j++; 			   } 
			}			wp_reset_postdata();  
			?> 
        </ol>
        <div class="carousel-inner">
          <?php 		  
            $banner_a = array (
                'post_type' =>  'banner',
                'order'     =>  'ASC',
                'posts_per_page'=>  '-1',
            );
            $banner_q = new WP_Query($banner_a);
            if($banner_q->have_posts()) {				$i = 0;
                while($banner_q->have_posts()) {					$banner_q->the_post(); ?>
					<div class="carousel-item <?php echo (!$i)? 'active' : ''; ?>">
						<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail('original', array('class' => 'd-block w-100'));
						} ?>
						<div class="carousel-caption">
						  <?php the_content(); ?>
						</div>
					</div>
                 <?php $i++; }
            } else {
            };
            /* Restore original Post Data */
            wp_reset_postdata();    
        ?>
        </div>		<?php if($banner_q->post_count > 1 ): ?>
        <a class="carousel-control-prev" href="#bannerIndicator" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#bannerIndicator" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>		<?php endif; ?>		
      </div>       
     </div> 

      <?php get_template_part('template-parts/resources-section') ?>


     <div class="successStoriesSection">
       <div class="container">
        <div class="row">
        <?php query_posts( 'post_type=success-stories&posts_per_page=1&orderby=rand' ); ?>
        <?php if(have_posts()): while(have_posts()): the_post(); ?>
         <div class="col-12 col-xl-7 successStoriesHandler">
           <h2 class="sectionTitle"><?php _e('Success Stories', 'sab_lang')?></h2>
           <a href="<?php the_permalink() ?>" class=" d-block successStoriesImg text-center">
             <img class="w-100 mw-100" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="Success Story">
           </a>
           <a href="<?php the_permalink() ?>" class="successStoryTitle d-block "><?php the_title() ?></a>
           <div class="successStoryDesc"><?php the_content() ?> </div>
           <div class="successStoryDownloadHandler">
             <div class="row">
               <div class="col-12 col-md-6">
                 <a target="_blank" class="successStoryDownload" href="<?php bloginfo('url'); ?>/wp-content/uploads/2017/11/2017020217_GIZ-EISRA_Restart-book_light-version.pdf"><?php _e('Download "RESTART" book','sab_lang')?> <i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
               </div> 
               <div class="col-12 col-md-6  successStoryMoreHandler">
                 <a href="<?php bloginfo('url')?>/success-stories"><?php _e('Success Stories', 'sab_lang')?></a>
               </div>
             </div>
           </div>
         </div>
      <?php endwhile; endif; ?> 
      <?php wp_reset_query(); ?>         
         <div class="col-12 col-xl-5">
             <?php get_sidebar('homepage'); ?>
         </div>
        </div>
       </div>
     </div>

     <div class="homeNewsSection">
        
        <div class="container">
          <h2 class="sectionTitle white"><?php echo __('Latest News','sab_lang'); ?></h2>

          <div class="row row-eq-height">
            <?php 
              $news_a = array (
                  'post_type' => 'post',
                  'category_name' => 'news',
                  'posts_per_page'  => '4'
                );

              $news_q = new WP_Query($news_a);

              if ($news_q->have_posts()) : while($news_q->have_posts()): $news_q->the_post(); ?>
                
                <div class="homeNewsItem col-12 col-md-6 col-xl-3">

                    <?php if ( has_post_thumbnail() ) : ?>
                      <div class="thumbHolder">
                        <a class="thumbLink" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                            <?php if(has_post_thumbnail()) {
                                 the_post_thumbnail('thumbnail'); 
                                }?>
                        </a>

                        
                      </div>
                    <?php endif; ?>

                    <div class="homeNewsContent">
                      <?php get_template_part('template-parts/social') ?>
                    <h3 class="homeNewsTitle"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php 
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

               <?php endwhile;
                wp_reset_postdata();
              else:
              endif;
             ?>
            
          </div>
           <a href="<?php bloginfo('url'); ?>/news" class="moreNewsLink float-right"><?php echo __('More News', 'sab_lang'); ?> <i class="fa fa-caret-right" aria-hidden="true"></i></a>
        </div>

      </div>

     <?php get_footer(); ?>