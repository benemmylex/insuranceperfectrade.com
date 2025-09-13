<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Db_model extends CI_Model
{

	function query($sql)
	{
		return $this->db->query($sql);
	}

	function escape($str)
	{
		return $this->db->escape($str);
	}

	function select($select, $from, $where = '', $row = 0)
	{
		$sql = "SELECT $select FROM `$from` $where";
		$q = $this->query($sql);
		$result = $q->row_array($row);
		return $result;
	}

	function selectGroup($select, $from, $where = '')
	{
		$sql = "SELECT $select FROM `$from` $where";
		return $this->query($sql);
	}

	function selectArray($select, $from, $where = '', $sigleRow = true)
	{
		$query = $this->selectGroup($select, $from, $where);
		if ($query->num_rows() == 0) {
			$array = array();
		} else {
			if ($sigleRow) {
				$array = $query->row_array();
			} else {
				foreach ($query->result_array() as $row) {
					$array[] = $row;
				}
			}
		}
		return $array;
	}

	function insert($into, $array)
	{
		$return = false;
		$data = array();
		foreach ($array as $key => $val) {
			if (!is_numeric($val) || substr($val, 0, 1) == 0) {
				$data[] = "`$key`=" . $this->escape($val);
			} else {
				$data[] = "`$key`=$val";
			}
		}
		$value = implode(", ", $data);
		if ($this->query("INSERT INTO `$into` SET $value")) {
			unset($into, $array, $data, $value);
			$return = true;
		}
		//if ($this->insert = $this->query(
		return $return;
	}

	function update($table, $array, $where = '')
	{
		$return = false;
		$data = array();
		foreach ($array as $key => $val) {
			if (!is_numeric($val) || substr($val, 0, 1) == 0) {
				$data[] = "`$key`=" . $this->escape($val);
			} else {
				$data[] = "`$key`=$val";
			}
		}
		$value = implode(", ", $data);
		if ($this->query("UPDATE `$table` SET $value $where")) {
			unset($table, $array, $where, $data, $value);
			$return = true;
		}
		return $return;
	}

	function delete($from, $where = '')
	{
		$return = false;
		if ($this->query("DELETE FROM `$from` $where")) {
			unset($from, $where);
			$return = true;
		}
		return $return;
	}

	function row_count($result)
	{
		$this->result->num_rows();
	}

	function limit($page, $max = 10)
	{
		$limit = "";
		if ($page > 0) {
			$min = $page - 1;
			$min = $min * $max;
			$max = $max * $page;
			$limit = "LIMIT $min, $max";
		}
		return $limit;
	}

	function error()
	{
		return $this->error();
	}

}

?>