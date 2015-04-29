<?php
/*
** Copyright 2010-2015, Pye Brook Company, Inc.
**
**
** This software is provided under the GNU General Public License, version
** 2 (GPLv2), that covers its  copying, distribution and modification. The 
** GPLv2 license specifically states that it only covers only copying,
** distribution and modification activities. The GPLv2 further states that 
** all other activities are outside of the scope of the GPLv2.
**
** All activities outside the scope of the GPLv2 are covered by the Pye Brook
** Company, Inc. License. Any right not explicitly granted by the GPLv2, and 
** not explicitly granted by the Pye Brook Company, Inc. License are reserved
** by the Pye Brook Company, Inc.
**
** This software is copyrighted and the property of Pye Brook Company, Inc.
**
** Contact Pye Brook Company, Inc. at info@pyebrook.com for more information.
**
** This program is distributed in the hope that it will be useful, but WITHOUT ANY 
** WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR 
** A PARTICULAR PURPOSE. 
**
*/


/**
 * @param $country_id
 * @param $country_name
 * @param $country_iso_code
 * @param $currency_name
 * @param $currency_symbol
 * @param $currency_symbol_html
 * @param $currency_text_code
 * @param $has_regions
 * @param $tax
 * @param $continent
 * @param $visible
 *
 * @return array
 */
function _wpsc_make_country_array_element( $country_id, $country_name, $country_iso_code, $currency_name, $currency_symbol, $currency_symbol_html, $currency_text_code, $has_regions, $tax, $continent, $visible ) {

	return array(
		'id'          => $country_id,
		'name'        => $country_name,
		'isocode'     => $country_iso_code,
		'currency'    => $currency_name,
		'symbol'      => $currency_symbol,
		'symbol_html' => $currency_symbol_html,
		'code'        => $currency_text_code,
		'has_regions' => $has_regions,
		'tax'         => $tax,
		'continent'   => $continent,
		'visible'     => $visible
	);
}

/**
 * @return array
 */
