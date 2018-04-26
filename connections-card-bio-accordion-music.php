<?php
/**
 * Plugin Name:       Connections Accordion Music - Template
 * Plugin URI:        http://www.chem.ufl.edu
 * Description:       This is a variation of the default template which shows the bio field for an entry.
 * Version:           1.0
 * Author:            Steven M. Kobb
 * Author URI:        http://connections-pro.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

function cn_remove_list_no_result_message4() {
    remove_action( 'cn_list_no_results', array( 'cnTemplatePart', 'noResults' ), 10 );
}

add_action( 'plugins_loaded', 'cn_remove_list_no_result_message4', 12 );


if ( ! class_exists( 'CN_Bio_Card_Accordion_Music_Template' ) ) {

	class CN_Bio_Card_Accordion_Music_Template {

		public static function register() {

			$atts = array(
				'class'       => 'CN_Bio_Card_Accordion_Music_Template',
				'name'        => 'Bio Card Accordion Music',
				'slug'        => 'card-bio-accordion-music',
				'type'        => 'all',
				'version'     => '2.0.1',
				'author'      => 'Steven A. Zahm',
				'authorURL'   => 'connections-pro.com',
				'description' => 'This is a variation of the default template which shows the bio field for an entry.',
				'custom'      => TRUE,
				'path'        => plugin_dir_path( __FILE__ ),
				'url'         => plugin_dir_url( __FILE__ ),
				'thumbnail'   => 'thumbnail.png',
				'parts'       => array(),
				);

			cnTemplateFactory::register( $atts );
		}

		public function __construct( $template ) {
			$this->template = $template;

			$template->part( array( 'tag' => 'card', 'type' => 'action', 'callback' => array( __CLASS__, 'card' ) ) );
			$template->part( array( 'tag' => 'card-single', 'type' => 'action', 'callback' => array( __CLASS__, 'card' ) ) );
		}


		public static function card( $entry, $template, $atts ) {


		global $thisCatFound;
		$thisCat = strip_tags($entry->getCategoryBlock( array( 'label' => '', 'separator' => '', 'before' => '', 'after' => '', 'parents' => FALSE,  'return' => TRUE ) ));

		$paddingBottom = '0px';
		if (!$thisCatFound[$thisCat]) {
			print('<h2 style="padding-left:20px; padding-top:20px" id="squelch-taas-title-0" class="squelch-taas-group-title">');
			print($thisCat);
			print("</h2>\n");
			$paddingBottom = '0px';
			$thisCatFound[$thisCat] = TRUE;
		}
		?>

<div style="padding-left:40px; padding-bottom:<?php print($paddingBottom); ?>" role="tablist" id="squelch-taas-accordion-0" class="squelch-taas-accordion squelch-taas-override ui-accordion ui-widget ui-helper-reset" data-active="false" data-disabled="false" data-autoheight="false" data-collapsible="true">
<h3 tabindex="-1" aria-selected="false" aria-controls="ui-accordion-squelch-taas-accordion-0-panel-0" role="tab" class="ui-accordion-header ui-helper-reset ui-state-default ui-corner-all ui-accordion-icons" id="squelch-taas-header-0"><span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span><a href="#squelch-taas-accordion-shortcode-content-0">
<?php echo $entry->getNameBlock(array('link' => '')); ?></a></h3>
<div aria-hidden="true" aria-expanded="false" role="tabpanel" aria-labelledby="squelch-taas-header-0" id="ui-accordion-squelch-taas-accordion-0-panel-0" style="display: none;" class="squelch-taas-accordion-shortcode-content-0 ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom">
			<div class="cn-entry" style="-moz-border-radius:4px; background-color:#FFFFFF; border:1px solid #E3E3E3; color: #000000; margin:8px 0px; padding:6px; position: relative;">
				<div style="width:49%; float:left">
					<?php $entry->getImage(); ?>
					<div style="clear:both;"></div>
					<div style="margin-bottom: 10px;">
						<!--<span style="font-size:larger;font-variant: small-caps"><strong><?php echo $entry->getNameBlock(array('link' => '')); ?></strong></span>-->
						<?php $entry->getTitleBlock(); ?>
						<?php $entry->getOrgUnitBlock(); ?>
						<?php $entry->getContactNameBlock(); ?>

					</div>

						


						<?php
$thisAddress = $entry->getAddressBlock(array('return' => TRUE));
$thisAddress = str_replace('<span class="address-name">Work</span>', '', $thisAddress);
$thisAddress = str_replace('<span class="address-name">Home</span>', '', $thisAddress);
echo $thisAddress;

?>
				</div>

				<div align="right">

					<?php $entry->getFamilyMemberBlock(); ?>
					<?php $entry->getPhoneNumberBlock(); ?>
					<?php $entry->getEmailAddressBlock(); ?>
					<?php $entry->getSocialMediaBlock(); ?>
					<?php $entry->getImBlock(); ?>
					<?php $entry->getLinkBlock(); ?>
					<?php $entry->getDateBlock(); ?>
<?php

$thismusic = $entry->getContentBlock( array('key' => 'Music', 'return' => TRUE), $atts['content'], $atts, $template );
$msplit1 = '<iframe';
$msplit2 = '</iframe>';
$msplit2b = '<\/iframe>';

if ((!empty($thismusic)) aND (!is_array($thismusic)) AND (stripos($thismusic, $msplit1)) AND (stripos($thismusic, $msplit2))) {
	list($mus1, $mus2) = preg_split("/$msplit1/", $thismusic);
	list($mus3, $mus4) = preg_split("/$msplit2b/", $mus2);
	$thismusic = '<iframe' . $mus3 . '</iframe>';
	##echo "mus3=$mus3<br>mus2=$mus2<br>";
	echo $thismusic;
}
if ((!empty($thisentry)) aND (is_array($thisentry))) {
	reset($thisentry);
	while($current = each($thisentry)) {
		$key = $current['key'];
		$value = $current['value'];
		##print("*t $key=$value<br>");
		if ($value['meta_value']) { $thisMeta = $value['meta_value']; }
	}
}

if ($thisMeta) { print($thisMeta); }
##print("<p>*TEST: thisentry=<pre>\n"); print_r($thisentry); print("\n</pre></p>");

?>


				</div>

				<div style="clear:both"></div>

				<?php echo $entry->getBioBlock(); ?>


				<div style="clear:both"></div>

				<div class="cn-meta" align="left" style="margin-top: 6px">

					<?php
 						##$entry->getContentBlock( array('exclude' => 'Music'), $atts, $template );
 						##$entry->getContentBlock( array('exclude' => 'Music'), $atts['content'], $atts, $template );
 					?>

					<!--<div style="display: block; margin-bottom: 8px;"><?php
					$entry->getCategoryBlock( array( 'separator' => ', ', 'before' => '<span>', 'after' => '</span>' ) );
					?></div>-->

					<?php
					if ( cnSettingsAPI::get( 'connections', 'connections_display_entry_actions', 'vcard' ) ) $entry->vcard( array( 'before' => '<span>', 'after' => '</span>' ) );
					?>

					<?php
					/*

					cnTemplatePart::updated(
						array(
							'timestamp' => $entry->getUnixTimeStamp(),
							'style' => array(
								'font-size'    => 'x-small',
								'font-variant' => 'small-caps',
								'position'     => 'absolute',
								'right'        => '36px',
								'bottom'       => '8px'
							)
						)
					);

					cnTemplatePart::returnToTop( array( 'style' => array( 'position' => 'absolute', 'right' => '8px', 'bottom' => '5px' ) ) );
					*/

					?>

				</div>

			</div>
</div>
</div>

			<?php
		}

	}

	// Register the template.
	add_action( 'cn_register_template', array( 'CN_Bio_Card_Accordion_Music_Template', 'register' ) );
}
