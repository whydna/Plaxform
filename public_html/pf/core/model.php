<?php
abstract class Pf_Core_Model extends Pf_Core_Object
{
	protected $db;
	
	public function __construct()
	{
		$this->db = Pf_Core_Database::getInstance();
	}
	
	// override this if you want to change the table key name
	protected function getKeyName()
	{
		return 'id';
	}
	
	// override this if you want to change the table key name
	protected function getTableName()
	{
		// strip App_Models_
		return substr(get_class($this), 11);
	}
	
	public function checkExists($key)
	{
		$sql = "SELECT COUNT(*) FROM `".$this->getTableName()."`
			WHERE `".$this->getKeyName()."` = :key
			LIMIT 1
		";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(':key', $key);
		$stmt->execute();
			
        if ($stmt->fetchColumn() > 0) {
            return true;
        } else {
            return false;
        }
	}
	
	public function getSize()
	{
		$sql = "SELECT COUNT(*) FROM  `".$this->getTableName()."`";
		
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchColumn();
	}
	
	public function select($key)
	{
		$sql = "SELECT * FROM `".$this->getTableName()."`
				WHERE `".$this->getKeyName()."` = :key
				LIMIT 1
			";

		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(':key', $key);
		$stmt->execute();
		
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $row;
	}

	public function selectMultiple(Array $keys, $max=10, $offset=0)
	{
		$sql = "SELECT * FROM `".$this->getTableName()."`
			WHERE `".$this->getKeyName()."` IN (".implode(",",$keys).")
			ORDER BY `".$this->getKeyName()."` DESC 
			LIMIT ".$offset.",".$max.";
		";
		
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function selectLatest($max = 10, $offset = 0)
	{
		$sql = "SELECT * FROM `".$this->getTableName()."`
				ORDER BY `".$this->getKeyName()."` DESC 
				LIMIT ".$offset.",".$max.";
			";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $rows;
	}
	
	public function update($key, Array $data)
	{
		$sql = 'UPDATE '.$this->getTableName().' SET ';
		$sql .= implode(' = ?, ',array_keys($data)).' = ? ';
		$sql .= 'WHERE '.$this->getKeyName().' = ?';
		
		
		$stmt = $this->db->prepare($sql);
		
		$i = 1;
		foreach(array_values($data) as $value) { 
			$stmt->bindValue($i++, $value);
		}
		
		// bind the key value
		$stmt->bindValue($i, $key);
		
		$stmt->execute();
	}
	
	public function updateMultiple(Array $models)
	{
		$models;
	}
	
	public function insert(Array $row)
	{		
		// get the column names for this table
		$columnNames = $this->getColumnNames();
		
		foreach($columnNames as $columnName) {
			// don't set the key property, this will be auto generated
			if($columnName != $this->getKeyName()) {
				$sqlColumnNames .= "`".$columnName."`, ";
				$sqlValues .= "?, ";	
			}
		}
		//strip last ", "
		$sqlColumnNames = substr($sqlColumnNames, 0, -2);
		$sqlValues = substr($sqlValues, 0, -2);
		
		$sql = "INSERT INTO `".$this->getTableName()."` (".$sqlColumnNames.") VALUES (".$sqlValues.");";
		$stmt = $this->db->prepare($sql);
		
		// bind all the values
		$i = 1;
		foreach($columnNames as $columnName) {
			if ($columnName != $this->getKeyName()) {
				$stmt->bindParam($i++, $row[$columnName]);
			}
		}
		
		$stmt->execute();
		
		// set the key value and return
		$row[$this->getKeyName()] = $this->db->lastInsertId();
		
		return $row;
	}
	
	public function insertMultiple(Array $rows)
	{
		foreach($rows as $row) {
			$row = $this->insert($row);
		}
	}
	
	public function delete($key)
	{
        $sql = "DELETE FROM `".$this->getTableName()."` 
                WHERE `".$this->getKeyName()."` = :key 
                LIMIT 1
            ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':key',$key);
        $stmt->execute();
	}
	
	public function deleteMultiple(Array $keys)
	{
		$keys;
	}
		
	public function find($columnName, $value) 
	{		
		$sql = "SELECT * FROM `".$this->getTableName()."`
				WHERE ".$columnName." = :value  
				LIMIT 1
			";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(':value', $value);
		$stmt->execute();
		
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $row;
	}
	
	public function findMultiple($columnName, $value, $max=10, $offset=0)
	{		
		$sql = "SELECT * FROM `".$this->getTableName()."`
				WHERE ".$columnName." = :value  
				ORDER BY `".$this->getKeyName()."` DESC 
				LIMIT ".$offset.",".$max.";
			";

		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(':value', $value);
		$stmt->execute();
		
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $rows;
	}
	
	public function findDelete($columnName, $value)
	{
		$sql = "DELETE FROM `".$this->getTableName()."`
				WHERE ".$columnName." = :value 
			";

		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(':value', $value);
		$stmt->execute();
	}
		
	// returns the column field names in an array
	private function getColumnNames()
	{
		// Retrieve a list of the column names for this table
		$columnNames = array();
		$sql = "SHOW COLUMNS FROM ".$this->getTableName();
		$res = $this->db->query($sql);
		foreach($res as $row) {
			array_push($columnNames, $row['Field']);
		}
		
		return $columnNames;
	}
}