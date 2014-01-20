<?php
/**
 * Function for getting bacon ipsum with Alfred 2.
 * 
 * @package Bacon Ipsum
 * @author Justin Kopepasah
 * @version 1.1.0
*/

function get_bacon( $query ) {
	/**
	 * Create the new workflow instance.
	 * 
	 * @since 1.0.0
	*/
	$workflow = new Workflows();
	
	/**
	 * Convert query to an array by using spaces as
	 * the delimiter and then remove any empty values.
	 * 
	 * @since 1.0.0
	*/
	$query = array_filter( explode( ' ', $query ) );
	
	/**
	 * Set the parameters array.
	 * 
	 * @since 1.0.0
	*/
	$params = array();
	
	/**
	 * Get number paragraphs based on parameter one.
	 * Check if parameter one is set, if not default
	 * five paragraphs.
	 * 
	 * @since 1.0.0
	*/
	$params['paras'] = ( ! isset( $query[0] ) ) ? 5 : $query[0];
	
	
	
	/**
	 * If the tag is and ordered or unordered list,
	 * convert the number of paragraphs to sentences.
	 * 
	 * @since 1.0.0
	*/
	if ( in_array( $query[1], array( 'ol', 'ul', 's' ) ) ) {
		$params['sentences'] = $query[0];
	}
	
	/**
	 * Set the type of ipsum desired. If no parameter
	 * is set, default to 'all meat'.
	 * 
	 * @since 1.0.0
	*/
	$params['type'] = ( !isset($query[2])) ? 'all-meat' : $query[2];
	
	/**
	 * Build the query string used in the Bacon Ipsum
	 * API.
	 * 
	 * @since 1.0.0
	*/
	$params = http_build_query( $params );
	
	/**
	 * Get the API URL.
	 * 
	 * @since 1.0.0
	*/
	$url = 'http://baconipsum.com/api/?';
	
	/**
	 * Get JSON result and convert to an array.
	 * 
	 * @since 1.0.0
	*/
	$data = json_decode( $workflow->request( $url . $params ), true );
	
	/**
	 * Set the output variable.
	 * 
	 * @since 1.0.0
	*/
	$output = '';
	
	/**
	 * Run the loop based on the data to get our
	 * bacon.
	 * 
	 * @since 1.0.0
	*/
	$count = 1;
	
	if ( 's' == $query[1] ) {
		foreach ( $data as $sentence ) {
			$output .= "$sentence";
		}
	} else {
		foreach ( $data as $paragraph ) {
			if ( in_array( $query[1], array( 'ol', 'ul' ) ) ) {
			
				$lists = explode( '. ', $paragraph );
			
				$output .= "<$query[1]>\n";
			
				foreach ( $lists as $list ) {
					$output .= "    <li>$list.</li>\n";
				}
			
				$output .= "</$query[1]>\n";
				
		    } elseif ( $query[1] == 'p' ) {
				if ( $count >= $query[0] ) {
					$output .= "<p>$paragraph</p>";
				} else {
					$output .= "<p>$paragraph</p>\n\n";
				}
		    } elseif ( preg_match( '/h/', $query[1] ) ) {
				if ( $count >= 2 )
					break;
			
				$paragraph = ucwords( str_replace( array( '.', ',' ), '' , $paragraph ) );
			
				$words = explode( ' ', $paragraph );
				
				$counter = 0;
			
				$header = array();
			
				foreach ( $words as $word ) {
					if ( $counter >= $query[0] ) 
					    break;
				
					$counter++;
				
					$header[] = $word;
				}
			
				$header = implode( ' ', $header );
			
				$output .= "<$query[1]>$header</$query[1]>";
			} else {
				if ( $count >= $query[0] ) {
					$output .= "$paragraph";
				} else {
					$output .= "$paragraph\n\n";
				}
			}
		
			$count++;
		}
	}
	
	/**
	 * Create and store the bacon.
	 * 
	 * @since 1.0.0
	*/
	$workflow->result( '', $output, 'Your Bacon: ' . $output, 'Press Return to copy to clipboard', 'icon.png' );
	
	/**
	 * Echo the bacon.
	 * 
	 * @since 1.0.0
	*/
	echo $workflow->toxml();
}

