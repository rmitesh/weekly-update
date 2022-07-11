<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task_model extends MY_Model {

	/**
	 * @var boolean
	 */
	protected $soft_delete = TRUE;

	/**
	 * @var string
	 */
	protected $soft_delete_key = 'is_deleted';

	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();
	}


	public function get_all_projects_with_task( $tracker_id = null )
	{
		$this->db->select([
			'project.*', 'task.id AS task_id', 'task.mail_date', 'task.updated_at AS task_updated_at',
		]);
		$this->db->from( TBL_PROJECTS . ' AS project' );
		$this->db->join( TBL_TASKS . ' AS task', 'task.project_id = project.id' );
		$this->db->where([
			'project.user_id' => get_loggedin_user_id(),
			'project.is_deleted' => 0,
			'task.is_deleted' => 0,
		]);
		if ( $tracker_id ) {
			$this->db->where_in('project.tracker_id', $tracker_id);
		}
		$this->db->order_by('task.updated_at', 'desc');

		$result = $this->db->get();
		$respose = array();
		if ( $result ) {
			$respose = $result->result_array();
		}

		return $respose;
	}

	public function get_weekly_update( $tracker_id )
	{
		$monday = date('Y-m-d', strtotime('this monday'));
		$saturday = date('Y-m-d', strtotime('this saturday'));
		
		$this->db->select([
			'task.mail_date', 'task_detail.task', 'task_detail.status',
		]);
		$this->db->from( TBL_TASKS . ' AS task' );
		$this->db->join( TBL_TASK_DETAILS . ' AS task_detail', 'task.id = task_detail.task_id', 'LEFT' );
		$this->db->where([
			'task.is_deleted' => 0,
			'task_detail.is_deleted' => 0,
		]);
		// $this->db->where("task.mail_date BETWEEN '$monday' AND '$saturday'");

		$this->db->where('( task_detail.status = "completed" OR task_detail.status = "in-progress" )');
		$where = 'task.project_id = ( SELECT id FROM '. TBL_PROJECTS .' WHERE tracker_id = '. $tracker_id .' )';
		$this->db->where_in( $where );
		$this->db->order_by('task.mail_date', 'asc');
		$result = $this->db->get();
		$respose = array();
		if ( $result ) {
			$respose = $result->result_array();
		}

		return $respose;
	}

}
