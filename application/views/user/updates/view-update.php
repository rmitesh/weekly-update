<div class="container mt-2">
	<div class="d-flex justify-content-between">
		<h5>View your updates</h5>
		<div class="">
			<a href="<?php echo base_url('updates') ?>" class="btn btn-link">Back</a>
			<a href="<?php echo base_url('select-project') ?>" class="btn btn-link text-info">Write New Update</a>
		</div>
	</div>
	<hr class="mt-1">
	<?php
		$subject = 'updates for ' . $project['name'] . ' as on ' . date('dS F, Y', strtotime($task['mail_date']));
		$completed_tasks = '';
		$in_progress_tasks = '';
		$remaining_tasks = '';
		$queries_tasks = '';
		$notes_tasks = '';
		
		$completed_cnt = 1;
		$in_progress_cnt = 1;
		$remaining_cnt = 1;
		$queries_cnt = 1;
		$notes_cnt = 1;

		foreach ( $task_details as $tasks ) {
			if ( $tasks['status'] === 'completed' ) {
				$completed_tasks .= '<span>'. $completed_cnt . '. ' .  $tasks['task'] . '</span><br />';
				$completed_cnt++;
			} elseif ( $tasks['status'] === 'in-progress' ) {
				$in_progress_tasks .= '<span>'. $in_progress_cnt . '. ' .  $tasks['task'] . '</span><br />' ;
				$in_progress_cnt++;
			} elseif ( $tasks['status'] === 'remaining' ) {
				$remaining_tasks .= '<span>'. $remaining_cnt . '. ' .  $tasks['task'] . '</span><br />' ;
				$remaining_cnt++;
			} elseif ( $tasks['status'] === 'query' ) {
				$queries_tasks .= '<span>'. $queries_cnt . '. ' .  $tasks['task'] . '</span><br />' ;
				$queries_cnt++;
			} elseif ( $tasks['status'] === 'note' ) {
				$notes_tasks .= '<span>'. $notes_cnt . '. ' .  $tasks['task'] . '</span><br />' ;
				$notes_cnt++;
			}
		}
	?>
	<div class="row justify-content-between">
		<div class="col-12">
			<a href="mailto:joe@example.com?subject=<?php echo $subject; ?>" id="generate-mail" class="btn btn-outline-dark d-none">Generate Mail</a>
			<a href="javascript: void(0);" class="btn btn-outline-dark" id="copy-mail">Copy Mail</a>
			<hr />
		</div>

		<div class="col-md-12" id="mail_body">
			<span>Hi <?php echo $project['client_name'] ?>,</span>
			<br><br>
			<span>Following weekly <?php echo $subject ?>:</span>
			<br><br>

			<?php if ( $completed_tasks ) { ?>
				<span><strong><u>List of Completed Tasks:</u></strong></span>
				<br>
				<?php echo ( $completed_tasks !== '' ) ? $completed_tasks : '-' ?>
				<br>
			<?php } ?>

			<?php if ( $in_progress_tasks ) { ?>
				<span><strong><u>List of In-Progress Tasks:</u></strong></span>
				<br>
				<?php echo ( $in_progress_tasks !== '' ) ? $in_progress_tasks : '- <br>' ?>
				<br>
			<?php } ?>

			<?php if ( $remaining_tasks ) { ?>
				<span><strong><u>List of Remaining Tasks:</u></strong></span>
				<br>
				<?php echo ( $remaining_tasks !== '' ) ? $remaining_tasks : '- <br>' ?>
				<br>
			<?php } ?>
			
			<?php if ( $queries_tasks ) { ?>
				<span><strong><u>Queries:</u></strong></span>
				<br>
				<?php echo ( $queries_tasks !== '' ) ? $queries_tasks : '- <br>' ?>
				<br>
			<?php } ?>

			<?php if ( $notes_tasks ) { ?>
				<span><strong><u>Notes:</u></strong></span>
				<br>
				<?php echo ( $notes_tasks !== '' ) ? $notes_tasks : '- <br>' ?>
				<br>
			<?php } ?>

			<span>Please check with the latest updates and let us know your thoughts for the same.</span>
			<br><br>

			<span>Kind Regards,</span>
			<br>
			<?php echo ( $task['tl_name'] !== '' ) ? $task['tl_name'] : '-' ?>
			<br>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		// let mail_body = $('#mail_body').text();
		// mail_body = mail_body.replace(/\n/g, '<br>')
		// let href = $('#generate-mail').attr('href');
		// $('#generate-mail').attr('href', `${href}&body=${mail_body}`);
	});

	$(document).on('click', '#copy-mail', function(event) {
		event.preventDefault();

		$(this).addClass('disabled').html('Copied');
		copy( $('#mail_body') );
		setTimeout(() => {
			$(this).removeClass('disabled').html('Copy Mail');
		}, 4000)
	});
</script>