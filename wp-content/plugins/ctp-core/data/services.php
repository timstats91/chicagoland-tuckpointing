<?php
/**
 * Starter services.
 *
 * Body copy uses a tiny markup convention that the seeder converts into real
 * Gutenberg blocks: blank lines separate paragraphs, "## " starts a heading,
 * "- " starts a list item. Everything here is editable in WP afterwards.
 *
 * @package CTP_Core
 */

defined( 'ABSPATH' ) || exit;

return array(

	array(
		'slug'    => 'tuckpointing',
		'title'   => 'Tuckpointing & Repointing',
		'icon'    => 'trowel',
		'excerpt' => 'Grinding out failed mortar joints and repointing them with the right mix, so water stops working its way into your walls.',
		'meta'    => array(
			'tagline'  => 'Cut out failing mortar, repoint with a color-matched mix, stop the water.',
			'price'    => 'Most homes land between $2,400 and $9,000 depending on how many walls need work',
			'duration' => '2 to 5 working days for a typical house, weather permitting',
			'signs'    => "Mortar you can scratch out with a key or screwdriver\nVisible gaps, cracks or missing sections between bricks\nSandy mortar dust collecting on the ground along the wall\nDamp patches or efflorescence on interior walls\nBricks that feel loose or move when pushed\nJoints that look recessed compared to the brick face",
			'includes' => "Full walk-around inspection with photos of every problem area\nGrinding and cutting out deteriorated mortar to proper depth\nMortar mixed to match the original in strength and color\nJoints tooled to match the existing profile\nBrush-down and cleaning of the brick face\nSite protected with drop cloths, cleaned up daily\nWritten scope so you know exactly what was done",
			'process'  => "Inspection | We walk the whole exterior, photograph the failing joints and tell you honestly which walls need work now and which can wait.\nWritten estimate | You get a fixed, itemized price in writing. No pressure, no expiring discounts.\nPrep and grind | We protect landscaping and windows, then grind out the failed mortar to roughly twice the joint width in depth.\nRepoint and tool | Fresh mortar is packed in and tooled to match the original profile, then the brick face is cleaned down.",
			'faq'      => "How long does tuckpointing last? | Done properly, with mortar matched to the brick, repointed joints should last 25 to 30 years in the Chicago climate. Done with mortar that is too hard, it can start damaging the brick within a few winters.\nWhat is the difference between tuckpointing and repointing? | In everyday use around Chicago they mean the same thing: removing failed mortar and replacing it. Strictly, tuckpointing is a decorative technique using two mortar colors, but almost nobody uses the term that way anymore.\nCan tuckpointing be done in winter? | Mortar needs temperatures above about 40 degrees to cure properly. We generally work from April through November, and will tell you to wait rather than do work that will fail.\nWill the new mortar match? | We match color, texture and joint profile as closely as possible. Fresh mortar always looks slightly different until it weathers in, usually over one or two seasons.\nDo I need the whole house done? | Usually not. Southern and western walls take the worst weather and often fail first. We will tell you if only two walls need attention.",
		),
		'content' => <<<'TEXT'
Mortar is the sacrificial part of a brick wall. It is supposed to be softer than the brick, and it is supposed to fail first, because it is far cheaper to replace mortar than to replace brick. In the Chicago area, with freeze and thaw cycles running from November through March, mortar joints typically last somewhere between 25 and 40 years before they need attention.

When those joints go, water gets in. It soaks into the wall, freezes, expands, and starts pushing the brick apart from the inside. Left long enough, you stop having a tuckpointing job and start having a rebuild.

## What tuckpointing actually involves

The failed mortar is ground out to a depth of roughly twice the width of the joint. Anything shallower and the new mortar has nothing to key into, so it pops out within a few years. This is where most cut-rate tuckpointing goes wrong: a thin skim of mortar smeared over the surface looks fine on the day and fails by the third winter.

Once the joints are cut, they are cleaned, dampened, and packed with fresh mortar in layers. The joint is then tooled to match the profile of the original work, whether that is a concave, weathered or flush joint.

## Getting the mortar mix right

This is the part that separates work that lasts from work that causes damage. Older Chicago-area homes, particularly anything built before roughly 1930, were laid up with soft lime-based mortar. If you repoint that brick with a modern high-Portland mix, the mortar ends up harder than the brick around it. The wall still moves, but now the brick is the weakest element, so the brick faces spall off instead of the mortar giving way.

We match the mix to the age and condition of the wall, not to whatever is fastest to work with.

## What you get from us

An honest assessment, first. If three walls are fine and one needs work, we will say so. A written scope and a fixed price, so there are no conversations about extras halfway through. And a crew that protects your landscaping, sweeps up at the end of every day, and leaves the brick clean.
TEXT
	),

	array(
		'slug'    => 'masonry-repair',
		'title'   => 'Brick & Masonry Repair',
		'icon'    => 'brick',
		'excerpt' => 'Replacing spalled, cracked and failed brick, and rebuilding sections of wall that have moved past the point of repointing.',
		'meta'    => array(
			'tagline'  => 'Spalled brick swapped out, cracks tracked to the cause, walls rebuilt when they need it.',
			'price'    => 'Small brick replacement from $600; wall sections vary widely by size and access',
			'duration' => '1 day for spot repairs, up to 2 weeks for a full wall rebuild',
			'signs'    => "Brick faces flaking, crumbling or popping off\nStair-step cracks running through the mortar joints\nA wall that bows, leans or bulges outward\nGaps opening where two walls meet\nBrick that sounds hollow when tapped\nWhite chalky deposits repeatedly returning after cleaning",
			'includes' => "Diagnosis of why the brick failed, not just replacement of the symptom\nSourcing of replacement brick matched for size, color and texture\nCareful removal so surrounding brick is not damaged\nRebuilding of wall sections where repair is no longer enough\nStructural crack evaluation and referral when a structural engineer is warranted\nFull cleanup and disposal of debris",
			'process'  => "Diagnosis | Cracked brick is a symptom. We find out whether it is water, a failed lintel, settlement or frost, because replacing brick without fixing the cause just buys you two years.\nBrick matching | We source replacement brick to match size, color and texture. On older homes this sometimes means salvage brick.\nRemoval and rebuild | Failed units come out without disturbing what is sound, and the new brick goes in on a matched mortar bed.\nBlend and clean | New brick and mortar are tooled and cleaned so the repair reads as part of the wall, not a patch.",
			'faq'      => "Why is my brick flaking apart? | That is spalling, and it is almost always water. Moisture gets into the brick, freezes, expands and blows the face off. The usual culprits are failed mortar joints, a bad lintel, or a previous repointing job done with mortar that was too hard.\nCan you match my brick? | Usually yes, closely. Common Chicago brick is still available and salvage yards cover most older styles. Exact matches on unusual brick can be difficult, in which case we will often pull brick from a less visible wall and use the new brick there.\nIs a stair-step crack serious? | It can be. A hairline crack that has not moved in years is often just settlement. A crack that is widening, wider than about a quarter inch, or accompanied by a bulge in the wall needs a proper look, and sometimes a structural engineer.\nDo I need the wall rebuilt or just repaired? | If the wall is plumb and the damage is limited to individual units, repair is fine. If the wall is bowing or the brick has lost its bond with the wythe behind it, rebuilding is the honest answer.",
		),
		'content' => <<<'TEXT'
Brick is not supposed to crumble. When it does, something is putting water where it does not belong, and the brick is paying for it. The repair itself is straightforward masonry work. Finding out what caused it is the part that matters.

## Spalling

Spalled brick has lost its hard outer face, leaving the soft, porous interior exposed. Once that happens, that brick absorbs water far faster than it used to, and it deteriorates quickly. Spalling almost never happens in isolation. It clusters below failed mortar joints, under leaking lintels, around downspouts that discharge against the wall, and on walls that were sandblasted at some point in the past.

We replace the damaged units and fix the water path. Replacing the brick alone is a two-year fix.

## Cracks

The pattern tells the story. Stair-step cracking that follows the mortar joints usually points to settlement or to a lintel that has rusted and expanded. Vertical cracking through the brick faces themselves suggests something stronger is at work: expansion with nowhere to go, or genuine structural movement.

We will tell you which one you have. If it needs a structural engineer rather than a mason, we will say so rather than sell you masonry work that papers over the real problem.

## Rebuilds

Sometimes a wall is past repair. Bowing, separation between the outer brick and the structure behind it, or a section where the mortar has failed throughout means rebuilding is the right call. We take the section down in a controlled way, salvage what brick is reusable, and rebuild it properly with correct ties and flashing.

It is a bigger job, and we will only recommend it when patching would be throwing money away.
TEXT
	),

	array(
		'slug'    => 'chimney-rebuilds',
		'title'   => 'Chimney Repair & Rebuilds',
		'icon'    => 'chimney',
		'excerpt' => 'Rebuilding chimneys from the roofline up, replacing crumbling crowns, and stopping the leaks that are quietly rotting your roof deck.',
		'meta'    => array(
			'tagline'  => 'Crowns, flashing, and full rebuilds from the roofline up. The wettest, hardest-working masonry on the house.',
			'price'    => 'Crown repair from $900; above-roofline rebuilds typically $3,500 to $12,000',
			'duration' => '1 to 2 days for crown or flashing work, 3 to 6 days for a rebuild',
			'signs'    => "Cracked or missing concrete crown at the top\nWater stains on the ceiling near the chimney\nLoose or fallen brick in the yard after a storm\nA chimney that visibly leans\nRusted, lifting or tar-patched flashing at the roofline\nWhite staining down the chimney face\nDamp or musty smell in the fireplace",
			'includes' => "Inspection from the roof, with photos you can actually see\nNew poured concrete crown with proper overhang and drip edge\nRebuilding above the roofline using matched brick\nNew step and counter flashing, properly let into the mortar joints\nChimney cap installation to keep rain and animals out\nWater-repellent treatment where appropriate\nCoordination with your roofer when the roof is involved",
			'process'  => "Roof-level inspection | We get up there and photograph the crown, flashing, brick and cap so you can see exactly what we are talking about.\nHonest scope | Plenty of chimneys need a crown and flashing, not a rebuild. We will tell you which one yours is.\nTear-down and rebuild | Failed masonry comes down to sound material, then goes back up plumb with matched brick and correct mortar.\nCrown, cap and flashing | A poured crown with a real overhang, new counter flashing cut into the joints, and a cap on top.",
			'faq'      => "How do I know if I need a rebuild or just repair? | If the damage is confined to the crown, the flashing and the top few courses, a partial rebuild or repair is usually enough. If mortar has failed throughout or the stack is leaning, it needs rebuilding from the roofline.\nWhy do chimneys fail before the rest of the house? | They are exposed on all four sides, they get no shelter from the roof, and they take the full freeze-thaw cycle. Combustion also pushes moisture and acidic condensate through the structure from the inside.\nWhat is a chimney crown? | The sloped concrete slab on top of the chimney. It sheds water away from the brick and the flue. A proper crown overhangs the brick with a drip edge. A thin mortar wash smeared on top, which is what many chimneys have, cracks within a few years.\nMy chimney leaks but the brick looks fine. | Then it is almost certainly the flashing or the crown. Flashing that has been tarred over rather than replaced is the single most common source of chimney leaks we find.\nDo you sweep chimneys or line flues? | We are masons, so we handle the structure: brick, crown, flashing and caps. For flue liners and sweeping we will point you to a certified chimney sweep.",
		),
		'content' => <<<'TEXT'
Your chimney takes more weather than anything else on the house. It stands above the roofline with no shelter, exposed on four sides, and it gets hit from the inside too, because combustion pushes warm, damp, acidic air through the structure. That is why chimneys are usually the first masonry on a house to fail, often by decades.

## Start with the crown

The crown is the concrete slab across the top. Its whole job is to throw water clear of the brick below. A proper crown is poured concrete, several inches thick, sloped, and overhanging the brick with a drip edge so water drips free rather than running down the face.

What a lot of Chicago-area chimneys actually have is a thin mortar wash troweled flush with the brick. It cracks within a handful of winters, and then every rainstorm is feeding water directly into the top of the stack.

## Then the flashing

Where the chimney passes through the roof there should be two layers of metal: step flashing woven into the shingles, and counter flashing let into a cut in the mortar joints and sealed. Done right, it lasts as long as the roof.

Done wrong, which usually means a bead of roof tar over the gap, it lasts about two years and then quietly leaks into the roof deck. If you have a stain on a bedroom ceiling near the chimney, this is where to look first.

## Rebuilding above the roofline

When the mortar has failed throughout the exposed section, or the stack has started to lean, rebuilding from the roofline up is the right repair. We take it down to sound masonry, salvage the brick where it is reusable, and rebuild it plumb with a correct mortar mix, a poured crown, new flashing and a cap.

We will always tell you when a crown and flashing would do the job instead. A rebuild is a real expense, and most chimneys we look at do not need one yet.
TEXT
	),

	array(
		'slug'    => 'caulking',
		'title'   => 'Caulking & Sealant Replacement',
		'icon'    => 'caulk',
		'excerpt' => 'Replacing failed sealant around windows, doors, control joints and dissimilar materials, where most exterior water intrusion actually starts.',
		'meta'    => array(
			'tagline'  => 'The cheapest water-intrusion fix there is, and the one most often skipped.',
			'price'    => 'Typically $8 to $16 per linear foot depending on access and prep',
			'duration' => '1 to 2 days for a typical house',
			'signs'    => "Cracked, split or chalky caulk around windows and doors\nSealant pulling away from one side of the joint\nDrafts near window frames\nWater stains on interior sills\nGaps where brick meets siding, trim or stone\nCaulk that has gone hard and lost all flexibility",
			'includes' => "Complete removal of the old failed sealant, not caulking over the top\nJoint cleaning and priming where the substrate requires it\nBacker rod installed so the sealant can flex correctly\nHigh-grade polyurethane or silicone sealant appropriate to the joint\nTooled finish, not a smeared bead\nColor matched to the adjacent material",
			'process'  => "Survey | We identify every joint that has failed, including the ones that are easy to miss like control joints and material transitions.\nRemoval | The old sealant comes out completely. Caulking over failed caulk is the most common shortcut in the trade and it never holds.\nBacker rod | Correct-diameter rod goes in so the bead is the right shape and can stretch without tearing.\nSeal and tool | Quality sealant is gunned in and tooled to a clean concave finish that sheds water.",
			'faq'      => "How often does exterior caulking need replacing? | Good polyurethane sealant, installed correctly with backer rod, lasts 10 to 20 years. Cheap acrylic latex caulk applied straight into a deep joint often fails in 3 to 5.\nWhy does new caulk keep cracking? | Almost always because there is no backer rod. Sealant needs a specific width-to-depth ratio to flex. Without rod it bonds to three sides instead of two, and tears the first time the joint moves.\nCan you caulk over the old caulk? | You can, and it will fail. The new sealant is only as good as whatever it is stuck to, and it is stuck to something that has already let go.\nIs caulking part of a tuckpointing job? | Not automatically, and it should be. If we are already repointing a wall, adding the window perimeters and control joints is inexpensive and closes the other half of the water path.",
		),
		'content' => <<<'TEXT'
Caulking is not glamorous and it is not expensive, which is exactly why it gets deferred. It is also one of the most common places water gets into a house.

## Where sealant matters

Anywhere two different materials meet, they move at different rates. Brick and aluminum window frames expand and contract differently in a Chicago summer, which means the joint between them opens and closes all year. Sealant is the flexible part that keeps that joint closed while it moves.

The joints worth checking on almost any house: window and door perimeters, control joints in the brickwork, where brick meets siding or trim, around vents and hose bibs, and the transition between the foundation and the wall above.

## Why cheap caulking fails

Two reasons, nearly every time.

- The old sealant was not removed. New caulk applied over failed caulk is bonded to something that has already released, so it goes when that goes.
- There is no backer rod. Sealant needs to be roughly twice as wide as it is deep, and it needs to bond on two sides only. Gun it into a deep joint with no rod and it grabs three sides, cannot stretch, and tears.

## What we use

Polyurethane sealant for most masonry joints, because it stays flexible and takes paint. Silicone where the joint needs to shed water and will not be painted. Not acrylic latex, which is what comes in the cheap tubes and turns hard and chalky within a few seasons of Chicago weather.

Every joint gets the old material cut out, the substrate cleaned, backer rod sized to the gap, and a tooled concave finish that sheds water rather than holding it.
TEXT
	),

	array(
		'slug'    => 'patio-rebuilds',
		'title'   => 'Patio, Paver & Walkway Rebuilds',
		'icon'    => 'patio',
		'excerpt' => 'Lifting, regrading and relaying sunken patios, walkways and driveways so they drain away from the house and stop shifting every spring.',
		'meta'    => array(
			'tagline'  => 'Sunken, heaved and pitched-the-wrong-way hardscape, taken up and relaid on a proper base.',
			'price'    => 'Typically $18 to $34 per square foot for a full rebuild including base work',
			'duration' => '3 to 7 days for a typical patio',
			'signs'    => "Pavers that have sunk, lifted or tipped\nWater pooling on the patio or running toward the house\nWeeds and ants coming up through the joints\nWobbling or rocking underfoot\nEdges spreading outward and joints opening up\nA patio that sits lower than it used to against the foundation",
			'includes' => "Careful lift and salvage of existing pavers where they are reusable\nExcavation to proper depth and removal of the failed base\nCompacted aggregate base built in lifts, not dumped in one go\nGrading set to fall away from the house\nPolymeric sand swept into the joints\nEdge restraint installed so the field cannot spread\nSite graded and cleaned, debris hauled away",
			'process'  => "Assess the base | Sunken pavers are a base problem, not a paver problem. We dig a test area and find out what is under there.\nLift and excavate | Pavers come up and get stacked for reuse. The failed base is dug out to proper depth for our soil.\nRebuild the base | Aggregate goes in and gets compacted in layers, which is the step that gets skipped on nearly every patio we rebuild.\nRelay and lock | Pavers go back on screeded bedding sand, edge restraint is installed, and polymeric sand locks the joints.",
			'faq'      => "Why did my patio sink? | Almost always an inadequate base. If the aggregate was too thin, was not compacted in layers, or was laid over soft soil, the patio settles as the ground moves under it. Chicago clay and frost make this worse.\nCan you reuse my existing pavers? | Usually most of them. Concrete pavers hold up well; it is the base under them that fails. We typically reuse 80 to 90 percent and source replacements for the rest.\nHow deep should the base be? | For a patio in our soil, six to eight inches of compacted aggregate. For a driveway, ten to twelve. Anything less and you are rebuilding it again in five years.\nWhat about drainage? | This is the part that matters most. A patio should fall roughly an eighth of an inch per foot away from the house. We reset the grade as part of every rebuild, because a patio pitched toward the foundation is a wet basement waiting to happen.\nDo you do new patios as well as rebuilds? | Yes. New patios, walkways, steps and sitting walls, built on the same base detail.",
		),
		'content' => <<<'TEXT'
A paver patio fails from the bottom up. The pavers themselves are usually fine after twenty years. What gives out is the base underneath, and no amount of releveling the surface fixes that.

## What actually went wrong

When a patio sinks, tips or rocks, one of a few things happened when it was built:

- The aggregate base was too thin for our soil and frost depth.
- The base was dumped in one lift and compacted once, rather than built up in layers and compacted at each stage.
- There was no edge restraint, so the field spread outward and the joints opened.
- The grade was wrong from the start, so water sat on the patio and washed out the bedding sand.

## Drainage comes first

Before anything else, we work out where the water is going. A patio should shed water away from the house at about an eighth of an inch per foot. It is a slope you cannot really see but it makes the difference between dry basement walls and a foundation that gets soaked every storm.

More than a few of the patios we rebuild were actually pitched back toward the house. Fixing that is often worth more to the homeowner than the new surface.

## The rebuild

Pavers come up by hand and get stacked for reuse. The old base comes out. We excavate to depth, put in compacted aggregate in lifts, screed a bedding layer, and relay the pavers on the original pattern. Edge restraint goes in around the perimeter, and polymeric sand gets swept and set into the joints to lock the field together and keep weeds and ants out.

The result should sit flat, drain correctly, and stay that way through the freeze-thaw cycles rather than needing attention every spring.
TEXT
	),

	array(
		'slug'    => 'lintel-replacement',
		'title'   => 'Lintel Replacement',
		'icon'    => 'lintel',
		'excerpt' => 'Replacing the rusted steel lintels above windows and doors that push brick apart as they corrode and expand.',
		'meta'    => array(
			'tagline'  => 'Rusting steel above your windows expands with real force. Cracked brick above an opening usually starts here.',
			'price'    => 'Typically $900 to $2,800 per opening depending on span and access',
			'duration' => '1 to 2 days per opening',
			'signs'    => "Rust stains bleeding down the brick above a window\nA horizontal crack running along the top of a window or door\nBrick above an opening that has lifted or stepped out of line\nVisible flaking rust on the steel angle\nMortar joints above the window opening up\nWindows that have become hard to operate",
			'includes' => "Temporary shoring of the masonry above the opening\nRemoval of the corroded steel angle\nNew galvanized or primed steel lintel, correctly sized and bearing\nFlashing and weep holes installed above the lintel\nBrick reset and repointed to match\nRust staining cleaned from surrounding brick where possible",
			'process'  => "Confirm the cause | Rust stains and a horizontal crack above an opening are the tell. We check bearing and span before quoting.\nShore the opening | The brickwork above gets properly supported before anything is removed. This is not a step to improvise.\nSwap the steel | Corroded angle out, new galvanized steel in, sized for the span with proper bearing on each end.\nFlash and rebuild | Flashing and weeps go in above the lintel so water drains out instead of sitting on the steel, then the brick is reset and repointed.",
			'faq'      => "What is a lintel? | The steel angle that carries the brickwork above a window or door. On most Chicago-area homes it is a painted steel angle, and paint does not last forever.\nWhy does rust crack the brick? | Steel expands to several times its original thickness as it corrodes. That expansion happens inside a wall that has nowhere to go, so it lifts the brick above it and cracks the joints. It is called rust jacking.\nCan a rusted lintel just be painted? | If it is surface rust caught early, cleaning and coating it can buy years. Once it has delaminated or started lifting the brick, it needs replacing.\nIs this urgent? | It is not usually an emergency, but it gets worse steadily and never better, and the longer it runs the more brick has to be rebuilt along with it. It is one of the repairs we recommend not deferring.",
		),
		'content' => <<<'TEXT'
Above every window and door in a brick wall there is a steel angle carrying the weight of the masonry above the opening. On most homes around Chicago it is a painted steel lintel, sitting in a spot that gets wet and stays wet.

When the paint film breaks down, the steel starts to corrode. As it corrodes it expands, to as much as ten times its original thickness. That force has nowhere to go except up, into the brickwork sitting on it.

## How to spot it

The classic signs are a rust stain bleeding down the brick above a window, and a horizontal crack running along the joint just above the opening. Sometimes the brick course directly above the window has visibly lifted or stepped forward.

If you have rust staining but no cracking yet, you have caught it early, and the fix is smaller.

## The repair

The masonry above the opening gets shored so it is fully supported before anything comes out. The corroded angle is removed, and a correctly sized galvanized or primed steel lintel goes in with proper bearing at each end.

The detail that matters is what goes above the new steel: flashing, and weep holes. Water that gets into the wall needs somewhere to drain out. Without flashing and weeps, water sits on the lintel and the new steel starts the same process over again. A surprising number of original installations skipped this entirely, which is exactly why the original lintel failed.

Then the brick is reset, the joints are repointed to match, and we clean the rust staining off the surrounding brick as far as it will come.
TEXT
	),

	array(
		'slug'    => 'step-rebuilds',
		'title'   => 'Step & Stoop Rebuilds',
		'icon'    => 'steps',
		'excerpt' => 'Rebuilding crumbling front steps, stoops and porch landings that have settled, cracked or become genuinely unsafe.',
		'meta'    => array(
			'tagline'  => 'The first thing every visitor touches, and usually the most weather-beaten masonry on the property.',
			'price'    => 'Typically $2,200 to $8,500 depending on size, materials and foundation work',
			'duration' => '2 to 5 days',
			'signs'    => "Treads that are cracked, spalling or crumbling at the edges\nSteps that have settled away from the house\nA stoop that pitches back toward the door\nLoose or wobbling railings\nRisers of uneven height, which is both a trip hazard and a code issue\nHollow sounds underfoot or visible voids beneath the slab",
			'includes' => "Demolition and removal of the failed steps\nProper footing depth for our frost line\nRebuild in brick, block and concrete, or natural stone to match the house\nUniform riser heights and correct tread depth\nPositive pitch away from the entry\nRailing anchoring set into solid masonry\nCleanup and full debris removal",
			'process'  => "Assess the foundation | Settled steps usually mean a footing problem or washed-out fill underneath. We find out before quoting a rebuild.\nDemolition | The old steps come out and the debris is hauled away the same day where possible.\nFooting and structure | New footings go below frost depth, and the structure is built up in block and concrete.\nFinish to match | The visible surface is finished in brick, stone or concrete to match the house, with even risers and a pitch that sheds water.",
			'faq'      => "Can my steps be resurfaced instead of rebuilt? | Sometimes. If the structure underneath is sound and only the surface has spalled, a proper resurface can work. If the steps have settled or there are voids underneath, resurfacing just hides the problem.\nWhy did my steps settle? | Usually the fill underneath was never properly compacted, or the footing does not go below frost depth. In Chicago that means about 42 inches. Steps built on shallow footings heave every winter.\nCan you match the brick on my house? | Generally yes. We source matching or salvage brick, and on many homes the steps look better with a complementary stone cap rather than an exact match.\nDo you handle railings? | We set the masonry so railings can be anchored into solid material, and we can coordinate with a railing fabricator. Crumbling steps and loose railings usually go together.",
		),
		'content' => <<<'TEXT'
Front steps take a beating that no other part of the masonry has to deal with. They are horizontal, so they hold water rather than shedding it. They get salted all winter. They carry foot traffic. And they are frequently built on fill that was never properly compacted.

## Repair or rebuild

If the structure underneath is solid and the damage is limited to the surface, a resurface can be the right answer and it costs considerably less. What makes a rebuild the honest recommendation is any of the following: the steps have settled or separated from the house, the risers are uneven, there are voids underneath, or the concrete has deteriorated through its full depth rather than just at the face.

We will tell you which situation you have, and we would rather resurface a sound set of steps than sell you a rebuild you do not need.

## Getting the foundation right

The reason steps settle is almost always underneath them. Either the footing does not reach below the frost line, which is around 42 inches here, or the fill under the slab was never compacted and has continued to consolidate for years.

A rebuild that does not address that is a rebuild you do again in eight years. New footings go to depth, and fill gets compacted in lifts.

## Details that matter

Uniform riser heights, because uneven risers are the single most common cause of trip-and-fall on a residential entry, and they are a code issue. Adequate tread depth. A slight pitch away from the door so water and melting snow run off rather than pooling against the threshold. And solid masonry where the railing anchors go, so the railing stays tight.
TEXT
	),

	array(
		'slug'    => 'stone-restoration',
		'title'   => 'Stone & Limestone Restoration',
		'icon'    => 'stone',
		'excerpt' => 'Repointing, patching and restoring limestone sills, lintels, trim and stone facades on older Chicago-area homes and greystones.',
		'meta'    => array(
			'tagline'  => 'Greystone facades, limestone sills and stone trim, repaired with materials that will not harm the stone.',
			'price'    => 'Quoted per element; sill repairs from around $450, facade work varies widely',
			'duration' => '2 days to 2 weeks depending on scope',
			'signs'    => "Limestone sills that are cracked, spalling or sloping the wrong way\nDark soiling or crusting on a stone facade\nOpen or missing joints between stone units\nPrevious repairs in gray Portland patch that stand out badly\nStone that is delaminating in sheets\nWater staining beneath sills and projecting elements",
			'includes' => "Assessment of the stone type and the cause of deterioration\nRepointing with lime-based mortar appropriate to the stone\nDutchman repairs and stone patching with color-matched materials\nGentle, appropriate cleaning rather than abrasive blasting\nSill repair or replacement with correct pitch and drip detail\nConsolidation and sealing only where it genuinely helps",
			'process'  => "Identify the stone | Indiana limestone, greystone and cast stone all behave differently and want different treatment.\nDiagnose the deterioration | Soiling, sugaring, delamination and salt damage each have different causes and different fixes.\nRepair | Repointing in lime mortar, patching with color-matched composite, or dutchman repairs where a section needs replacing.\nClean appropriately | The gentlest method that works. We do not sandblast stone, and neither should anyone else.",
			'faq'      => "Why should stone never be sandblasted? | Blasting strips the dense outer skin off limestone and leaves a soft, porous surface that soaks up water and deteriorates far faster. A great deal of the damage on Chicago greystones traces back to aggressive cleaning in the 1970s and 80s.\nWhat mortar should be used on limestone? | A soft lime-based mortar. Portland-heavy mortar is harder than the stone and forces the stone to take movement it cannot handle, which causes spalling at the joint edges.\nCan a cracked limestone sill be repaired? | Often yes, with a color-matched patching compound or a dutchman, which is a piece of matching stone let into the damaged area. Full replacement is reserved for sills that have failed structurally.\nWhat is the dark crust on my stone? | Usually gypsum crust: decades of pollution and sulfur reacting with the calcium in the limestone. It traps moisture and eventually spalls off, taking stone with it. It needs removing, gently.",
		),
		'content' => <<<'TEXT'
Chicago has a great deal of limestone: greystone two-flats, limestone sills and lintels on brick bungalows, stone trim and water tables on prewar homes. It is beautiful material and it is surprisingly easy to damage with the wrong repair.

## Softer than it looks

Limestone is calcium carbonate. It is porous, it is relatively soft, and it reacts with acid. That means two things matter enormously.

First, the mortar has to be softer than the stone. A lime-based mortar lets the wall move and takes the wear itself. Portland-heavy modern mortar is harder than the limestone around it, so the stone becomes the weakest point and the joint edges start spalling.

Second, cleaning has to be gentle. Sandblasting removes the dense outer skin that limestone forms over time, leaving the soft interior exposed. A lot of the badly deteriorated greystone facades around the city were blasted in the 1970s and 80s and have been deteriorating faster ever since.

## Common repairs

- **Sills.** Limestone sills take standing water and salt. They crack, they spall at the front edge, and they lose their pitch so water runs back toward the window instead of away. Many can be patched or given a dutchman repair rather than replaced.
- **Dutchman repairs.** A section of matching stone cut and let into the damaged area, pinned and set. Done well it is nearly invisible and lasts as long as the original.
- **Patching.** Color-matched, lime-based composite patching for smaller losses, mixed to match the stone rather than a gray Portland smear.
- **Repointing.** Open joints raked out and repointed in an appropriate lime mortar, tooled to match.

## Cleaning

The right approach is the gentlest method that achieves the result: low-pressure water, appropriate detergents, poultices where staining is deep. Slower than blasting, and it is the difference between a facade that lasts another century and one that needs major work in fifteen years.
TEXT
	),

	array(
		'slug'    => 'masonry-cleaning',
		'title'   => 'Masonry Cleaning & Power Washing',
		'icon'    => 'wash',
		'excerpt' => 'Removing efflorescence, algae, soot, carbon staining and paint from brick and stone, without stripping the face off the masonry.',
		'meta'    => array(
			'tagline'  => 'Pressure and chemistry matched to the material. Brick is easy to clean and easy to ruin.',
			'price'    => 'Typically $0.60 to $2.40 per square foot depending on staining and method',
			'duration' => '1 to 3 days for a typical house',
			'signs'    => "White chalky deposits on the brick face\nGreen or black biological growth on shaded walls\nDark carbon or soot staining, especially near the city\nRust or mineral staining running down from steel or downspouts\nPaint peeling off brick that should never have been painted\nGeneral dinginess that makes sound brick look neglected",
			'includes' => "Test patch in an inconspicuous area before committing to a method\nAppropriate cleaner selected for the stain and the substrate\nControlled pressure, low enough to protect the brick face\nWindows, plants and adjacent materials protected and rinsed\nEfflorescence treatment addressing the moisture source, not just the deposit\nOptional breathable water repellent after cleaning",
			'process'  => "Test first | We clean a small, hidden patch and check the result before touching the visible elevations.\nProtect | Plantings, windows, fixtures and adjacent materials get covered and pre-wetted.\nClean | Correct chemistry, controlled pressure, worked top to bottom and rinsed thoroughly.\nAssess what is underneath | Clean brick shows its condition honestly, so we will flag any joints or units that need attention.",
			'faq'      => "Can power washing damage brick? | Yes, easily. High pressure strips the hard fired face off brick and blows mortar out of the joints. Most brick should be cleaned at well under 1,000 psi with the right chemistry doing the work rather than the pressure.\nWhat is the white powder on my brick? | Efflorescence: dissolved salts carried to the surface by water moving through the wall, left behind when the water evaporates. It is cosmetic in itself, but it tells you water is getting into the masonry, and that is worth investigating.\nCan you remove paint from brick? | Usually, with masonry-safe chemical strippers and a lot of patience. Never with blasting. Be aware that brick painted decades ago may have absorbed paint into the face, and some ghosting can remain.\nShould I seal my brick after cleaning? | Only with a breathable siloxane water repellent, and only where it is warranted. Film-forming sealers trap moisture inside the wall and cause far more damage than they prevent.",
		),
		'content' => <<<'TEXT'
Clean masonry is worth a surprising amount on a house, and cleaning is one of the easiest ways to do permanent damage to it.

## Pressure is not the tool

The phrase power washing does most of the harm here. Brick has a hard fired outer face, and that face is what keeps water out. High pressure strips it off, leaving the soft, porous interior exposed. It also blasts mortar out of the joints. The damage is not always obvious on the day, and it shows up over the following few winters as spalling.

Most brick should be cleaned well below 1,000 psi. The chemistry should be doing the work, not the pressure.

## What we are actually removing

- **Efflorescence.** White salt deposits brought to the surface by water moving through the wall. The deposit itself is cosmetic, but it is evidence of water in the masonry, so we look for the source.
- **Biological growth.** Green and black algae and moss on shaded north walls. Straightforward to remove with the right detergent.
- **Carbon and soot.** Decades of atmospheric grime, common closer to the city. Needs an appropriate cleaner and dwell time.
- **Rust and mineral staining.** Usually running from steel lintels, railings or downspouts. Needs a specific treatment, and it is worth fixing the source at the same time.
- **Paint.** Removable with masonry-safe chemical strippers. Slow work, and worth doing properly.

## Always a test patch

Different brick responds differently, and previous repairs can react in unexpected ways. We clean a small hidden area first, check the result, and adjust before touching the front of the house.

One useful side effect: clean brick shows its real condition. It is common to finish a cleaning and immediately be able to point out which joints need repointing, which were invisible under the grime.
TEXT
	),

	array(
		'slug'    => 'waterproofing',
		'title'   => 'Masonry Waterproofing',
		'icon'    => 'waterproof',
		'excerpt' => 'Breathable water repellents, flashing repairs and drainage corrections that keep water out of the wall without trapping moisture inside it.',
		'meta'    => array(
			'tagline'  => 'Keep water out of the wall without sealing moisture inside it. The distinction matters a great deal.',
			'price'    => 'Water repellent application typically $1.20 to $2.80 per square foot',
			'duration' => '1 to 2 days for application, longer where repairs come first',
			'signs'    => "Damp patches on interior walls after heavy rain\nEfflorescence returning again and again\nMusty smell in the basement or lower level\nBrick that stays visibly dark for days after rain\nPeeling interior paint on an exterior wall\nWater in the basement along a particular wall",
			'includes' => "Diagnosis of where water is actually entering, before anything is applied\nRepointing and sealant repairs as the first line of defense\nFlashing and weep hole inspection and correction\nBreathable siloxane water repellent, never a film-forming sealer\nDownspout and grading recommendations\nClear explanation of what a repellent will and will not fix",
			'process'  => "Find the entry point | Water repellent is the last step, not the first. We identify whether it is joints, a lintel, flashing, the crown, grading or a downspout.\nFix the path | Repointing, sealant, flashing and weeps come first. A repellent over failed joints is money wasted.\nApply the repellent | A breathable siloxane, applied at the correct rate to a dry wall, in appropriate weather.\nAddress the ground | We will flag grading and downspout issues, which are often the real cause of a wet basement wall.",
			'faq'      => "Does waterproofing brick actually work? | A breathable repellent reduces water absorption significantly and is worthwhile on exposed walls. But it will not bridge a failed mortar joint or a leaking lintel. Those have to be fixed first, and if they are, they do most of the work.\nWhat is the difference between a sealer and a repellent? | A film-forming sealer puts a skin over the surface and traps moisture inside the wall, where it freezes and spalls the brick. A breathable siloxane repellent soaks in and lets vapor escape. Only the second type belongs on brick.\nHow long does a water repellent last? | Typically 7 to 10 years on a vertical wall, less on horizontal surfaces that take standing water.\nMy basement is wet. Will this fix it? | Possibly not. Wet basements are more often a grading, downspout or drainage problem than a wall problem. We will tell you honestly what we think is going on rather than sell you a treatment that will not help.",
		),
		'content' => <<<'TEXT'
Brick walls are not waterproof and were never designed to be. They are designed to absorb some water, hold it briefly, and then release it as the wall dries. The whole system depends on the wall being able to breathe.

This is why the single worst thing you can do to a brick wall is coat it in a film-forming sealer. Water still gets in, through the joints, around windows, over the top. Now it cannot get out. It sits in the masonry, it freezes, and it takes the face off the brick.

## The order of operations

Water repellent is the last step in waterproofing a wall, not the first.

1. **Fix the joints.** Failed mortar is the largest opening in most walls, and no coating bridges a gap.
2. **Fix the sealant.** Window perimeters and control joints.
3. **Check flashing and weeps.** Water that gets into a cavity wall is supposed to drain out through weep holes. Blocked or missing weeps turn the cavity into a reservoir.
4. **Check the top.** Chimney crowns, parapet caps and sills are horizontal, and horizontal masonry is where water gets in.
5. **Then, if it is warranted, apply a repellent.**

## What we apply

A penetrating siloxane water repellent. It soaks into the masonry and lines the pores so liquid water beads and runs off, while water vapor still passes through freely. Applied to a dry wall at the correct rate and in the right weather, it typically holds up for seven to ten years.

## The part that is usually not masonry at all

If the complaint is a wet basement, the cause is frequently not the wall. It is a downspout discharging next to the foundation, ground sloping toward the house, or a patio pitched the wrong way.

We will tell you when that is what we are looking at. Regrading and extending a downspout costs very little compared to masonry work, and on a lot of houses it is the fix.
TEXT
	),
);
