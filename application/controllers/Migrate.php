<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Migration based on selected version
	 * @param  integer
	 * @return null
	 */
    public function index($version = 0)
    {
        $this->load->library("migration");

        if(!$this->migration->version($version)){
            show_error($this->migration->error_string());
        }
    }
	/**
	 * Migration based on latest version
	 * @return null
	 */
	public function latest()
	{
		$this->load->library('migration');

		echo "Migrating...<br>";

		if ($this->migration->latest() === false) {
			show_error($this->migration->error_string());
		} else {
			echo "Done.";
		}
	}
}
