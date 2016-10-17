<?php namespace App\Http\Controllers;

use App\Http\Models\Category;
use App\Http\Models\Skill;
use App\Http\Models\Page;
use App\Http\Models\Ad;
use LaravelAcl\Authentication\Models\ProfileField;
use App\Http\Models\Contract;
use LaravelAcl\Authentication\Models\User;
use App\Http\Models\Feedback;
use App\Http\Models\Proposal;
use App\Http\Models\Savejob;
use App\Http\Models\Notifications;
use App\Http\Models\Job;
use App\Http\Models\Money;
use App\Http\Models\Credit;
use Illuminate\Http\Request;
use LaravelAcl\Authentication\Models\UserProfile;
use View, Input, Redirect, App, Config,Session,Mail;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination;
use Illuminate\Pagination\LengthAwarePaginator;
use LaravelAcl\Authentication\Interfaces\AuthenticateInterface;

use DB;



class WelcomeController extends Controller {

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

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(AuthenticateInterface $auth)
	{
		$this->middleware('guest');
		$this->auth = $auth;
	}
	
	public function testhome(){
		
		return view::make('vendor.laravel-authentication-acl.client.layout.home_page');
		
		
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$about = Page::where('slug','home-page-content')->first();
		$hexa_gonal_background = Page::where('id',21)->first();
		$logged_user = $this->auth->getLoggedUser();
		
		$freelancers = User::has('user_profile_avtar.profile_field_type_seller')->with('user_profile_avtar.profile_field_type_tagline')->where('activated',1)->orderByRaw("RAND()")->limit(28)->get();
		
		$employeer_news = Page::with('children_hexa')->where('id',85)->first();
		$freelancer_news = Page::with('children_hexa')->where('id',80)->first();
		
		return view::make('main_welcome')->with([
		    'about'   => $about ,
            'hexa_gonal_background'=>$hexa_gonal_background,
            'freelancers'   => $freelancers,
            'employeer_news'=>$employeer_news,
            'freelancer_news'=>$freelancer_news,
            'logged_user'=>$logged_user
        ]);
	}
	
	public function home($skill=null,$category=null)
	{
		if(Input::get('sorting')):
			$sorting= explode('-',Input::get('sorting'),3);
			if($sorting[0]=='budget'):
				$sorting_keyword=$sorting[0];
				$sorting_value=$sorting[1];
			else:
				$sorting_keyword=$sorting[0].'_'.$sorting[1];
				$sorting_value=$sorting[2];
			endif;
		else:
			$sorting_keyword='ID';
			$sorting_value='DESC';
		endif;
		
		$q = Input::get('q');
		$skill_q='';
		
		if(Input::get('min')):
			$min=Input::get('min');
		else:
			$min=0;
		endif;
		
		if(Input::get('max')):
			$max=Input::get('max');
		else:
			$max=100000;
		endif;
		
		if(Input::get('status')):
			$status_array=array(2);
		else:
			$status_array=array(0);
		endif;
		
		$budget_array=array($min,$max);
		
		$max = Input::get('max');
		$min = Input::get('min');
		$category = \Request::segment(2);
		
		$subcategories=array();
		if($category!=null && $skill=='category'):
			$pcategories = Category::with('children')->where('slug',$category)->first();
			if(!empty($pcategories)):
					array_push($subcategories,$pcategories->id);
				foreach($pcategories->children as $subcategory):
					array_push($subcategories, $subcategory->id);
				endforeach;
			endif;
		endif;
		
		if($category!=null && $skill=='skill'):
			$skill_name = Skill::where('slug',$category)->first();
			$skill_q=$skill_name->skill;
		endif;
		
		if(Input::get('search_type')=='jobs' || Input::get('search_type')==''):
			$jobs = Job::with('categories.parent_get','user','children')->subCategory($subcategories)->where(function($query) use ($q,$budget_array,$skill_q,$status_array) {
					/** @var $query Illuminate\Database\Query\Builder  */
					return $query->where('project_name', 'LIKE', '%'. $q .'%')
						->Where('skill_name','LIKE', '%'. $skill_q .'%')
						->whereIn('job_close', $status_array)
						->WhereBetween('budget', $budget_array)
						->Where('status', 1);
				})->orderBy($sorting_keyword, $sorting_value)->paginate(10); 
			
			$jobs->appends(array('sorting'=>Input::get('sorting'),'status'=>Input::get('status'),'min'=>$min,'max'=>$max,'q' => Input::get('q')));
		elseif(Input::get('search_type')=='freelancer'):
						$jobs = UserProfile::ByUseractivate(1)->where(function($query) use ($q) {
							return $query->where('first_name', 'LIKE', '%'. $q .'%')
								->orWhere('last_name','LIKE', '%'. $q .'%');
							})->paginate(10); 
			
				$jobs->appends(array('search_type'=>Input::get('search_type'),'q' => Input::get('q')));
		endif;
		//dd($freelancer);exit;
		
		if($category!=null && $skill=='category'):
			$jobs->setPath('');
			$category=$pcategories->category;
		endif;
		
		if($category!=null && $skill=='skill'):
			$jobs->setPath('');
			$category=$skill_name->skill;
		endif;
		
		return view::make('welcome')->with([ 'jobs'   => $jobs,'category'=>$category,'skill'=>ucwords($skill) ]);
	}
	
