<style>
#retailer_filter ul li
{
	text-align:left;
}
</style>
<div class="logo">
    <a href="<?=base_url();?>"><?=image_asset('logo.jpg')?></a>
</div><!--logo-->
<div class="header_right">
	<div class="top_wishlist">
		<ul>
			<li style="width:132px;">
				<!-- comment at registered--
                
                <a href="<?=base_url()?>auth/register_retailer"><span style="text-decoration:underline;color:#0099FF;font-weight:bold;">SÄLJ PÅ SALEFINDER</span></a>
                
                
               end -->
               </li>
			<li style="width:121px;">
				<a href="<?=base_url()?>product/wishlist/">
                                    <em class="topwishlistimg">
                                    <?php
                                    if(wishlist_count() > 0){?>
                                    <?=image_asset('heart_red.jpg')?>
                                    <?php
                                    }else{
                                        echo image_asset('header.jpg');
                                    }?>
                                    </em>
                                    <span>ÖNSKELISTA (<b id="wishlist" style="color:red"><?php echo wishlist_count()?></b>)</span>
                                </a>
			</li>
                        
                            
                            <?php $user_data = get_user_data();
                            if(isset($user_data['group_id']) && $user_data['group_id']){
                                if($user_data['group_id']==2){
                                    $url = base_url("user/viewproduct");
                                }elseif($user_data['group_id']==1){
                                    $url = base_url()."auth/edit_profile";
                                }
                            }else{
                                $url = base_url("auth/login");
                            }
                            ?>
                            <?php if(!$this->tank_auth->is_logged_in()){?>
                                <li><a href="<?=$url;?>"><?=image_asset('icon-account.jpg')?><span>LOGGA IN</span></a></li>
                            <?php }else {?>
                                <li style="width:100px;"><a href="<?=$url;?>"><?=image_asset('icon-account.jpg')?><span>MITT KONTO</span></a></li>
                            <?php } ?>
			
			
			
			<li style="width:93px;">
				<?php
				if(!$this->tank_auth->is_logged_in()){?>
					<a href="<?=base_url()?>auth/register"><?=image_asset('icon-login.jpg')?><span>BLI MEDLEM </span></a>
				<?php
				}else{?>
					<a href="<?=base_url()?>auth/logout"><span>LOGGA UT</span></a>
				<?php
				}?>	
			</li>
			
		</ul>
	</div><!--top_wishlist-->
	<div class="clear"></div><!--clear-->
	<div class="search">
            <?php
                $query_arr =  parse_querystring();
            ?>
            
            <form method="get" id="city_form" name="city_form" action="<?=base_url()?>product/searchresult">
		<div class="search_bg">                    
			<input type="text" name="pro_name" id="pro_name" value="<?php if(isset($query_arr['pro_name']) AND $query_arr['pro_name']!='') echo $query_arr['pro_name']?>" placeholder="SÖK..." />
			<div class="dropdown_search">
                                <div class="search_loc" id="retailer_filter">
                                    <select id="retailer_id" name="retailer_id">
                                        <option value="">BUTIK</option>
                                        <?php
                                        $retailers = get_stores();//get_retailers();                                        
                                        foreach( $retailers as $retailer )
                                        { 
                                           if($retailer['store_name']!='')
                                           {
                                           echo $retailer['store_name'];
                                        ?>
                                            <option <?=(isset($query_arr['retailer_id']) && ($query_arr['retailer_id']==$retailer['store_name']))?'selected="selected"':'';?> value="<?=$retailer['store_name'];?>"><?=$retailer['store_name'];?></option>
                                        <?php
                                        }
                                        }
                                        ?>
                                    </select>
				</div><!--search_loc-->
				<div class="search_loc" id="location_filter" style="display:none">
                                    <select id="location_id" name="location_id">
                                        <option value="">STAD</option>
                                        <?php
                                        $locations = get_locations_having_products();
                                        foreach( $locations as $location )
                                        { ?>
                                        <option <?=(isset($query_arr['location_id']) && ($query_arr['location_id']==$location['city_id']))?'selected="selected"':'';?> value="<?=$location['city_id'];?>"><?=$location['city_name'];?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
				</div><!--search_loc-->
			</div><!--dropdown_search-->
		</div><!--search_bg-->
		<div class="search_btn">
                    <input type="image" src="<?=base_url('assets/images/search_btn.jpg');?>" />
			 
		</div><!--search_btn-->
                </form>
	</div><!--search-->
</div><!--header_right-->
<div class="clear"></div><!--clear-->
<nav>
	<div class="nav">
		<ul>
                    <?php
                    $categories = get_parent_categories();
                    $i = 0;
                    foreach($categories as $cat){
                    ?>
                    <li <?=($i==0)?'style="border-left: 2px solid #fff;"':'';?>>
                            <?php $cat_id = $cat['cat_id']; ?>
                            <a href="<?=base_url('category/?cat_id='.$cat_id.'&per_page=');?>" class="cat" rel="<?=$cat['cat_id']?>"><?=$cat['cat_title']?></a>
                            <ul class="dropdown">
                            <?php
                            $child_cats = get_child_categories($cat['cat_id']);
                            if($child_cats){
                            	 
                                foreach($child_cats as $child_cat)
                                {
                                		$cat_id = $child_cat['cat_id'];
                                ?>
                                    <li>
                                        <a href="<?=base_url('category?cat_id='.$cat_id.'&per_page=');?>"><?=$child_cat['cat_title'];?></a>
                                    </li>
                                <?php 
                                }
                                
                            } ?>
                            </ul>
                            
			</li>
                    <?php
                    $i++;
                    }
                    ?>
		</ul>
		<div class="clear"></div>
		
		<div class="clear"></div>
	</div><!--nav-->
</nav>