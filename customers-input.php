<?php
include_once 'config.php';

// Include header
$page       = 'customers-input';
$page_title = 'Customers Input';
if(!$_SESSION['login_user_data']){
	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") {
		$actual_link = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	} else {
		$actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	}
	$_SESSION['redirect_url'] = $actual_link;
}

include_once F_ROOT.'parts/layout/head.php';
$helptexts        = $db->getHelpText();

?>
	<!--Body content-->
	<!-- Auth navigation -->
	<header>
		<?php include_once(F_ROOT.'parts/header-auth.php'); ?>
	</header>

	<div class="container-fluid mt-3 mb-3">

		<div class="row mb-3">
			<div class="col-12">
				<h2 class="m-0"><img src="<?php echo W_ROOT; ?>/favicon.ico" style="height:30px;margin-right:10px">Inputs des Faches 
        <span class="h6" style="display: inline-flex;vertical-align: middle;">
        			       <?php if ($helptexts['title_customers_input']) {
				              echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['title_customers_input'] . "'></i>";
			               } ?>  
        </span></h2>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8 col-sm-8 col-xs-12">
				<?php
				if (isset($_SESSION['customers-input-error'])) {
					$msg = $_SESSION['customers-input-error'];
					unset($_SESSION['customers-input-error']);
					?>
					<div class="alert alert-danger" role="alert">
						<?php echo $msg; ?>
					</div>
					<?php
				}
				if (isset($_SESSION['customers-input-success'])) {
					$msg = $_SESSION['customers-input-success'];
					unset($_SESSION['customers-input-success']);
					?>
					<div class="alert alert-success" role="alert">
						<?php echo $msg; ?>
					</div>
					<?php
				}
				?>
			</div>
		</div>




	<div class="container-fluid mt-3 mb-3">
		<div class="row mb-3">
      		<div class="col-md-12 border shadow"  id="helpbox">
                <div class="form-group">
                  <div class="row">
                      <div class="col-3">
                        <label for="f_pi" class="col-form-label">PIs</label>
  
  
                            <select name="topics_watcher[]" id="topics_watcher" multiple class="form-control">
                                <option value="0">PI 16 (start - end)</option>
                                <option value="0" selected="selected">PI 15 (2020-10-01 - 2020-12-31)</option>
                                <option value="0" selected="selected">PI 14 (2020-10-01 - 2020-12-31)</option>
                                <option value="0">PI .. (2020-10-01 - 2020-12-31)</option>
                                <option value="0">PI 1 (2020-10-01 - 2020-12-31)</option>
                            </select>
                       
                        
                      </div>
                      <div class="col-3">
                        <label for="f_oe" class="col-form-label">Departemente</label>
                            <select name="topics_watcher[]" id="topics_watcher" multiple class="form-control">
                                <option value="0" selected="selected">A</option>
                                <option value="0">G</option>
                                <option value="0">L</option>
                                <option value="0">N</option>   
                                <option value="0">P</option>
                                <option value="0">S</option>
                                <option value="0" selected="selected">T</option>
                                <option value="0" selected="selected">W</option>                                                          
                            </select>
                      </div>
                      <div class="col-3">
                        <label for="f_status" class="col-form-label">Status</label>
                            <select name="topics_watcher[]" id="topics_watcher" multiple class="form-control">
                                <option value="0">New</option>
                                <option value="0">Requested</option>
                                <option value="0">Planned</option>
                                <option value="0" selected="selected">Doing</option>   
                                <option value="0" selected="selected">Done</option>
                                <option value="0">Cancelled</option>                                                         
                            </select>
                         
                        
                      </div>
                      <div class="col-3">
                        <label for="f_topics" class="col-form-label">Topics</label>
                        
  
                            <select name="topics_watcher[]" id="topics_watcher" multiple class="form-control">
                                <option value="0">--bitte w<span>&#228;</span>hlen--</option>
                				<?php
                				if ($topics_list) {
                					foreach ($topics_list as $topic) {
                						$key      = array_search($topic['id'], array_column($watching_topics, 'model_id'));
                						$selected = $key === false ? '' : 'selected="selected"';
                						?>
                                        <option value="<?php echo $topic['id']; ?>" <?php echo $selected; ?>><?php echo $topic['name']; ?></option>
                						<?php
                					}
                				}
                				?>
                            </select>
                      
                        
                      </div> 
                    </div>                                      
                </div> 
                <div class="form-group">
                    <button type="submit" name="---" class="btn btn-primary">Ansicht anpassen</button>
                </div> 
			</div>
		</div>
    </div>
    
	<div class="container-fluid mt-3 mb-3">
		<div class="row mb-3">
			<table class="table">
				<thead>
				<tr>
                  <th colspan="4">&nbsp;</th>
                  <th colspan="10" style="background-color:#e6e6e6;">
                    PI 15
                    <div style="font-size:10px;font-weight: normal;">13.04.2020 - 21.06.2020</div>
                  </th>
                  <th colspan="10" style="background-color:#b5b5b5;">
                    PI 14
                    <div style="font-size:10px;font-weight: normal;">13.04.2020 - 21.06.2020</div>
                  </th>
                </tr>                
				<tr>
                  <th>Title</th>
                  <th>Notizen</th>
                  <th>Status</th>
                  <th>Topic</th>
                  <th>Res</th>  
                  <th>Kommentar</th>
                  <th>A</th>
                  <th>T</th>
                  <th>W</th>
                  <th>BV</th>  
                  <th>TC</th>
                  <th>RROE</th>
                  <th>JS</th>
                  <th>WSJF</th> 
                  <th>Res</th>  
                  <th>Kommentar</th>                  
                  <th>A</th>
                  <th>T</th>
                  <th>W</th>
                  <th>BV</th>  
                  <th>TC</th>
                  <th>RROE</th>
                  <th>JS</th>
                  <th>WSJF</th>                                                                         
				</tr>
				</thead>
				<tbody>
                   <tr>
                        <td>
                            AG Admin Lehre (2020-04-29)
                        </td>
                        <td>
                            <textarea class="form-control"  style="width:200px;" name="f_desc" id="f_desc"></textarea>
                        </td>                        
                        <td>
                            Done
                        </td>
                        <td>
                            Evento
                        </td> 
                        <!--- PI --->
                       <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:orange;" value="4" aria-invalid="false" aria-required="true">
                        </td>                            
                        <td>
                            <textarea class="form-control" name="f_desc"  style="width:200px;" id="f_desc"></textarea>
                        </td>  
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:red;" value="5" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:yellow;" value="3" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:blue; "value="1" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td>   
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td> 
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td> 
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                          <span class="form-control f_WSJF">9.123</span>                        
                        </td>  
                        <!-- PI -->
                       <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:orange;" value="4" aria-invalid="false" aria-required="true">
                        </td>                            
                        <td>
                            <textarea class="form-control" name="f_desc"  style="width:200px;" id="f_desc"></textarea>
                        </td>  
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:red;" value="5" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:yellow;" value="3" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:blue; "value="1" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td>   
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td> 
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td> 
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                          <span class="form-control f_WSJF">9.123</span>                        
                        </td>                                                                                                                                                                      
                    </tr> 
                   <tr>
                        <td>
                            Active Directory Migration
                        </td>
                        <td>
                            <textarea class="form-control"  style="width:200px;" name="f_desc" id="f_desc"></textarea>
                        </td>                        
                        <td>
                            Done
                        </td>
                        <td>
                            Evento
                        </td> 
                        <!--- PI --->
                       <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:orange;" value="4" aria-invalid="false" aria-required="true">
                        </td>                            
                        <td>
                            <textarea class="form-control" name="f_desc"  style="width:200px;" id="f_desc"></textarea>
                        </td>  
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:red;" value="5" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:yellow;" value="3" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:blue; "value="1" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td>   
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td> 
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td> 
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                          <span class="form-control f_WSJF">9.123</span>                        
                        </td>  
                        <!-- PI -->
                       <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:orange;" value="4" aria-invalid="false" aria-required="true">
                        </td>                            
                        <td>
                            <textarea class="form-control" name="f_desc"  style="width:200px;" id="f_desc"></textarea>
                        </td>  
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:red;" value="5" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:yellow;" value="3" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:blue; "value="1" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td>   
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td> 
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td> 
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                          <span class="form-control f_WSJF">9.123</span>                        
                        </td>                                                                                                                                                                      
                    </tr> 
                   <tr>
                        <td>
                            ** Block: Features vom PI3, die nicht umgesetzt werde konnten **
                        </td>
                        <td>
                            <textarea class="form-control"  style="width:200px;" name="f_desc" id="f_desc"></textarea>
                        </td>                        
                        <td>
                            Done
                        </td>
                        <td>
                            Evento
                        </td> 
                        <!--- PI --->
                       <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:orange;" value="4" aria-invalid="false" aria-required="true">
                        </td>                            
                        <td>
                            <textarea class="form-control" name="f_desc"  style="width:200px;" id="f_desc"></textarea>
                        </td>  
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:red;" value="5" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:yellow;" value="3" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:blue; "value="1" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td>   
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td> 
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td> 
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                          <span class="form-control f_WSJF">9.123</span>                        
                        </td>  
                        <!-- PI -->
                       <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:orange;" value="4" aria-invalid="false" aria-required="true">
                        </td>                            
                        <td>
                            <textarea class="form-control" name="f_desc"  style="width:200px;" id="f_desc"></textarea>
                        </td>  
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:red;" value="5" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:yellow;" value="3" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:blue; "value="1" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td>   
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td> 
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td> 
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                          <span class="form-control f_WSJF">9.123</span>                        
                        </td>                                                                                                                                                                      
                    </tr>                                         

                   <tr>
                        <td>
                            ONLA / RMV Zweisprachigkeit Faktura & Semesterbestätigung
                        </td>
                        <td>
                            <textarea class="form-control"  style="width:200px;" name="f_desc" id="f_desc"></textarea>
                        </td>                        
                        <td>
                            Done
                        </td>
                        <td>
                            Evento
                        </td> 
                        <!--- PI --->
                       <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:orange;" value="4" aria-invalid="false" aria-required="true">
                        </td>                            
                        <td>
                            <textarea class="form-control" name="f_desc"  style="width:200px;" id="f_desc"></textarea>
                        </td>  
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:red;" value="5" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:yellow;" value="3" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:blue; "value="1" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td>   
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td> 
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td> 
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                          <span class="form-control f_WSJF">9.123</span>                        
                        </td>  
                        <!-- PI -->
                       <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:orange;" value="4" aria-invalid="false" aria-required="true">
                        </td>                            
                        <td>
                            <textarea class="form-control" name="f_desc"  style="width:200px;" id="f_desc"></textarea>
                        </td>  
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:red;" value="5" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:yellow;" value="3" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:blue; "value="1" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td>   
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td> 
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td> 
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="20" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                          <span class="form-control f_WSJF">9.123</span>                        
                        </td>                                                                                                                                                                      
                    </tr>                    
                   <tr>
                        <td>
                            TABLE/DB: [f_title]
                        </td>
                        <td>
                            <textarea class="form-control"  style="width:200px;" name="f_desc" id="f_desc">[f_notes]</textarea>
                        </td>                        
                        <td>
                            [f_status]
                        </td>
                        <td>
                            [f_topic_id]
                        </td> 
                        <!--- PI --->
                       <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:orange;" value="[dr_rankingvalue]" aria-invalid="false" aria-required="true">
                        </td>                            
                        <td>
                            <textarea class="form-control" name="f_desc"  style="width:200px;" id="f_desc">[dr_notes]</textarea>
                        </td>  
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:red;" value="[dr_rankingvalue]" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:yellow;" value="[dr_rankingvalue]" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:blue; "value="[dr_rankingvalue]" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="[fp_BV]" aria-invalid="false" aria-required="true">
                        </td>   
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="[fp_TC]" aria-invalid="false" aria-required="true">
                        </td> 
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="[fp_RROE]" aria-invalid="false" aria-required="true">
                        </td> 
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="[fp_JS]" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                          <span class="form-control f_WSJF">9.123</span>                        
                        </td>  
                        <!-- PI -->
                       <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:orange;" value="[dr_rankingvalue]" aria-invalid="false" aria-required="true">
                        </td>                            
                        <td>
                            <textarea class="form-control" name="f_desc"  style="width:200px;" id="f_desc">[dr_notes]</textarea>
                        </td>  
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:red;" value="[dr_rankingvalue]" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:yellow;" value="[dr_rankingvalue]" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" style="background-color:blue; "value="[dr_rankingvalue]" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="[fp_BV]" aria-invalid="false" aria-required="true">
                        </td>   
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="[fp_TC]" aria-invalid="false" aria-required="true">
                        </td> 
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="[fp_RROE]" aria-invalid="false" aria-required="true">
                        </td> 
                        <td>
                            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="[fp_JS]" aria-invalid="false" aria-required="true">
                        </td>
                        <td>
                          <span class="form-control f_WSJF">9.123</span>                        
                        </td>  
                    </tr>                        
                </tbody>
            </table>
               
        </div>    
    </div>

		<div class="row">
			<div class="col-12"><?php include_once(F_ROOT.'parts/customers-input-grid.php'); ?></div>
		</div>
	</div>
<?php
// Include footer
include_once F_ROOT.'parts/layout/footer.php';