<?php
/**
 * Structured data (JSON-LD).
 *
 * For a local contractor this is the highest-leverage SEO work on the whole
 * site: it is what feeds the business panel, the service listings and the FAQ
 * rich results. Emitted as one connected @graph rather than several loose
 * blocks, which is what Google prefers.
 *
 * @package CTP_Core
 */

defined( 'ABSPATH' ) || exit;

/**
 * The stable @id for the business node.
 *
 * @return string
 */
function ctp_business_id() {
	return home_url( '/#business' );
}

/**
 * The LocalBusiness node.
 *
 * @return array<string,mixed>
 */
function ctp_schema_business() {
	$node = array(
		'@type'       => array( 'GeneralContractor', 'HomeAndConstructionBusiness' ),
		'@id'         => ctp_business_id(),
		'name'        => ctp_business( 'name' ),
		'legalName'   => ctp_business( 'legal_name', ctp_business( 'name' ) ),
		'description' => ctp_business( 'tagline' ),
		'url'         => home_url( '/' ),
		'telephone'   => ctp_business( 'phone' ),
		'email'       => ctp_business( 'email' ),
		'priceRange'  => '$$',
	);

	$address = array_filter(
		array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => ctp_business( 'street' ),
			'addressLocality' => ctp_business( 'city' ),
			'addressRegion'   => ctp_business( 'state' ),
			'postalCode'      => ctp_business( 'zip' ),
			'addressCountry'  => 'US',
		)
	);

	if ( count( $address ) > 1 ) {
		$node['address'] = $address;
	}

	$lat = ctp_business( 'lat' );
	$lng = ctp_business( 'lng' );

	if ( $lat && $lng ) {
		$node['geo'] = array(
			'@type'     => 'GeoCoordinates',
			'latitude'  => (float) $lat,
			'longitude' => (float) $lng,
		);

		$radius = (float) ctp_business( 'radius_miles', '45' );

		if ( $radius > 0 ) {
			// Schema.org expects metres.
			$node['serviceArea'] = array(
				'@type'  => 'GeoCircle',
				'geoMidpoint' => array(
					'@type'     => 'GeoCoordinates',
					'latitude'  => (float) $lat,
					'longitude' => (float) $lng,
				),
				'geoRadius'   => (string) (int) round( $radius * 1609.34 ),
			);
		}
	}

	if ( ctp_business( 'founded' ) ) {
		$node['foundingDate'] = ctp_business( 'founded' );
	}

	$hours = ctp_schema_hours();

	if ( $hours ) {
		$node['openingHoursSpecification'] = $hours;
	}

	$profiles = array_values(
		array_filter(
			array(
				ctp_business( 'google' ),
				ctp_business( 'facebook' ),
				ctp_business( 'instagram' ),
				ctp_business( 'yelp' ),
			)
		)
	);

	if ( $profiles ) {
		$node['sameAs'] = $profiles;
	}

	$areas = ctp_get_areas( 60 );

	if ( $areas ) {
		$node['areaServed'] = array_map(
			static function ( $area ) {
				return array(
					'@type' => 'City',
					'name'  => get_the_title( $area ),
					'url'   => get_permalink( $area ),
				);
			},
			$areas
		);
	}

	$services = ctp_get_services( 30 );

	if ( $services ) {
		$node['hasOfferCatalog'] = array(
			'@type'           => 'OfferCatalog',
			'name'            => __( 'Masonry Services', 'ctp-core' ),
			'itemListElement' => array_map(
				static function ( $service ) {
					return array(
						'@type' => 'Offer',
						'itemOffered' => array(
							'@type' => 'Service',
							'name'  => get_the_title( $service ),
							'url'   => get_permalink( $service ),
						),
					);
				},
				$services
			),
		);
	}

	return array_filter( $node );
}

