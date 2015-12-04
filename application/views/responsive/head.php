	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width">
                <meta name="verification" content="82ebea81ee11638f9d48fd9e8edd4d21" />
		<?=css_asset('style.css?v=3')?>
		<?=css_asset('new.css')?>
		<?=css_asset('jquery-ui-1.8.23.custom.css')?>
		<?=css_asset("validationEngine.jquery.css")?>
		<?=css_asset('jquery.selectbox.css')?>
		<?=css_asset('skins/tango/skin.css')?>
		<?=css_asset('skins/tango/popular_sales.css')?>
		<?=css_asset('skins/tango/detailpage.css')?>
		<? //css_asset('skins/tango/detail_sales.css'); ?>
		<?=css_asset("uploadify.css")?>
		<?=css_asset("colorbox.css")?>
		<?=css_asset("jquery.wysiwyg.css","admin")?>
	    <style>
	    	ul.uploadedimages {
			    list-style: none outside none;
			}
			ul.uploadedimages li {
			    float: left;
			    padding: 0 5px;
			    background: none !important;
			}
	    </style>
		<title><?=$this->config->item('site_title')?></title>
                <?=js_asset('bootstrap/jquery.min.js');?> 
                 <? //=js_asset('jquery-1.8.1.min.js');?>
                <?=js_asset('jquery.jcarousel.js');?>
                <?=js_asset('jquery-ui-date_picker.min.js');?>  
                <?=js_asset('jquery.cycle.all.js');?>  
                <?=js_asset('jquery.selectbox-0.2.js');?>  
                <?=js_asset('jcarousellite.min.js');?>
                <?=js_asset('slides.min.jquery.js');?>
                <?=js_asset('jquery.placeholder.js');?>
                <?=js_asset('jquery.colorbox-min.js');?>
                <?=js_asset('jquery.validationEngine-en.js')?>
  				<?=js_asset('jquery.validationEngine.js')?> 
  <script type="text/javascript">
                        $(document).ready(function(){
                        	$('ul.treeMenu li:has("div")').find('span:first').addClass('closed');
							$('ul.treeMenu li:has("div")').find('div').hide();	
							$('ul.treeMenu li:has("div.selected")').find('div').show();	
							$('.treeMenu li:has("div")').find('span:first').click (function (){ 
								$(this).parent('li').find('span:first').toggleClass('opened');
								$(this).parent('li').find('div:first').slideToggle();
							 
							 });
                           //$("#location_id").selectbox();
                           jQuery("#retailer_id").selectbox();
							var id = '';
							$('.adslimit').click(function(){
								alert('ADS Limit Reached! Please upgrade your subscription package or delete some product to add new');
								return false;
							});
                           /* $('#rotating_banner').before('<div id="banner_nav">').cycle({ 
                                fx:     'scrollDown',  
                                timeout: 3000, 
                                pager:  '#banner_nav'
                            });*/
                            
                            jQuery('#popular_retailers').jcarousel({
                                scroll: 5
                            });
							jQuery('#popular_brands').jcarousel({
                                scroll: 5
                            });
                            
                            jQuery('#popular_sales').jcarousel({
                                scroll: 5,
                                auto:5,
                                wrap:'last'
                            });
                            jQuery('#more_from_category').jcarousel({
                                scroll: 4
                            });
							jQuery('#more_from_retailer').jcarousel({
                                scroll: 4
                            });
                            jQuery('#more_on_detailpage').jcarousel({
                                scroll: 4
                            });
                            $('.product_detail').on('mouseover',function(){								
								var id = $(this).attr('rel');								
								$('#wish_heart_'+id).show();							
															
							});
							$('.product_detail').on('mouseout',function(){
								var id = $(this).attr('rel');	
                                                                console.log('#wish_heart_'+id);
                                                                if($('#wish_heart_'+id).hasClass("heartred")){
                                                                    return false;
                                                                }
								$('#wish_heart_'+id).hide();
							});
							$('.heart').on('click',function(){
								product_id = $(this).attr('rel');
								if(product_id!=''){
									$.ajax({
										type: "POST",
										  url: "<?=base_url()?>product/add_wishlist",
										  data: {product_id:product_id},
										  success: function(msg){
											$('#wish_heart_'+product_id).replaceWith(msg);
									    	count =  parseInt($('#wishlist').html());
										 	count = count +1 ;
											$('#wishlist').html(count);
                                        	$('.topwishlistimg').html('<?=image_asset("heart_red.jpg")?>');
										  }
									});
								}
								else{
									alert('product aleardy there');
								}
							});
							// from detail page
							$('.add_wishlist').click(function(){
							  	var product_id = $(this).attr('rel');
							  	$.ajax({
									type: "POST",
									  url: "<?=base_url()?>product/add_wishlist",
									  data: {product_id:product_id},
									  success: function(msg){
									 	location.reload();
									  }
								});
						 	});
							$('.heartred').on('click',function(){
								product_id = $(this).attr('rel');
								if(product_id!=''){
									$.ajax({
										type: "POST",
										  url: "<?=base_url()?>product/remove_pro_wishlist",
										  data: {product_id:product_id},
										  success: function(msg){
											$('#wish_heart_'+product_id).replaceWith(msg);
									    	count =  parseInt($('#wishlist').html());
										 	count = count -1 ;
											$('#wishlist').html(count);
											if(count < 1)
                                        		$('.topwishlistimg').html('<?=image_asset("header.jpg")?>');
										  }
									});
								}
								else{
									alert('product aleardy there');
								}
							});
							$('.remove_wish').click(function(){
								var wish_id = $(this).attr('rel');
								window.location.href = "<?=base_url()?>product/remove_wishlist/"+wish_id;
							});
                            $('#category_slides').slides({
                                    preload: true,
                                    preloadImage: 'img/loading.gif',
                                    play: 5000,
                                    pause: 2500,
                                    hoverPause: true,
                                    animationStart: function(current){
                                            $('.caption').animate({
                                                    bottom:-35
                                            },100);
                                            if (window.console && console.log) {
                                                    // example return of current slide number
                                                    console.log('animationStart on slide: ', current);
                                            };
                                    },
                                    animationComplete: function(current){
                                            $('.caption').animate({
                                                    bottom:0
                                            },200);
                                            if (window.console && console.log) {
                                                    // example return of current slide number
                                                    console.log('animationComplete on slide: ', current);
                                            };
                                    },
                                    slidesLoaded: function() {
                                            $('.caption').animate({
                                                    bottom:0
                                            },200);
                                    }
                            });
							
						/*$('#city_form').submit(function() {
							var city_id     = $("#by_location").val();
							var retailer_id = $("#by_retailer").val();
							var product_name = $("#pro_name").val();
							$.ajax({
								type: "POST",
								url: "<?=base_url()?>product/search_form",
								data: {city_id:city_id,retailer_id:retailer_id,product_name:product_name},
								success: function(msg){								 	
								 $('#product_cat').html(msg);	
								}
							});	
							return false;	
						}); */
                            
                            $('.search_bg input[placeholder]').placeholder();
                            
                            $('#color_picker_choose').click(function(event){
                                event.preventDefault();
                                if($('#color_picker').css('visibility')=='visible'){
                                    $('#color_picker').css('visibility','hidden');
                                }else{
                                    $('#color_picker').css('visibility','visible');
                                }
                            }); 
                            
                            $('#selected_color_box').click(function(event){
                                event.preventDefault();
                                if($('#color_picker').css('visibility')=='visible'){
                                    $('#color_picker').css('visibility','hidden');
                                }else{
                                    $('#color_picker').css('visibility','visible');
                                }
                            }); 
                            
                            
                            $('a.color_box').click(function(event){
                                event.preventDefault();
                                var color = $(this).css('background-color');
                                var color_name = $(this).attr('href');
                                $('#color_value').val(color_name);
                                $('#selected_color_box').css('display','block');

                                $('#selected_color_box').css('background-color',color);
                                $('#selected_color_box').attr('href',color_name);
                                $('#choose_color_box').css('display','none');
                                $('#color_picker').css('visibility','hidden');
                                $('#filter_form').submit();
                                return false;
                            });
                            
                            $(".other_filters").change(function(event){
                                event.preventDefault();
                                $('#filter_form').submit();
                            }); 
                            
                            $('#remove_color_filter').click(function(event){
                                event.preventDefault();
                                $('#color_value').val("");
                                $('#filter_form').submit();
                            })
                            
                           /* $('*').not('div#color_picker,#selected_color_box,#color_picker_choose,#choose_color_box').click(function(event){
                                event.preventDefault();
                                console.log($(this));
                                console.log($('#color_picker'));
                                //$('#color_picker').css('visibility','hidden');
                            }) */
                            $(document).on('click',':not(#color_picker,#selected_color_box,#color_picker_choose,#choose_color_box)',function(event){
                                var idArr = ['color_picker','selected_color_box','color_picker_choose','choose_color_box'];
                                if ( idArr.indexOf(event.target.id) == -1 ) {
                                    $('#color_picker').css('visibility','hidden');
                                }
                            })
                            
                        });


                </script>
		<script type="text/javascript">var switchTo5x=true;</script>
		<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
		<script type="text/javascript">stLight.options({publisher: "276ba6b6-a496-4bf6-aaae-2441ba995d08", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
                <style>
                    .filters{
                        background-color:#fff;
                        border:solid 1px;
                    }
                    </style>
	</head>