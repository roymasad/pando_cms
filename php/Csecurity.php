<?php

//// Csec core security class & low level utility, keeps the framework together ////
// this is meant to be used as an include file 

// !!Protect all framework files with Zend Guard enconding & obfuscation b4 deploying online!!

// Coding by Roy Massaad

// PandoCMS 2012, Copyright Roy Massaad
// www.roymassaad.com

// contains classes Csec

// Description:

// Csec class
// Core Class responsible for Security 
// and low level global static utility functions.
// such as html streaming, db connects, emails,
// sanitizing for sql and html, encryption
// and of course securing cookies

// this class keeps the peace and rule of law through despotism ! :)
// all other classes/scripts need this class

// Summary of Class methods API
//  	__construct()
//  	__destruct()
//		rawStreamer()
//		streamer()
//		sanitizer()
//		DBconnector()
//		DBclose()
//		emailer()
//		uploadSaver()
//		logmeIn()
//		logmeOut()
//		cookieChecker()
//		returnCookieUser()
//		getL2moderator()
//		setL2moderator()
//		encrypterL1()
//		decrypterL1()
//		encrypterL2()
//		decrypterL2()

include('SimpleImage.php');

class Csec {
	
	// list of constants that this class houses
	const assetsFolder = 'assets/';
	const projectpixFolder = 'pix/';
	const projectpdfFolder = 'pdf/';
	const projectvideoFolder = 'video/';
	//const storevidFolder = 'storevids/';
	const loginhtml = 'masterlogin.html';
	const defaultDBhost = 'localhost';
	const defaultDBuser = 'root';
	const defaultDBpass = '';
	const defaultDBdatabse = 'pando_cms';
	
	
	// list of variables
	private $DBhost;
	private $DBselected;
	private $DBuser;
	private $DBpass;
	private $DBquery;
	public  $DBhandle;
	public  $DBresult;
	
	// the contrustor
	// currently empty
	public function __construct() { }
	
	// the destructor (mostly for cleaning the mysql handle on exit/unset)
	public function __destruct() { $this->DBclose(); }
	
	// for debugging to console
	public static function console($data) {
	
		if(is_array($data) || is_object($data))
		{
			echo("<script>console.log('PHP: ".json_encode($data)."');</script>");
		} else {
			echo("<script>console.log('PHP: ".$data."');</script>");
		}
		
	}
	
	
	// a fast raw html streamer function
	public static function rawStreamer($arg) {
		
		// if file doesnt exist (in asset folder) then exit with an error
		if (file_exists(self::assetsFolder.$arg) == false) {	die('Error: Missing file:'. $arg); }
		
		// if present, dump it directly to the browser
		readfile(self::assetsFolder.$arg);
								
	}

	// another html streamer function but with the option of parsing data bytes too (if needed)
	// $replacetable is an associative array of this to find and change
	public static function streamer($arg, $replacetable) {
						
		// if file doesnt exist (in asset folder) then exit with an error
		if (file_exists(self::assetsFolder.$arg) == false) {	die('Error: Missing file:'. $arg); }

		// get data in a variable-stream to parse
		$data = file_get_contents(self::assetsFolder.$arg);
				
		// and replace all
		foreach ($replacetable as $find => $replaceby) {
			
			// parse it by find and replace: replace $1 by $2 in $3
			$data  = str_replace($find, $replaceby , $data);
		}

		// echo it out 
		echo $data;
				
	}
		
	// this is the atomic sanitizer function
	// it cleans all variables passed to it in 3 passes
	public static function sanitizer($arg, $type) {
				
		// first pass, clean malicious html tags
		//$result = htmlentities($arg);
		$result = $arg;
		
		// second, get rid of sql injection extra quotes
		//$result = mysql_real_escape_string($result);
		
    // finally, force type casting and return 		
		if ($type == 'bool')   return (bool)   $result;
			
		if ($type == 'int')    return (int)    $result;
			
		if ($type == 'float')  return (float)  $result;
			
		if ($type == 'string') return (string) $result;
			
	}
			
