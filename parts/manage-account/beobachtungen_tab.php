<?php
$topics_list         = $db->getTopics();
$watching_topics = $db->getWatchingTopics($login_id);
?>
<div class="form-group row mt-3">
	<div class="from-group col-md-12">
  Du kannst hier definieren, f&uuml;r welche Topics Du informiert werden willst, wenn:
  <ul>
    <li>neue Features</li>
    <li>angepasste Feature</li>
    <li>gel&ouml;schte Features</li>
   </ul>        
   Du erh&auml;lst dann jeweils ein E-Mail.<br />
   Hinweis: Du kannst auf den einzelnen Features ebenfalls eine Beobachtung vornehmen.
	</div>
</div>

<div class="form-group row mt-3">
    <div class="from-group col-md-9">
        <label for="topics_watcher" class="col-3 col-form-label">Topics: </label>

        <div class="col-md-9 float-right">
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

<div class="form-group row mt-3">
	<div class="from-group col-md-12">
  under construction:<br />
  Liste aller Features, die Du folgst. 
	</div>
</div>