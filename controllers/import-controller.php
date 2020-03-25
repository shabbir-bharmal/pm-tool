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
			    		<th> Jira ID </th>
			    		<th> Titel </th>
			    		<th> Bemerkung </th>
			    		<th> Business Value </th>
			    		<th> Type </th>
			    		<th> Epic </th>
                        <th> Kommentar </th>
                        <th> Import-Status </th>
			    	</thead>
                                            	
                                                
                                                
                                                
                                                
                                                
                                                
		        <?php 
                
		        	while (($column = fgetcsv($file, 10000, ",")) !== FALSE) { 

			            $counter++;	   

			            // assigning csv column to a variable
	        	 		$jira_id           =       $column[0];

	        	 		$titel         	   =       $column[1];
	        	 		
	        	 		$bemerkung         =       $column[2];
	        	 		
	        	 		$BV		           =	   $column[3];
	        	 		
	        	 		$type              =	   $column[4];
                        
                        $epic              =	   $column[5];
                        
                        $kommentar         =	   $column[6];
	                

                            $importstatus       =       "Import nicht erfolgreich!!";
                            $importstatus_color =       "error";
	                	//check if record already exists:
    	                	$sql 				=		"SELECT * FROM jira_tickets where jira_id='$jira_id'";
    	                	$result 			=		$this->conn->query($sql);                        
                         if($jira_id<>""){     
                             if($result->num_rows == 1){
        	                	$sql 				=		"UPDATE jira_tickets SET jira_id= '$jira_id', titel='$titel', bemerkung='$bemerkung', BV='$BV', type='$type', epic='$epic', kommentar='$kommentar' where id=$id";
        	                	$result 			=		$this->conn->query($sql);
                                $importstatus       =       "Aktualisiert";
                                $importstatus_color =       "success";                   
                              }{
                                  // inserting values into the table
          	                	$sql 				=		"INSERT INTO jira_tickets (jira_id, titel, bemerkung, BV, type, epic, kommentar) VALUES ('$jira_id', '$titel', '$bemerkung', '$BV', '$type', '$epic', '$kommentar') ";
          	                	$result 			=		$this->conn->query($sql);
                                $importstatus       =       "Importiert";
                                $importstatus_color =       "success";  
                              }
                          }
                          ?>
                                       		
	                    		<tr>
									<td> <?php echo $counter; ?> </td>
									<td> <?php echo $jira_id; ?> </td>
									<td> <?php echo $titel; ?> </td>
									<td> <?php echo $bemerkung; ?> </td>
									<td> <?php echo $BV; ?> </td>
									<td> <?php echo $type; ?> </td>
                                    <td> <?php echo $epic; ?> </td>
                                    <td> <?php echo $kommentar; ?> </td>
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