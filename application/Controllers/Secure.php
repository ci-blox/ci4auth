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
	$this->data['title'] = 'Demo Secure Area';
	$this->data['pagetitle'] = 'CodeIgniter 4 Demo Secure Area';
}

/**
 * index - secure area home
 *
 * @return void
 */
public function index()
{
	$curruser = $this->getCurrentUser();
	if (!$curruser)
		return redirect()->to('/secure/login');
	$this->data['viewdata'] = array();
	$this->data['viewdata']['curruser'] = $curruser;
	$this->data['pagebody'] = 'welcome_secure';
	$this->render();
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
			$this->data['pagetitle'] = 'Login - ' . $this->data['pagetitle'];
			return view('secure/login', $this->data);				
		} else {
			// Logged in successfully, set cookie, display success message
		
			$cfg = new \Config\Authenticator();			
			$authconfig = (object)$cfg->authconfig;			
			setcookie($authconfig->cookie_name, $result['hash'], $result['expire'], 
			$authconfig->cookie_path, $authconfig->cookie_domain, $authconfig->cookie_secure, $authconfig->cookie_http);
			return redirect()->to('/secure/');
		}				
	}
	else
		return view('secure/login', $this->data);
	}
		
		/**
		 * register
		 *
		 * @return void
		 */
		public function register()
		{
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
				$this->data['viewdata']['msg'] = $result['message'];
				

//$userData = [$firstname,$lastname,$email];

//$zxcvbn = new Zxcvbn();
//$strength = $zxcvbn->passwordStrength($password, $userData);
//$this->data['viewdata']['msg'] .= ' '.$strength['score'];

            } else {
                $uid = $this->auth->getUID($email);
                $output = json_encode(array("type" => 0, "result" => $result['message']));
                return redirect()->to('/secure/login');
            }
            $registration = false;
        }
		
		$this->data['pagetitle'] = 'Register - ' . $this->data['title'];
		$this->data['title'] = 'Register - ' . $this->data['title'];
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
		$email = false;
		if (isset($_POST['username'])) {		
			$email = filter_var($this->request->getPost('username'), FILTER_SANITIZE_STRING);	
			$result = $this->auth->requestReset($email);			
			if($result['error']) {
				// Something went wrong, display error message
				$this->data['viewdata'] = array();
				$this->data['viewdata']['msg'] = $result['message'];
				$this->data['title'] = 'Forgot Password - ' . $this->data['title'];
				return view('secure/forgot', $this->data);	
			}
			else
			{
				return redirect()->to('/secure/login');
			}
		}
        return view('secure/forgot', $this->data);
	}
	
	/**
	 * changepassword
	 *
	 * @return void
	 */
	public function changepassword()
    {
		$this->data['pagetitle'] = 'Change Password - ' . $this->data['pagetitle'] ;
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
			}
			else
			{
				return redirect()->to('/secure/login');
			}
		}
		$this->data['pagebody'] = 'secure/changepassword';
		$this->render();
	}

	/**
	 * logout
	 *
	 * @return void
	 */
	public function logout()
	{
		$cfg = new \Config\Authenticator();			
		$authconfig = (object)$cfg->authconfig;			
		if(isset($authconfig->cookie_name)) {
			setcookie($authconfig->cookie_name, '', time() - 3600,"/",""); // empty value and old timestamp
		}
		return redirect()->to('/secure/login');

	}
}
