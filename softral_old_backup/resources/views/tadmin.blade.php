@extends('laravel-authentication-acl::client.layouts.ticket')
@section('title')
Softral - Admin tickets
@stop
@section('content')
<div class="row content" >
	<div id="sidebar-collapse" class="col-lg-3 content-left col-sm-3 col-lg-2 sidebar" style='display:block'>
	<br/>
		<ul class="nav menu well well-sm">
			<li class="active"><a href="customer-service"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Manage Ticket</a></li>

			<li><a href="admin-manage-setting"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg>Manage Setting</a></li>
		<li><a href="admin/users/list"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg>Admin Panel</a></li>
			<li role="presentation" class="divider"></li>
		</ul>

	</div><!--/.sidebar-->
		
	<div class="col-sm-10 col-lg-10  main">				
		<br/>
		 @if(Session::has('succe'))
    <br/>
    <div class="row">
     <div class="col-lg-12">
    
      <div class="alert bg-success" role="alert">
       <svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> <font size="4"> {{ Session::get('succe') }} </font>
      </div>
    
     </div>
    </div><!--/.row--> 
      @endif
			<div class="row">

			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-orange panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
					<svg class="glyph stroked download"><use xlink:href="#stroked-download"/></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">{{$totu}}</div>
							<div class="text-muted">New Tickets</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
						<svg class="glyph stroked two messages"><use xlink:href="#stroked-two-messages"/></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">{{$tott}}</div>
							<div class="text-muted">New Replies</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-red panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked open letter"><use xlink:href="#stroked-open-letter"/></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">{{$toto}}</div>
							<div class="text-muted">Open Tickets</div>
						</div>
					</div>
				</div>
			</div>
		<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked email"><use xlink:href="#stroked-email"/></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">{{$totr}}</div>
							<div class="text-muted">Resloved</div>
						</div>
					</div>
				</div>
			</div>

		</div><!--/.row-->
		</div>

		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	
		<br/>
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-info">
					<div class="panel-heading"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Manage Tickets</div>
					<div class="panel-body">
						  <table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
           <thead>
           <tr>
           
            <th data-field="sl" data-sortable="false">Sl No</th>
            <th data-field="id"  data-sortable="true">Ticket ID</th>
            <th data-field="dept" data-sortable="false">Department</th>
             <th data-field="pri" data-sortable="false">Priority</th>
             <th data-field="created" data-sortable="false">Created</th>
              <th data-field="status" data-sortable="false">Status</th>
             <th data-field="option" data-sortable="false">View</th>
                <th data-field="option2" data-sortable="false">Delete</th>
           </tr>
           
             </thead> 
                <?php $sl=1; ?>
              @foreach($data as $row)
            <tr>
           
            <td ><?php echo  $sl;?></td>
            <td data-field="id"  data-sortable="true">{{$row->id}} @if($newData[$sl-1]>0) <span class="caret" style="color:green;font-size:10px">Replies&nbsp;:&nbsp;{{$newData[$sl-1]}} @endif</span></td>
            <td data-field="dept" data-sortable="true">{{$row->tdept}}</td>
             <td data-field="pri" data-sortable="true">{{$row->tpri}}</td>
             <td data-field="created" data-sortable="true">{{$row->created_at}}</td>
              <td data-field="status" data-sortable="true">

             {{$row->tstatus}} 
             @if($row->tview=="Unseen")
               <span class="caret" style="color:red;font-size:10px">{{$row->tview}}</span>
             @else
               <span class="caret" style="font-size:10px">{{$row->tview}}</span>
             
               @endif


              </td>


              <td data-field="option" data-sortable="true"><a href="{{route('viewAdmin',$row->id)}}" class="btn btn-success btn-md pull-left">View</a>
            </td><td data-field="option2" data-sortable="true">
             <a href="{{route('deleteTicket',$row->id)}}" onclick="return confirm('Are you sure you want to Delete Ticket and Replies?')"  class="btn btn-danger btn-sh pull-middle">Delete</a>
              </td>



           </tr>  <?php $sl=$sl+1;?>
              @endforeach
          
      </table>
					</div>
				</div>
			</div>
		</div><!--/.row-->	
	
		
	</div><!--/.main-->
								
		
	</div>	<!--/.main-->
	</div>	<!--/.main-->

@stop