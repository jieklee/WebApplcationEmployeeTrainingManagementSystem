<?php

define('ROLE_ADMIN', 'A');
define('ROLE_HR', 'HR');
define('ROLE_TRAINER', 'TR');
define('ROLE_TRAINEE', 'TE');

$type = array(
	ROLE_HR => 'HR Staff',
	ROLE_TRAINER => 'Trainer',
	ROLE_TRAINEE => 'Trainee'
);

$rating = array(
    1,
    2,
    3,
    4,
    5,
);

$status = array(
    'C' => 'Confirmed',
    'P' => 'Pending',
    'R' => 'Rejected',
);

$department = array(
    'MKT' => 'Marketing',
    'HR' => 'Human Resource',
    'IT' => 'Information Technology',
    'S' => 'Sales',
	'SP' => 'Support',
);

$time = array(
    '6:00 PM',
    '6:15 PM',
    '6:30 PM',
    '6:45 PM',
    '7:00 PM',
    '7:15 PM',
    '7:30 PM',
    '7:45 PM',
    '8:00 PM',
    '9:15 PM',
    '9:30 PM',
    '9:45 PM',
    '10:00 PM',
);