	public function members(){
		
		if((Input::get('search_type'))):
			$user_type = Input::get('search_type');
		else:
			$user_type='';
		endif;
		
		if((Input::get('skill'))):
			$skill = Input::get('skill');
		else:
			$skill='';
		endif;
		
		if((Input::get('q'))):
			$q = Input::get('q');
			
			$l_name = explode(" ", $q);
			$q = $l_name[0];
			$la_name='';
			if(isset($l_name[1])):
				$la_name=$l_name[1];
			endif;
		else:
			$q='';
			$la_name='';
		endif;
		
		if((Input::get('l'))):
			$l = Input::get('l');
		else:
			$l='';
		endif;
	
		
		$skills = Skill::get();
		$options = array();

		$users = UserProfile::ByUseractivate(1)->ByUsertype($user_type)->ByUserskill($skill)->where(function($query) use ($q,$l,$la_name) {
							return $query->where('first_name', 'LIKE', '%'. $q .'%')
								->Where('last_name','LIKE', '%'. $la_name .'%')
								->Where('user_id','LIKE', '%'. $l .'%');
							})->paginate(10); 
		$users->setPath('');	
		$users->appends(array('search_type'=>Input::get('search_type'),'q' => Input::get('q')));
				
		return view::make('members')->with([ 'jobs'   => $users,'skills'=>$skills ]);
	}
	
	public function MyProposals(){
		$logged_user = $this->auth->getLoggedUser();
		
		if($logged_user->user_profile[0]->profile_field_type->value!='Seller' && $logged_user->user_profile[0]->profile_field_type->value!='Both'):
			return view('laravel-authentication-acl::client.exceptions.404');
		endif;
		
		$proposals = Proposal::with('user','user_profile.profile_field','job','contract')->where("user_id",  $logged_user->id)->orderBy('id','desc')->paginate(10);
		$proposals->setPath('');
		//dd($proposals);exit;
		return view::make('proposal.my_proposals')->with([ 'proposals'   => $proposals]);
	}
	
	public function jobProposals(){
		$logged_user = $this->auth->getLoggedUser();
		$job = Job::with('contract')->where("user_id",  $logged_user->id)->where("id",  Input::get('job-id'))->first();
		if(empty($job)):
						return view('laravel-authentication-acl::client.exceptions.404');
		endif;
		$proposals = Proposal::with('user','user_profile.profile_field','job')->where("job_id",  Input::get('job-id'))->paginate(10);
		
		$no_more=0;
		if(isset($job->contract) && ($job->contract->cancel_contract==1 || $job->contract->ended_contract==1)):
			$no_more=1;
		endif;
		
		$proposals->setPath('');
		
		return view::make('proposal.job_proposals')->with([ 'proposals'   => $proposals,'job'=>$job,'no_more'=>$no_more]);
	}
	
