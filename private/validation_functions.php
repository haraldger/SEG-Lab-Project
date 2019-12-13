<?php
// Functions to check data
// E.g. checking if input is email, etc

// is_blank('abcd')
// * validate data presence
// * uses trim() so empty spaces don't count
// * uses === to avoid false positives
// * better than empty() which considers "0" to be empty
function is_blank($value) {
	return !isset($value) || trim($value) === '';
}

// has_length_greater_than('abcd', 3)
// * validate string length
// * spaces count towards length
// * use trim() if spaces should not count
function has_length_greater_than($value, $min) {
    $length = strlen($value);
    return $length > $min;
}

// has_length_less_than('abcd', 5)
// * validate string length
// * spaces count towards length
// * use trim() if spaces should not count
function has_length_less_than($value, $max) {
    $length = strlen($value);
    return $length < $max;
}

// has_length_exactly('abcd', 4)
// * validate string length
// * spaces count towards length
// * use trim() if spaces should not count
function has_length_exactly($value, $exact) {
    $length = strlen($value);
    return $length == $exact;
}

// has_length('abcd', ['min' => 3, 'max' => 5])
// * validate string length
// * combines functions_greater_than, _less_than, _exactly
// * spaces count towards length
// * use trim() if spaces should not count
function has_length($value, $options) {
    if(isset($options['min']) && !has_length_greater_than($value, $options['min'])) {
		return false;
    } elseif(isset($options['max']) && !has_length_less_than($value, $options['max'])) {
		return false;
    } elseif(isset($options['exact']) && !has_length_exactly($value, $options['exact'])) {
		return false;
    } else {
		return true;
    }
}

// has_valid_email_format('nobody@nowhere.com')
// * validate correct format for email addresses
// * format: [chars]@[chars].[2+ letters]
// * preg_match is helpful, uses a regular expression
//    returns 1 for a match, 0 for no match
//    http://php.net/manual/en/function.preg-match.php
function has_valid_email_format($value) {
    $email_regex = '/\A[A-Z0-9._%+-]+@kcl.ac.uk\Z/i';
    return preg_match($email_regex, $value) === 1;
}

function has_unique_email($email, $current_id="0") {
  $member = Member::find_by_email($email);
  if($member === false || $member->id == $current_id) {
    // is unique
    return true;
  } else {
    // not unique
    return false;
  }
}
