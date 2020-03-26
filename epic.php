<?php  
namespace Phppot\Model;

use Phppot\Datasource;

class epic
{
    private $ds;    
    
  function __construct()
  {
        require_once __DIR__ . './../lib/DataSource.php';
        $this->ds = new DataSource();
  }

    /**
     * to get the all value
     *
     * @return array result record
     */
  function getFAQ() 
  {
     
        $query= "SELECT f.*,fs.name as fname,pi.pi_title as ptitle,tp.name as tname
        FROM features AS f
        LEFT JOIN feature_statuses AS fs ON fs.id = f.f_status_id
        LEFT JOIN productincrements AS pi ON pi.pi_id = f.f_PI
        LEFT JOIN topics AS tp ON tp.id = f.f_topic_id";                 
        $result = $this->ds->select($query);
        //print '<pre>';print_r($result);
        return $result;
  }

  function topics()
  {

         $topics = "SELECT * from topics";
         $topicsresult = $this->ds->select($topics);  
         //print_r($topicsresult);
         return $topicsresult;
  }

  function getPI()
  {

        $PI = "SELECT * from productincrements";
        $PIresult = $this->ds->select($PI);  
        //print_r($PIresult);
        return $PIresult;
  }

 function status()
 {

        $status = "SELECT * from feature_statuses";
        $statusresult = $this->ds->select($status);  
        //print_r($statusresult);
        return $statusresult;
 }
    
  function epics()
  {

    $epics = "SELECT * from epics";
    $epicsresult = $this->ds->select($epics);  
    //print_r($PIresult);
    return $epicsresult;
  }
    
    /**
     * to edit redorcbased on the question_id
     *
     * @param string $columnName
     * @param string $columnValue
     * @param string $questionId
     */
    function editRecord($columnName, $columnValue, $questionId) 
    {
       
        $query = "UPDATE features set " . $columnName . " = ? WHERE  f_id = ?";
        $paramType = 'si';
        $paramValue = array($columnValue,$questionId);
        $this->ds->execute($query, $paramType, $paramValue);
    }
// ******************************Start Epics**********************

  function getTeam() 
  {
     
        $query="SELECT * FROM epics
        LEFT JOIN team
        ON team.id = epics.team_id";
        $result = $this->ds->select($query);
        //print '<pre>';print_r($result);
        return $result;
  }

  function team()
  {
       $team = "SELECT * from team";
        $teamresult = $this->ds->select($team);  
      //print '<pre>';print_r($teamresult);
        return $teamresult;
  }



//Update..

  function epicseditRecord($columnName, $columnValue, $questionId) 
  {
        $query = "UPDATE epics set " . $columnName . " = ? WHERE  e_id = ?";
        $paramType = 'si';
        $paramValue = array($columnValue,$questionId);
        $this->ds->execute($query, $paramType, $paramValue);
  }
// ******************************End Epics************************


// ******************************Start Staff**********************
function getStaff() 
  {
     
        $query= "SELECT s.*,teamname.name as teamname,topic.name as topicname
        FROM staff AS s
        LEFT JOIN team AS teamname ON teamname.id = s.staff_team_id
        LEFT JOIN topics AS topic ON topic.id = s.staff_topic_id";                 
        $result = $this->ds->select($query);
        
        return $result;
  }


  function staffeditRecord($columnName, $columnValue, $questionId) 
  {
        $query = "UPDATE staff set " . $columnName . " = ? WHERE  staff_id = ?";
        $paramType = 'si';
        $paramValue = array($columnValue,$questionId);
        $this->ds->execute($query, $paramType, $paramValue);
  }

// ******************************End Staff************************


// ******************************Start Topics**********************

  function getTopics()
  {

         $topics = "SELECT * from topics";
         $topicsresult = $this->ds->select($topics);  
         //print_r($topicsresult);
         return $topicsresult;
  }

    function topicseditRecord($columnName, $columnValue, $questionId) 
  {
        $query = "UPDATE topics set " . $columnName . " = ? WHERE  id = ?";
        $paramType = 'si';
        $paramValue = array($columnValue,$questionId);
        $this->ds->execute($query, $paramType, $paramValue);
  }

// ******************************End Topics************************


// ******************************Start Topics**********************

  function getProductInc()
  {
         $productInc = "SELECT * from productincrements";
         $productIncresult = $this->ds->select($productInc);  
         //print_r($productIncresult);
         return $productIncresult;
  }



