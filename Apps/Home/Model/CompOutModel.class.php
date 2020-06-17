<?php

namespace Home\Model;
use Think\Model\RelationModel;
class CompOutModel extends RelationModel {
	// protected $tablePrefix = 'tb_'; 
	protected $_link = array(
		'CompReserve' => array(
		    'mapping_type'  => self::BELONGS_TO,
		    'class_name'    => 'CompReserve',
		    'foreign_key'   => 'comp_id',
		    'mapping_name'  => 'compReserve',
		    'mapping_fields'=> array('type','name','standard','store_num','project_pact','comp_pact')
		)
    );
}
