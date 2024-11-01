<?php

// Tab Title
function tab_title_view($content) { ?>
	<div class="tab-name">
		<h1><?php echo esc_html($content); ?></h1>
	</div>
<?php }

// Tab Avatar
function tab_avatar_view($content) { ?>
	<div class="tab-avatar">
		<?php echo wp_get_attachment_image( $content, 'full' ); ?>
	</div>
<?php }

// Tab Job
function tab_subtitle_view($content) { ?>
	<div class="tab-job">
		<span><?php echo esc_html($content); ?></span>
	</div>
<?php }

// Tab Bio
function tab_bio_view($content) { ?>
	<div class="tab-bio">
		<p><?php echo wp_specialchars_decode($content); ?></p>
	</div>
<?php }