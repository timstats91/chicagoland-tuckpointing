<?php
/**
 * Starter pages.
 *
 * The home page body is short on purpose: the front page template composes the
 * hero, service grid, process, areas and CTA around it, so this is only the
 * introductory block in the middle.
 *
 * @package CTP_Core
 */

defined( 'ABSPATH' ) || exit;

return array(

	array(
		'slug'     => 'home',
		'title'    => 'Home',
		'template' => '',
		'content'  => <<<'TEXT'
## Masonry that is meant to last, not just to look finished

Most masonry problems are water problems. Mortar joints open up, a chimney crown cracks, a lintel rusts, a patio starts pitching back toward the house, and water finds its way into a wall that was never meant to hold it.

We fix the water path, not just the symptom. That means telling you when two walls need repointing rather than four, when a chimney needs a crown rather than a rebuild, and when the actual problem is a downspout rather than anything we would charge you for.

Family run, based in Wood Dale, and working across DuPage, Cook and the surrounding counties.
TEXT
	),

	array(
		'slug'     => 'about',
		'title'    => 'About Us',
		'template' => '',
		'content'  => <<<'TEXT'
## A small crew that does its own work

We are a family-run masonry business based in Wood Dale, and we work within about an hour of it. That radius is deliberate. It is close enough that we can get back out if something needs looking at, and close enough that our reputation travels between the towns we work in.

The work is done by the same people who quote it. There is no sales department, no subcontracting the job to whoever is available, and nobody knocking on doors offering a discount that expires this afternoon.

## What we actually do

Tuckpointing and repointing, brick and masonry repair, chimney repair and rebuilds, lintel replacement, caulking and sealant, step and stoop rebuilds, stone and limestone restoration, patio and paver rebuilds, masonry cleaning, and waterproofing.

What we do not do is sell work that does not need doing. A fair share of our estimates end with us telling someone their brick is fine and to call us in a few years.

## How we quote

We walk the whole exterior, photograph anything that is failing, and give you a written, itemized price. You get to see the photos. The price does not expire, and nobody follows up three times a week.

If the honest answer is that you need a structural engineer, or a roofer, or just a longer downspout, we will tell you that instead.

## The standards that matter

**Mortar matched to the brick.** On anything built before roughly 1930, that means a soft lime-based mix. Modern hard mortar on old brick causes spalling, and we will not do it regardless of what it costs us.

**Joints cut to proper depth.** Roughly twice the joint width. A surface skim looks the same on the day and fails by the third winter.

**Joint profiles matched.** So the repair does not read as a patch from the sidewalk.

**No abrasive cleaning on brick or stone.** Sandblasting strips the fired face off brick and the hard skin off limestone, and there is no undoing it.

**Your property protected.** Landscaping covered, drop cloths down, and the site swept at the end of every day.

## Licensed and insured

Fully insured for the work we do, and happy to send a certificate before we start. Ask any masonry contractor for that before they set foot on a ladder.
TEXT
	),

	array(
		'slug'     => 'contact',
		'title'    => 'Contact',
		'template' => 'template-contact.php',
		'content'  => <<<'TEXT'
Tell us what is going on and we will get back to you, usually the same day. If it is easier, call and you will get a person rather than a menu.

Photos help a great deal. If you can send a picture of the wall, chimney or steps you are worried about, we can often tell you roughly what you are dealing with before we come out.
TEXT
	),

	array(
		'slug'     => 'knowledge-hub',
		'title'    => 'Knowledge Hub',
		'template' => '',
		'content'  => <<<'TEXT'
Straight answers about masonry in the Chicago area: what fails, why it fails here in particular, what repairs actually cost, and how to tell good work from work that will not last.

No sales copy. If you read something here and decide you do not need us yet, that is a good outcome.
TEXT
	),

	array(
		'slug'     => 'thank-you',
		'title'    => 'Thank You',
		'template' => '',
		'noindex'  => true,
		'content'  => <<<'TEXT'
## Thanks, we have your message

We will get back to you shortly, usually the same day and almost always within one business day.

If it is urgent, or something has come loose and you are worried about it, call us directly rather than waiting on email.

In the meantime, the Knowledge Hub has straight answers on what most masonry problems actually are and what they cost to fix.
TEXT
	),
);
