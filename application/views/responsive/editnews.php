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
					<div style="min-height:500px">
						<h1>News Board</h1>
						<hr />
						<br />
						<h3>Edit News</h3>
						<form action="" method="post">
							<p>
								<textarea name="news_text"><?=$edit_data['news_text']?></textarea>
							</p>
							<p style="margin-top:10px">
								<input type="submit" name="add" value="Add News" />
							</p>
						</form>
					</div>
					<div class="clear"></div>
					<!--footer-->
					<?php $this->load->view('responsive/footer.php')?>
				</div><!--container-->
			</div><!--wrapper-->
	</body>
</html>