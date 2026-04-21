<?php

namespace App\Http\Controllers;

use App\Classes\FormBuilder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
	public function __construct(private FormBuilder $formBuilder){
		$this->middleware(function ($request, $next) {
			if (session('user_role') !== 'admin') {
				return redirect(ADMIN_DASHBOARD)->with('flash_message_error', 'Access denied.');
			}
			return $next($request);
		});
	}

	private function buildUserForm(?User $currentuser = null): string
	{
		$action = $currentuser ? ADMIN_USERS_EDIT . $currentuser->id : ADMIN_USERS_ADD;

		$this->formBuilder
			->setAction($action)
			->setMethod('POST')
			->setEnctype('multipart/form-data')
			->addElement($this->formBuilder->textbox('First Name', 'first_name', 'first-name', old('first_name', $currentuser->firstname ?? ''), ['required' => 'required'], 'form-control'))
			->addElement($this->formBuilder->textbox('Last Name', 'last_name', 'last-name', old('last_name', $currentuser->lastname ?? ''), ['required' => 'required'], 'form-control'))
			->addElement($this->formBuilder->textbox('Email', 'email', 'email', old('email', $currentuser->email ?? ''), ['required' => 'required'], 'form-control'))
			->addElement($this->formBuilder->password('Password', 'password', 'password', '', [], 'form-control'))
			->addElement($this->formBuilder->select('Role', 'role', 'role', old('role', $currentuser->role ?? ''), ['' => 'Select', 'admin' => 'Admin', 'consultant' => 'Consultant'], [], 'form-control'))
			->addElement('
				<div class="form-group mt-3">
					<button type="submit" name="submit_action" value="save_back" class="btn btn-md btn-primary">Save &amp; Back to List</button>
					<button type="submit" name="submit_action" value="save_stay" class="btn btn-md btn-secondary ml-2">Save &amp; Stay</button>
				</div>
			');

		return $this->formBuilder->renderForm();
	}
	/**
	 * Display the dashboard.
	 *
	 * @return \Illuminate\View\View
	 */
	public function users()
	{
		$user = Auth::user();
		if (empty($user->id)) {
			return redirect(ADMIN_DASHBOARD);
		}
		add_to_log('Users page',array());

		$data['user'] = $user;
		$data['page_title'] = 'Users';
		$data['page_name'] = 'users';
		$users = User::orderBy('name','asc')->get(); // Fetch all users from the database
		$data['usersarray'] = $users;
		return view('admin.users.users-list', $data);
	}

	public function users_create()
	{
		$user = Auth::user();
		if (empty($user->id)) {
			return redirect(ADMIN_DASHBOARD);
		}
		add_to_log('Opened user create page', array());
		$data['user'] = $user;
		$data['page_title'] = 'Add User';
		$data['page_name'] = 'add_users';
		$data['form_elements'] = $this->buildUserForm();
		return view('admin.users.users-form', $data);
	}

	public function users_store(Request $request)
	{
		$user = Auth::user();
		if (empty($user->id)) {
			return redirect(ADMIN_DASHBOARD);
		}
		$request->validate([
			'first_name' => 'required',
			'last_name'  => 'required',
			'email'      => 'required|email|unique:users,email',
			'password'   => 'required|min:8',
		]);

		$newuser = new User();
		$newuser->firstname = $request->first_name;
		$newuser->lastname  = $request->last_name;
		$newuser->name      = $newuser->firstname . ' ' . $newuser->lastname;
		$newuser->email     = $request->email;
		$newuser->password  = bcrypt($request->password);
		$newuser->role      = $request->role;
		$newuser->status    = 1;
		$newuser->save();

		add_to_log('Created user', $request->all());

		if ($request->submit_action === 'save_stay') {
			return redirect(ADMIN_USERS_EDIT . $newuser->id)->with('flash_message_success', 'User created successfully.');
		}
		return redirect(ADMIN_USERS_LIST)->with('flash_message_success', 'User created successfully.');
	}

	public function users_edit($id)
	{
		$user = Auth::user();
		if (empty($user->id)) {
			return redirect(ADMIN_DASHBOARD);
		}
		$currentuser = User::find($id);

		add_to_log('Editing user', array('user_id' => $currentuser->id, 'firstname' => $currentuser->firstname));

		$data['user']         = $user;
		$data['page_title']   = 'Edit User';
		$data['page_name']    = 'edit_users';
		$data['currentuser']  = $currentuser;
		$data['form_elements'] = $this->buildUserForm($currentuser);
		return view('admin.users.users-form', $data);
	}

	public function users_update(Request $request, $id)
	{
		$user = Auth::user();
		if (empty($user->id)) {
			return redirect(ADMIN_DASHBOARD);
		}
		$currentuser = User::find($id);

		if (!$currentuser) {
			return redirect(ADMIN_USERS_LIST)->with('flash_message_success', 'User not found.');
		}

		$request->validate([
			'first_name' => 'required',
			'last_name'  => 'required',
			'email'      => 'required|email|unique:users,email,' . $id,
			'password'   => 'nullable|min:8',
		]);

		$currentuser->firstname = $request->first_name;
		$currentuser->lastname  = $request->last_name;
		$currentuser->name      = $currentuser->firstname . ' ' . $currentuser->lastname;
		$currentuser->email     = $request->email;
		$currentuser->role      = $request->role;
		$currentuser->status    = 1;
		if (!empty($request->password)) {
			$currentuser->password = bcrypt($request->password);
		}
		$currentuser->save();

		add_to_log('Updated user', $request->all());

		if ($request->submit_action === 'save_stay') {
			return redirect(ADMIN_USERS_EDIT . $id)->with('flash_message_success', 'User updated successfully.');
		}
		return redirect(ADMIN_USERS_LIST)->with('flash_message_success', 'User updated successfully.');
	}

	public function users_destroy($id)
	{
		$user = Auth::user();
		if (empty($user->id)) {
			return redirect(ADMIN_DASHBOARD);
		}
		// Find the API key by ID
		$newuser = User::where('id', $id)->first();

		$newuser->is_deleted = '1';
		$newuser->save();

		add_to_log('Deleted profile',$newuser);
		// Redirect back to the /apis page
		return redirect('/dashboard/users')->with('flash_message_success', 'User deleted successfully.');
	}

	public function users_impersonate($id)
	{
		$adminuser = Auth::user();

		$user = User::findOrFail($id);
		if($user){

			$adminlogin = request()->session()->get('admin_login');
			if(empty($adminlogin)){

				$admin_login = array();
				$admin_login['admin_login_id'] = $adminuser->id;
				$admin_login['admin_login_name'] = $adminuser->firstname.' '.$adminuser->lastname;
				$admin_login['admin_login_email'] = $adminuser->email;
				$admin_login['admin_login_role'] = $adminuser->role;
				request()->session()->put('admin_login', $admin_login);

				add_to_log('impersonated', $admin_login);
			}

			Auth::loginUsingId($user->id);
			session(['user_role' => $user->role]);

			add_to_log('impersonated to '.$user->firstname, $user);

			return redirect(ADMIN_DASHBOARD);
		}
		// Redirect back to the /apis page
		return redirect(ADMIN_DASHBOARD)->with('flash_message_success', 'Could not impersonate.');
	}
}
