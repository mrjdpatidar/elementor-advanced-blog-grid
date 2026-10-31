<?php
if (!defined('ABSPATH')) exit;
use Elementor\Widget_Base;
use Elementor\Controls_Manager as C;
use Elementor\Group_Control_Typography as T;
use Elementor\Group_Control_Border as B;
use Elementor\Group_Control_Box_Shadow as S;
use Elementor\Group_Control_Background as BG;
use Elementor\Group_Control_Image_Size as IS;
class ABG_Blog_Grid_Widget extends Widget_Base {
 public function get_name(){return 'advanced_blog_grid';}
 public function get_title(){return esc_html__('Advanced Blog Grid','advanced-blog-grid');}
 public function get_icon(){return 'eicon-posts-grid';}
 public function get_categories(){return ['general'];}
 public function get_style_depends(){return ['abg-blog-grid'];}
 protected function register_controls(){
  $this->start_controls_section('content',['label'=>'Query & Content']);
  $this->add_control('post_type',['label'=>'Post Type','type'=>C::SELECT,'options'=>['post'=>'Posts','page'=>'Pages'],'default'=>'post']);
  $cats=get_categories(['hide_empty'=>false]);$opts=[''=>'All Categories'];foreach($cats as $cat){$opts[$cat->term_id]=$cat->name;}
  $this->add_control('category',['label'=>'Category','type'=>C::SELECT,'options'=>$opts,'default'=>'','condition'=>['post_type'=>'post']]);
  $this->add_control('per_page',['label'=>'Posts Per Page','type'=>C::NUMBER,'min'=>1,'max'=>100,'default'=>12]);
  $this->add_control('orderby',['label'=>'Order By','type'=>C::SELECT,'options'=>['date'=>'Date','title'=>'Title','modified'=>'Modified','rand'=>'Random','menu_order'=>'Menu Order'],'default'=>'date']);
  $this->add_control('order',['label'=>'Order','type'=>C::SELECT,'options'=>['DESC'=>'Descending','ASC'=>'Ascending'],'default'=>'DESC']);
  foreach(['image'=>'Featured Image','title'=>'Post Title','excerpt'=>'Excerpt','readmore'=>'Read More'] as $key=>$label){$this->add_control('show_'.$key,['label'=>'Show '.$label,'type'=>C::SWITCHER,'label_on'=>'Yes','label_off'=>'No','return_value'=>'yes','default'=>in_array($key,['image','title'])?'yes':'']);}
  $this->add_control('excerpt_length',['label'=>'Excerpt Words','type'=>C::NUMBER,'min'=>1,'max'=>100,'default'=>20,'condition'=>['show_excerpt'=>'yes']]);
  $this->add_control('readmore_text',['label'=>'Read More Text','type'=>C::TEXT,'default'=>'Read More','condition'=>['show_readmore'=>'yes']]);
  $this->add_control('image_size',['label'=>'Image Size','type'=>C::SELECT,'options'=>['thumbnail'=>'Thumbnail','medium'=>'Medium','medium_large'=>'Medium Large','large'=>'Large','full'=>'Full'],'default'=>'medium_large']);
  $this->add_control('pagination',['label'=>'Pagination','type'=>C::SWITCHER,'return_value'=>'yes','default'=>'yes']);
  $this->add_control('page_arrows',['label'=>'Previous / Next','type'=>C::SWITCHER,'return_value'=>'yes','default'=>'yes','condition'=>['pagination'=>'yes']]);
  $this->add_control('page_ends',['label'=>'Show First / Last Page Numbers','type'=>C::SWITCHER,'return_value'=>'yes','default'=>'yes','condition'=>['pagination'=>'yes']]);
  $this->add_control('page_mid',['label'=>'Numbers Around Current','type'=>C::NUMBER,'min'=>0,'max'=>8,'default'=>2,'condition'=>['pagination'=>'yes']]);
  $this->end_controls_section();
  $this->start_controls_section('layout',['label'=>'Grid Layout','tab'=>C::TAB_STYLE]);
  $this->add_responsive_control('columns',['label'=>'Columns','type'=>C::SELECT,'options'=>['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6'],'default'=>'3','tablet_default'=>'2','mobile_default'=>'1','selectors'=>['{{WRAPPER}} .abg-grid'=>'grid-template-columns:repeat({{VALUE}},minmax(0,1fr));']]);
  $this->add_responsive_control('col_gap',['label'=>'Column Gap','type'=>C::SLIDER,'size_units'=>['px','em'],'range'=>['px'=>['min'=>0,'max'=>120]],'default'=>['size'=>22,'unit'=>'px'],'selectors'=>['{{WRAPPER}} .abg-grid'=>'column-gap:{{SIZE}}{{UNIT}};']]);
  $this->add_responsive_control('row_gap',['label'=>'Row Gap','type'=>C::SLIDER,'size_units'=>['px','em'],'range'=>['px'=>['min'=>0,'max'=>120]],'default'=>['size'=>30,'unit'=>'px'],'selectors'=>['{{WRAPPER}} .abg-grid'=>'row-gap:{{SIZE}}{{UNIT}};']]);
  $this->add_responsive_control('alignment',['label'=>'Text Alignment','type'=>C::CHOOSE,'options'=>['left'=>['title'=>'Left','icon'=>'eicon-text-align-left'],'center'=>['title'=>'Center','icon'=>'eicon-text-align-center'],'right'=>['title'=>'Right','icon'=>'eicon-text-align-right']],'selectors'=>['{{WRAPPER}} .abg-card'=>'text-align:{{VALUE}};']]);
  $this->end_controls_section();
  $this->start_controls_section('cardstyle',['label'=>'Cards','tab'=>C::TAB_STYLE]);
  $this->add_group_control(BG::get_type(),['name'=>'card_bg','selector'=>'{{WRAPPER}} .abg-card']);
  $this->add_group_control(B::get_type(),['name'=>'card_border','selector'=>'{{WRAPPER}} .abg-card']);
  $this->add_responsive_control('card_radius',['label'=>'Card Radius','type'=>C::DIMENSIONS,'size_units'=>['px','%'],'selectors'=>['{{WRAPPER}} .abg-card'=>'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
  $this->add_responsive_control('card_padding',['label'=>'Card Padding','type'=>C::DIMENSIONS,'size_units'=>['px','em'],'selectors'=>['{{WRAPPER}} .abg-card'=>'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
  $this->add_group_control(S::get_type(),['name'=>'card_shadow','selector'=>'{{WRAPPER}} .abg-card']);
  $this->end_controls_section();
  $this->start_controls_section('imagestyle',['label'=>'Image','tab'=>C::TAB_STYLE,'condition'=>['show_image'=>'yes']]);
  $this->add_responsive_control('image_ratio',['label'=>'Image Ratio','type'=>C::SELECT,'options'=>['16/9'=>'16:9','4/3'=>'4:3','1/1'=>'Square','3/2'=>'3:2','2/3'=>'Portrait'],'default'=>'16/9','selectors'=>['{{WRAPPER}} .abg-image'=>'aspect-ratio:{{VALUE}};']]);
  $this->add_responsive_control('image_radius',['label'=>'Image Radius','type'=>C::DIMENSIONS,'size_units'=>['px','%'],'selectors'=>['{{WRAPPER}} .abg-image'=>'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
  $this->add_responsive_control('image_bottom',['label'=>'Bottom Spacing','type'=>C::SLIDER,'range'=>['px'=>['min'=>0,'max'=>80]],'default'=>['size'=>10],'selectors'=>['{{WRAPPER}} .abg-image'=>'margin-bottom:{{SIZE}}px;']]);
  $this->add_control('image_hover',['label'=>'Image Hover Zoom','type'=>C::SWITCHER,'return_value'=>'yes','default'=>'yes']);
  $this->end_controls_section();
  $this->start_controls_section('titlestyle',['label'=>'Title','tab'=>C::TAB_STYLE,'condition'=>['show_title'=>'yes']]);
  $this->add_group_control(T::get_type(),['name'=>'title_typography','selector'=>'{{WRAPPER}} .abg-title']);
  $this->add_control('title_color',['label'=>'Normal Color','type'=>C::COLOR,'selectors'=>['{{WRAPPER}} .abg-title a'=>'color:{{VALUE}};']]);
  $this->add_control('title_hover_color',['label'=>'Hover Color','type'=>C::COLOR,'selectors'=>['{{WRAPPER}} .abg-title a:hover'=>'color:{{VALUE}};']]);
  $this->add_responsive_control('title_spacing',['label'=>'Bottom Spacing','type'=>C::SLIDER,'range'=>['px'=>['min'=>0,'max'=>80]],'selectors'=>['{{WRAPPER}} .abg-title'=>'margin-bottom:{{SIZE}}px;']]);
  $this->end_controls_section();
  foreach(['excerpt'=>'Excerpt','readmore'=>'Read More'] as $name=>$label){
   $this->start_controls_section($name.'style',['label'=>$label,'tab'=>C::TAB_STYLE,'condition'=>['show_'.$name=>'yes']]);
   $this->add_group_control(T::get_type(),['name'=>$name.'_typo','selector'=>'{{WRAPPER}} .abg-'.$name]);
   $this->add_control($name.'_color',['label'=>'Color','type'=>C::COLOR,'selectors'=>['{{WRAPPER}} .abg-'.$name=>'color:{{VALUE}};']]);
   if($name==='readmore')$this->add_control($name.'_hover',['label'=>'Hover Color','type'=>C::COLOR,'selectors'=>['{{WRAPPER}} .abg-readmore:hover'=>'color:{{VALUE}};']]);
   $this->end_controls_section();
  }
  $this->start_controls_section('paginationstyle',['label'=>'Pagination','tab'=>C::TAB_STYLE,'condition'=>['pagination'=>'yes']]);
  $this->add_responsive_control('page_align',['label'=>'Alignment','type'=>C::CHOOSE,'options'=>['flex-start'=>['title'=>'Left','icon'=>'eicon-text-align-left'],'center'=>['title'=>'Center','icon'=>'eicon-text-align-center'],'flex-end'=>['title'=>'Right','icon'=>'eicon-text-align-right']],'default'=>'center','selectors'=>['{{WRAPPER}} .abg-pagination ul'=>'justify-content:{{VALUE}};']]);
  $this->add_group_control(T::get_type(),['name'=>'page_typo','selector'=>'{{WRAPPER}} .abg-pagination a, {{WRAPPER}} .abg-pagination span']);
  $this->add_responsive_control('page_top',['label'=>'Top Spacing','type'=>C::SLIDER,'range'=>['px'=>['min'=>0,'max'=>150]],'default'=>['size'=>40],'selectors'=>['{{WRAPPER}} .abg-pagination'=>'margin-top:{{SIZE}}px;']]);
  $this->add_responsive_control('page_gap',['label'=>'Item Gap','type'=>C::SLIDER,'range'=>['px'=>['min'=>0,'max'=>50]],'default'=>['size'=>8],'selectors'=>['{{WRAPPER}} .abg-pagination ul'=>'gap:{{SIZE}}px;']]);
  $this->add_responsive_control('page_size',['label'=>'Button Size','type'=>C::SLIDER,'range'=>['px'=>['min'=>20,'max'=>90]],'default'=>['size'=>34],'selectors'=>['{{WRAPPER}} .abg-pagination a, {{WRAPPER}} .abg-pagination span'=>'min-width:{{SIZE}}px;height:{{SIZE}}px;']]);
  $this->add_responsive_control('page_radius',['label'=>'Border Radius','type'=>C::SLIDER,'range'=>['px'=>['min'=>0,'max'=>60]],'default'=>['size'=>6],'selectors'=>['{{WRAPPER}} .abg-pagination a, {{WRAPPER}} .abg-pagination span'=>'border-radius:{{SIZE}}px;']]);
  $this->add_group_control(B::get_type(),['name'=>'page_border','selector'=>'{{WRAPPER}} .abg-pagination a, {{WRAPPER}} .abg-pagination span']);
  foreach(['normal'=>'Normal','hover'=>'Hover','active'=>'Active'] as $state=>$label){
   $this->add_control('page_'.$state.'_heading',['label'=>$label,'type'=>C::HEADING,'separator'=>'before']);
   $selector=$state==='normal'?'.abg-pagination a, {{WRAPPER}} .abg-pagination span':($state==='hover'?'.abg-pagination a:hover':'.abg-pagination .current');
   $this->add_control('page_'.$state.'_text',['label'=>'Text Color','type'=>C::COLOR,'selectors'=>['{{WRAPPER}} '.$selector=>'color:{{VALUE}};']]);
   $this->add_control('page_'.$state.'_bg',['label'=>'Background','type'=>C::COLOR,'selectors'=>['{{WRAPPER}} '.$selector=>'background-color:{{VALUE}};']]);
  }
  $this->end_controls_section();
 }
 protected function render(){
  $s=$this->get_settings_for_display();
  $page=isset($_GET['abg_page'])?max(1,absint(wp_unslash($_GET['abg_page']))):1;
  $args=['post_type'=>in_array($s['post_type'],['post','page'],true)?$s['post_type']:'post','post_status'=>'publish','posts_per_page'=>max(1,min(100,(int)$s['per_page'])),'paged'=>$page,'orderby'=>$s['orderby'],'order'=>$s['order'],'ignore_sticky_posts'=>true];
  if($args['post_type']==='post'&&!empty($s['category']))$args['cat']=(int)$s['category'];
  $q=new WP_Query($args);
  if(!$q->have_posts()){echo '<p>'.esc_html__('No posts found.','advanced-blog-grid').'</p>';wp_reset_postdata();return;}
  $zoom=($s['image_hover']??'')==='yes'?' abg-zoom':'';
  echo '<div class="abg-grid'.$zoom.'">';
  while($q->have_posts()){$q->the_post();
   echo '<article class="abg-card">';
   if(($s['show_image']??'')==='yes'&&has_post_thumbnail()){echo '<a class="abg-image" href="'.esc_url(get_permalink()).'" aria-label="'.esc_attr(get_the_title()).'">';echo get_the_post_thumbnail(get_the_ID(),$s['image_size'],['loading'=>'lazy']);echo '</a>';}
   if(($s['show_title']??'')==='yes')echo '<h3 class="abg-title"><a href="'.esc_url(get_permalink()).'">'.esc_html(get_the_title()).'</a></h3>';
   if(($s['show_excerpt']??'')==='yes')echo '<div class="abg-excerpt">'.esc_html(wp_trim_words(get_the_excerpt(),max(1,(int)$s['excerpt_length']))).'</div>';
   if(($s['show_readmore']??'')==='yes')echo '<a class="abg-readmore" href="'.esc_url(get_permalink()).'">'.esc_html($s['readmore_text']).'</a>';
   echo '</article>';
  }
  echo '</div>';
  if(($s['pagination']??'')==='yes'&&$q->max_num_pages>1){
   $url=remove_query_arg('abg_page');
   $base=add_query_arg('abg_page','%#%',$url);
   $links=paginate_links(['base'=>esc_url_raw($base),'format'=>'','current'=>$page,'total'=>$q->max_num_pages,'mid_size'=>max(0,(int)$s['page_mid']),'end_size'=>($s['page_ends']??'')==='yes'?1:0,'prev_next'=>($s['page_arrows']??'')==='yes','prev_text'=>'&laquo;','next_text'=>'&raquo;','type'=>'list']);
   if($links)echo '<nav class="abg-pagination" aria-label="'.esc_attr__('Blog pagination','advanced-blog-grid').'">'.wp_kses_post($links).'</nav>';
  }
  wp_reset_postdata();
 }
}
