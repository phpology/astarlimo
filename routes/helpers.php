<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

function sendResponse($result, $message)
{
	$response = [
		'status' => 200,
		'count'    => count($result),
		'data'    => $result,
		'message' => $message,
	];
	return response()->json($response, 200);
}

/**
 * return error response.
 *
 * @return \Illuminate\Http\Response
 */
function sendNotFound($error, $code = 200)
{
	$response = [
		'status' => 404,
		'count'    => 0,
		'data'    => array(),
		'message' => $error,
	];
	return response()->json($response, 404);
}

/**
 * return error response.
 *
 * @return \Illuminate\Http\Response
 */
function sendError($error)
{
	$response = [
		'status' => 500,
		'message' => $error
	];
	return response()->json($response, 200);
}

function check_user_permission()
{
	$user = \Illuminate\Support\Facades\Auth::user();

	$admin_login = request()->session()->get('admin_login');
	if(!empty($admin_login)){
		$admin_login_id = $admin_login['admin_login_id'];
		$admin_login_role = $admin_login['admin_login_role'];

		if(!empty($admin_login_id)){
			return $admin_login_role;
		}
	}
	return !empty($user->role) ? $user->role : null;

}

function check($csvString)
{
	$lineContent = array_map("str_getcsv", explode("\n", $csvString));

	$headers = $lineContent[0];
	$jsonArray = array();
	$rowCount = count($lineContent);
	for ($i=1;$i<$rowCount;$i++) {
		foreach ($lineContent[$i] as $key => $column) {
			$jsonArray[$i][$headers[$key]] = $column;
		}
	}
	return $jsonArray;
}

function convert_response($csvString)
{
	$lineContent = array_map("str_getcsv", explode("\n", $csvString));

	$headers = $lineContent[0];
	$jsonArray = array();
	$rowCount = count($lineContent);
	for ($i=1;$i<$rowCount;$i++) {
		foreach ($lineContent[$i] as $key => $column) {
			$jsonArray[$i][$headers[$key]] = $column;
		}
	}
	return $jsonArray;
}

// With this function you can calculate on how many days someone has birthday
function countdays($date)   // declare the function and get the birth date as a parameter
{
	$olddate =  substr($date, 4); // use this line if you have a date in the format YYYY-mm-dd.
	$newdate = date('Y') .''.$olddate; //set the full birth date this year
	$nextyear = date('Y')+1 .''.$olddate; //set the full birth date next year

	if(strtotime($newdate) > strtotime(date('Y-m-d'))) //check if the birthday has passed this year. In order to check use strotime(). if it has not....
	{
		$start_ts = strtotime($newdate); // set a variable equal to the birthday in seconds (Unix timestamp, check php manual for more information)
		$end_ts = strtotime(date('Y-m-d'));// and a variable equal to today in seconds
		$diff = $end_ts - $start_ts; // calculate the difference of today minus birthday
		$n = round($diff / (60*60*24));// divide the diffence with the seconds of one day to get the dates. Use round() to get a round number.
		//(60*60*24) represents 60 seconds * 60 minutes * 24 hours = 1 day in seconds. You can also directly write 86400
		$return = substr($n, 1); //you need this to get the right value without -
		return $return; // return the value
	}
	else // else if the birthday has past this year
	{
		$start_ts = strtotime(date('Y-m-d')); // set a variable equal to the today in seconds
		$end_ts = strtotime($nextyear); // and a variable with the birtday next year
		$diff = $end_ts - $start_ts; // calculate the difference of next birthday minus today
		$n = round($diff / (60*60*24)); // divide the diffence with the seconds of one day to get the dates.
		$return = $n; // assign the dates to return
		return $return; // return the value
	}
}

