<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/modals/modals.css?ver=1616599710169">
<div class="modals">
	<div class="modal --xs" id="modal-buy">
		<div class="modal__close popup-btn-close">
			<svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 24 24">
				<path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"></path>
			</svg>
		</div>
		<div class="modal__wrap">
			<div class="modal__title"><?php esc_html_e('Купить советник', 'govpsfx') ?></div>
			<div class="modal__form">
				<?= do_shortcode('[contact-form-7 id="25034" title="Купить советника"]') ?>
			</div>
		</div>
	</div>
	<div class="modal --xs" id="modal-get-free">
		<div class="modal__close popup-btn-close">
			<svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 24 24">
				<path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"></path>
			</svg>
		</div>
		<div class="modal__wrap">
			<div class="modal__title"><?php esc_html_e('Получить бесплатно', 'govpsfx') ?></div>
			<div class="modal__form">
				<?= do_shortcode('[contact-form-7 id="25033" title="Получить советника"]') ?>
			</div>
		</div>
	</div>
	<div class="modal --xs" id="modal-feedback">
		<div class="modal__close popup-btn-close">
			<svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 24 24">
				<path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"></path>
			</svg>
		</div>
		<div class="modal__wrap">
			<div class="modal__title"><?php esc_html_e('Напишите нам, поможем', 'govpsfx') ?></div>
			<div class="modal__form">
				<?= do_shortcode('[contact-form-7 id="25035" title="Напишите нам"]') ?>
			</div>
		</div>
	</div>
</div>