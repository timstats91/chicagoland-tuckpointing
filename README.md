# Chicagoland Tuckpointing

A complete WordPress site for a masonry contractor: custom theme, companion plugin, and a full set of starting content.

Built for `chicagolandtuckpointing.com` on Namecheap Stellar shared hosting.

---

## What's in here

```
wp-content/
├── themes/ctp/            The theme: templates, design system, performance trims
└── plugins/ctp-core/      Services, service areas, projects, business info, schema
    └── data/              The starter content, as plain PHP files you can edit
docs/
├── DEPLOY-NAMECHEAP.md    Step by step, from DNS to a live site
├── CONTENT-GUIDE.md       How to add work, photos and articles
└── SEO-CHECKLIST.md       What to do in the first month
tools/
└── build-zips.ps1         Builds the installable ZIPs for uploading to Namecheap
```

**Why a theme plus a plugin rather than one of each?** Because content should outlive design. Services, areas, projects and the business phone number live in the plugin, so if the site is ever redesigned, none of that has to be re-entered.

---

## Working in this repo

The repo root sits at the WordPress webroot, but **only our own code is tracked**. WordPress core, the bundled Twenty* themes, `wp-content/uploads/` and `wp-config.php` are all gitignored.

That means a fresh clone is not a runnable site by itself, which is intentional. Core is WordPress's job to update, and committing it turns every WP release into a two-thousand-file diff that buries the changes you actually made. `wp-config.php` stays out because it holds the database password and the auth salts.

**Local development** happens in Local (by Flywheel). The site lives at `Local Sites/chicagoland-tuckpointing`, and this repo is its `app/public` folder, so editing the theme in place and refreshing the browser is the whole loop — no build step, no compile.

**To set this up on another machine:**

1. Create a new site in Local.
2. Delete the contents of its `app/public` and clone this repo there — or clone elsewhere and copy `wp-content/themes/ctp` and `wp-content/plugins/ctp-core` across.
3. Activate the plugin, then the theme.
4. Run **Tools → Starter Content**.

**To build the upload ZIPs:**

```powershell
.\tools\build-zips.ps1
```

That writes `dist/ctp.zip` and `dist/ctp-core.zip`. The `dist/` folder is gitignored — archives go stale the moment you edit a file, so build them fresh when you need them rather than committing them.

---

## What the site includes

| | |
|---|---|
| **10 service pages** | Tuckpointing, masonry repair, chimney rebuilds, caulking, patio and paver rebuilds, lintel replacement, step rebuilds, stone restoration, masonry cleaning, waterproofing |
| **21 service area pages** | Wood Dale, Elmhurst, Oak Park, Naperville, Schaumburg and more, each with genuinely local content |
| **105-town coverage list** | Every town within roughly an hour, grouped by county, on the service areas page |
| **6 knowledge hub articles** | 700 to 1,100 words each, on the questions people actually search before calling a mason |
| **Projects section** | Ready for photos, with a drag-to-compare before/after slider |
| **Contact page** | Fluent Forms, with hours, phone, coverage radius and a "what helps us most" panel |
| **Local SEO schema** | LocalBusiness, Service, FAQ, BlogPosting and breadcrumbs, generated automatically |

Every word of the starter copy is written to be edited. It is a strong first draft, not a finished voice — see [CONTENT-GUIDE.md](docs/CONTENT-GUIDE.md).

---

## Performance

You asked whether hosting on Stellar would hurt performance. It will not, for this site. The reason is that the theme is doing almost nothing:

| | Transferred |
|---|---|
| CSS | **7.1 KB** gzipped (one file) |
| JavaScript | **1.4 KB** gzipped (one file, deferred) |
| jQuery | not loaded |
| Page builder | none |
| Web fonts | none — a system font stack, so text paints instantly |

For comparison, a typical Elementor contractor site ships 500 KB to 900 KB per page. This one is under 10 KB of theme assets, so most of what Stellar has to do is serve a cached HTML document.

