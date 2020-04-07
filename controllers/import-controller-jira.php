<?php   

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
                               
	class ImportController {

		// getting connection in constructor
		function __construct($conn) {

			$this->conn 		 =		 $conn;

		}                    

       
		// function for reading csv file
		public function index() {

        	$fileName         =        "";

        	// if there is any file
	        if(isset($_FILES['file'])){

	        	// reading tmp_file name
	    		$fileName     =        $_FILES["file"]["tmp_name"];
	        }

			$counter          =        0;	 


			// if file size is not empty
	        if (isset($_FILES["file"]) && $_FILES["file"]["size"] > 0) {   

		        $file       =  fopen($fileName, "r");			        
		        
		        // eliminating the first row of CSV file
			    fgetcsv($file);  ?>

			    <table class="table">
			    	<thead>
			    		<th> # </th>
			    		<th> Jira Key </th>
			    		<th> Titel </th>
			    		<th> Typ </th>
			    		<th> Status </th>
			    		<th> Bis </th>
			    		<th> PI </th>
              <th> Topic </th>
              <th> Team </th>
              <th> Import-Status </th>
			    	</thead>
                                            	
                                                
                                                
                                                
                                                
                                                
                                                
		        <?php 
                
		        	while (($column = fgetcsv($file, 10000, "|")) !== FALSE) { 

			          $counter++;	   
                
			            // assigning csv column to a variable
	        	 		$j_key           =     $column[0];
                $issueid         =     $column[1];  // we don't import this
	        	 		$titel         	 =     utf8_decode($column[2]);
                $description     =     utf8_decode($column[3]);
                $type            =     $column[4];
                $status          =     $column[5];

                $array = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
                $key  = array_search(substr($column[6],3,3), $array);
                if (strlen($key)==1){$key="0".$key;}
                if(strlen($column[6])==18){
                    $due         =     date("Y-m-d",strtotime($key."/".substr($column[6],0,2)."/20".substr($column[6],7,2)));
                }else{
                    $due         =     "0000-00-00";
                }
                
                $storypoints     =     $column[7]/60/60/8;
	        	 		$BV		           =	   (int)substr($column[8], 0, strrpos($column[8], '.'));  
                $TC		           =	   (int)substr($column[9], 0, strrpos($column[9], '.'));
                $RROE		         =	   (int)substr($column[10], 0, strrpos($column[10], '.'));
                $JS		           =	   (int)substr($column[11], 0, strrpos($column[11], '.'));
	        	 		$created         =	   $column[12];  // we don't import this
                $updated         =	   $column[13];  // we don't import this
                $labels1         =	   $column[14];
                $labels2         =	   $column[15];
                $labels3         =	   $column[16];
                $labels4         =	   $column[17];
                $labels5         =	   $column[18];
                $labels6         =	   $column[19];
	                
                
                $importstatus       =       "Import nicht erfolgreich!!";
                $importstatus_color =       "error";
                
                //check labels
                    // Check Team:
                        $team="";
                        if (in_array($labels1, array ("SA","SM"))){
                            $team=$labels1;
                        }
                        if (in_array($labels2, array ("SA","SM"))){
                            $team=$labels2;
                        }
                        if (in_array($labels3, array ("SA","SM"))){
                            $team=$labels3;
                        }
                        if (in_array($labels4, array ("SA","SM"))){
                            $team=$labels4;
                        }
                        if (in_array($labels5, array ("SA","SM"))){
                            $team=$labels5;
                        }
                        if (in_array($labels6, array ("SA","SM"))){
                            $team=$labels6;
                        }
                        
                        if ($team=="SA"){$team="School Administration";}
                        if ($team=="SM"){$team="School Management";}
                        
                    // Check PI:
                        $pi="";                  
                        if (substr($labels1,0,2)=="PI"){
                            $pi=$labels1;
                        }
                        if (substr($labels2,0,2)=="PI"){
                            $pi=$labels2;
                        }
                        if (substr($labels3,0,2)=="PI"){
                            $pi=$labels3;
                        }
                        if (substr($labels4,0,2)=="PI"){
                            $pi=$labels4;
                        }
                        if (substr($labels5,0,2)=="PI"){
                            $pi=$labels5;
                        }
                        if (substr($labels6,0,2)=="PI"){
                            $pi=$labels6;
                        }      
                        

                    // Check Topic:
                        $topic="";              
                        if (in_array($labels1, array ("PLP","evento"))){
                            $topic=$labels1;
                        }
                        if (in_array($labels2, array ("PLP","evento"))){
                            $topic=$labels2;
                        }
                        if (in_array($labels3, array ("PLP","evento"))){
                            $topic=$labels3;
                        }
                        if (in_array($labels4, array ("PLP","evento"))){
                            $topic=$labels4;
                        }
                        if (in_array($labels5, array ("PLP","evento"))){
                            $topic=$labels5;
                        }
                        if (in_array($labels6, array ("PLP","evento"))){
                            $topic=$labels6;
                        }                                                                                                                                               
	                	  
                        // Start Import/Sync
                         if($j_key<>""){
                            //check if record already exists:
        	                	$sql 				=		"SELECT * FROM jira_tickets where j_key='$j_key'";
                            $result 	  =		$this->conn->query($sql);
                        
                             
                            //if there is a record with the jira-key in jira table (on pm.mastaz.ch) we update the existing record:                                                          
                            if(mysqli_num_rows($result) == 1){
        	                	    $sql 				        =		"UPDATE jira_tickets SET 
                                                            j_key       = '$j_key', 
                                                            title       = '$titel',
                                                            j_desc      = '$description',
                                                            j_type      = '$type',
                                                            j_status    = '$status', 
                                                            j_due_date  = '$due',
                                                            j_SP        = '$storypoints',
                                                            j_BV        = '$BV',
                                                            j_TC        = '$TC',
                                                            j_RROE      = '$RROE',
                                                            j_JS        = '$JS',
                                                            j_team      = '$team',
                                                            j_PI        = '$pi',
                                                            j_topic     = '$topic'   
	        	 	                                           where j_key='$j_key'";
        	                	    $result 			      =		$this->conn->query($sql);
                                $importstatus       =   "Aktualisiert";
                                $importstatus_color =   "success";                   
                            }else{
                              // inserting values into the table
          	                	  $sql 				        =		"INSERT INTO jira_tickets 
                                                                 (j_key   , title   , j_desc        , j_type , j_status , j_due_date, j_SP          , j_BV , j_TC , j_RROE , j_JS , j_team , j_PI,  j_topic) 
                                                          VALUES ('$j_key', '$titel', '$description', '$type', '$status', '$due'    , '$storypoints', '$BV', '$TC', '$RROE', '$JS', '$team', '$pi', '$topic') ";
          	                	  $result 			      =		$this->conn->query($sql);
                                $importstatus       =   "Neu erstellt";
                                $importstatus_color =   "success";  
                                
                                
                                // Mapping to FEATURES
                                
        	                	$sql 				=		"SELECT * FROM features where f_title='$titel'";
                            $result 	  =		$this->conn->query($sql);   
                            if(mysqli_num_rows($result) == 1){

                              
                              
                                foreach ($result as $k ) {
                                }
                                
                                $importstatus.="/ Mapping mit Feature #".$k["f_id"];
                                $sql 				        =		"UPDATE feature_details SET 
                                                            f_jira_id       = '$j_key' 
	        	 	                                           where f_id='".$k["f_id"]."'";
        	                	    $result 			      =		$this->conn->query($sql);
                                
                            }else{
                                $importstatus.="/ Kein Mapping zu Features";
                            }                             
                                
                                
                              }
                              
                          }
                          ?>
                                       		
	                    		<tr>
									<td> <?php echo $counter; ?> </td>
									<td> <?php echo $BV; ?> </td>
                  <td> <?php echo $titel; ?> </td>
									<td> <?php echo $type; ?> </td>
									<td> <?php echo $status; ?> </td>
									<td> <?php echo $due; ?> </td>
									<td> <?php echo $pi; ?> </td>
                  <td> <?php echo $topic; ?> </td>
                  <td> <?php echo $team; ?> </td>
	     						<td> <?php echo "<label class='text-".$importstatus_color."'>".$importstatus." </label> " .date('d-m-Y H:i:s');?> </td>
								</tr>
			<?php
            	}
                if($counter==0){
                echo "Fehler mit der Datei";
                }
				 ?>
				</table>

				<?php
			

		}else{
        
		}
	}	
 
}

?>