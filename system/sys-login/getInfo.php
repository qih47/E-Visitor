<?php
function getDeviceType()
{
$userAgent = $_SERVER['HTTP_USER_AGENT'];

if (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Android') !== false) {
return 'Mobile';
} elseif (strpos($userAgent, 'Tablet') !== false || strpos($userAgent, 'iPad') !== false) {
return 'Tablet';
}

return 'Desktop';
}

function getBrowser()
{
$userAgent = $_SERVER['HTTP_USER_AGENT'];

if (strpos($userAgent, 'Opera') || strpos($userAgent, 'OPR/')) {
preg_match('/(Opera|OPR)\/([\d.]+)/', $userAgent, $matches);
$browserName = 'Opera';
$browserVersion = $matches[2];
} elseif (strpos($userAgent, 'Edge')) {
preg_match('/Edge\/([\d.]+)/', $userAgent, $matches);
$browserName = 'Microsoft Edge';
$browserVersion = $matches[1];
} elseif (strpos($userAgent, 'Chrome')) {
preg_match('/Chrome\/([\d.]+)/', $userAgent, $matches);
$browserName = 'Google Chrome';
$browserVersion = $matches[1];
} elseif (strpos($userAgent, 'Safari')) {
preg_match('/Version\/([\d.]+)/', $userAgent, $matches);
$browserName = 'Safari';
$browserVersion = $matches[1];
} elseif (strpos($userAgent, 'Firefox')) {
preg_match('/Firefox\/([\d.]+)/', $userAgent, $matches);
$browserName = 'Mozilla Firefox';
$browserVersion = $matches[1];
} elseif (strpos($userAgent, 'MSIE') || strpos($userAgent, 'Trident/7')) {
preg_match('/(MSIE|rv:)([\d.]+)/', $userAgent, $matches);
$browserName = 'Internet Explorer';
$browserVersion = $matches[2];
} else {
$browserName = 'Unknown';
$browserVersion = '';
}

return [
'name' => $browserName,
'version' => $browserVersion
];
}

// Menggunakan fungsi-fungsi di atas untuk mendapatkan informasi perangkat dan browser
$deviceType = getDeviceType();
$browserInfo = getBrowser();

$browserName = $browserInfo['name'];
$browserVersion = $browserInfo['version'];
?>