/**
 * Turn the free-text hours field into openingHoursSpecification entries.
 *
 * Understands lines such as "Monday - Friday: 7:00am - 5:00pm" and
 * "Saturday: 8:00am - 2:00pm". Lines it cannot parse are skipped rather than
 * guessed at, because wrong hours in schema are worse than no hours.
 *
 * @return array<int,array<string,mixed>>
 */
function ctp_schema_hours() {
	$days = array(
		'mon' => 'Monday',
		'tue' => 'Tuesday',
		'wed' => 'Wednesday',
		'thu' => 'Thursday',
		'fri' => 'Friday',
		'sat' => 'Saturday',
		'sun' => 'Sunday',
	);
	$order = array_keys( $days );
	$out   = array();

	foreach ( ctp_hours_lines() as $line ) {
		$parts = array_map( 'trim', explode( ':', $line, 2 ) );

		if ( 2 !== count( $parts ) ) {
			continue;
		}

		list( $day_part, $time_part ) = $parts;

		if ( false !== stripos( $time_part, 'closed' ) ) {
			continue;
		}

		// Which days does this line cover?
		$covered = array();
		$range   = array_map( 'trim', preg_split( '/\s*[-\x{2013}]\s*/u', $day_part ) );

		if ( 2 === count( $range ) ) {
			$start = array_search( strtolower( substr( $range[0], 0, 3 ) ), $order, true );
			$end   = array_search( strtolower( substr( $range[1], 0, 3 ) ), $order, true );

			if ( false !== $start && false !== $end && $end >= $start ) {
				for ( $i = $start; $i <= $end; $i++ ) {
					$covered[] = $days[ $order[ $i ] ];
				}
			}
		} else {
			$key = array_search( strtolower( substr( $day_part, 0, 3 ) ), $order, true );

			if ( false !== $key ) {
				$covered[] = $days[ $order[ $key ] ];
			}
		}

		if ( ! $covered ) {
			continue;
		}

		// Times: "7:00am - 5:00pm" or "7am-5pm".
		if ( ! preg_match_all( '/(\d{1,2})(?::(\d{2}))?\s*(am|pm)/i', $time_part, $matches, PREG_SET_ORDER ) ) {
			continue;
		}

		if ( count( $matches ) < 2 ) {
			continue;
		}

		$to_24 = static function ( $match ) {
			$hour   = (int) $match[1] % 12;
			$minute = isset( $match[2] ) && '' !== $match[2] ? $match[2] : '00';

			if ( 'pm' === strtolower( $match[3] ) ) {
				$hour += 12;
			}

			return sprintf( '%02d:%s', $hour, $minute );
		};

		$out[] = array(
			'@type'     => 'OpeningHoursSpecification',
			'dayOfWeek' => $covered,
			'opens'     => $to_24( $matches[0] ),
			'closes'    => $to_24( $matches[1] ),
		);
	}

	return $out;
}

/**
 * Breadcrumb trail as a schema node, mirroring the visible breadcrumbs.
 *
 * @return array<string,mixed>|null
 */
function ctp_schema_breadcrumbs() {
	$crumbs = function_exists( 'ctp_breadcrumb_trail' ) ? ctp_breadcrumb_trail() : array();

	if ( count( $crumbs ) < 2 ) {
		return null;
	}

	$items = array();
	$i     = 1;

	foreach ( $crumbs as $crumb ) {
		$item = array(
			'@type'    => 'ListItem',
			'position' => $i,
			'name'     => $crumb['label'],
		);

		if ( ! empty( $crumb['url'] ) ) {
			$item['item'] = $crumb['url'];
		}

		$items[] = $item;
		$i++;
	}

	return array(
		'@type'           => 'BreadcrumbList',
		'@id'             => ctp_current_url() . '#breadcrumbs',
		'itemListElement' => $items,
	);
}

/**
 * The current request URL, normalised.
 *
 * @return string
 */
