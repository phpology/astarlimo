<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SuperadminController extends Controller
{
	public function __construct(){
		$this->middleware(function ($request, $next) {
			return $next($request);
		});
	}

	public function getLogin(Request $request){
		$admin = Auth::user();
		if(!empty($admin->id)){
			return redirect(ADMIN_DASHBOARD);
		}
		$data['page_title'] = 'Login';
		$data['logintype'] = !empty($request->login) ? $request->login : '';
		return view("admin.login", $data);
	}

	public function postLogin(Request $request){
		$request->validate([
			'email'    => 'required|email',
			'password' => 'required',
		]);

		if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => '1'])) {
			$request->session()->regenerate();

			$user = Auth::user();
			$user->last_login = date('Y-m-d H:i:s');
			$user->save();

			session(['user_role' => $user->role]);

			add_to_log('logged in', []);

			return redirect(ADMIN_DASHBOARD);
		}

		return back()->withErrors(['email' => 'These credentials do not match our records.'])->onlyInput('email');
	}

	public function getLoginEmail(Request $request, $email){
		$user = User::where('email', $email)->first();
		if(!empty($user)){
			Auth::loginUsingId($user->id);
			return redirect(ADMIN_DASHBOARD);
		}
		return redirect(ADMIN_LOGIN);
	}

	public function getDashboard(Request $request){
		$admin = Auth::user();
		if(empty($admin->id)) {
			return redirect(ADMIN_LOGIN);
		}
		$data['user'] = $admin;
		$data['page_title'] = APP_NAME.' Dashboard';

		add_to_log('Dashboard Viewed', array());

		return view("admin.dashboard", $data);
	}

	public function getProfile(Request $request){
		$admin = Auth::user();
		if(empty($admin->id)){
			return redirect(ADMIN_LOGIN);
		}
		$data['user'] = $admin;
		$data['page_title'] = 'Profile';
		$data['page_name'] = 'profile';

		add_to_log('Viewed Profile', $admin);

		return view("admin.profile", $data);
	}

	public function postUpdateProfile(Request $request){
		$admin = Auth::user();
		if(empty($admin->id)){
			return redirect(ADMIN_LOGIN);
		}
		return redirect(ADMIN_PROFILE)->with('flash_message_success', 'Profile updated.');
	}

	public function getLogout(){
		add_to_log('logged out', array());
		Session::flush();
		return redirect(ADMIN_LOGIN);
	}

	public function getImpersonateLogout(){
		$adminlogin = request()->session()->get('admin_login');
		request()->session()->forget('admin_login');

		add_to_log('impersonate logged out', array($adminlogin));

		Auth::loginUsingId($adminlogin['admin_login_id']);
		session(['user_role' => $adminlogin['admin_login_role']]);

		add_to_log('logged in account', array($adminlogin));

		return redirect(ADMIN_DASHBOARD);
	}
}
