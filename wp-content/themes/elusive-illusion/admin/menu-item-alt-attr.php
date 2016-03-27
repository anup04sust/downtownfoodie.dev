<?php

/**
 * Proof of concept for how to add new fields to nav_menu_item posts in the WordPress menu editor.
 * @author Weston Ruter (@westonruter), X-Team
 */
add_action('init', array('ELI_Nav_Menu_Item_Custom_Fields', 'setup'));

class ELI_Nav_Menu_Item_Custom_Fields {

    static $options = array(
        'item_tpl' => '
			<p class="additional-menu-field-{name} description description-thin">
				<label for="edit-menu-item-{name}-{id}">
					{label}<br>
					<input
						type="{input_type}"
						id="edit-menu-item-{name}-{id}"
						class="widefat code edit-menu-item-{name}"
						name="menu-item-{name}[{id}]"
						value="{value}">
				</label>
			</p>
		',
    );

    static function setup() {
        $new_fields = apply_filters('eli_nav_menu_item_additional_fields', array());
        if (empty($new_fields))
            return;
        self::$options['fields'] = self::get_fields_schema($new_fields);

        if (is_admin()) {
            add_filter('wp_edit_nav_menu_walker', function () {
                return 'ELI_Walker_Nav_Menu_Edit';
            });
            //add_filter( 'eli_nav_menu_item_additional_fields', array( __CLASS__, '_add_fields' ), 10, 5 );
            add_action('save_post', array(__CLASS__, '_save_post'), 10, 2);
        } else {
            add_filter('nav_menu_link_attributes', array(__CLASS__, '_add_link_attr'), 100, 3);
        }
    }

    static function get_fields_schema($new_fields) {
        $schema = array();
        foreach ($new_fields as $name => $field) {
            if (empty($field['name'])) {
                $field['name'] = $name;
            }
            $schema[] = $field;
        }
        return $schema;
    }

    static function get_menu_item_postmeta_key($name) {
        return '_menu_item_' . $name;
    }

    /**
     * Inject the 
     * @hook {action} save_post
     */
    static function get_field($item, $depth, $args) {
        $new_fields = '';
        foreach (self::$options['fields'] as $field) {
            $field['value'] = get_post_meta($item->ID, self::get_menu_item_postmeta_key($field['name']), true);
            $field['id'] = $item->ID;
            $new_fields .= str_replace(
                    array_map(function($key) {
                        return '{' . $key . '}';
                    }, array_keys($field)), array_values(array_map('esc_attr', $field)), self::$options['item_tpl']
            );
        }
        return $new_fields;
    }

    /**
     * Save the newly submitted fields
     * @hook {action} save_post
     */
    static function _save_post($post_id, $post) {
        if ($post->post_type !== 'nav_menu_item') {
            return $post_id; // prevent weird things from happening
        }

        foreach (self::$options['fields'] as $field_schema) {
            $form_field_name = 'menu-item-' . $field_schema['name'];
            // @todo FALSE should always be used as the default $value, otherwise we wouldn't be able to clear checkboxes
            if (isset($_POST[$form_field_name][$post_id])) {
                $key = self::get_menu_item_postmeta_key($field_schema['name']);
                $value = stripslashes($_POST[$form_field_name][$post_id]);
                update_post_meta($post_id, $key, $value);
            }
        }
    }

    static function _add_link_attr($atts, $item, $args) {
        foreach (self::$options['fields'] as $field_schema) {
           
            $form_field_name = 'menu-item-' . $field_schema['name'];            
                $meta_val = get_post_meta($item->ID, self::get_menu_item_postmeta_key($field_schema['name']), true);
                $value = stripslashes($meta_val);
                if(!empty($value)){
                    $atts[$field_schema['name']] = $value;
                }
                
            
        }      
        
        return $atts;
    }

}

// @todo This class needs to be in it's own file so we can include id J.I.T.
// requiring the nav-menu.php file on every page load is not so wise
require_once ABSPATH . 'wp-admin/includes/nav-menu.php';

class ELI_Walker_Nav_Menu_Edit extends Walker_Nav_Menu_Edit {

    function start_el(&$output, $item, $depth, $args) {
        $item_output = '';
        parent::start_el($item_output, $item, $depth, $args);
        // Inject $new_fields before: <div class="menu-item-actions description-wide submitbox">
        if ($new_fields = ELI_Nav_Menu_Item_Custom_Fields::get_field($item, $depth, $args)) {
            $item_output = preg_replace('/(?=<div[^>]+class="[^"]*submitbox)/', $new_fields, $item_output);
        }
        $output .= $item_output;
    }

}

// Somewhere in config...
add_filter('eli_nav_menu_item_additional_fields', 'mytheme_menu_item_additional_fields');

function mytheme_menu_item_additional_fields($fields) {
    $fields['onclick'] = array(
        'name' => 'onclick',
        'label' => __('On Click'),
        'container_class' => '',
        'input_type' => 'text',
    );

    return $fields;
}
