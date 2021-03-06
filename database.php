<?php

/**
 * Class Database
 */
class Database
{
	/**
	 * @var
	 */
	public $pdo;
	
	/**
	 *
	 */
	public function __construct()
	{
	
	}
	
	/**
	 *
	 */
	public function connect()
	{
		$dsn       = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
		$user      = DB_USER;
		$passwd    = DB_PWD;
		$this->pdo = new PDO($dsn, $user, $passwd);
	}
	
	/**
	 * @return bool
	 */
	public function getTopics()
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `topics` ORDER BY `topics`.`name` ASC");
			$stm->execute();
			$topics = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $topics;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @param int $topic_id
	 * @return bool
	 */
	public function getTopicById($topic_id = 0)
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `topics` WHERE id=:topic_id");
			$stm->bindParam(':topic_id', $topic_id);
			$stm->execute();
			$topic = $stm->fetch(PDO::FETCH_ASSOC);
			return $topic;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @return bool
	 */
	public function getAllProductIncrements()
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `productincrements`");
			$stm->execute();
			$pi = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $pi;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @return bool
	 */
	public function getActualProductIncrement()
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `productincrements` WHERE `pi_start`< now() and `pi_end`> now()");
			$stm->execute();
			$pi = $stm->fetch(PDO::FETCH_ASSOC);
			return $pi;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @param $exclude_pi_id
	 * @return bool
	 */
	public function getOtherProductIncrements($exclude_pi_id = 0)
	{
		try {
			//$stm = $this->pdo->prepare("SELECT * FROM `productincrements` WHERE `pi_id` != :exclude_pi_id AND `pi_id` > :exclude_pi_id");
			$stm = $this->pdo->prepare("SELECT * FROM `productincrements`");
			$stm->bindParam(':exclude_pi_id', $exclude_pi_id);
			$stm->execute();
			$pis = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $pis;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @param $topic_id
	 * @return bool
	 */
	public function getStaffByTopic($topic_id = 0)
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `staff` WHERE `staff_topic_id` = :staff_topic_id ");
			$stm->bindParam(':staff_topic_id', $topic_id);
			$stm->execute();
			$staff = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $staff;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @return bool
	 */
	public function getStaff()
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `staff` ORDER BY staff_firstname, staff_lastname");
			$stm->execute();
			$staff = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $staff;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @param $staff_id
	 * @return bool
	 */
	public function getStaffById($staff_id = 0)
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `staff` WHERE `staff_id` = :staff_id ");
			$stm->bindParam(':staff_id', $staff_id);
			$stm->execute();
			$staff = $stm->fetch(PDO::FETCH_ASSOC);
			return $staff;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @param $staff_id
	 * @param $pi_id
	 * @return bool
	 */
	public function getStaffCapacityByPI($staff_id = 0, $pi_id = 0)
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `capacities` WHERE `staff_id` = :staff_id AND `pi_id` = :pi_id ");
			$stm->bindParam(':staff_id', $staff_id);
			$stm->bindParam(':pi_id', $pi_id);
			$stm->execute();
			$capacity = $stm->fetch(PDO::FETCH_ASSOC);
			return $capacity;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @param $staff_id
	 * @param $pi_id
	 * @param $capacity
	 * @return bool
	 */
	public function updateStaffCapacityByPI($staff_id = 0, $pi_id = 0, $capacity = 0)
	{
		try {
			$sql
				 = "INSERT INTO `capacities` (
					pi_id,
					staff_id,
					capacity
				) VALUES (
					:pi_id,
					:staff_id,
					:capacity
				)
				ON DUPLICATE KEY UPDATE
					capacity = :capacity
					";
			$stm = $this->pdo->prepare($sql);
			$stm->bindParam(':capacity', $capacity);
			$stm->bindParam(':staff_id', $staff_id);
			$stm->bindParam(':pi_id', $pi_id);
			if ($stm->execute()) {
				return true;
			}
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @param int $topic_id
	 * @param int $pi_id
	 * @return bool
	 */
	public function getFeaturesByTopicAndPI($topic_id = 0, $pi_id = 0)
	{
		try {
			$stm = $this->pdo->prepare("SELECT features.*,featuretypes.highlight_color, feature_details.f_mehr_details, feature_details.f_SME FROM `features` LEFT JOIN featuretypes ON features.f_type = featuretypes.id
LEFT JOIN feature_details ON feature_details.f_id = features.f_id WHERE features.f_topic_id = :f_topic_id AND features.f_PI = :f_PI  ORDER BY features.f_ranking ASC ");
			$stm->bindParam(':f_topic_id', $topic_id);
			$stm->bindParam(':f_PI', $pi_id);
			$stm->execute();
			$features = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $features;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @param $f_id
	 * @return bool
	 */
	public function getFeatureByFeatureId($f_id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT f.*, fd.* FROM `features` AS f LEFT JOIN feature_details AS fd ON fd.f_id = f.f_id WHERE f.`f_id` = :f_id");
			$stm->bindParam(':f_id', $f_id);
			$stm->execute();
			$feature = $stm->fetch(PDO::FETCH_ASSOC);
			return $feature;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @param int $sme
	 * @return bool
	 */
	public function getFeatureRequestsBySME($sme = 0)
	{
		try {
			$sql = "
							SELECT
							  f.f_id,
							  f.f_title,
							  f.f_status_id,
							  fst.`name` AS f_status
							FROM
							  `features` AS f
							  LEFT JOIN feature_details AS fd
							    ON fd.f_id = f.f_id
							  LEFT JOIN feature_statuses AS fst
							    ON fst.`id` = f.`f_status_id`
							WHERE fd.f_SME = :f_SME
			";
			$stm = $this->pdo->prepare($sql);
			$stm->bindParam(':f_SME', $sme);
			$stm->execute();
			$feature = $stm->fetchALL(PDO::FETCH_ASSOC);
			return $feature;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @param $feature_info
	 * @return bool
	 */
	public function saveFeature($feature_info)
	{
		try {
			foreach ($feature_info as $key => $value) {
				if ($value == '') {
					if ($key == 'f_status_id') {
						$feature_info[$key] = 5;
					} else {
						$feature_info[$key] = null;
					}
				}
			}
			
			$data = [
				':f_id'          => $feature_info['f_id'],
				':f_title'       => $feature_info['f_title'],
				':f_desc'        => $feature_info['f_desc'],
				':f_storypoints' => $feature_info['f_storypoints'],
				':f_BV'          => $feature_info['f_BV'],
				':f_TC'          => $feature_info['f_TC'],
				':f_RROE'        => $feature_info['f_RROE'],
				':f_JS'          => $feature_info['f_JS'],
				':f_type'        => $feature_info['f_type'],
				':f_status_id'   => $feature_info['f_status_id'],
			
			];
			if ($feature_info['f_id'] == 0) {
				$ranking = 0;
				$stm     = $this->pdo->prepare("SELECT MAX(`f_ranking`) as ranking FROM `features` WHERE `f_topic_id` = :f_topic_id AND `f_PI` = :f_PI");
				$stm->bindParam(':f_topic_id', $feature_info['topic_id']);
				$stm->bindParam(':f_PI', $feature_info['pi_id']);
				$stm->execute();
				$ranking_result = $stm->fetch(PDO::FETCH_ASSOC);
				if ($ranking_result) {
					$ranking = $ranking_result['ranking'] + 1;
				}
				$sql = "INSERT INTO features (f_title,f_desc,f_storypoints,f_topic_id,f_PI,f_ranking,f_status_id,f_type,f_BV,f_TC,f_RROE,f_JS) VALUES (:f_title,:f_desc,:f_storypoints,:f_topic_id,:f_PI,:f_ranking,:f_status_id,:f_type,:f_BV,:f_TC,:f_RROE,:f_JS)";
				
				$stm = $this->pdo->prepare($sql);
				unset($data[':f_id']);
				$data[':f_topic_id'] = $feature_info['topic_id'];
				$data[':f_PI']       = $feature_info['pi_id'];
				$data[':f_ranking']  = $ranking;
				
				$stm->execute($data);
				
				$f_id                 = $this->pdo->lastInsertId();
				$feature_info['f_id'] = $f_id;
			} else {
				$data[':f_topic_id'] = $feature_info['topic_id'];
				
				$stm = $this->pdo->prepare("UPDATE features SET f_title=:f_title, f_desc=:f_desc, f_storypoints=:f_storypoints, f_status_id=:f_status_id,f_BV=:f_BV,f_TC=:f_TC,f_RROE=:f_RROE,f_JS=:f_JS,f_type=:f_type,f_topic_id=:f_topic_id WHERE f_id=:f_id");
				$stm->execute($data);
				$f_id = $feature_info['f_id'];
			}
			// Save detailss
			
			$this->saveFeatureDetails($f_id, $feature_info);
			$this->saveFeatureFiles($f_id, $feature_info);
			$this->saveWatcher($_SESSION['login_user_data']['staff_id'], 'feature', $f_id, $feature_info['watcher']);
			return $f_id;
			
			
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @param $feature_info
	 * @return bool
	 */
	public function saveFeatureRequest($feature_info)
	{
		try {
			
			$feature_info['f_status_id'] = isset($feature_info['einreichen']) ? 6 : 5;
			
			
			foreach ($feature_info as $key => $value) {
				
				if ($value == '') {
					$feature_info[$key] = null;
				}
			}
			
			$data = [
				':f_id'          => $feature_info['f_id'],
				':f_title'       => $feature_info['f_title'],
				':f_desc'        => $feature_info['f_desc'],
				':f_storypoints' => $feature_info['f_storypoints'],
				':f_topic_id'    => $feature_info['f_topic'],
				':f_PI'          => 0,
				':f_ranking'     => 0,
				':f_status_id'   => $feature_info['f_status_id'],
				':f_type'        => $feature_info['f_type'],
				':f_BV'          => $feature_info['f_BV'],
				':f_TC'          => $feature_info['f_TC'],
				':f_RROE'        => $feature_info['f_RROE'],
				':f_JS'          => $feature_info['f_JS'],
			];
			
			if (!$feature_info['f_id']) {
				$sql = "INSERT INTO features (f_title,f_desc,f_storypoints,f_topic_id,f_PI,f_ranking,f_status_id,f_type,f_BV,f_TC,f_RROE,f_JS) VALUES (:f_title,:f_desc,:f_storypoints,:f_topic_id,:f_PI,:f_ranking,:f_status_id,:f_type,:f_BV,:f_TC,:f_RROE,:f_JS)";
				unset($data[':f_id']);
			} else {
				$data = [
					':f_id'          => $feature_info['f_id'],
					':f_title'       => $feature_info['f_title'],
					':f_desc'        => $feature_info['f_desc'],
					':f_storypoints' => $feature_info['f_storypoints'],
					':f_status_id'   => $feature_info['f_status_id'],
					':f_topic_id'    => $feature_info['f_topic'],
					':f_type'        => $feature_info['f_type'],
					':f_BV'          => $feature_info['f_BV'],
					':f_TC'          => $feature_info['f_TC'],
					':f_RROE'        => $feature_info['f_RROE'],
					':f_JS'          => $feature_info['f_JS'],
				];
				$sql  = "UPDATE features SET f_title=:f_title, f_desc=:f_desc, f_status_id=:f_status_id,f_topic_id=:f_topic_id, f_storypoints = :f_storypoints, f_BV = :f_BV, f_TC = :f_TC, f_RROE = :f_RROE, f_JS = :f_JS, f_type = :f_type WHERE f_id=:f_id";
			}
			
			$stm = $this->pdo->prepare($sql);
			$stm->execute($data);
			
			$f_id                 = (!$feature_info['f_id'] ? $this->pdo->lastInsertId() : $feature_info['f_id']);
			$feature_info['f_id'] = $f_id;
			$_POST['f_id']        = $f_id;
			// Save details
			$this->saveFeatureDetails($f_id, $feature_info);
			$this->saveFeatureFiles($f_id, $feature_info);
			return $this->saveWatcher($_SESSION['login_user_data']['staff_id'], 'feature', $f_id, $feature_info['watcher']);
			
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @param int $f_id
	 * @param array $feature_info
	 * @return bool
	 */
	public function saveFeatureDetails($f_id, $feature_info)
	{
		try {
			
			$data = [
				':f_id'                  => $f_id,
				':f_note'                => $feature_info['f_note'],
				':f_benefit'             => $feature_info['f_benefit'],
				':f_dependencies'        => $feature_info['f_dependencies'],
				':f_acceptance_criteria' => $feature_info['f_acceptance_criteria'],
				':f_SME'                 => $feature_info['f_SME'],
				':f_due_date'            => $feature_info['f_due_date'],
				':f_responsible'         => $feature_info['f_responsible'],
				':f_mehr_details'        => $feature_info['f_mehr_details'],
				':f_epic'                => $feature_info['f_epic'],
				':f_context'             => $feature_info['f_context'],
				':f_problemdessc'        => $feature_info['f_problemdessc'],
				':f_currentstate'        => $feature_info['f_currentstate'],
				':f_targetstate'         => $feature_info['f_targetstate'],
				':f_inscope'             => $feature_info['f_inscope'],
				':f_outofscope'          => $feature_info['f_outofscope'],
				':f_risks'               => $feature_info['f_risks'],
        ':f_jira_id'             => $feature_info['f_jira_id']
			];
			
			$sql
				 = "INSERT INTO `feature_details` (
					f_id,
					f_note,
					f_benefit,
					f_dependencies,
					f_acceptance_criteria,
					f_SME,
					f_due_date,
					f_responsible,
					f_mehr_details,
					f_epic,
					f_context,
					f_problemdessc,
					f_currentstate,
					f_targetstate,
					f_inscope,
					f_outofscope,
					f_risks,
          f_jira_id
					
				) VALUES (
					:f_id,
					:f_note,
					:f_benefit,
					:f_dependencies,
					:f_acceptance_criteria,
					:f_SME,
					:f_due_date,
					:f_responsible,
					:f_mehr_details,
					:f_epic,
					:f_context,
					:f_problemdessc,
					:f_currentstate,
					:f_targetstate,
					:f_inscope,
					:f_outofscope,
					:f_risks,
          :f_jira_id
				)
				ON DUPLICATE KEY UPDATE
					f_note = :f_note,
					f_benefit = :f_benefit,
					f_dependencies = :f_dependencies,
					f_acceptance_criteria = :f_acceptance_criteria,
					f_SME = :f_SME,
					f_due_date = :f_due_date,
					f_responsible = :f_responsible,
					f_mehr_details = :f_mehr_details,
					f_epic = :f_epic,
					f_context = :f_context,
					f_problemdessc = :f_problemdessc,
					f_currentstate = :f_currentstate,
					f_targetstate = :f_targetstate,
					f_inscope = :f_inscope,
					f_outofscope = :f_outofscope,
					f_risks = :f_risks,
          f_jira_id = :f_jira_id
					";
			$stm = $this->pdo->prepare($sql);
			
			$stm->execute($data);
			return true;
			
		}
		catch (PDOException $e) {
		}
		return false;
		
	}
	
	/**
	 * @param $epic_info
	 * @return bool
	 */
	public function saveEpicRequest($epic_info)
	{
		try {
			$epic_info['e_status_id'] = isset($epic_info['einreichen']) ? 2 : 1;
			
			foreach ($epic_info as $key => $value) {
				if ($value == '') {
					$epic_info[$key] = NULL;
				}
			}
			$data = [
				':e_title'     => $epic_info['e_title'],
				':team_id'     => $epic_info['team_id'],
				':e_status_id' => $epic_info['e_status_id'],
				':e_owner'     => $epic_info['e_owner']
			];
			
			if (!$epic_info['e_id']) {
				$sql             = "INSERT INTO epics (e_title,e_desc,team_id,e_status_id,e_owner) VALUES (:e_title,:e_desc,:team_id,:e_status_id,:e_owner)";
				$data[':e_desc'] = '';
			} else {
				$sql           = "UPDATE epics SET e_title=:e_title, team_id=:team_id, e_status_id=:e_status_id, e_owner=:e_owner WHERE e_id=:e_id";
				$data[':e_id'] = $epic_info['e_id'];
			}
			$stm = $this->pdo->prepare($sql);
			
			$stm->execute($data);
			#echo str_replace(array_keys($data), array_values($data), $sql);exit;
			$e_id              = (!$epic_info['e_id'] ? $this->pdo->lastInsertId() : $epic_info['e_id']);
			$epic_info['e_id'] = $e_id;
			$_POST['e_id']     = $e_id;
			
			// Save details
			$this->saveEpicDetails($e_id, $epic_info);
			$this->saveEpicFiles($e_id, $epic_info);
			return $this->saveWatcher($_SESSION['login_user_data']['staff_id'], 'epic', $e_id, $epic_info['watcher']);
			
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @param int $e_id
	 * @param array $epic_info
	 * @return bool
	 */
	public function saveEpicDetails($e_id, $epic_info)
	{
		try {
			
			$data = [
				':e_id'                                   => $e_id,
				':e_hs_for'                               => $epic_info['e_hs_for'],
				':e_hs_for_desc'                          => $epic_info['e_hs_for_desc'],
				':e_hs_solution'                          => $epic_info['e_hs_solution'],
				':e_hs_how'                               => $epic_info['e_hs_how'],
				':e_hs_value'                             => $epic_info['e_hs_value'],
				':e_hs_unlike'                            => $epic_info['e_hs_unlike'],
				':e_hs_oursoluion'                        => $epic_info['e_hs_oursoluion'],
				':e_hs_businessoutcome'                   => $epic_info['e_hs_businessoutcome'],
				':e_hs_leadingindicators'                 => $epic_info['e_hs_leadingindicators'],
				':e_hs_nfr'                               => $epic_info['e_hs_nfr'],
				':e_notes'                                => $epic_info['e_notes'],
				':e_in_scope'                             => $epic_info['e_in_scope'],
				':e_out_of_scope'                         => $epic_info['e_out_of_scope'],
				':e_mvp_features'                         => $epic_info['e_mvp_features'],
				':e_additional_potential_features'        => $epic_info['e_additional_potential_features'],
				':e_sponsors'                             => $epic_info['e_sponsors'],
				':e_users_markets_affected'               => $epic_info['e_users_markets_affected'],
				':e_impact_products_programs_services'    => $epic_info['e_impact_products_programs_services'],
				':e_impact_sales_distribution_deployment' => $epic_info['e_impact_sales_distribution_deployment'],
				':e_analysis_summary'                     => $epic_info['e_analysis_summary'],
				':e_is_go'                                => $epic_info['e_is_go'],
				':e_estimated_story_points'               => $epic_info['e_estimated_story_points'],
				':e_estimated_monetary_cost'              => $epic_info['e_estimated_monetary_cost'],
				':e_type_of_return'                       => $epic_info['e_type_of_return'],
				':e_anticipated_business_impact'          => $epic_info['e_anticipated_business_impact'],
				':e_development_type'                     => $epic_info['e_development_type'],
				':e_start_date'                           => $epic_info['e_start_date'],
				':e_completion_date'                      => $epic_info['e_completion_date'],
				':e_incremental_implementation_strategy'  => $epic_info['e_incremental_implementation_strategy'],
				':e_sequencing_dependencies'              => $epic_info['e_sequencing_dependencies'],
				':e_milestones'                           => $epic_info['e_milestones']
			];
			
			$sql
				 = "INSERT INTO `epic_details` (
								e_id,
								e_hs_for,
								e_hs_for_desc,
								e_hs_solution,
								e_hs_how,
								e_hs_value,
								e_hs_unlike,
								e_hs_oursoluion,
								e_hs_businessoutcome,
								e_hs_leadingindicators,
								e_hs_nfr,
								e_notes,
								e_in_scope,
								e_out_of_scope,
								e_mvp_features,
								e_additional_potential_features,
								e_sponsors,
								e_users_markets_affected,
								e_impact_products_programs_services,
								e_impact_sales_distribution_deployment,
								e_analysis_summary,
								e_is_go,
								e_estimated_story_points,
								e_estimated_monetary_cost,
								e_type_of_return,
								e_anticipated_business_impact,
								e_development_type,
								e_start_date,
								e_completion_date,
								e_incremental_implementation_strategy,
								e_sequencing_dependencies,
								e_milestones
							) VALUES (
								:e_id,
								:e_hs_for,
								:e_hs_for_desc,
								:e_hs_solution,
								:e_hs_how,
								:e_hs_value,
								:e_hs_unlike,
								:e_hs_oursoluion,
								:e_hs_businessoutcome,
								:e_hs_leadingindicators,
								:e_hs_nfr,
								:e_notes,
								:e_in_scope,
								:e_out_of_scope,
								:e_mvp_features,
								:e_additional_potential_features,
								:e_sponsors,
								:e_users_markets_affected,
								:e_impact_products_programs_services,
								:e_impact_sales_distribution_deployment,
								:e_analysis_summary,
								:e_is_go,
								:e_estimated_story_points,
								:e_estimated_monetary_cost,
								:e_type_of_return,
								:e_anticipated_business_impact,
								:e_development_type,
								:e_start_date,
								:e_completion_date,
								:e_incremental_implementation_strategy,
								:e_sequencing_dependencies,
								:e_milestones
							)
							ON DUPLICATE KEY UPDATE
								e_hs_for = :e_hs_for,
								e_hs_for_desc = :e_hs_for_desc,
								e_hs_solution = :e_hs_solution,
								e_hs_how = :e_hs_how,
								e_hs_value = :e_hs_value,
								e_hs_unlike = :e_hs_unlike,
								e_hs_oursoluion = :e_hs_oursoluion,
								e_hs_businessoutcome = :e_hs_businessoutcome,
								e_hs_leadingindicators = :e_hs_leadingindicators,
								e_hs_nfr = :e_hs_nfr,
								e_notes = :e_notes,
								e_in_scope = :e_in_scope,
								e_out_of_scope = :e_out_of_scope,
								e_mvp_features = :e_mvp_features,
								e_additional_potential_features = :e_additional_potential_features,
								e_sponsors = :e_sponsors,
								e_users_markets_affected = :e_users_markets_affected,
								e_impact_products_programs_services = :e_impact_products_programs_services,
								e_impact_sales_distribution_deployment = :e_impact_sales_distribution_deployment,
								e_analysis_summary = :e_analysis_summary,
								e_is_go = :e_is_go,
								e_estimated_story_points = :e_estimated_story_points,
								e_estimated_monetary_cost = :e_estimated_monetary_cost,
								e_type_of_return = :e_type_of_return,
								e_anticipated_business_impact = :e_anticipated_business_impact,
								e_development_type = :e_development_type,
								e_start_date = :e_start_date,
								e_completion_date = :e_completion_date,
								e_incremental_implementation_strategy = :e_incremental_implementation_strategy,
								e_sequencing_dependencies = :e_sequencing_dependencies,
								e_milestones = :e_milestones
								";
			$stm = $this->pdo->prepare($sql);
			
			$stm->execute($data);
			
			//echo str_replace(array_keys($data), array_values($data), $sql); exit;
			
			return true;
			
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @param $f_id
	 * @param $feature_info
	 * @return bool
	 */
	public function saveFeatureFiles($f_id, $feature_info)
	{
		try {
			
			$countfiles = count($_FILES['f_file']['name']);
			if ($countfiles > 0) {
				
				// Looping all files
				for ($i = 0; $i < $countfiles; $i++) {
					$filename = $_FILES['f_file']['name'][$i];
					
					if ($filename) {
						$f_file_name = explode('.', $filename);
						$newfilename = $f_file_name[0] . '_' . date('dmYHis') . '.' . $f_file_name[1];
						
						move_uploaded_file($_FILES['f_file']['tmp_name'][$i], 'upload/' . $newfilename);
						$fileurl = W_ROOT . '/upload/' . $newfilename;
						
						$file_data = [
							':f_id'       => $f_id,
							':f_filename' => $newfilename,
							':f_fileurl'  => $fileurl,
						];
						
						$sql = "INSERT INTO `feature_files` (
							f_id,
							f_filename,
							f_fileurl
						) VALUES (
							:f_id,
							:f_filename,
							:f_fileurl
						)";
						$stm = $this->pdo->prepare($sql);
						$stm->execute($file_data);
					}
					
				}
			}
			return true;
		}
		catch (PDOException $e) {
		}
		return false;
		
	}
	
	public function saveEpicFiles($e_id, $epic_info)
	{
		
		try {
			$countfiles = count($_FILES['e_file']['name']);
			if ($countfiles > 0) {
				
				// Looping all files
				for ($i = 0; $i < $countfiles; $i++) {
					$filename = $_FILES['e_file']['name'][$i];
					
					if ($filename) {
						$e_file_name = explode('.', $filename);
						$newfilename = $e_file_name[0] . '_' . date('dmYHis') . '.' . $e_file_name[1];
						
						move_uploaded_file($_FILES['e_file']['tmp_name'][$i], 'upload/' . $newfilename);
						$fileurl = W_ROOT . '/upload/' . $newfilename;
						
						$file_data = [
							':e_id'       => $e_id,
							':e_filename' => $newfilename,
							':e_fileurl'  => $fileurl,
						];
						
						
						$sql = "INSERT INTO `epic_files` (
							e_id,
							e_filename,
							e_fileurl
						) VALUES (
							:e_id,
							:e_filename,
							:e_fileurl
						)";
						$stm = $this->pdo->prepare($sql);
						$stm->execute($file_data);
					}
					
				}
			}
			return true;
		}
		catch (PDOException $e) {
		}
		return false;
		
	}
	
	/**
	 * @param $f_id
	 * @return bool
	 */
	public function deleteFeature($f_id)
	{
		try {
			$stm = $this->pdo->prepare("DELETE FROM `features` WHERE `f_id` = :f_id");
			$stm->bindParam(':f_id', $f_id);
			$stm->execute();
			
			$stm = $this->pdo->prepare("DELETE FROM `feature_details` WHERE `f_id` = :f_id");
			$stm->bindParam(':f_id', $f_id);
			$stm->execute();
			
			$stm = $this->pdo->prepare("DELETE FROM `feature_files` WHERE `f_id` = :f_id");
			$stm->bindParam(':f_id', $f_id);
			$stm->execute();
			return $f_id;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @param $pi_id
	 * @param $f_ids
	 * @return bool
	 */
	public function updateFeatureRanking($pi_id, $f_ids, $topic_id)
	{
		try {
			$f_ids = explode(',', $f_ids);
			
			foreach ($f_ids as $key => $value) {
				$stm = $this->pdo->prepare("UPDATE `features` SET f_PI = :f_PI,f_ranking = :f_ranking,f_topic_id = :f_topic_id WHERE `f_id` = :f_id ");
				$stm->bindParam(':f_ranking', $key);
				$stm->bindParam(':f_PI', $pi_id);
				$stm->bindParam(':f_topic_id', $topic_id);
				$stm->bindParam(':f_id', $value);
				$stm->execute();
			}
			return true;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @return bool
	 */
	public function getFeatureType()
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `featuretypes` ORDER BY `featuretypes`.`name` ASC");
			$stm->execute();
			$feature_types = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $feature_types;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @return bool
	 */
	public function getFeatureStatuses()
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `feature_statuses` ORDER BY `order` ASC");
			$stm->execute();
			$feature_statuses = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $feature_statuses;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @param int $topic_id
	 * @param int $pi_id
	 * @return int
	 */
	public function getTotalCapacityByTopicPI($topic_id = 0, $pi_id = 0)
	{
		try {
			$stm = $this->pdo->prepare("SELECT sum(capacity) AS total_capacity FROM `capacities` where pi_id = :pi_id and staff_id in (SELECT staff_id FROM `staff` where staff_topic_id = :topic_id)
");
			$stm->bindParam(':topic_id', $topic_id);
			$stm->bindParam(':pi_id', $pi_id);
			$stm->execute();
			$result = $stm->fetch(PDO::FETCH_ASSOC);
			if ($result['total_capacity']) {
				return $result['total_capacity'];
			}
		}
		catch (PDOException $e) {
		}
		return 0;
	}
	
	
	/**
	 * @param $f_id
	 * @return bool
	 */
	public function getFeatureFilesByFeatureId($f_id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `feature_files` WHERE `f_id` = :f_id");
			$stm->bindParam(':f_id', $f_id);
			$stm->execute();
			$featurefiles = $stm->fetchALL(PDO::FETCH_ASSOC);
			return $featurefiles;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	public function getEpicFilesByFeatureId($e_id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `epic_files` WHERE `e_id` = :e_id");
			$stm->bindParam(':e_id', $e_id);
			$stm->execute();
			$featurefiles = $stm->fetchALL(PDO::FETCH_ASSOC);
			return $featurefiles;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	
	/**
	 * @param $id
	 * @param $file_name
	 * @return bool
	 */
	public function deleteFile($id, $file_name)
	{
		try {
			$stm = $this->pdo->prepare("DELETE FROM `feature_files` WHERE `id` = :id");
			$stm->bindParam(':id', $id);
			$stm->execute();
			unlink('upload/' . $file_name);
			
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	public function deleteFileEpic($id, $file_name)
	{
		try {
			$stm = $this->pdo->prepare("DELETE FROM `epic_files` WHERE `id` = :id");
			$stm->bindParam(':id', $id);
			$stm->execute();
			unlink('upload/' . $file_name);
			
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @param $username
	 * @param $password
	 * @return bool
	 */
	public function getUserData($username, $password)
	{
		
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `staff` WHERE `username` = :username AND `password` = :password");
			$stm->bindParam(':username', $username);
			$stm->bindParam(':password', $password);
			$stm->execute();
			$userdata = $stm->fetch(PDO::FETCH_ASSOC);
			unset($userdata['password']);
			$staff_id = $userdata['staff_id'];
			$last_login = date('Y-m-d H:i:s');
			
			$stm = $this->pdo->prepare("UPDATE `staff` SET last_login = :last_login WHERE `staff_id` = :staff_id ");
			$stm->bindParam(':staff_id', $staff_id);
			$stm->bindParam(':last_login', $last_login);
			$stm->execute();
			
			return $userdata;
		}
		catch (PDOException $e) {
		}
		return false;
		
	}
	
	/**
	 * @return bool
	 */
	public function getEpics()
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `epics` ORDER BY `epics`.`e_title` ASC");
			$stm->execute();
			$epics = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $epics;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @param int $owner_id
	 * @return bool
	 */
	public function getEpicsByOwner($owner_id = 0)
	{
		try {
			$sql          = "SELECT ep.*,eps.name as e_status FROM `epics` AS ep LEFT JOIN epics_statuses as eps on eps.id = ep.e_status_id WHERE ep.e_owner = :e_owner ORDER BY ep.`e_title` ASC";
			$stm          = $this->pdo->prepare($sql);
			$query_params = [':e_owner' => $owner_id];
			$stm->execute($query_params);
			$epics = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $epics;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @param int $e_id
	 * @return bool
	 */
	public function getEpicById($e_id = 0)
	{
		try {
			$sql = "
							SELECT
							  ep.*,
							  eps.name AS e_status,
							  epd.*
							FROM
							  `epics` AS ep
							  LEFT JOIN epics_statuses AS eps
							    ON eps.id = ep.e_status_id
							  LEFT JOIN epic_details AS epd
							    ON epd.`e_id` = ep.`e_id`
							WHERE ep.e_id = :e_id
			";
			
			$stm          = $this->pdo->prepare($sql);
			$query_params = [':e_id' => $e_id];
			$stm->execute($query_params);
			$epics = $stm->fetch(PDO::FETCH_ASSOC);
			return $epics;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @return bool
	 */
	public function getEpicStatuses()
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `epics_statuses` ORDER BY `name` ASC");
			$stm->execute();
			$epic_statuses = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $epic_statuses;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	
	/**
	 * @return array|bool
	 */
	public function getHelpText()
	{
		try {
			$stm = $this->pdo->prepare("SELECT field_name,tooltip FROM `help_text`");
			$stm->execute();
			$helptexts = $stm->fetchAll(PDO::FETCH_ASSOC);
			$help_text = [];
			foreach ($helptexts as $helptext) {
				$help_text[$helptext['field_name']] = $helptext['tooltip'];
			}
			return $help_text;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	
	/**
	 * @param $id
	 * @return bool
	 */
	public function getFeatureHighlightColor($id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT highlight_color FROM `featuretypes` WHERE `id` = :id");
			$stm->bindParam(':id', $id);
			$stm->execute();
			$highlight_color = $stm->fetch(PDO::FETCH_ASSOC);
			return $highlight_color;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @return bool
	 */
	public function getTeams()
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `team` ORDER BY `team`.`name` ASC");
			$stm->execute();
			$teams = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $teams;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @param $team_id
	 * @return bool
	 */
	public function getEpicsByTeam($team_id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `epics` WHERE `team_id` = :team_id ORDER BY `epics`.`e_title` ASC");
			$stm->bindParam(':team_id', $team_id);
			$stm->execute();
			$epics = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $epics;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @param int $epic_id
	 * @param int $pi_id
	 * @param int $team_id
	 * @return bool
	 */
	public function getFeaturesByEpicAndPI($epic_id = 0, $pi_id = 0, $team_id = 0)
	{
		try {
			
			$sql = "
				SELECT f.*, ep.e_title,fd.*,featuretypes.highlight_color
				FROM features as f
				JOIN feature_details AS fd on fd.f_id = f.f_id
				JOIN epics as ep on ep.e_id = fd.f_epic
				LEFT JOIN featuretypes ON f.f_type = featuretypes.id WHERE fd.f_epic = :epic_id AND f.f_pi = :pi_id
				
			";
			$stm = $this->pdo->prepare($sql);
			$stm->bindParam(':epic_id', $epic_id);
			$stm->bindParam(':pi_id', $pi_id);
			$stm->execute();
			$features = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $features;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @return bool
	 */
	public function getWorkingEpics()
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `epics` WHERE `e_status_id` NOT IN (5,6) ORDER BY `epics`.`e_title` ASC");
			$stm->execute();
			$epics = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $epics;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @return bool
	 */
	public function getCompletedEpics()
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `epics` WHERE `e_status_id` IN (5,6) ORDER BY `epics`.`e_title` ASC");
			$stm->execute();
			$epics = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $epics;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * Enter capacity of missing staff and pi
	 *
	 * @return bool
	 */
	public function checkCapacity()
	{
		try {
			$staff = $this->getStaff();
			if ($staff) {
				foreach ($staff as $staff_member) {
					$sql = "SELECT pi_id FROM productincrements WHERE pi_id NOT IN (SELECT pi_id FROM capacities WHERE staff_id = :staff_id);";
					$stm = $this->pdo->prepare($sql);
					$stm->execute([':staff_id' => $staff_member['staff_id']]);
					$pis = $stm->fetchAll(PDO::FETCH_ASSOC);
					if ($pis) {
						foreach ($pis as $pi) {
							$this->updateStaffCapacityByPI($staff_member['staff_id'], $pi['pi_id'], 0);
						}
					}
				}
			}
			return true;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @param $id
	 * @return bool
	 */
	public function getEpicsStatusByID($id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT name FROM `epics_statuses` WHERE `id` = :id");
			$stm->bindParam(':id', $id);
			$stm->execute();
			$epics = $stm->fetch(PDO::FETCH_ASSOC);
			return $epics;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @param $id
	 * @return bool
	 */
	public function getTeamByID($id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `team` WHERE `id` = :id");
			$stm->bindParam(':id', $id);
			$stm->execute();
			$teams = $stm->fetch(PDO::FETCH_ASSOC);
			return $teams;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	public function getTopicsByTeam($id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `topics` WHERE `team_id` = :team_id");
			$stm->bindParam(':team_id', $id);
			$stm->execute();
			$teams = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $teams;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	public function getStaffByTeam($team_id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `staff` WHERE `staff_team_id` = :staff_team_id ");
			$stm->bindParam(':staff_team_id', $team_id);
			$stm->execute();
			$staff = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $staff;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	public function getStaffByTeamAndTopic($team_id, $topic_id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `staff` WHERE `staff_team_id` = :staff_team_id AND `staff_topic_id` = :staff_topic_id  ");
			$stm->bindParam(':staff_team_id', $team_id);
			$stm->bindParam(':staff_topic_id', $topic_id);
			$stm->execute();
			$staff = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $staff;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	public function getTotalCapacityByTeamPI($team_id = 0, $pi_id = 0)
	{
		try {
			$stm = $this->pdo->prepare("SELECT sum(capacity) AS total_capacity FROM `capacities` where pi_id = :pi_id and staff_id in (SELECT staff_id FROM `staff` where staff_team_id = :team_id)");
			$stm->bindParam(':team_id', $team_id);
			$stm->bindParam(':pi_id', $pi_id);
			$stm->execute();
			$result = $stm->fetch(PDO::FETCH_ASSOC);
			if ($result['total_capacity']) {
				return $result['total_capacity'];
			}
		}
		catch (PDOException $e) {
		}
		return 0;
	}
	
	public function manageAccount($account_info)
	{
		try {
			
			$releation = "staff_firstname=:staff_firstname, staff_lastname=:staff_lastname, email=:email";
			$data      = [
				':staff_id'        => $account_info['staff_id'],
				':staff_firstname' => $account_info['staff_firstname'],
				':staff_lastname'  => $account_info['staff_lastname'],
				':email'           => $account_info['email']
			];
			
			if ($_FILES) {
				$filename = $_FILES['avatarImg']['name'];
				if ($filename) {
					$this->removeCurrntAvatar($account_info['staff_id']);
					$filename    = explode('.', $filename);
					$newfilename = $filename[0] . '_' . date('dmYHis') . '.' . $filename[1];
					
					move_uploaded_file($_FILES['avatarImg']['tmp_name'], 'upload/avatar/' . $newfilename);
					$fileurl = W_ROOT . '/upload/avatar/' . $newfilename;
					
					$data[':staff_avatar'] = $fileurl;
					$releation             .= ", staff_avatar = :staff_avatar";
				}
				
			}
			if ($account_info['password_new']) {
				$releation .= ", password = :password";
				
				$data[':password'] = md5($account_info['password_new']);
			}
			
			$sql = "UPDATE staff SET $releation WHERE staff_id=:staff_id";
			$stm = $this->pdo->prepare($sql);
			$stm->execute($data);
			$this->saveStaffCardFooterPermission($account_info);
			if (isset($account_info['topics_watcher'])) {
				// Add watching topics
				foreach ($account_info['topics_watcher'] as $topic_id) {
					if ($topic_id) {
						$this->saveWatcher($account_info['staff_id'], 'topic', $topic_id, 1);
					}
				}
				// Remove other watching topics
				$this->unwatchOtherTopics($account_info['staff_id'], $account_info['topics_watcher']);
			} else {
				// Remove old topics
				$this->unwatchAllTopics($account_info['staff_id']);
			}
			
		}
		catch (PDOException $e) {
		
		}
		return 0;
	}
	
	public function removeCurrntAvatar($staff_id)
	{
		
		try {
			$stm = $this->pdo->prepare("SELECT staff_avatar FROM `staff` WHERE `staff_id` = :staff_id");
			$stm->bindParam(':staff_id', $staff_id);
			$stm->execute();
			$userdata = $stm->fetch(PDO::FETCH_ASSOC);
			$file     = str_replace(W_ROOT, F_ROOT, $userdata['staff_avatar']);
			unlink($file);
			
			return true;
		}
		catch (PDOException $e) {
		}
		return false;
		
	}
	
	public function getUserInfo($staff_id)
	{
		
		try {
			$stm = $this->pdo->prepare("SELECT staff_id,staff_firstname,staff_lastname,	email,username,can_edit_roadmap,can_edit_epic_feature,can_manage_config,can_edit_customers_inputs,staff_avatar FROM `staff` WHERE `staff_id` = :staff_id");
			$stm->bindParam(':staff_id', $staff_id);
			$stm->execute();
			$userdata = $stm->fetch(PDO::FETCH_ASSOC);
			return $userdata;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	public function saveStaffCardFooterPermission($account_info)
	{
		try {
			$data = [
				':staff_id'               => $account_info['staff_id'],
				':cardfooter_duedate'     => (!$account_info['cardfooter_duedate'] ? 0 : 1),
				':cardfooter_wsjf'        => (!$account_info['cardfooter_wsjf'] ? 0 : 1),
				':cardfooter_sp'          => (!$account_info['cardfooter_sp'] ? 0 : 1),
				':cardfooter_attachments' => (!$account_info['cardfooter_attachments'] ? 0 : 1),
				':cardfooter_sme'         => (!$account_info['cardfooter_sme'] ? 0 : 1),
				':cardfooter_comments'    => (!$account_info['cardfooter_comments'] ? 0 : 1),
			];
			
			$sql
				 = "INSERT INTO `staff_card_footer_permission` (
					staff_id,
					cardfooter_duedate,
					cardfooter_wsjf,
					cardfooter_sp,
					cardfooter_attachments,
					cardfooter_sme,
					cardfooter_comments
				) VALUES (
					:staff_id,
					:cardfooter_duedate,
					:cardfooter_wsjf,
					:cardfooter_sp,
					:cardfooter_attachments,
					:cardfooter_sme,
					:cardfooter_comments
				)
				ON DUPLICATE KEY UPDATE
					cardfooter_duedate = :cardfooter_duedate,
					cardfooter_wsjf = :cardfooter_wsjf,
					cardfooter_sp = :cardfooter_sp,
					cardfooter_attachments = :cardfooter_attachments,
					cardfooter_sme = :cardfooter_sme,
					cardfooter_comments = :cardfooter_comments
					";
			$stm = $this->pdo->prepare($sql);
			$stm->execute($data);
			return true;
		}
		catch (PDOException $e) {
		
		}
	}
	
	public function getStaffCardPermission($staff_id)
	{
		
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `staff_card_footer_permission` WHERE `staff_id` = :staff_id");
			$stm->bindParam(':staff_id', $staff_id);
			$stm->execute();
			$show_cardfooter = $stm->fetch(PDO::FETCH_ASSOC);
			return $show_cardfooter;
		}
		catch (PDOException $e) {
		}
		return false;
		
	}
	
	public function getTopicsPermissionByStaffId($staff_id)
	{
		
		try {
			$allow = 1;
			$stm   = $this->pdo->prepare("SELECT topic_id FROM `staff_manageable_topics` WHERE `staff_id` = :staff_id AND `allow` = :allow");
			$stm->bindParam(':staff_id', $staff_id);
			$stm->bindParam(':allow', $allow);
			$stm->execute();
			$topic_ids        = $stm->fetchAll(PDO::FETCH_ASSOC);
			$topic_permission = [];
			foreach ($topic_ids as $topic_id) {
				$topic_permission[] = $topic_id['topic_id'];
			}
			
			return $topic_permission;
		}
		catch (PDOException $e) {
		}
		return false;
		
	}
	
	/**
	 * @param int $staff_id
	 * @param string $model_type
	 * @param int $model_id
	 * @return bool
	 */
	public function getWatcher($staff_id = 0, $model_type = 'feature', $model_id = 0)
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `watchers` WHERE `staff_id` = :staff_id AND model_type = :model_type AND model_id = :model_id");
			$stm->bindParam(':staff_id', $staff_id);
			$stm->bindParam(':model_type', $model_type);
			$stm->bindParam(':model_id', $model_id);
			$stm->execute();
			$watcher = $stm->fetch(PDO::FETCH_ASSOC);
			return $watcher;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @param int $staff_id
	 * @param string $model_type
	 * @param int $model_id
	 * @param int $watch
	 * @return bool
	 */
	public function saveWatcher($staff_id = 0, $model_type = 'feature', $model_id = 0, $watch = 0)
	{
		try {
			if ($watch) {
				$is_watching = $this->getWatcher($staff_id, $model_type, $model_id);
				if (!$is_watching) {
					$sql = "INSERT INTO `watchers` (staff_id, model_type, model_id) VALUES (:staff_id, :model_type, :model_id)";
					$stm = $this->pdo->prepare($sql);
					$stm->bindParam(':staff_id', $staff_id);
					$stm->bindParam(':model_type', $model_type);
					$stm->bindParam(':model_id', $model_id);
					$stm->execute();
				}
			} else {
				$sql = "DELETE from watchers where staff_id = :staff_id AND model_type = :model_type AND model_id = :model_id";
				$stm = $this->pdo->prepare($sql);
				$stm->bindParam(':staff_id', $staff_id);
				$stm->bindParam(':model_type', $model_type);
				$stm->bindParam(':model_id', $model_id);
				$stm->execute();
			}
			return true;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @param int $staff_id
	 * @param string $model_type
	 * @return bool
	 */
	public function getWatchingTopics($staff_id = 0, $model_type = 'topic')
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `watchers` WHERE `staff_id` = :staff_id AND model_type = :model_type");
			$stm->bindParam(':staff_id', $staff_id);
			$stm->bindParam(':model_type', $model_type);
			$stm->execute();
			$watchers = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $watchers;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @param int $staff_id
	 * @return bool
	 */
	public function unwatchAllTopics($staff_id = 0)
	{
		try {
			$sql = "DELETE from watchers where staff_id = :staff_id AND model_type = 'topic'";
			$stm = $this->pdo->prepare($sql);
			$stm->bindParam(':staff_id', $staff_id);
			$stm->execute();
			return true;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	/**
	 * @param int $staff_id
	 * @param array $topic_ids
	 * @return bool
	 */
	public function unwatchOtherTopics($staff_id = 0, $topic_ids = array())
	{
		try {
			$sql = "DELETE from watchers where staff_id = :staff_id AND model_type = 'topic' AND model_id NOT IN (" . "'" . implode("', '", $topic_ids) . "'" . ")";
			$stm = $this->pdo->prepare($sql);
			$stm->bindParam(':staff_id', $staff_id);
			$stm->execute();
			return true;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	public function getWatcherByModelAndModalId($model_type, $model_id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT staff_id FROM `watchers` WHERE model_type = :model_type AND model_id = :model_id");
			$stm->bindParam(':model_type', $model_type);
			$stm->bindParam(':model_id', $model_id);
			$stm->execute();
			$watchers    = $stm->fetchAll(PDO::FETCH_ASSOC);
			$watcherlist = [];
			foreach ($watchers as $watcher) {
				$watcherlist[] = $watcher['staff_id'];
			}
			
			return $watcherlist;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	public function getFeatureTitleTopicColorByFeatureId($f_id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT features.f_id,features.f_title,featuretypes.highlight_color,topics.name FROM features LEFT JOIN featuretypes ON features.f_type = featuretypes.id LEFT JOIN topics ON features.f_topic_id = topics.id WHERE  features.f_id = :f_id");
			$stm->bindParam(':f_id', $f_id);
			$stm->execute();
			$feature = $stm->fetch(PDO::FETCH_ASSOC);
			return $feature;
		}
		catch (PDOException $e) {
		
		}
	}
	
	public function saveComment($modal, $modal_id, $data, $login_id)
	{
		try {
			
			foreach ($data as $key => $value) {
				if ($value == 'true') {
					$data[$key] = 1;
				}
				if ($value == 'false') {
					$data[$key] = 0;
				}
				if ($value == '') {
					$data[$key] = NULL;
				}
				
			}
			
			$comment_data = [
				':modal'                   => $modal,
				':modal_id'                => $modal_id,
				':parent'                  => $data['parent'],
				':content'                 => $data['content'],
				':creator'                 => $login_id,
				':created_by_current_user' => $data['created_by_current_user'],
				':upvote_count'            => $data['upvote_count'],
				':user_has_upvoted'        => $data['user_has_upvoted'],
			];
			if ($data['id']) {
				$comment_data[':id'] = $data['id'];
				$sql                 = "UPDATE comments SET
						modal = :modal,
						modal_id = :modal_id,
						parent = :parent,
						content = :content,
						creator= :creator,
						created_by_current_user = :created_by_current_user,
						upvote_count = :upvote_count,
						user_has_upvoted = :user_has_upvoted
						WHERE
						id=:id";
			} else {
				$sql = "INSERT INTO `comments` (
						modal,
						modal_id,
						parent,
						content,
						creator,
						created_by_current_user,
						upvote_count,
						user_has_upvoted
					) VALUES (
						:modal,
						:modal_id,
						:parent,
						:content,
						:creator,
						:created_by_current_user,
						:upvote_count,
						:user_has_upvoted
					)";
			}
			//	echo str_replace(array_keys($comment_data), array_values($comment_data), $sql);exit;
			$stm = $this->pdo->prepare($sql);
			$stm->execute($comment_data);
			if ($data['id']) {
				$c_id = $data['id'];
			} else {
				$c_id = $this->pdo->lastInsertId();
			}
			
			$stm = $this->pdo->prepare("DELETE FROM `pings` WHERE `c_id` = :c_id;");
			$stm->bindParam(':c_id', $c_id);
			$stm->execute();
			
			if ($data['pings']) {
				
				foreach ($data['pings'] as $key => $value) {
					
					$pings_data = [
						':c_id'       => $c_id,
						':staff_id'   => $key,
						':staff_name' => $value,
					
					];
					$sql        = "INSERT INTO `pings` (
						c_id,
						staff_id,
						staff_name
					) VALUES (
						:c_id,
						:staff_id,
						:staff_name
					)";
					$stm        = $this->pdo->prepare($sql);
					$stm->execute($pings_data);
				}
				
			}
			return $c_id;
			
		}
		catch (PDOException $e) {
		}
		
	}
	
	public function getCommentsByIdAndType($modal_id, $modal)
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `comments` WHERE `modal` = :modal AND `modal_id` = :modal_id");
			$stm->bindParam(':modal_id', $modal_id);
			$stm->bindParam(':modal', $modal);
			$stm->execute();
			$comments = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $comments;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	public function getPingByCommentID($id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT staff_id,staff_name FROM `pings` WHERE `c_id` = :c_id");
			$stm->bindParam(':c_id', $id);
			$stm->execute();
			$pings_data = $stm->fetchAll(PDO::FETCH_ASSOC);
			$pings      = [];
			foreach ($pings_data as $ping_info) {
				$pings[$ping_info['staff_id']] = $ping_info['staff_name'];
			}
			
			return $pings;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	public function deleteComment($data)
	{
		try {
			$c_id = $data['id'];
			$stm  = $this->pdo->prepare("DELETE FROM `comments` WHERE `id` = :c_id;");
			$stm->bindParam(':c_id', $c_id);
			$stm->execute();
			
			$stm = $this->pdo->prepare("DELETE FROM `pings` WHERE `c_id` = :c_id;");
			$stm->bindParam(':c_id', $c_id);
			$stm->execute();
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	public function getFeatureMatchedByJiraId($epic_id, $status_id, $pi_id, $lower_limit, $page_limit)
	{
		try {
			$data = array();
			
			$where .= 'WHERE feature_details.f_jira_id IN(SELECT j_key FROM `jira_tickets`)';
			if ($epic_id != 0) {
				$where           .= " AND feature_details.f_epic = :f_epic";
				$data[':f_epic'] = $epic_id;
			}
			if ($status_id != 0) {
				$where                .= " AND features.f_status_id = :f_status_id";
				$data[':f_status_id'] = $status_id;
			}
			if ($pi_id != 0) {    
				$where                .= " AND features.f_PI = :f_PI";
				$data[':f_PI'] = $pi_id;
			}   
      
			
			$sql = "SELECT features.f_id,feature_details.f_jira_id  FROM `features` LEFT JOIN feature_details ON feature_details.f_id = features.f_id $where ORDER BY `features`.`f_id` DESC limit $lower_limit,$page_limit";
			$stm = $this->pdo->prepare($sql);
			$stm->execute($data);
			$feature = $stm->fetchAll(PDO::FETCH_ASSOC);
			
			return $feature;
      

			
		}
		catch (PDOException $e) {
		
		}
		return false;
	}
	
	public function getFeatureMatchedByJiraIdCount($epic_id, $status_id, $pi_id)
	{
		try {
			$data = array();
			
			$where .= 'WHERE feature_details.f_jira_id IN(SELECT j_key FROM `jira_tickets`)';
			if ($epic_id != 0) {
				$where           .= " AND feature_details.f_epic = :f_epic";
				$data[':f_epic'] = $epic_id;
			}              
			if ($status_id != 0) {
				$where                .= " AND features.f_status_id = :f_status_id";
				$data[':f_status_id'] = $status_id;
			}   
			if ($pi_id != 0) {          
				$where                .= " AND features.f_PI = :f_PI";
				$data[':f_PI'] = $pi_id;
			}    
			
			$sql = "SELECT features.f_id,feature_details.f_jira_id  FROM `features` LEFT JOIN feature_details ON feature_details.f_id = features.f_id $where ORDER BY `features`.`f_id` DESC";
			$stm = $this->pdo->prepare($sql);
			$stm->execute($data);
			$feature = $stm->fetchAll(PDO::FETCH_ASSOC);

			return count($feature);
			
		}
		catch (PDOException $e) {
		
		}
		return false;
	}
	
	
	public function getJiraTicketById($f_jira_id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `jira_tickets` WHERE `j_key` = :j_key");
			$stm->bindParam(':j_key', $f_jira_id);
			$stm->execute();
			$jira_ticket = $stm->fetch(PDO::FETCH_ASSOC);
			return $jira_ticket;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	public function getJiraTicketsNotMatched($lower_limit, $page_limit)
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `jira_tickets` WHERE `j_key` NOT IN (SELECT f_jira_id FROM `feature_details` WHERE `f_jira_id` IS NOT NULL) ORDER BY `id` desc LIMIT $lower_limit,$page_limit");
			
			$stm->execute();
			$jira_ticket = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $jira_ticket;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	public function getJiraTicketsNotMatchedCount()
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `jira_tickets` WHERE `j_key` NOT IN (SELECT f_jira_id FROM `feature_details` WHERE `f_jira_id` IS NOT NULL) ORDER BY `id` desc");
			
			$stm->execute();
			$jira_ticket = $stm->fetchAll(PDO::FETCH_ASSOC);
			return count($jira_ticket);
		}
		catch (PDOException $e) {
		}
		return false;
	}
	public function getFeatureNonMatchedByJiraId($epic_id, $status_id, $pi_id, $lower_limit, $page_limit)
	{
		try {
			$data = array();
			
			$where .= 'WHERE (feature_details.f_jira_id Not IN(SELECT j_key FROM `jira_tickets`) OR feature_details.f_jira_id IS NULL)';
			if ($epic_id != 0) {
				$where           .= " AND feature_details.f_epic = :f_epic";
				$data[':f_epic'] = $epic_id;
			}
			if ($status_id != 0) {
				$where                .= " AND features.f_status_id = :f_status_id";
				$data[':f_status_id'] = $status_id;
			}
			if ($pi_id != 0) {          
				$where                .= " AND features.f_PI = :f_PI";
				$data[':f_PI'] = $pi_id;
			}           
			
			$sql = "SELECT features.f_id,feature_details.f_jira_id  FROM `features` LEFT JOIN feature_details ON feature_details.f_id = features.f_id $where ORDER BY `features`.`f_id` DESC limit $lower_limit,$page_limit";
			$stm = $this->pdo->prepare($sql);
			$stm->execute($data);
			$feature = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $feature;
		}
		catch (PDOException $e) {
		
		}
		return false;
	}
	
	public function getFeatureNonMatchedByJiraIdCount($epic_id, $status_id, $pi_id)
	{
		try {
			$data = array();
			
			$where .= 'WHERE (feature_details.f_jira_id Not IN(SELECT j_key FROM `jira_tickets`) OR feature_details.f_jira_id IS NULL)';
			if ($epic_id != 0) {
				$where           .= " AND feature_details.f_epic = :f_epic";
				$data[':f_epic'] = $epic_id;
			}
			if ($status_id != 0) {
				$where                .= " AND features.f_status_id = :f_status_id";
				$data[':f_status_id'] = $status_id;
			}
			if ($pi_id != 0) {          
				$where                .= " AND features.f_PI = :f_PI";
				$data[':f_PI'] = $pi_id;
			}       
      
			$sql = "SELECT features.f_id,feature_details.f_jira_id  FROM `features` LEFT JOIN feature_details ON feature_details.f_id = features.f_id $where ORDER BY `features`.`f_id` DESC";
			$stm = $this->pdo->prepare($sql);
			$stm->execute($data);
			$feature = $stm->fetchAll(PDO::FETCH_ASSOC);
			
      
			return count($feature);
		}
		catch (PDOException $e) {
		
		}
		return false;
	}
	public function updateFeatureJiraNote($f_id, $f_jira_notes)
	{
		try {
			$stm = $this->pdo->prepare("UPDATE `feature_details` SET f_jira_notes = :f_jira_notes WHERE `f_id` = :f_id ");
			$stm->bindParam(':f_jira_notes', $f_jira_notes);
			$stm->bindParam(':f_id', $f_id);
			$stm->execute();
			return true;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	public function getUserInfoByUsername($username)
	{
		
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `staff` WHERE `username` = :username");
			$stm->bindParam(':username', $username);
			$stm->execute();
			$userdata = $stm->fetch(PDO::FETCH_ASSOC);
			return $userdata;
		}
		catch (PDOException $e) {
		}
		return false;
	}
  
	/**
	 * @return bool
	 */
	public function getAllJira()
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `jira_tickets`");
			$stm->execute();
			$jira = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $jira;
		}
		catch (PDOException $e) {
		}
		return false;
	}  
	public function getAllDepartements()
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `oe` WHERE `oe_type` = 'Dep'");
			$stm->execute();
			$pi = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $pi;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	public function getProductIncrementById($pi_id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `productincrements` WHERE `pi_id` = :pi_id");
			$stm->bindParam(':pi_id', $pi_id);
			$stm->execute();
			$pi = $stm->fetch(PDO::FETCH_ASSOC);
			return $pi;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	public function getOeById($oe_id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `oe` WHERE `oe_id` = :oe_id");
			$stm->bindParam(':oe_id', $oe_id);
			$stm->execute();
			$oe = $stm->fetch(PDO::FETCH_ASSOC);
			return $oe;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	public function getFeatureByStatusAndTopic($f_status, $f_topics)
	{
		try {
			$f_status_ids = implode(',', $f_status);
			$f_topic_id   = implode(',', $f_topics);
			
			$where                = "WHERE  FIND_IN_SET (features.f_status_id, :f_status_id)";
			$data                 = array();
			$data[':f_status_id'] = $f_status_ids;
			if (isset($f_topics[0]) && !empty($f_topics[0])) {
				$where               .= " AND FIND_IN_SET (features.f_topic_id, :f_topic_id)";
				$data[':f_topic_id'] = $f_topic_id;
			}
			$sql = "SELECT features.*, feature_details.f_note FROM `features` LEFT JOIN feature_details ON feature_details.f_id = features.f_id " . $where . " ORDER BY features.f_ranking ASC ";
			$stm = $this->pdo->prepare($sql);
			$stm->execute($data);
			$features = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $features;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	public function updateFeatureNote($f_id, $f_note)
	{
		try {
			$stm = $this->pdo->prepare("UPDATE `feature_details` SET f_note = :f_note WHERE `f_id` = :f_id ");
			$stm->bindParam(':f_note', $f_note);
			$stm->bindParam(':f_id', $f_id);
			$stm->execute();
			return true;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	public function getFPRankingInfo($f_id, $pi_id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `fp_rankings` WHERE `fp_fid` = :fp_fid AND `fp_piid` = :fp_piid");
			$stm->bindParam(':fp_fid', $f_id);
			$stm->bindParam(':fp_piid', $pi_id);
			$stm->execute();
			$fpranaking = $stm->fetch(PDO::FETCH_ASSOC);
			if (empty($fpranaking)) {
				
				$insert_data = [
					':fp_fid'  => $f_id,
					':fp_piid' => $pi_id,
				];
				$sql         = "INSERT INTO `fp_rankings` (
							fp_fid,
							fp_piid
						) VALUES (
							:fp_fid,
							:fp_piid
						)";
				$stm         = $this->pdo->prepare($sql);
				$stm->execute($insert_data);
				return $this->getFPRankingInfo($f_id, $pi_id);
			} else {
				return $fpranaking;
			}
			
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	public function updateFpRanking($fp_id, $fp_BV, $fp_TC, $fp_RROE, $fp_JS)
	{
		try {
			$stm = $this->pdo->prepare("UPDATE `fp_rankings` SET `fp_BV`= :fp_BV,`fp_TC`= :fp_TC,`fp_RROE`= :fp_RROE,`fp_JS`= :fp_JS WHERE fp_id = :fp_id");
			$stm->bindParam(':fp_id', $fp_id);
			$stm->bindParam(':fp_BV', $fp_BV);
			$stm->bindParam(':fp_TC', $fp_TC);
			$stm->bindParam(':fp_RROE', $fp_RROE);
			$stm->bindParam(':fp_JS', $fp_JS);
			$stm->execute();
			return true;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	public function saveDrRanking($fp_id, $data_info)
	{
		try {
			
			$data = [
				':dr_oeid'  => $data_info['oe'],
				':dr_fprid' => $fp_id,
			];
			$stm  = $this->pdo->prepare("SELECT * FROM `deptrankings` WHERE `dr_oeid` = :dr_oeid AND `dr_fprid` = :dr_fprid");
			$stm->execute($data);
			$drranaking               = $stm->fetch(PDO::FETCH_ASSOC);
			$data[':dr_rankingvalue'] = $data_info['dr_rankingvalue'];
			if (empty($drranaking)) {
				$sql = "INSERT INTO `deptrankings` (
					dr_oeid,
					dr_fprid,
					dr_rankingvalue
				) VALUES (
					:dr_oeid,
					:dr_fprid,
					:dr_rankingvalue
				)
				";
				$stm = $this->pdo->prepare($sql);
				$stm->execute($data);
				return true;
			} else {
				
				$stm = $this->pdo->prepare("UPDATE `deptrankings` SET `dr_rankingvalue`= :dr_rankingvalue WHERE `dr_oeid` = :dr_oeid AND `dr_fprid` = :dr_fprid");
				$stm->execute($data);
			}
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	public function getDrRanking($dr_fprid, $dr_oeid)
	{
		try {
			$data = [
				':dr_oeid'  => $dr_oeid,
				':dr_fprid' => $dr_fprid,
			];
			$stm  = $this->pdo->prepare("SELECT * FROM `deptrankings` WHERE `dr_oeid` = :dr_oeid AND `dr_fprid` = :dr_fprid");
			$stm->execute($data);
			$drranaking = $stm->fetch(PDO::FETCH_ASSOC);
			return $drranaking;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	
	public function saveDrNotes($fp_id, $data_info)
	{
		try {
			
			$data = [
				':dr_oeid'  => $data_info['oe'],
				':dr_fprid' => $fp_id,
			];
			$stm  = $this->pdo->prepare("SELECT * FROM `deptrankings` WHERE `dr_oeid` = :dr_oeid AND `dr_fprid` = :dr_fprid");
			$stm->execute($data);
			$drranaking               = $stm->fetch(PDO::FETCH_ASSOC);
			$data[':dr_notes'] = $data_info['dr_notes'];
			if (empty($drranaking)) {
				$sql = "INSERT INTO `deptrankings` (
					dr_oeid,
					dr_fprid,
					dr_notes
				) VALUES (
					:dr_oeid,
					:dr_fprid,
					:dr_notes
				)
				";
				$stm = $this->pdo->prepare($sql);
				$stm->execute($data);
				return true;
			} else {
				
				$stm = $this->pdo->prepare("UPDATE `deptrankings` SET `dr_notes`= :dr_notes WHERE `dr_oeid` = :dr_oeid AND `dr_fprid` = :dr_fprid");
				$stm->execute($data);
			}
		}
		catch (PDOException $e) {
		}
		return false;
	}
	public function getJiraTicketsNotMatchedList()
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `jira_tickets` WHERE `j_key` NOT IN (SELECT f_jira_id FROM `feature_details` WHERE `f_jira_id` IS NOT NULL) ORDER BY `id` desc");
			
			$stm->execute();
			$jira_ticket = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $jira_ticket;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	public function updateFeatureJiraId($f_id,$f_jira_id)
	{
		try {
			$stm = $this->pdo->prepare("UPDATE `feature_details` SET f_jira_id = :f_jira_id WHERE `f_id` = :f_id ");
			$stm->bindParam(':f_jira_id', $f_jira_id);
			$stm->bindParam(':f_id', $f_id);
			$stm->execute();
			return true;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	public function updateFeatureJiraMatch($f_id,$f_jira_match)
	{
		try {
			echo $f_jira_match;
			$stm = $this->pdo->prepare("UPDATE `feature_details` SET f_jira_match = :f_jira_match WHERE `f_id` = :f_id ");
			$stm->bindParam(':f_jira_match', $f_jira_match);
			$stm->bindParam(':f_id', $f_id);
			$stm->execute();
			return true;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	public function getFeaturesNotMatchedList($epic_id, $status_id, $pi_id)
	{
		try {
			$data = array();
			
			$where .= 'WHERE (feature_details.f_jira_id Not IN(SELECT j_key FROM `jira_tickets`) OR feature_details.f_jira_id IS NULL)';
			if ($epic_id != 0) {
				$where           .= " AND feature_details.f_epic = :f_epic";
				$data[':f_epic'] = $epic_id;
			}
			if ($status_id != 0) {
				$where                .= " AND features.f_status_id = :f_status_id";
				$data[':f_status_id'] = $status_id;
			}
			if ($pi_id != 0) {
				$where                .= " AND features.f_PI = :f_PI";
				$data[':f_PI'] = $pi_id;
			}
			
			$sql = "SELECT features.f_id,features.f_PI,features.f_title FROM `features` LEFT JOIN feature_details ON feature_details.f_id = features.f_id $where ORDER BY `features`.`f_id` DESC";
			$stm = $this->pdo->prepare($sql);
			$stm->execute($data);
			$feature = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $feature;
		}
		catch (PDOException $e) {
		
		}
		return false;
	}
	public function updateJiraKommentar($j_key, $kommentar)
	{
		try {
			$stm = $this->pdo->prepare("UPDATE `jira_tickets` SET kommentar = :kommentar WHERE `j_key` = :j_key ");
			$stm->bindParam(':kommentar', $kommentar);
			$stm->bindParam(':j_key', $j_key);
			$stm->execute();
			return true;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	public function updateJiraMatch($j_key,$jira_match)
	{
		try {
			
			$stm = $this->pdo->prepare("UPDATE `jira_tickets` SET jira_match = :jira_match WHERE `j_key` = :j_key ");
			$stm->bindParam(':jira_match', $jira_match);
			$stm->bindParam(':j_key', $j_key);
			$stm->execute();
			return true;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	public function storeCustomerInput($staff_id,$customer_input_url)
	{
		try {
			$stm = $this->pdo->prepare("UPDATE `staff` SET customer_input_url = :customer_input_url WHERE `staff_id` = :staff_id ");
			$stm->bindParam(':staff_id', $staff_id);
			$stm->bindParam(':customer_input_url', $customer_input_url);
			$stm->execute();
			return true;
		}
		catch (PDOException $e) {
		}
		return false;
	}
	public function getCustomerInput($staff_id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT customer_input_url FROM `staff` WHERE `staff_id` = :staff_id");
			$stm->bindParam(':staff_id', $staff_id);
			$stm->execute();
			$staff_customer_url = $stm->fetch(PDO::FETCH_ASSOC);
			return $staff_customer_url['customer_input_url'];
		}
		catch (PDOException $e) {
		}
		return false;
	}
}