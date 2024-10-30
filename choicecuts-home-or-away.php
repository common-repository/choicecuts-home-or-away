<?php
/*
Plugin Name: ChoiceCuts Home or Away
Plugin URI: http://www.workwithchoicecuts.com
Version: 1.0
Author: Ian Huet http://www.workwithchoicecuts.com
Description: ChoiceCuts Home or Away simply identifies all links within post_content and checks if they are external links. If an external link is found then CSS class hook 'external' is automatically inserted.
License: GPL2
*/


function ccHOA_linkFilter( $content )
{
	// detect the content encoding and apply the appropriate charset identifier
	if (!empty($content)) {
		if (empty($encod))
			$encod  = mb_detect_encoding($content);
			$headpos = mb_strpos($content,'<head>');
		if (FALSE=== $headpos)
			$headpos= mb_strpos($content,'<HEAD>');
		if (FALSE!== $headpos) {
			$headpos+=6;
			$content = mb_substr($content,0,$headpos) . '<meta http-equiv="Content-Type" content="text/html; charset='.$encod.'">' .mb_substr($content,$headpos);
		}
		$content = mb_convert_encoding($content, 'HTML-ENTITIES', $encod);
	}


	// import content into DOMDoc for traversing, finding & manipulating tags
	$doc = new DOMDocument();
	@ $doc->loadHTML( $content );
	
	// find all links within passed content
	$xpath = new DOMXPath( $doc );
	$query = "//a";
	@ $links = $xpath->query( $query );


	// process all links
	if ($links->length > 0) 
	{
		foreach ($links as $link)
		{

			// is this link internal
			$href = $link->getAttribute('href');
			$local = get_bloginfo('url');
			$internal = strpos( $href, $local );
			if ( $internal === FALSE )
			{

				// if the child node is not an image
				$nextNode = $link->getElementsByTagName('img');
				if ( $nextNode->length == 0 )
				{

					// does the node already have a CLASS attribute
					if ( $link->hasAttribute( 'class' ))
					{

						// if the existing CLASS attribute doesn't already contain 'external'
						$class = $link->getAttribute( 'class' );
						$pos = strpos( 'external', $class );
						if (! $pos === FALSE ) {
							$class = $class.' external';
							$link->removeAttribute( 'class' );
							$link->setAttribute( 'class', $class );
						}
					}
					else {
						$link->setAttribute( 'class', 'external' );
					}
				}
			}
		}
	}

	$content = preg_replace('/^<!DOCTYPE.+?>/', '', str_replace( array('<html>', '</html>', '<body>', '</body>'), array('', '', '', ''), $doc->saveHTML()));
	return $content;
}

add_filter( 'the_content', 'ccHOA_linkFilter', 50 );
add_filter( 'comment_text', 'ccHOA_linkFilter' );


?>