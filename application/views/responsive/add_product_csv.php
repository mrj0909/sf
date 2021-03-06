<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<?php $this->load->view('responsive/head.php'); ?>
	<?=js_asset("jquery.filestyle.mini.js","admin")?>
	<?=js_asset("ajaxupload.js","admin")?>
	<?=js_asset('jquery.tmpl.min.js')?>
	<?=js_asset('jquery.uploadify.js')?>
	<?=js_asset("jquery.wysiwyg.js","admin")?>
	<?=js_asset("tiny_mce/tiny_mce.js","admin")?>
        <?=js_asset("products.js","admin")?>
	<script type="text/javascript">
	tinyMCE.init({
		theme : "advanced",
        mode : "textareas",
        plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
		skin : "o2k7",
		skin_variant : "silver",
        // Theme options
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : false
	});
	</script>
	<body>
		<div class="wrapper">
			<div class="container">
				<header>
					<div class="header">
						<?php $this->load->view('responsive/head.php')?>
					</div><!--header-->
				</header>
				<div class="clear"></div><!--clear-->
				<div class="main_body">
					<div class="float_left">
						<?php $this->load->view('responsive/reg_left_bar.php')?>	
					</div>
					<div class="float_right" style="margin-left: 10px;">
						<p align="center">&nbsp;
							
						</p>
						<div style="min-height:500px">
							<h1>Add Products by CVS</h1>
							<hr />
							<br />
                            <p><strong><?php echo $msg?></strong></p>
							<form method="post" id="form1" name="form1" action="" enctype="multipart/form-data">
                                <p>
                                    <label>Upload CSV File:</label>
                                    <input type="file" name="csv_file"/><br><br><br>
                                </p>
                                <p>
                                    <input type="submit" value="Add Product CVS" id="add" class="submit small" name="add">
                                </p>
							</form>
						</div>
					</div>
					<div class="clear"></div>
					<!--footer-->
					<?php $this->load->view('responsive/footer.php')?>
				</div><!--container-->
			</div><!--wrapper-->
			<script type="text/javascript">
				$(document).ready(function() {
					$('.buy_link_type').click(function(){
						if($(this).val() == 1){
							$('#city_id').removeClass('validate[required]');
							$('#citydiv').hide();
						}
						else{
							$('#city_id').addClass('validate[required]');
							$('#citydiv').show();
						}
					});
					$("#form1").validationEngine();
					// Date picker
					$('input.date_picker').datepicker();
					// File upload
					if ($('#fileupload').length) {
						new AjaxUpload('fileupload', {
							action: '<?=base_url()?>user/add_pro_image/',
							autoSubmit: true,
							name: 'userfile',
							responseType: 'json',
							onSubmit : function(file , ext) {
								$('.fileupload #uploadmsg').addClass('loading').text('Uploading...');
								this.disable();
							},
							onComplete : function(file, response) {
								if(response == 'error'){
									$('.fileupload #uploadmsg').removeClass('loading').text("Error occured in uploading! Try Again.");
									this.enable();
								}
								else{
									$('#proimage').attr('src',response.imagename);
									$('#product_image').val(response.name);
									$('#product_ext').val(response.ext);
									$('.fileupload #uploadmsg').removeClass('loading').text("Uploaded Successfully");
									this.enable();
								}
							}
						});
					}
				// more images
				var proimgs = new Array();
				var proimgsext = new Array();
				$("#more_upload").uploadify({
					buttonImage   : '<?=image_asset_url("choose_file.jpg")?>',
					height        : 33,
					swf           : '<?=other_asset_url('uploadify.swf','','js')?>',
					uploader      : '<?php echo base_url();?>user/add_pro_image',
					post_params	  : {"browser_cookie": "<?= trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->config->item('encryption_key'), $_COOKIE[$this->config->item('sess_cookie_name')], MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)))); ?>"},
					width         : 108,
					fileObjName   : 'userfile',
					queueID  	  : 'some_file_queue',
					fileTypeDesc  : 'Image Files',
					fileTypeExts  : '*.jpg; *.png',
					'onUploadSuccess' : function(file, data, response) {
						var myobj = JSON.parse(data);
						//alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
						proimgs.push(myobj.name);
						proimgsext.push(myobj.ext);
						$('#product_moreimages').val(proimgs.join(','));
						$('#product_moreimagesext').val(proimgsext.join(','));
						$('.uploadedimages').append('<li><img src="<?=other_asset_url("'+myobj.name+'_s.'+myobj.ext+'","","uploads/images/products")?>" width="32" height="32" alt="image" />'+
						'<div class="clr"></div><a href="#" class="delproductimg" rel="'+myobj.name+'_'+myobj.ext+'">Delete</a> </li>');
					},
					'onUploadError' : function(file, errorCode, errorMsg, errorString) {
						alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
					}
				});
				$('.delproductimg').live('click',function(){
					var timg = $(this).attr('rel');
					$.post('<?php echo base_url();?>user/unlink_promoreimage',{img:timg},function(data){});
					$(this).parent().remove();
					return false;
				});
			} );
			function change_cat(cat_id){
				$('#sub_cat_div').show();
				$('#sub_cat').html('Loading...');
				$.post('<?=base_url()?>user/change_cat',{cat_id:cat_id},function(response){
					if(response != '')
						$('#sub_cat').html(response);
					else
						$('#sub_cat_div').hide();	
				});
			}
		</script>
	</body>
</html>