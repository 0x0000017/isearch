<div class ="container">
	<div class ="row">
		<?php
                $conn = mysqli_connect("localhost", "root", "", "isearch_db");
                $sql = mysqli_query($conn, "SELECT * from worker_tbl");

                while($rw = mysqli_fetch_array($sql))
				{
					$_SESSION['worker_name'] = $rw['worker_name'];
                    $id = $rw['worker_id'];
					$wname = $rw['worker_name'];
					$wrating = $rw['worker_rating'];
					$wdesc = $rw['worker_desc'];
					$wpic = $rw['worker_pic']
					echo '
                    <div class="col-md-3 col-sm-6 my-3 my-md-0">
						<form action="http://localhost/iSearch/isearch/api/worker/ReadWorkers.php" method="GET">
							<div class="card shadow">
								<img src="assets/pfp.png" alt="Image1" class="img-thumbnail" height =200 width = 200></a>
								<div class="card-body">
									<a href="http://localhost/iSearch/isearch/api/worker/ReadSingleWorker.php?worker_id=',$id,'"><h6 class="card-title">',$wname,'</h6>
									<h6>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
									<h6>			
								<input type="hidden" name="product_id" value="',$id,'">
								</div>
							</div>
						</form>
					</div>';
					}
		?>
	</div>
</div>