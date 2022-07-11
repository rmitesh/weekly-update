<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UpdateController extends Frontend_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model([
			'Project_model' => 'project',
			'Task_model' => 'task',
			'Task_detail_model' => 'task_detail',
			'Link_model' => 'link',
		]);
	}

	public function index()
	{
		$this->set_page_title('List your project');
		$projects = $this->task->get_all_projects_with_task();
		$this->data['projects'] = $projects;
		$this->template->load( 'index', 'content', 'user/updates/index', $this->data );
	}


	public function select_project()
	{
		$this->set_page_title('Select Project');
		
		$this->db->order_by('created_at', 'desc');
		$projects = $this->project->get_many_by( [ 'user_id' => get_loggedin_user_id(), 'is_deleted' => 0 ] );
		$this->data['projects'] = $projects;
		
		if ( $this->input->post() ) {
			$update_type = $this->input->post('update_type', TRUE);
			$tracker_id = $this->input->post('select_project', TRUE);
			if ( $update_type === 'weekly_update' ) {
				redirect('weekly/' . $tracker_id );
			} else {
				redirect('updates/new/' . $tracker_id );
			}
		}

		$this->template->load( 'index', 'content', 'user/updates/select-project', $this->data );
	}

	public function new_update( $tracker_id )
	{
		$project = $this->project->get_by( ['tracker_id' => $tracker_id, 'is_deleted' => 0] );
		$task = $this->task->get_by( ['project_id' => $project['id'], 'mail_date LIKE' => '%' . date('Y-m-d') . '%'] );
		if ( !empty( $task ) ) {
			$project_name = $project['name'];
			$this->session->set_flashdata('error', "You have already written today's update mail for $tracker_id - $project_name .");
			redirect('select-project');
			exit();
		}
		$this->set_page_title('Write New Updates');

		if ( $this->input->post() ) {
			$client_name = $this->input->post('client_name', TRUE);
			$project_name = $this->input->post('project_name', TRUE);
			$your_name = $this->input->post('your_name', TRUE);
			$list_done = $this->input->post('list_done', TRUE);
			$list_progress = $this->input->post('list_progress', TRUE);
			$list_remaining = $this->input->post('list_remaining', TRUE);
			$list_query = $this->input->post('list_query', TRUE);
			$list_note = $this->input->post('list_note', TRUE);
			$tl_name = $this->input->post('tl_name', TRUE);

			if ( !empty( $project ) ) {
				$task_insert = array(
					'project_id' => $project['id'],
					'tl_name' => $tl_name,
					'mail_date' => date('Y-m-d h:i:s'),
				);
				$task_id = $this->task->insert( $task_insert );
				/* completed */
				if ( !empty( $list_done[0] ) ) {
					$this->add_task_details( $list_done, 'completed', $task_id );
				}

				/* in_progress */
				if ( !empty( $list_progress[0] ) ) {
					$this->add_task_details( $list_progress, 'in-progress', $task_id );
				}

				/* remaining */
				if ( !empty( $list_remaining[0] ) ) {
					$this->add_task_details( $list_remaining, 'remaining', $task_id );
				}

				/* remaining */
				if ( !empty( $list_query[0] ) ) {
					$this->add_task_details( $list_query, 'query', $task_id );
				}

				/* note */
				if ( !empty( $list_note[0] ) ) {
					$this->add_task_details( $list_note, 'note', $task_id );
				}
				
				$this->session->set_flashdata('success', 'Saved! Update mail has been added.');
				base_url("updates/view/$tracker_id/$task_id");
			}
		}

		$this->data['footer_js'] = array(
			'assets/js/validation/validate.min.js',
			'assets/js/custom/daily-updates.js',
		);

		$this->data['project'] = $project;

		$this->template->load( 'index', 'content', 'user/updates/daily-update', $this->data );
	}

	public function weekly_update( $tracker_id )
	{
		$project = $this->project->get_by([ 'tracker_id' => $tracker_id, 'is_deleted' => 0 ]);
		if ( !empty( $project ) ) {
			$tasks = $this->task->get_weekly_update( $tracker_id );
			
			$this->set_page_title('Weekly Update');
			$this->data['project'] = $project;
			$this->data['tasks'] = $tasks;
			// pr($this->data); die;

			$this->template->load( 'index', 'content', 'user/updates/weekly-update', $this->data );
		} else {
			$this->session->set_flashdata('error', 'Project details not found');
			redirect('select-project');
		}
	}

	public function view_update( $tracker_id, $task_id )
	{
		if ( !empty( $tracker_id ) && !empty( $task_id ) ) {
			$project = $this->project->get_by([ 'tracker_id' => $tracker_id, 'is_deleted' => 0 ]);
			if ( !empty( $project ) ) {
				$task = $this->task->get_by([ 'id' => $task_id, 'project_id' => $project['id'], 'is_deleted' => 0 ]);
				if ( !empty( $task ) ) {
					$this->set_page_title('View Update');

					$task_details = $this->task_detail->get_many_by([ 'task_id' => $task['id'], 'is_deleted' => 0 ]);
					$this->data['project'] = $project;
					$this->data['task'] = $task;
					$this->data['task_details'] = $task_details;

					$this->template->load( 'index', 'content', 'user/updates/view-update', $this->data );
				} else {
					$this->session->set_flashdata('error', 'Task not found on this project');
					redirect('updates');
				}
			} else {
				$this->session->set_flashdata('error', 'Project not found');
				redirect('updates');
			}
		} else {
			$this->session->set_flashdata('error', 'Invalid access');
			redirect('updates');
		}
	}

	public function delete_update( $tracker_id, $task_id ) {
		if ( !empty( $tracker_id ) && !empty( $task_id ) ) {
			$project = $this->project->get_by([ 'tracker_id' => $tracker_id, 'is_deleted' => 0 ]);
			if ( !empty( $project ) ) {
				$task = $this->task->get_by([ 'id' => $task_id, 'project_id' => $project['id'], 'is_deleted' => 0 ]);
				if ( !empty( $task ) ) {

					$task_detail = $this->task_detail->get_many_by([ 'task_id' => $task['id'], 'is_deleted' => 0 ]);
					if ( !empty( $task_detail ) ) {
						$task_detail_id = array_column($task_detail, 'id');
						$this->task_detail->delete_many($task_detail_id);
					}

					$this->task->delete($task['id']);
					$this->session->set_flashdata('success', 'Task has been removed.');
				} else {
					$this->session->set_flashdata('error', 'Task not found on this project');
				}
			} else {
				$this->session->set_flashdata('error', 'Project not found');
			}
		} else {
			$this->session->set_flashdata('error', 'Invalid access');
		}
		redirect('updates');
	}

	private function add_task_details( $tasks, $status, $task_id )
	{
		foreach ( $tasks as $task ) {
			$task_detail_insert = array(
				'task_id' => $task_id,
				'task' => $task,
				'status' => $status,
			);
			$this->task_detail->insert( $task_detail_insert );
		}
	}
}
