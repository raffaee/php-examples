<?php
// Run from the CLI: php check-php2shell.php
// Flags a PHP runtime below the fixed releases for CVE-2026-109618 / CVE-2026-109619.
// Distro packages may backport fixes without changing the version, so confirm
// a "vulnerable" result against your distribution's security advisory.
$fixed = [
    '8.5' => '8.5.12',
    '8.4' => '8.4.27',
    '8.3' => '8.3.36',
    '8.2' => '8.2.35',
];

$branch = PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION;

if (!isset($fixed[$branch])) {
    fwrite(STDERR, 'PHP ' . PHP_VERSION . ": no official fix for this branch. "
        . "Use a vendor-patched package or upgrade.\n");
    exit(2);
}

if (version_compare(PHP_VERSION, $fixed[$branch], '<')) {
    fwrite(STDERR, 'PHP ' . PHP_VERSION . ' is VULNERABLE to CVE-2026-109618/109619. '
        . "Upgrade to {$fixed[$branch]} or later.\n");
    exit(1);
}

echo 'PHP ' . PHP_VERSION . " is at or above the fixed release.\n";