function time_elapsed_string($datetime, $full = false)
{
	$now = new DateTime;
	$target = new DateTime($datetime);
	$diff = $now->diff($target);

	// weeks helper
	$diff->w = floor($diff->d / 7);
	$diff->d -= $diff->w * 7;

	$string = [
		'y' => 'year',
		'm' => 'month',
		'w' => 'week',
		'd' => 'day',
		'h' => 'hour',
		'i' => 'minute',
		's' => 'second',
	];

	foreach ($string as $k => &$v) {
		if ($diff->$k) {
			$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
		} else {
			unset($string[$k]);
		}
	}

	if (!$full) {
		$string = array_slice($string, 0, 1);
	}

	if (!$string) {
		return 'just now';
	}

	$phrase = implode(', ', $string);

	// invert = 1 means $target is earlier than $now (past)
	if ($diff->invert) {
		return $phrase . ' ago';
	}

	// future
	return 'in ' . $phrase; // or: $phrase . ' time'
}


function validate_phone_region($mobile = null)
{
	//clean the number
	$mobile = preg_replace('/[^0-9]/', '', $mobile);

	//now check predominantly for Ireland, what the first 3 digits are
	$first_three_digits = substr($mobile, 0, 3);
	switch($first_three_digits)
	{
		case '083':
		case '085':
		case '086':
		case '087':
		case '088':
		case '089':
			$region = 'IE';
			break;
		default:
			$region = 'UK';
			break;
	}

	return $region;
}

function validate_phone_for_whatsapp($mobile = null)
{
	//validate the mobile number
	$region = validate_phone_region($mobile);
	switch($region)
	{
		case 'IE':
			$mobile_prefix = '353'; //whatsapp dont like the + in the telephone
			break;
		default:
			$mobile_prefix = '44'; //whatsapp dont like the + in the telephone
			break;
	}
	//check the number of characters in the mobile number, if its not equal to 11, then there is a problem
	$len = strlen($mobile);
	switch(1 == 1)
	{
		case ($len == 10): //no zero in the front
			$mobile = '0'.$mobile;
			break;
		case ($len == 12): //most likely have put 44 in front
			$mobile = '0'.substr($mobile, 2); //remove the first 2 digits and whack in the 0
			break;
		default:

			break;
	}
	return $mobile = preg_replace('/^0/', $mobile_prefix, $mobile);
}

function format_monies($value = 0)
{
	return number_format($value, 2, '.', ',');
}

function getIp()
{
	foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
		if (array_key_exists($key, $_SERVER) === true) {
			foreach (explode(',', $_SERVER[$key]) as $ip) {
				$ip = trim($ip); // just to be safe
				if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
					return $ip;
				}
			}
		}
	}
}
function check_in_range($start_date, $end_date, $date_from_user)
{
	// Convert to timestamp
	$start_ts = strtotime($start_date);
	$end_ts = strtotime($end_date);
	$user_ts = strtotime($date_from_user);

	// Check that user date is between start & end
	if(($user_ts >= $start_ts) && ($user_ts <= $end_ts))
	{
		return true;
	}
	return false;
}
function format_date($date_time, $format = "d/m/Y")
{
	return date($format, strtotime($date_time));
}

function date_difference_in_days($start, $end)
{
	$start_ts = strtotime($start);
	$end_ts = strtotime($end);
	$diff = $end_ts - $start_ts;
	return round($diff / 86400);
}

function normalizeUkNumber($number)
{
	// Remove all non-digit characters except the plus sign
	$number = preg_replace('/[^\d+]/', '', $number);

	// If it starts with +44, just return it as is
	if (strpos($number, '+44') === 0) {
		return $number;
	}

	// If it starts with 0044, convert to +44
	if (strpos($number, '0044') === 0) {
		return '+44' . substr($number, 4);
	}

	// If it starts with 0, replace it with +44
	if (strpos($number, '0') === 0) {
		return '+44' . substr($number, 1);
	}

	// If it’s missing a prefix (starts with 7 and is 10/11 digits long)
	if (preg_match('/^7\d{9}$/', $number)) {
		return '+44' . $number;
	}

	// If none match, return the original number
	return $number;
}

