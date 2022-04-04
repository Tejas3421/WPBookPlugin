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
    
    $options = array(
        'labels' => $labels,
        'public'=> true,
        'rewrite'=>array('slug'=>'books'),
        'taxonomies'=> array('book-catagory')
    );
    
    register_post_type( "Book", $options);
}

add_action( 'init', 'register_custom_post_type_books');
    

function register_custom_custom_taxonomy_book_catagery(){

    $labels=array(
        'name'=>'Books Catagory',
        'singular-name'=>'Book Catagory'
    );
    
    $options = array(
        'labels' => $labels,
        'hierarchical'=> true,
        'rewrite'=>array('slug'=>'book-catagory')
    );
    
    register_taxonomy( 'book-catagory', array('books'), $options);

}
    
add_action( 'init', 'register_custom_custom_taxonomy_book_catagery');
