<?php 
$setting=getSettingSystem();
$contacted_phone=$setting['contacted_phone'];
$email_to=$setting['email_to'];
$address=$setting['address'];
$to_name=$setting['to_name'];
$telephone=$setting['telephone'];
$website=$setting['website'];
$slogan_about=$setting['slogan_about'];
$opened_time=$setting['opened_time'];
$opened_date=$setting['opened_date'];
$contaced_name=$setting['contacted_name'];
$facebook_url=$setting['facebook_url'];
$twitter_url=$setting['twitter_url'];
$google_plus=$setting['google_plus'];
$youtube_url=$setting['youtube_url'];
$instagram_url=$setting['instagram_url'];
$pinterest_url=$setting['pinterest_url'];     
$ssName="vmuser";
$arrUser=array();            
if(Session::has($ssName)){
  $arrUser=Session::get($ssName)["userInfo"];      
}         
$account_link=route("frontend.index.viewAccount");  
$logout_link=route("frontend.index.getLgout"); 
$security_link=route("frontend.index.viewSecurity"); 
$invoice_link=route("frontend.index.getInvoice");
$register_member_link=route("frontend.index.register");
$cart_link=route('frontend.index.viewCart');

$ssNameCart='vmart';
$quantity=0;
$arrCart=array();
              if(Session::has($ssNameCart)){    
                  $arrCart = @Session::get($ssNameCart)["cart"];    
              }         
              if(count($arrCart) > 0){
                foreach ($arrCart as $key => $value){
                  $quantity+=(int)$value['product_quantity'];              
                }
              }   
$data_slideshow=getModuleByPosition('slideshow');      
$data_de_centralised=getModuleByPosition('de-centralised');         
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">  
  <title><?php echo (!empty($title)) ? $title : $slogan_about; ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="keywords" content="<?php echo @$meta_keyword; ?>" />
  <meta name="description" content="<?php echo @$meta_description; ?>"/>
  <script src="{{ asset('public/frontend/js/jquery-3.2.1.js') }}"></script>
  <script src="{{ asset('public/frontend/js/bootstrap.js') }}"></script>
  <script src="{{ asset('public/frontend/js/ddsmoothmenu.js') }}"></script>
  <script src="{{ asset('public/frontend/js/jquery.fancybox.js') }}"></script>
  <script src="{{ asset('public/frontend/js/jquery.fancybox-buttons.js') }}"></script>
  <script src="{{ asset('public/frontend/js/jquery.fancybox-thumbs.js') }}"></script>
  <script src="{{ asset('public/frontend/js/jquery.fancybox-media.js') }}"></script>
  <script src="{{ asset('public/frontend/nivo-slider/jquery.nivo.slider.js') }}"></script>
  <script src="{{ asset('public/frontend/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('public/frontend/js/jquery.simplyscroll.min.js') }}"></script>
  <script src="{{ asset('public/frontend/js/jquery.bxslider.min.js') }}"></script>
  <script src="{{ asset('public/frontend/js/jquery.elevatezoom-3.0.8.min.js') }}"></script>
  <script src="{{ asset('public/frontend/js/accounting.min.js') }}"></script>
  <script src="{{ asset('public/frontend/js/custom.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('public/frontend/css/font-awesome.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/bootstrap.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/ddsmoothmenu.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/jquery.fancybox.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/jquery.fancybox-buttons.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/jquery.fancybox-thumbs.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/hover.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/pagination.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/jquerysctipttop.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/nivo-slider/themes/default/default.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/nivo-slider/themes/light/light.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/nivo-slider/themes/dark/dark.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/nivo-slider/themes/bar/bar.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/nivo-slider/nivo-slider.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/owl.carousel.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/jquery.simplyscroll.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/jquery.bxslider.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/dropdownmenu.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/tab.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/menu-horizontal-right.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/product.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/template.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/custom.css') }}" />
  <script type="text/javascript" language="javascript">
    ddsmoothmenu.init({
      mainmenuid: "smoothmainmenu", 
      orientation: "h", 
      classname: "ddsmoothmenu",
      contentsource: "markup" 
    });    
    ddsmoothmenu.init({
      mainmenuid: "smoothmainmenu-2", 
      orientation: "h", 
      classname: "ddsmoothmenu",
      contentsource: "markup" 
    });    
    $(document).ready(function(){        
      $(window).bind("scroll", function() {                        
        if ($(window).scrollTop() > 38) {
         $("div.bg-header").hide();
         $("div.bg-header-2").show();         
       }
       else {
        $("div.bg-header").show();
         $("div.bg-header-2").hide();
       }
     });
      var home_li='<li><a href="<?php echo url('/'); ?>"><img src="<?php echo asset('upload/home.png'); ?>" /></a></li>';
      $('.mainmenu').prepend(home_li);
    });
  </script>