function parse_date($date, $format)
{
	// Builds up date pattern from the given $format, keeping delimiters in place.
	if( !preg_match_all( "/%([YmdHMp])([^%])*/", $format, $formatTokens, PREG_SET_ORDER ) ) {
		return false;
	}
	$datePattern = '';
	foreach( $formatTokens as $formatToken ) {
		$delimiter = !empty($formatToken[2]) ? preg_quote( $formatToken[2], "/" ) : '/';
		$datePattern .= "(.*)".$delimiter;
	}

	// Splits up the given $date
	if( !preg_match( "/".$datePattern."/", $date, $dateTokens) ) {
		return false;
	}
	$dateSegments = array();
	for($i = 0; $i < get_count($formatTokens); $i++) {
		$dateSegments[$formatTokens[$i][1]] = $dateTokens[$i+1];
	}

	// Reformats the given $date into US English date format, suitable for strtotime()
	if( $dateSegments["Y"] && $dateSegments["m"] && $dateSegments["d"] ) {
		$dateReformated = $dateSegments["Y"]."-".$dateSegments["m"]."-".$dateSegments["d"];
	}
	else {
		return false;
	}
	if( $dateSegments["H"] && $dateSegments["M"] ) {
		$dateReformated .= " ".$dateSegments["H"].":".$dateSegments["M"];
	}

	return strtotime( $dateReformated );
}

function validateDate($date)
{
	$d = DateTime::createFromFormat('Y-m-d', $date);
	return $d && $d->format('Y-m-d') == $date;
}

function getStartOfWeekDate($date = null)
{
	//echo $date;
	if ($date instanceof \DateTime) {
		$date = clone $date;
	} else if (!$date) {
		$date = new \DateTime();
	} else {
		$date = new \DateTime($date);
	}

	$date->setTime(0, 0, 0);

	if ($date->format('N') == 1) {
		// If the date is already a Monday, return it as-is
		return $date;
	} else {
		// Otherwise, return the date of the nearest Monday in the past
		// This includes Sunday in the previous week instead of it being the start of a new week
		return $date->modify('last monday');
	}
}

function week_between_two_dates($date1, $date2)
{
	$first = DateTime::createFromFormat('Y-m-d', $date1);
	$second = DateTime::createFromFormat('Y-m-d', $date2);
	if($date1 > $date2) return week_between_two_dates($date2, $date1);
	return ceil($first->diff($second)->days/7);
}

function pprint_r($array = null, $exit = true)
{
	echo '<pre>';
		print_r($array);
	echo '</pre>';
	echo '<hr />';

	if($exit) { exit; }
}

function get_count($array = array())
{
	if(is_countable($array))
	{
		return count($array);
	}
	else
	{
		return 0;
	}
}

function clean_url_accents($str, $delimiter = '-')
{
	$temp = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
	$temp = preg_replace('/[^a-zA-Z0-9\/_|+ -]/', '', $temp);
	$temp = strtolower(trim($temp, '-'));
	$temp = preg_replace('/[\/_|+ -]+/', $delimiter, $temp);
	return trim($temp);
}

function add_to_log($message = null, $data = array(), $booking_id = 0)
{

	$user =  \Illuminate\Support\Facades\Auth::user();
	$params = new \App\Models\AuditLogs();
	$params->session_id = session_id();
	$params->user_id = !empty($user) ? $user->id : 0;
	$params->user =  !empty($user) ? $user->firstname.' '.$user->lastname : '';
	$params->task = $message;
	$params->data = json_encode($data);
	//$params->ip_address = getIp();
	$params->createdate_date = date('Y-m-d');

	//if the user has been impersonated, I would like to add that to the log also
	if(!empty(request()->hasSession())){

	$admin_login = request()->session()->get('admin_login');

		 if(!empty($admin_login))
		{
			$params->is_impersonated = 1;
			$params->impersonated_by = $admin_login['admin_login_name'];
			$params->impersonate_by_id = $admin_login['admin_login_id'];
		}
	}
	$params->save();
}

