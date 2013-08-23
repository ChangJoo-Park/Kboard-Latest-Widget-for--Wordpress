<?php
/*
Plugin Name: Kboard Latest Widget
Plugin URI: http://parkcj.wordpress.com
Description: Add Kboard widget
Version: 0.0.1
Author: Chang Ju Park
Author URI: http://parkcj.wordpress.com
*/
class Kboard_Latest_Widget extends WP_Widget {
    public function __construct() {
        // 생성자, 위젯이 실행되면 가장 먼저 처리된다. 
        parent::__construct(
            'kboard_widget',
            'KBoard_Widget',
            array( 'description' => __( 'Kboard Latest Widget', '' ), ) // Args
            );
    }
    public function widget( $args, $instance ) {
        // 위젯의 실제 출력될 모습. 
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $board_code = empty($instance['board_code']) ? '&nbsp' : apply_filters('Kboard Latest Widget', $instance['board_code']);
?>
        <div id="kboard-latest-widget">
            <?php echo $title; ?>
            <?php echo do_shortcode( $board_code );?>
        </div>
<?php
    }
    public function form( $instance ) {
        // 관리자 페이지에 나타날 위젯 폼이다. 
         $defaults = array('title'=> 'Board Name', 'board_code'=> '', 'notice' => '');
         $instance = wp_parse_args((array)$instance, $defaults);
         
         $title = strip_tags($instance['title']); // 게시판이름
         $board_code = strip_tags($instance['board_code']);

?>
        <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title :' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <label for="<?php echo $this->get_field_name( 'board_code' ); ?>"><?php _e( 'Board ShortCode :' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'board_code' ); ?>" name="<?php echo $this->get_field_name( 'board_code' ); ?>" type="text" value="<?php echo esc_attr( $board_code ); ?>" />
        </p>
<?php
    }

    public function update( $new_instance, $old_instance ) {
        // 위젯 옵션을 저장할 때 처리한다. 
        $instance = $old_instance;
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['board_code'] = ( ! empty( $new_instance['board_code'] ) ) ? strip_tags( $new_instance['board_code'] ) : '';

        return $instance;
    }



}

function kboard_latest_widget() {
    register_widget( 'Kboard_Latest_Widget' );
}

add_action( 'widgets_init', 'kboard_latest_widget' );
?>
