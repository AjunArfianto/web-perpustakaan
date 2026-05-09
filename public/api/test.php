<?php
include 'dashboard.php';

echo 'Testing getLatestBooks function...' . PHP_EOL;
$result = getLatestBooks(5);
echo 'Result type: ' . gettype($result) . PHP_EOL;

if ($result !== null) {
    echo 'Result count: ' . count($result) . PHP_EOL;
    echo 'First item: ' . PHP_EOL;
    var_dump($result[0]);
} else {
    echo 'Result is NULL!' . PHP_EOL;
}

// Test cache functions
echo PHP_EOL . 'Testing cache functions...' . PHP_EOL;
$testKey = 'test_key';
$testData = ['test' => 'data'];
setCachedData($testKey, $testData);
$cached = getCachedData($testKey);
echo 'Cache test result: ' . ($cached === $testData ? 'SUCCESS' : 'FAILED') . PHP_EOL;
?>




