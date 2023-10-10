<?php

//// Cinventory and her helper class DBatom include file ////

// !!Protect all framework files with Zend Guard enconding & obfuscation b4 deploying online!!

// Coding by Roy Massaad

// PandoCMS 2012, Copyright Roy Massaad
// www.roymassaad.com

// contains classes DBatom, Cinventory

// Class DBatom

// Description:
// basic DB-data atoms transfer utility  class for dealing with Cinventory derived classes.
// it's mostly used for input and/or output 
// it basically deals with 1d or 2d associate arrays
// for instance it can expect to in/output arrays like $x[][] or $x[] depending on the function requested.
// when the array to be manipulated/returned is 2d such as $x[i][i2], then the first array i$ is the index 
// of a set of (array) records. each record has fields, everything is associative.
// on the other hand, when it's dealing with 1d associative arrays, the key is a field name in just 1 record 
// and the value is just the field value nothing more. 
// the input/output data is in only one member property value, in $DBarray.
// everything else are just data manipulation utility functions to make this object class interact in compliance 
// with the requirements of Cinventory sub classes.
// ie : X$[0]['field1'] = value. 0 here is record zero.
// ps: this class DOES NOT DIRECTLY DEAL WITH ANY true DATABASE

// Summary of Class methods API
//		clearAll()
//		maxIndex()
//		arraysResult()
//		setArrays()
//		addRecord()
//		removeRecordAt()
//		findRecordAt()
//		findFieldAt

class DBatom {
	
	// main and only data member variable
	// usuallly it's an indexed list of records, each record has fields in it
	public $DBarray;

	// this function will completly empty $DBarray and then reindex
	public function clearAll() {
		
		// loop through each sub element (which is an associative array hence the required => $value)..
		foreach ($this->DBarray as $i => $value) {
    		// and delete it
    		unset($this->DBarray[$i]);
		}
		
		// finally reindex
		$this->DBarray = array_values($this->DBarray);
		
	}
	
	// this function returned the top index[] of the record array
	public function maxIndex() {
		
		// this will return -1 if $DBarray is empty
		return sizeof($this->DBarray) - 1;
			
	}
	
	// this returns a copy of $DBarray since $DBarray is private
	// usually that's a 2d array[][]
	public function arraysResult() {
				
		return $this->DBarray;
		
				
	}
	
	
	// this function sets the internal $DBarray to a passed COMPATIBLE array
	// usually that's a 2s array[][]
	public function setArrays($arg) {
		
		$this->DBarray = $arg;
		
		// reindex
		$this->DBarray = array_values($this->DBarray);
		
	}
	
	// this adds/appends a 1d array[] in the form of a record to $DBarray 
	public function addRecord($record) {
		
		$this->DBarray[$this->maxIndex()+1] = $record;
		
		// reindex
		$this->DBarray = array_values($this->DBarray);
			
	}
	
	
	// this removes a record from $DBarray based on a requested index
	public function removeRecordAt($index) {
		
		// if it's already not set quit and return 'failure'
		if (!isset($this->DBarray[$index])) return 'failure';
		
		// if it's there, delete it
		unset($this->DBarray[$index]);
		
		// and reindex
		$this->DBarray = array_values($this->DBarray);
		
		// return success flag
		return 'success';
		
		
	}
	
	// this returns a 1d record from $DBarray based on the parameter index
	// the record will have fields and their associated values
	public function findRecordAt($index) {
		
		// if requested index isn't set, return null
		if (!isset($this->DBarray[$index])) return;
		
		// return the record
		// ps: if the receiving user tries to use a none existent field from
		// the record, we will get a null.
		return $this->DBarray[$index];
						
	}
	
	// this function returns a field value based on the index and record requested
	public function findFieldAt($index, $record) {
		
			return $this->DBarray[$index][$record];
		
	}
		
	
}

// Cinventory is the basic data inventory class for dealing with our data-driven website backend
// it is an abstract class, it's meant to be extended to suit specific project needs.
// this class next to Csec and DBatom make up the core of our backend solution framework.
// this is low level manipulation of DBatom data, classes that extend it will implement that custom
// required high level logic.
// it's basically an empty interface class that can be extended into a custom normal class.

// the child classes that inherit from him should be instantiated as SINGLETONS, 
// the class will ENFORCE THIS 

