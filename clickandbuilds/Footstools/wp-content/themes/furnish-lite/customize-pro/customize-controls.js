( function( api ) {

	// Extends our custom "furnish-lite" section.
	api.sectionConstructor['furnish-lite'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );