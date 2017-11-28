@extends("frontend.master")
@section("content")
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
$map_url=$setting['map_url'];
// lấy sản phẩm nổi bật
$data_featured_product=getModuleByPosition('featured-product');    
// thiết bị vệ sinh
$data_toilet_equipment=getModuleByPosition('toilet-equipment');
// thiết bị bếp
$data_chicken_equipment=getModuleByPosition('chicken-equipment');
// nhà thông minh
$data_clever_house=getModuleByPosition('clever-house');
// lấy danh sách khách hàng
$data_customer=getModuleByPosition('customer');    
// tin mới
$data_hot_article=getModuleByPosition('hot-article');    
// đối tác
$data_partner=getModuleByPosition('partner');    
// slideshow
$data_slideshow=getModuleByPosition('slideshow');    
// banner trái
$data_banner_trai=getModuleByPosition('noi-that-sang-trong');    

?>
@endsection()               