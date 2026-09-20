# Deploying to Namecheap Stellar

Start to finish. Allow about an hour, most of which is waiting for DNS.

Namecheap occasionally moves things around in cPanel, so a menu item may sit under a slightly different heading than described here. The names are stable enough to search for in the cPanel search box.

---

## 1. Point the domain at the hosting

Both the domain and the hosting are with Namecheap, which makes this the easy version.

1. Sign in to Namecheap → **Hosting List** → **Manage** next to your Stellar plan.
2. Find the **nameservers** for your hosting package. They look like `dns1.namecheaphosting.com` and `dns2.namecheaphosting.com`.
3. Go to **Domain List** → **Manage** next to `chicagolandtuckpointing.com`.
4. Under **Nameservers**, choose **Custom DNS** and enter both nameservers.
5. Save.

DNS propagation usually takes 30 minutes to a few hours. It can take up to 24. Nothing below works properly until this resolves, so start here.

To check whether it has taken effect:

```bash
nslookup chicagolandtuckpointing.com
```

If your hosting plan was bought separately from the domain, you may need to add the domain in cPanel first under **Domains → Create A New Domain**.

---

## 2. Install WordPress

1. Open **cPanel** from the Namecheap hosting dashboard.
2. Find **WordPress** under Softaculous Apps Installer (or **WordPress Toolkit** if your cPanel has it).
3. Click **Install** and fill in:

| Field | Value |
|---|---|
| Protocol | **https://** (not http, and not the www variant unless you want www) |
| Domain | `chicagolandtuckpointing.com` |
| In Directory | **leave this empty** — this is the single most common mistake, a value here puts the site at `/wp` |
| Site Name | Chicagoland Tuckpointing |
| Admin Username | anything except `admin` |
| Admin Password | use the generator |
| Admin Email | an address you actually check |

4. Install.

If SSL is not active yet, cPanel's **SSL/TLS Status** page has an **Run AutoSSL** button. Stellar includes free SSL. Wait for the certificate before choosing `https://` above, or reinstall afterwards — mixing them up leads to mixed-content warnings that are annoying to unpick.

---

## 3. Set PHP to 8.2 or 8.3

Shared hosts often default to an older PHP. Newer is meaningfully faster.

1. cPanel → **Select PHP Version** (sometimes **MultiPHP Manager**).
2. Choose **8.2** or **8.3**.
3. Make sure these extensions are enabled: `curl`, `mbstring`, `gd` or `imagick`, `zip`, `intl`, `opcache`.

`opcache` in particular is worth checking. It caches compiled PHP and makes a noticeable difference on shared hosting.

---

## 4. Upload the theme and the plugin

Two ZIP files ship alongside this guide: `ctp.zip` and `ctp-core.zip`.

**The plugin first**, because the theme depends on it:

1. WordPress admin → **Plugins → Add New → Upload Plugin**
2. Choose `ctp-core.zip` → **Install Now** → **Activate**

**Then the theme:**

3. **Appearance → Themes → Add New → Upload Theme**
4. Choose `ctp.zip` → **Install Now** → **Activate**

If the upload is rejected for size, use cPanel **File Manager** instead: navigate to `public_html/wp-content/themes/`, upload the zip, and use the **Extract** action. Same for `wp-content/plugins/`.

---

## 5. Import the starter content

**Tools → Starter Content → Import starter content**

This creates 10 services, 21 service area pages, 6 articles and 5 pages, then sets the front page, the posts page, pretty permalinks and both navigation menus.

It is safe to run again. Anything whose slug already exists is skipped, so your edits are never overwritten.

---

## 6. Put in the real business details

**Settings → Business Info**

At minimum, replace:

- **Phone** — currently the placeholder `(630) 555-0123`
- **Email** — currently `info@chicagolandtuckpointing.com`
- **Hours**
- **Year founded** — drives the "X years in business" badge; clear it to hide that
- **License number** — optional, shown in the footer if filled in

**On the street address:** leave it blank if your dad works out of the house. Google does not require a street address for a service-area business, and publishing a home address invites both junk mail and the occasional unwanted visitor. City, state and ZIP are enough, and that is what the schema will use.

---

## 7. Install the two plugins

### LiteSpeed Cache — the single biggest performance win

Stellar runs on LiteSpeed, so this plugin talks directly to the web server. Cached pages are served without PHP running at all.

1. **Plugins → Add New**, search **LiteSpeed Cache**, install, activate.
2. **LiteSpeed Cache → Cache → Cache** tab: turn **Enable Cache** on.
3. **Browser** tab: turn **Browser Cache** on.
4. **Page Optimization → CSS Settings**: turn on **CSS Minify** and **CSS Combine**.
5. **Page Optimization → JS Settings**: turn on **JS Minify** and **JS Defer**.
6. **Image Optimization**: turn on **Auto Request Cron** and **Image WebP Replacement**.

