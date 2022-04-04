<?php
/*
Plugin Name: WP Book Plugin
Plugin URI: http://localhost/WordPress/
Description: This is my Book Plugin for WordPress
Author: Tejas Patle
Author URI: http://localhost/WordPress/
Version: 1.0
*/

function register_custom_post_type_books(){

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

add_action('init', 'register_custom_post_type_books');
    

function register_custom_heirarchical_taxonomy_book_catagery() {

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
    
add_action('init', 'register_custom_heirarchical_taxonomy_book_catagery', 0);


 
function register_nonhierarchical_taxonomy_book_tag() {

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

add_action('init', 'register_nonhierarchical_taxonomy_book_tag', 0 );



//adding meta box for books 

function book_meta_fields() {
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

function add_book_meta_box() {
    add_meta_box("book-meta-box", 'Book Meta Box', 'book_meta_fields', 'book');
}

add_action('add_meta_boxes', 'add_book_meta_box');


function save_meta_data_book($post_id) {

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

add_action('save_post', 'save_meta_data_book');