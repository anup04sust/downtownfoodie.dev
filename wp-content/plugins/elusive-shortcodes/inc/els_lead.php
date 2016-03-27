<?php
function els_lead( $params, $content=null ){

    $content = preg_replace( '/<br class="nc".\/>/', '', $content );
    $result = '<div class="lead">';
    $result .= do_shortcode( $content );
    $result .= '</div>';

    return force_balance_tags( $result );
}
add_shortcode( 'els_lead', 'els_lead' );
