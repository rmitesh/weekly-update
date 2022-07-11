<div class="container mt-2">
	<div class="row justify-content-between">
		<div class="col-sm-7">
			<h3>Your weekly update mail for <?php echo $project['name'] ?></h3>
			<hr>
			<div class="copy-wrapper">
				<?php
					$project_name = $project['name'];
					$client_name = $project['client_name'];

					$completed_tasks = '';
					$in_progress_tasks = '';
					$completed_cnt = 1;
					$in_progress_cnt = 1;
					foreach ( $tasks as $task ) {
						if ( $task['status'] === 'completed' ) {
							$completed_tasks .= '<span>'. $completed_cnt . '. ' .  $task['task'] . '</span><br />';
							$completed_cnt++;
						} elseif ( $task['status'] === 'in-progress' ) {
							$in_progress_tasks .= '<span>'. $in_progress_cnt . '. ' .  $task['task'] . '</span><br />' ;
							$in_progress_cnt++;
						}
					}

					$view = $this->load->view('user/updates/weekly-mail-layout', NULL, TRUE);
					$placeholder = [
						'{CLIENT_NAME}',
						'{PROJECT_NAME}',
						'{DATE}',
						'{COMPLETED_TASKS}',
						'{IN_PROGRESS_TASKS}',
					];

					$replace_value = [
						$client_name,
						$project_name,
						date('dS F, Y', strtotime('this saturday')),
						$completed_tasks,
						$in_progress_tasks,
					];
					$view = str_replace($placeholder, $replace_value, $view);
					echo $view;
				?>
			</div>
			<hr>
			<div class="form-group">
				<button type="button" class="btn btn-outline-info" onclick="copy($('.copy-wrapper'))">Copy</button>
			</div>
		</div>
	</div>
</div>