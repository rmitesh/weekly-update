<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ProjectController extends Frontend_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model([
			'Project_model' => 'project',
		]);
	}

	public function index()
	{
		$this->set_page_title('My Projects');

		$projects = $this->project->get_many_by( [ 'user_id' => get_loggedin_user_id(), 'is_deleted' => 0 ] );
		$this->data['projects'] = $projects;

		$this->template->load( 'index', 'content', 'user/project/index', $this->data );
	}

	public function add_new()
	{
		$this->set_page_title('Add New Project');
		if ( $this->input->post() ) {
			$tracker_id = $this->input->post('tracker_id', TRUE);
			$project_name = $this->input->post('project_name', TRUE);
			$client_name = $this->input->post('client_name', TRUE);
			$tracker_name = $this->input->post('tracker_name', TRUE);

			$this->form_validation->set_rules('tracker_id','Tracker Id','trim|required|numeric');
			$this->form_validation->set_rules('project_name','Project Name','trim|required');
			$this->form_validation->set_rules('client_name','Client Name','trim|required');
			$this->form_validation->set_rules('tracker_name','Tracker Name','trim|required');

			if( $this->form_validation->run() == false ) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('project/new');
			}

			$insert_data = array(
				'user_id' => get_loggedin_user_id(),
				'tracker_id' => $tracker_id,
				'tracker_name' => $tracker_name,
				'name' => $project_name,
				'client_name' => $client_name,
			);

			$result = $this->project->insert( $insert_data );
			if ( $result ) {
				$this->session->set_flashdata('success', 'Saved! New project has been added.');
				redirect('select-project');
			}

		}
		$this->template->load( 'index', 'content', 'user/project/add-new', $this->data );
	}

	public function edit( $tracker_id )
	{
		if ( !empty( $tracker_id ) ) {
			$project = $this->project->get_by( [ 'tracker_id' => $tracker_id, 'is_deleted' => 0 ] );
			$this->data['project'] = $project;
			if ( $this->input->post() ) {
				$_id = $this->input->post('_id', TRUE);
				$project_name = $this->input->post('project_name', TRUE);
				$client_name = $this->input->post('client_name', TRUE);
				$tracker_name = $this->input->post('tracker_name', TRUE);

				$this->form_validation->set_rules('project_name','Project Name','trim|required');
				$this->form_validation->set_rules('client_name','Client Name','trim|required');
				$this->form_validation->set_rules('tracker_name','Tracker Name','trim|required');

				if( $this->form_validation->run() == false ) {
					$this->session->set_flashdata('error', validation_errors());
					redirect('project/'. $tracker_id .'/edit');
				}
				$update_data = array(
					'tracker_name' => $tracker_name,
					'name' => $project_name,
					'client_name' => $client_name,
				);
				$result = $this->project->update( $_id, $update_data );
				if ( $result ) {
					$this->session->set_flashdata('success', 'Saved! Project has been updated.');
					redirect('project');
				} else {
					$this->session->set_flashdata('success', 'Error! Something went wrong while update the project.');
				}

			}
			$this->template->load( 'index', 'content', 'user/project/edit', $this->data );
		} else {
			$this->session->set_flashdata('error', 'Invalid Request');
		}
	}

}
