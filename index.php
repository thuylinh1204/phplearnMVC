<?php
session_start();
if (isset($_SESSION['user']))
{
    echo "Hello Hanoi 2021!";
}
else{

$a = [
    [
        'id' 	=> 1,
        'name' 	=> 'abc',
        'model'	=> 'xxx',
        'year' 	=> '2017',
    ],
    [
        'id' 	=> 2,
        'name' 	=> 'dbc',
        'model'	=> '',
        'year' 	=> '2017',
    ],
    [
        'id' 	=> 3,
        'name' 	=> 'dbc',
        'model'	=> '',
        'year' 	=> '2016',
    ],
    [
        'id' 	=> 4,
        'name' 	=> 'dbc',
        'model'	=> '',
        'year' 	=> '2018',
    ]
];

function checkEmpty($var)
{
    return !empty($var['model']);
}

function sortByYear($a, $b)
{
    if ($a['year'] == $b['year']) {
        return 0;
    }
    return ($a['year'] > $b['year']) ? -1 : 1;
}


//var_dump(array_filter($a, "checkEmpty"));

usort($a, "sortByYear");

var_dump($a);
}