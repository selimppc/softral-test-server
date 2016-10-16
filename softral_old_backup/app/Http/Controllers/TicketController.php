<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatTicketRequest;
use App\Http\Requests\CreateAdminRequest3;
use App\Http\Requests\CreateAdminRequest2;
use App\Http\Requests\CreateThread;
use Illuminate\Http\Request;
use LaravelAcl\Authentication\Models\User;
use LaravelAcl\Authentication\Interfaces\AuthenticateInterface;
use App\Tdept;
use App\Tstore;
use App\Thread;
use App\Tpri;
use Input;
use Mail;
use Illuminate\Http\RedirectResponse;
use Redirect;
class TicketController extends Controller {


	protected $auth;
	
	public function __construct(AuthenticateInterface $auth)
	{
		 $this->middleware('guest');
		 $this->auth = $auth;
	}
	
	public function index()
	{
		$data=Tdept::all();
		$data2=Tpri::all();
		$logged_user = $this->auth->getLoggedUser();
		
		return view('tform')->with('data',$data)->with('data2',$data2)->with('logged_user',$logged_user);
	}


	public function adminSetting()
	{
		$data	= Tdept::all();
		$data2	= Tpri::all();
		return view('tadmin_manage')->with('data',$data)->with('data2',$data2);
	}

	public function deleteAdminDept($id)
	{
		$response=Tdept::find($id)->delete();//where('tno', '=', $id)->get(); //find($id);
		if($response){
			return redirect()->back()->with('succ','Success! Department Deleted.');
		}
	}

	public function deleteAdminPri($id)
	{
		$response=Tpri::find($id)->delete();//where('tno', '=', $id)->get(); //find($id);
		if($response){
		return redirect()->back()->with('succ','Success! Priority Deleted.');
		}
	}

	public function adminindex()
	{
		$totu=Tstore::where('tview','=','Unseen')->count();
		$toto=Tstore::where('tstatus','=','Open')->count();
		$totr=Tstore::where('tstatus','=','Resolved')->count();

		$tott=Thread::where('tstatus','=','Unseen')->where('tuserid','<>','1')->count();
		$data=Tstore::all()->sortByDesc("tno");

		$ids = Tstore::all()->sortByDesc("tno")->lists('id');
		foreach ($ids as $idl) 
		{
			$newData[]=Thread::where('tuserid','<>','1')->where('tstatus','=','Unseen')->where('tid', $idl)->count();
		}

		return view('tadmin')->with('data',$data)->with('totu',$totu)->with('toto',$toto)->with('totr',$totr)->with('tott',$tott)->with('newData',$newData);
	}


	public function manage()
	{
		$logged_user = $this->auth->getLoggedUser();
		$newData=array();
		$data=Tstore::where('tuserid', '=', $logged_user->id)->orderBy('id', 'DESC')->get();
		
		$totu=Tstore::where('tview','=','Unseen')->where('tuserid','=',$logged_user->id)->count();
		$toto=Tstore::where('tstatus','=','Open')->where('tuserid','=',$logged_user->id)->count();
		$totr=Tstore::where('tstatus','=','Resolved')->where('tuserid','=',$logged_user->id)->count();
		$ids = Tstore::select('id')->where('tuserid','=', $logged_user->id)->orderBy('id', 'DESC')->lists('id');

		 foreach ($ids as $idl) 
		{
			$newData[]=Thread::where('tuserid','=','1')->where('tstatus','=','Unseen')->where('tid', $idl)->count();
		}
		$tott=Thread::where('tuserid','=','1')->where('tstatus','=','Unseen')->whereIn('tid', $ids)->count();
		return view('tcustomer_manage')->with('data',$data)->with('totu',$totu)->with('toto',$toto)->with('totr',$totr)->with('tott',$tott)->with('newData',$newData);

	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreatTicketRequest $request)	
	{
		$logged_user = $this->auth->getLoggedUser();
		$tnos=Tstore::max('id');

		$tnos=$tnos+1;

		$data=[
				'tno'=>$tnos,
				'tuserid'=>$logged_user->id,
				'tusername'=>Input::get('tusername'),
				'tuseremail'=>Input::get('tuseremail'),
				'tdept'=>Input::get('tdept'),
				'tpri'=>Input::get('tpri'),
				'tmsg'=>Input::get('tmsg'),
				'tstatus'=>'Open',
				'tview'=>'Unseen'
				];

			$response=Tstore::create($data);
			if($response)
			{

			$maildata = array(
				'tid'=>$response['id'],
				'name' => Input::get('tusername'),
				'email' => Input::get('tuseremail'),
				'dept'=>Input::get('tdept'),
				'pri'=>Input::get('tpri'),
					'msg'=>Input::get('tmsg')
			);
			Mail::send('emails.ticket2admin', $maildata, function ($message) {
				$message->from(Input::get('tuseremail'), Input::get('tusername'));
				$message->to(config('app.admin_email'))->subject('New Ticket Generated');

			});
				return redirect()->back()->with('succ','Success! Your Ticket ID : '.$tnos);
			}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
	}

public function viewAdminTicket($id)
	{
		$data=[
				'id'=>$id,
				'tview'=>'Seen'
				];
		$response=Tstore::find($id)->update($data);//where('tno', '=', $id)->get(); //find($id);
		
		$data2=[
				'tid'=>$id,
				'tstatus'=>'Seen'
				];
		$response2=Thread::where('tid', '=', $id)->where('tuserid','<>','1')->update($data2);//where('tno', '=', $id)->get(); //find($id);
		if($response)
		{
			return Redirect::to('admin-ticket-view/'.$id.'/adminview');//->with('data',$data2);
		}
	}

