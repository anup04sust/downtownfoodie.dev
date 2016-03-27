<?php

function els_icons( $params, $content=null ) {
    extract(shortcode_atts(array(
        'name' => 'default'
    ), $params));

    $content = preg_replace( '/<br class="nc".\/>/', '', $content );
    $result = '<i class="' . $name . '"></i>';
    return force_balance_tags( $result );
}
add_shortcode( 'els_icon', 'els_icons' );
