<?php
/**
 * A dummy-class that is included if the user does not supply an appmodel.
 * @package kata_model
 * @author mnt@codeninja.de
 */
require_once (dirname(__FILE__) . "/model.php");
class AppModel extends Model{
	
	protected $_dataset=array();
	protected $_colums=array();
	
	public function __construct()
	{
		parent::dbo()->setEncoding('UTF8'); 	
	}
	
	public function __destruct()
	{
	    
	}
	
	/**
	 * Set a colum value and return
	 * object self.
	 * 
	 * 
	 * @param string $colum
	 * @param mixed $value
	 * @return object 
	 */
	public function set($colum, $value) 
	{
		if (!in_array($colum, $this->_colums)) {
			throw new Exception($colum . ' is not a valid colum.');
		}
		$this->_dataset[$colum] = $value;
		return $this;
	}
	
	/**
	 * Get current value by given colum name
	 * @param $col
	 * @param $value
	 * @return unknown_type
	 */
	public function get($col)
	{
		if (!in_array($col, $this->_colums)){
			throw new Exception($col . " is not valid colum name.");
		}
		if (!isset($this->_dataset[$col])) {
			throw new Exception( $col . " value is not set.");
		}
		return $this->_dataset[$col];
	}
	
	public function findAll()
	{
		return  $this->find(	'all',
								array('order'=>array($this->useIndex))
							);
	}
	
	/**
	 * 
	 * @param $key
	 * @return bool
	 */
	public function loadByPrimaryKey($key)
	{	
		$this->_dataset = array();
		$r=$this->read(array($this->useIndex => $key));
		if (sizeof($r) != 1) {
			// not found or the record is not idenitiy
			throw new Exception('load by primary key failed.');
		}
		/*
		foreach($r[0] as $key => $record) {
			$this->_dataset[$key] = $record; 
		}*/
		$this->_dataset = $r[0];
	    return $this;
	}
	
	/**
	 * insert 
	 * @see src/lib/Model#create($fields, $tableName)
	 */
	public function create($dataSet=null, $useTable=null)
	{
		return parent::create($this->_dataset, $this->useTable);
	}
	
	/**
	 * Update the current dataset in database 
	 * @see src/lib/Model#update($id, $fields, $tableName)
	 */
	public function update($index=null, $data=null, $table=null)
	{
		return parent::update($this->_dataset[$this->useIndex], 
							  $this->_dataset, 
							  $this->useTable);
	}


	
	public function directUpdate($id, array $fields)
	{
		return parent::update($id, $fields);
	}


    /**
     * Delete by promary key.
     *
     * @param $prikey
     * @return mixed
     */
    public function del($prikey)
	{
		return parent::delete($prikey, $this->useTable);
	}
	
	public function getDataset()
	{
		return $this->_dataset;
	}
	
	public function getTbName()
	{
		return parent::getTbName();
	}
	
	/**
	 *  return the dataset as array
	 *
	 */
    public function toArray()
    {
    	return $this->_dataset;
    }

    public function getColums()
    {
        return $this->_colums;
    }

    public function init()
    {
        foreach($this->_colums as $col) {
            $this->set($col, NULL);
        }
        return $this;
    }
}
/* EOF */