function _wpsc_get_countries_data_array() {
	$countries = array();

	$countries[] = _wpsc_make_country_array_element( 1, __( 'Mauritania', 'wpsc' ), 'MR', __( 'Mauritanian Ouguiya', 'wpsc' ), '', '', __( 'MRO', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 2, __( 'Martinique( French )', 'wpsc' ), 'MQ', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'southamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 3, __( 'Malta', 'wpsc' ), 'MT', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 4, __( 'Marshall Islands', 'wpsc' ), 'MH', __( 'US Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'USD', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 5, __( 'Mali', 'wpsc' ), 'ML', __( 'CFA Franc BCEAO', 'wpsc' ), '', '', __( 'XOF', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 6, __( 'Maldives', 'wpsc' ), 'MV', __( 'Maldive Rufiyaa', 'wpsc' ), '', '', __( 'MVR', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 7, __( 'Malaysia', 'wpsc' ), 'MY', __( 'Malaysian Ringgit', 'wpsc' ), '', '', __( 'MYR', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 8, __( 'Malawi', 'wpsc' ), 'MW', __( 'Malawi Kwacha', 'wpsc' ), '', '', __( 'MWK', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 9, __( 'Madagascar', 'wpsc' ), 'MG', __( 'Malagasy Ariary', 'wpsc' ), '', '', __( 'MGA', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 10, __( 'Macau', 'wpsc' ), 'MO', __( 'Macau Pataca', 'wpsc' ), '', '', __( 'MOP', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 11, __( 'Macedonia', 'wpsc' ), 'MK', __( 'Denar', 'wpsc' ), '', '', __( 'MKD', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 12, __( 'Luxembourg', 'wpsc' ), 'LU', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 13, __( 'Lithuania', 'wpsc' ), 'LT', __( 'Lithuanian Litas', 'wpsc' ), '', '', __( 'LTL', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 14, __( 'Liechtenstein', 'wpsc' ), 'LI', __( 'Swiss Franc', 'wpsc' ), '', '', __( 'CHF', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 15, __( 'Libya', 'wpsc' ), 'LY', __( 'Libyan Dinar', 'wpsc' ), '', '', __( 'LYD', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 16, __( 'Liberia', 'wpsc' ), 'LR', __( 'Liberian Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'LRD', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 17, __( 'Lesotho', 'wpsc' ), 'LS', __( 'Lesotho Loti', 'wpsc' ), '', '', __( 'LSL', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 18, __( 'Lebanon', 'wpsc' ), 'LB', __( 'Lebanese Pound', 'wpsc' ), '', '', __( 'LBP', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 19, __( 'Latvia', 'wpsc' ), 'LV', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 20, __( 'Laos', 'wpsc' ), 'LA', __( 'Lao Kip', 'wpsc' ), '', '', __( 'LAK', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 21, __( 'Kyrgyzstan', 'wpsc' ), 'KG', __( 'Som', 'wpsc' ), '', '', __( 'KGS', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 22, __( 'Kuwait', 'wpsc' ), 'KW', __( 'Kuwaiti Dinar', 'wpsc' ), '', '', __( 'KWD', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 23, __( 'Korea, South', 'wpsc' ), 'KR', __( 'Korean Won', 'wpsc' ), '', '', __( 'KRW', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 24, __( 'Korea, North', 'wpsc' ), 'KP', __( 'North Korean Won', 'wpsc' ), '', '', __( 'KPW', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 25, __( 'Kiribati', 'wpsc' ), 'KI', __( 'Australian Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'AUD', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 26, __( 'Kenya', 'wpsc' ), 'KE', __( 'Kenyan Shilling', 'wpsc' ), '', '', __( 'KES', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 27, __( 'Kazakhstan', 'wpsc' ), 'KZ', __( 'Kazakhstan Tenge', 'wpsc' ), '', '', __( 'KZT', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 28, __( 'Jordan', 'wpsc' ), 'JO', __( 'Jordanian Dinar', 'wpsc' ), '', '', __( 'JOD', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 29, __( 'Jersey', 'wpsc' ), 'JE', __( 'Pound Sterling', 'wpsc' ), __( '£', 'wpsc' ), __( ' &#163;', 'wpsc' ), __( 'GBP', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 30, __( 'Japan', 'wpsc' ), 'JP', __( 'Japanese Yen', 'wpsc' ), __( '¥', 'wpsc' ), __( ' &#165;', 'wpsc' ), __( 'JPY', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 31, __( 'Jamaica', 'wpsc' ), 'JM', __( 'Jamaican Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'JMD', 'wpsc' ), '0', '0', 'southamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 32, __( 'Ivory Coast', 'wpsc' ), 'CI', __( 'CFA Franc BCEAO', 'wpsc' ), '', '', __( 'XOF', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 33, __( 'Italy', 'wpsc' ), 'IT', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 34, __( 'Isle of Man', 'wpsc' ), 'IM', __( 'Pound Sterling', 'wpsc' ), __( '£', 'wpsc' ), __( ' &#163;', 'wpsc' ), __( 'GBP', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 35, __( 'Israel', 'wpsc' ), 'IL', __( 'Israeli New Shekel', 'wpsc' ), __( '?', 'wpsc' ), __( ' &#8362;', 'wpsc' ), __( 'ILS', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 36, __( 'Ireland', 'wpsc' ), 'IE', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 37, __( 'Iraq', 'wpsc' ), 'IQ', __( 'Iraqi Dinar', 'wpsc' ), '', '', __( 'IQD', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 38, __( 'Indonesia', 'wpsc' ), 'ID', __( 'Indonesian Rupiah', 'wpsc' ), '', '', __( 'IDR', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 39, __( 'Iran', 'wpsc' ), 'IR', __( 'Iranian Rial', 'wpsc' ), '', '', __( 'IRR', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 40, __( 'India', 'wpsc' ), 'IN', __( 'Indian Rupee', 'wpsc' ), '', '', __( 'INR', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 41, __( 'Iceland', 'wpsc' ), 'IS', __( 'Iceland Krona', 'wpsc' ), '', '', __( 'ISK', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 42, __( 'Hungary', 'wpsc' ), 'HU', __( 'Hungarian Forint', 'wpsc' ), '', '', __( 'HUF', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 43, __( 'Hong Kong', 'wpsc' ), 'HK', __( 'Hong Kong Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'HKD', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 44, __( 'Honduras', 'wpsc' ), 'HN', __( 'Honduran Lempira', 'wpsc' ), '', '', __( 'HNL', 'wpsc' ), '0', '0', 'southamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 45, __( 'Heard Island and McDonald Islands', 'wpsc' ), 'HM', __( 'Australian Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'AUD', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 46, __( 'Haiti', 'wpsc' ), 'HT', __( 'Haitian Gourde', 'wpsc' ), '', '', __( 'HTG', 'wpsc' ), '0', '0', 'southamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 47, __( 'Guyana', 'wpsc' ), 'GY', __( 'Guyana Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'GYD', 'wpsc' ), '0', '0', 'southamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 48, __( 'Guinea Bissau', 'wpsc' ), 'GW', __( 'CFA Franc BEAC', 'wpsc' ), '', '', __( 'XAF', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 49, __( 'Guinea', 'wpsc' ), 'GN', __( 'Guinea Franc', 'wpsc' ), '', '', __( 'GNF', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 50, __( 'Guernsey', 'wpsc' ), 'GG', __( 'Pound Sterling', 'wpsc' ), __( '£', 'wpsc' ), __( ' &#163;', 'wpsc' ), __( 'GBP', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 51, __( 'Guatemala', 'wpsc' ), 'GT', __( 'Guatemalan Quetzal', 'wpsc' ), '', '', __( 'GTQ', 'wpsc' ), '0', '0', 'southamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 52, __( 'Guam( USA )', 'wpsc' ), 'GU', __( 'US Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'USD', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 53, __( 'Grenada', 'wpsc' ), 'GD', __( 'East Carribean Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'XCD', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 54, __( 'Guadeloupe( French )', 'wpsc' ), 'GP', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'southamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 55, __( 'Greenland', 'wpsc' ), 'GL', __( 'Danish Krone', 'wpsc' ), '', '', __( 'DKK', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 56, __( 'Greece', 'wpsc' ), 'GR', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '19', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 57, __( 'Gibraltar', 'wpsc' ), 'GI', __( 'Gibraltar Pound', 'wpsc' ), '', '', __( 'GIP', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 58, __( 'Ghana', 'wpsc' ), 'GH', __( 'Ghanaian Cedi', 'wpsc' ), '', '', __( 'GHS', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 59, __( 'Germany', 'wpsc' ), 'DE', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 60, __( 'Georgia', 'wpsc' ), 'GE', __( 'Georgian Lari', 'wpsc' ), '', '', __( 'GEL', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 61, __( 'Gambia', 'wpsc' ), 'GM', __( 'Gambian Dalasi', 'wpsc' ), '', '', __( 'GMD', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 62, __( 'Gabon', 'wpsc' ), 'GA', __( 'CFA Franc BEAC', 'wpsc' ), '', '', __( 'XAF', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 63, __( 'French Southern Territories', 'wpsc' ), 'TF', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 64, __( 'France', 'wpsc' ), 'FR', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 65, __( 'Finland', 'wpsc' ), 'FI', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 66, __( 'Fiji', 'wpsc' ), 'FJ', __( 'Fiji Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'FJD', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 67, __( 'Faroe Islands', 'wpsc' ), 'FO', __( 'Danish Krone', 'wpsc' ), '', '', __( 'DKK', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 68, __( 'Falkland Islands', 'wpsc' ), 'FK', __( 'Falkland Islands Pound', 'wpsc' ), '', '', __( 'FKP', 'wpsc' ), '0', '0', 'southamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 69, __( 'Ethiopia', 'wpsc' ), 'ET', __( 'Ethiopian Birr', 'wpsc' ), '', '', __( 'ETB', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 70, __( 'Estonia', 'wpsc' ), 'EE', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 71, __( 'Eritrea', 'wpsc' ), 'ER', __( 'Eritrean Nakfa', 'wpsc' ), '', '', __( 'ERN', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 72, __( 'Equatorial Guinea', 'wpsc' ), 'GQ', __( 'CFA Franc BEAC', 'wpsc' ), '', '', __( 'XAF', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 73, __( 'El Salvador', 'wpsc' ), 'SV', __( 'US Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'USD', 'wpsc' ), '0', '0', 'southamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 74, __( 'Egypt', 'wpsc' ), 'EG', __( 'Egyptian Pound', 'wpsc' ), '', '', __( 'EGP', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 75, __( 'Ecuador', 'wpsc' ), 'EC', __( 'Ecuador Sucre', 'wpsc' ), '', '', __( 'ECS', 'wpsc' ), '0', '0', 'southamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 76, __( 'Timor - Leste', 'wpsc' ), 'TL', __( 'US Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'USD', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 77, __( 'Dominican Republic', 'wpsc' ), 'DO', __( 'Dominican Peso', 'wpsc' ), '', '', __( 'DOP', 'wpsc' ), '0', '0', 'southamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 78, __( 'Dominica', 'wpsc' ), 'DM', __( 'East Caribbean Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'XCD', 'wpsc' ), '0', '0', 'southamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 79, __( 'Djibouti', 'wpsc' ), 'DJ', __( 'Djibouti Franc', 'wpsc' ), '', '', __( 'DJF', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 80, __( 'Denmark', 'wpsc' ), 'DK', __( 'Danish Krone', 'wpsc' ), '', '', __( 'DKK', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 81, __( 'Democratic Republic of Congo', 'wpsc' ), 'CD', __( 'Francs', 'wpsc' ), '', '', __( 'CDF', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 82, __( 'Czech Rep . ', 'wpsc' ), 'CZ', __( 'Czech Koruna', 'wpsc' ), '', '', __( 'CZK', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 83, __( 'Cyprus', 'wpsc' ), 'CY', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 84, __( 'Cuba', 'wpsc' ), 'CU', __( 'Cuban Peso', 'wpsc' ), '', '', __( 'CUP', 'wpsc' ), '0', '0', 'northamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 85, __( 'Croatia', 'wpsc' ), 'HR', __( 'Croatian Kuna', 'wpsc' ), '', '', __( 'HRK', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 86, __( 'Costa Rica', 'wpsc' ), 'CR', __( 'Costa Rican Colon', 'wpsc' ), '', '', __( 'CRC', 'wpsc' ), '0', '0', 'southamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 87, __( 'Cook Islands', 'wpsc' ), 'CK', __( 'New Zealand Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'NZD', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 88, __( 'Republic of the Congo', 'wpsc' ), 'CG', __( 'CFA Franc BEAC', 'wpsc' ), '', '', __( 'XAF', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 89, __( 'Comoros', 'wpsc' ), 'KM', __( 'Comoros Franc', 'wpsc' ), '', '', __( 'KMF', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 90, __( 'Colombia', 'wpsc' ), 'CO', __( 'Colombian Peso', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'COP', 'wpsc' ), '0', '0', 'southamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 91, __( 'Cocos( Keeling ) Islands', 'wpsc' ), 'CC', __( 'Australian Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), 'AUD', '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 92, __( 'Christmas Island', 'wpsc' ), 'CX', __( 'Australian Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'AUD', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 93, __( 'Chile', 'wpsc' ), 'CL', __( 'Chilean Peso', 'wpsc' ), '', '', __( 'CLP', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 94, __( 'China', 'wpsc' ), 'CN', __( 'Yuan Renminbi', 'wpsc' ), '', '', __( 'CNY', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 95, __( 'Chad', 'wpsc' ), 'TD', __( 'CFA Franc BEAC', 'wpsc' ), '', '', __( 'XAF', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 96, __( 'Central African Republic', 'wpsc' ), 'CF', __( 'CFA Franc BEAC', 'wpsc' ), '', '', __( 'XAF', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 97, __( 'Cayman Islands', 'wpsc' ), 'KY', __( 'Cayman Islands Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'KYD', 'wpsc' ), '0', '0', 'northamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 98, __( 'Cape Verde', 'wpsc' ), 'CV', __( 'Cape Verde Escudo', 'wpsc' ), '', '', __( 'CVE', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 99, __( 'Cameroon', 'wpsc' ), 'CM', __( 'CFA Franc BEAC', 'wpsc' ), '', '', __( 'XAF', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 100, __( 'Canada', 'wpsc' ), 'CA', __( 'Canadian Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'CAD', 'wpsc' ), '1', '', 'northamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 101, __( 'Cambodia', 'wpsc' ), 'KH', __( 'Kampuchean Riel', 'wpsc' ), '', '', __( 'KHR', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 102, __( 'Burundi', 'wpsc' ), 'BI', __( 'Burundi Franc', 'wpsc' ), '', '', __( 'BIF', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 103, __( 'Burkina Faso', 'wpsc' ), 'BF', __( 'CFA Franc BCEAO', 'wpsc' ), '', '', __( 'XOF', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 104, __( 'Bulgaria', 'wpsc' ), 'BG', __( 'Bulgarian Lev', 'wpsc' ), '', '', __( 'BGN', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 105, __( 'Brunei Darussalam', 'wpsc' ), 'BN', __( 'Brunei Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'BND', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 106, __( 'British Indian Ocean Territory', 'wpsc' ), 'IO', __( 'US Dollar', 'wpsc' ), '$', '&#036;', 'USD', '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 107, __( 'Brazil', 'wpsc' ), 'BR', __( 'Brazilian Real', 'wpsc' ), '', '', __( 'BRL', 'wpsc' ), '0', '0', 'southamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 108, __( 'Bouvet Island', 'wpsc' ), 'BV', __( 'Norwegian Krone', 'wpsc' ), '', '', __( 'NOK', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 109, __( 'Botswana', 'wpsc' ), 'BW', __( 'Botswana Pula', 'wpsc' ), '', '', __( 'BWP', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 110, __( 'Bosnia - Herzegovina', 'wpsc' ), 'BA', __( 'Marka', 'wpsc' ), '', '', __( 'BAM', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 111, __( 'Bolivia', 'wpsc' ), 'BO', __( 'Boliviano', 'wpsc' ), '', '', __( 'BOB', 'wpsc' ), '0', '0', 'southamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 112, __( 'Bhutan', 'wpsc' ), 'BT', __( 'Bhutan Ngultrum', 'wpsc' ), '', '', __( 'BTN', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 113, __( 'Bermuda', 'wpsc' ), 'BM', __( 'Bermudian Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'BMD', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 114, __( 'Benin', 'wpsc' ), 'BJ', __( 'CFA Franc BCEAO', 'wpsc' ), '', '', __( 'XOF', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 115, __( 'Belize', 'wpsc' ), 'BZ', __( 'Belize Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'BZD', 'wpsc' ), '0', '0', 'northamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 116, __( 'Belgium', 'wpsc' ), 'BE', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 117, __( 'Belarus', 'wpsc' ), 'BY', __( 'Belarussian Ruble', 'wpsc' ), '', '', __( 'BYR', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 118, __( 'Barbados', 'wpsc' ), 'BB', __( 'Barbados Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'BBD', 'wpsc' ), '0', '0', 'southamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 119, __( 'Bangladesh', 'wpsc' ), 'BD', __( 'Bangladeshi Taka', 'wpsc' ), '', '', __( 'BDT', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 120, __( 'Bahrain', 'wpsc' ), 'BH', __( 'Bahraini Dinar', 'wpsc' ), '', '', __( 'BHD', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 121, __( 'Bahamas', 'wpsc' ), 'BS', __( 'Bahamian Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'BSD', 'wpsc' ), '0', '0', 'northamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 122, __( 'Azerbaijan', 'wpsc' ), 'AZ', __( 'Azerbaijani Manat', 'wpsc' ), _x( 'm', 'azerbaijani manat symbol', 'wpsc' ), _x( 'm', 'azerbaijani manat symbol html', 'wpsc' ), __( 'AZN', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 123, __( 'Austria', 'wpsc' ), 'AT', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 124, __( 'Aruba', 'wpsc' ), 'AW', __( 'Aruban Florin', 'wpsc' ), __( 'Afl . ', 'wpsc' ), __( 'Afl . ', 'wpsc' ), __( 'AWG', 'wpsc' ), '0', '0', 'southamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 125, __( 'Armenia', 'wpsc' ), 'AM', __( 'Armenian Dram', 'wpsc' ), '', '', __( 'AMD', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 126, __( 'Argentina', 'wpsc' ), 'AR', __( 'Argentine Peso', 'wpsc' ), '', '', __( 'ARS', 'wpsc' ), '0', '0', 'southamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 127, __( 'Antigua and Barbuda', 'wpsc' ), 'AG', __( 'East Caribbean Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'XCD', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 128, __( 'Antarctica', 'wpsc' ), 'AQ', __( 'Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'ATA', 'wpsc' ), '0', '0', 'antarctica', '1' );
	$countries[] = _wpsc_make_country_array_element( 129, __( 'Anguilla', 'wpsc' ), 'AI', __( 'East Caribbean Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'XCD', 'wpsc' ), '0', '0', 'northamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 130, __( 'Angola', 'wpsc' ), 'AO', __( 'Angolan Kwanza', 'wpsc' ), __( 'Kz', 'wpsc' ), __( 'Kz', 'wpsc' ), __( 'AOA', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 131, __( 'Andorra', 'wpsc' ), 'AD', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 132, __( 'American Samoa', 'wpsc' ), 'AS', __( 'US Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'USD', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 133, __( 'Algeria', 'wpsc' ), 'DZ', __( 'Algerian Dinar', 'wpsc' ), '', '', __( 'DZD', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 134, __( 'Albania', 'wpsc' ), 'AL', __( 'Albanian Lek', 'wpsc' ), '', '', __( 'ALL', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 135, __( 'Afghanistan', 'wpsc' ), 'AF', __( 'Afghanistan Afghani', 'wpsc' ), '', '', __( 'AFA', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 136, __( 'USA', 'wpsc' ), 'US', __( 'US Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'USD', 'wpsc' ), '1', '', 'northamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 137, __( 'Australia', 'wpsc' ), 'AU', __( 'Australian Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'AUD', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 139, __( 'Mauritius', 'wpsc' ), 'MU', __( 'Mauritius Rupee', 'wpsc' ), '', '', __( 'MUR', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 140, __( 'Mayotte', 'wpsc' ), 'YT', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 141, __( 'Mexico', 'wpsc' ), 'MX', __( 'Mexican Peso', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'MXN', 'wpsc' ), '1', '', 'northamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 142, __( 'Micronesia', 'wpsc' ), 'FM', __( 'US Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'USD', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 143, __( 'Moldova', 'wpsc' ), 'MD', __( 'Moldovan Leu', 'wpsc' ), '', '', __( 'MDL', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 144, __( 'Monaco', 'wpsc' ), 'MC', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 145, __( 'Mongolia', 'wpsc' ), 'MN', __( 'Mongolian Tugrik', 'wpsc' ), '', '', __( 'MNT', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 146, __( 'Montserrat', 'wpsc' ), 'MS', __( 'East Caribbean Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'XCD', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 147, __( 'Morocco', 'wpsc' ), 'MA', __( 'Moroccan Dirham', 'wpsc' ), '', '', __( 'MAD', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 148, __( 'Mozambique', 'wpsc' ), 'MZ', __( 'Mozambique Metical', 'wpsc' ), '', '', __( 'MZN', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 149, __( 'Myanmar', 'wpsc' ), 'MM', __( 'Myanmar Kyat', 'wpsc' ), '', '', __( 'MMK', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 150, __( 'Namibia', 'wpsc' ), 'NA', __( 'Namibian Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'NAD', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 151, __( 'Nauru', 'wpsc' ), 'NR', __( 'Australian Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'AUD', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 152, __( 'Nepal', 'wpsc' ), 'NP', __( 'Nepalese Rupee', 'wpsc' ), '', '', __( 'NPR', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 153, __( 'Netherlands', 'wpsc' ), 'NL', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 154, __( 'Netherlands Antilles', 'wpsc' ), 'AN', __( 'Netherlands Antillean Guilder', 'wpsc' ), __( 'ƒ', 'wpsc' ), __( ' &#402;', 'wpsc' ), __( 'ANG', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 155, __( 'New Caledonia ( French )', 'wpsc' ), 'NC', __( 'CFP Franc', 'wpsc' ), '', '', __( 'XPF', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 156, __( 'New Zealand', 'wpsc' ), 'NZ', __( 'New Zealand Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'NZD', 'wpsc' ), '0', '12.5', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 157, __( 'Nicaragua', 'wpsc' ), 'NI', __( 'Nicaraguan Cordoba Oro', 'wpsc' ), '', '', __( 'NIO', 'wpsc' ), '0', '0', 'northamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 158, __( 'Niger', 'wpsc' ), 'NE', __( 'CFA Franc BCEAO', 'wpsc' ), '', '', __( 'XOF', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 159, __( 'Nigeria', 'wpsc' ), 'NG', __( 'Nigerian Naira', 'wpsc' ), '', '', __( 'NGN', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 160, __( 'Niue', 'wpsc' ), 'NU', __( 'New Zealand Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'NZD', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 161, __( 'Norfolk Island', 'wpsc' ), 'NF', __( 'Australian Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'AUD', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 162, __( 'Northern Mariana Islands', 'wpsc' ), 'MP', __( 'US Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'USD', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 163, __( 'Norway', 'wpsc' ), 'NO', __( 'Norwegian Krone', 'wpsc' ), '', '', __( 'NOK', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 164, __( 'Oman', 'wpsc' ), 'OM', __( 'Omani Rial', 'wpsc' ), '', '', __( 'OMR', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 165, __( 'Pakistan', 'wpsc' ), 'PK', __( 'Pakistan Rupee', 'wpsc' ), '', '', __( 'PKR', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 166, __( 'Palau', 'wpsc' ), 'PW', __( 'US Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'USD', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 167, __( 'Panama', 'wpsc' ), 'PA', __( 'Panamanian Balboa', 'wpsc' ), '', '', __( 'PAB', 'wpsc' ), '0', '0', 'southamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 168, __( 'Papua New Guinea', 'wpsc' ), 'PG', __( 'Papua New Guinea Kina', 'wpsc' ), '', '', __( 'PGK', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 169, __( 'Paraguay', 'wpsc' ), 'PY', __( 'Paraguay Guarani', 'wpsc' ), '', '', __( 'PYG', 'wpsc' ), '0', '0', 'southamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 170, __( 'Peru', 'wpsc' ), 'PE', __( 'Peruvian Nuevo Sol', 'wpsc' ), '', '', __( 'PEN', 'wpsc' ), '0', '0', 'southamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 171, __( 'Philippines', 'wpsc' ), 'PH', __( 'Philippine Peso', 'wpsc' ), '', '', __( 'PHP', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 172, __( 'Pitcairn Island', 'wpsc' ), 'PN', __( 'New Zealand Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'NZD', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 173, __( 'Poland', 'wpsc' ), 'PL', __( 'Polish Zloty', 'wpsc' ), '', '', __( 'PLN', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 174, __( 'Polynesia( French )', 'wpsc' ), 'PF', __( 'CFP Franc', 'wpsc' ), '', '', __( 'XPF', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 175, __( 'Portugal', 'wpsc' ), 'PT', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 176, __( 'Puerto Rico', 'wpsc' ), 'PR', __( 'US Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'USD', 'wpsc' ), '0', '0', 'northamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 177, __( 'Qatar', 'wpsc' ), 'QA', __( 'Qatari Rial', 'wpsc' ), '', '', __( 'QAR', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 178, __( 'Reunion( French )', 'wpsc' ), 'RE', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 179, __( 'Romania', 'wpsc' ), 'RO', __( 'Romanian New Leu', 'wpsc' ), '', '', __( 'RON', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 180, __( 'Russia', 'wpsc' ), 'RU', __( 'Russian Ruble', 'wpsc' ), '', '', __( 'RUB', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 181, __( 'Rwanda', 'wpsc' ), 'RW', __( 'Rwanda Franc', 'wpsc' ), '', '', __( 'RWF', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 182, __( 'Saint Helena', 'wpsc' ), 'SH', __( 'St . Helena Pound', 'wpsc' ), '', '', __( 'SHP', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 183, __( 'Saint Kitts & Nevis Anguilla', 'wpsc' ), 'KN', __( 'East Caribbean Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'XCD', 'wpsc' ), '0', '0', 'northamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 184, __( 'Saint Lucia', 'wpsc' ), 'LC', __( 'East Caribbean Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'XCD', 'wpsc' ), '0', '0', 'northamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 185, __( 'Saint Pierre and Miquelon', 'wpsc' ), 'PM', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'northamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 186, __( 'Saint Vincent & Grenadines', 'wpsc' ), 'VC', __( 'East Caribbean Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'XCD', 'wpsc' ), '0', '0', 'northamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 187, __( 'Samoa', 'wpsc' ), 'WS', __( 'Samoan Tala', 'wpsc' ), '', '', __( 'WST', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 188, __( 'San Marino', 'wpsc' ), 'SM', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 189, __( 'Sao Tome and Principe', 'wpsc' ), 'ST', __( 'Dobra', 'wpsc' ), '', '', __( 'STD', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 190, __( 'Saudi Arabia', 'wpsc' ), 'SA', __( 'Saudi Riyal', 'wpsc' ), '', '', __( 'SAR', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 191, __( 'Senegal', 'wpsc' ), 'SN', __( 'CFA Franc BCEAO', 'wpsc' ), '', '', __( 'XOF', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 192, __( 'Seychelles', 'wpsc' ), 'SC', __( 'Seychelles Rupee', 'wpsc' ), '', '', __( 'SCR', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 193, __( 'Sierra Leone', 'wpsc' ), 'SL', __( 'Sierra Leone Leone', 'wpsc' ), '', '', __( 'SLL', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 194, __( 'Singapore', 'wpsc' ), 'SG', __( 'Singapore Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'SGD', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 195, __( 'Slovakia', 'wpsc' ), 'SK', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 196, __( 'Slovenia', 'wpsc' ), 'SI', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 197, __( 'Solomon Islands', 'wpsc' ), 'SB', __( 'Solomon Islands Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), 'SBD', '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 198, __( 'Somalia', 'wpsc' ), 'SO', __( 'Somali Shilling', 'wpsc' ), '', '', __( 'SOS', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 199, __( 'South Africa', 'wpsc' ), 'ZA', __( 'South African Rand', 'wpsc' ), '', '', __( 'ZAR', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 200, __( 'South Georgia & South Sandwich Islands', 'wpsc' ), 'GS', __( 'Pound Sterling', 'wpsc' ), __( '£', 'wpsc' ), __( ' &#163;', 'wpsc' ), __( 'GBP', 'wpsc' ), '0', '0', 'southamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 201, __( 'Spain', 'wpsc' ), 'ES', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 202, __( 'Sri Lanka', 'wpsc' ), 'LK', __( 'Sri Lanka Rupee', 'wpsc' ), '', '', __( 'LKR', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 203, __( 'Sudan', 'wpsc' ), 'SD', __( 'Sudanese Pound', 'wpsc' ), '', '', __( 'SDG', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 204, __( 'Suriname', 'wpsc' ), 'SR', __( 'Surinamese Dollar', 'wpsc' ), '', '', __( 'SRD', 'wpsc' ), '0', '0', 'southamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 205, __( 'Svalbard and Jan Mayen Islands', 'wpsc' ), 'SJ', __( 'Norwegian Krone', 'wpsc' ), '', '', __( 'NOK', 'wpsc' ), '0', '0', '', '1' );
	$countries[] = _wpsc_make_country_array_element( 206, __( 'Swaziland', 'wpsc' ), 'SZ', __( 'Swaziland Lilangeni', 'wpsc' ), '', '', __( 'SZL', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 207, __( 'Sweden', 'wpsc' ), 'SE', __( 'Swedish Krona', 'wpsc' ), '', '', __( 'SEK', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 208, __( 'Switzerland', 'wpsc' ), 'CH', __( 'Swiss Franc', 'wpsc' ), '', '', __( 'CHF', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 209, __( 'Syria', 'wpsc' ), 'SY', __( 'Syrian Pound', 'wpsc' ), '', '', __( 'SYP', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 210, __( 'Taiwan', 'wpsc' ), 'TW', __( 'New Taiwan Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'TWD', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 211, __( 'Tajikistan', 'wpsc' ), 'TJ', __( 'Tajik Somoni', 'wpsc' ), '', '', __( 'TJS', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 212, __( 'Tanzania', 'wpsc' ), 'TZ', __( 'Tanzanian Shilling', 'wpsc' ), '', '', __( 'TZS', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 213, __( 'Thailand', 'wpsc' ), 'TH', __( 'Thai Baht', 'wpsc' ), '', '', __( 'THB', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 214, __( 'Togo', 'wpsc' ), 'TG', __( 'CFA Franc BCEAO', 'wpsc' ), '', '', __( 'XOF', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 215, __( 'Tokelau', 'wpsc' ), 'TK', __( 'New Zealand Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'NZD', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 216, __( 'Tonga', 'wpsc' ), 'TO', __( 'Tongan Pa &#699;anga', 'wpsc' ), '', '', __( 'TOP', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 217, __( 'Trinidad and Tobago', 'wpsc' ), 'TT', __( 'Trinidad and Tobago Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'TTD', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 218, __( 'Tunisia', 'wpsc' ), 'TN', __( 'Tunisian Dinar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'TND', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 219, __( 'Turkey', 'wpsc' ), 'TR', __( 'Turkish Lira', 'wpsc' ), '', '', __( 'TRY', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 220, __( 'Turkmenistan', 'wpsc' ), 'TM', __( 'Manat', 'wpsc' ), '', '', __( 'TMM', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 221, __( 'Turks and Caicos Islands', 'wpsc' ), 'TC', __( 'US Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'USD', 'wpsc' ), '0', '0', 'northamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 222, __( 'Tuvalu', 'wpsc' ), 'TV', __( 'Australian Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'AUD', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 223, __( 'United Kingdom', 'wpsc' ), 'GB', __( 'Pound Sterling', 'wpsc' ), __( '£', 'wpsc' ), __( ' &#163;', 'wpsc' ), __( 'GBP', 'wpsc' ), '0', '17.5', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 224, __( 'Uganda', 'wpsc' ), 'UG', __( 'Uganda Shilling', 'wpsc' ), '', '', __( 'UGX', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 225, __( 'Ukraine', 'wpsc' ), 'UA', __( 'Ukraine Hryvnia', 'wpsc' ), __( '?', 'wpsc' ), __( ' &#8372;', 'wpsc' ), __( 'UAH', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 226, __( 'United Arab Emirates', 'wpsc' ), 'AE', __( 'Arab Emirates Dirham', 'wpsc' ), '', '', __( 'AED', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 227, __( 'Uruguay', 'wpsc' ), 'UY', __( 'Uruguayan Peso', 'wpsc' ), '', '', __( 'UYU', 'wpsc' ), '0', '0', 'southamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 228, __( 'USA Minor Outlying Islands', 'wpsc' ), 'UM', __( 'US Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'USD', 'wpsc' ), '0', '0', '', '1' );
	$countries[] = _wpsc_make_country_array_element( 229, __( 'Uzbekistan', 'wpsc' ), 'UZ', __( 'Uzbekistan Sum', 'wpsc' ), '', '', __( 'UZS', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 230, __( 'Vanuatu', 'wpsc' ), 'VU', __( 'Vanuatu Vatu', 'wpsc' ), '', '', __( 'VUV', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 231, __( 'Vatican', 'wpsc' ), 'VA', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 232, __( 'Venezuela', 'wpsc' ), 'VE', __( 'Venezuelan Bolivar Fuerte', 'wpsc' ), '', '', __( 'VEF', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 233, __( 'Vietnam', 'wpsc' ), 'VN', __( 'Vietnamese Dong', 'wpsc' ), '', '', __( 'VND', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 234, __( 'Virgin Islands( British )', 'wpsc' ), 'VG', __( 'US Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'USD', 'wpsc' ), '0', '0', 'northamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 235, __( 'Virgin Islands( USA )', 'wpsc' ), 'VI', __( 'US Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'USD', 'wpsc' ), '0', '0', 'northamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 236, __( 'Wallis and Futuna Islands', 'wpsc' ), 'WF', __( 'CFP Franc', 'wpsc' ), '', '', __( 'XPF', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 237, __( 'Western Sahara', 'wpsc' ), 'EH', __( 'Moroccan Dirham', 'wpsc' ), '', '', __( 'MAD', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 238, __( 'Yemen', 'wpsc' ), 'YE', __( 'Yemeni Rial', 'wpsc' ), '', '', __( 'YER', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 240, __( 'Zambia', 'wpsc' ), 'ZM', __( 'Zambian Kwacha', 'wpsc' ), '', '', __( 'ZMK', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 241, __( 'Zimbabwe', 'wpsc' ), 'ZW', __( 'US Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'USD', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 242, __( 'South Sudan', 'wpsc' ), 'SS', __( 'South Sudanese Pound', 'wpsc' ), '', '', __( 'SSP', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 243, __( 'Serbia', 'wpsc' ), 'RS', __( 'Serbian Dinar', 'wpsc' ), '', '', __( 'RSD', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 244, __( 'Montenegro', 'wpsc' ), 'ME', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 246, __( 'Aland Islands', 'wpsc' ), 'AX', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 247, __( 'Saint Barthelemy', 'wpsc' ), 'BL', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'europe', '1' );
	$countries[] = _wpsc_make_country_array_element( 248, __( 'Bonaire, Sint Eustatius and Saba', 'wpsc' ), 'BQ', __( 'US Dollar', 'wpsc' ), __( '$', 'wpsc' ), __( ' &#036;', 'wpsc' ), __( 'USD', 'wpsc' ), '0', '0', 'southamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 249, __( 'Curacao', 'wpsc' ), 'CW', __( 'Netherlands Antillean Guilder', 'wpsc' ), __( 'ƒ', 'wpsc' ), __( ' &#402;', 'wpsc' ), __( 'ANG', 'wpsc' ), '0', '0', 'southamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 250, __( 'Saint Martin( French Part)', 'wpsc' ), 'MF', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'southamerica', '1' );
	$countries[] = _wpsc_make_country_array_element( 251, __( 'Palestinian Territories', 'wpsc' ), 'PS', __( 'Israeli New Shekel', 'wpsc' ), __( '?', 'wpsc' ), __( ' &#8362;', 'wpsc' ), __( 'ILS', 'wpsc' ), '0', '0', 'asiapacific', '1' );
	$countries[] = _wpsc_make_country_array_element( 252, __( 'Sint Maarten( Dutch Part)', 'wpsc' ), 'SX', __( 'Netherlands Antillean Guilder', 'wpsc' ), __( 'ƒ', 'wpsc' ), __( ' &#402;', 'wpsc' ), __( 'ANG', 'wpsc' ), '0', '0', 'africa', '1' );
	$countries[] = _wpsc_make_country_array_element( 253, __( 'French Guiana', 'wpsc' ), 'GF', __( 'Euro', 'wpsc' ), __( '€', 'wpsc' ), __( ' &#8364;', 'wpsc' ), __( 'EUR', 'wpsc' ), '0', '0', 'southamerica', '1' );

	/**
	 * Get or modify the countries data used to initalize WP eCommerce ccuntries data structures
	 *
	 * @since  4.1
	 *
	 * @param array array of associative arrays of country data, each array element should have the following required properties
	 *  country_id
	 *  country_name
	 *  country_iso_code
	 *  currency_name
	 *  currency_symbol
	 *  currency_symbol_html
	 *  currency_text_code
	 *  has_regions
	 *  tax
	 *  continent
	 *  visible
	 */
	$countries = apply_filters( 'wpsc_get_countries_data_array', $countries );
	return $countries;
}

