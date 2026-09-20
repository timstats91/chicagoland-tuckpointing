# Local SEO checklist

The site handles the technical side on its own. This is the part that needs a human.

Ordered by how much difference it makes, which is not the order most people do it in.

---

## 1. Google Business Profile — do this first

For a local contractor, this outranks everything else on this page combined. Most people searching "tuckpointing near me" never scroll past the map pack, and the map pack is fed by Google Business Profile, not by your website.

1. Go to [google.com/business](https://www.google.com/business) and claim or create the listing.
2. Set it up as a **service-area business**, not a storefront. Hide the address and list the towns served instead. This is the correct choice when he works out of a home or yard.
3. Pick **Masonry Contractor** as the primary category. Add **Chimney Services** and **Concrete Contractor** as secondary if they fit.
4. Service areas: list the towns from the site's service areas page.
5. Hours: match what is in **Settings → Business Info** exactly.
6. Add the website URL.
7. Upload photos. Google weights listings with real photos heavily, and it wants new ones over time, not a batch uploaded once.
8. Paste the profile URL into **Settings → Business Info → Google Business Profile URL**. The site then links it in its structured data.

Google will verify by postcard, phone or video. The postcard takes a week or two, so start it early.

### Reviews

Reviews are the other half of the map pack, and they are the hardest part to fake, which is why they count.

- Ask every satisfied customer, in person, on the last day. Not by email a week later
- Get the short link from the Google dashboard, save it in his phone, and text it to them while you are still in the driveway
- Aim for a steady trickle rather than ten in one week, which looks manufactured
- Reply to every review, including the bad ones. Reply calmly to the bad ones especially. Future customers read the response more carefully than the complaint

Ten genuine reviews will do more for the phone ringing than anything else in this document.

---

## 2. Consistent name, address and phone

Google cross-references your business details across the web. Inconsistency dilutes it.

Pick one exact format and use it everywhere, character for character:

```
Chicagoland Tuckpointing
Wood Dale, IL 60191
(630) XXX-XXXX
```

Then list the business, with that exact format, on:

- Google Business Profile
- Bing Places
- Apple Business Connect
- Facebook
- Yelp
- Angi / HomeAdvisor
- Better Business Bureau
- Nextdoor — genuinely effective for local contractors
- The Chamber of Commerce in Wood Dale or Itasca

Put the profile URLs into **Settings → Business Info** as you go. The site adds them to its structured data as `sameAs` links, which is how Google connects the listings to the site.

---

## 3. Verify the technical side

The site does this automatically, but confirm it once after launch.

**Structured data.** Paste a few URLs into the [Rich Results Test](https://search.google.com/test/rich-results):
- The home page → should report `GeneralContractor` / `LocalBusiness`
- A service page → should report `Service` and `FAQPage`
- An article → should report `BlogPosting`

**Google Search Console.** Set it up at [search.google.com/search-console](https://search.google.com/search-console), verify the domain, and submit the sitemap. WordPress generates one at:

```
https://chicagolandtuckpointing.com/wp-sitemap.xml
```

Then check back monthly. The **Performance** report tells you which searches are finding you, and that is the best guide to what to write next.

**PageSpeed Insights.** Run [pagespeed.web.dev](https://pagespeed.web.dev) against the home page. Expect mid-to-high 90s on mobile. If it drops sharply later, it will be either an unoptimized photo or a plugin somebody added.

---

## 4. Do you need an SEO plugin?

Probably not at first, and possibly not at all.

The site already generates the structured data that matters, and WordPress handles sitemaps, canonical URLs and titles by itself. Yoast and Rank Math mostly add things this site already has, plus a large admin interface and a certain amount of weight.

**Install one only when you actually want:**
- Per-page control over meta descriptions
- Open Graph images for how links look when shared on Facebook
- Redirect management after changing URLs

If you do, **Rank Math** is the lighter of the two. Turn off its schema modules, since they would duplicate what CTP Core already outputs, and duplicated schema is worse than none.

---

## 5. What to write, in order

The starter articles cover the general questions. The next ones should be more specific, because specific queries are less competitive and the people searching them are closer to calling.

**Town plus service pieces** — the highest-value writing you can do:
- "Tuckpointing in Elmhurst: what the 1920s brick around here actually needs"
- "Chimney rebuilds in Oak Park and the historic district rules"
- "Why Addison's 1960s ranches are all needing tuckpointing at once"

**Question pieces**, straight out of what people ask on the phone:
- "Can you tuckpoint in winter in Chicago?"
- "How long does tuckpointing last?"
- "Is my chimney dangerous?"

**Cost pieces.** People search these constantly and most contractors refuse to write them, which is exactly why they work. Give real ranges and explain what moves the number.

One article a month is plenty. Three good ones beat twenty thin ones, and thin content actively hurts.

---

## 6. What not to do

**Do not create a page for every town in the coverage list.** Eighty near-identical city pages is the single most common way a local contractor site gets flagged as thin content. The site is set up with 21 real pages and a 105-town coverage list for exactly this reason.

**Do not buy backlinks.** The directory-link packages advertised to contractors are worthless at best.

**Do not stuff keywords.** "Tuckpointing Chicago tuckpointing contractor Chicago tuckpointing near me" reads badly to humans and Google stopped rewarding it well over a decade ago.

**Do not hide text or reviews you did not receive.** Fake reviews get listings suspended, and a suspended Google Business Profile is genuinely hard to get back.

**Do not let someone talk you into a $1,500/month SEO retainer** in the first year. Reviews, photos and a monthly article will outperform it.

---

## A realistic timeline

| When | What to expect |
|---|---|
| Week 1 | Site live, Google Business Profile submitted |
| Weeks 2–4 | Verification completed, pages start getting indexed |
| Months 2–3 | Ranking for the long-tail searches — "tuckpointing Wood Dale", "chimney rebuild Itasca" |
| Months 4–6 | Map pack presence in the nearest towns, if reviews are coming in |
| Months 6–12 | Competing for the broader terms in DuPage |

Local SEO is slow and then it compounds. The work that matters is unglamorous: photos from every job, reviews from every customer, an article a month.
