<?php namespace App\Http\Controllers;

use App\Http\Models\Category;
use App\Http\Models\Skill;
use App\Http\Models\Email;
use App\Http\Models\Job;
use App\Http\Models\Ad;
use App\Http\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use LaravelAcl\Authentication\Exceptions\PermissionException;
use LaravelAcl\Authentication\Exceptions\ProfileNotFoundException;
use LaravelAcl\Authentication\Helpers\DbHelper;
use LaravelAcl\Authentication\Models\UserProfile;
use LaravelAcl\Authentication\Presenters\UserPresenter;
use LaravelAcl\Authentication\Services\UserProfileService;
use LaravelAcl\Authentication\Validators\UserProfileAvatarValidator;
use LaravelAcl\Library\Exceptions\NotFoundException;
use LaravelAcl\Authentication\Models\User;
use LaravelAcl\Authentication\Helpers\FormHelper;
use LaravelAcl\Authentication\Exceptions\UserNotFoundException;
use LaravelAcl\Authentication\Validators\UserValidator;
use LaravelAcl\Library\Exceptions\JacopoExceptionsInterface;
use LaravelAcl\Authentication\Validators\UserProfileValidator;
use View, Input, Redirect, App, Config,Session,Mail;
use LaravelAcl\Authentication\Interfaces\AuthenticateInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Validator;
use DB;

class GroupController extends Controller {

		protected $auth;
		public function __construct(AuthenticateInterface $auth)
		{
			//$this->middleware('guest');
			 $this->auth = $auth;
		}
		public function index()
		{
			$groups = DB::table('group_user')
					->join('group_user_mapping', 'group_user.group_id', '=', 'group_user_mapping.group_id')
					->select('group_user.group_name',DB::raw('COUNT(group_user_mapping.group_id) as total_users'),'group_user.group_id')
					->groupBy('group_user_mapping.group_id')
					->get();
			return view('grouplist',['groups' => $groups]);
		}
		public function addgroup($group_id=''){
			$edit_data = array();
			if(!empty($group_id)){
				$groups = DB::table('group_user')
					->join('group_user_mapping', 'group_user.group_id', '=', 'group_user_mapping.group_id')
					->select('group_user.group_name','group_user_mapping.user_id','group_user.group_id')
					->where('group_user.group_id','=',$group_id)
					->get();
					$edit_data = $groups;
			}
				$exit_users = DB::table('users')
				->join('group_user_mapping', 'users.id', '=', 'group_user_mapping.user_id');
				if(!empty($group_id)){
					$exit_users->where('group_user_mapping.group_id','!=',$group_id);
				}
				$exit_users->groupBy('users.id');
				$exits= $exit_users->lists('users.id');
		
			$users = DB::table('users')
				->join('user_profile', 'users.id', '=', 'user_profile.user_id')
				->select('users.id','users.email','user_profile.first_name','user_profile.last_name')
				->whereNotIn('users.id',$exits)
				->get();
			return view::make('group.addgroup')->with(['users' => $users,'edit_data' => $edit_data]);
		}
		public function savegroup(Request $request){
		$validator = Validator::make($request->all(), [
	        'group_name' => 'required',
	        'users' => 'required',
	    ]);
		if($request->input('group_id')){
			$group_id = $request->input('group_id');
			$redirect = '/admin/editgroup/'.$group_id;
		}else{
			$redirect = '/admin/addgroup';
		}
	    if ($validator->fails()) {
            return redirect($redirect)
                        ->withErrors($validator)
                        ->withInput();
        }else{
        	$post = Input::all();
        	if($request->input('group_id')){
        		$users = $post['users'];
        		$ids = DB::table('group_user_mapping')
            		->where('group_id' ,'=', $group_id)->lists('user_id');	
        		foreach ($users as $id)
        		{
            		if(!in_array($id,$ids))
            		{
            			$data = array(
	                        'group_id' => $group_id,
	                        'user_id'=> $id,
	                    );
	            		$insert = DB::table('group_user_mapping')->insert($data);
            		}
            		
	            }
	            $ids = DB::table('group_user_mapping')
            		->where('group_id' ,'=', $group_id)->lists('user_id');
            	foreach ($ids as $id)
        		{
            		if(!in_array($id,$users))
            		{
            			DB::table('group_user_mapping')
            			->where('group_id' ,'=', $group_id)
            			->where('user_id' ,'=', $id)
            			->delete();
            		}
            		
	            }
        		$data = array(
	                        'group_name' => $post['group_name'],
	                        'updated_at'=> \Carbon\Carbon::now()->toDateTimeString(),
	                    );
	            $group = DB::table('group_user')->where('group_id',$group_id)->update($data);

	            \Session::flash('success_message', 'Successfully Update group!');
	                return redirect('/admin/grouplist');
        	}else{
		      	$data = array(
	                        'group_name' => $post['group_name'],
	                        'created_at'=> \Carbon\Carbon::now()->toDateTimeString(),
	                        'updated_at'=> \Carbon\Carbon::now()->toDateTimeString(),
	                    );
	            $group_id = DB::table('group_user')->insertGetId($data);

	            if($group_id > 0){
	            	$users = $post['users'];
	            	foreach ($users as $id) {
	            		$data = array(
	                        'group_id' => $group_id,
	                        'user_id'=> $id,
	                    );
	            		$insert = DB::table('group_user_mapping')->insert($data);
	            	}
	            	
	                \Session::flash('success_message', 'Successfully created group!');
	                return redirect('/admin/grouplist');
	            }
        	}
        }
	}
}