// Summary of Class methods API
//		__construct()
//		__destruct()
//		getSingleton()
//		searchRecords()
// 		printDBatom()
//		addRecord()
//		deleteRecord()
//		updateRecord()

// PLEASE NOTE
// i have opted to make Cinventory an abstract class and not a true 'interface' BECAUSE:
// i want to clearly define here what are the required propertie & methods in child objects
// + i want to leave working code for the singleton system so when writing subclasses for this
// everything is clear.

// now that said, U MUST TREAT Cinventory AS AN INTERFACE when extending it in children,
// OVERRIDE EVERYTHING, properties, methods and construstors and singletons functions..
// (just dont get too smart and use 'implements' in child class definitions ;) 

// in short, i have opted for future coding clarity over 'strict' coding here
// if this was an interface i would have had to comment out many descriptive parts (first section mainly).
// i'm assuming anyone reading this is sane enough to read  with an editor that supports code highlights!
// since this decision doesnt affect code stability nor security, let's move on..

abstract class Cinventory {
	
		// this static variable keeps track of the unique class instance
		private static $instance = null;
		
		// indexed array member property to dblinks used by the class
		public $dblink;
		
		// the contrustor, will enforce SINGLETON model IN CHILD subclass instantiation
		// BECAUSE IT IS PRIVATE, it's UNCALLABLE with new()
		private function __construct() { }
		
		// deconstructor, works to complement the singleton rule
		// clear instance variable on destroy
		public function __destruct() { self::$instance = null; }
		
		
		// this static class function is responsible for creating the singleton instance
		// since the default constructor isnt callable cuz we set it to private.
		// THIS CODE IS ONLY FOR SHOW
		public static function getSingleton() {
			
			// create a new singleton only if the class static instance variable is null
			if (self::$instance == null) {
				
				self::$instance = new Cinventory();
				
				return self::$instance;
				
			}
			
		}

		// this functions gets passed a 1D dbatom argument as a search criteria
		// it returns an indexed list of found 2d dbatom elements or null.
		// if u want to READ a single record in database, USE THIS ALSO
		public function searchRecords($dbatom_arg) {
		
			// search where ?
			// =it will contain a custom $query here for each project subclass
			
			// =one or more custom $DBlink will be here
			// $DBlink is a handle of type Csec->DBhandle
			
			// specific database $query strings go here (usually it's sql SELECT)	
			
			// also this is the basic search prototype function,
			// so apart from overriding it, other seperate specific search functions can be 
			// written in the subclasses to supplement it
			
			// return null is nothing is found
			
		}
		
		// this function will echo the contents of DBatom list
		// first option specifies the format, 1=raw, 2=html table, 3=flash readable
		// second option is whether to output the index value or not.
		// other more custom class print functions could supplement this
		public function printDBatom($dbatom_arg, $option, $option_i) {
			
			// a conditional set of customized echo commands go here
			
		}
				
		// this function adds the list in db_atom into the database dllink
		// this is the generic adder. other custom ones supplement it
		public function addRecord($dbatom_arg) {
			
			// specific database $query strings go here (usually it's sql INSERT)	
			
			// one or more custom $DBlink will be here
			// $DBlink is a handle of type Csec->DBhandle
					
			// return 'failure' or 'success'
		}
		
		// this function removes records from the database dllink based on dbatom
		// dbatom here is used as like a search criteria like in search()
		// this is the generic deleter. other custom ones supplement it
		public function deleteRecord($dbatom_arg) {
			
			// specific database $query strings go here (usually it's sql DELETE WHERE FROM)	

			// one or more custom $DBlink will be here
			// $DBlink is a handle of type Csec->DBhandle
			
			
			// return 'failure' or 'success'
		}
		
		// this function updates records in the database
		// it uses $dbatom_criteria as the criteria for the record/s to change like in search()
		// and $dbatom_newdata houses the new data.
		// as with other functions of Cinventory, this function will not only 
		// get overridding in childs but probably also supplemented by other
		// most specific update functions
		public function updateRecord($dbatom_criteria, $dbatom_newdata) {
			
			// specific database $query strings go here (usually it's sql UPDATE WHERE FROM)	

			// one or more custom $DBlink will be ehre
			// $DBlink is a handle of type Csec->DBhandle
			
						
			// return 'failure' or 'success'
			
		}
	
}
?>