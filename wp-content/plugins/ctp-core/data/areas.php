<?php
/**
 * Starter service areas.
 *
 * Deliberately 21 pages rather than one for every town within an hour. A page
 * per town with nothing unique on it is thin content, and Google is good at
 * spotting it. These are the towns worth a real page; everything else inside
 * the radius is listed on the service-areas archive from data/coverage.php.
 *
 * @package CTP_Core
 */

defined( 'ABSPATH' ) || exit;

return array(

	array(
		'slug'    => 'wood-dale',
		'title'   => 'Wood Dale',
		'excerpt' => 'Our home town. Tuckpointing, masonry repair and chimney work across Wood Dale, usually with same-week estimates.',
		'meta'    => array(
			'county'        => 'DuPage County',
			'drive_time'    => 'This is our home town',
			'zips'          => '60191',
			'neighborhoods' => "Downtown Wood Dale\nGeorgetown Square\nBriar Hill\nSalt Creek corridor\nOak Meadows area\nForest Preserve Drive neighborhoods",
			'housing'       => "1950s and 1960s brick ranches with original mortar now well past 60 years old\nSplit-levels from the 1960s and 70s with brick fronts and frame sides\nA handful of prewar homes near the original village center\nNewer construction south of Irving Park Road with brick veneer and control joints",
			'faq'           => "How quickly can you get to a Wood Dale job? | This is our home town, so usually within a few days for an estimate and often sooner for anything urgent.\nDo you work on the older homes near downtown? | Yes. The prewar homes near the village center generally need a softer lime-based mortar than the postwar ranches, and we mix accordingly.",
		),
		'content' => <<<'TEXT'
Wood Dale is where we are based, and a good share of our work happens within a few minutes of the shop.

The housing stock here is mostly postwar. Brick ranches and split-levels built through the 1950s, 60s and 70s make up most of what we look at, and that means most of it is now running on mortar that is somewhere between 55 and 75 years old. That is squarely in the range where joints start giving up, particularly on south and west elevations that take the weather.

The other thing we see constantly in Wood Dale is chimney work. A lot of these houses have original chimneys with thin mortar-wash crowns rather than proper poured crowns, and those crack within a decade. Once the crown is open, water runs straight down inside the stack.

Being local means we can usually get out for an estimate within a few days, and if something has come loose after a storm we can generally take a look quickly.
TEXT
	),

	array(
		'slug'    => 'itasca',
		'title'   => 'Itasca',
		'excerpt' => 'Masonry restoration in Itasca, from prewar homes near the village center to the 1970s subdivisions north of Irving Park.',
		'meta'    => array(
			'county'        => 'DuPage County',
			'drive_time'    => 'About 6 minutes from our Wood Dale shop',
			'zips'          => '60143',
			'neighborhoods' => "Downtown Itasca\nItasca Country Club area\nSpringbrook\nNordic Park neighborhoods\nWalnut Street corridor",
			'housing'       => "Prewar homes around the original village center, often on soft lime mortar\n1960s and 70s brick ranches and colonials\nNewer subdivisions with brick veneer and proper control joints\nOlder limestone sills and lintels on the pre-1940 stock",
			'faq'           => "Do you work on the older homes near downtown Itasca? | Regularly. Anything built before about 1930 usually wants a lime-based mortar rather than a modern Portland mix, and using the wrong one damages the brick.\nHow far is Itasca from you? | Roughly six minutes. It is one of the closest towns we serve.",
		),
		'content' => <<<'TEXT'
Itasca sits just west of us, and it is one of the towns we work in most often.

There are really two Itascas from a masonry standpoint. Around the original village center there is genuinely old housing stock, with limestone sills and lintels and soft lime mortar. That work needs to be approached carefully: repointing a prewar wall with hard modern mortar is one of the more expensive mistakes a homeowner can make, because the brick then becomes the weakest element and starts spalling instead of the joints.

North and east of there, the 1960s and 70s subdivisions are a different job entirely. Standard brick, standard mortar, and joints that are now reaching the end of a normal service life.

We handle both, and we will tell you which category your house falls into before we quote it.
TEXT
	),

	array(
		'slug'    => 'addison',
		'title'   => 'Addison',
		'excerpt' => 'Tuckpointing and brick repair across Addison, where thousands of 1960s and 70s brick homes are all hitting the same point at once.',
		'meta'    => array(
			'county'        => 'DuPage County',
			'drive_time'    => 'About 8 minutes from our Wood Dale shop',
			'zips'          => '60101',
			'neighborhoods' => "Army Trail corridor\nMichael Lane area\nLake Park\nGreen Meadows\nStone Park Boulevard neighborhoods\nCentennial Park area",
			'housing'       => "Heavy 1960s and 1970s tract building, much of it full brick or brick front\nBrick ranches and bi-levels on slab and crawl foundations\nSome 1950s stock closer to Lake Street\nCommercial and light industrial masonry along the Army Trail corridor",
			'faq'           => "Why do so many Addison houses need tuckpointing at the same time? | Because so many of them were built within the same fifteen-year window. Mortar from the 1960s and 70s is now 50 to 65 years old, which is exactly when it starts failing in this climate.\nDo you do commercial work in Addison? | Yes. There is a lot of light industrial masonry along Army Trail and we handle tuckpointing, lintels and caulking on those buildings.",
		),
		'content' => <<<'TEXT'
Addison was built fast. A very large share of the housing here went up between roughly 1958 and 1978, which from where we stand means an entire town's worth of mortar joints reaching the end of their service life within the same few years.

That is genuinely why you see so many tuckpointing trucks in Addison neighborhoods. Fifty to sixty-five year old mortar in a freeze-thaw climate is due, and the houses that have not been repointed yet are usually the ones where brick damage is starting.

The common pattern we find here: south and west elevations gone soft first, rust staining above the steel lintels over the front windows, and chimneys with cracked mortar-wash crowns. Often the lintels are the most urgent item, because rusting steel expands and actively pushes the brick apart above the opening.

We also do a fair amount of commercial tuckpointing and caulking along the Army Trail and Lake Street corridors.
TEXT
	),

	array(
		'slug'    => 'bensenville',
		'title'   => 'Bensenville',
		'excerpt' => 'Masonry repair in Bensenville, where proximity to O\'Hare and a mix of prewar and postwar homes keeps the work varied.',
		'meta'    => array(
			'county'        => 'DuPage County',
			'drive_time'    => 'About 7 minutes from our Wood Dale shop',
			'zips'          => '60106',
			'neighborhoods' => "Downtown Bensenville\nWhite Pines area\nRedmond Park neighborhoods\nGrand Avenue corridor\nCounty Line Road area",
			'housing'       => "Prewar homes and two-flats near the original downtown\nPostwar brick ranches through the 1950s and 60s\nBrick and frame mixed construction\nOlder commercial masonry along Irving Park and Grand",
			'faq'           => "Does being close to O'Hare affect masonry? | Not in any way that changes the repair. Ordinary weather and water are what cause mortar to fail here as everywhere else.\nDo you work on two-flats and small multifamily buildings? | Yes, regularly. Bensenville has a good number of them near downtown and they often need lintel work along with repointing.",
		),
		'content' => <<<'TEXT'
Bensenville gives us a real mix. Close to the original downtown there is genuinely old housing, including brick two-flats and prewar single-family homes with limestone details. Further out it is mostly postwar ranches.

The older buildings near downtown are where we see the most lintel work. Steel angles over windows on prewar and early postwar buildings were often painted steel with no flashing above them, which means water sits on the steel, the steel rusts, and rusting steel expands with enough force to lift the brick course above it. The tell is a rust stain running down from the corner of a window and a horizontal crack along the joint just above it.

On the postwar stock it is more straightforward: mortar that has reached its age, chimneys that need crowns, and caulking around aluminum-framed windows that went hard years ago.
TEXT
	),

	array(
		'slug'    => 'elmhurst',
		'title'   => 'Elmhurst',
		'excerpt' => 'Tuckpointing and masonry restoration in Elmhurst, on everything from prewar Georgians and Tudors to the newer builds replacing them.',
		'meta'    => array(
			'county'        => 'DuPage County',
			'drive_time'    => 'About 12 minutes from our Wood Dale shop',
			'zips'          => '60126',
			'neighborhoods' => "Downtown Elmhurst\nCrescent Park\nElmhurst College area\nVan Auken Park neighborhoods\nBerens Park area\nCherry Farm\nJackson Square",
			'housing'       => "Strong prewar stock: Georgians, Tudors, brick bungalows and foursquares\nLimestone sills, lintels and trim throughout the older neighborhoods\nMidcentury ranches and colonials in the outer subdivisions\nSubstantial new construction on teardown lots, with modern brick veneer",
			'faq'           => "Do you work on the historic homes near downtown Elmhurst? | Yes, and they need a different approach. Prewar brick and limestone want soft lime-based mortar, matched joint profiles and gentle cleaning. Hard modern mortar on those homes causes real damage.\nCan you match the mortar color on an older Elmhurst home? | We match color, texture and joint profile as closely as we can. Fresh mortar always reads slightly different until it weathers in over a season or two.",
		),
		'content' => <<<'TEXT'
Elmhurst has some of the best prewar housing stock in DuPage County, and that shapes the work we do here.

Georgians, Tudors, foursquares and brick bungalows built in the 1910s through the 1930s, many with limestone sills, lintels and water tables. These homes were laid up with soft lime-based mortar, and the single most important thing about repointing them is matching that softness. Modern Portland-heavy mortar is harder than the brick around it. The wall still moves with temperature and moisture, but now the brick is the weakest link, so brick faces spall off instead of joints giving way. We have been called in to fix that mistake more than once.

The limestone details need the same care: lime mortar at the joints, gentle cleaning rather than blasting, and dutchman or color-matched patch repairs on cracked sills instead of gray Portland smears.

Elmhurst also has a lot of newer construction on teardown lots, which is a completely different and much more standard job: modern brick veneer, control joints, and sealant that needs replacing at roughly the fifteen-year mark.
TEXT
	),

	array(
		'slug'    => 'villa-park',
		'title'   => 'Villa Park',
		'excerpt' => 'Tuckpointing, chimney and step work across Villa Park\'s 1920s bungalows and postwar brick ranches.',
		'meta'    => array(
			'county'        => 'DuPage County',
			'drive_time'    => 'About 13 minutes from our Wood Dale shop',
			'zips'          => '60181',
			'neighborhoods' => "Ardmore\nVilla Avenue corridor\nJefferson Park area\nLufkin Park neighborhoods\nNorth End",
			'housing'       => "1920s brick bungalows, many with original limestone sills\nPostwar ranches and Cape Cods from the 1940s and 50s\nMixed brick and frame construction\nOriginal front steps and stoops that are now well past their service life",
			'faq'           => "Do you rebuild front steps in Villa Park? | Frequently. A lot of the bungalows here still have their original steps, and after 90 winters of salt and freeze-thaw they are usually the most deteriorated masonry on the property.\nWhat mortar do you use on the older bungalows? | A softer lime-based mix, matched to the original. It matters a great deal on 1920s brick.",
		),
		'content' => <<<'TEXT'
Villa Park has a lot of the classic Chicago-area brick bungalow, mostly built in the 1920s, alongside postwar ranches and Cape Cods.

On the bungalows, three things come up over and over.

First, mortar age. Century-old lime mortar has done its job and is due. It needs repointing with a compatible soft mix, not a modern hard one.

Second, limestone sills. Original sills on these homes take standing water and road salt, and many have lost their pitch so water now runs back toward the window rather than away from it. Most can be patched or repaired with a dutchman rather than replaced entirely.

Third, front steps. Original bungalow steps have taken ninety winters of salt and freeze-thaw. They are frequently the most deteriorated masonry on the property and, with uneven risers and loose railings, the least safe.

On the postwar stock the work is more routine: repointing, chimney crowns, and caulking that has gone hard.
TEXT
	),

	array(
		'slug'    => 'lombard',
		'title'   => 'Lombard',
		'excerpt' => 'Masonry repair in Lombard, covering prewar homes near the village center and the large postwar subdivisions around them.',
		'meta'    => array(
			'county'        => 'DuPage County',
			'drive_time'    => 'About 15 minutes from our Wood Dale shop',
			'zips'          => '60148',
			'neighborhoods' => "Downtown Lombard\nLilacia Park area\nYorktown corridor\nWestmore neighborhoods\nTerrace View\nMadison Meadows",
			'housing'       => "Prewar frame and brick homes near the village center\nLarge postwar subdivisions of brick ranches and split-levels\n1970s and 80s townhomes with brick veneer\nCommercial masonry along Roosevelt Road and the Yorktown corridor",
			'faq'           => "Do you work on townhome and HOA buildings? | Yes. Lombard has a lot of 1970s and 80s townhome stock, and we handle association tuckpointing, lintel replacement and building-wide caulking.\nHow long does a typical Lombard tuckpointing job take? | Two to five working days for a single-family home, depending on how many elevations need work.",
		),
		'content' => <<<'TEXT'
Lombard covers a wide range of building ages, and the work varies with it.

The older homes near the village center are prewar, some brick and some frame with masonry foundations and chimneys. These need the soft-mortar approach and often need chimney work more than anything else.

The postwar subdivisions are where most of our volume is: brick ranches and split-levels from the 1950s through the 70s, all now sitting on mortar that is at or past the normal 40 to 60 year mark for this climate.

There is also a significant amount of 1970s and 80s townhome and condo stock in Lombard, and we do a fair amount of association work. Those buildings tend to need three things together: repointing on the weather elevations, lintel replacement where the steel has rusted, and a full recaulk of window perimeters and control joints. Doing them as one project is considerably cheaper than doing them as three, mostly because of scaffolding and lift costs.
TEXT
	),

	array(
		'slug'    => 'glen-ellyn',
		'title'   => 'Glen Ellyn',
		'excerpt' => 'Tuckpointing and stone restoration in Glen Ellyn, where the older housing stock needs a careful, traditional approach.',
		'meta'    => array(
			'county'        => 'DuPage County',
			'drive_time'    => 'About 18 minutes from our Wood Dale shop',
			'zips'          => '60137',
			'neighborhoods' => "Downtown Glen Ellyn\nLake Ellyn area\nGlen Oak\nArboretum area neighborhoods\nBiltmore\nStacy's Corners",
			'housing'       => "Substantial prewar stock, including Tudors and stone-trimmed homes\nOriginal limestone and fieldstone detailing\nMidcentury colonials and ranches in the outer neighborhoods\nMature trees and shaded walls, which brings biological growth on north elevations",
			'faq'           => "Do you do stone repair as well as brick? | Yes. Glen Ellyn has a lot of limestone and fieldstone detail, and it needs lime-based mortar and gentle cleaning rather than modern mortar and pressure.\nWhy is the north side of my house green? | Shaded, slow-drying walls grow algae. It is cosmetic and cleans off with the right detergent at low pressure. High pressure would do more harm than the algae.",
		),
		'content' => <<<'TEXT'
Glen Ellyn has beautiful older housing, a lot of stone detailing, and a mature tree canopy. All three affect the masonry.

The prewar homes here often combine brick with limestone or fieldstone trim, and that combination needs traditional materials. Lime-based mortar, matched joint profiles, and cleaning methods that do not strip the stone. Sandblasting limestone removes the dense outer skin it has formed over decades and leaves a soft, absorbent surface that deteriorates much faster afterward. We do not do it and we would advise against anyone who offers to.

The tree canopy is the other local factor. Shaded north and east elevations dry slowly, which means biological growth: the green and black staining that shows up on walls that never get full sun. It is cosmetic rather than damaging, and it comes off with appropriate detergent at low pressure.

The homes in the outer subdivisions are midcentury and the work there is more conventional repointing, chimney and caulking work.
TEXT
	),

	array(
		'slug'    => 'wheaton',
		'title'   => 'Wheaton',
		'excerpt' => 'Masonry restoration in Wheaton, from the older homes near the historic district to the postwar neighborhoods further out.',
		'meta'    => array(
			'county'        => 'DuPage County',
			'drive_time'    => 'About 22 minutes from our Wood Dale shop',
			'zips'          => '60187, 60189',
			'neighborhoods' => "Downtown Wheaton\nHistoric district\nCollege of DuPage area\nNorthside Park neighborhoods\nBriarcliffe\nDanada",
			'housing'       => "Significant prewar and historic housing stock near the center\nStone and brick homes with original detailing\nLarge postwar and 1970s subdivisions\nNewer subdivisions east and south with modern brick veneer",
			'faq'           => "Do you work on historic district properties? | Yes, with the appropriate care: matched lime mortar, matched joint profile, and no abrasive cleaning. If a property has review requirements we will work within them.\nCan you handle a whole-house repointing? | Yes, and on larger Wheaton homes it is often the right approach rather than doing it one elevation at a time over several years.",
		),
		'content' => <<<'TEXT'
Wheaton has a wide spread of building ages, and the older end of it is some of the more interesting masonry in the county.

Near the historic district there are homes with genuine architectural stonework, original limestone details and brickwork laid up with lime mortar a century or more ago. The approach on those is conservative: match the original mortar in softness and color, match the joint profile so the repair is not visible from the sidewalk, and clean only as gently as the result requires.

Further out, the postwar and 1970s subdivisions are standard repointing work, and the newer neighborhoods east and south mostly need sealant work rather than mortar work, since modern brick veneer construction relies on caulked control joints that go hard and split after fifteen years or so.

On larger homes we generally recommend doing the whole exterior at once rather than an elevation at a time. Scaffolding and setup are a real share of the cost, and splitting the work across three years means paying for that three times.
TEXT
	),

	array(
		'slug'    => 'roselle',
		'title'   => 'Roselle',
		'excerpt' => 'Tuckpointing, chimney and paver work in Roselle, mostly on 1970s and 80s subdivision homes now reaching the age where mortar fails.',
		'meta'    => array(
			'county'        => 'DuPage County',
			'drive_time'    => 'About 12 minutes from our Wood Dale shop',
			'zips'          => '60172',
			'neighborhoods' => "Downtown Roselle\nTrails of Roselle\nWaterbury\nSpring Hills\nBrittany Place\nRodenburg Road corridor",
			'housing'       => "Heavy 1970s and 1980s subdivision building\nBrick-front colonials, bi-levels and ranches\nTownhome and duplex clusters with shared masonry\nPaver patios and walkways from the 1990s now settling",
			'faq'           => "My house is only from the 1980s. Can it really need tuckpointing? | Yes. Forty-year-old mortar in this climate is in normal failure range, particularly on south and west walls and on chimneys.\nDo you rebuild paver patios in Roselle? | A lot of them. Patios installed in the 1990s and 2000s frequently went in on a thin base, and after twenty-five years of frost they have settled and often pitch back toward the house.",
		),
		'content' => <<<'TEXT'
Roselle is mostly a subdivision town, built heavily through the 1970s and 80s. That gives the masonry here a fairly consistent profile.

The homes are typically brick-front colonials, bi-levels and ranches, and they are now forty to fifty years old. People are sometimes surprised that a house from the 1980s needs tuckpointing, but forty-year-old mortar in a Chicago freeze-thaw climate is squarely in the normal range for failure, especially on the south and west elevations and on the chimney.

The other job we do a great deal of in Roselle is paver work. A lot of patios and walkways here went in during the 1990s and 2000s, frequently on a base that was too thin and not compacted in lifts. After twenty-plus years of frost, they have settled, the joints have opened, and a good number of them now pitch back toward the house, which is worth fixing for reasons well beyond appearance.

There are also several townhome and duplex clusters in Roselle where we handle association-level repointing and caulking.
TEXT
	),

	array(
		'slug'    => 'bloomingdale',
		'title'   => 'Bloomingdale',
		'excerpt' => 'Masonry repair and paver rebuilds in Bloomingdale, across its subdivision housing and older village-center homes.',
		'meta'    => array(
			'county'        => 'DuPage County',
			'drive_time'    => 'About 13 minutes from our Wood Dale shop',
			'zips'          => '60108',
			'neighborhoods' => "Old Town Bloomingdale\nIndian Lakes area\nStratford Woods\nWestlake\nCircle Drive neighborhoods\nSpringfield Drive area",
			'housing'       => "Older homes around the original village center\n1970s through 1990s subdivision building, mostly brick front\nLarger homes with full masonry and stone accents\nExtensive paver hardscape from the 1990s and 2000s",
			'faq'           => "Do you do larger custom home masonry in Bloomingdale? | Yes. There is a good amount of full-masonry and stone-accent construction here and we handle repointing, stone repair and hardscape on those properties.\nHow much does a patio rebuild cost? | Most full rebuilds including proper base work run in the range of $18 to $34 per square foot, which varies with access and how much excavation is needed.",
		),
		'content' => <<<'TEXT'
Bloomingdale splits between the older homes around the original village center and a large amount of subdivision building from the 1970s onward, including a number of larger custom homes with full masonry and stone accents.

On the subdivision stock, the pattern is familiar: brick-front construction that is now thirty to fifty years old, with repointing due on the weather elevations, chimney crowns cracked, and sealant at window perimeters gone hard.

On the larger custom homes there is more stone involved, which changes the approach. Cast stone and natural stone accents want a softer mortar than the brick around them, and the transitions between materials are where water tends to get in.

Bloomingdale also has a great deal of paver hardscape from the 1990s and 2000s, and we rebuild a lot of it. The failure is nearly always the base rather than the pavers themselves, which is why simply relifting and releveling the surface does not hold. We take it up, rebuild the base in compacted lifts, reset the grade so it drains away from the house, and relay the original pavers.
TEXT
	),

	array(
		'slug'    => 'naperville',
		'title'   => 'Naperville',
		'excerpt' => 'Tuckpointing and masonry restoration across Naperville, from the historic district to the large modern subdivisions south and west.',
		'meta'    => array(
			'county'        => 'DuPage County',
			'drive_time'    => 'About 30 minutes from our Wood Dale shop',
			'zips'          => '60540, 60563, 60564, 60565',
			'neighborhoods' => "Historic district and downtown\nNaper Grove\nCress Creek\nAshbury\nWhite Eagle\nTall Grass\nHobson West",
			'housing'       => "Genuinely historic homes in and around the downtown district\n1970s and 80s subdivision building north and east\nLarge 1990s and 2000s subdivisions south and west with brick veneer and stone accents\nExtensive paver hardscape on the newer stock",
			'faq'           => "Do you travel to Naperville? | Yes, regularly. It is about a half hour from the shop and well inside our service area.\nMy house is from 2002 and the caulking is splitting. Is that normal? | Completely normal. Exterior sealant on modern brick veneer typically needs replacing somewhere between twelve and twenty years, and it is one of the cheapest things you can do to keep water out of a wall.",
		),
		'content' => <<<'TEXT'
Naperville covers an enormous range of building ages, and the work we do there reflects that.

In and around the historic district there are genuinely old buildings with limestone and soft-mortar brickwork, where the traditional approach applies: lime mortar, matched profiles, gentle cleaning.

North and east, the 1970s and 80s subdivisions are now at the age where full repointing of the weather elevations is normal, and chimneys are usually overdue for crown and flashing work.

South and west, the large 1990s and 2000s subdivisions are a different job again. Modern brick veneer over sheathing, with control joints that rely on sealant. The mortar on these homes is usually still fine. What fails is the caulking: window and door perimeters, control joints, and the transitions between brick and siding or stone accents. Twelve to twenty years is a normal life for that sealant, and replacing it is inexpensive compared to what water in a wall costs.

There is also a lot of paver hardscape on the newer Naperville stock, and a good deal of it was built on a base that is not holding up.
TEXT
	),

	array(
		'slug'    => 'hinsdale',
		'title'   => 'Hinsdale',
		'excerpt' => 'Careful masonry and stone restoration in Hinsdale, on older high-value homes where the repair needs to be invisible.',
		'meta'    => array(
			'county'        => 'DuPage County',
			'drive_time'    => 'About 25 minutes from our Wood Dale shop',
			'zips'          => '60521',
			'neighborhoods' => "Downtown Hinsdale\nRobbins Park historic district\nWoodlands\nGolfview Hills area\nThe Highlands\nSouth Hinsdale",
			'housing'       => "Substantial prewar stock including Tudors, Georgians and stone homes\nExtensive limestone and cut stone detailing\nHistoric district properties with review considerations\nNew construction on teardown lots with modern veneer and stone",
			'faq'           => "Will the repointing be visible? | On a Hinsdale home that is usually the whole question. We match mortar color and texture as closely as possible and match the original joint profile exactly, which is what actually makes a repair read as invisible from the street.\nDo you work on historic district properties? | Yes, using traditional materials and methods, and we will work within any applicable review requirements.",
		),
		'content' => <<<'TEXT'
Hinsdale work is mostly restoration rather than repair, and the standard is different. On these homes the question is not only whether the repair will last but whether anyone will be able to see it.

Three things determine that.

**Mortar color and texture.** Matched as closely as we can to the original, tested on a sample area before we commit to the elevation. Fresh mortar always reads slightly lighter until it weathers in over a season or two, and we will tell you that up front rather than have it be a surprise.

**Joint profile.** This matters more than most people expect. A concave joint where the original was weathered or grapevine catches light differently and the repair reads as a patch from thirty feet away, even with a perfect color match.

**Material compatibility.** Prewar brick and limestone need soft lime-based mortar. Modern hard mortar on these homes is not just visually wrong, it actively causes spalling over the following decade.

There is also a lot of cut stone and limestone detailing on Hinsdale homes. Cracked sills and damaged stone elements can usually be repaired with a dutchman, a piece of matching stone cut and let into the damaged area, rather than replaced wholesale.
TEXT
	),

	array(
		'slug'    => 'elk-grove-village',
		'title'   => 'Elk Grove Village',
		'excerpt' => 'Tuckpointing and masonry repair in Elk Grove Village, on its 1960s planned-community housing and its large industrial park.',
		'meta'    => array(
			'county'        => 'Cook County',
			'drive_time'    => 'About 10 minutes from our Wood Dale shop',
			'zips'          => '60007',
			'neighborhoods' => "Original village sections\nWinston Grove\nElk Grove Industrial Park\nBiesterfield corridor\nRidge Avenue neighborhoods",
			'housing'       => "1960s planned-community ranches and split-levels, built in consistent phases\nBrick and brick-front construction throughout\nOne of the largest industrial parks in the country, with extensive commercial masonry\n1970s and 80s townhome clusters",
			'faq'           => "Do you do commercial tuckpointing in the industrial park? | Yes. We handle tuckpointing, lintel replacement, control joint caulking and masonry repair on commercial and industrial buildings.\nWhy do whole streets here need tuckpointing at once? | Elk Grove Village was built in planned phases, so an entire section often went up within two or three years and reaches the same point together.",
		),
		'content' => <<<'TEXT'
Elk Grove Village was built as a planned community, largely through the 1960s, and it shows in the masonry. Whole sections went up within two or three years of each other, so when the mortar reaches the end of its life it does so across an entire street at roughly the same time.

The residential work is consistent: brick ranches and split-levels, sixty-odd years old, with repointing due on the weather elevations, chimney crowns that were thin mortar washes and have long since cracked, and original steel lintels above the front windows that have started to rust and lift the brick.

The other half of Elk Grove Village is one of the largest industrial parks in the country, and we do a good deal of commercial work there. Commercial masonry has its own priorities: control joint sealant, lintel replacement, and repointing on elevations that get wind-driven rain. On a large building the cost is driven as much by lift and access as by the masonry itself, which is why it is worth bundling the repointing, lintels and caulking into one mobilization rather than three.
TEXT
	),

	array(
		'slug'    => 'schaumburg',
		'title'   => 'Schaumburg',
		'excerpt' => 'Masonry repair across Schaumburg\'s 1970s and 80s housing, townhome associations and commercial corridors.',
		'meta'    => array(
			'county'        => 'Cook County',
			'drive_time'    => 'About 15 minutes from our Wood Dale shop',
			'zips'          => '60193, 60194, 60195',
			'neighborhoods' => "Weathersfield\nLakewood\nTown Square area\nHoffman Estates border neighborhoods\nWoodfield corridor\nDunbar",
			'housing'       => "Extensive 1970s and 1980s subdivision building\nBrick-front colonials, ranches and split-levels\nLarge amount of townhome and condominium stock\nCommercial masonry through the Woodfield and Golf Road corridors",
			'faq'           => "Do you work with homeowner associations? | Yes. Schaumburg has a lot of townhome and condo associations and we are comfortable working through boards and management companies, with phased scopes and written proposals.\nHow do I know if my association needs tuckpointing or just caulking? | Often both, and the ratio matters for budgeting. We will walk the property and give you a building-by-building breakdown rather than a single number.",
		),
		'content' => <<<'TEXT'
Schaumburg is dominated by 1970s and 1980s construction, both single-family and a very large amount of townhome and condominium stock.

On the single-family homes, brick-front construction from that era is now at the point where the weather elevations need repointing, and where chimneys need crown and flashing work. This is routine work and it is generally straightforward.

The association work is where it gets more involved. A townhome or condo building typically needs several things at once: repointing on the exposed elevations, lintel replacement where steel has rusted over windows, and a full replacement of control joint and window perimeter sealant. Because lift and scaffolding costs are a real share of the total, doing these as one project rather than three separate years of work saves the association a meaningful amount.

We are used to working through boards and property managers, and we will put a building-by-building breakdown in writing so a board can phase it sensibly rather than being handed one large number.
TEXT
	),

	array(
		'slug'    => 'des-plaines',
		'title'   => 'Des Plaines',
		'excerpt' => 'Tuckpointing, chimney and step work in Des Plaines, across its prewar core and its large postwar brick neighborhoods.',
		'meta'    => array(
			'county'        => 'Cook County',
			'drive_time'    => 'About 12 minutes from our Wood Dale shop',
			'zips'          => '60016, 60018',
			'neighborhoods' => "Downtown Des Plaines\nCumberland\nRiverview\nBig Bend\nForest Elementary neighborhoods\nOakton corridor",
			'housing'       => "Prewar homes and brick bungalows near the original downtown\nHeavy 1950s and 60s brick ranch construction\nOlder two-flats and small multifamily buildings\nFlood-prone areas near the Des Plaines River, where moisture problems are more common",
			'faq'           => "Does flooding near the river affect masonry? | It can. Repeated saturation at the base of a wall drives efflorescence and accelerates mortar failure near grade, and it is worth addressing drainage alongside the masonry.\nDo you rebuild front steps? | Regularly in Des Plaines. A lot of the postwar stock still has original steps that are now spalled and uneven.",
		),
		'content' => <<<'TEXT'
Des Plaines has a prewar core near the original downtown and a large amount of 1950s and 60s brick ranch housing around it.

The postwar brick homes are our bread and butter here: sixty-plus year old mortar, chimneys with failed crowns, and original front steps that have taken decades of salt and are now crumbling at the tread edges and uneven underfoot.

Near the river, there is an additional factor. Areas that see repeated flooding or high groundwater get chronic moisture at the base of the wall, and that shows up as persistent efflorescence, mortar that has gone soft near grade, and spalling in the lower courses. Repointing that section without dealing with the water means doing it again. We will look at grading, downspout discharge and any hardscape pitched toward the house, because in a lot of cases those are the actual fix and they cost far less than masonry work.

Closer to downtown there are older two-flats and small multifamily buildings, where lintel work and repointing usually go together.
TEXT
	),

	array(
		'slug'    => 'arlington-heights',
		'title'   => 'Arlington Heights',
		'excerpt' => 'Masonry restoration in Arlington Heights, from prewar homes near downtown to the extensive postwar brick neighborhoods.',
		'meta'    => array(
			'county'        => 'Cook County',
			'drive_time'    => 'About 18 minutes from our Wood Dale shop',
			'zips'          => '60004, 60005',
			'neighborhoods' => "Downtown Arlington Heights\nScarsdale\nStonegate\nGreenbrier\nPioneer Park area\nIvy Hill\nTerramere",
			'housing'       => "Prewar homes and bungalows near the original downtown\nVery large postwar subdivision build-out through the 1950s to 70s\nBrick and brick-front colonials and ranches\nNewer infill and teardown construction near the center",
			'faq'           => "How far in advance should I book? | Spring and fall are our busiest periods. For non-urgent work it is worth getting on the schedule a few weeks out, particularly if you want it done before winter.\nCan tuckpointing be done in the fall? | Yes, as long as temperatures stay above roughly 40 degrees for curing. We generally work into November depending on the weather.",
		),
		'content' => <<<'TEXT'
Arlington Heights has a substantial prewar center and a very large postwar build-out around it, so we see both ends of the work here.

Near downtown, the older homes and bungalows want traditional treatment: soft lime-based mortar matched to the original, matched joint profiles, and careful handling of any limestone sills and trim.

The postwar subdivisions, which is most of the town by volume, are conventional repointing territory. Brick and brick-front colonials and ranches from the 1950s through the 70s, with mortar that is now well into the normal failure window.

One thing worth mentioning about scheduling. Spring and fall are the busiest stretches of our year, because those are the windows where temperatures are reliably above the roughly 40 degrees that mortar needs to cure properly. If you want work done before winter, it is worth getting on the calendar in late summer rather than in October. We would rather tell you to wait until spring than do work in marginal conditions that will not hold.
TEXT
	),

	array(
		'slug'    => 'mount-prospect',
		'title'   => 'Mount Prospect',
		'excerpt' => 'Tuckpointing and chimney work in Mount Prospect, mostly on its consistent 1950s and 60s brick housing stock.',
		'meta'    => array(
			'county'        => 'Cook County',
			'drive_time'    => 'About 14 minutes from our Wood Dale shop',
			'zips'          => '60056',
			'neighborhoods' => "Downtown Mount Prospect\nOld Orchard\nCountry Club\nProspect Meadows\nBoxwood\nBusse corridor",
			'housing'       => "Consistent 1950s and 1960s brick ranch and split-level construction\nSome prewar stock near the train station\nTownhome and apartment clusters along the major corridors\nOriginal steel lintels on most of the postwar housing",
			'faq'           => "There is a rust stain above my window. Is that serious? | It means the steel lintel is corroding, and corroding steel expands enough to crack and lift the brick above the opening. Caught early it is a manageable repair. Left alone it gets more expensive every year.\nDo you offer free estimates? | Yes, and a written itemized price with no obligation.",
		),
		'content' => <<<'TEXT'
Mount Prospect has some of the most consistent postwar brick housing in the northwest suburbs. Ranches and split-levels built largely in the 1950s and 60s, with full brick or brick-front elevations.

Because the stock is so consistent, so are the problems. Three things come up on nearly every Mount Prospect house we look at.

**Mortar at age.** Sixty to seventy years is past due in this climate, particularly on south and west elevations.

**Rusted lintels.** The steel angles above the front windows on these houses were painted steel, usually with no flashing above them. Paint fails, water sits on the steel, and the steel corrodes and expands to several times its original thickness. That force lifts the brick course above the window. The giveaway is a rust stain running down from a window corner and a horizontal crack in the joint above the opening. Caught early, it is a contained repair. Left for another decade, there is a lot more brick to rebuild along with it.

**Chimney crowns.** Almost all of these chimneys were finished with a thin mortar wash rather than a proper poured crown with an overhang and drip edge, and those crack within a decade or so.
TEXT
	),

	array(
		'slug'    => 'park-ridge',
		'title'   => 'Park Ridge',
		'excerpt' => 'Masonry restoration in Park Ridge, on prewar Georgians, Tudors and brick bungalows where the work needs to look original.',
		'meta'    => array(
			'county'        => 'Cook County',
			'drive_time'    => 'About 15 minutes from our Wood Dale shop',
			'zips'          => '60068',
			'neighborhoods' => "Uptown Park Ridge\nCountry Club\nSouth Park\nEdison Park border neighborhoods\nHodges Park historic area\nCumberland",
			'housing'       => "Strong prewar stock: Georgians, Tudors, brick bungalows and colonials\nExtensive limestone sills, lintels and trim\nSome midcentury infill\nSubstantial teardown and new construction in recent decades",
			'faq'           => "Do you work on historic Park Ridge homes? | Yes, with traditional lime-based mortar, matched joint profiles and gentle cleaning. Hard modern mortar on prewar brick causes spalling and we will not use it on those homes.\nCan a cracked limestone sill be repaired rather than replaced? | Usually. A dutchman repair or a color-matched lime-based patch is often the right answer, and it is considerably less disruptive than full replacement.",
		),
		'content' => <<<'TEXT'
Park Ridge has some of the best prewar housing stock we work on, and the masonry work here is closer to restoration than repair.

Georgians, Tudors, brick bungalows and colonials from the 1910s through the 1930s, most of them with limestone sills, lintels, water tables and entry surrounds. The brick was laid up with soft lime-based mortar, and the single most consequential decision on any repointing job here is matching that.

We have been called in more than once to deal with the aftermath of a house repointed in hard Portland-heavy mortar. The mortar itself holds up fine. What happens is that the wall continues to expand and contract, and because the new mortar is now harder than the century-old brick, the brick becomes the weakest element and the faces start spalling off. It is a much more expensive problem than the repointing was.

On the limestone, the same principle applies to both mortar and cleaning. Lime-based mortar at the joints. Gentle cleaning methods rather than abrasive blasting, which strips the hard outer skin off limestone and leaves it soaking up water for the rest of its life.

Cracked sills can usually be repaired rather than replaced, either with a color-matched patch or a dutchman.
TEXT
	),

	array(
		'slug'    => 'oak-park',
		'title'   => 'Oak Park',
		'excerpt' => 'Historic masonry restoration in Oak Park, on Prairie School homes, Victorians, greystones and brick two-flats.',
		'meta'    => array(
			'county'        => 'Cook County',
			'drive_time'    => 'About 25 minutes from our Wood Dale shop',
			'zips'          => '60301, 60302, 60304',
			'neighborhoods' => "Frank Lloyd Wright historic district\nRidgeland Oak Park historic district\nHarrison Street arts district\nThe Avenue\nSouth Oak Park\nHemingway district",
			'housing'       => "Exceptional prewar stock including Prairie School and Victorian homes\nBrick two-flats and greystones\nExtensive limestone detailing and original lime mortar\nHistoric district properties with review requirements",
			'faq'           => "Do you work on landmarked or historic district properties? | Yes. Oak Park has real review requirements in the historic districts and we work within them, using traditional materials and matched joint profiles.\nWhat mortar do you use on a hundred-year-old Oak Park home? | A soft, lime-rich mix matched to the original. Modern Portland mortar on this brick causes spalling, and on a home of this quality that is an expensive mistake.",
		),
		'content' => <<<'TEXT'
Oak Park has some of the most significant residential architecture in the country, and the masonry work here deserves to be treated accordingly.

Prairie School homes, Victorians, greystones and brick two-flats, most of them a century or more old and nearly all of them laid up with soft lime mortar over limestone foundations and details. There are also real historic district review requirements on many properties, and we work within them.

The technical considerations are the ones that apply to any building of this age, but the stakes are higher.

**Mortar must be softer than the brick.** Century-old brick is more porous and less hard-fired than modern brick. Repoint it with a Portland-heavy modern mortar and the brick, not the joint, becomes the sacrificial element. You get spalling faces within a decade.

**Joint profiles must match.** On a home where the brickwork is part of the architecture, a wrong joint profile is visible from the sidewalk regardless of how good the color match is.

**No abrasive cleaning.** A considerable amount of the deteriorated greystone and brick around Oak Park and the near west side traces directly back to sandblasting done in the 1970s and 80s. It strips the fired face off brick and the hard skin off limestone, and there is no undoing it.

We would rather turn down a job than do it in a way that damages a building like this.
TEXT
	),

	array(
		'slug'    => 'chicago',
		'title'   => 'Chicago',
		'excerpt' => 'Tuckpointing and masonry repair on Chicago bungalows, two-flats and greystones, with a focus on the Northwest and North Sides.',
		'meta'    => array(
			'county'        => 'Cook County',
			'drive_time'    => 'About 25 to 40 minutes depending on the neighborhood',
			'zips'          => '60630, 60631, 60634, 60641, 60646, 60656, 60618, 60639',
			'neighborhoods' => "Jefferson Park\nPortage Park\nNorwood Park\nEdison Park\nDunning\nBelmont Cragin\nIrving Park\nSauganash\nAvondale\nOld Irving Park",
			'housing'       => "The Chicago bungalow belt: brick bungalows from the 1910s through the 1930s\nBrick two-flats and three-flats\nGreystones with limestone facades\nOriginal limestone sills, lintels and front steps throughout\nShared party walls and tight lot lines affecting access",
			'faq'           => "Do you work in the city? | Yes, primarily the Northwest and North Sides. Downtown high-rise work is outside what we do.\nHow do you handle access on a narrow city lot? | Most bungalow and two-flat work is done from ladders and light scaffold. We will look at access before quoting, because on tight lots it genuinely affects the price.\nAre permits needed for tuckpointing in Chicago? | Straightforward repointing generally does not require a permit, but larger structural masonry work can. We will tell you when a permit applies rather than leaving you to find out.",
		),
		'content' => <<<'TEXT'
The Chicago bungalow belt runs right through the Northwest Side, and it is where a lot of our city work happens: Jefferson Park, Portage Park, Norwood Park, Dunning, Belmont Cragin, Irving Park and the surrounding neighborhoods.

Chicago bungalows are a specific and fairly consistent building type. Brick, usually 1910s through 1930s, with limestone sills and lintels, a limestone or brick front stoop, and original soft lime mortar. Nearly all of them are now at or past a century old.

What we most often find on them:

- **Mortar at the end of its life**, particularly on the south and west walls and along the parapet at the top of the front facade.
- **Limestone sills that have lost their pitch**, so water runs back toward the window rather than away from it.
- **Original front steps** that are spalled, uneven and, after a hundred winters of salt, genuinely hazardous.
- **Parapet walls** exposed on both faces, which makes them the fastest-failing masonry on the building.
- **Rusted lintels** above windows, lifting the brick above the opening.

Two-flats and greystones have all of the same issues plus more limestone to look after.

One practical note about city work: access matters. Narrow lots and close neighbors affect how we can stage the work, so we look at that before quoting rather than after.
TEXT
	),
);
