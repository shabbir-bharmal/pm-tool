<?php
$topics          = $db->getTopics();
$watching_topics = $db->getWatchingTopics($login_id);
?>
<div class="form-group row mt-3">
    <div class="from-group col-md-9">
        <label for="topics_watcher" class="col-3 col-form-label">Watch Topics: </label>

        <div class="col-md-9 float-right">
            <select name="topics_watcher[]" id="topics_watcher" multiple class="form-control">
                <option value="0">--bitte w<span>&#228;</span>hlen--</option>
				<?php
				if ($topics) {
					foreach ($topics as $topic) {
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