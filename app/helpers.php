<?php
function linkActive($link_url){
    $url = app('request')->url();
    if ($url != $link_url) {
      return "";
    }
    return "active";
}

function linksActive($link_urls){
	if(empty($link_urls)){
		return '';
	}
	foreach ($link_urls as $link_url) {
		if (linkActive($link_url) !== "") {
			return 'active';
		}
	}
	return '';
}

function folderLinkActive($link_url){
	$url = app('request')->url();
	if (strpos($url, $link_url) === false) {
		return '';
	}
	return 'active';
}

function folderLinksActive($link_urls){
	if (empty($link_urls)) {
		return '';
	}
	$url = app('request')->url();
	foreach ($link_urls as $link_url) {
		if (folderLinkActive($link_url) == 'active') {
			return 'active';
		}
	}
	return '';
}