	// this is the database connection establisher function
	// all it does is try to connect, and then return a handle if successful
	// if not, it will return an exception for the high level code to take care of
	public function DBconnector($argHost, $argUser, $argPass, $argDB) {
		
		// map the passed arguments into the object properties
		$this->DBhost = $argHost;
   	$this->DBuser = $argUser;
	  $this->DBpass = $argPass;
	   		   
    // connect to the database host phase 1
    // use @ to temporarily hide any warning msgs since we got our own error system
    $this->DBhandle = @mysqli_connect($this->DBhost,$this->DBuser,$this->DBpass); 
     		
     	     
    //check for errors and report through an exception 
    if (!$this->DBhandle) {
    			throw new Exception ('Database connection error L1.');
    			// MAKE SURE TO CATCH THE EXCEPTION
		}
     
    // connect to the database itself phase 2
    $this->DBselected = mysqli_select_db($this->DBhandle, $argDB); 
      
    //check for errors and report through an exception 
    if (!$this->DBselected) {
    			throw new Exception ('Database connection error L2');
    			// MAKE SURE TO CATCH THE EXCEPTION
		} 
     
		
	}
	
	// funtion to close the DB if we want to reuse this Csec instance to connect to another DB
	private function DBclose() {
		
		// just check if we have a handle to close b4 highlevel 'closing it' with leaks ;)
		if ($this->DBhandle)  { mysqli_close($this->DBhandle); }
		
	}
		
	// this utiliy class function emails what u want, simple as that
	// what gets passed are the basic email elements
	public static function emailer($from, $to, $subject, $body) {
		
		// needed Pear package to send email through smtp with full control
		//require_once "php/Mail.php";
 
		// smtp host variables
		//$host = "mail.lihamra2i.com";
		//$port = "465";
		//$username = "info@lihamra2i.com";
		//$password = "0000";

		// start setting up the msg
		//$headers = array ('From' => $from,'To' => $to, 'Subject' => $subject);

	  	// send up send settings
	  	//$smtp = Mail::factory('smtp',
  		//array ('host' => $host,
    		//'auth' => true,
    		//'username' => $username,
    		//'password' => $password));
    		////'port' => $port,

		// send the email
		//$mail = $smtp->send($to, $headers, $body);

		// Debugging, check for errors
		//		if (PEAR::isError($mail)) {
		//  	  	echo("<p>" . $mail->getMessage() . "</p>");
		// 		} else {
		//  			echo("<p>Message successfully sent!</p>");
		// 			}
		
		$headers = 'From: '. $from . "\r\n" .
    'Reply-To: '. $from . "\r\n" ;
		
		
		mail($to, $subject, $body, $headers);
		
				
	}
	
	
	// this function saves an already uploaded file through a form's transparent POST submit.
	// at this stage the uploaded file is just temporary and in a temp folder
	// so to really 'save the upload', this function can do some condition tests first
	// concerning the format properties of the file, then if the tmp file passes the tests
	// it will save it in his final target server side folder. UPLOAD COMPLETE !
	// ps: the calling function should use $_FILES[$variable]['tmp_name'] as the $tmpserverfile parameter.
	// and $_FILES[$variable]['name'] as $originalfile
	
	// the uploaded can upload many types of files now and to many different systems
	
	public static function uploadSaver ($originalfile, $tmpserverfile, $destinationpath, $format = null, $size = null) {
		
	  // make IMPORTANT security checks: is it a valid format type ? 	(jpeg, mp4 in this example)
	  // ie: jpeg = 'JFIF'
	  // check manually with a hex editor what each file type has at header offsets
	  			
		// manually check the file header since mime_content_type requires 
		// server side extensions to be installed and is deprecated while the newer fileinfo is 'contraversial' (both suck)
		// and this is more secure than just checking the extension on the browser or server side
		$mime1 = file_get_contents($tmpserverfile, FILE_BINARY, NULL, 6, 4);
		$mime2 = file_get_contents($tmpserverfile, FILE_BINARY, NULL, 8, 3);
		
		// if its not out format, delete/unlink temp file and return with failure flag
		// if the the user didnt submit anything, quit also
				
		if (!$tmpserverfile) { $targetfile = 'failure' ; return $targetfile; }
				//if ($mime1 != 'JFIF' && $mime2 != 'mp4') { $targetfile = 'failure' ; unlink($tmpserverfile); return $targetfile; }
		
		// we do some string trimming and concatination to get the full path of the final target file.
		// just get the name from the tmp source file and append it to the destination folder path
		$targetfile = $destinationpath . basename($originalfile); 
		$targetfile2 = $destinationpath . 'thumbs/' . basename($originalfile);
		$targetfile3 = $destinationpath . 'archive/' . basename($originalfile);
		
		// now we attempt to move it or 'save it' proper
		// if we get an error the function will return 'failure'
		
		// if its an image, generate the approriate valid sizes for it for display and thumbnail, plus keep an original archive version of it
		// ps: i use simpleimage php class to do the resizing
		if ($format=='jpg'){
			$image = new SimpleImage();
			$image->load($tmpserverfile);
			$image->save($targetfile3);
			$image->resizeToHeight($size['imgsize']);
			$image->save($targetfile);
			$image->resizeToHeight($size['thmbsize']);
			$image->save($targetfile2);
		
		} else if(!move_uploaded_file($tmpserverfile, $targetfile)) {		return $targetfile = 'failure';}
				
		// but if all goes well the function will return a valid $targetfile file path
		return basename($originalfile);
	}
	
