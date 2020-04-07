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
			    		<th> TopDesk Nr.</th>
			    		<th> Kurzbeschreibung (Details) </th>
              <th> Feature </th>
			    		<th> Incidentart </th>
			    		<th> Status </th>
			    		<th> Erstelldatum/-zeit </th>
			    		<th> Bearbeitergruppe </th>
              <th> Kategorie </th>
              <th> Unterkategorie </th>
              <th> Import-Status </th>
			    	</thead>
                                            	
               
                                                
                                                
                                                
                                                
		        <?php 
                
		        	while (($column = fgetcsv($file, 10000, ";")) !== FALSE) { 

			          $counter++;	   
                
			            // assigning csv column to a variable

	        	 		$tdi_key             =     $column[0];               //Incidentnummer > Key  
                $tdi_title           =     $column[1];  //Kurzbeschreibung (Details)
	        	 		$tdi_art        	   =     $column[2];  //Incidentart,
                $tdi_anmelder        =     $column[3];  //Name Anmelder
                $tdi_status          =     $column[4];               //Status
                $tdi_bearbeiter      =     $column[5];  //Bearbeiter
                $tdi_termin          =     $column[6];               //Termin 
                $tdi_auswirkung      =     $column[7];  //Auswirkung
                $tdi_kategorie       =     $column[8];  //Kategorie
                $tdi_unterkat        =     $column[9];  //Unterkategorie
                $tdi_bearbgrupp      =     $column[10]; //Bearbeitergruppe                                                	
                $tdi_departement     =     $column[11]; //Departement                                                	
                $tdi_erstelltdatum   =     $column[12];              //Erstelldatum/-zeit                                                	                                                                                                	

	                
                
                $importstatus       =       "Import nicht erfolgreich!!";
                $importstatus_color =       "error";
                
                                                                                                                                          
	                	  
                        // Start Import/Sync
                         if($tdi_key<>""){
                            //check if record already exists:
        	                	$sql 				=		"SELECT * FROM topdesk_incidents where tdi_key='$tdi_key'";
                            $result 	  =		$this->conn->query($sql);
                        
                             
                            //if there is a record with the jira-key in jira table (on pm.mastaz.ch) we update the existing record:                                                          
                            if(mysqli_num_rows($result) == 1){
        	                	    $sql 				        =		"UPDATE topdesk_incidents SET 
                                                            tdi_title         = '$tdi_title',
                                                            tdi_art           = '$tdi_art',
                                                            tdi_anmelder      = '$tdi_anmelder',
                                                            tdi_status        = '$tdi_status', 
                                                            tdi_bearbeiter    = '$tdi_bearbeiter',
                                                            tdi_termin        = '$tdi_termin',
                                                            tdi_auswirkung    = '$tdi_auswirkung',
                                                            tdi_kategorie     = '$tdi_kategorie',
                                                            tdi_unterkat      = '$tdi_unterkat',
                                                            tdi_bearbgrupp    = '$tdi_bearbgrupp',
                                                            tdi_departement   = '$tdi_departement',
                                                            tdi_erstelltdatum = '$tdi_erstelltdatum'
	        	 	                                           where tdi_key='$tdi_key'";
        	                	    $result 			      =		$this->conn->query($sql);
                                $importstatus       =   "Aktualisiert";
                                $importstatus_color =   "success";    


$f_title="";
$sql 				=		"SELECT * FROM features where f_title like '%$tdi_key%'";
$result 	  =		$this->conn->query($sql);   
if(mysqli_num_rows($result) == 1){
$f_title=$sql;
}
                                 
                            }else{
                              // inserting values into the table
          	                	  $sql 				        =		"INSERT INTO topdesk_incidents
                                                                 ( tdi_key,    tdi_title,    tdi_art,    tdi_anmelder,    tdi_status,    tdi_bearbeiter,    tdi_termin,    tdi_auswirkung,    tdi_kategorie,   tdi_unterkat,    tdi_bearbgrupp,    tdi_departement,    tdi_erstelltdatum) 
                                                          VALUES ('$tdi_key','$tdi_title', '$tdi_art', '$tdi_anmelder', '$tdi_status', '$tdi_bearbeiter', '$tdi_termin', '$tdi_auswirkung', '$tdi_kategori', '$tdi_unterkat', '$tdi_bearbgrupp', '$tdi_departement', '$tdi_erstelltdatum') ";                                 
          	                	  $result 			      =		$this->conn->query($sql);
                                $importstatus       =   "Neu erstellt";
                                $importstatus_color =   "success";  
                                
                                
                                // Mapping to FEATURES
                                
        	                	$sql 				=		"SELECT * FROM features where f_title like '%$tdi_key%'";
                            $result 	  =		$this->conn->query($sql);   
                            if(mysqli_num_rows($result) == 1){
                             $f_title=$sql;
                              
                              
                                foreach ($result as $k ) {
                                }
                                
                                $importstatus.="/ Mapping mit Feature #".$k["f_id"];
                                $sql 				        =		"UPDATE feature_details SET 
                                                            f_jira_id       = '$j_key' 
	        	 	                                           where f_id='".$k["f_id"]."'";
        	                	   // $result 			      =		$this->conn->query($sql);
                                $f_title= $k["f_id"];
                            }else{
                                $importstatus.="/ Kein Mapping zu Features";
                            }                             
  



                                
                              }
                              
                          }
                          $style='<font color="red">';
                          if($tdi_kategorie=="Applikationen"){
                          $style='<font color="green">';
                          
                          }
                          ?>
                                       		
	                    		<tr>
									<td> <?php echo $counter; ?> </td>
									<td> <?php echo $style; ?> <?php echo $tdi_key; ?> </td>
                  <td> <?php echo $style; ?><?php echo $tdi_title; ?> </td>
                  <td> <?php echo $f_title; ?> </td>                  
									<td> <?php echo $tdi_art; ?> </td>
									<td> <?php echo $tdi_status; ?> </td>
									<td> <?php echo $tdi_erstelltdatum; ?> </td>
									<td> <?php echo $tdi_bearbeiter; ?> </td>
                  <td> <?php echo $style; ?><?php echo $tdi_kategorie; ?> </td>
                  <td> <?php echo $tdi_unterkat; ?> </td>
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