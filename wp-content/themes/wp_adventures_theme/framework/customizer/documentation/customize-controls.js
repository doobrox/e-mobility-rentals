( function( api ) {

	// Extends our custom "example-1" section.
	api.sectionConstructor['adventures_customizer_doc'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

	// Extends our custom "example-1" section.
	api.sectionConstructor['adventures_update'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

	// Extends our custom "example-1" section.
	api.sectionConstructor['adventures_test_data'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

	// Extends our custom "example-1" section.
	api.sectionConstructor['adventures_recom_plugins'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
