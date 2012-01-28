<?php 
class TimeformatBehavior extends ModelBehavior {
	function afterFind($model, $results, $primary) {
	    foreach ($results as $key => $val) {
	    	if (isset($val['Discussion']['date'])) {
	            $results[$key]['Discussion']['date'] = $this->dateFormatAfterFind($val['Discussion']['date']);
	            $results[$key]['Discussion']['date_non_format'] = $val['Discussion']['date'];
	        }

	        if (isset($val['Comment']['date'])) {
	            $results[$key]['Comment']['date'] = $this->dateFormatAfterFind($val['Comment']['date']);
	            $results[$key]['Comment']['date_non_format'] = $val['Comment']['date'];
	        }
	    }
	    return $results;
	}

	function beforeSave($model, $results) {
	    foreach ($results as $key => $val) {
	    	
	        if (isset($model->data['Discussion']['date']) && isset($model->data['Discussion']['date_non_format'])) {
	            $model->data['Discussion']['date'] = $model->data['Discussion']['date_non_format'];
	        }

	        if (isset($model->data['Comment']['date']) && isset($model->data['Comment']['date_non_format'])) {
	            $model->data['Comment']['date'] = $model->data['Comment']['date_non_format'];
	        }
	    	
	    }
	    return $model;
	}
	
	function dateFormatAfterFind($dateString) {
	    return date('d.m.y H:i', strtotime($dateString));
	}
	
}