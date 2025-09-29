# Security Readiness Checklist

This document summarizes the controls implemented and the items the Phapros security team can verify before go‑live.

## Application Controls
- **Authentication & Role**
  - All admin routes are protected with `['auth','admin']` middleware in `routes/web.php`.
  - Controller authorization for sensitive actions uses FormRequest `authorize()` returning admin only.
- **CSRF Protection**
  - Web group includes `VerifyCsrfToken`; all forms use `@csrf`.
- **Output Escaping (XSS)**
  - Blade uses `{{ }}` for user content (e.g., `keterangan`, `notes`). No raw `{!! !!}` rendering.
- **Validation**
  - FormRequest classes:
    - `StockOpnameImportRequest`
    - `StockOpnameUpdateStokRequest`
    - `StockOpnameUpdateLotSerialRequest`
    - `StockOpnameUpdateLocationActualRequest`

## File Upload / Import
- Accepts only `xlsx,xls,csv` with 10 MB limit (configurable) and stores files under `storage/app/public/stock_opname`.
- Excel import parses data only (no macro execution).

## Security Headers
- Middleware `App\Http\Middleware\SecurityHeaders` adds:
  - `X-Frame-Options: DENY`
  - `X-Content-Type-Options: nosniff`
  - `Referrer-Policy: no-referrer-when-downgrade`
  - Minimal **Content-Security-Policy**. In local, allows Vite HMR; in non-local, `default-src 'self'`.

## Environment & Session (Production)
- `.env` expected settings:
  - `APP_ENV=production`
  - `APP_DEBUG=false`
  - `APP_KEY` set
  - `SESSION_SECURE_COOKIE=true`
  - `SESSION_SAME_SITE=lax` (or `strict`)
  - `LOG_LEVEL=warning`
- Cookies are encrypted; sessions start in web middleware group.

## Rate Limiting (Recommended)
- Use `throttle` middleware for login and heavy endpoints (import/export) as needed.

## Dependency Hygiene
- Run `composer audit` and `npm audit` and patch any high/critical issues before go‑live.

## Deployment Notes
- Serve `public/` as document root.
- Build production assets with Vite: `npm ci && npm run build`.
- Optimize caches: `php artisan optimize`.

## Evidence for Review
- Code references:
  - Routes: `routes/web.php`
  - Middleware: `app/Http/Middleware/SecurityHeaders.php`, `app/Http/Middleware/AdminMiddleware.php`
  - Kernel registration: `app/Http/Kernel.php`
  - Requests: `app/Http/Requests/*`
  - Controller: `app/Http/Controllers/Admin/StockOpnameController.php`

If anything above needs adjustment for the Phapros security baseline, please annotate here.
