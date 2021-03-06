<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<?php $this->load->view('responsive/head.php'); ?>
	<?=css_asset("datatables.css","admin")?>
	<?=js_asset("jquery.dataTables.min.js","admin")?>
	<body>
		<div class="wrapper">
			<div class="container">
				<header>
					<div class="header">
						<?php $this->load->view('responsive/header.php')?>
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
							<h1>View Invoice</h1>
							<hr />
							<br />
							<form action="" method="post">
								<table cellpadding="0" cellspacing="0" width="100%" class="datatable" id="quiz_data">
									<thead>
										<tr>
											<th>Invoice ID</th>
											<th>Name</th>
											<th>Description</th>
											<th>Amount</th>
											<th>Due Date</th>
											<th>Status</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
                                                                            <?php
                                                                            if(isset($invoices) && $invoices){
                                                                                foreach($invoices as $invoice){
                                                                                ?>
                                                                                    <tr style="text-align:center;">
                                                                                            <td style="border-bottom: 1px solid #EEEEEE;"><?=$invoice['suid']?></td>
                                                                                            <td style="border-bottom: 1px solid #EEEEEE;"><?=$invoice['name']?></td>
                                                                                            <td style="border-bottom: 1px solid #EEEEEE;"><?=$invoice['description']?></td>
                                                                                            <td style="border-bottom: 1px solid #EEEEEE;"><?=$invoice['totalprice']?></td>
                                                                                            <td style="border-bottom: 1px solid #EEEEEE;"><?=$invoice['due_date']?></td>
                                                                                            <td style="border-bottom: 1px solid #EEEEEE;"><?=$invoice['status']?></td>
                                                                                            <td style="border-bottom: 1px solid #EEEEEE;" class="delete">
                                                                                                <a href="<?=base_url()?>user/downloadinvoice/<?=$invoice['suid'];?>" class="editcategories">Download PDF</a>  
                                                                                            </td>
                                                                                    </tr>
                                                                                <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                            
									</tbody>
								</table>
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
					$('#quiz_data').dataTable({
						"iDisplayLength" : 25,
						"aoColumns" : [{
							"asSorting" : ["asc"]
						}, null, null, null, {
							"asSorting" : false
						}]
					});
					$('.deleteproduct').live('click', function() {
						var pid = $(this).attr('rel');
						var x = window.confirm("WARNING: This will permanently remove the selected product(s). Are you sure you wish to do this?");
						if(x) {
							window.location = '<?=base_url()?>user/delete_product/' + pid;
						}
						return false;
					});
				});

			</script>
	</body>
</html>