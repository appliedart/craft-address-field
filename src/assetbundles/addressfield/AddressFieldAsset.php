<?php
/**
 * Address Field plugin for Craft CMS 3.x
 *
 * Expose address element field.
 *
 * @link      https://appliedart.com
 * @copyright Copyright (c) 2022 Applied Art
 */

namespace appliedart\addressfield\assetbundles\addressfield;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Applied Art
 * @package   AddressField
 * @since     1.0.0
 */
class AddressFieldAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@appliedart/addressfield/assetbundles/addressfield/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/Address.js',
        ];

        $this->css = [
            'css/Address.css',
        ];

        parent::init();
    }
}