function msort($array, $key, $sort_flags = SORT_REGULAR)
{
	if (is_array($array) && get_count($array) > 0) {
		if (!empty($key)) {
			$mapping = array();
			foreach ($array as $k => $v) {
				$sort_key = '';
				if (!is_array($key)) {
					$sort_key = $v[$key];
				} else {
					// @TODO This should be fixed, now it will be sorted as string
					foreach ($key as $key_key) {
						$sort_key .= $v[$key_key];
					}
					$sort_flags = SORT_STRING;
				}
				$mapping[$k] = $sort_key;
			}
			asort($mapping, $sort_flags);
			$sorted = array();
			foreach ($mapping as $k => $v) {
				$sorted[] = $array[$k];
			}
			return $sorted;
		}
	}
	return $array;
}

function status_name($item)
{
	$type = '';
	switch ($item){
		case '0':
			$type = 'Pending';
			break;
		case '1':
			$type = 'Active';
			break;
		case '2':
			$type = 'Archive';
			break;
	}
	return $type;
}
function curlApi($url,$params)
{
	$headers = [
		'Content-Type: application/json'
	];
	/* 'http://10.250.0.50:9200/email_log/_search/?size=10&sort=dateReceived%3Adesc' */
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_POSTFIELDS => json_encode($params),
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_HTTPHEADER => $headers,
	));

	$response = curl_exec($curl);
	curl_close($curl);
	return json_decode($response);
}

function get_name($mailid)
{
	$user = strstr($mailid, '@', true);
	$user = str_replace('.',' ',$user);
	return ucwords($user);
}

function get_two_text($name)
{

	$trimtext = '';
	if(!empty($name)){
		$name = explode(' ',$name);
		if(count($name)>1){
			$trimtext = $name[0][0].$name[1][0];
		}else{
			$trimtext = $name[0][0].$name[0][1];
		}
	}
	return strtoupper($trimtext);
}

if (! function_exists('sub_str')) {
	function sub_str($text,$length = false)
	{
		$length = $length ?: 100;
		$textlen = strlen($text);
		if($textlen>$length){
			$newtest = substr(strip_tags($text),0,$length).'...';
		}else{
			$newtest = $text;
		}

		return $newtest;
	}
}
function body_trim($text, $count=false)
{
	if(empty($count)){
		$count = 100;
	}
	$wrapText='...';
	if(strlen($text)>$count){
		preg_match('/^.{0,' . $count . '}(?:.*?)\b/siu', $text, $matches);
		$text = $matches[0];
	}else{
		$wrapText = '';
	}
	return $text . $wrapText;
}

function filter_string($string){
	$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	$string =  preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	return strtolower($string);
}

function shift_types()
{
	//shift_type array
	$shift_types['ANY'] = array(0 => 'ANY', 1 => 'ANY');
	$shift_types['ALL DAY'] = array(0 => 'ALL DAY', 1 => 'DAY');
	$shift_types['LONG DAY'] = array(0 => 'LONG DAY', 1 => 'LONG DAY');
	$shift_types['EARLY'] = array(0 => 'EARLY', 1 => 'EARLY');
	$shift_types['LATE'] = array(0 => 'LATE', 1 => 'LATE');
	$shift_types['NIGHT'] = array(0 => 'NIGHT', 1 => 'NIGHT');
	$shift_types['TWILIGHT'] = array(0 => 'TWILIGHT', 1 => 'TWILIGHT');
	$shift_types['BREAK GLASS'] = array(0 => 'BREAK GLASS', 1 => 'BREAK GLASS');
	$shift_types['HOLIDAY'] = array(0 => 'HOLIDAY', 1 => 'HOLIDAY');
	$shift_types['SELF ISOLATION'] = array(0 => 'SELF ISOLATION', 1 => 'SELF ISOLATION');
	//$shift_types[] = array(0 => 'AM', 1 => 'AM');
	//$shift_types[] = array(0 => 'PM', 1 => 'PM');
	return $shift_types;
}

