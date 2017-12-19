<?php get_header(); ?>

<div class="pageContainer">
  <div class="container ">
  	<div class="row">
      <?php  if(have_posts()) : while(have_posts()) : the_post(); ?>
                  <div class="col-12"> <h1 class="pageTitle">
                          <?php the_title(); ?>
                       </h1>
                   </div>
                   <div class="col-12 col-md-6">
                       <?php the_content(); ?>
                    </div>

                    <div class="col-12 col-md-6 branchesSection">

                      <?php 

                        $branches_a = array (
                            'post_type' => 'branch',
                            'order'   =>  'ASC',
                            'orderby' =>  'title',
                            'posts_per_page'  => '-1'
                        );

                        $branches_q = new WP_Query($branches_a);
                        $i=0;

                        if($branches_q->have_posts()):  while($branches_q->have_posts()): $branches_q->the_post(); 

                      
                        $branch_arr[$i]['slug'] = get_post_field( 'post_name', get_post() );
                        $branch_arr[$i]['title'] = get_the_title();
                         if (get_post_meta($post->ID,'country')) {
                          $branch_arr[$i]['country'] = get_post_meta($post->ID,'country');
                         }
                         if (get_post_meta($post->ID,'address')) {
                          $branch_arr[$i]['address'] = get_post_meta($post->ID,'address');
                         }
                         if (get_post_meta($post->ID,'phone')) {
                          $branch_arr[$i]['phone'] = get_post_meta($post->ID,'phone');
                         }
                         if (get_post_meta($post->ID,'email')) {
                          $branch_arr[$i]['email'] = get_post_meta($post->ID,'email');
                         }
                         if (get_post_meta($post->ID,'work-hours')) {
                          $branch_arr[$i]['work-hours'] = get_post_meta($post->ID,'work-hours');
                         }
                         if (get_post_meta($post->ID,'loc-lat')) {
                          $branch_arr[$i]['locLat'] = get_post_meta($post->ID,'loc-lat');
                         }
                         if (get_post_meta($post->ID,'loc-lng')) {
                          $branch_arr[$i]['locLng'] = get_post_meta($post->ID,'loc-lng');
                         }
                         $i++;

                        endwhile; ?>   <?php endif; wp_reset_postdata();  ?>

                         <ul class="nav nav-pills flex-column flex-sm-row" role="tablist">
                           <?php 
                                  $j = true;
                                  $k = 1;
                                foreach ($branch_arr as $value) { ?>
                                <li data-toggle="collapse" data-target=".multi-collapse" aria-expanded="true" aria-controls="map-<?php $value['slug']; ?>">
                                  <a href="#<?php echo $value['slug']; ?>" aria-controls="<?php echo $value['slug']; ?>" role="tab" data-toggle="tab" class="<?php echo ($j) ? 'active' : '';?>"><?php echo $value['title']; ?></a>
                                </li>

                            <?php $j = false; $k++; }?>
                         
                         </ul>
                        <div class="tab-content">
                                
                                <?php $j = true;
                                    foreach ( $branch_arr as $value ) { ?>
                                            <!-- Tab panes -->
                                            <div role="tabpanel" class="branchInfo tab-pane fade in <?php echo ($j) ? ' active show' : ''; ?>" id="<?php echo $value['slug'];  ?>">

                                              <div class="branchHours">
                                                  <?php echo $value['work-hours'][0]; ?>
                                              </div>

                                              <div class="branchAddress">
                                                  <?php echo $value['address'][0]; ?>
                                              </div>

                                              <div class="branchEmail">
                                                <?php echo isset($value['email'][0]) ? '<a href="mailto:'.$value['email'][0].'">'.$value['email'][0].'</a>' : ''; ?>
                                              </div>
                                              <div class="branchPhone">
                                                <?php echo isset($value['phone'][0]) ? '<a href="tel:'.$value['phone'][0].'">'.$value['phone'][0].'</a>' : ''; ?>
                                              </div>


                                            </div>
                                            
                                        <?php 
                                            
                                     $j = false;
                                    
                                  }

                                ?>

                            </div>

                    </div>

                <?php endwhile; endif; ?>
        </div>
      </div>

</div>

<div class="mapsArea">

 <?php $j = true;
       foreach ( $branch_arr as $value ) { ?>

       <div class="mapHolder map<?php echo $value[title]; ?>">
          <?php 

          $handlId = "map".$value[title]; 

          mapCaller($handlId, $value['locLat'][0], $value['locLng'][0]); ?>
       </div>

  <?php $j = false;
                                    
   } ?>

 </div>

<?php get_footer(); ?>