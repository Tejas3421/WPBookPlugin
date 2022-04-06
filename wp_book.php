<?php
/** 
Plugin Name: WP Book Plugin
Plugin URI: http://localhost/WordPress/
Description: This is my Book Plugin for WordPress
Author: Tejas Patle
Author URI: http://localhost/WordPress/
Version: 1.0 
 *******************/

function Register_Custom_Post_Type_books()
{

    $labels= array(
        'name'=>'Books',
        'singular-name'=>'Book'
    );
    
    $supports= array('title','editor','thumbnail','comments','excerpts');
        
    $options = array(
        'labels' => $labels,
        'public'=> true,
        'rewrite'=>array('slug'=>'books'),
        'supports'=>$supports,
        'taxonomies'=> array('book-catagory','book-tag')
    );

    register_post_type( "Book", $options);
}

add_action('init', 'Register_Custom_Post_Type_books');
    

/**
 *  Created custom hierarchical taxonomy 
 * **/
function Register_Custom_Hierarchical_Taxonomy_Book_catagery() {

    $labels=array(
        'name'=>'Books Catagories',
        'singular-name'=>'Book Catagory'
    );
    
    $options = array(
        'labels' => $labels,
        'hierarchical'=> true,
        'rewrite'=> array('slug' => 'book-catagory'),
        'show_admin_column'=>true
    );
    
    register_taxonomy('book-catagory', array('books'), $options);
}
    
add_action('init', 'Register_Custom_Hierarchical_Taxonomy_Book_catagery', 0);


/**
 * Cretaing no hierarchical taxonomy 
 *
 * @return void
 */
function Register_Non_Hierarchical_Taxonomy_Book_tag() {

    $labels = array(
        'name' => 'Book Tags',
        'singular_name' =>  'Book Tag',
        'parent_item' => null,
        'parent_item_colon' => null,
        'public'=> true
    ); 

    $options=array(
        'hierarchical' => false,
        'labels' => $labels,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'rewrite' => array( 'slug' => 'book-tag' ),
    );

    register_taxonomy('book-tag', 'books', $options);
}   

add_action('init', 'Register_Non_Hierarchical_Taxonomy_Book_tag', 0);


/**
 * Creating fields for Book 
 */
function Book_Meta_fields() 
{
    ?>
    <div>  
        
        <label for='author-first-name'>Author First Name :</label>
        <input id='author-first-name' type='text' value='<?php echo get_post_meta(get_the_ID(), 'Author First Name', true); ?>' name='author-first-name' ><br>
        <label for='author-lirst-name'>Author Last Name :</label>
        <input id='author-last-name' type='text' value='<?php echo get_post_meta(get_the_ID(), 'Author Last Name', true); ?>' name='author-last-name' ><br>
        <label for='book-price'>Price :</label>
        <input id='book-price' type='Integer' name='book-price' value='<?php echo get_post_meta(get_the_ID(), 'Book Price', true); ?>'><br>
        <label for='book-publisher'>Publisher :</label>
        <input id='book-publisher' type='text' name='book-publisher' value='<?php echo get_post_meta(get_the_ID(), 'Book Publisher', true); ?>'><br>
        <label for='published-year'>Year :</label>
        <input id='published-year' type='text' name='published-year' value='<?php echo get_post_meta(get_the_ID(), 'Published year', true); ?>'>  <br>
        <label for='edition'>Edition :</label>
        <input  id='edition' type='text' name='edition' value='<?php echo get_post_meta(get_the_ID(), 'Edition', true); ?>'><br>
        <label for='book-url'>URL :</label>
        <input  id='book-url' type='text' name='book-url' value='<?php echo get_post_meta(get_the_ID(), 'Book URL', true); ?>'><br>

    </div>
    <?php
}


/**
 * Creating  Meta Box For Books
 *
 * @return void
 */
function Add_Book_Meta_box() 
{
    add_meta_box("book-meta-box", 'Book Meta Box', 'Book_Meta_fields', 'book');
}

add_action('add_meta_boxes', 'Add_Book_Meta_box');


/**
 * Saving the data in post meta table
 * 
 * @return void
 */