function get_days_for_working_days_string($weekdays = array(), $workdays = null)
{
	//take the string, break it down, and convert the numbers to short hand days

	//explode the $workdays in array
	$workdays_array = explode(',', $workdays);
	//pprint_r($workdays_array, false);

	//now loop thru and get the weekday labels
	$temp_array = array();
	foreach($workdays_array as $d)
	{
		if($d != '')
		{
			settype($d, 'int');
			array_push($temp_array, $weekdays[$d-1][1]);
		}
	}
	//implode the string by comma
	return implode(', ', $temp_array);

}

function display_yes_no($value)
{
	return ($value == 1) ? 'Yes' : 'No';
}
function prettyPrint( $json ){

	$result = '';
	$level = 0;
	$in_quotes = false;
	$in_escape = false;
	$ends_line_level = NULL;
	$json_length = strlen( $json );

	for( $i = 0; $i < $json_length; $i++ ) {
		$char = $json[$i];
		$new_line_level = NULL;
		$post = "";
		if( $ends_line_level !== NULL ) {
			$new_line_level = $ends_line_level;
			$ends_line_level = NULL;
		}
		if ( $in_escape ) {
			$in_escape = false;
		} else if( $char === '"' ) {
			$in_quotes = !$in_quotes;
		} else if( ! $in_quotes ) {
			switch( $char ) {
				case '}': case ']':
				$level--;
				$ends_line_level = NULL;
				$new_line_level = $level;
				$char.="<br>";
				for($index=0;$index<$level-1;$index++){$char.=" ";}
				break;

				case '{': case '[':
				$level++;
				$char.="<br>";
				for($index=0;$index<$level;$index++){$char.=" ";}
				break;
				case ',':
					$ends_line_level = $level;
					$char.="<br>";
					for($index=0;$index<$level;$index++){$char.=" ";}
					break;

				case ':':
					$post = " ";
					break;

				case "\t": case "\n": case "\r":
				$char = "";
				$ends_line_level = $new_line_level;
				$new_line_level = NULL;
				break;
			}
		} else if ( $char === '\\' ) {
			$in_escape = true;
		}
		if( $new_line_level !== NULL ) {
			$result .= "\n".str_repeat( "\t", $new_line_level );
		}
		$result .= $char.$post;
	}
	return $result;
	}
function clean_url($str)
{
	$temp = stripslashes(strtolower($str));
	$temp = preg_replace('/[^a-zA-Z0-9\/_|+ -]/', '', $temp);
	$temp = strtolower(trim($str, '-'));
	$temp = preg_replace('/[\/_|+ -]+/', '-', $temp);
	return $temp;
}

function ordinal($input_number)
{
	$number = (string) $input_number;
	$last_digit = substr($number, -1);
	$second_last_digit = substr($number, -2, 1);
	$suffix = 'th';
	if ($second_last_digit != '1')
	{
		switch ($last_digit)
		{
			case '1':
				$suffix = 'st';
				break;
			case '2':
				$suffix = 'nd';
				break;
			case '3':
				$suffix = 'rd';
				break;
			default:
				break;
		}
	}
	if ((string) $number === '1') $suffix = 'st';
	return $number.$suffix;
}

function generate_sha1($primary_key_value)
{
	$sha1_value = substr(sha1($primary_key_value.rand()), 0, 15);
	return $sha1_value;
}

function generate_fake_nino()
{
	// Allowed letters for first/second position
	$letters = array_diff(range('A', 'Z'), ['D','F','I','Q','U','V']); // remove invalids
	$letters = array_values($letters);

	$forbiddenPrefixes = ['BG','GB','KN','NK','NT','TN','ZZ'];
	$prefix = '';
	// Pick a valid 2-letter prefix
	do {
		$first = $letters[array_rand($letters)];
		$second = $letters[array_rand($letters)];

		// Second letter cannot be O
		if ($second === 'O') {
			continue;
		}

		$prefix = $first . $second;
	} while (in_array($prefix, $forbiddenPrefixes, true));

	// 6 random digits (leading zeros allowed)
	$digits = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

	// Suffix A–D
	$suffixes = ['A','B','C','D'];
	$suffix = $suffixes[array_rand($suffixes)];

	return $prefix . $digits . $suffix;  // e.g. AB123456C
}

