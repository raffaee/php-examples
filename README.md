# PHP2Shell exposure demo (CVE-2026-109618 / CVE-2026-109619)

Demo only. This project contains no exploit code. It pins PHP runtimes that are
below the fixed releases so scanners and inventory checks have something to flag.

The bugs are in the PHP engine, not in application code, so exposure is decided by
the runtime version and how it serves requests.

| Branch | Fixed in |
|---|---|
| 8.5.x | 8.5.12 |
| 8.4.x | 8.4.27 |
| 8.3.x | 8.3.36 |
| 8.2.x | 8.2.35 |
| 7.4, 8.0, 8.1 | no official release; use a vendor package or upgrade |
| 7.3 and older | no fix; upgrade |

## Where the exposure is

| File | Exposed setting |
|---|---|
| `Dockerfile` | `php:8.2.20-apache` is below 8.2.35 and runs as Apache mod_php |
| `docker-compose.yml` | `php:8.3.10-fpm` is below 8.3.36; `php:7.4-fpm` has no fix |
| `composer.json` | allows `>=7.4` and pins the platform to 8.1.0 |
| `.github/workflows/ci.yml` | matrix runs 7.4, 8.1 and 8.2.20 |

## Check it

```bash
php check-php2shell.php            # exit 1 = vulnerable, 2 = no official fix, 0 = fixed
docker build -t php2shell-demo . && trivy image php2shell-demo
```

## Fix

Move to 8.5.12, 8.4.27, 8.3.36 or 8.2.35 (for example `FROM php:8.2.35-apache`),
then restart all PHP workers. PHP states that no configuration change fully
mitigates these vulnerabilities.