function Save_Meta_Data_book($post_id) {

    //Save data for author first name
    $field_data = $_POST['author-first-name'];
    if(isset($_POST['author-first-name'])) {
        if(get_post_meta($post_id, 'Author First Name', true) != '') {
            update_post_meta($post_id, 'Author First Name', $field_data);
        }
        else {
            add_post_meta($post_id, 'Author First Name', $field_data);   
        }
    }

    //Save data for author last name
    $field_data = $_POST['author-last-name'];
    if(isset($_POST['author-last-name'])) {
        if(get_post_meta($post_id, 'Author Last Name', true) != '') {
            update_post_meta($post_id, 'Author Last Name', $field_data);
        }
        else {
            add_post_meta($post_id, 'Author Last Name', $field_data);   
        }
    }

    //save meta data for Book Price
    $field_data = $_POST['book-price'];
    if(isset($_POST['book-price'])) {
        if(get_post_meta($post_id, 'Book Price', true) != '') {
            update_post_meta($post_id, 'Book Price', $field_data);
        }
        else {
            add_post_meta($post_id, 'Book Price', $field_data);   
        }
    }

    //save meta data for book Publisher
    $field_data = $_POST['book-publisher'];
    if(isset($_POST['book-publisher'])) {
        if(get_post_meta($post_id, 'Book Publisher', true) != '') {
            update_post_meta($post_id, 'Book Publisher', $field_data);
        }
        else {
            add_post_meta($post_id, 'Book Publisher', $field_data);   
        }
    }

    //save meta data for Publisherd year
    $field_data = $_POST['published-year'];
    if(isset($_POST['published-year'])) {
        if(get_post_meta($post_id, 'Published year', true) != '') {
            update_post_meta($post_id, 'Published year', $field_data);
        }
        else {
            add_post_meta($post_id, 'Published year', $field_data);   
        }
    }

    //save meta data for Edition 
    $field_data = $_POST['edition'];
    if(isset($_POST['edition'])) {
        if(get_post_meta($post_id, 'Edition', true) != '') {
            update_post_meta($post_id, 'Edition', $field_data);
        }
        else {
            add_post_meta($post_id, 'Edition', $field_data);   
        }
    }

    //save meta data for book URl
    $field_data = $_POST['book-url'];
    if(isset($_POST['book-url'])) {
        if(get_post_meta($post_id, 'Book URL', true) != '') {
            update_post_meta($post_id, 'Book URL', $field_data);
        }
        else {
            add_post_meta($post_id, 'Book URL', $field_data);   
        }
    }
}

add_action('save_post', 'Save_Meta_Data_book');

/**
 * Creating settings page for book
 *
 * @return void
 */
function Book_Setting_Page_book()
{
    echo '<input type="submit" id="btn" name=Submit>';
    
}

/**
 * Adding a MEnu Page for Book
 *
 * @return void
 */
function Add_Menu_Page_book()
{
    add_menu_page('Books Setting', 'Books Setting', 'manage_options', 'book-setting-page', 'Book_Setting_Page_book');

    add_submenu_page('book', 'Books Setting', 'Books Setting', 'manage_options', 'book-setting-page', 'Book_Setting_Page_book');
}

add_action('admin_menu', 'Add_Menu_Page_book');


/**
 * Function to diaplaying bbok details
 */
function Display_Book_deatils($atts, $content)
{
    $atts = shortcode_atts( array(
        'id'         => 'Unknown',
        'author_name'=> 'Unknown',
        'year'       => 'Unknown',
        'catagory'   => 'Unknown',
        'tag'        => 'Unknown',
        'publisher'  => 'Unknown'
    ), 
    $atts );

    $content= add_filter('the_content', $content);

    $content.='<div>';

    $content.='ID of Book is '.$atts['id'] .'<br>';
    $content.='Author of Book is '.$atts['author_name'] .'<br>';
    $content.='Published Year of Book is '.$atts['year'] .'<br>';
    $content.='Catagory of Book is '.$atts['catagory'] .'<br>';
    $content.='Tags of Book is '.$atts['tag'] .'<br>';
    $content.='Publisher of Book is '.$atts['publisher'] .'<br>';

    $content.='</div>';

    return $content;
}

/**
 * Creating a shortcode
 */
function Shortcode_book($atts ,$content)
{
    return Display_Book_deatils($atts, $content);
}

add_shortcode('Book', 'Shortcode_book');    

/**
 * register widget
 */

function Create_Book_Catagory_widget() 
{
    register_widget('Book_Catagory_Widget');
}

add_action('widgets_init', 'Create_Book_Catagory_widget');


/**class for Widget */
class Book_Catagory_Widget extends WP_Widget 
{
    /**constructor for widget class

     */
    public function __construct()
    {
        parent::__construct(
            'book_catagory_widget', __("Book Catagory Widget"), array('description'=> __("WIdget For displaying book of same catagory"))
        );
    }

    function widget($args, $instance)
    {
        $catagory = apply_filters('widget_title', $instance['catagory']);

        echo $args['before_widget'];

        if(!empty($instance['catagory']))
        {
            echo $args['before_title']. $catagory .$args['after_title'];
        }

        echo $args['after_widget'];
    }
    //widget setting
    function form($instance)
    {
        if(isset($instance['catagory']))
        {
            $catagory= $instance['catagory'];  
        }
        else{
            $catagory = __('New Catagory');
        }

        ?>
            <div>
                <label for='<?php echo $this->get_field_id('catagory') ?>'><?php _e("Catagory") ?></label>
                <input class='widefat' type='text' id='<?php echo $this->get_field_id('catagory') ?>' name='<?php echo $this->get_field_name('catagory') ?>' value="<?php echo esc_attr($catagory); ?>" >
            </div>
        <?php
    }

    function update($new_instance, $old_instance)
    {
        $instance=array();
        $instance['catagory'] =(!empty($new_instance['catagory'])) ? strip_tags($new_instance['catagory']) : "" ; 
        return $instance; 
    }
}