Leave "CSS Combine External and Inline", "Load JS Deferred → Delayed", and the Critical CSS / UCSS options alone at first. They are the settings most likely to break a page layout, and given how small this theme's CSS already is, they would save you perhaps a kilobyte.

Image optimization is worth switching on before you upload photos. It converts to WebP automatically and will make a bigger difference to this site than anything else on the list, because photos will end up being 95% of the page weight.

### Fluent Forms — the contact form

The form is already built. It lives in the database rather than in the repo, so it travels as a JSON export: **`tools/fluentform-estimate-request.json`**.

1. **Plugins → Add New**, search **Fluent Forms**, install, activate.
2. **Fluent Forms → Tools → Import Forms**, upload `tools/fluentform-estimate-request.json`.
3. Open the imported form and copy its shortcode — the ID will differ from the local one.
4. **Appearance → Customize → Contact Form**, paste the shortcode in.
5. **Settings → Email Notifications** on the form: confirm the "send to" address is the real business email. The export carries whatever was in Business Info at export time.
6. **Settings → Confirmation**: confirm it redirects to the **Thank You** page. Page IDs change between installs, so re-pick it from the dropdown.

Steps 5 and 6 are the two that do not survive an import cleanly, because both reference IDs that are specific to an install. Check them.

Until step 4 is done the contact page shows a clear notice instead of a form, so nothing looks broken.

**What the form asks for:**

| Field | Required | Why |
|---|---|---|
| First / last name | First only | Lower friction than demanding both |
| Phone | Yes | The fastest way to reach someone about masonry work |
| Email | Yes | Needed to send the written estimate |
| Town or ZIP | Yes | Confirms they are inside the service area before anyone drives out |
| What can we help with? | No | Dropdown of all ten services plus "Not sure — please take a look" |
| Tell us what you are seeing | Yes | Help text prompts for house age, previous repointing, and water inside |

The notification email subject is `Estimate request: {service} in {town}`, and reply-to is set to the submitter, so hitting reply in the inbox goes straight back to the customer.

**No photo upload field.** File and image upload are paid features in Fluent Forms. The message field's help text asks people to email photos instead, which costs nothing and works.

---

## 8. Make form emails actually arrive

This matters more than people expect. Shared hosting sends mail through `PHP mail()`, which Gmail and Outlook treat with suspicion. Form submissions land in spam or vanish silently, and you never find out you lost the lead.

Install **FluentSMTP** (free) and connect a real mail service:

- **Google Workspace / Gmail** — if he already has a Google account
- **Namecheap Private Email** — included free for the first couple of months on Stellar, then inexpensive
- **Brevo** or **SendGrid** — generous free tiers, most reliable option

Then send yourself a test submission and confirm it arrives in the inbox, not the spam folder. Do this before you start advertising the site.

---

## 9. Final settings pass

**Settings → General**
- Site Title: `Chicagoland Tuckpointing`
- Tagline: something descriptive, not "Just another WordPress site"
- Both URLs on `https://`

**Settings → Permalinks**
- **Post name**. The importer sets this, but visit the page once to flush the rewrite rules.

**Settings → Discussion**
- Uncheck **Allow people to submit comments on new posts**. A contractor site does not need comments and they are a spam magnet.

**Settings → Media**
- Uncheck **Organize my uploads into month- and year-based folders** if you would rather keep photo URLs tidy. Optional.

**Appearance → Customize → Site Identity**
- Upload a logo when you have one. Until then the theme shows a clean wordmark with a trowel icon.

---

## 10. Check it works

Walk the site on a phone, not just a desktop browser. Most of the traffic will be someone standing in their driveway looking at their chimney.

- [ ] Home page loads over `https://` with a padlock
- [ ] The mobile call bar appears at the bottom on a phone
- [ ] Tapping the phone number opens the dialer
- [ ] A service page loads and the FAQs expand
- [ ] A service area page loads
- [ ] The contact form submits and the email arrives
- [ ] A made-up URL like `/nonsense/` shows the styled 404, not a server error

---

## Backups

Namecheap takes its own backups, but do not rely solely on them for a site you care about.

Install **UpdraftPlus** (free), set a weekly schedule, and send it to Google Drive or Dropbox. Five minutes now, and it is the difference between a bad afternoon and a lost website.

---

## If something goes wrong

**White screen after activating the theme.** The plugin probably is not active. Activate CTP Core first.

**Service pages 404.** Visit **Settings → Permalinks** and click Save. This flushes the rewrite rules.

**The site looks unstyled.** A caching problem. **LiteSpeed Cache → Toolbox → Purge All**.

**Changes do not show up.** Same fix, plus a hard refresh (Ctrl+Shift+R).

**"Are you sure you want to do this?" on upload.** The ZIP is bigger than the upload limit. Use cPanel File Manager to upload and extract instead.
