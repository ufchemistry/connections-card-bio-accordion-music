<?php
/**
 * @package    Connections
 * @subpackage Template : Bio Card Accordion Music TEST
 * @author     Steven A. Zahm
 * @since      0.7.9
 * @license    GPL-2.0+
 * @link       http://connections-pro.com
 * @copyright  2013 Steven A. Zahm
 *
 * @wordpress-plugin
 * Plugin Name:       Connections Bio Card Accordion Music - Template
 * Plugin URI:        http://connections-pro.com
 * Description:       This is a variation of the default template which shows the bio field for an entry.
 * Version:           2.0.1
 * Author:            Steven A. Zahm
 * Author URI:        http://connections-pro.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'CN_Bio_Card_Accordion_Music_Template' ) ) {

	class CN_Bio_Card_Accordion_Music_Template {

		public static function register() {

			$atts = array(
				'class'       => 'CN_Bio_Card_Accordion_Music_Template',
				'name'        => 'Bio Entry Accordion Music Card',
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
		$thisCat = strip_tags($entry->getCategoryBlock( array( 'label' => '', 'separator' => ', ', 'before' => '', 'after' => '', 'return' => TRUE ) ));

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

						<?php $entry->getAddressBlock(); ?>
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
	##$thisentry = $entry->getMetaBlock(array('separator' => '-', 'key' => 'Music', 'single' => TRUE),'','');
	echo '<!--';
	$thismusic = $entry->getContentBlock( array('key' => 'Music', 'return' => TRUE), $atts['content'], $atts, $template );
	echo '-->';

$msplit1 = '<iframe';
$msplit2 = '</iframe>';

if ((!empty($thismusic)) aND (!is_array($thismusic)) AND (stripos($thismusic, $msplit1)) AND (stripos($thismusic, $msplit2))) {
	list($mus1, $mus2) = preg_split("/$msplit1/", $thismusic);
	list($mus3, $mus4) = preg_split("/$msplit2/", $mus2);
	$thismusic = '<iframe' . $mus3 . '</iframe>';
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

?>

				</div>

				<div style="clear:both"></div>

				<?php echo $entry->getBioBlock(); ?>
<?php
	$thisentry = $entry->getMetaBlock(array('separator' => '-', 'key' => 'Music'),'','');
	echo $thisentry;
?>

				<div style="clear:both"></div>

				<div class="cn-meta" align="left" style="margin-top: 6px">

					<?php $entry->getContentBlock( $atts['content'], $atts, $template ); ?>

					<!--<div style="display: block; margin-bottom: 8px;"><?php $entry->getCategoryBlock( array( 'separator' => ', ', 'before' => '<span>', 'after' => '</span>' ) ); ?></div>-->

					<?php if ( cnSettingsAPI::get( 'connections', 'connections_display_entry_actions', 'vcard' ) ) $entry->vcard( array( 'before' => '<span>', 'after' => '</span>' ) ); ?>

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
