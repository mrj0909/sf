<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

	<meta http-equiv="X-UA-Compatible" content="IE=7" />

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<title><?=$this->config->item('title');?> Categories</title>
	<?=css_asset("style.css","admin")?>
	<?=css_asset("jquery.wysiwyg.css","admin")?>
	<?=css_asset("facebox.css","admin")?>
	<?=css_asset("visualize.css","admin")?>
	<?=css_asset("date_input.css","admin")?>
	<?=css_asset("datatables.css","admin")?>
    
	<?=js_asset("jquery.js","admin")."\n";?>
	
	<?=js_asset("facebox.js","admin");?>
	<?=js_asset("jquery.validate.min.js","admin")?>
	<?=js_asset("jquery.dataTables.min.js","admin")?>
	<?=js_asset("jquery.filestyle.mini.js","admin")?>
	<?=js_asset("jquery.wysiwyg.js","admin")?>
	<?=js_asset("jquery.visualize.js","admin")?>
	<?=js_asset("jquery.select_skin.js","admin")."\n";?>
	<?=js_asset("jquery.date_input.pack.js","admin")."\n";?>
	<?=js_asset("tiny_mce/tiny_mce.js","admin")?>
	<?=js_asset("ajaxupload.js","admin")?>	
		
	<?=js_asset("custom.js","admin")?>			
	<!--[if lt IE 8]><?=css_asset("ie.css","admin")?><![endif]-->

</head>
<body>
	
	<div id="hld">
	
		<div class="wrapper">		<!-- wrapper begins -->

			<? include("header.html");?>
			
			
			<div class="block">
			
				<div class="block_head">
					<div class="bheadl"></div>
					<div class="bheadr"></div>
					<h2>Invoice</h2>
					<ul>
                                            <li><a href="<?=base_url()?>admin/banner">View Invoices</a></li>
                                        </ul>
				</div>		<!-- .block_head ends -->
				<div id="addcats" class="block_content tab_content" style="display: none;">
			        <form method="post" enctype="multipart/form-data" id="form1" name="form1" action="">			          
			          <p>
			            <label>Subscription Name*: </label>
			            <br/>
                                    <select name="subscription_id">
                                        <?php echo get_subscription_levels($edit_data['subscription_id']); ?>
                                    </select>
			            <span class="note error"></span> </p>
			          <p>
			          <label>Amount*: </label>
			            <br/>
                                        <input type="text" id="amount" readonly class="required text small" name="totalprice" value="<?=$edit_data['totalprice']?>" />
			            <span class="note error"></span> </p>			            
                                  <p>
			            <label>Due Date: </label>
			            <br />
                                    <input type="text" class="text date_picker" name="due_date" />
			            <span class="note error"></span> </p>
			          <p>  
			          <label>Status*: </label>
			            <br>
                                        <input type="text" id="status" class="required text small" name="status" value="<?=$edit_data['status']?>">
			            <span class="note error"></span> </p>
			          <p>  
			          <label>Active*: </label>
			            <br>
                                    <select name="is_active">
                                            <option value="1" <?=$edit_data['is_active']?'selected="selected"':'';?>> Active </option>
                                            <option value="0" <?=$edit_data['is_active']?'':'selected="selected"';?> > In-active </option>
                                        </select>
			            <span class="note error"></span> </p>
                                    
			          <p>
			            <input type="submit" value="Submit" id="add" class="submit small" name="add">
			          </p>
			        </form>
			    </div>
				<div class="bendl"></div>
				<div class="bendr"></div>
			</div>		
		
			<? include("footer.html");?>
		
		
		</div>						<!-- wrapper ends -->
		
	</div>		<!-- #hld ends -->
	
	
	
	
	<script type="text/javascript">
		$(document).ready(function() {
			
		    $('#quiz_data').dataTable();
		    $('a[rel*=facebox]').facebox();
		    $("form select.styled").select_skin();
		    $("input[type=file]").filestyle({ 
			    image: "<?=image_asset_url('upload.gif','admin')?>",
			    imageheight : 30,
			    imagewidth : 80,
			    width : 250
			});
			// File upload
			if ($('#fileupload').length) {
				new AjaxUpload('fileupload', {
					action: '<?=base_url()?>admin/add_ban_image/',
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
								$('#banimage').attr('src',response.imagename);
								$('#image_name').val(response.name);
								$('#image_ext').val(response.ext);
								$('.fileupload #uploadmsg').removeClass('loading').text("Uploaded Successfully");
								this.enable();
							}
						}	
				});
			}
		    $("#form1").validate({
		           errorPlacement: function(error, element) {
		           error.appendTo(element.next('span'));
				}
		    });
		    $('.deletebanner').live('click',function(){
				var cid = $(this).attr('rel');
				var x = window.confirm("WARNING: This will permanently remove the selected banner(s). Are you sure you wish to do this?");
				if(x){window.location = '<?=base_url()?>admin/delete_banner/'+cid;}
				return false;
			});	
		} );
	
		
	</script>

	
</body>
</html>