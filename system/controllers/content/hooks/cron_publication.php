<?php

class onContentCronPublication extends cmsAction {

	public function run(){

		$ctypes = $this->model->getContentTypes();

        $is_pub_items = array();

		foreach($ctypes as $ctype){

			if (!$ctype['is_date_range']) { continue; }

            $pub_items = $this->model->filterNotEqual('is_pub', 1)->filter('i.date_pub <= NOW()')->get($this->model->table_prefix.$ctype['name']);

            if($pub_items){
                $this->model->publishDelayedContentItems($ctype['name']);
                $is_pub_items[$ctype['name']] = $pub_items;
            }

            if($ctype['options']['is_date_range_process'] === 'delete') {
                $this->model->deleteExpiredContentItems($ctype['name']);
            } else {
                $this->model->hideExpiredContentItems($ctype['name']);
            }

		}

        if($is_pub_items){
            cmsEventsManager::hook('publish_delayed_content', $is_pub_items);
        }

    }

}