</head>
<body>
  <header class="header">
    <div class="container relative">
      <div class="top-header">      
        <div class="contact-language">
          <div class="col-xs-4"><a href="<?php echo url('lien-he'); ?>">Contact Us</a></div>
          <div class="col-xs-4 "><a href="<?php echo url('/'); ?>">English</a></div>
          <div class="col-xs-4 "><font color='#ffffff'><i class="fa fa-search" aria-hidden="true"></i></font></div>
        </div>      
      </div>
      <div class="bg-header">       
        <div class="menu border-radius-10">
          <div class="col-lg-3 no-padding logo">                
            <a href="<?php echo url('/'); ?>">                
              <img src="<?php echo asset('upload/logo.png');?>" />
            </a>
          </div>
          <div class="col-lg-9 no-padding">             
            <?php     
            $args = array(                         
              'menu_class'            => 'mainmenu', 
              'menu_id'               => 'main-menu',                         
              'before_wrapper'        => '<div id="smoothmainmenu" class="ddsmoothmenu">',
              'before_title'          => '',
              'after_title'           => '',
              'before_wrapper_ul'     =>  '',
              'after_wrapper_ul'      =>  '',
              'after_wrapper'         => '</div>'     ,
              'link_before'           => '', 
              'link_after'            => '',                                                                    
              'theme_location'        => 'main-menu' ,
              'menu_li_actived'       => 'current-menu-item',
              'menu_item_has_children'=> 'menu-item-has-children',
              'alias'                 => $alias
            );                    
            wp_nav_menu($args);
            ?>    
            <div class="clr"></div>          
          </div>
          <div class="clr"></div>
        </div>     
      </div>
      <div class="de-centralised">
        <div class="col-lg-5 no-padding">
          <?php 
          if(count($data_de_centralised) > 0){
            for($i=0;$i<count($data_de_centralised);$i++){
              $permalink=url($data_de_centralised[$i]['alias'].'.html');              
              $fullname=$data_de_centralised[$i]['fullname'];
              $intro=$data_de_centralised[$i]['intro'];            
              ?>
              <div class="de-centralised-content">
                <div>
                  <div class="thanh-ngang"></div>
                  <div class="clr"></div>
                </div>
                <h3><a href="<?php echo $permalink; ?>"><?php echo $fullname; ?></a></h3>
                <div><?php echo $intro; ?></div>
              </div>
              <?php
            }
          }
          ?>
        </div>
        <div class="col-lg-7 no-padding"></div>
      </div>
    </div>
    
    <div class="bg-header-2" style="display: none">
      <div class="menu">
          <div class="col-lg-3 no-padding logo">                
            <a href="<?php echo url('/'); ?>">                
              <img src="<?php echo asset('upload/logo.png');?>" />
            </a>
          </div>
          <div class="col-lg-9 no-padding">             
            <?php     
            $args = array(                         
              'menu_class'            => 'mainmenu', 
              'menu_id'               => 'main-menu',                         
              'before_wrapper'        => '<div id="smoothmainmenu-2" class="ddsmoothmenu">',
              'before_title'          => '',
              'after_title'           => '',
              'before_wrapper_ul'     =>  '',
              'after_wrapper_ul'      =>  '',
              'after_wrapper'         => '</div>'     ,
              'link_before'           => '', 
              'link_after'            => '',                                                                    
              'theme_location'        => 'main-menu' ,
              'menu_li_actived'       => 'current-menu-item',
              'menu_item_has_children'=> 'menu-item-has-children',
              'alias'                 => $alias
            );                    
            wp_nav_menu($args);
            ?>    
            <div class="clr"></div>          
          </div>
          <div class="clr"></div>
        </div>
    </div>
    
    <?php 
    if(count($data_slideshow) > 0){
      ?>  
      <div id="wrapper">
        <div class="slider-wrapper theme-default">
          <div id="slider" class="nivoSlider"> 
            <?php 
            for($i=0 ; $i < count($data_slideshow) ; $i++ ){
              $banner=asset('upload/'.$data_slideshow[$i]['image']);
              ?>
              <img src="<?php echo $banner; ?>" data-thumb="<?php echo $banner; ?>" alt="" />     
              <?php
            } 
            ?>

          </div>        
        </div>
      </div>
      <script type="text/javascript">
        jQuery(document).ready(function(){
          jQuery('#slider').nivoSlider();
        });    
      </script> 

      <?php
    }
    ?>
    
  </header>