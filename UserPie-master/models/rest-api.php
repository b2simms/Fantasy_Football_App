<?php
require 'Slim/Slim.php';

if (isset($_SERVER['HTTP_ORIGIN'])) {
	header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
	header("Access-Control-Allow-Origin: *");
	header('Access-Control-Allow-Credentials: true');    
	header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
}   
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
		header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

	exit(0);
}
require_once("config.php");   
include_once 'funcs.football.php';    
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

//$app->get('/pickAll', 'getPicks');
$app->get('/pick/:pool', 'getCurrentPoolPick');
//$app->get('/pick/:round/:pool', 'getUserPick');
$app->get('/updatePick/:pick/:pool', 'updatePick');
//$app->get('/round', 'getCurrentRound');
//$app->get('/allteams', 'getAllTeams');
$app->run();

function getPicks() {
    $picks = new Football();
    echo $picks->getAllUserPicks();
}
function getCurrentPoolPick($pool) {
    $picks = new Football();
    echo $picks->getSpecificUserPick($pool);
}
function getUserPick($round,$pool) {
    $picks = new Football();
    echo $picks->getUserPick($round,$pool);
}
function updatePick($pick,$pool) {
    $picks = new Football();
    echo $picks->updateUserPick($pick,$pool);
}
function getCurrentRound() {
    $picks = new Football();
    echo $picks->getCurrentRound();
}
function getAllTeams() {
    $picks = new Football();
    echo $picks->getAllTeams();
}


?>