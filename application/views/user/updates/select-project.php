<div class="container mt-2">
	<?php $this->load->view('user/includes/alerts'); ?>

	<div class="d-flex justify-content-between">
		<h5>Select project for write updates</h5>
		<div class="">
			<a href="<?php echo base_url('project/new') ?>" class="btn btn-link text-info">Add New Project</a>
		</div>
	</div>
	<hr>
	<div class="row justify-content-between">
		<div class="col-sm-5">
			<form method="post" id="select-project-form" class="select-project-form">
				<fieldset>
				    <div class="form-group">
				        <label for="select_project">Select Project : </label>
			        	<select class="select_project" data-placeholder="Select a Project..." name="select_project" id="select_project" required>
		        			<option value=""></option>
			        		<?php foreach ( $projects as $project ) { ?>
			        			<option value="<?php echo $project['tracker_id'] ?>"><?php echo $project['tracker_id'] . ' - ' . $project['name'] ?></option>
			        		<?php } ?>
			        	</select>
				    </div>
				    <div class="form-group d-flex justify-content-between">
				    	<a href="<?php echo base_url('updates') ?>" class="btn btn-link text-info">Back</a>
				    	<div class="text-right">
				    		<button type="submit" name="update_type" value="daily_update" class="btn btn-outline-success ml-auto">Daily Update!</button>
							<?php if ( is_weekly_update_day() ) { ?>
								<button type="submit" name="update_type" value="weekly_update" class="btn btn-outline-success ml-auto">Weekly Update!</button>
							<?php } ?>
				    	</div>
				    </div>
			   	</fieldset>
		   	</form>
		</div>
	</div>
</div>
