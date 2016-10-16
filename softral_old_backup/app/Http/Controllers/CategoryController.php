<?php namespace App\Http\Controllers;

use App\Http\Models\Category;
use App\Http\Models\Skill;
use App\Http\Models\Job;
use App\Http\Models\Ad;
use App\Http\Models\Page;
use App\Http\Models\Proposal;
use App\Http\Models\Milestone;
use App\Http\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Models\Financial;
use LaravelAcl\Authentication\Exceptions\PermissionException;
use LaravelAcl\Authentication\Exceptions\ProfileNotFoundException;
use LaravelAcl\Authentication\Helpers\DbHelper;
use LaravelAcl\Authentication\Models\UserProfile;
use LaravelAcl\Authentication\Presenters\UserPresenter;
use LaravelAcl\Authentication\Services\UserProfileService;
use LaravelAcl\Authentication\Validators\UserProfileAvatarValidator;
use LaravelAcl\Library\Exceptions\NotFoundException;
use LaravelAcl\Authentication\Models\User;
use LaravelAcl\Authentication\Models\ProfileField;
use LaravelAcl\Authentication\Helpers\FormHelper;
use LaravelAcl\Authentication\Exceptions\UserNotFoundException;
use LaravelAcl\Authentication\Validators\UserValidator;
use LaravelAcl\Library\Exceptions\JacopoExceptionsInterface;
use LaravelAcl\Authentication\Validators\UserProfileValidator;
use View, Input, Redirect, App, Config,Session,Mail;
use LaravelAcl\Authentication\Interfaces\AuthenticateInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use DB;

