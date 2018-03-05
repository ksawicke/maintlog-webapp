<?php

/**
 * Handles checklist item object interactions.
 */
class Checklistitem_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('Rb');
        
        date_default_timezone_set('America/Phoenix');
    }
    
    /**
     * Finds a single checklist item object.
     * 
     * @param type $equipmenttype_id
     * @return array
     */
    public function findOne($checklistitem_id) {
        $checklistitem = R::findOne('checklistitem', ' id = :checklistitem_id ', [':checklistitem_id' => $checklistitem_id]);
        
        return $checklistitem;
    }
    
    /**
     * Finds all checklist item objects.
     * 
     * @return array
     */
    public function findAll($checklist_equipmenttype_id = '')
	{
		$checklistitems = R::getAll('SELECT * FROM checklistitem');
		$checklistitemsOrig = $checklistitems;
		$preStartItems = [];
		$postStartItems = [];
		$checklist = [];

		/** Sorts by item ASC; we need to preserve order of checklist_json */
		array_multisort(array_map(function($element) {
			return $element['item'];
		}, $checklistitemsOrig), SORT_ASC, $checklistitemsOrig);

		if ($checklist_equipmenttype_id != '') {
			$checklist = R::findAll('checklist', ' equipmenttype_id = :equipmenttype_id ', [':equipmenttype_id' => $checklist_equipmenttype_id]);
		}

		if (!empty($checklist)) {
			foreach ($checklist as $key => $cldata) {
				$checklist_json = $cldata['checklist_json'];
			}

			$checklist = (array) json_decode($checklist_json);

			foreach($checklistitems as $key => $clidata) {
				if(in_array($clidata['id'], $checklist['preStartData'])) {
					$preStartItems[$key] = $checklistitems[$key];
					unset($checklistitems[$key]);
				}
				if(in_array($clidata['id'], $checklist['postStartData'])) {
					$postStartItems[$key] = $checklistitems[$key];
					unset($checklistitems[$key]);
				}
			}
		}

//		array_multisort(array_map(function($element) {
//			return $element['item'];
//		}, $checklistitems), SORT_ASC, $checklistitems);

        return ['checklistitems' => $checklistitemsOrig, 'checklistitemsremaining' => $checklistitems, 'checklist' => $checklist, 'preStartItems' => $preStartItems, 'postStartItems' => $postStartItems];
    }

	/**
     * Creates or modifies a checklist item object.
     */
    public function store($post) {        
        $now = date('Y-m-d h:i:s');

        $checklistitem = ($post['checklistitem_id']==0 ? R::dispense('checklistitem') : R::load('checklistitem', $post['checklistitem_id']));
        $checklistitem->item = $post['item'];

        if($post['checklistitem_id']==0) {
            $checklistitem->created = $now;
            $checklistitem->created_by = $_SESSION['user_id'];
        } else {
            $checklistitem->modified = $now;
            $checklistitem->modified_by = $_SESSION['user_id'];
        }

        R::store($checklistitem);
    }
    
    /**
     * Deletes a checklist item type object.
     * 
     * @param integer $checklistitem_id
     */
    public function delete($checklistitem_id = null) {
        if(!is_null($checklistitem_id)) {
            $checklistitem = R::load('checklistitem', $checklistitem_id);
            R::trash($checklistitem);
        }
    }

}
