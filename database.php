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
		$dsn       = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
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
		} catch (PDOException $e) {
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
		} catch (PDOException $e) {
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
		} catch (PDOException $e) {
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
		} catch (PDOException $e) {
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
			//	$stm = $this->pdo->prepare("SELECT * FROM `productincrements` WHERE `pi_id` != :exclude_pi_id AND `pi_id` > :exclude_pi_id limit 0,3");
			$stm = $this->pdo->prepare("SELECT * FROM `productincrements` WHERE `pi_id` != :exclude_pi_id AND `pi_id` > :exclude_pi_id");
			$stm->bindParam(':exclude_pi_id', $exclude_pi_id);
			$stm->execute();
			$pis = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $pis;
		} catch (PDOException $e) {
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
		} catch (PDOException $e) {
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
		} catch (PDOException $e) {
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
		} catch (PDOException $e) {
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
		} catch (PDOException $e) {
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
		} catch (PDOException $e) {
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
			$stm = $this->pdo->prepare("SELECT features.*,featuretypes.highlight_color, feature_details.f_mehr_details FROM `features` LEFT JOIN featuretypes ON features.f_type = featuretypes.id
LEFT JOIN feature_details ON feature_details.f_id = features.f_id WHERE features.f_topic_id = :f_topic_id AND features.f_PI = :f_PI  ORDER BY features.f_ranking ASC ");
			$stm->bindParam(':f_topic_id', $topic_id);
			$stm->bindParam(':f_PI', $pi_id);
			$stm->execute();
			$features = $stm->fetchAll(PDO::FETCH_ASSOC);
			return $features;
		} catch (PDOException $e) {
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
		} catch (PDOException $e) {
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
							WHERE f.`f_is_FR` = '1'
							  AND fd.f_SME = :f_SME
			";
			$stm = $this->pdo->prepare($sql);
			$stm->bindParam(':f_SME', $sme);
			$stm->execute();
			$feature = $stm->fetchALL(PDO::FETCH_ASSOC);
			return $feature;
		} catch (PDOException $e) {
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
			foreach ($feature_info as $key=>$value){
				if($value == ''){
					if($key == 'f_status_id'){
						$feature_info[$key] = 5;
					}else{
						$feature_info[$key] = NULL;
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

		} catch (PDOException $e) {
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
				':f_storypoints' => 0,
				':f_topic_id'    => $feature_info['f_topic'],
				':f_PI'          => 0,
				':f_ranking'     => 0,
				':f_status_id'   => $feature_info['f_status_id'],
				':f_type'        => 1,
				':f_BV'          => 0,
				':f_TC'          => 0,
				':f_RROE'        => 0,
				':f_JS'          => 0,
				':f_is_FR'       => 1
			];

			if (!$feature_info['f_id']) {
				$sql = "INSERT INTO features (f_title,f_desc,f_storypoints,f_topic_id,f_PI,f_ranking,f_status_id,f_type,f_BV,f_TC,f_RROE,f_JS,f_is_FR) VALUES (:f_title,:f_desc,:f_storypoints,:f_topic_id,:f_PI,:f_ranking,:f_status_id,:f_type,:f_BV,:f_TC,:f_RROE,:f_JS,:f_is_FR)";
				unset($data[':f_id']);
			} else {
				$data = [
					':f_id'        => $feature_info['f_id'],
					':f_title'     => $feature_info['f_title'],
					':f_desc'      => $feature_info['f_desc'],
					':f_status_id' => $feature_info['f_status_id'],
					':f_topic_id'  => $feature_info['f_topic'],
					':f_is_FR'     => 1
				];
				$sql  = "UPDATE features SET f_title=:f_title, f_desc=:f_desc, f_status_id=:f_status_id,f_topic_id=:f_topic_id, f_is_FR=:f_is_FR WHERE f_id=:f_id";
			}
			$stm = $this->pdo->prepare($sql);

			$stm->execute($data);

			$f_id                 = (!$feature_info['f_id'] ? $this->pdo->lastInsertId() : $feature_info['f_id']);
			$feature_info['f_id'] = $f_id;

			// Save details
			return $this->saveFeatureDetails($f_id, $feature_info);

		} catch (PDOException $e) {
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
					f_risks
					
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
					:f_risks
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
					f_risks = :f_risks
					";
			$stm = $this->pdo->prepare($sql);

			$stm->execute($data);
			return true;

		} catch (PDOException $e) {
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

			// Save details
			return $this->saveEpicDetails($e_id, $epic_info);

		} catch (PDOException $e) {
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
				':e_id'                   => $e_id,
				':e_hs_for'               => $epic_info['e_hs_for'],
				':e_hs_for_desc'          => $epic_info['e_hs_for_desc'],
				':e_hs_solution'          => $epic_info['e_hs_solution'],
				':e_hs_how'               => $epic_info['e_hs_how'],
				':e_hs_value'             => $epic_info['e_hs_value'],
				':e_hs_unlike'            => $epic_info['e_hs_unlike'],
				':e_hs_oursoluion'        => $epic_info['e_hs_oursoluion'],
				':e_hs_businessoutcome'   => $epic_info['e_hs_businessoutcome'],
				':e_hs_leadingindicators' => $epic_info['e_hs_leadingindicators'],
				':e_hs_nfr'               => $epic_info['e_hs_nfr'],
				':e_notes'                => $epic_info['e_notes']
			];

			$sql
				   = "INSERT INTO `epic_details` (
								e_id,
								`e_hs_for`,
								`e_hs_for_desc`,
								e_hs_solution,
								e_hs_how,
								e_hs_value,
								e_hs_unlike,
								e_hs_oursoluion,
								e_hs_businessoutcome,
								e_hs_leadingindicators,
								e_hs_nfr,
								e_notes
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
								:e_notes
							)
							ON DUPLICATE KEY UPDATE
								`e_hs_for` = :e_hs_for,
								`e_hs_for_desc` = :e_hs_for_desc,
								e_hs_solution = :e_hs_solution,
								e_hs_how = :e_hs_how,
								e_hs_value = :e_hs_value,
								e_hs_unlike = :e_hs_unlike,
								e_hs_oursoluion = :e_hs_oursoluion,
								e_hs_businessoutcome = :e_hs_businessoutcome,
								e_hs_leadingindicators = :e_hs_leadingindicators,
								e_hs_nfr = :e_hs_nfr,
								e_notes = :e_notes
								";
			$stm = $this->pdo->prepare($sql);

			$stm->execute($data);
			#echo str_replace(array_keys($data), array_values($data), $sql);exit;
			return true;

		} catch (PDOException $e) {
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
			define('W_ROOT', 'http://localhost/pm_tool');

			$countfiles = count($_FILES['f_file']['name']);
			if ($countfiles > 0) {

				// Looping all files
				for ($i = 0; $i < $countfiles; $i++) {
					$filename = $_FILES['f_file']['name'][$i];

					if ($filename) {
						$f_file_name = explode('.', $filename);
						$newfilename = $f_file_name[0].'_'.date('dmYHis').'.'.$f_file_name[1];

						move_uploaded_file($_FILES['f_file']['tmp_name'][$i], 'upload/'.$newfilename);
						$fileurl = W_ROOT.'/upload/'.$newfilename;

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
		} catch (PDOException $e) {
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
		} catch (PDOException $e) {
		}
		return false;
	}

	/**
	 * @param $pi_id
	 * @param $f_ids
	 * @return bool
	 */
	public function updateFeatureRanking($pi_id, $f_ids)
	{
		try {
			$f_ids = explode(',', $f_ids);

			foreach ($f_ids as $key => $value) {
				$stm = $this->pdo->prepare("UPDATE `features` SET f_PI = :f_PI,f_ranking = :f_ranking WHERE `f_id` = :f_id ");
				$stm->bindParam(':f_ranking', $key);
				$stm->bindParam(':f_PI', $pi_id);
				$stm->bindParam(':f_id', $value);
				$stm->execute();
			}
			return true;
		} catch (PDOException $e) {
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
		} catch (PDOException $e) {
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
		} catch (PDOException $e) {
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
		} catch (PDOException $e) {
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
		} catch (PDOException $e) {
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
			unlink('upload/'.$file_name);

		} catch (PDOException $e) {
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
			$stm = $this->pdo->prepare("SELECT staff_id,staff_firstname,staff_lastname,username,can_edit_roadmap,can_edit_epic_feature,can_manage_config FROM `staff` WHERE `username` = :username AND `password` = :password");
			$stm->bindParam(':username', $username);
			$stm->bindParam(':password', $password);
			$stm->execute();
			$userdata = $stm->fetch(PDO::FETCH_ASSOC);
			return $userdata;
		} catch (PDOException $e) {
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
		} catch (PDOException $e) {
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
		} catch (PDOException $e) {
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
		} catch (PDOException $e) {
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
		} catch (PDOException $e) {
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
		} catch (PDOException $e) {
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
		} catch (PDOException $e) {
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
		} catch (PDOException $e) {
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
		} catch (PDOException $e) {
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
		} catch (PDOException $e) {
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
		} catch (PDOException $e) {
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
		} catch (PDOException $e) {
		}
		return false;
	}

	/**
	 * Enter capacity of missing staff and pi
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
		} catch (PDOException $e) {
		}
		return false;
	}

	public function getEpicsStatusByID($id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT name FROM `epics_statuses` WHERE `id` = :id");
			$stm->bindParam(':id', $id);
			$stm->execute();
			$epics = $stm->fetch(PDO::FETCH_ASSOC);
			return $epics;
		} catch (PDOException $e) {
		}
		return false;
	}
	public function getTeamByID($id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `team` WHERE `id` = :id");
			$stm->bindParam(':id', $id);
			$stm->execute();
			$teams = $stm->fetch(PDO::FETCH_ASSOC);
			return $teams;
		} catch (PDOException $e) {
		}
		return false;
	}
}