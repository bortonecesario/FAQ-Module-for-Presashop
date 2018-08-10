<?php
if (!defined('_PS_VERSION_')) {
    exit;
}
require_once _PS_MODULE_DIR_ . 'faq/faq.php';

class blockcmsOverride extends blockcms
{
	public function hookFooter()
	{	
    	$faq = new faq();
    	$infoblock = array();
    	$infoblock = BlockCMSModel::getCMSTitlesFooter();
		$infoblock[0]['link'] = $faq->getlink();
		$infoblock[0]['meta_title'] = $faq->gettitle();
        
		if (!($block_activation = Configuration::get('FOOTER_BLOCK_ACTIVATION')))
			return;
	
    if (!$this->isCached('blockcms.tpl', $this->getCacheId(BlockCMSModel::FOOTER)))
		{
			$display_poweredby = Configuration::get('FOOTER_POWEREDBY');
			$this->smarty->assign(
				array(
					'block' => 0,
					'contact_url' => 'contact',
					'cmslinks' => $infoblock,
					'display_stores_footer' => Configuration::get('PS_STORES_DISPLAY_FOOTER'),
					'display_poweredby' => ((int)$display_poweredby === 1 || $display_poweredby === false),
					'footer_text' => Configuration::get('FOOTER_CMS_TEXT_'.(int)$this->context->language->id),
					'show_price_drop' => Configuration::get('FOOTER_PRICE-DROP'),
					'show_new_products' => Configuration::get('FOOTER_NEW-PRODUCTS'),
					'show_best_sales' => Configuration::get('FOOTER_BEST-SALES'),
					'show_contact' => Configuration::get('FOOTER_CONTACT'),
					'show_sitemap' => Configuration::get('FOOTER_SITEMAP')
				)
			);
		}
		return $this->display(__FILE__, 'blockcms.tpl', $this->getCacheId(BlockCMSModel::FOOTER));
	}	
   
}
