# Content guide

How to add work to the site once it is live. Written for whoever ends up maintaining it, including your dad.

---

## Adding a project

Projects are the most valuable content on the site. A homeowner deciding between three masonry contractors is looking for evidence, and "here is a chimney we rebuilt in Elmhurst in June, with photos" is worth more than any amount of copy.

**Projects → Add New**

| Field | What to put |
|---|---|
| Title | What was done and where: "Chimney Rebuild in Elmhurst" |
| Featured image | The best finished shot. Shown on cards |
| Content | A few paragraphs: what the problem was, what you found, what you did |
| Location | City and state only — **never a street address** |
| Completed | "June 2026" |
| Time on site | "4 days" |
| Scope of work | One line per item |
| Materials used | "Type N mortar, color-matched to original" |
| Before photo | See the note below |
| After photo | Same |
| Customer quote | Only if they agreed to it |
| **Related Services** | Tick the service this was. This is what makes it appear on that service page |
| **Related Areas** | Tick the town. Same idea |

Those last two boxes are the important ones. They are in the sidebar of the editor. Ticking "Tuckpointing" and "Elmhurst" makes the project show up on both the tuckpointing page and the Elmhurst page, automatically, with no further work.

### Before and after photos

The site has a drag-to-compare slider, and it only looks good if the two photos line up.

- **Shoot the before photo from a fixed position.** Mark where you stood. Stand there again for the after.
- Same time of day if you can. Matching light does most of the work.
- Landscape orientation, held level.
- Same distance and same zoom. Do not step closer for the after shot.
- One slider per project. Use the regular gallery block in the body for the rest.

If you only have one usable photo, skip the before/after fields entirely and just set a featured image. A single good photo beats a mismatched pair.

### Photos generally

- **Take more than you think you need**, on every job. It costs nothing and you cannot go back.
- Wide shot of the whole elevation, medium shot of the work area, close-up of the detail.
- Photograph the problem before you touch it. The before shot is the one people cannot re-stage.
- Phone photos are fine. Modern phones are more than good enough for the web.
- Before uploading, resize to about **1600px** on the long edge. Full-resolution phone photos are 4–8 MB each and will slow the site down and fill the hosting quota. LiteSpeed's image optimization helps, but starting smaller helps more.
- Name the files something descriptive before uploading: `chimney-rebuild-elmhurst-after.jpg`, not `IMG_4471.jpg`. Google reads filenames.
- Fill in the **alt text** field on every image. It describes the photo for screen readers and for search engines.

---

## Adding a knowledge hub article

**Posts → Add New**

The hub is for answering questions people search before they call anyone. Good articles are specific, useful, and do not read like sales copy.

**What works:**
- "What does tuckpointing cost in Elmhurst?"
- "Why is the brick on my chimney flaking?"
- "How long should a chimney rebuild take?"
- "Do I need a permit for masonry work in Chicago?"
- Anything your dad finds himself explaining on site for the fifth time

**The test:** would this be useful to someone who then decides they do not need you? If yes, publish it. That is what earns the call next time.

**Practical notes:**
- 800 to 1,500 words is the sweet spot
- Use `##` headings — they become the page structure and Google reads them
- Set an **excerpt**. It is used on cards and in search results. Do not leave it to auto-generate
- Tick **Related Services** so the article appears on that service page
- Tick **Related Areas** if the article is town-specific

---

## Adding a service

**Services → Add New**

Only add one when it is genuinely distinct work. Ten strong service pages beat twenty thin ones, and a page with three sentences on it will drag the rest of the site down rather than help.

Fill in every field. Each one drives a section of the page:

| Field | Becomes |
|---|---|
| Card tagline | The one-liner on service cards |
| Typical investment | A badge under the page title. Leave blank to hide |
| Typical timeline | Same |
| Signs you need this | The checklist panel near the top |
| What's included | The scope-of-work list |
| Our process | The numbered steps, formatted `Step name \| What happens` |
| FAQs | The accordion, formatted `Question? \| Answer`. **These also generate FAQ structured data for Google** |
| Icon | Pick from the list; falls back to a sensible guess |

The FAQ field is the highest-value one on the page. Two or more entries produce FAQ schema, which is how you end up with expandable answers directly in Google results. Use the questions people actually ask on the phone.

---

## Adding a service area

**Service Areas → Add New**

Before you do: **do not add a page for every town.** There are 105 towns in the coverage list and only 21 have pages. That is deliberate. A page per town with nothing unique on it is thin content, and Google is good at recognising the pattern. A site with eighty near-identical city pages can end up ranking worse than one with twenty good ones.

**Add a town page when:**
- You have done real work there and can point to projects
- There is something specific to say about the local housing stock
- It is a market worth pursuing deliberately

The towns already listed under **Full coverage area** on the service areas page still tell Google and visitors that you serve them. That is enough until there is something real to say.

When you do add one, fill in the **Local masonry notes** field properly. "1950s brick ranches with soft lime mortar and original steel lintels" is the kind of detail no competitor's template page will have, and it is what makes the page worth ranking.

---

## Editing the starter copy

The starting text is a solid first draft. It is deliberately written as a contractor who explains rather than sells, because that is what wins this kind of work. But it is not your dad's voice yet.

**Worth going through:**
- The **About** page. Add how he got into the trade, how long, who he works with
- Every service page's opening paragraphs
- The **prices** on each service — these are researched ranges, not his numbers. Correct them or clear them
- The **hero headline** in Appearance → Customize

**Worth leaving mostly alone:**
- The technical explanations, which are accurate
- The FAQ answers, unless his answer differs
- The service area local detail

**Things to check before publishing, because they were written without knowing the specifics:**
- The claim that he is "family run" and "based in Wood Dale"
- "Licensed and fully insured" — turn this off in **Settings → Business Info** if it is not accurate
- Years in business
- Any claim about what he does or does not do

Do not publish a claim you cannot back up. It is the one thing on a contractor site that can actually cost you.

---

## A realistic publishing rhythm

You do not need to do much, but you do need to do it consistently.

- **Every job:** take photos. Five minutes.
- **Every month:** add one project. Twenty minutes.
- **Every month or two:** add one article. An hour.
- **Every few months:** reread a service page and improve it.

Twelve projects and six articles a year, which is about two hours a month, will put this site ahead of nearly every masonry contractor in DuPage County. Most of them have a five-page site that has not changed since 2019.
