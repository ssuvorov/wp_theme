<?php

function noo_organici_get_color($hex) {
	// Format the hex color string
	$hex = str_replace('#', '', $hex);
	if (strlen($hex) == 3) {
		$hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
	}

	// Get decimal values
	$r = hexdec(substr($hex,0,2));
	$g = hexdec(substr($hex,2,2));
	$b = hexdec(substr($hex,4,2));

	return array( $r, $g, $b );
}

function noo_organici_return_color($color) {
	return sprintf("#%02x%02x%02x", $color[0],$color[1], $color[2]);
}

function noo_organici_return_rgbahex($color) {
	return sprintf("#%02x%02x%02x%02x",
		isset($color[3]) ? $color[3]*255 : 255,
		$color[0],$color[1], $color[2]);
}

function noo_organici_return_rgba($color) {
	return sprintf("rgba(%d, %d, %d, %01.2f)",
		$color[0],$color[1], $color[2], 
		isset($color[3]) ? $color[3]/255 : 1);
}

function noo_organici_rgb_to_hsl($color) {
	$r = $color[0] / 255;
	$g = $color[1] / 255;
	$b = $color[2] / 255;

	$min = min($r, $g, $b);
	$max = max($r, $g, $b);

	$L = ($min + $max) / 2;
	if ($min == $max) {
		$S = $H = 0;
	} else {
		if ($L < 0.5)
			$S = ($max - $min)/($max + $min);
		else
			$S = ($max - $min)/(2.0 - $max - $min);

		if ($r == $max) $H = ($g - $b)/($max - $min);
		elseif ($g == $max) $H = 2.0 + ($b - $r)/($max - $min);
		elseif ($b == $max) $H = 4.0 + ($r - $g)/($max - $min);

	}

	$out = array(
		($H < 0 ? $H + 6 : $H)*60,
		$S*100,
		$L*100,
	);

	return $out;
}

function noo_organici_hsl_to_rgb_helper($comp, $temp1, $temp2) {
	if ($comp < 0) $comp += 1.0;
	elseif ($comp > 1) $comp -= 1.0;

	if (6 * $comp < 1) return $temp1 + ($temp2 - $temp1) * 6 * $comp;
	if (2 * $comp < 1) return $temp2;
	if (3 * $comp < 2) return $temp1 + ($temp2 - $temp1)*((2/3) - $comp) * 6;

	return $temp1;
}

function noo_organici_hsl_to_rgb($color) {
	$H = $color[0] / 360;
	$S = $color[1] / 100;
	$L = $color[2] / 100;

	if ($S == 0) {
		$r = $g = $b = $L;
	} else {
		$temp2 = $L < 0.5 ?
			$L*(1.0 + $S) :
			$L + $S - $L * $S;

		$temp1 = 2.0 * $L - $temp2;

		$r = noo_organici_hsl_to_rgb_helper($H + 1/3, $temp1, $temp2);
		$g = noo_organici_hsl_to_rgb_helper($H, $temp1, $temp2);
		$b = noo_organici_hsl_to_rgb_helper($H - 1/3, $temp1, $temp2);
	}

	// $out = array($r*255, $g*255, $b*255);
	$out = array(round($r*255), round($g*255), round($b*255));
	return $out;
}

function noo_organici_adjust_lightness($hex, $percent) {
	$color = noo_organici_get_color( $hex );
	$color = noo_organici_rgb_to_hsl( $color );

	// Adjust lightness
	$color[2] = min(100, max(0, $color[2] + $percent));

	$color = noo_organici_hsl_to_rgb( $color );
	return noo_organici_return_color($color);
}

function noo_organici_adjust_saturate($hex, $percent) {
	$color = noo_organici_get_color( $hex );
	$color = noo_organici_rgb_to_hsl( $color );

	// Adjust staturate
	$color[1] = min(100, max(0, $color[1] + $percent));

	$color = noo_organici_hsl_to_rgb( $color );
	return noo_organici_return_color($color);
}

function noo_organici_css_darken($hex, $percent) {
	$percent = intval( str_replace('%', '', $percent), 10 );
	return noo_organici_adjust_lightness( $hex, 0 - $percent );
}

function noo_organici_css_lighten($hex, $percent) {
	$percent = intval( str_replace('%', '', $percent), 10 );
	return noo_organici_adjust_lightness( $hex, $percent );
}

function noo_organici_css_saturate($hex, $percent) {
	$percent = intval( str_replace('%', '', $percent), 10 );
	return noo_organici_adjust_saturate( $hex, $percent );
}

function noo_organici_css_desaturate($hex, $percent) {
	$percent = intval( str_replace('%', '', $percent), 10 );
	return noo_organici_adjust_saturate( $hex, 0 - $percent );
}

function noo_organici_css_fade($hex, $percent) {
	$percent = intval( str_replace('%', '', $percent), 10 );
	$color = noo_organici_get_color( $hex );

	$color[3] = min(1, max(0, $percent / 100.0)) * 255;

	return noo_organici_return_rgba($color);
}
