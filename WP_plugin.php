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