With LiteSpeed Cache switched on (Stellar runs LiteSpeed, so this is free and genuinely fast), cached pages are served without PHP running at all. Expect load times comfortably under a second and Lighthouse performance in the mid-to-high 90s.

**The honest caveat:** Stellar is the entry plan and it has lower CPU and concurrent-process limits than Stellar Plus. For a local contractor's traffic — realistically a few hundred visits a day at most — that is not a constraint. If the knowledge hub takes off, or you start hosting a lot of large project photos, Stellar Plus is the natural upgrade and costs little more. There is no need to start there.

---

## Installation, short version

The full walkthrough is in [docs/DEPLOY-NAMECHEAP.md](docs/DEPLOY-NAMECHEAP.md). In brief:

1. Point `chicagolandtuckpointing.com` at your Stellar hosting.
2. Install WordPress from cPanel, over HTTPS.
3. Run `.\tools\build-zips.ps1` to produce `dist/ctp.zip` and `dist/ctp-core.zip`.
4. Upload `ctp-core.zip` under **Plugins → Add New → Upload**, and activate it.
5. Upload `ctp.zip` under **Appearance → Themes → Add New → Upload**, and activate it.
6. Go to **Tools → Starter Content** and click **Import starter content**.
7. Go to **Settings → Business Info** and put in the real phone number, email and hours.
8. Install **LiteSpeed Cache** and **Fluent Forms**, then paste the form shortcode into **Appearance → Customize → Contact Form**.

Step 6 builds all 42 pages, sets the front page, the permalink structure and the navigation menus. It is safe to run twice: anything that already exists is skipped, so it never overwrites an edit.

---

## Where to change things

| What | Where |
|---|---|
| Phone, email, hours, address, license, social links | **Settings → Business Info** |
| Homepage headline and hero photo | **Appearance → Customize → Homepage Hero** |
| Contact form shortcode | **Appearance → Customize → Contact Form** |
| Mobile call bar on/off | **Appearance → Customize → Mobile Call Bar** |
| Logo | **Appearance → Customize → Site Identity** |
| Service copy, prices, timelines, FAQs | **Services →** edit any service |
| Menus | **Appearance → Menus** |

Never type the phone number into page content. Use the `[ctp_phone]` shortcode and it stays correct everywhere.

### Shortcodes

| Shortcode | Output |
|---|---|
| `[ctp_phone]` | Linked phone number |
| `[ctp_phone link="no"]` | Plain text phone number |
| `[ctp_email]` | Obfuscated email link |
| `[ctp_hours]` | Formatted hours table |
| `[ctp_services]` | Grid of every service |
| `[ctp_areas]` | Service areas grouped by county |
| `[ctp_cta heading="..." text="..."]` | Call-to-action band |

---

## Technical notes

- **PHP 8.0+**, **WordPress 6.4+**
- Custom fields are plain core meta boxes — no ACF, nothing to renew, one fewer plugin
- The `ctp_service_link` and `ctp_area_link` taxonomies connect projects and articles to services and towns. Tag a project "Tuckpointing" and it appears on the tuckpointing page automatically, because the service's slug and the term's slug are kept in sync
- Those taxonomies are deliberately non-public, so their archives cannot compete with the real service pages in search results
- Structured data and the visible breadcrumbs are generated from the same function, so they can never disagree
- Images without a featured image render a styled "photo coming soon" placeholder rather than an empty box

---

## Before going live

- [ ] Replace the placeholder phone number `(630) 555-0123` in **Settings → Business Info**
- [ ] Replace the placeholder email `info@chicagolandtuckpointing.com`
- [ ] Set the correct founding year, or clear it to hide the "years in business" line
- [ ] Decide whether to publish a street address (usually **no** if he works from home)
- [ ] Read through the service pages and make them sound like your dad
- [ ] Set up SMTP so form emails actually arrive — see the deployment guide
