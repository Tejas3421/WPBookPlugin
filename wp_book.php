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

