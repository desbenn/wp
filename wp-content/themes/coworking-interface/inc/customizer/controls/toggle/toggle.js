// Toggle control
wp.customize.controlConstructor[ 'coworking-interface-toggle' ] = wp.customize.Control.extend({
	ready: function() {
		"use strict";

		var control = this;

		// Change the value
		control.container.on( 'click', '.coworking-interface-toggle-switch', function() {
			control.setting.set( ! control.setting.get() );
		});
	}
});