class CategoryController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/
	protected $auth;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(AuthenticateInterface $auth)
	{
		//$this->middleware('guest');
		 $this->auth = $auth;
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getList()
	{
		 $categories = Category::with('children')->where('type',Input::get('type'))->get();
		
		 return View::make('laravel-authentication-acl::admin.category.list')->with([ 'categories'   => $categories]);
	}
	
	public function contractsList()
	{
		 $contracts = Contract::with('job','user','proposal')->get();
		 
		 return View::make('laravel-authentication-acl::admin.contract.list')->with([ 'contracts'   => $contracts]);
	}
	
  
	public function editCategory()
	{
		if(Input::get('id')):
        
            $category = Category::find(Input::get('id'));
			$parents = DB::table('categories')->where(['parent' => 0])->where('id','!=',Input::get('id'))->where('type',Input::get('type'))->get();
        else:
            $category = new Category;
			$parents = DB::table('categories')->where(['parent' => 0])->where('type',Input::get('type'))->get();
       endif;
		
		$parent_selector = array();
		$parent_selector['']='-Select Parent Category-';
		foreach($parents as $parent) {
			$parent_selector[$parent->id] = $parent->category; // I assume name attribute contains client name here
		}
		 return View::make('laravel-authentication-acl::admin.category.edit')->with([
                                                                                          'category'   => $category,
                                                                                          "parents" => $parent_selector
                                                                                  ]);
	}
	
	public function saveCategory(Request $request)
	{
		$this->validate($request, [
			'category' => 'required',
			//'description' => 'required'
		]);
		 $input = $request->all();
		 
		$slug = str_slug($input['category'], "-");
		$LastSlug = Category::whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")
		->orderBy('slug', 'desc')
		->first();
	
		// print_r($input);exit;
		 if((Input::get('id'))):
			 $category = Category::findOrFail(Input::get('id'));
			 $category->fill($input)->save();
			Session::flash('message', 'Category successfully updated!');
		 else:
				
			if(isset($LastSlug->slug)):
				$input['slug'] = "{$slug}-" . ((intval(str_replace("{$slug}-", '', $LastSlug->slug))) + 1);
			else:
				$input['slug'] =str_slug($input['category'], "-");
			endif;	

			Category::create($input);
			Session::flash('message', 'Category successfully added!');
		 endif;
 
		return redirect()->back();
		
	}
	
	public function contractsApprove(Request $request){
		$input = $request->all();
		
		if($input['submit']=='Suspend'):
			$input['approve_contract']='1';
		elseif($input['submit']=='Hold'):
			$input['hold_contract']='0';
		elseif($input['submit']=='UnHold'):
			$input['hold_contract']='1';
		elseif($input['submit']=='Reinstate'):
			$input['approve_contract']='0';
		endif;
		
		$contract = Contract::findOrFail($input['contract_id']);
		$contract->fill($input)->save();
		
		$proposal = Proposal::findOrFail($contract['proposal_id']);
		
		$send_mail=$proposal['job']['user']['email'];
		$freelancer_mail=$proposal['user']['email'];
		Mail::send('emails.approve_contract_notification', ['proposal' => $proposal,'label'=>'been '.$input['submit']], function($message) use ($send_mail) {
				$message->to($send_mail, 'From Softral Job')->subject('Softral - Contract Suspend / Hold notification');
			});
			
		Mail::send('emails.approve_contract_notification_freelancer', ['proposal' => $proposal,'label'=>'been '.$input['submit']], function($message) use ($freelancer_mail) {
				$message->to($freelancer_mail, 'From Softral Job')->subject('Softral - Contract Suspend / Hold notification');
			});
			
		Session::flash('message', 'Congratulations, You have successfully '.$input['submit'].'d the contract, '.$input['submit'].'d confirmation has been sent to the Employee.');
		return redirect('admin/contracts/list');
		
	}
	
	public function deleteCategory()
	{
		$category = Category::findOrFail(Input::get('id'));
		$category->delete();
		Session::flash('message', 'Category successfully deleted!');
 
		return redirect()->route('category.list');	
	}

 /* Skill List */ 	
	public function getskillList()
	{
		 $skills = Skill::get();
		
		 return View::make('laravel-authentication-acl::admin.skill.list')->with([ 'skills'   => $skills]);
	}
	
	public function editSkill()
	{
		
		try
        {
            $skill = Skill::find(Input::get('id'));
        } catch(JacopoExceptionsInterface $e)
        {
            $skill = new Skill;
        }
		
		 return View::make('laravel-authentication-acl::admin.skill.edit')->with([
                                                                                          'skill'   => $skill,
                                                                                 
                                                                                  ]);
	}
	
	public function saveSkill(Request $request)
	{
		$this->validate($request, [
			'skill' => 'required',
			//'description' => 'required'
		]);
		 $input = $request->all();
		 
		$slug = str_slug($input['skill'], "-");
		$LastSlug = Skill::whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")
		->orderBy('slug', 'desc')
		->first();
		
		
		// print_r($input);exit;
		 if((Input::get('id'))):
			 $skill = Skill::findOrFail(Input::get('id'));
			 $skill->fill($input)->save();
			Session::flash('message', 'Skill successfully updated!');
		 else:
				if(isset($LastSlug->slug)):
				$input['slug'] = "{$slug}-" . ((intval(str_replace("{$slug}-", '', $LastSlug->slug))) + 1);
				else:
				$input['slug'] =str_slug($input['skill'], "-");
				endif;	

			Skill::create($input);
			Session::flash('message', 'Skill successfully added!');
		 endif;
 
		return redirect()->back();
		
	}
	
	public function deleteSkill()
	{
		$skill = Skill::findOrFail(Input::get('id'));
		$skill->delete();
		Session::flash('message', 'Skill successfully deleted!');
 
		return redirect()->route('skill.list');	
	}
	
	public function deleteAdminProposal(){
		$proposal = Proposal::findOrFail(Input::get('id'));
		$proposal->delete();
		Session::flash('message', 'Proposal successfully deleted!');
 
		return redirect()->back();
		
	}
	
	public function view_Proposal(){
		$proposal = Proposal::with('job','user_profile.profile_field','contract')->where('id',Input::get('id'))->first();
		$logged_user = $this->auth->getLoggedUser();
		
		
		if($logged_user->id!=$proposal->user_id && $logged_user->id!=$proposal->job->user_id):
			//return view('laravel-authentication-acl::client.exceptions.404');
		endif;
		
		$images=unserialize($proposal->job->images);
		$images_string='';

		if(!empty($images)):
			$images_string=implode(' ', array_map(function ($v, $k) { return "<a href='".url()."/download/".$v."' target='_blank'>".$v."</a>,"; }, $images, array_keys($images)));
		endif;
		
		$no_more=0;
		if(isset($proposal->contract) && ($proposal->contract->cancel_contract==1 || $proposal->contract->ended_contract==1)):
			$no_more=1;
		endif;
		
		return View::make('laravel-authentication-acl::admin.job.view_Proposal')->with(['proposal'=>$proposal,'images_string'=>rtrim($images_string,','),'no_more'=>$no_more,'user_id'=>$logged_user->id]);
	}

	public function viewadminProposal()
	{
		$logged_user = $this->auth->getLoggedUser();
		$job = Job::with('contract')->where("id",  Input::get('job-id'))->first();
		
		$proposals = Proposal::with('user','user_profile.profile_field','job')->where("job_id",  Input::get('job-id'))->paginate(10);
		//dd($proposals);
		$no_more=0;
		if(isset($job->contract) && ($job->contract->cancel_contract==1 || $job->contract->ended_contract==1)):
			$no_more=1;
		endif;
		
		$proposals->setPath('');
		
		return View::make('laravel-authentication-acl::admin.job.viewadminProposal')->with([ 'proposals'   => $proposals,'job'=>$job,'no_more'=>$no_more]);
	}
	
		public function edit_Proposal($job=null,$id=null){
		
		$logged_user = $this->auth->getLoggedUser();
		$setting = User::where('id',1)->first();
	
			$job_detail = Job::with('categories.parent_get','user','children')->where('slug', $job)->first();
			//dd($job_detail);
			$exist_proposal = Proposal::where('user_id', $logged_user->id)->first();
			//dd($exist_proposal);
			
			try
			{
				$proposal = Proposal::find($id);
				$milestone = Milestone::where('proposal_id',$id)->first();
			} catch(JacopoExceptionsInterface $e)
			{
				$proposal = new Proposal;
				$milestone = new milestone;
			}
			
			if($setting['employee_fee']!=''):
				$freelancer_fee=$setting['employee_fee'];
			else:
				$freelancer_fee='5';
			endif;
			
			return View::make('laravel-authentication-acl::admin.job.edit_Proposal')->with([ 'job_detail'   => $job_detail,'proposal'=>$proposal,'milestone'=>$milestone, 'freelancer_fee'=>$freelancer_fee]);
		
	}
	
	public function adminsaveProposal(Request $request)
	{
			$input = $request->all();
			//dd($input);
			$logged_user = $this->auth->getLoggedUser();
			$amount=json_encode($input['amount']);
			$amount_array=$input['amount'];
			
			$input['user_id']= $logged_user->id;
			$input['amount']= $amount;
			
			
			$notification['label'] = 'got proposal';
			$notification['job_id'] =$input['job_id'];
			
			
			$job_detail = Job::where('id', $input['job_id'])->first();
			//dd($job_detail);
			$job_posted_email=$job_detail->user->email;
				
			if(Input::get('id')):
			
				$proposal = Proposal::findOrFail(Input::get('id'));
				   //dd($proposal);
			
				
				Milestone::where('proposal_id', Input::get('id'))->update(['posted_date' => $amount_array['duration'],'amount'=>$amount_array['charged_client']]);
				
				$proposal->fill($input)->save();
				Session::flash('message', 'Proposal successfully updated!');
			else:
			
				$proposal=Proposal::create($input);
				
				
				$notification['user_id'] =$job_detail['user_id'];
				$notification['proposal_id'] =$proposal['id'];
				$notification = Notifications::create($notification);
				$notification['user_id'] =$job_detail['user_id'];
				$input['proposal_id']= $proposal->id;
				$input['label']= 'Final Deliverble';
				$input['amount']= $amount_array['charged_client'];	
				$input['posted_date']= $amount_array['duration'];
				$milestone=Milestone::create($input);
				
				 Mail::send('emails.proposal_sent', ['user'=>$logged_user,'data' => $input,'job_detail'=>$job_detail,'proposal'=>$proposal], function($message) use ($job_posted_email) {
				$message->to($job_posted_email, 'From Softral Job')->subject('Softral - Got Proposal');
			});
				Session::flash('message', 'You have successfully sent a proposal!');
			endif;
		
		
			//return redirect()->route('job.addProposal/'.$job_detail['slug']);	
			return redirect()->back();
	}
/* Job List */  	
	public function getjobList()
	{
		 $jobs = Job::with('categories','categories.parent_get')->get();
		//dd($jobs);exit;
		 return View::make('laravel-authentication-acl::admin.job.list')->with([ 'jobs'   => $jobs]);
	}
	
	public function editJob()
	{
		 
		 $categories = Category::with('children')->where('type','Job')->get();
		 //dd($categories );
		 $skills = Skill::get();
		 $logged_user = $this->auth->getLoggedUser();
		 $parent_selector = array();
		 $cant_post=0;
		 
		 
		if($logged_user->user_profile[0]->profile_field_type->value!='Buyer' && $logged_user->user_profile[0]->profile_field_type->value!='Both'):
			return view('laravel-authentication-acl::client.exceptions.404');
		endif;
		
		foreach($skills as $skill) {
			$parent_selector[$skill->id] = $skill->skill; // I assume name attribute contains client name here
		}
		
		if((Input::get('id'))):
            $job = Job::where('id',Input::get('id'))->first();
			//dd($job);
			if(empty($job)):
				return view('laravel-authentication-acl::client.exceptions.404');
			endif;
			//$skill_id[]=unserialize($job->skill_id);
        else:
            $job = new Job;
		endif;
		
		if(isset($logged_user->user_profile[0]->id)):
			$employee_type = ProfileField::where('profile_id',$logged_user->user_profile[0]->id)->where('profile_field_type_id','=','1')->first();
			if(isset($employee_type['value']) &&  ($employee_type['value']=='Both' ||  $employee_type['value']=='Buyer')):		
				$accounts = Financial::where('user_id',$logged_user->id)->Orwhere('person_name','!=','')->where('bank_account','!=','')->get();
				$accounts_array=$accounts->toArray();
				if(empty($accounts_array)):
					$cant_post=1;
				endif;
			endif;
		endif;
		//dd($job);exit;
		 return View::make('laravel-authentication-acl::admin.job.edit')->with([ 'categories' => $categories,'skills'   => $parent_selector, 'job'=>$job, 'cant_post'=>$cant_post]);
		
		
	}
	
	public function adminedit(Request $request)
	{
	
		$input = $request->all();
		
		$validation='';
		
		if($input['job_type']=='hourly'):
			$validation="required";
		endif;
		$this->validate($request, [
			'project_name' => 'required|min:8|max:120',
			'category_id' => 'required',
			'skill_id' => 'required',
			'description' => 'required',
			'hourperweek' => $validation,
			'budget' => 'digits_between:1,9',
		]);
		
		 $logged_user = $this->auth->getLoggedUser();
		
		$files = Input::file('images');
		$file_count = count($files);
		
		$file_count = count($files);
    // start count how many uploaded
			$uploadcount = 0;
			$images=array();
			$skill_name='';
			
			if($files[0]!=''):
			foreach($files as $file) {
			
				$destinationPath = 'uploads';
				$filename = $file->getClientOriginalName();
				$upload_success = $file->move($destinationPath, $filename);
				$uploadcount ++;
				$images[]=$filename;
			  }
			 endif;
		
		
		if(isset($input['image_string'])):
			for($image_string=0;$image_string<count($input['image_string']);$image_string++):
				$images[] =$input['image_string'][$image_string];
			endfor;
		endif;
		
		for($sk=0;$sk<count($input['skill_id']);$sk++):
			$skill = Skill::find($input['skill_id'][$sk]);
			$skill_name.=$skill->skill.',';
		endfor;
		
		$input['images']=serialize($images);
		$input['skill_id']=serialize($input['skill_id']);
		$input['user_id']= $logged_user->id;
		
		$input['skill_name']=$skill_name;
		
		$job = Job::findOrFail(Input::get('id'));
		$job->fill($input)->save();	
		
		Session::flash('message', 'Job successfully updated!');
		
		return redirect()->route('job.list');	
	}
	
	public function viewJob()
	{
		$job = Job::findOrFail(Input::get('id'));
		return View::make('laravel-authentication-acl::admin.job.view')->with([ 'job'   => $job]);
	}
	
	public function deleteJob()
	{
		$job = Job::findOrFail(Input::get('id'));
		$job->delete();
		Session::flash('message', 'Job successfully deleted!');
 
		return redirect()->route('job.list');	
	}
	
/* Ad List */  	
	public function getadList()
	{
		 $ads = Ad::with('categories','categories.parent_get')->get();
		//dd($jobs);exit;
		 return View::make('laravel-authentication-acl::admin.ad.list')->with([ 'ads'   => $ads]);
	}
	
	public function viewAd()
	{
		$ad = Ad::findOrFail(Input::get('id'));
		return View::make('laravel-authentication-acl::admin.ad.view')->with([ 'ad'   => $ad]);
	}
	
	public function deleteAd()
	{
		$ad = Ad::findOrFail(Input::get('id'));
		$ad->delete();
		Session::flash('message', 'Classified successfully deleted!');
 
		return redirect()->route('ad.list');	
	}
	
	/* Page List */ 	
	public function getpageList()
	{
		 $pages = Page::with('children_hexa')->get();
		//dd($pages);exit;
		 return View::make('laravel-authentication-acl::admin.page.list')->with([ 'pages'   => $pages]);
	}
	
	public function editPage()
	{
		$parents = DB::table('pages')->where(['parent' => 0])->get();
		$parent_selector = array();
		$parent_selector['']='-Select Parent Page-';
		foreach($parents as $parent) {
			$parent_selector[$parent->id] = $parent->title; // I assume name attribute contains client name here
		}
		
		try
        {
            $page = Page::find(Input::get('id'));
        } catch(JacopoExceptionsInterface $e)
        {
            $page = new Page;
        }
		
		 return View::make('laravel-authentication-acl::admin.page.edit')->with([
                                                                                          'page'   => $page,
																						  'parents'=>$parent_selector
                                                                                  ]);
	}
	
	public function savePage(Request $request)
	{
		$this->validate($request, [
			'title' => 'required',
			'content' => 'required',
		]);
		
		 $input = $request->all();
		 //dd($input);exit();
		 $slug = str_slug($input['title'], "-");
		$LastSlug = Page::whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")
		->orderBy('slug', 'desc')
		->first();

		
		 if((Input::get('id'))):
		 
				$page = Page::findOrFail(Input::get('id'));
				//dd($page);exit();
				$image1=@unserialize($page->image);
				if($page->image!='' && $image1!==false):
					$input1=unserialize($page->image);
				else:
					$input1=array();
				endif;
				
				$file = Input::file('image');
				
				$file_count = count($file);
			
				$uploadcount = 0;
				$image=array();
			
				
				if($file[0]!=''):
				foreach($file as $f) {
					$destinationPath = 'uploads';
					$filename = $f->getClientOriginalName();
					$input['image']=$filename;
					$upload_success = $f->move($destinationPath, $filename);
					$uploadcount ++;
					$image[]=$filename;
					
				}
						$input['image_text']='';
						$input['image']=$input['image_text'];
				
				endif;
				

				    $files = Input::file('vedio1');
					
					if(isset($files)):
					$destinationPath = 'uploads/video';
					$filename = $files->getClientOriginalName();
					$input['vedio1']=$filename;
					$upload_success = $files->move($destinationPath, $filename);
					$input['image_text']='';
					$input['image']=$input['image_text'];
					endif;
					
					
					$file = Input::file('vedio2');
					if(isset($file)):
					$destinationPath = 'uploads/video';
					$filename = $file->getClientOriginalName();
					$input['vedio2']=$filename;
					$upload_success = $file->move($destinationPath, $filename);
					$input['image_text']='';
					$input['image']=$input['image_text'];
					endif;
					
					$file = Input::file('vedio3');
					if(isset($file)):
					$destinationPath = 'uploads/video';
					$filename = $file->getClientOriginalName();
					$input['vedio3']=$filename;
					$upload_success = $file->move($destinationPath, $filename);
					$input['image_text']='';
					$input['image']=$input['image_text'];
					endif;
		
		        $images=array_merge($input1,$image);

				$input['image']=serialize($images);
		
				$page->fill($input)->save();
				$page_id['id']=Input::get('id');
				Session::flash('message', 'Page successfully updated!');
		 else:
	
				if(isset($LastSlug->slug)):
					$input['slug'] = "{$slug}-" . ((intval(str_replace("{$slug}-", '', $LastSlug->slug))) + 1);
				else:
					$input['slug'] =str_slug($input['title'], "-");
				endif;	

				$file = Input::file('image');

				$uploadcount = 0;
				$image=array();
				
			
				if($file[0]!=''):
				foreach($file as $fi)
				{
					$destinationPath = 'uploads';
					$filename = $fi->getClientOriginalName();
					$input['image']=$filename;
					$upload_success = $fi->move($destinationPath, $filename);
					$uploadcount ++;
					$image[]=$filename;
				}	
					
					$input['image_text']='';
					$input['image']=$input['image_text'];
	
				endif;
					
					$file = Input::file('vedio1');
					if($file!=''):
						$destinationPath = 'uploads/video';
						$filename = $file->getClientOriginalName();
						$input['vedio1']=$filename;
						$upload_success = $file->move($destinationPath, $filename);
						$input['image_text']='';
						$input['image']=$input['image_text'];
					endif;
					
					
					$file = Input::file('vedio2');
					if($file!=''):
						$destinationPath = 'uploads/video';
						$filename = $file->getClientOriginalName();
						$input['vedio2']=$filename;
						$upload_success = $file->move($destinationPath, $filename);
						$input['image_text']='';
						$input['image']=$input['image_text'];	
						
					endif;
			
				$input['image']=serialize($image);
				
				$page_id=Page::create($input);
				Session::flash('message', 'Page successfully added!');
		 endif;
 
		return redirect('admin/page/edit?id='.$page_id['id']);
		
	}
	
	public function deleteImage()
	{
		$id=$_GET['id'];
		$page = Page::findOrFail(Input::get('page_id'));
		$input1=unserialize($page->image);
		unset($input1[$id]);
		
		if(!$input1==""):
			$inputs['image']=serialize($input1);
		else:
			$inputs['image']='';
		endif;
		
		$page->fill($inputs)->save();
 
		return redirect()->back();
	}
	
	public function deleteVideo1()
	{
		
		$id=$_GET['page_id'];
		$type=$_GET['type'];
		$page = Page::findOrFail(Input::get('page_id'));
		
		if($type=='1'):
			$page['vedio1']="";
		elseif($type=='2'):
			$page['vedio2']="";
		else:
			$page['vedio3']="";
		endif;
		
		$page->fill([$page])->save();
		return redirect()->back();
		
	}
	
	public function deletePage()
	{
		$page = Page::findOrFail(Input::get('id'));
		$page->delete();
		Session::flash('message', 'Page successfully deleted!');
 
		return redirect()->route('page.list');	
	}

}
