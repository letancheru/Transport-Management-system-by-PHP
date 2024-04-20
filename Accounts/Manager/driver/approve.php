<?php
	if (isset($_SERVER['QUERY_STRING'])) {
		if ($_SERVER['QUERY_STRING']!=""||$_SERVER['QUERY_STRING']!=null) {
			mysql_connect("localhost","root","");
			mysql_select_db("huvmts");

			$dr_actv = "SELECT * FROM `driver_report` WHERE `dr_rpt_id` = '".$_SERVER['QUERY_STRING']."'";
			$fetch = mysql_query($dr_actv);
			$rows = mysql_fetch_array($fetch);



            $rprt_ids = $rows['dr_rpt_id'];
            $rprt_dr_ids = $rows['driver_id'];
            $dr_rprt_tim = $rows['time'];
            $dr_rprt_dests = $rows['destny']; 
            $plate_nos = $rows['plate_no']; 


            $drvr = "SELECT * FROM `driver` WHERE `driver_id` = '$rprt_dr_ids'";
            $ftc = mysql_query($drvr);
            $d_row = mysql_fetch_array($ftc);

            $vod = "SELECT * FROM `vehicle_on_duty` WHERE `plate_no` = '$plate_nos'";
            $vod_ftc = mysql_query($vod);
            $vod_row = mysql_fetch_array($vod_ftc);
            $vod_strt_tim = $vod_row['start_time'];
            $vod_end_tim = $vod_row['End_time'];
            $vod_dest = $vod_row['destney'];

            $rqst = "SELECT * FROM `request` WHERE `r_id`='".$vod_row['r_id']."'";
            $rqst_ftc = mysql_query($rqst);
            $rqst_row = mysql_fetch_array($rqst_ftc);
            $rqst_dept = $rqst_row['dept_name'];
            $rqst_id = $rqst_row['r_id'];


			$dr_actv = "UPDATE `driver` SET `report`='not' WHERE `driver_id` = '".$rows['driver_id']."'";
			mysql_query($dr_actv);
			$vcl = "UPDATE `vehicle` SET `report`='not' WHERE `plate_no` = '".$rows['plate_no']."'";
			mysql_query($vcl);
			$vcl = "UPDATE  `driver_report`  SET `approval`='yes'WHERE `dr_rpt_id` = '".$_SERVER['QUERY_STRING']."'";
			mysql_query($vcl);

			$sql = "INSERT INTO `vehicle_history`(`plate_no`, `driver_id`, `return_date`, `t_start`, `t_end`, `p_from`, `r_id`) 
			VALUES ('$plate_nos','$rprt_dr_ids','$dr_rprt_tim','$vod_strt_tim','$vod_end_tim','$vod_dest','$rqst_id')";

			if (mysql_query($sql)) {
				$sql = "DELETE FROM `vehicle_on_duty` WHERE `plate_no` = '$plate_nos'";
				header("Location:report.php?success");
			}else{
				echo "error";
			}
		}
	}
?>