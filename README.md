# Gulf Cut UAE website

Laravel site for [gulfcut.ae](https://gulfcut.ae): concrete cutting, core drilling, scanning and demolition in the UAE.
There is no database content and no build step. CSS and JS are plain files in `public/`.

## Where things live

| What | File |
| --- | --- |
| Phone, email, address, WhatsApp, menus, titles, meta descriptions, schema | `app/Support/GulfCut.php` |
| Service page content (imported from the old WordPress site) | `resources/data/widgets.json` |
| Blog posts | `resources/data/blog.php` |
| Projects | `resources/data/projects.php` |
| Styles / scripts | `public/css/site.css`, `public/js/site.js` (bump the `?v=` number in `layouts/site.blade.php` after editing) |
| Sitemap | generated at `/sitemap.xml` by `SiteController@sitemap` |

Adding a service page: add the slug to `GulfCut::servicePages()`, a title to `titles()`, a description to `descriptions()`
and its widgets to `widgets.json`. The route and sitemap pick it up.

Images: put the photo in `public/images/`. Photos wider than 700px should also get a `name-640.webp` copy for phones.
The helpers `GulfCut::attrs()` and `GulfCut::heroStyle()` add width/height/srcset automatically.

## Production `.env`

```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://gulfcut.ae
MAIL_MAILER=smtp          # NOT "log", or quote requests never arrive
MAIL_FROM_ADDRESS=info@gulfcut.ae
GTM_ID= / GA4_ID=          # analytics, one of the two
GOOGLE_SITE_VERIFICATION=  # Search Console
SAME_AS=                   # Google Business Profile and social URLs, comma separated
```

Sessions and cache use the database driver, so run `php artisan migrate --force` once.

## Deploy

```
composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
```