	// this function is responsible of login the user in, or NOT
	// it checks the submitted user+pass against the database of mods
	// if it finds a match for user+pass, it sets a session cookie 
	// the cookie will be used for authenticating the client so later on all the subsystems become available to him
	public function logmeIn ($user, $pass) {
		
		// first of all sanitize the user/pass from input data 
		$user =	self::sanitizer($user, 'string');
	    $pass = self::sanitizer($pass, 'string');
		
   		// connect to the databse in Csec default maintenance settings mode
   		try { $this->DBconnector(self::defaultDBhost, self::defaultDBuser, self::defaultDBpass, self::defaultDBdatabse); }
 				catch (Exception $e) { echo $e->getMessage(); exit; }
  
  		// try to match the user+pass in the database
  		$sql = "select * from modz where username='$user' and password= '$pass'";
  
  		// submit the query
  		$this->DBresult = mysqli_query($this->DBhandle, $sql); //or die(mysql_error());  
  
  		// check if we got results (we would get 0 if there is no match)
  		// note, there is no risk for $rows to return a result of hits greater than one
  		// because in the database the username field has be set to Unique
  		$rows = mysqli_num_rows($this->DBresult);	
  
  		// if we have a hit, set the cookie !
  		if ($rows) {
  			
  			// fetch the moderator level (1 or 2)
  			// and append it to the last digit of 'garbage' ;)
  			$data = mysqli_fetch_array($this->DBresult);
  			
  			// the cookie will have the username + a hash of the password for reverse checking later on ;)
  			// all cookies have been encrypted with the Csec crypter
  			setcookie(self::encrypterL1('user'),self::encrypterL2($user));
  			setcookie(self::encrypterL1('pass'),self::encrypterL2(hash('md5',$pass)));
  			setcookie(self::encrypterL1('garbage'),self::encrypterL2('df3ddfd'.$data['level']));
  			
				// finished, get out dont continue
				return;
  		}
		
			// if we reached here then it wasn't a successful log in
			// so set the invalid cookie flag
			// this is only used to display a 'error login msg' when the user is sent back to the login page
			// it plays no security role whatsoever and can't be used to bypass anyting, it's just an error msg
			setcookie(self::encrypterL1('invalidlog'), self::encrypterL2('true'));
			
			
		
 	}
 	
 	// this function logs the user out by just setting user/pass to null and using a negative expiry date
 	public function logmeOut() {
		
		setcookie(self::encrypterL1('user'), "", time() - 3600);
  		setcookie(self::encrypterL1('pass'), "", time() - 3600);
  		setcookie(self::encrypterL1('garbage'), "", time() - 3600);
				
 	}
 