	public function updateAdminTicket($id)
	{
		$data=[
				'id'=>$id,
				'tstatus'=>Input::get('tstatus')
				];
		$response=Tstore::where('id', '=', $id)->update($data);//where('tno', '=', $id)->get(); //find($id);
		if($response)
		{
			return redirect()->back()->with('succ','Success! Ticket Status updated.');
		}	
	}


	public function viewAdminThread($id)
	{
		$data=Tstore::find($id);//where('tno', '=', $id)->get(); //find($id);

		$data2=Thread::where('tid', '=', $id)->orderBy('id', 'ASC')->get(); 
		return view('admin-thread')->with('data',$data)->with('data2',$data2);
	}


public function viewTicket($id)
	{
		$data2=[
			'tid'=>$id,
			'tstatus'=>'Seen'
			];

	$response2=Thread::where('tid', '=', $id)->where('tuserid','=','1')->update($data2);
	$data=Tstore::find($id);
	$data2=Thread::where('tid', '=', $id)->orderBy('id', 'ASC')->get(); 
	return view('customer-thread')->with('data',$data)->with('data2',$data2);

	}


	public function storeAdmin(CreateThread $r6, $id)	
	{
				$edata=Tstore::find($id);

				$data=[
						'tid'=>$id,
						'tuserid'=>'1',
						'tusername'=>'Admin',
						'tuseremail'=>config('app.admin_email'),
						'tmsg'=>Input::get('tmsg'),
						'tstatus'=>'Unseen'
						];
						$response=Thread::create($data);
						if($response)
						{

				$maildata = array(
					'tid'=>$id,
					'name' => 'Admin',
					'email' => config('app.admin_email'),
						'msg'=>Input::get('tmsg')


				);
				
				Mail::send('emails.ticket2customer', $maildata, function ($message) use ($edata) {

					$message->from(config('app.admin_email'), 'Admin');   // shazzadul.hussain@gmail.com is the admin email id , Admin is the admin name
					$message->to($edata->tuseremail)->subject('Reply to the Ticket sent to Softral.com');

				});
				return redirect()->back()->with('succ','Success! Your reply has sent');
			}
	}	



public function storeDept(CreateAdminRequest3 $r2)
{
	$data=[
			
			'deptname'=> Input::get('deptname')
			];
			$response=Tdept::create($data);
			if($response)
			{
				return redirect()->back()->with('succ','Success! New Department added.');
			}


	}	

	public function storePri(CreateAdminRequest2 $r)	
	{
		$data=[
				'priname'=> Input::get('priname')
				];
				$response=Tpri::create($data);
				if($response)
				{

				return redirect()->back()->with('succ','Success! New Priority added.');
				}
	}	



public function storeCustomer(CreateThread $r4, $id)	
	{
		$edata=Tstore::find($id);
		$data=[
			'tid'=>$id,
			'tuserid'=> $edata->tuserid,
			'tusername'=> $edata->tusername,
			'tuseremail'=>$edata->tuseremail,
			'tmsg'=>Input::get('tmsg'),
			'tstatus'=>'Unseen'
			];
			$response=Thread::create($data);
			if($response)
			{
    $maildata = array(
    	'tid'=>$id,
        'name' => $edata->tusername,
        'email' => $edata->tuseremail,
			'msg'=>Input::get('tmsg')


    );
    Mail::send('emails.ticket2admin2', $maildata, function ($message) use ($edata) {

        $message->from($edata->tuseremail, $edata->tusername);   // shazzadul.hussain@gmail.com is the admin email id , Admin is the admin name
		$send_mail=config('app.admin_email');
        $message->to($send_mail,'Admin')->subject('Reply to the Ticket sent to Softral.com');
    });

	return redirect()->back()->with('succ','Success! Your reply has sent');
			}


	}	
	
	public function delTicketThread($id)
    {
			$response=Thread::where('tid','=',$id)->delete();
			$response2=Tstore::find($id)->delete();
			if($response2)
			{
			 return redirect()->back()->with('succe','Success! Ticket ID: '.$id.' has been deleted.');
			}
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
