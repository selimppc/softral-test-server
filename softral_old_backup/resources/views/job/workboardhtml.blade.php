<?php
use Carbon\Carbon;
$created = new Carbon();
if (isset($projectowner[0]) == FALSE  ||  isset($projectfreelancer[0]) == FALSE) {
?>
    <div class="row1 col-xs-12 col-sm-12 col-md-12 col-lg-12">


        <div class="panel panel-default">
            <div class="panel-body">
                <h4 style="margin:0px;text-align:center"><strong>You are not allowed to view workbard of this project</strong></h4>
            </div>
        </div>

    </div>
<?php
}else{
if ($projectowner[0]->user_id != $logged_user->id && $projectfreelancer[0]->user_id != $logged_user->id) {
    ?>
    <div class="row1 col-xs-12 col-sm-12 col-md-12 col-lg-12">


        <div class="panel panel-default">
            <div class="panel-body">
                <h4 style="margin:0px;text-align:center"><strong>You are not allowed to view workbard of this project</strong></h4>
            </div>
        </div>

    </div>
    <?php
}else{
?>

<div class="row">
    <div class="col-lg-12">
        <center>  <table class="workboardtable">
                <tr>
                    <th style="width:30px !important;  "></th>
                    <th>Employer: {!! $projectowner[0]->first_name !!}   {!! $projectowner[0]->last_name !!} </th>
                    <th colspan="4">
                        <strong>WorkBoard</strong> Job Title: {!! $projectowner[0]->project_name !!} (ID={!! $projectowner[0]->id !!})
                    </th>
                    <th>Freelancer : {!! $projectfreelancer[0]->first_name !!}   {!! $projectfreelancer[0]->last_name !!}</th>
                </tr> 
                <tr>
                    <td style="width:30px !important;"></td> 
                    <td>Employer Assignments</td>
                    <td colspan="2">
                        Employer
                    </td>
                    <td colspan="2">
                        Freelancer
                    </td>
                    <td>
                        Freelancer Comments
                    </td>
                </tr>
                <tr>
                    <td style="width:30px !important;"></td> 
                    <td></td>
                    <td>Approve</td>
                    <td>Disapprove</td>
                    <td>Complete</td>
                    <td>Incomplete</td>
                    <td></td>
                </tr>
                <?php $count = 0; ?>
                @foreach($assignments as $ass)
                <?php
                $count++;
                $isapprove = $ass->employer_status;
                $iscomplete = $ass->freelancer_status;
                $approve_checked = "";
                $Disapprove_check = "";
                if (isset($isapprove) == FALSE) {

                    $approve_checked = "";
                    $Disapprove_check = "";
                } else if ($isapprove == TRUE) {
                    $approve_checked = "checked";
                    $Disapprove_check = "";
                } else if ($isapprove == FALSE) {
                    $approve_checked = "";
                    $Disapprove_check = "checked";
                }

                $complete_checked = "";
                $incomplete_check = "";
                if (isset($iscomplete) == FALSE) {

                    $complete_checked = "";
                    $incomplete_check = "";
                } else if ($iscomplete == TRUE) {
                    $complete_checked = "checked";
                    $incomplete_check = "";
                } else if ($iscomplete == FALSE) {
                    $complete_checked = "";
                    $incomplete_check = "checked";
                }
                ?>
                <tr>
                    <td style="width: 2%;"><?php echo $count; ?></td> 
                    <td>
                        <div style="overflow:auto; height:100px; ">
						<?php if ($projectowner[0]->user_id == $logged_user->id) { 
						?>
						  <b> <a href="#" onclick="editEmployeeComments('{!! $ass->id !!}', '{!! $ass->job_id !!}');
                                            return false;" style='color:#d9534f'>Edit Assignment</a></b>
						<?php } ?>				
                          <span style="float:right;padding: 0 4px 0px 0px;"><?php echo $created::createFromFormat('Y-m-d H:i:s', $ass->updated_datetime)->format('M d, Y \of h:i A') ?></span>  {!! $ass->asignment_title !!}<br/>
							<?php if ($projectowner[0]->user_id == $logged_user->id) { ?>
							<b><a href="javascript:void(0)" onclick="replyEmployeeComments('{!! $ass->id !!}', '{!! $ass->job_id !!}');
                                            return false;" style='color:#d9534f'>Send Reply</a></b><br/>
											<b><a href="javascript:void(0)" onclick="viewEmployeeComments('{!! $ass->id !!}', '{!! $ass->job_id !!}');
                                            return false;" style='color:#d9534f'>View all Reply</a></b>
											<?php } ?>		
                        </div>
                    </td>
                    <td style="text-align: center;width:8%;color:green;font-weight:bold">
                        <?php
                        if ($projectowner[0]->user_id == $logged_user->id) {
                            ?>
                            <input type="checkbox" id="chkboxemployerapprove"   onchange="applyStatusChange(this, 'employer_status', '{!! $ass->id !!}', 'approve', '{!! $ass->job_id !!}')" name="chkboxemployerapprove" <?php echo $approve_checked ?> />
                            <?php
                        } else {
                            if ($ass->employer_status) {
                                echo "Approved";
                            }
                        }
                        ?>
                    </td>
                    <td style="text-align: center;width:8%;color:red;font-weight:bold"">
                        <?php
                        if ($projectowner[0]->user_id == $logged_user->id) {
                            ?>
                            <input type="checkbox" id="chkboxemployerdisapprove" onchange="applyStatusChange(this, 'employer_status', '{!! $ass->id !!}', 'disapprove', '{!! $ass->job_id !!}')"  name="chkboxemployerdisapprove" <?php echo $Disapprove_check ?> />
                            <?php
                        } else {
                            if (isset($isapprove) == FALSE) {
                                echo "";
                            } else if ($isapprove == FALSE) {
                                echo "DisApproved";
                            }
                        }
                        ?>
                    </td>
                    <td style="text-align: center;width:8%">
<?php
if ($projectfreelancer[0]->user_id == $logged_user->id) {
    ?>
                            <input type="checkbox" id="chkboxfreelancercomplete" onchange="applyStatusChange(this, 'freelancer_status', '{!! $ass->id !!}', 'approve', '{!! $ass->job_id !!}')" name="chkboxfreelancercomplete" <?php echo $complete_checked ?> />
                            <?php
                        } else {
                            // $isapprove = $ass->employer_status;
                            // $iscomplete = $ass->freelancer_status;
                            if ($ass->freelancer_status) {
                                echo "Completed";
                            }
                        }
                        ?>
                    </td>
                    <td style="text-align: center;width:8%">
<?php
if ($projectfreelancer[0]->user_id == $logged_user->id) {
    ?>
                            <input type="checkbox" id="chkboxfreelancerincomplete" onchange="applyStatusChange(this, 'freelancer_status', '{!! $ass->id !!}', 'disapprove', '{!! $ass->job_id !!}')" name="chkboxfreelancerincomplete" <?php echo $incomplete_check ?> />
                            <?php
                        } else {
                            if ($ass->freelancer_status == FALSE) {
                                echo "Incompleted";
                            }
                        }
                        ?>
                    </td>
                    <td>
                        <div style="overflow:auto; height:100px; ">
<?php
if ($projectfreelancer[0]->user_id == $logged_user->id) {
    ?>
                                <b> <a href="#" onclick="addFreeLancerComments('{!! $ass->id !!}', '{!! $ass->job_id !!}');
                                            return false;" style='color:#d9534f'>Add/Edit Comments</a></b>
                                       <?php
                                   }
                                   ?>
                          <span style="float:right;padding: 0 4px 0px 0px;"><?php echo $created::createFromFormat('Y-m-d H:i:s', $ass->updated_datetime)->format('M d, Y \of h:i A') ?></span>  {!! $ass->freelancer_comments !!}
							
							<?php
if ($projectfreelancer[0]->user_id == $logged_user->id) {
    ?>
<b><a href="javascript:void(0)" onclick="replyEmployeeComments('{!! $ass->id !!}', '{!! $ass->job_id !!}');
                                            return false;" style='color:#d9534f'>Send Reply</a></b><br/>
											<b><a href="javascript:void(0)" onclick="viewEmployeeComments('{!! $ass->id !!}', '{!! $ass->job_id !!}');
                                            return false;" style='color:#d9534f'>View all Reply</a></b>
       <?php
                                   } ?>
                        </div>
                    </td>
                </tr>

                @endforeach

                <tr>
                    <td style="width:30px !important;"></td> 
                    <td>

<?php
if ($projectowner[0]->user_id == $logged_user->id) {
    ?>
                            <b><a href="#" onclick="addassignment('{!! $projectowner[0]->jobid !!}');
                                        return false;">Add more assignments</a></b>
                                  <?php
                              }
                              ?>

                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </center>
    </div>  
</div>

<?php
}
}
?>