function ctp_current_url() {
	if ( is_singular() ) {
		return (string) get_permalink();
	}

	if ( is_post_type_archive() ) {
		$link = get_post_type_archive_link( (string) get_query_var( 'post_type' ) );
		if ( $link ) {
			return $link;
		}
	}

	if ( is_home() ) {
		$page_id = (int) get_option( 'page_for_posts' );
		if ( $page_id ) {
			return (string) get_permalink( $page_id );
		}
	}

	return home_url( add_query_arg( array(), $GLOBALS['wp']->request ? $GLOBALS['wp']->request . '/' : '/' ) );
}

/**
 * Build and print the JSON-LD graph.
 */
function ctp_print_schema() {
	if ( is_404() || is_search() ) {
		return;
	}

	$graph = array( ctp_schema_business() );

	$graph[] = array(
		'@type'      => 'WebSite',
		'@id'        => home_url( '/#website' ),
		'url'        => home_url( '/' ),
		'name'       => ctp_business( 'name' ),
		'publisher'  => array( '@id' => ctp_business_id() ),
		'inLanguage' => get_bloginfo( 'language' ),
	);

	$breadcrumbs = ctp_schema_breadcrumbs();

	if ( $breadcrumbs ) {
		$graph[] = $breadcrumbs;
	}

	if ( is_singular( 'ctp_service' ) ) {
		$service = array(
			'@type'       => 'Service',
			'@id'         => get_permalink() . '#service',
			'name'        => get_the_title(),
			'description' => wp_strip_all_tags( get_the_excerpt() ),
			'url'         => get_permalink(),
			'serviceType' => get_the_title(),
			'provider'    => array( '@id' => ctp_business_id() ),
		);

		$areas = ctp_get_areas( 60 );

		if ( $areas ) {
			$service['areaServed'] = array_map(
				static function ( $area ) {
					return array(
						'@type' => 'City',
						'name'  => get_the_title( $area ),
					);
				},
				$areas
			);
		}

		$graph[] = $service;
	}

	if ( is_singular( 'ctp_area' ) ) {
		$graph[] = array(
			'@type'       => 'Place',
			'@id'         => get_permalink() . '#place',
			'name'        => get_the_title(),
			'url'         => get_permalink(),
			'address'     => array_filter(
				array(
					'@type'           => 'PostalAddress',
					'addressLocality' => get_the_title(),
					'addressRegion'   => ctp_business( 'state' ),
					'addressCountry'  => 'US',
				)
			),
		);
	}

	if ( is_singular( 'post' ) ) {
		$graph[] = array_filter(
			array(
				'@type'            => 'BlogPosting',
				'@id'              => get_permalink() . '#article',
				'headline'         => get_the_title(),
				'description'      => wp_strip_all_tags( get_the_excerpt() ),
				'url'              => get_permalink(),
				'datePublished'    => get_the_date( DATE_W3C ),
				'dateModified'     => get_the_modified_date( DATE_W3C ),
				'author'           => array( '@id' => ctp_business_id() ),
				'publisher'        => array( '@id' => ctp_business_id() ),
				'image'            => get_the_post_thumbnail_url( null, 'full' ),
				'mainEntityOfPage' => get_permalink(),
			)
		);
	}

	if ( is_singular( array( 'ctp_service', 'ctp_area' ) ) ) {
		$faqs = ctp_meta_faq( 'faq' );

		if ( count( $faqs ) >= 2 ) {
			$graph[] = array(
				'@type'      => 'FAQPage',
				'@id'        => get_permalink() . '#faq',
				'mainEntity' => array_map(
					static function ( $faq ) {
						return array(
							'@type'          => 'Question',
							'name'           => $faq['q'],
							'acceptedAnswer' => array(
								'@type' => 'Answer',
								'text'  => $faq['a'],
							),
						);
					},
					$faqs
				),
			);
		}
	}

	$json = wp_json_encode(
		array(
			'@context' => 'https://schema.org',
			'@graph'   => $graph,
		),
		JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
	);

	if ( ! $json ) {
		return;
	}

	echo '<script type="application/ld+json">' . $json . '</script>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- wp_json_encode output.
}
add_action( 'wp_head', 'ctp_print_schema', 20 );
