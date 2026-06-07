<?php
/**
 * Comprehensive PHP Date & Time Demo
 * Covers: DateTime, DateInterval, DatePeriod, Timezones, and legacy functions.
 */

echo "=== PHP Date & Time Functions Demo ===\n\n";

// 1. Creating Dates
echo "1. Creating Dates\n";
echo "-----------------\n";
$now = new DateTime(); // Current date/time
echo "Current: " . $now->format('Y-m-d H:i:s') . "\n";

$specific = new DateTime('2024-12-25 10:30:00');
echo "Specific: " . $specific->format('Y-m-d H:i:s') . "\n";

$relative = new DateTime('next Monday');
echo "Relative ('next Monday'): " . $relative->format('Y-m-d') . "\n\n";

// 2. Parsing Custom Formats (createFromFormat)
echo "2. Parsing Custom Formats\n";
echo "-------------------------\n";
$userDate = "25/12/2024 10:30";
$parsed = DateTime::createFromFormat('d/m/Y H:i', $userDate);
if ($parsed) {
    echo "Parsed from 'd/m/Y H:i': " . $parsed->format('Y-m-d H:i:s') . "\n";
} else {
    echo "Failed to parse date.\n";
}
echo "Last errors: " . print_r(DateTime::getLastErrors(), true) . "\n\n";

// 3. Formatting Output
echo "3. Formatting Output\n";
echo "--------------------\n";
$formatExamples = [
    'Y-m-d H:i:s' => 'ISO 8601 Style',
    'd/m/Y'       => 'European Date',
    'm/d/Y'       => 'US Date',
    'l, d F Y'    => 'Full Text',
    'U'           => 'Unix Timestamp',
    DateTime::RFC3339 => 'RFC 3339'
];

foreach ($formatExamples as $fmt => $desc) {
    echo "$desc: " . $now->format($fmt) . "\n";
}
echo "\n";

// 4. Modifying Dates (Add/Subtract)
echo "4. Modifying Dates\n";
echo "------------------\n";
$base = new DateTime('2024-01-01');
echo "Base: " . $base->format('Y-m-d') . "\n";

// Method A: modify() (Human readable)
$base->modify('+1 month');
echo "After '+1 month': " . $base->format('Y-m-d') . "\n";

$base->modify('-1 year');
echo "After '-1 year': " . $base->format('Y-m-d') . "\n";

// Method B: add()/sub() with DateInterval
$base->add(new DateInterval('P1Y1M')); // 1 Year, 1 Month
echo "After add('P1Y1M'): " . $base->format('Y-m-d') . "\n";

$base->sub(new DateInterval('P6M')); // Subtract 6 Months
echo "After sub('P6M'): " . $base->format('Y-m-d') . "\n\n";

// 5. Calculating Differences (diff)
echo "5. Calculating Differences\n";
echo "--------------------------\n";
$date1 = new DateTime('2023-01-01');
$date2 = new DateTime('2025-06-15');

$diff = $date1->diff($date2);

echo "Date 1: " . $date1->format('Y-m-d') . "\n";
echo "Date 2: " . $date2->format('Y-m-d') . "\n";
echo "Difference (Years): " . $diff->y . "\n";
echo "Difference (Months): " . $diff->m . "\n";
echo "Difference (Days): " . $diff->d . "\n";
echo "Total Days: " . $diff->days . "\n";
echo "Formatted Diff: " . $diff->format('%y years, %m months, %d days') . "\n\n";

// 6. Timezones
echo "6. Timezones\n";
echo "------------\n";
$utc = new DateTime('now', new DateTimeZone('UTC'));
$ny = new DateTime('now', new DateTimeZone('America/New_York'));
$tokyo = new DateTime('now', new DateTimeZone('Asia/Tokyo'));

echo "UTC: " . $utc->format('Y-m-d H:i:s T') . "\n";
echo "New York: " . $ny->format('Y-m-d H:i:s T') . "\n";
echo "Tokyo: " . $tokyo->format('Y-m-d H:i:s T') . "\n";

// Converting timezone
$utc->setTimezone(new DateTimeZone('Europe/London'));
echo "Converted UTC to London: " . $utc->format('Y-m-d H:i:s T') . "\n\n";

// 7. Iterating Date Ranges (DatePeriod)
echo "7. Iterating Date Ranges\n";
echo "------------------------\n";
$start = new DateTime('2024-12-25');
$end = new DateTime('2025-01-05');
$interval = new DateInterval('P1D'); // Every 1 day

$period = new DatePeriod($start, $interval, $end);
echo "Dates from Dec 25 to Jan 5:\n";
foreach ($period as $date) {
    echo " - " . $date->format('M d') . "\n";
}
echo "\n";

// 8. Legacy Functions (For completeness)
echo "8. Legacy Functions (Procedural)\n";
echo "--------------------------------\n";
echo "Current Timestamp (time()): " . time() . "\n";
echo "Current Date (date()): " . date('Y-m-d H:i:s') . "\n";
echo "String to Timestamp (strtotime('now')): " . strtotime('now') . "\n";
echo "String to Timestamp (strtotime('next Friday')): " . strtotime('next Friday') . "\n";

// getdate() returns an array
$details = getdate();
echo "getdate() Year: " . $details['year'] . "\n";
echo "getdate() Month: " . $details['mon'] . "\n\n";

echo "=== Demo Complete ===\n";