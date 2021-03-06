<?php
$url_segments = explode("/",current_url());

if(in_array("product_detail",$url_segments)){
		$banners_limit =4;

    $product_id = end($url_segments);
    $cat_id = get_catid_by_productid($product_id);
}else{
		$banners_limit =6;
    $cat_id = isset($_GET['cat_id'])?$_GET['cat_id']:0;
}
if($cat_id){
    $cat_info = get_category_recursive_info($cat_id);
	if($cat_info['parents'][0]['parent_id']==0)
	   {
		  $cat_id=$cat_info['subcats'][0]['cat_id'];
		  $cat_info = get_category_recursive_info($cat_id);
	   }
    $parents = array_reverse($cat_info['parents']);
    if($cat_info['level']<=2){
        $cat_heading = $cat_info['category']['cat_title'];
        $categories = ($cat_info['subcats'])?$cat_info['subcats']:array();
    }else{
        $categories = get_subcats($parents[1]['cat_id']);
        $cat_heading = $parents[1]['cat_title'];
    }
}
?>
<div class="catagari">
    <?php
    if($cat_id){
    ?>
    <div class="mans_cata">
            <div style="color: #333333;
    font: 700 10px Tahoma; padding:10px 20px;"> 
                <a href="<?=base_url()?>">> Hem</a>
            <?php
            if ($cat_info['level']>1){
                echo "> ".$parents[0]['cat_title'];
            }
            ?>
            </div>
            <h4><?php echo $cat_heading;?></h4>
            <ul <?=($cat_info['level']>=2)?"class='treeMenu'":"";?>>
                <?php
                foreach($categories as $cat){
                if(isset($parents[2]) && $parents[2]['cat_id']==$cat['cat_id']){
                    $selected = 1;
                }else{
                    $selected = 0;
                }
                $subcats = get_subcats($cat['cat_id']);
                    ?>
                    <li>
                        <span class="<?=($selected || !$subcats)?"opened":"closed";?>"></span>
                        <a class="<?=($cat_id == $cat['cat_id'])?"selected":"";?>" href="<?php echo base_url("category?cat_id=".$cat['cat_id']).'&per_page='; ?>">
                           <?=$cat['cat_title'];?>
                        </a>
                        <?php 
                        if($cat_info['level']>=2){
                            
                            if($selected){
                                $css="display:block;";
                            }else{
                                $css="display:none";
                            }
                            if(isset($subcats) && $subcats){
                        ?>
                        <div style="<?=$css;?>" class="<?=($selected)?"selected":"";?>">
                        <ul>
                                <?php
                                foreach($subcats as $subcat){
                                ?>
                                <li>
                                    <a class="<?=($cat_id == $subcat['cat_id'])?"selected":"";?>" href="<?php echo base_url("category?cat_id=".$subcat['cat_id']).'&per_page='; ?>">
                                        <?=$subcat['cat_title'];?>
                                    </a>
                                </li>
                                <?php
                                }
                                ?>
                        </ul>
                        </div>
                        <?php
                            }
                        }
                        ?>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <?php //$product_category?>
    </div><!--mans_cata-->
    <?php
    }
    ?>
    <?php
    if ((isset($cat_info['level']) && $cat_info['level']>1) || !$cat_id){
        if(isset($cat_info['level']) && $cat_info['level']>1){
            $other_cats = get_subcats($parents[0]['cat_id']);
        }else{
            $other_cats = get_subcats(0);
        }
        foreach($other_cats as $other_cat){
            if(isset($parents[1]['cat_id']) && ($parents[1]['cat_id']==$other_cat['cat_id'])){
                continue;
            }
            $other_subcats = get_subcats($other_cat['cat_id']);
            if(!$other_subcats){
                $other_subcats = array();
            }
            ?>
        <div class="mans_cata">
            <h4><?=$other_cat['cat_title']?></h4>
            <ul class="treeMenu">
                <?php 
                foreach($other_subcats as $other_subcat){
                ?>
                <li>
                    <span class="opened"></span>
                    <a href="<?php echo base_url("category?cat_id=".$other_subcat['cat_id']).'&per_page='; ?>">
                       <?=$other_subcat['cat_title'];?>
                    </a>
                </li>
                <?php
                }
                ?>
                
            </ul>
        </div><!--mans_cata-->
            <?php
        }
        
    }
    ?>
</div>    
    
<div style="margin-top:20px;">
    <?php
    $banners = get_left_random_banners($banners_limit);
    foreach($banners as $banner){
        if($banner['banner_code']==''){?>
        <a target="_blank" <?=(isset($banner['url']) && $banner['url'])?'href="'.$banner['url'].'"':'';?> >
            <img src="<?=base_url('assets/uploads/images/banners/'.$banner['image_name'].'_l.'.$banner['image_ext']);?>" width="250" />
        </a>
        <?php
        }
        else
        {
           echo "<div class='banners'>";
           echo $banner['banner_code'];
           echo "</div>";
        }
    }
    ?>
	
</div><!--float_left-->