# DEMO ONLY - intentionally pins a PHP runtime that is exposed to
# CVE-2026-109618 and CVE-2026-109619 (PHP2Shell).
# Fixed releases: 8.5.12, 8.4.27, 8.3.36, 8.2.35.
# 8.2.20 is below 8.2.35, so this image is exposed.
# Apache mod_php is the deployment PHP considers highest risk.
FROM php:8.2.20-apache

COPY src/ /var/www/html/
