<?php 
/**
 * Class to work with all extra attribute instances, extends class _User_
 */
class Attribute extends User
{
	/**
     * Method to add user id to a new line in DB table 'attributes'.
     * 
     * First call method findId() from class _User_ which returns user id.
     * Insert retrieved id in a columnt 'id' in DB table creating a new line.
     * Return given id for further use.
     * 
     * @param int $id retrieved from findId() method.
     */
	public function addId($email)
	{
		$id = $this->findId($email);
		$sql = "INSERT INTO attributes (id) VALUES ('$id')";
		$db = $this->connect()->query($sql);
		return $id;

	}

	/**
     * Method to add a column with speciffic name to the DB table 'attributes'.
     * 
     * Set attribute name to given $name. Call method to add user id with given email to DB table 'attributes'.
     * Retrieve all column names from the DB table 'attributes'.
     * Check if a column with needed name already exists. If so, stop searching and don't add new column.
     * If column not found, but there are still some columns to check, continue looking.
     * if column not found and no more columns from DB to check, alter table and add new column with name=$name.
     * Return user id for further use.
     * 
     * @param string $email, $name retrieved from POST Sign-up form in index.php
     */
	public function addColumn($email, $name)
	{
		$this->attribute_name = $name;
		$id = $this->addId($email);
		$sql1 = "SHOW COLUMNS FROM attributes";
		$result = $this->connect()->query($sql1);
		$rowNum = $result->num_rows;
        if ($rowNum>0) {
	        while ($row = $result->fetch_assoc()){
	        	$columns[]=$row['Field'];
	        }
        }
        $count = sizeof($columns);
        for ($i=0; $i < $count; $i++) { 
        	if ($columns[$i]==$this->attribute_name) {
        		break;
        	} elseif ($i<$count-1) {
        		continue;
        	} else {
				$db2 = $this->connect()->query("ALTER TABLE attributes ADD $this->attribute_name varchar(50)");
        	}
        }
		return $id;
	}

	/**
     * Method to add attribute instances to DB table 'attributes'.
     * 
     * Set attribute name to $name, attribute value to $value. Update DB table 'attributes' row, where user id = $id and column = $name, with value. 
     * 
     * @param string $email, $name, $value retrieved from POST Sign-up form in index.php
     */
	public function addAttribute($email, $name, $value)
	{
		$this->attribute_name = $name;
		$this->attribute_value = $value;

		$id = $this->addColumn($email, $name);
		$sql = "UPDATE attributes SET $this->attribute_name = '$this->attribute_value' WHERE id = $id";
	 	$db = $this->connect()->query($sql);
	}
}
?>