 	// this is a very basic function
 	// it will return either true or false
 	// depending whether the client has a valid cookie or not ;)
 	// this will be used at entry points to cut off unauthorized access
 	public function cookieChecker() {
 		
 			// first of all sanitize the cookie data from malformed cookie attacks
 			// all cookies have been encrypted with the Csec crypters

 		$user =	self::sanitizer(self::decrypterL2($_COOKIE[self::encrypterL1('user')]), 'string');
	    	$pass = self::sanitizer(self::decrypterL2($_COOKIE[self::encrypterL1('pass')]), 'string');
 		
 			// connect to the databse in Csec default maintenance settings mode
   		try { $this->DBconnector(self::defaultDBhost, self::defaultDBuser, self::defaultDBpass, self::defaultDBdatabse); }
 				catch (Exception $e) { echo $e->getMessage(); exit; }
 		  
 			// try to match the  unique username in the database if available
  		$sql = "select * from modz where username ='$user'";
  		
  		// submit the query
  		$this->DBresult = mysqli_query($this->DBhandle, $sql); //or die(mysql_error());  
  
  		// check if we got results (we would get 0 if there is no match)
  		// note, there is no risk for $rows to return a result of hits greater than one
  		// because in the database the username field has be set to Unique
  		$rows = mysqli_num_rows($this->DBresult);	
 		  
 		  
 		  // if we have a hit, then let's check if the password hashes matches
  		if ($rows) {
  			
  			 // try to match the  unique username in the database if available
  			 $sql = "select password from modz where username ='$user'";
  		
  			// submit the query
  			$this->DBresult = mysqli_query($this->DBhandle, $sql); //or die(mysql_error());  
  			
  			// fetch the password
  			$data = mysqli_fetch_array($this->DBresult);
  			
  			// now compare the hashes
  			// note, $pass is already a hash in the cookie
  			// if we got a match return true
  			if ($pass == hash('md5', $data['password'])) return true;
  			
  			
  		}
 		  
 		  // finally if we reached this point then there was no user/pass match
 		  // return the invalid flag
 		  
 		  return false;
 	
	}
	
	// this function returns the current username based on the cookie
 	public function returnCookieUser() {
 		
 			// return the decrypted username
 			return $user =	self::sanitizer(self::decrypterL2($_COOKIE[self::encrypterL1('user')]), 'string');
	  	
	}
	
	// CUSTOM BASIC INTERNAL TEXT ENCRYPTER UTILITY (LEVEL 1 for cookie names and such 'sensitive' bunch ;)
	public static function encrypterL1($text) {
		
		// ENCRYPTER
		// basic function responsible for crypt encoding a string in a way that can be used as a COOKIE NAME.
		// nasty things happen when u encode a string into base64 or DES and try to store it as cookie name (not value)
		// cookie names dont like to have strings with strange characters in them, they wont save right.
		
		// basically this crypter uses a key and shifts the encrypted characters' ascii according to this key,
		// but keeps a-z shifts local, and A-Z local too, all other extra characters are ignored and remain the same.

		// the key must be a nb sequence ONLY
		$key = "192537547121643417";

		// size and key index counter variables for the loop parsing pass
		$keylen = strlen($key);
		$i2 = $keylen;

		// we initialize the result variable with the same size as the text to encrypt
		$result = $text;

		// this is where we travel through the string and parse/edit the result accordingly to encode
		// note: we got 2 position index counters looping concurrently, one for the text and one for the key
		for ($i = 0; $i < strlen($text) ; $i++) {
	
			if ($i2 < $keylen-1) $i2++;
			else $i2 = 0;
	
			// dont encode any characters outside of the a-z and A-Z set
			if ( (ord($text[$i]) > 122) || (ord($text[$i]) < 65) ) continue;
			if ( (ord($text[$i]) >  90) && (ord($text[$i]) < 97) ) continue;
	
			// get the preliminary result, this one will have characters out of ascii-set bounds, so on the next step
			$result[$i] = chr( ord($text[$i]) + (int) $key[$i2] );
	
	
			// here we wrap the crypt key onces depending on whether it was in the a-z set or the A-Z set
			if ((ord($result[$i]) > 122) && (ord($text[$i]) >= 97)) $result[$i] = chr( (ord($result[$i]) - 122) + 96 );
			if ((ord($result[$i]) > 90) && (ord($text[$i]) <= 90)) $result[$i] = chr( (ord($result[$i]) - 90) + 64 );
	
		}
		
		return $result;
	}
	