   function productInceditRecord($columnName, $columnValue, $questionId) 
  {
        $query = "UPDATE productincrements set " . $columnName . " = ? WHERE  pi_id = ?";
        $paramType = 'si';
        $paramValue = array($columnValue,$questionId);
        $this->ds->execute($query, $paramType, $paramValue);
  }

// ******************************End Topics************************

  // ******************************Start Help Text **********************

  function getHelptext()
  {
         $helptext = "SELECT * from help_text";
         $helptextresult = $this->ds->select($helptext);  
         //print_r($helptextresult);
         return $helptextresult;
  }



   function helptexteditRecord($columnName, $columnValue, $questionId) 
  {
        $query = "UPDATE help_text set " . $columnName . " = ? WHERE  id = ?";
        $paramType = 'si';
        $paramValue = array($columnValue,$questionId);
        $this->ds->execute($query, $paramType, $paramValue);
  }

// ******************************End Help Text************************


    // ******************************Start Help Text **********************

  function getfeaturetype()
  {
         $featuretypes = "SELECT * from featuretypes";
         $featuretypesresult = $this->ds->select($featuretypes);  
         //print_r($featuretypesresult);
         return $featuretypesresult;
  }



   function featuretypeseditRecord($columnName, $columnValue, $questionId) 
  {
        $query = "UPDATE featuretypes set " . $columnName . " = ? WHERE  id = ?";
        $paramType = 'si';
        $paramValue = array($columnValue,$questionId);
        $this->ds->execute($query, $paramType, $paramValue);
  }

// ******************************End Help Text************************


  // ******************************Start My Epics************************
  function getmyepics($epicOwnerID)
  {
        //$myepics = "SELECT * from epics";
    $myepics= "SELECT e.*,staff.*,epics_statuses.name as epicsname,team.name as teamname
        FROM epics AS e
        LEFT JOIN epics_statuses AS epics_statuses ON epics_statuses.id = e.e_status_id
        LEFT JOIN team AS team ON team.id = e.team_id
        LEFT JOIN staff AS staff ON staff.staff_id = e.e_owner WHERE e.e_owner='".$epicOwnerID."'"; 
        $myepicsresult = $this->ds->select($myepics);  
        //print_r($myepicsresult);
        return $myepicsresult;
  }

  // ******************************End My Epics**************************


    // ******************************All  Epics************************
  function getallepics()
  {
        //$allepics = "SELECT * from epics";
    $allepics= "SELECT e.*,staff.*,epics_statuses.name as epicsname,team.name as teamname
        FROM epics AS e
        LEFT JOIN epics_statuses AS epics_statuses ON epics_statuses.id = e.e_status_id
        LEFT JOIN team AS team ON team.id = e.team_id
        LEFT JOIN staff AS staff ON staff.staff_id = e.e_owner"; 
        $allepicsresult = $this->ds->select($allepics);  
        //print_r($myepicsresult);
        return $allepicsresult;
  }

  // ******************************End All Epics**************************
 
  // ******************************Start My feature************************
  function getmyfeature($SMEID)
  {
        
    $myfeature= "SELECT f.*,fd.*,st.*,ep.*,topics.name as topicsname,feature_statuses.name as statusename, pi.pi_title as piname    
        FROM features AS f
         LEFT JOIN feature_details AS fd ON fd.f_id = f.f_id 
         LEFT JOIN staff AS st ON st.staff_id = fd.f_SME 
         LEFT JOIN epics AS ep ON ep.e_id = fd.f_epic 
         LEFT JOIN productincrements AS pi ON pi.pi_id = f.f_PI
         LEFT JOIN feature_statuses AS feature_statuses ON feature_statuses.id = f.f_status_id 
          LEFT JOIN topics AS topics ON topics.id = f.f_topic_id";
        $myfeatureresult = $this->ds->select($myfeature);  
        //print '<pre>';print_r($myfeatureresult);
        return $myfeatureresult;
  }

  // ******************************End My feature**************************

