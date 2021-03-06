<?php

extract( shortcode_atts( array(
			'style' => 'simple-style',
			'size' => '', 
			'padding' => '', 
			'background_color' => '',
			'text_color' => '',
			'el_class' => '', 
		), $atts ) );


$id = uniqid();

$output = '';


global $app_styles;
$app_styles .= !empty( $background_color ) ? ( '#drop-caps-'.$id.' {background-color:'.$background_color.' !important;}' ) : '';
$app_styles .= !empty( $padding ) ? ( '#drop-caps-'.$id.' {padding:'.$padding.'px !important;}' ) : '';
$app_styles .= !empty( $text_color ) ? ( '#drop-caps-'.$id.' {color:'.$text_color.' !important;}' ) : ''; 
$app_styles .= !empty( $size ) ? ( '#drop-caps-'.$id.' {font-size:'.$size.'px !important;}' ) : ''; 

$output .= '<span id="drop-caps-'.$id.'" class="mk-dropcaps mk-shortcode '.$style.' '.$el_class.'">'.do_shortcode( strip_tags( $content ) ).'</span>';

echo $output;