	public function saveJobs(){
		$logged_user = $this->auth->getLoggedUser();
		$save_jobs = Savejob::with('job')->where("user_id",  $logged_user->id)->where("job_id",  "!=","0")->paginate(10);
		$save_jobs->setPath('');
		
		return view::make('job.my_savejobs')->with([ 'save_jobs'   => $save_jobs]);
	}
	
	public function saveUsers(){
		$logged_user = $this->auth->getLoggedUser();
		$save_jobs = Savejob::with('user')->where("user_id",  $logged_user->id)->where("save_user_id",  "!=","0")->paginate(10);
		$save_jobs->setPath('');
		
		return view::make('job.my_saveusers')->with([ 'save_users'   => $save_jobs]);
	}
	
	public function myJobs(){
		$logged_user = $this->auth->getLoggedUser();
		
		if($logged_user->user_profile[0]->profile_field_type->value!='Buyer' && $logged_user->user_profile[0]->profile_field_type->value!='Both'):
			return view('laravel-authentication-acl::client.exceptions.404');
		endif;
		
		$my_jobs = Job::with('user','proposal_selected','contract','user_money','financial_credit_card')->where("user_id",  $logged_user->id)->orderBy('created_at', 'desc')->paginate(10);
		$my_jobs->setPath('');
		//dd($my_jobs);
		return view::make('job.my_jobs')->with([ 'my_jobs'   => $my_jobs,'amount'=>0,'credit_methods'=>0]);
	}
	
	public function myContracts(){
		$logged_user = $this->auth->getLoggedUser();
		
		if($logged_user->user_profile[0]->profile_field_type->value!='Buyer' && $logged_user->user_profile[0]->profile_field_type->value!='Both'):
			return view('laravel-authentication-acl::client.exceptions.404');
		endif;
		
		$my_jobs = Contract::with('job','proposal','proposal_selected')->JobUserid($logged_user->id)->orderBy('created_at', 'desc')->paginate(10);
		$my_jobs->setPath('');
		
		return view::make('job.my_contracts')->with([ 'my_jobs'   => $my_jobs]);
	}
	
	public function runningJobs(){
		$logged_user = $this->auth->getLoggedUser();
		
		if($logged_user->user_profile[0]->profile_field_type->value!='Seller' && $logged_user->user_profile[0]->profile_field_type->value!='Both'):
			return view('laravel-authentication-acl::client.exceptions.404');
		endif;
		
		$my_jobs = Contract::with('user','job','proposal')->ProposalUserid($logged_user->id)->orderBy('id', 'desc')->paginate(10);
		$my_jobs->setPath('');
		//dd($my_jobs);exit;
		return view::make('job.my_runningjobs')->with([ 'save_jobs'   => $my_jobs]);
	}
	
	public function myAds(){
		$logged_user = $this->auth->getLoggedUser();
		$my_ads = Ad::with('user','messages')->where("user_id",  $logged_user->id)->orderBy('created_at', 'desc')->paginate(10);
		$my_ads->setPath('');
		//dd($proposals);exit;
		return view::make('ad.my_ads')->with([ 'my_ads'   => $my_ads]);
	}
	
