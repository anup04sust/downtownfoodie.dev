<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Theme_EMShortcode_Widget extends WP_Widget {

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {
        parent::__construct(
                'theme_embed_shortcode', __('[Embed shortcode] Widget', ELUSICVE_THEME_LAN), array('description' => __('A Social Widget', ELUSICVE_THEME_LAN),)
        );
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance) {       
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
         $scontent =   apply_filters('widget_scontent', $instance['scontent']);
         echo do_shortcode($scontent);
        echo $args['after_widget'];
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form($instance) {
       
        $title = !empty($instance['title']) ? $instance['title'] : __('', ELUSICVE_THEME_LAN);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
        $scontent = !empty($instance['scontent']) ? $instance['scontent'] : __('', ELUSICVE_THEME_LAN);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('scontent'); ?>"><?php _e('Shortcodes:'); ?></label> 
            <textarea class="widefat" id="<?php echo $this->get_field_id('scontent'); ?>" name="<?php echo $this->get_field_name('scontent'); ?>"><?php echo esc_attr($scontent); ?></textarea>
        </p>
        <?php
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     */
    public function update($new_instance, $old_instance) {        
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        $instance['scontent'] = (!empty($new_instance['scontent']) ) ? strip_tags($new_instance['scontent']) : '';
        return $instance;
    }

}
