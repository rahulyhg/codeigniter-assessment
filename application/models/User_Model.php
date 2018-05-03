<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Model extends CI_Model
{
    public $table = 'users';
    public $primary_key = 'id';

	public function __construct()
	{
		parent::__construct();
        $this->load->database();
	}

    public function login($email, $password)
    {
        $user = $this->db->where('email', $email)->get('users')->result();
        if (empty($user))
            return 'Your username or password is incorrect';
        if (!password_verify($password, $user->password))
            return 'Your username or password is incorrect';
        if ($user->confirmed == 0)
            return 'Your account has not been activated';

        $hash = hash('sha256', $user->id);
        $this->session->set_userdata('user_id',  $hash);
        return $user->id;
    }

    public function register()
    {
        if(empty($this->input->post('first_name'))){return false;}
        if(empty($this->input->post('last_name'))){return false;}
        if(empty($this->input->post('username'))){return false;}
        if(empty($this->input->post('password'))){return false;}
        if(empty($this->input->post('email'))){return false;}

        $this->load->helper('string');
        $token = random_string('alnum', 64);

        $data = array(
            'first_name'     => $this->input->post('first_name'),
            'last_name'      => $this->input->post('last_name'),
            'username'       => $this->input->post('username'),
            'password'       => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'email'          => $this->input->post('email'),
            'phone'          => $this->input->post('phone'),
            'remember_token' => $token,
            'created'        => time(),
        );
        $this->db->insert($this->table, $data);

        // Get inserted user_id for the other tables
        $user_id = $this->db->insert_id();


        $data = array(
            'user_id' => $user_id,
            'token'   => $token,
            'expired' => (time() + (24*60*60)),
            'created' => time(),
        );
        $this->db->insert('email_confirmations', $data);

        // Get inserted user_id for the other tables
        $ec_id = $this->db->insert_id();
        
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return FALSE;
        }
        else
        {
            $this->db->trans_commit();
            return $token;
        }
    }

    public function activate($token = '')
    {
        if ( empty($token) ) {
            return FALSE;
        }
        $this->db->trans_begin();

        $this->db->select('users.user_id');
        $this->db->join('email_confirmations', 'users.id = email_confirmations.user_id');
        $this->db->where('email_confirmations.token', $token);
        $this->db->where('email_confirmations.expired >', time());
        $user = $this->db->get($this->table)->row();

        if ( !empty($user) ) {
            $data = array(
                'confirmed' => time(),
            );
            $this->db->where('id', $user->id);
            $this->db->update($this->table, $data);
        }

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return FALSE;
        }
        else
        {
            $this->db->trans_commit();
            return $user->id;
        }
    }
}
?>