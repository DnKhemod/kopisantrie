/**
 * Media picker dan pengurutan galeri.
 */
( () => {
	const input = document.querySelector( '[data-gallery-input]' );
	const list = document.querySelector( '[data-gallery-list]' );
	const addButton = document.querySelector( '[data-gallery-add]' );
	const empty = document.querySelector( '[data-gallery-empty]' );

	if ( ! input || ! list || ! addButton ) {
		return;
	}

	const sync = () => {
		const ids = Array.from( list.querySelectorAll( '[data-id]' ) ).map(
			( item ) => item.dataset.id
		);

		input.value = ids.join( ',' );

		if ( empty ) {
			empty.toggleAttribute( 'hidden', ids.length > 0 );
		}
	};

	let frame = null;

	addButton.addEventListener( 'click', () => {
		if ( ! window.wp || ! window.wp.media ) {
			return;
		}

		if ( ! frame ) {
			frame = window.wp.media( {
				title: 'Pilih Foto Galeri',
				button: { text: 'Tambahkan ke Galeri' },
				library: { type: 'image' },
				multiple: true,
			} );

			frame.on( 'select', () => {
				frame.state().get( 'selection' ).each( ( attachment ) => {
					const data = attachment.toJSON();

					if ( ! data.id || list.querySelector( `[data-id="${ data.id }"]` ) ) {
						return;
					}

					const item = document.createElement( 'li' );
					item.dataset.id = String( data.id );

					const image = document.createElement( 'img' );
					image.className = 'is-gallery__thumb';
					image.src =
						data.sizes && data.sizes.thumbnail
							? data.sizes.thumbnail.url
							: data.url;
					image.alt = data.alt || '';

					const actions = document.createElement( 'div' );
					actions.className = 'is-gallery__actions';
					actions.innerHTML =
						'<button type="button" class="button" data-move="up">Naik</button>' +
						'<button type="button" class="button" data-move="down">Turun</button>' +
						'<button type="button" class="button button-link-delete" data-remove>Hapus</button>';

					const title = data.title || 'foto';
					const buttons = actions.querySelectorAll( 'button' );
					buttons.forEach( ( button ) => {
						const action = button.hasAttribute( 'data-remove' )
							? 'Hapus'
							: 'up' === button.dataset.move
								? 'Naik'
								: 'Turun';

						button.setAttribute( 'aria-label', `${ action }: ${ title }` );
					} );

					item.append( image, actions );
					list.appendChild( item );
				} );

				sync();
			} );
		}

		frame.open();
	} );

	list.addEventListener( 'click', ( event ) => {
		const button = event.target.closest( 'button' );
		const item = button ? button.closest( '[data-id]' ) : null;

		if ( ! button || ! item ) {
			return;
		}

		if ( button.hasAttribute( 'data-remove' ) ) {
			item.remove();
		} else if ( 'up' === button.dataset.move ) {
			const previous = item.previousElementSibling;

			if ( previous ) {
				list.insertBefore( item, previous );
			}
		} else if ( 'down' === button.dataset.move ) {
			const next = item.nextElementSibling;

			if ( next ) {
				list.insertBefore( next, item );
			}
		}

		sync();
	} );

	sync();
} )();
