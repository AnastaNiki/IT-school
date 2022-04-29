<?php
require '../../start.php';
$request = file_get_contents('php://input');
if (empty($request)) die(http_response_code(400));
$rj = json_decode($request);
if (is_null($rj)) die(http_response_code(406));
if (!API::checkKey($rj->api_key)) die(http_response_code(401));
if (!isset($rj->target_user) || !isset($rj->message)) die(http_response_code(422));
$ms = MemberSearch::searchMember($rj->target_user);
if (is_null($ms)) die(http_response_code(410));
global $discord;
$dmc = $discord->user->createDm([
    'recipient_id' => $ms
]);
$dmcid = $dmc->id;
try {
    (new CreateMessage)->setDestination($dmcid)
        ->setContent($rj->message)
        ->send();
} catch (Exception $e) {
    error_log($e->getMessage());
    die(http_response_code(503));
}
http_response_code(200);