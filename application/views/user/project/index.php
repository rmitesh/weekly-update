<div class="container">

	<div class="d-flex justify-content-between">
		<h5>Your Projects</h5>
		<a href="<?php echo base_url('project/new') ?>" class="btn btn-link text-info">Add New Project</a>
	</div>
	<hr class="mt-1">
	<?php $this->load->view('user/includes/alerts'); ?>
	<div class="row justify-content-between">
		<div class="col-sm-12">
			<div class="text-right">
			</div>
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Tracker id</th>
							<th>Project Name</th>
							<th>Client Name</th>
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
									<td><?php echo date('dS F Y', strtotime($project['created_at'])) ?></td>
									<td>
										<div class="dropdown">
										  	<a class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</a>
										  	<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										    	<a href="<?php echo base_url( 'updates/new/' . $project['tracker_id'] ) ?>" class="dropdown-item">Write Update</a>
										    	<a href="<?php echo base_url( 'project/' . $project['tracker_id'] . '/edit' ) ?>" class="dropdown-item">Edit</a>
												<a href="javascript: void(0)" class="dropdown-item">Delete</a>
										 	</div>
										</div>
									</td>
								</tr>
							<?php } ?>
						<?php } else { ?>
							<tr><td colspan="5" class="text-center">No project found</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
