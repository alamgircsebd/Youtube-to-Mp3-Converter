<?php

$id		= $_GET['videoid'];
$ids	= explode("=", $id);

$getVideo = '<div class="well">
	<h3 class="download-heading">Youtube Downloader Results</h3>
	<hr />
	<div id="info">';
	if ($this->get('show_thumbnail') === true) {
		$getVideo .= '<a href="'.$this->get('thumbnail_anchor').'" target="_blank"><img src="'.$this->get('thumbnail_src').'" border="0" hspace="2" vspace="2"></a>';
	}
	$getVideo .= '<p>'.$this->get('video_title').'</p></div>';
	if ($this->get('no_stream_map_found', false) === true) {
		$getVideo .= '<p>No encoded format stream found.</p>
		<p>Here is what we got from YouTube:</p>
		<pre>'.$this->get('no_stream_map_found_dump').'</pre>';
	}
	else {
		if ($this->get('show_debug1', false) === true) {
			$getVideo .= '<pre>'.$this->get('debug1').'</pre>';
		}
		if ($this->get('show_debug2', false) === true) {
			$getVideo .= '<p>These links will expire at '.$this->get('debug2_expires').'</p>
			<p>The server was at IP address '.$this->get('debug2_ip').' which is an '.$this->get('debug2ipbits').' bit IP address. Note that when 8 bit IP addresses are used, the download links may fail.</p>';
		}
		$getVideo .= '<h3>List of available formats for download</h3>
		<ul class="dl-list">';
		foreach($this->get('streams', []) as $format) {
			if ($format['size'] != 0){
				$getVideo .= '<li>
					<a class="btn btn-default btn-type disabled" href="#">'.$format['type'].' - '.$format['quality'].'</a>';
				if ($format['show_direct_url'] === true) {
					$getVideo .= '<a class="btn btn-default btn-download" href="'.$format['direct_url'].'" class="mime"><i class="glyphicon glyphicon-download-alt"></i> Direct</a>';
				}
				if ($format['show_proxy_url'] === true) {
					$getVideo .= '<a class="btn btn-primary btn-download" href="'.$format['proxy_url'].'" class="mime"><i class="glyphicon glyphicon-download-alt"></i> Proxy</a>';
				}
				$getVideo .= '<div class="label label-warning">'.$format['size'].'</div>
				<div class="label label-default">'.$format['itag'].'</div>
			</li>';
			}
			else
				$getVideo .= '<a class="btn btn-danger btn-block" href="#" onclick="location.reload();"><i class="glyphicon glyphicon-refresh"></i> Retry</a>';
		}
		$getVideo .= '</ul>
		<hr />
		<h3>Separated video and audio format</h3>
		<ul class="dl-list">';
		foreach($this->get('formats', []) as $format) {
			if ($format['size'] != 0){
				$getVideo .= '<li>
					<a class="btn btn-default btn-type disabled" href="#">'.$format['type'].' - '.$format['quality'].'</a>';
				if ($format['show_direct_url'] === true) {
					$getVideo .= '<a class="btn btn-default btn-download" href="'.$format['direct_url'].'" class="mime"><i class="glyphicon glyphicon-download-alt"></i> Direct</a>';
				}
				if ($format['show_proxy_url'] === true) {
					$getVideo .= '<a class="btn btn-primary btn-download" href="'.$format['proxy_url'].'" class="mime"><i class="glyphicon glyphicon-download-alt"></i> Proxy</a>';
				}
				$getVideo .= '<div class="label label-warning">'.$format['size'].'</div>
					<div class="label label-default">'.$format['itag'].'</div>
				</li>';
			}
			else
				$getVideo .= '<a class="btn btn-danger btn-block" href="#" onclick="location.reload();"><i class="glyphicon glyphicon-refresh"></i> Retry</a>';
		}
		$getVideo .= '</ul>';
		if ($this->get('showMP3Download', false) === true) {
			$getVideo .= '<h3>Convert and Download to .mp3</h3>
				<ul class="dl-list">
					<li>
						<a class="btn btn-default btn-type disabled" href="#" class="mime" style="color:#000 !important;">audio/mp3 - '.$this->get('mp3_download_quality').'</a>
						<a class="btn btn-primary btn-download" style="color:#fff !important;" href="'.site_url().'/youtube-video-to-mp3-download?id='.$ids[1].'" class="mime"><i class="glyphicon glyphicon-download-alt"></i> Convert and Download</a>
					</li>
				</ul>';
		}
		$getVideo .= '<hr />
		<p><small>Note that you initiate download either by clicking "Direct" to download from the origin server or by clicking "Proxy" to use this server as proxy.</small></p>';
		if ($this->get('showBrowserExtensions', false) === true) {
			$getVideo .= '<p><a href="ytdl.user.js" class="userscript btn btn-mini" title="Install chrome extension to view a Download link to this application on Youtube video pages."> Install Chrome Extension </a></p>';
		}
	}
	$getVideo .= '<hr />
		
			<div class="clearfix"></div>
	</div>';

	echo $getVideo;
?>