/*****/
//Json difference check for vacancies
/*****/
/**
 * Compare two JSON strings and return structured change data
 */
function jsonStructuredChanges(string $oldJson, string $newJson): array
{
	$old = json_decode($oldJson, true);
	$new = json_decode($newJson, true);

	if (!is_array($old) || !is_array($new)) {
		throw new InvalidArgumentException('Invalid JSON supplied');
	}

	$diffs = arrayDiffRecursive($old, $new);
	$changes = [];

	foreach ($diffs as $path => $change) {
		if ($change['type'] !== 'changed') {
			continue;
		}

		$changes[$path] = [
			'summary'   => jsonBuildSummary($path, $change['old'], $change['new']),
			'old_value' => $change['old'],
			'new_value' => $change['new'],
			'field_key' => $path,
		];
	}

	return $changes;
}

/**
 * Recursively diff two arrays
 */
function arrayDiffRecursive(array $old, array $new, string $path = ''): array
{
	$diff = [];

	foreach ($old as $key => $oldValue) {
		if (!array_key_exists($key, $new)) {
			continue;
		}

		$currentPath = $path === '' ? $key : "{$path}.{$key}";
		$newValue = $new[$key];

		if (is_array($oldValue) && is_array($newValue)) {
			$diff = array_merge(
				$diff,
				arrayDiffRecursive($oldValue, $newValue, $currentPath)
			);
			continue;
		}

		if ($oldValue !== $newValue) {
			$diff[$currentPath] = [
				'old'  => $oldValue,
				'new'  => $newValue,
				'type' => 'changed',
			];
		}
	}

	return $diff;
}

/**
 * Build human-readable summary text
 */
function jsonBuildSummary(string $path, $old, $new): string
{
	$label = jsonHumanizeKey($path);

	return sprintf(
		'%s was changed from %s to %s',
		$label,
		jsonFormatValue($old),
		jsonFormatValue($new)
	);
}

/**
 * Make values readable
 */
function jsonFormatValue($value): string
{
	if ($value === null || $value === '') {
		return '(none)';
	}

	if (is_bool($value)) {
		return $value ? 'true' : 'false';
	}

	if (is_array($value)) {
		return json_encode($value);
	}

	return (string) $value;
}

function getBetweenDates($startDate, $endDate)
{
	$rangArray = [];
	$startDate = strtotime($startDate);
	$endDate = strtotime($endDate);
	for ($currentDate = $startDate; $currentDate <= $endDate; $currentDate += (86400)) 
	{
		$date = date('Y-m-d', $currentDate);
		$rangArray[] = $date;
	}
	return $rangArray;
}
/**
 * Convert dot-path keys into human labels
 * requirements.fallbackGradeName → Fallback Grade Name
 */
function jsonHumanizeKey(string $path): string
{
	$key = basename(str_replace('.', '/', $path));

	$key = preg_replace('/([a-z])([A-Z])/', '$1 $2', $key);

	return ucwords($key);
}

function extractSiteCodesFromUnitName(string $unitName, array $siteCodes): array
{
	$siteSet = [];
	foreach ($siteCodes as $code) {
		$code = strtoupper(trim((string)$code));
		if ($code !== '') $siteSet[$code] = true;
	}

	$s = strtoupper($unitName);
	$s = str_replace(['-', '/', '\\', '(', ')', '[', ']', ',', '.', ':', ';', '|'], ' ', $s);
	$s = preg_replace('/\s+/', ' ', $s);

	$tokens = explode(' ', trim($s));

	$matches = [];
	$seen = [];
	foreach ($tokens as $t) {
		if ($t === '') continue;
		if (isset($siteSet[$t]) && !isset($seen[$t])) {
			$matches[] = $t;
			$seen[$t] = true;
		}
	}

	return $matches;
}