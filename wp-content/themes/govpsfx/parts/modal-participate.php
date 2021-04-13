<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/participate/participate.css?ver=1617096443247">
<div class="modal --sm --black" id="modal-contest">
	<div class="modal__close popup-btn-close">
		<svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 24 24">
			<path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"></path>
		</svg>
	</div>
	<div class="modal__wrap participate">
		<?= do_shortcode(get_field('raffle_form_participants', $participateID)); ?>
	</div>
</div>