<?php
    $tabs = carbon_get_post_meta( get_the_ID(), 'tab_items' ); 
	$animated = carbon_get_post_meta( get_the_ID(), 'tab_content_animated' );
?>
<div class="tab-awesome tab-post-<?php echo esc_attr(get_the_ID()); ?>">
	<div class="style-empat">
		<div class="tabs bg-color-tab tabs-style-linetriangle">
			<nav>
				<ul>
				<?php $noid=0; foreach ($tabs as $tab) { $noid++; ?>
					<li><a href="#section-linetriangle-<?php echo esc_attr($noid); ?>"><span class="title-tab"> <?php echo esc_html($tab['tab_item_name']) ?></span></a></li>
					<?php } ?>
				</ul>
			</nav>
			<div class="content-wrap clearfix">
			<?php $noid=0; foreach ($tabs as $tab2) { $noid++; ?>
				<section id="section-linetriangle-<?php echo esc_attr($noid); ?>">
					<div class="tab-content animated <?php echo esc_attr($animated); ?>"><?php echo wp_specialchars_decode($tab2['tab_item_desc']); ?></div>
				</section>
			<?php } ?>
			</div>
		</div>
	</div>
</div>
<script>
    ;( function( window ) {
	
	'use strict';

	function extend( a, b ) {
		for( var key in b ) { 
			if( b.hasOwnProperty( key ) ) {
				a[key] = b[key];
			}
		}
		return a;
	}

	function CBPFWTabs( el, options ) {
		this.el = el;
		this.options = extend( {}, this.options );
  		extend( this.options, options );
  		this._init();
	}

	CBPFWTabs.prototype.options = {
		start : 0
	};

	CBPFWTabs.prototype._init = function() {
		// tabs elems
		this.tabs = [].slice.call( this.el.querySelectorAll( 'nav > ul > li' ) );
		// content items
		this.items = [].slice.call( this.el.querySelectorAll( '.content-wrap > section' ) );
		// current index
		this.current = -1;
		// show current content item
		this._show();
		// init events
		this._initEvents();
	};

	CBPFWTabs.prototype._initEvents = function() {
		var self = this;
		this.tabs.forEach( function( tab, idx ) {
			tab.addEventListener( 'click', function( ev ) {
				ev.preventDefault();
				self._show( idx );
			} );
		} );
	};

	CBPFWTabs.prototype._show = function( idx ) {
		if( this.current >= 0 ) {
			this.tabs[ this.current ].className = this.items[ this.current ].className = '';
		}
		// change current
		this.current = idx != undefined ? idx : this.options.start >= 0 && this.options.start < this.items.length ? this.options.start : 0;
		this.tabs[ this.current ].className = 'tab-current';
		this.items[ this.current ].className = 'content-current';
	};

	// add to global namespace
	window.CBPFWTabs = CBPFWTabs;

})( window );
    (function() {

        [].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
            new CBPFWTabs( el );
        });

    })();
</script>