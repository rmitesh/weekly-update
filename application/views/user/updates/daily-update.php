<div class="container mt-2">
	<?php $this->load->view('user/includes/alerts'); ?>
	<div class="row justify-content-between">
		<div class="col-12">
			<div class="alert alert-info stay" role="alert">
			  	<strong>After saving ...</strong> You can copy your update mail in propery format. &#128516; &#128640;
			</div>
		</div>
		<div class="col-sm-5">
			<form method="post" id="daily-updates-form" class="daily-updates-form">
				<fieldset>
	        		<!-- <legend>Update for <?php // echo date('dS F Y') ?></legend> -->

				    <div class="form-group stud_detail">
				        <label for="client_name">Client Name : </label>
				        <input type="text" class="form-control" name="client_name" id="client_name" placeholder="Enter Client Name" onkeyup="setClientName(this);" value="<?php echo $project['client_name'] ?>" required />
				    </div>
				    <div class="form-group stud_detail">
				        <label for="project_name">Project Name : </label>
				        <input type="text" class="form-control" name="project_name" id="project_name" placeholder="Enter Project Name" onkeyup="setProjectName(this);" value="<?php echo $project['name'] ?>" required />
				    </div>
				    <div class="form-group stud_detail">
				        <label for="txt_done_task" class="task_label">List of Completed Tasks : </label>
				        <div class="element-block">
				            <div class="">
				                <input type="text" placeholder="Done Task" name="list_done[]" id="txt_done_task" class="form-control custom-input task_detail done_task" value="" required />
				                <i class="fa fa-plus-circle font-20 components mt-2"></i>
				            </div>
				            <div class="clearfix"></div>
				        </div>
				    </div>
				    <div class="form-group stud_detail">
				        <label for="txt_progress_task" class="task_label">List of In-Progress Tasks : </label>
				        <div class="element-block">
				            <div class="">
				                <input type="text" placeholder="In-Progress Task" name="list_progress[]" id="txt_progress_task" class="form-control custom-input task_detail progress_task" value="" required />
				                <i class="fa fa-plus-circle font-20 components mt-2"></i>
				            </div>
				            <div class="clearfix"></div>
				        </div>
				    </div>
				    <div class="form-group stud_detail">
				        <label for="txt_remaining_task" class="task_label">List of Remaining Tasks : </label>
				        <div class="element-block">
				            <div class="">
				                <input type="text" placeholder="Remaining Task" name="list_remaining[]" id="txt_remaining_task" class="form-control custom-input task_detail remaining_task" value="" required />
				                <i class="fa fa-plus-circle font-20 components mt-2"></i>
				            </div>
				            <div class="clearfix"></div>
				        </div>
				    </div>
				    <div class="form-group stud_detail">
				        <label for="txt_query" class="task_label">Queries : </label>
				        <div class="element-block">
				            <div class="">
				                <input type="text" placeholder="Query" name="list_query[]" id="txt_query" class="form-control custom-input task_detail query_task" value="" required />
				                <i class="fa fa-plus-circle font-20 components mt-2"></i>
				            </div>
				            <div class="clearfix"></div>
				        </div>
				    </div>
				    <div class="form-group stud_detail">
				        <label for="txt_note" class="task_label">Notes : </label>
				        <div class="element-block">
				            <div class="">
				                <input type="text" placeholder="Note" name="list_note[]" id="txt_note" class="form-control custom-input task_detail note_task" value="" required />
				                <i class="fa fa-plus-circle font-20 components mt-2"></i>
				            </div>
				            <div class="clearfix"></div>
				        </div>
				    </div>
				    <div class="form-group stud_detail">
				        <label for="tl_name">TL Name : </label>
				        <input type="text" value="<?php echo $project['tl_name'] ?>" class="form-control" id="tl_name" name="tl_name" placeholder="TL Name" onkeyup="SetTlName(this);" required />
				    </div>
				    <div class="form-group">
					    <button type="submit" class="btn btn-outline-success copy-and-save">Save</button>
					    <a href="<?php echo base_url('updates'); ?>" class="btn btn-link text-info">Back</a>
					</div>
			   	</fieldset>

		   	</form>
		</div>
		<div class="col-sm-7">
	        <span class="subject"></span>
	        <div class="mail_body">
	            <span class="client_name"></span>
	            <span class="update_msg"></span>
	            <span class="list_done"></span>
	            <span class="list_progress"></span>
	            <span class="list_remaining"></span>
	            <span class="list_query"></span>
	            <span class="list_note"></span>
	            <span class="review_note"></span>
	            <span class="thanks"></span>
	            <span class="total_worked"></span>
	        </div>
	    </div>
	</div>
</div>

<div class="hide clone-master" id="clone-master">
	<!-- Task Status Options -->
	<div class="col-md-12 task-status-option-wrapper">
		<div class="form-group d-inline-flex">
		    <div class="custom-control custom-radio">
		        <input type="radio" required id="completed" value="completed" name="task_status[CNT]" class="custom-control-input task-status-option">
		        <label class="custom-control-label pr-2" for="completed">Completed</label>
		    </div>
		    <div class="custom-control custom-radio">
		        <input type="radio" required id="in_progress" value="in-progress" name="task_status[CNT]" class="custom-control-input task-status-option">
		        <label class="custom-control-label pr-2" for="in_progress">In-Progress</label>
		    </div>
		    <div class="custom-control custom-radio">
		        <input type="radio" required id="note" value="note" name="task_status[CNT]" class="custom-control-input task-status-option">
		        <label class="custom-control-label pr-2" for="note">Note</label>
		    </div>
		    <div class="custom-control custom-radio">
		        <input type="radio" required id="query" value="query" name="task_status[CNT]" class="custom-control-input task-status-option">
		        <label class="custom-control-label pr-2" for="query">Query</label>
		    </div>
		</div>
	</div>
</div>