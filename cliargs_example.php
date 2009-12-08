#!/usr/bin/php
<?php

// This is an example demonstrating how to use the cliargs command-line argument
// library. By Pete Warden, http://petewarden.typepad.com - freely reusable
// with no restrictions.

require_once('cliargs.php');

$cliargs = array(
	'filename' => array(
		'short' => 'f',
		'type' => 'required',
		'description' => 'This is a required argument, the value can be specified as either -f/--filename=<value> or -f/--filename <value>. If the argument is not specified, the script will print this usage information and exit',
		'default' => '',
	),
	'queryurl' => array(
		'short' => 'q',
		'type' => 'optional',
		'description' => 'This is an optional argument, if -q/--queryurl is not specified, the default value of "empty" will be set into the result array',
		'default' => 'http://example.com',
	),
	'dohost' => array(
		'short' => 'h',
		'type' => 'switch',
		'description' => 'Switches default to false if they\'re not included on the command line, or true if they are present (you don\'t specify a value)',
	),
);	

$options = cliargs_get_options($cliargs);

$filename = $options['filename'];
$queryurl = $options['queryurl'];
$dohost = $options['dohost'];

if ($filename === 'bad')
{
    print "You gave me a filename I didn't like: '$filename'\n";
	cliargs_print_usage_and_exit();
}

print "All arguments set: filename='$filename', queryurl='$queryurl', dohost='";
if ($dohost)
    print "true";
else
    print "false";
print "'\n";

$unnamed = $options['unnamed'];
if (empty($unnamed))
{
    print "No unnamed arguments\n";
}
else
{
    print "Unnamed arguments: ".print_r($unnamed, true);
}

?>