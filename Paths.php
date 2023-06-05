<?php
define ('HOME' , 'E:\SoftWare\xampp-windows-x64-8.2.4-0-VS16-installer\htdocs\my_projects\GitHub\FakeContent');

/* ----------------------------------------------------------------------
 * Interpreter directory
 * ----------------------------------------------------------------------
 */

define ('INTERPRETER' , HOME . '/Interpreter/Interpreter.php');
define ('BASE_INTERPRETER' , HOME . '/Interpreter/Handlers/BaseInterpreter.php');
define ('METHOD' , HOME . '/Interpreter/Handlers/Method.php');
define ('RANGE' , HOME . '/Interpreter/Handlers/Range.php');
define ('SIGN' , HOME . '/Interpreter/Handlers/Sign.php');

/* ----------------------------------------------------------------------
 * GenContent directory
 * ----------------------------------------------------------------------
 */

define ('GEN_CONTENT' , HOME . '/GenContent/GenContent.php');
define ('ACCIDENTAL' , HOME . '/GenContent/Handlers/Accidental.php');
define ('BASE_CHARACTER' , HOME . '/GenContent/Handlers/BaseCharacter.php');
define ('DATE_TIME' , HOME . '/GenContent/Handlers/DateTime.php');
define ('HASHING' , HOME . '/GenContent/Handlers/Hashing.php');
define ('ORDINAL' , HOME . '/GenContent/Handlers/Ordinal.php');
define ('GEN_CONTENT_RANGE' , HOME . '/GenContent/Handlers/Range.php');
define ('BASE_LOREM_IPSUM' , HOME . '/GenContent/Handlers/LoremIpsum/BaseLoremIpsum.php');
define ('CHARACTER' , HOME . '/GenContent/Handlers/LoremIpsum/Character.php');
define ('WORD' , HOME . '/GenContent/Handlers/LoremIpsum/Word.php');