  // ******************************Start feature dynamic************************
  function getfeaturesdynamic($SMEID=NULL,$fStatus=NULL,$EPICID=NULL)
  {
        
    $myfeature= "SELECT f.*,fd.*,st.*,ep.*,topics.name as topicsname,feature_statuses.name as statusename,  resp.staff_firstname as responsible_firstname, resp.staff_lastname as responsible_lasttname, ft.name as ftname, pi.pi_title as piname    
        FROM features AS f
         LEFT JOIN feature_details AS fd ON fd.f_id = f.f_id 
         LEFT JOIN staff AS st   ON   st.staff_id = fd.f_SME 
         LEFT JOIN staff AS resp ON resp.staff_id = fd.f_responsible
         LEFT JOIN epics AS ep ON ep.e_id = fd.f_epic 
         LEFT JOIN featuretypes AS ft ON ft.id = f.f_type 
         LEFT JOIN productincrements AS pi ON pi.pi_id = f.f_PI
         LEFT JOIN feature_statuses AS feature_statuses ON feature_statuses.id = f.f_status_id 
          LEFT JOIN topics AS topics ON topics.id = f.f_topic_id";
          if ($SMEID || $EPICID || $fStatus){
              $whereset=0;

              if ($SMEID) {
                    $myfeature.=" where ";              
                    $myfeature.="fd.f_SME='".$SMEID."'"; 
                    $whereset=1;
              }
              if ($EPICID) {
                if ($whereset==1){
                    $myfeature.=" and "; 
                }else{
                    $myfeature.=" where ";                
                    $whereset=1;
                }
                    $myfeature.="fd.f_epic='".$EPICID."'"; 
              }
              if ($fStatus) {
                if ($whereset==1){
                    $myfeature.=" and "; 
                }else{
                    $myfeature.=" where ";                
                    $whereset=1;
                }              
                    $myfeature.="f.fstatus_id in (".$fStatus.")"; 
              }
          }
        $myfeatureresult = $this->ds->select($myfeature);  
        //print '<pre>';print_r($myfeatureresult);
        return $myfeatureresult;             
  }

  // ******************************End feature dynamic**************************
  
  
 // ******************************Start All feature************************
  function getallfeature()
  {
        
    $allfeature= "SELECT f.*,fd.*,st.*,ep.*,topics.name as topicsname,feature_statuses.name as statusename
        FROM features AS f
         LEFT JOIN feature_details AS fd ON fd.f_id = f.f_id 
         LEFT JOIN staff AS st ON st.staff_id = fd.f_SME 
         LEFT JOIN epics AS ep ON ep.e_id = fd.f_epic 
         LEFT JOIN feature_statuses AS feature_statuses ON feature_statuses.id = f.f_status_id 
          LEFT JOIN topics AS topics ON topics.id = f.f_topic_id"; 
        $allfeatureresult = $this->ds->select($allfeature);  
        //print '<pre>';print_r($allfeatureresult);
        return $allfeatureresult;
  }

  // ******************************End All feature**************************
      

  // ******************************Start Epics Details**********************

  function EpicsDetails() 
  {
     
        // $EpicsDetails="SELECT * FROM epics
        // LEFT JOIN team
        // ON team.id = epics.team_id";


    $EpicsDetails="SELECT e.*,stf.*,ed.*,team.name as teamname,epics_statuses.name as statusename
              FROM epics AS e
              LEFT JOIN team as team ON team.id=e.team_id
              LEFT JOIN epics_statuses as epics_statuses ON epics_statuses.id=e.e_status_id
              LEFT JOIN staff AS stf ON stf.staff_id = e.e_owner 
             LEFT JOIN epic_details AS ed ON ed.e_id = e.e_id where ed.e_id = e.e_id";
        $EpicsDetailsresult = $this->ds->select($EpicsDetails);
        //print '<pre>';print_r($EpicsDetailsresult);
        return $EpicsDetailsresult;
  }
       
  // ******************************End Epics Details********************** 
 
 // ******************************Start Features Details********************** 
  function FeaturesDetails() 
  {
     
        $FeaturesDetails= "SELECT f.*,fd.*,st.*,fs.name as fname,pi.pi_title as ptitle,tp.name as tname
        FROM features AS f
        LEFT JOIN feature_statuses AS fs ON fs.id = f.f_status_id
        LEFT JOIN productincrements AS pi ON pi.pi_id = f.f_PI
        LEFT JOIN topics AS tp ON tp.id = f.f_topic_id
        LEFT JOIN feature_details AS fd ON fd.f_id = f.f_id
        LEFT JOIN staff AS st ON st.staff_id = fd.f_SME";                 
        $FeaturesDetailsresult = $this->ds->select($FeaturesDetails);
        //print '<pre>';print_r($FeaturesDetailsresult);
        return $FeaturesDetailsresult;
  }
  // ******************************End Features Details********************** 

}