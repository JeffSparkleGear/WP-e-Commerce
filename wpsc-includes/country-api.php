<?php

/**
 * Get a country name using it's unique indentfier
 *
 * @param int|string unique country identifier, the ISO code is preferred, but
 *                   the WP eCommerce specific integer country id can also be used
 *
 * @since 3.8
 *
 * @return string the country name, empty string on failure
 */
function wpsc_get_country( $country_identifier ) {
	$wpsc_country = wpsc_get_country_object( $country_identifier );
	if ( $wpsc_country ) {
		$country_name = $wpsc_country->get_name();
	} else {
		$country_name = '';
	}

	return $country_name;
}

/**
 * Get a region name using it's WP eCommerce integer region id
 *
 * @param int the WP eCommerce specific integer region id
 *
 * @since 3.8
 *
 * @return WPSC_Country|boolean the country, or false on failure
 */
function wpsc_get_region( $region_identifier ) {
	$wpsc_region = wpsc_get_region_object( $region_identifier );
	if ( $wpsc_region ) {
		$region_name = $wpsc_region->get_name();
	} else {
		$region_name = '';
	}

	return $region_name;
}

/**
 * Get a country object using it's unique indentfier
 *
 * @param int|string unique country identifier, the ISO code is preferred, but
 *                   the WP eCommerce specific integer country id can also be used
 *
 * @return WPSC_Country|boolean the country, or false on failure
 */
function wpsc_get_country_object( $country_identifier ) {
	return WPSC_Countries::get_country( $country_identifier );
}

/**
 * Get a region object using it's WP eCommerce integer region id
 *
 * @param int the WP eCommerce specific integer region id
 *
 * @return WPSC_Country|boolean the country, or false on failure
 */
function wpsc_get_region_object( $region_id ) {
	return WPSC_Countries::get_region( false, $region_id );
}


