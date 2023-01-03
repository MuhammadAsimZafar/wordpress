<?php

/* This is a global array of translation strings on front-end */

//todo: check translate strings

global $pinhole_translate;

$pinhole_translate = array(
	'no_comments' => array( 'text' => esc_html__( 'Add comment', 'pinhole' ), 'desc' => 'Comment meta data (if zero comments)' ),
	'one_comment' => array( 'text' => esc_html__( '1 comment', 'pinhole' ), 'desc' => 'Comment meta data (if 1 comment)' ),
	'multiple_comments' => array( 'text' => esc_html__( '% comments', 'pinhole' ), 'desc' => 'Comment meta data (if more than 1 comments)' ),
	'min_read' => array( 'text' => esc_html__( 'Min read', 'pinhole' ), 'desc' => 'Used in post meta data (reading time)' ),
	'by' => array( 'text' => esc_html__( 'By', 'pinhole' ), 'desc' => 'Used in post meta data (before author)' ),
	'galleries' => array( 'text' => esc_html__( 'Galleries', 'pinhole' ), 'desc' => 'Label for album page meta data' ),
	'photos' => array( 'text' => esc_html__( 'Photos', 'pinhole' ), 'desc' => 'Label for gallery page meta data' ),
	'photo' => array( 'text' => esc_html__( 'Photo', 'pinhole' ), 'desc' => 'Label for gallery page meta data (if 1 photo)' ),
	'camera' => array( 'text' => esc_html__( 'Camera', 'pinhole' ), 'desc' => 'Camera label for image meta data' ),
	'aperture' => array( 'text' => esc_html__( 'Aperture', 'pinhole' ), 'desc' => 'Aperture label for image meta data' ),
	'shutter_speed' => array( 'text' => esc_html__( 'Shutter speed', 'pinhole' ), 'desc' => 'Shutter speed label for image meta data' ),
	'focal_length' => array( 'text' => esc_html__( 'Focal length', 'pinhole' ), 'desc' => 'Focal length label for image meta data' ),
    'credit' => array('text' => esc_html__('Credit', 'pinhole'), 'desc' => 'Credit label for image meta data'),
    'copyright' => array('text' => esc_html__('Copyright', 'pinhole'), 'desc' => 'Copyright label for image meta data'),
	'newer_entries' => array('text' => esc_html__('Newer Entries', 'pinhole'), 'desc' => 'Pagination (prev/next) link text'),
	'older_entries' => array('text' => esc_html__('Older Entries', 'pinhole'), 'desc' => 'Pagination (prev/next) link text'),
	'previous_posts' => array('text' => esc_html__('Previous', 'pinhole'), 'desc' => 'Pagination (numeric) link text'),
	'next_posts' => array('text' => esc_html__('Next', 'pinhole'), 'desc' => 'Pagination (numeric) link text'),
	'load_more' => array('text' => esc_html__('Load More', 'pinhole'), 'desc' => 'Pagination (load more) link text'),
	'previous_post' => array('text' => esc_html__('Previous post', 'pinhole'), 'desc' => 'Previous post label on sticky bottom bar for single posts'),
	'next_post' => array('text' => esc_html__('Next post', 'pinhole'), 'desc' => 'Next post label on sticky bottom bar for single posts'),
	'previous_gallery' => array('text' => esc_html__('Previous gallery', 'pinhole'), 'desc' => 'Previous gallery label on sticky bottom bar for gallery pages'),
	'next_gallery' => array('text' => esc_html__('Next gallery', 'pinhole'), 'desc' => 'Next gallery label on sticky bottom bar for gallery pages'),
	'category' => array('text' => esc_html__('Category - ', 'pinhole'), 'desc' => 'Category archive title prefix'),
	'tag' => array('text' => esc_html__('Tag - ', 'pinhole'), 'desc' => 'Tag archive title prefix'),
	'author' => array('text' => esc_html__('Author - ', 'pinhole'), 'desc' => 'Author archive title prefix'),
	'archive' => array('text' => esc_html__('Archive - ', 'pinhole'), 'desc' => 'Archive title prefix'),
	'view_all' => array('text' => esc_html__('All posts', 'pinhole'), 'desc' => 'View all posts link text in author box'),
	'menu' => array('text' => esc_html__('Menu', 'pinhole'), 'desc' => 'Menu label on mobile navigation'),
	'follow_me' => array('text' => esc_html__('Follow me', 'pinhole'), 'desc' => 'Social icons label on mobile navigation'),
	'search_results_for' => array('text' => esc_html__('Search results for - ', 'pinhole'), 'desc' => 'Title for search results template'),
	'search_placeholder' => array('text' => esc_html__('Type here to search...', 'pinhole'), 'desc' => 'Search placeholder text'),
	'search_button' => array('text' => esc_html__('Search', 'pinhole'), 'desc' => 'Search button text'),
	'comment_submit' => array('text' => esc_html__('Submit Comment', 'pinhole'), 'desc' => 'Comment form submit button label'),
	'comment_reply' => array('text' => esc_html__('Reply', 'pinhole'), 'desc' => 'Comment reply label'),
	'comment_text' => array('text' => esc_html__('Comment', 'pinhole'), 'desc' => 'Comment form text area label'),
	'comment_email' => array('text' => esc_html__('Email', 'pinhole'), 'desc' => 'Comment form email label'),
	'comment_name' => array('text' => esc_html__('Name', 'pinhole'), 'desc' => 'Comment form name label'),
	'comment_website' => array('text' => esc_html__('Website', 'pinhole'), 'desc' => 'Comment form website label'),
	'comment_cookie_gdpr' => array('text' => esc_html__('Save my name, email, and website in this browser for the next time I comment.', 'pinhole'), 'desc' => 'Comment GDPR cookie label'),
	'comment_cancel_reply' => array('text' => esc_html__('Cancel reply', 'pinhole'), 'desc' => 'Comment cancel reply label'),
	'protected_text' => array('text' => esc_html__('This gallery is password protected. To view it please enter your password below:', 'pinhole'), 'desc' => 'Protected gallery text'),
	'protected_submit' => array('text' => esc_html__('View gallery', 'pinhole'), 'desc' => 'Protected gallery submit button label'),
	'protected_password' => array('text' => esc_html__('Gallery password', 'pinhole'), 'desc' => 'Protected gallery password label'),
	'download' => array('text' => esc_html__('Download', 'pinhole'), 'desc' => 'Download button label'),
	'404_title' => array('text' => esc_html__('Page not found', 'pinhole'), 'desc' => '404 page title'),
	'404_text' => array('text' => esc_html__('The page that you are looking for does not exist on this website. You may have accidentally mistype the page address, or followed an expired link. Anyway, we will help you get back on track. Why not try to search for the page you were looking for:', 'pinhole'), 'desc' => '404 page text'),
	'content_none' => array('text' => esc_html__('Sorry, there are no posts found on this page. Feel free to contact website administrator regarding this issue.', 'pinhole'), 'desc' => 'Message when there are no posts on archive pages. i.e Empty Category')
);

?>