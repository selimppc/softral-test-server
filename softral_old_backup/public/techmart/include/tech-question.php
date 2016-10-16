<form class="form-horizontal" method="POST" id="msg_form">

    <fieldset>
        <!-- Name input-->
        <div class="form-group">
            <label class="col-md-3 control-label" for="name">Name</label>
            <div class="col-md-9">
                <input id="username" name="username" value=" <?php echo $first_name . " " . $last_name; ?>" readonly="" class="form-control" type="text">
                <input class="hide" id="client_id" name="client_id" value=" <?php echo $id; ?>" readonly="" class="form-control" type="text">
            </div>
        </div>



        <div class="form-group">
            <label class="col-md-3 control-label" for="Department">Department</label>
            <div class="col-md-9">

                <select required id="dept_id" name="dept_id" class="form-control">
                    <option value="" disabled="" selected="">Select</option>
                    <option value="1">Support</option>
                    <option value="2">Services</option>
                    <option value="3">Client</option>
                    <option value="4">Accounts</option>
                </select>

            </div>

        </div>

        <div class="form-group">
            <label class="col-md-3 control-label" for="Subject">Subject</label>
            <div class="col-md-9">

                <select required id="subj_id" name="subj_id" class="form-control">
                    <option value="" disabled="" selected="">Select</option>
                    <option value="1">High</option>
                    <option value="2">Low</option>
                    <option value="3">Medium</option>
                </select>
            </div>
        </div>


        <!-- Message body -->
        <div class="form-group">
            <label class="col-md-3 control-label" for="message">Your message
            </label>
            <div class="col-md-9">
                <textarea required wrap="hard" placeholder="Enter your message" style="resize:vertical;border: 1px solid #E5E8F1;" name="msg" class="form-control" id="msg" rows="5" cols="100"></textarea>
            </div>
        </div>

        <!-- Form actions -->
        <div class="form-group">
            <div class="col-md-12 widget-right">
                <button type="submit" class="btn btn-success btn-md pull-right">Submit</button>
            </div>
        </div>
    </fieldset>
</form>
