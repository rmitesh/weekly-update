<div class="container">
	
	<div class="d-flex justify-content-between">
		<h5>Update Project</h5>
		<a href="<?php echo base_url('project') ?>" class="btn btn-link text-info">Project List</a>
	</div>
	<hr class="mt-0">
	<form method="post" id="select-project-form" class="select-project-form" autocomplete="off">
		<?php $this->load->view('user/includes/alerts'); ?>
		<input type="hidden" name="_id" value="<?php echo $project['id'] ?>" />
		<div class="row justify-content-between">
			<div class="col-md-6">
				<div class="form-group">
					<label for="tracker_id">Project/Tracker ID:</label>
					<input type="text" name="tracker_id" class="form-control tracker_id" id="tracker_id" placeholder="Project/Tracker ID" disabled value="<?php echo $project['tracker_id'] ?>" />
				</div>
				<div class="form-group">
					<label for="client_name">Client Name:</label>
					<input type="text" name="client_name" class="form-control client_name" id="client_name" placeholder="Client Name" value="<?php echo $project['client_name'] ?>" />
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="tracker_name">Tracker Name:</label>
					<?php $tracker_name = $project['tracker_name']; ?>
					<select name="tracker_name" class="form-control tracker_name" id="tracker_name">
						<option value="" selected>Select Tracker</option>
						<option value="freelancer" <?php echo ( $tracker_name == 'freelancer' ) ? 'selected' : ''  ?>>Freelancer</option>
						<option value="upwork" <?php echo ( $tracker_name == 'upwork' ) ? 'selected' : '' ?>>Upwork</option>
						<option value="guru" <?php echo ( $tracker_name == 'guru' ) ? 'guru' : '' ?>>Guru</option>
					</select>
				</div>
				
				<div class="form-group">
					<label for="project_name">Project Name:</label>
					<input type="text" name="project_name" class="form-control project_name" id="project_name" placeholder="Project Name" value="<?php echo $project['name'] ?>" />
				</div>
			</div>
			<div class="col-12 text-right">
				<div class="form-group">
					<button type="submit" class="btn btn-outline-success ml-auto">Update</button>
			    </div>
			</div>
	   	</div>
   	</form>
</div>
