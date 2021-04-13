<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package govpsfx
 */

?>

		</main>
		<?php
			include 'parts/footer.php';
			include 'parts/modals.php';
		?>

<?php if (!isPSI()) : ?>
		<script src="<?= TEMP() ?>_/components/input/input.js?ver=1616599710170"></script>
		<script src="<?= TEMP() ?>_/components/check/check.js?ver=1616599710170"></script>
		<script src="<?= TEMP() ?>_/components/select/select.js?ver=1616599710170"></script>
		<script src="<?= TEMP() ?>_/components/tabs/tabs.js?ver=1616599710170"></script>
		<script src="<?= TEMP() ?>_/components/popup/popup.js?ver=1616599710170"></script>
		<script src="<?= TEMP() ?>_/components/slider/slider.js?ver=1616599710170"></script>
		<script src="<?= TEMP() ?>_/components/tog/tog.js?ver=1616599710170"></script>

	</div>



<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
  jQuery(function ($) {
    $(document).ready(function() {
      setTimeout(function(){
        (function(){ var widget_id = '77U5b5IEbX';
          var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);})();
        }, 4000);
    });
  });
</script>
<!-- {/literal} END JIVOSITE CODE --> 

<noscript><div style="position:absolute;left:-10000px;">
  <img src="//top-fwz1.mail.ru/counter?id=2822467;js=na" style="border:0;" height="1" width="1" alt="" />
</div></noscript>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N888T4Z"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->



<?php wp_footer(); ?>
<?php endif; ?>
</body>
</html>
