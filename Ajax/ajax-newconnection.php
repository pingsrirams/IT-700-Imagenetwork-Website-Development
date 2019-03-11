<?php 
include '../../secure_admin/include/shi-config.php';


if($_REQUEST['action'] == 'change_package') {

	$mode_str  = ($_REQUEST[mode]!=null)?"AND `mode_id`='$_REQUEST[mode]'  ":"";
	$package_str  = ($_REQUEST[pack]!=null)?"AND `packs_id`='$_REQUEST[pack]'  ":"";
	$validity_str  = ($_REQUEST[validity]!=null)?"AND `validlity`='$_REQUEST[validity]'  ":"";

	$package_result = mysqli_query($con,"SELECT * FROM `packages` WHERE 1 $mode_str $package_str $validity_str ")or die(mysqli_error($con));
	$str = '';
	while($package = mysqli_fetch_array($package_result)){
		 $str .= '<tr>
		 				<td><input type="hidden" name="package_id" value="'.$package[id].'"></td>
	                  <td class="text-5 text-primary text-center align-middle">$'.$package[amount].' <span class="text-1 text-muted d-block">Amount</span></td>

	                  <td class="text-3 text-center align-middle">'.$package[channels].'+ <span class="text-1 text-muted d-block">Channels</span></td>

	                  <td class="text-3 text-center align-middle">'.$package[validlity].' Month <span class="text-1 text-muted d-block">Validity</span></td>

	                  <td class="align-middle"><button class="btn btn-sm btn-outline-primary shadow-none selectpackage" type="button">Select</button></td>

	                </tr>';
	}

	echo $str;
}
?>