<?php
include "../connect_admin/include/shi-config.php";
include "../connect_admin/include/functions.php";


$edit = $_REQUEST['id'];

$checkadmin = select_query($con, "hr_package", "","`id`='$edit'");
foreach($checkadmin['result'] as $key=>$value)
{
	
}
?>

<div class="form-group">
                                                        <label class="col-sm-2 control-label">Resume Access Limit (Month)</label>
                                                        <div class="col-sm-10">
						          <input type="number" disabled name="resume_limit"  class="form-control" Value="<?php echo $value['resume']; ?>">
                                                        </div>
                                                    </div>
													<div class="form-group">
                                                        <label class="col-sm-2 control-label">SMS Send Limit (Month)</label>
                                                        <div class="col-sm-10">
                            <input type="number" disabled name="sms_limit"  class="form-control" Value="<?php echo $value['sms']; ?>">
                                                        </div>
                                                    </div>
													<div class="form-group">
                                                        <label class="col-sm-2 control-label">Email Send Limit (Month)</label>
                                                        <div class="col-sm-10">
                       <input type="number"  disabled name="email_limit"  class="form-control" Value="<?php echo $value['email']; ?>">
                                                        </div>
                                                    </div>
													<div class="form-group">
                                                        <label class="col-sm-2 control-label">Broadcast Send Limit (Month)</label>
                                                        <div class="col-sm-10">
                 <input type="number"  disabled name="broadcast_limit"  class="form-control" Value="<?php echo $value['broadcast']; ?>">
                                                        </div>
                                                    </div>