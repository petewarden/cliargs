cliargs
-------

Two utility functions to make handling command line arguments in PHP easier

To use them, pass in an array describing the expected arguments, in the form

 array(
 '<long name of argument>' => array(
     'short' => '<single letter version of argument>',
     'type' => <'switch' | 'optional' | 'required'>,
     'description' => '<help text for the argument>',
     'default' => '<value if this is an optional argument and it isn't specified>',
 ),
 ...
 );

If the type is switch, then the result is a boolean that will be false if it's
not present, or true if it is

If the type is optional, then the result will be the default if it's not present

If the type is required, then the script will print out the usage and exit if it's
not found

To use, call cliargs_print_usage_and_exit() with the array of argument descriptions
The result will be an array with the argument names as keys to the found values

by Pete Warden, http://petewarden.typepad.com but freely reusable with no restrictions

-------

There's an example file cliargs_example.php you can look at for more information on
usage. Here's some calls to that script and the expected output:

*No arguments*
./cliargs_example.php
Missing required value for 'filename'
Usage:
-f/--filename <value> : This is a required argument, the value can be specified as either -f/--filename=<value> or -f/--filename <value>. If the argument is not specified, the script will print this usage information and exit (required)
-q/--queryurl <value> : This is an optional argument, if -q/--queryurl is not specified, the default value of "empty" will be set into the result array
-h/--dohost : Switches default to false if they're not included on the command line, or true if they are present (you don't specify a value)

*Short required argument*
./cliargs_example.php -f somefilename
All arguments set: filename='somefilename', queryurl='http://example.com', dohost='false'
No unnamed arguments

*Long required argument*
./cliargs_example.php -filename somefilename
All arguments set: filename='somefilename', queryurl='http://example.com', dohost='false'
No unnamed arguments

*Short argument using equals*
./cliargs_example.php -filename=somefilename
All arguments set: filename='somefilename', queryurl='http://example.com', dohost='false'
No unnamed arguments

*Setting an optional argument*
/cliargs_example.php -f somefilename -q "http://someother.com"
All arguments set: filename='somefilename', queryurl='http://someother.com', dohost='false'
No unnamed arguments

*Setting a short switch*
./cliargs_example.php -f somefilename -h
All arguments set: filename='somefilename', queryurl='http://example.com', dohost='true'
No unnamed arguments

*Setting a long switch*
./cliargs_example.php -f somefilename -dohost
All arguments set: filename='somefilename', queryurl='http://example.com', dohost='true'
No unnamed arguments

*Unnamed arguments*
./cliargs_example.php unnamed_one -f somefilename unnamed_two "unnamed three"
All arguments set: filename='somefilename', queryurl='http://example.com', dohost='false'
Unnamed arguments: Array
(
    [0] => unnamed_one
    [1] => unnamed_two
    [2] => unnamed three
)

*Unknown argument*
./cliargs_example.php -f somefilename -p
Unknown argument 'p'
Usage:
-f/--filename <value> : This is a required argument, the value can be specified as either -f/--filename=<value> or -f/--filename <value>. If the argument is not specified, the script will print this usage information and exit (required)
-q/--queryurl <value> : This is an optional argument, if -q/--queryurl is not specified, the default value of "empty" will be set into the result array
-h/--dohost : Switches default to false if they're not included on the command line, or true if they are present (you don't specify a value)
