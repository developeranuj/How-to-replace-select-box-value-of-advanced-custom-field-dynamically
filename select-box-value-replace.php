<?php 
function acf_load_course_field_choices( $field ) {

$array = array();

$courses = get_posts( array( 'post_type' => 'courses', 'posts_par_page'=> -1,  'numberposts'=>-1) ); 
foreach ($courses as $course):
    $array[] = $course->post_title; 
endforeach; 
    // reset choices
    $field['choices'] = $array;

    // if has rows
    if( have_rows('my_select_values', 'option') ) {
        
        // while has rows
        while( have_rows('my_select_values', 'option') ) {
            
            // instantiate row
            the_row();
            
            
            // vars
            $value = get_sub_field('value');
            $label = get_sub_field('label');

            
            // append to choices
            $field['choices'][ $value ] = $label;
            
        }
        
    }


    // return the field
    return $field;
    
}

add_filter('acf/load_field/name=courses', 'acf_load_course_field_choices');

?>