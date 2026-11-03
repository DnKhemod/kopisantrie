/**
 * Repeater varian dan add-on pada layar produk.
 */
( () => {
	document.querySelectorAll( '[data-repeater]' ).forEach( ( repeater ) => {
		const key = repeater.dataset.repeater;
		const rows = repeater.querySelector( '[data-rows]' );
		const template = repeater.querySelector( 'template[data-template]' );
		const addButton = repeater.querySelector( '[data-add]' );

		if ( ! key || ! rows || ! template || ! addButton ) {
			return;
		}

		let nextIndex = Date.now();

		addButton.addEventListener( 'click', () => {
			const fragment = template.content.cloneNode( true );
			const row = fragment.querySelector( '[data-row]' );

			row.querySelectorAll( '[data-field]' ).forEach( ( input ) => {
				input.name = `irama_santri_${ key }[${ nextIndex }][${ input.dataset.field }]`;
				input.value = '';
			} );

			nextIndex += 1;
			rows.appendChild( fragment );
			row.querySelector( 'input' )?.focus();
		} );

		rows.addEventListener( 'click', ( event ) => {
			const button = event.target.closest( '[data-remove]' );

			if ( ! button ) {
				return;
			}

			button.closest( '[data-row]' )?.remove();
		} );
	} );
} )();