	public function userProfileslug($slug){
		
		$profile = UserProfile::with('profile_field','jobs')->where('slug',$slug)->first();
		$logged_user = $this->auth->getLoggedUser();
		$save_user = Savejob::where("save_user_id", $profile['user_id'])->where("user_id", $logged_user->id)->first();
		$working_jobs = Proposal::with('contract')->where("user_id", $profile->user_id)->orderBy('id', 'desc')->get();
		
		$tag_line = ProfileField::where('profile_id',$profile->id)->where('profile_field_type_id',4)->first();
		$degree = ProfileField::where('profile_id',$profile->id)->where('profile_field_type_id',10)->first();
		$education = ProfileField::where('profile_id',$profile->id)->where('profile_field_type_id',6)->first();
		$feedback_freelancer = Feedback::where("freelancer_id",  $profile->user_id)->where('freelancer_rating','!=','')->avg('freelancer_rating');
		$feedback_employee = Feedback::where("employee_id",  $profile->user_id)->where('employee_rating','!=','')->avg('employee_rating');
		
		return view::make('user.profile')->with([ 'profile'   => $profile,'tagline'=>$tag_line['value'],'feedback_freelancer'=>$feedback_freelancer,'feedback_employee'=>$feedback_employee,'user'=>$logged_user,'save_user'=>$save_user, 'working_jobs'=>$working_jobs,'degree'=>$degree,'education'=>$education]);
	}
	
	public function user_Agreement(){
		$logged_user = $this->auth->getLoggedUser();
		if($logged_user->user_profile[0]->profile_field_type->value!='Buyer' && $logged_user->user_profile[0]->profile_field_type->value!='Both'):
			//return view('laravel-authentication-acl::client.exceptions.404');
		endif;
		
		$my_jobs = Contract::with('job','proposal','proposal_selected')->JobUserid($logged_user->id)->orderBy('created_at', 'desc')->paginate(10);
		$my_jobs->setPath('');
		
		$money = Money::where('user_id',$logged_user->id)->orderBy('id','desc')->first();
		if(isset($money->total_amount)):
			$money= round($money->total_amount,2);
		else:
			$money=0.00;
		endif;
		$credit_accounts = Credit::where('user_id',$logged_user->id)->get();
	
		return view::make('job.user_Agreement')->with([ 'my_jobs'   => $my_jobs, 'money' => $money, 'amount'=>0,'credit_methods'=>0, 'credit_accounts'   => $credit_accounts]);
	}
	
	public function viewNotification()
	{
		$notify='';
		
		$logged_user = $this->auth->getLoggedUser();
		
		if(!empty($logged_user->id)):
			$notify = Notifications::with('user', 'job', 'proposal')
			->where("user_id", $logged_user->id)
			->orderBy('id', 'desc')->paginate(5);
			$notify->setPath('');
		endif;
	
		return view::make('job.viewNotification')->with(['notify'=>$notify ]);
	}
	
	public function hidenotification()
	{
		$logged_user = $this->auth->getLoggedUser();
		
		DB::table('notification')
            ->where('status', 1)
			->where("user_id", $logged_user->id)
            ->update(['status' => 0]);
	}
	
	public function GetPages($slug){
		$page = Page::with('children')->where('slug',$slug)->first();
		//dd($page);exit;
		return view::make('page')->with([ 'page'   => $page,'slug'=>$slug]);
	}
	
	public function ContactUs(){
		$page = Page::with('children_hexa')->where('id',3)->first();
		
		return view::make('contact')->with([ 'page'   => $page]);
	}
	
	public function sendMessage(Request $request){
		$input = $request->all();
		$user = User::with('user_profile')->where('id',$input['user_id'])->first();
		$logged_user = $this->auth->getLoggedUser();
		
		$emails = $user['email'];
		 Mail::send('emails.send_message', ['data' => $user,'logged_in'=>$logged_user], function($message) use ($emails) {
				$message->to($emails, 'From Softral - Got message')->subject('Softral - Got Message');
			});
		Session::flash('message', 'You have successfully sent a message to freelancer.');
		
		return redirect(url('/').'/chat/index.php?invite_id='.$user['id'].'&success');
	}
	
