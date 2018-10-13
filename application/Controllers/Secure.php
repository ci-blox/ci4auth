<?php namespace App\Controllers;
			use ZxcvbnPhp\Zxcvbn;

class Secure extends Application
{
	/**
	 * Constructor
     */
	public function __construct()
    {
		$this->isSecure = true;
        parent::init();
    }
	
	public function index()
	{
	if (!$this->getCurrentUser())
	return redirect()->to('/secure/login');
	
	$this->data = array();
	$this->data['title'] = 'Demo';
	
}

/**
 * login
 *
 * @return void
 */
public function login()
{
	$email = false;
	$password = false;
	$rememberme = false;
	if (isset($_POST['username'])) {
		// TODO do validation here
		$email = filter_var($this->request->getPost('username'), FILTER_SANITIZE_STRING);
		$password = filter_var($this->request->getPost('password'), FILTER_SANITIZE_STRING);
		$rememberme = (bool)($this->request->getPost('remember'));
		
		$result = $this->auth->login($email, $password, $rememberme);
		if($result['error']) {
			// Something went wrong, display error message
			$this->data['viewdata'] = array();
			$this->data['viewdata']['msg'] = $result['message'];
			$this->data['pagetitle'] = 'Login - CodeIgniter 4 Demo';
			return view('secure/login', $this->data);				
		} else {
			// Logged in successfully, set cookie, display success message
			setcookie($this->authconfig->cookie_name, $result['hash'], $result['expire'], 
			$this->authconfig->cookie_path, $this->authconfig->cookie_domain, $this->authconfig->cookie_secure, $this->authconfig->cookie_http);
			$this->data['pagetitle'] = 'CodeIgniter 4 Demo Secure Area';
			$this->data['pagebody'] = 'welcome_secure';
			$this->render();
		}				
			}
			$this->data['pagetitle'] = 'CodeIgniter 4 Demo Secure Area';
			return view('secure/login', $this->data);
		}
		
		/**
		 * register
		 *
		 * @return void
		 */
		public function register()
		{
			$this->data = array();
			$email = false;
			$password = false;
			$confirm_password = false;
        if (isset($_POST['password'])) {
			$rules = [
				'first_name' => 'trim|required|max_length[50]', 
				'last_name' => 'trim|required|max_length[50]', 
				'email'    => 'trim|required|valid_email',
				'password' => 'trim|required|min_length[5]',
				'confirm_password' => 'trim|required|matches[password]'
			];
			if (! $this->validate($rules))
			{
				return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
			}
	
			$firstname = filter_var($this->request->getPost('first_name'), FILTER_SANITIZE_STRING);
			$lastname = filter_var($this->request->getPost('last_name'), FILTER_SANITIZE_STRING);
            //$username = filter_var($this->request->getPost('username'), FILTER_SANITIZE_STRING);
			$email = filter_var($this->request->getPost('email'), FILTER_SANITIZE_EMAIL);
			$password = $this->request->getPost('password');
			$confirm_password = $this->request->getPost('confirm_password');
			$terms =  (bool)($this->request->getPost('terms'));
            //$key = $_POST['g-recaptcha-response'];
            //$params = array("firstName" => "{$firstname}", "lastName" => "{$lastname}", "username" => "{$username}", "type" => '1');
            $params = array("firstName" => "{$firstname}", "lastName" => "{$lastname}");
            $result = $this->auth->register($email, $password, $confirm_password, $params, $sendmail = true);
            if ($result['error']) {
                // if registration not complete
                $output = json_encode(array("type" => 1, "result" => $result['message']));
                $this->data['viewdata'] = array();
				$this->data['viewdata']['msg'] = $result['message'];
				

//$userData = [$firstname,$lastname,$email];

//$zxcvbn = new Zxcvbn();
//$strength = $zxcvbn->passwordStrength($password, $userData);
//$this->data['viewdata']['msg'] .= ' '.$strength['score'];

            } else {
                $uid = $this->auth->getUID($email);
                $output = json_encode(array("type" => 0, "result" => $result['message']));
                redirect()->to('/secure/login');
            }
            $registration = false;
        }
		
		$this->data['pagetitle'] = 'Register - CodeIgniter 4 Demo Secure Area';
        return view('secure/register', $this->data);
//    secure/register';

    }

	/**
	 * forgot
	 *
	 * @return void
	 */
	public function forgot()
    {
		$this->data = array();
		$email = false;
		if (isset($_POST['username'])) {		
			$email = filter_var($this->request->getPost('username'), FILTER_SANITIZE_STRING);	
			$result = $this->auth->requestReset($email);			
			if($result['error']) {
				// Something went wrong, display error message
				$this->data['viewdata'] = array();
				$this->data['viewdata']['msg'] = $result['message'];
				$this->data['pagetitle'] = 'CodeIgniter 4 Demo Login<br>id demo pw test1';
				return view('secure/forgot', $this->data);	
			}
			else
			{
				redirect()->to('/secure/login');
			}
		}
	   $this->data['pagetitle'] = 'CodeIgniter 4 Demo Secure Area';
        return view('secure/forgot', $this->data);
	}
	
	/**
	 * changepassword
	 *
	 * @return void
	 */
	public function changepassword()
    {
		$this->data = array();
		$this->data['pagetitle'] = 'Change Password - CodeIgniter 4 Demo';
        if (isset($_POST['password'])) {
            $uid = $this->auth->getSessionUID($this->auth->getSessionHash());
            $oldpassword = $this->request->getPost('old_password');
            $password = $this->request->getPost('password');
            $confirm_password = $this->request->getPost('confirm_password');
            $result = $this->auth->changePassword($uid, $oldpassword, $password, $confirm_password);
			if($result['error']) {
				// Something went wrong, display error message
				$this->data['viewdata'] = array();
				$this->data['viewdata']['msg'] = $result['message'];
				return view('secure/changepassword', $this->data);	
			}
			else
			{
				redirect()->to('/secure/login');
			}
		}
        return view('secure/changepassword', $this->data);
    }
}
