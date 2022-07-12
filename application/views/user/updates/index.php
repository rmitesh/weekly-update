<div class="container mt-2">
	<div class="d-flex justify-content-between">
		<h5>Your project updates</h5>
		<a href="<?php echo base_url('select-project') ?>" class="btn btn-link text-info">Write New Update</a>
	</div>
	<hr class="mt-1">
	<?php $this->load->view('user/includes/alerts'); ?>
	<div class="row justify-content-between">
		<div class="col-sm-12">
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Tracker id</th>
							<th>Project Name</th>
							<th>Client Name</th>
							<th>Mail Date</th>
							<th>Created At</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php if ( !empty( $projects ) ) { ?>
							<?php foreach ( $projects as $project ) { ?>
								<tr>
									<td> <?php echo $project['tracker_id'] . ' (' . ucwords($project['tracker_name']) . ')' ?> </td>
									<td><?php echo $project['name'] ?></td>
									<td><?php echo $project['client_name'] ?></td>
									<td><?php echo date('dS F Y', strtotime($project['mail_date'])) ?></td>
									<td><?php echo date('dS F Y', strtotime($project['task_updated_at'])) ?></td>
									<td>
										<div class="dropdown">
										  	<a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</a>
										  	<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
										    	<a href="<?php echo base_url('updates/view/'. $project['tracker_id'] . '/'.$project['task_id']) ?>" class="dropdown-item">View</a>
												<a href="<?php echo base_url('updates/delete/'. $project['tracker_id'] . '/'.$project['task_id']) ?>" data-id="<?php echo $project['task_id']; ?>" data-tracker-id="<?php echo $project['tracker_id']; ?>" class="dropdown-item">Delete</a>
										  	</div>
										</div>
									</td>
								</tr>
							<?php } ?>
						<?php } else { ?>
							<tr>
								<td colspan="6" class="text-center">No Updates</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