	// STANDARD TEXT ENCRYPTER UTILITY (LEVEL 2 for pretty much everything apart cookie names)
	public static function encrypterL2($text) {
		
			$key = "carvinalofrust";
			
			return $text;
			// we use 1 key and mcrypt+base64 without any salting 
			//return base64_encode(@mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_NOFB));
		
	}
	
	
	// CUSTOM BASIC INTERNAL TEXT DECRYPTER UTILITY (LEVEL 1 for cookie names and such 'sensitive' bunch ;)
	public static function decrypterL1($text) {
		
		// DECRYPTER
		// basic function responsible for crypt decoding a string in a way that can be stored as a COOKIE NAME.
		// nasty things happen when u encode a string into base64 or DES and try to store it as cookie name (not value)
		// cookie names dont like to have strings with strange characters in them, they wont save right.
		// and mcrypt function requires php to have mcrypt extension installed which isnt always an option.

		// basically this crypter uses a key and shifts the encrypted characters' ascii according to this key,
		// but keeps a-z shifts local, and A-Z local too, all other extra characters are ignored and remain the same.

		// the key must be a nb sequence ONLY
		$key = "192537547121643417";

		// size and key index counter variables for the loop parsing pass
		$keylen = strlen($key);
		$i2 = $keylen;

		// we initialize the result variable with the same size as the text to encrypt
		$result = $text;

		// this is where we travel through the string and parse/edit the result accordingly to decode
		// note: we got 2 position index counters looping concurrently, one for the text and one for the key
		for ($i = 0; $i < strlen($text) ; $i++) {
	
			if ($i2 < $keylen-1) $i2++;
			else $i2 = 0;
	
			// dont encode any characters outside of the a-z and A-Z set
			if ( (ord($text[$i]) > 122) || (ord($text[$i]) < 65) ) continue;
			if ( (ord($text[$i]) >  90) && (ord($text[$i]) < 97) ) continue;
		
			// get the preliminary result, this one will have characters out of ascii-set bounds, so on the next step
			$result[$i] = chr( ord($text[$i]) - (int) $key[$i2] );
	
			// here we inverse wrap the crypt key onces depending on whether it was in the a-z set or the A-Z set	
			if ((ord($result[$i]) < 97) && (ord($text[$i]) >= 97)) $result[$i] = chr( 123 - (97 - ord($result[$i])) );
			if ((ord($result[$i]) < 65) && (ord($text[$i]) <= 90)) $result[$i] = chr( 91 - (65 - ord($result[$i]))  );
		
		}
		
		return $result;
		
	}
	
	
  // STANDARD TEXT DECRYPTER UTILITY (LEVEL 2 for pretty much everything apart cookie names)
	public static function decrypterL2($text) {
		
			$key = "carvinalofrust";
		
			return $text;
			// we use 1 key and mcrypt+base64 without any salting 
			//return  @mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($text), MCRYPT_MODE_NOFB); 
	}
			
			
	// get the Level2 moderator
	public function getL2moderator() {
		
   		// connect to the databse in Csec default maintenance settings mode
   		try { $this->DBconnector(self::defaultDBhost, self::defaultDBuser, self::defaultDBpass, self::defaultDBdatabse); }
 				catch (Exception $e) { echo $e->getMessage(); exit; }
  
  		// look up the Level2 moderator
  		$sql = "select * from modz where level = 2";
  
  		// submit the query
  		$this->DBresult = mysqli_query($this->DBhandle, $sql); //or die(mysql_error());  
  
  		// check if we got results 
  		$rows = mysqli_num_rows($this->DBresult);	
  
  		if ($rows) {
  			
  			// fetch the moderator level 2
  			$data = mysqli_fetch_array($this->DBresult);
  			  			
  			$result['username'] = $data['username'];
  			$result['password'] = $data['password'];
  			$result['email'] = $data['email'];
  			
  			return $result;
  		}
							
	}			

	// set the Level2 moderator
	public function setL2moderator($data) {
		
   		// connect to the databse in Csec default maintenance settings mode
   		try { $this->DBconnector(self::defaultDBhost, self::defaultDBuser, self::defaultDBpass, self::defaultDBdatabse); }
 				catch (Exception $e) { echo $e->getMessage(); exit; }
  
  		// edit the Level2 moderator
  		$sql = "update modz set username= '".self::sanitizer($data['username'],'string').
  			"', password = '".self::sanitizer($data['password'],'string')."', email = '".
  			self::sanitizer($data['email'],'string')."' where level = 2";
  
   		// submit the query
  		$this->DBresult = mysqli_query($this->DBhandle, $sql); //or die(mysql_error());  
  			

	}			
		
	
}


?>