	public function editable(Request $request){
		
		$input = $request->all();
		
		$content= $_POST['content'];
		$id=$_POST['id'];
		
		$pages = Page::findOrFail($id);
		$pages->content=$content; 	
		$pages->save();
		
	}
	
	public function sendEmail(Request $request){
		$input = $request->all();
		
		$emails = ['admin@softral.com', 'mednoor1@gmail.com'];
		 Mail::send('emails.contact_message', ['data' => $input], function($message) use ($emails) {
				$message->to($emails, 'From Softral - Contact Us')->subject('Softral - Got Message');
			});
		Session::flash('message', 'You have successfully sent a message to Softral.');
		return redirect('/pages/contact-us');
	}
	
	public function errors(){
		
		return view::make('errors/404');
	}
	public function get_freelancers(Request $request)
	{
		$freelancers = User::has('user_profile_avtar.profile_field_type_seller')
							->with('user_profile_avtar.profile_field_type_tagline')
							->where('activated',1)
							->orderByRaw("RAND()")
							->limit(28)->get();
		//$res = json_encode($freelancers);
		$html = $cats = '';
		$j = 0;
		foreach($freelancers as $freelancer)
		{
			if( $freelancer->user_profile[0]->avatar == '' ) continue;
			$url 		= url('/user/profile/' . $freelancer->user_profile[0]->slug);
			$title 		= $freelancer->user_profile[0]->first_name;
			$img_url 	= url('/') . "/timthumb.php?src=".url('/images') . "/{$freelancer->user_profile[0]->slug}.jpg&w=114&h=114&q=100";
			$error_url 	= url('/') .'/timthumb.php?src='. url('/images'). '/admin.jpg&w=114&h=114&q=100';
			if($j==0 || $j==1 || $j==3 || $j==6 || $j==10 || $j==15 || $j==21)
			{
				$cats .= '<div class="pusher2">';
			}
			
			$cats .= '<a href="'.$url.'" title="'.$title.'">';
			if($j != 2 && $j != 1)
				$cats .= '<li class="pusher'.($j + 1).'">';
			else
				$cats .= '<li>';
			$cats .= '<div>';
			
			$cats .= '<img src="'.$img_url.'" onerror="this.src = \''.$error_url.'\';" />'.
							'<h1>' . $freelancer->user_profile[0]->first_name.'</h1>'.
							'<p>' . 
								(isset($value->user_profile[0]->profile_field_type_tagline->value) ? 
									$freelancer->user_profile[0]->profile_field_type_tagline->value : 
									'Freelancer') . '</p>'.
					'</div></li></a>';
			if($j==0 || $j==2 || $j==5 || $j==9 || $j==14 || $j==20 || $j==27)
			{
				$cats .= '</div>';
			}
			
			$j++;
		}
		foreach($freelancers as $freelancer)
		{
			if( isset($freelancer->user_profile[0]->profile_field_type_tagline->value) 
				&& $freelancer->user_profile[0]->avatar != '')
			{
				$url 		= url('/user/profile/' . $freelancer->user_profile[0]->slug);
				$title 		= $freelancer->user_profile[0]->first_name;
				$img_url 	= url('/') . "/timthumb.php?src=".url('/images') . "/{$freelancer->user_profile[0]->slug}.jpg&w=114&h=114&q=100";
				$error_url 	= url('/') .'/timthumb.php?src='. url('/images'). '/admin.jpg&w=114&h=114&q=100';
				
				$html .= "<a href=\"$url\" title=\"$title\">".
							"<div class=\"comb\">".
								"<img src=\"$img_url\" onerror=\"this.src = '$error_url';\" />".
								"<span>{$freelancer->user_profile[0]->first_name} <br/><br/>".
									"<p>{$freelancer->user_profile[0]->profile_field_type_tagline->value}</p>".
								"</span>" .
							"</div>".
						"</a>";
				
				
			}
		}  
		
		return response()->json(array('status' => 'ok', 'html' => $html, 'cats' => $cats));
	}
	
}
