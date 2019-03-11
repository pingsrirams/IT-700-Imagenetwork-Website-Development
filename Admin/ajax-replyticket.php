<?php 
include "include/shi-config.php";
include "include/functions.php";
$q = $_REQUEST['q'];

?>   <div class="form-group">
                    <label>Ticket Reply</label>
                    <select class="form-control" name="ticket_id" required="">
                    <?php 
                    $checkadmin = select_query($con, "support_ticket", "","`user_id`='$q'");



	foreach($checkadmin['result'] as $key=>$value){
		
	$tour_id = $value['tour_id'];
		
		 $tourinfo = select_query($con, "tournament", "","`id`='$tour_id'");



	foreach($tourinfo['result'] as $key=>$tourvalue){ }
?>
	

	

                    
                      <option value="<?php echo $value['tour_id']; ?>" ><?php echo $tourvalue['name']; ?></option>
                     <?php } ?> 
                      
                    </select>
                </div>
                <div class="form-group">
                    <label>Amount</label>
                    <input type="text" class="form-control" name="amount" placeholder="Amount" required>
                </div>

                <input type="hidden" name="user_id" value="<?php echo $q; ?>">