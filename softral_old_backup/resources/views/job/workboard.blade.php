@extends('laravel-authentication-acl::client.layouts.base')
@section('title')
Softral - Workboard  

@stop
@section('content')
<div class="row content">
    {{--@include('laravel-authentication-acl::client.layouts.sidebar')--}}
    <div class="row1 col-xs-12 col-sm-12 col-md-12 col-lg-12">


        <div class="panel panel-default">
            <div class="panel-body">
                <h4 style="margin:0px;text-align:center"><strong>Workboard</strong></h4>
            </div>
        </div>

    </div>
    <div id="content">
        {!! $tablecontent !!}
    </div>
</div>
<div class="modalajaxwait"></div>
{!! HTML::script('//tinymce.cachefly.net/4.2/tinymce.min.js') !!}
<script type='text/javascript'>
   
   
    var jobid = 0;
    var proposal_id = '<?php echo $_GET['id']; ?>';
	var assidForEmployee = "";
    tinymce.init({selector: 'textarea'});
    
	 function editEmployeeComments(assignmentid, jobid) {
        assidForEmployee = assignmentid;
        jobid = '<?php echo $job_id;?>';
         $body = $("body");
         $body.addClass("loading");
        $.post("{!! URL::route('workboard.employeecomments') !!}", {assignmentid: assignmentid}, function(result) {
            // $("#txtcommentstext").val(result);
             $body.removeClass("loading");
            tinyMCE.get('txtassignmenttext').setContent(result);
            $('#modal_addassignment').modal('show');
        });
    }	 
	
	function addassignment(jobidparam) {
        jobid = jobidparam;
		assidForEmployee = "";
		
        tinyMCE.get('txtassignmenttext').setContent("");
        $('#modal_addassignment').modal('show');
    }
	
	
	
	function replyEmployeeComments(assignmentid, jobid) {
        assidForEmployee = assignmentid;
        jobid = jobid;
         $body = $("body");
         $body.addClass("loading");
        $.post("{!! URL::route('workboard.replyAssignment') !!}", {assignmentid: assignmentid}, function(result) {
            // $("#txtcommentstext").val(result);
             $body.removeClass("loading");
            tinyMCE.get('txtassignmenttext').setContent(result);
            $('#modal_replyassignment').modal('show');
        });
    }	
	
	function viewEmployeeComments(assignmentid, jobid) {
        assidForEmployee = assignmentid;
		
        jobid = jobid;
         $body = $("body");
         $body.addClass("loading");
        $.post("{!! URL::route('workboard.freelancercomments') !!}", {condition:'viewall',proposal_id:proposal_id,assignmentid: assidForEmployee}, function(result) {
             $("#viewalltxtcommentstext").html(result);
             $body.removeClass("loading");
           // tinyMCE.get('viewalltxtcommentstext').setContent(result);
            $('#modal_viewallassignment').modal('show');
        });
    }

    function saveAssignment() {
        //  var txtassignmenttext=$("#txtassignmenttext").val();
        var txtassignmenttext = tinyMCE.get('txtassignmenttext').getContent();
        if (txtassignmenttext == "") {
            return false;
        }
		
        $body = $("body");
        $body.addClass("loading");
		
        $.post("{!! URL::route('workboard.saveassignment') !!}", {jobid: jobid,proposal_id:proposal_id, assignmenttext: txtassignmenttext,assid: assidForEmployee}, function(result) {
            $("#content").html(result);
              $body.removeClass("loading");
            $('#modal_addassignment').modal('hide');
        });
    }  
	
	function replyAssignment() {
        //  var txtassignmenttext=$("#txtassignmenttext").val();
        var txtassignmenttext = tinyMCE.get('txtreplyassignmenttext').getContent();
        if (txtassignmenttext == "") {
            return false;
        }
		
        $body = $("body");
        $body.addClass("loading");
		
        $.post("{!! URL::route('workboard.replyAssignment') !!}", { assignmenttext: txtassignmenttext,proposal_id:proposal_id,assid: assidForEmployee}, function(result) {
           // $("#content").html(result);
              $body.removeClass("loading");
            $('#modal_replyassignment').modal('hide');
			alert('You have successfully sent reply to the freelancer');
        });
    }	
	
    function applyStatusChange(currCntrl, colname, assID, mode, jobid) {
         $body = $("body");
        colval = "null";
        if ($(currCntrl).is(':checked')) {
            if (mode == "disapprove") {
                colval = "0";
            } else if (mode == "approve") {
                colval = "1";
            }
        }
         $body.addClass("loading");
        $.post("{!! URL::route('workboard.changestatus') !!}", {jobid: jobid,proposal_id:proposal_id, colname: colname, assID: assID, colval: colval}, function(result) {
            $("#content").html(result);
             $body.removeClass("loading");
            $('#modal_addassignment').modal('hide');
        });
    }
    var assidForFreelancer = "";
    var jobidForfreelancer = "";
    function addFreeLancerComments(assignmentid, jobid) {
        assidForFreelancer = assignmentid;
        jobidForfreelancer = jobid;
         $body = $("body");
         $body.addClass("loading");
        $.post("{!! URL::route('workboard.freelancercomments') !!}", {assignmentid: assignmentid,proposal_id:proposal_id}, function(result) {
            // $("#txtcommentstext").val(result);
             $body.removeClass("loading");
            tinyMCE.get('txtcommentstext').setContent(result);
            $('#modal_addfreelancercomments').modal('show');
        });
    }
	
	
    function saveFreelancerComments() {
        var txtcommentstext = tinyMCE.get('txtcommentstext').getContent();
        if (txtcommentstext == "") {
            return;
        }
         $body = $("body");
         $body.addClass("loading");
        $.post("{!! URL::route('workboard.savefreelancercomments') !!}", {commentstext: txtcommentstext,proposal_id:proposal_id, assid: assidForFreelancer, jobid: jobidForfreelancer}, function(result) {
             $body.removeClass("loading");
            $("#content").html(result);
            $('#modal_addfreelancercomments').modal('hide');
        });
    }
</script>

<div id="modal_addassignment" class="modal fade">
    <div class="modal-dialog" style="margin-top: 110px !important;" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add/Edit Assignment</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="txtassignmenttext">Assignment Text</label>
                        <textarea class="form-control" name="txtassignmenttext" id="txtassignmenttext" rows="3"></textarea>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onclick="saveAssignment()" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="modal_replyassignment" class="modal fade">
    <div class="modal-dialog" style="margin-top: 110px !important;" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Reply to comment</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="txtassignmenttext">Reply text</label>
                        <textarea class="form-control" name="txtreplyassignmenttext" id="txtreplyassignmenttext" rows="3"></textarea>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onclick="replyAssignment()" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="modal_addfreelancercomments" class="modal fade">
    <div class="modal-dialog" style="margin-top: 110px !important;" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Freelancer Comments</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="txtcommentstext">Comments Text</label>
                        <textarea class="form-control" name="txtcommentstext" id="txtcommentstext" rows="3"></textarea>
                    </div>




                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onclick="saveFreelancerComments()" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="modal_viewallassignment" class="modal fade" style='z-index:99999'>
    <div class="modal-dialog" style="margin-top: 110px !important" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">View Freelancer Comments</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                       <div id='viewalltxtcommentstext'></div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@stop
