<?php
/**
 * Address Field plugin for Craft CMS 3.x
 *
 * Expose address element field.
 *
 * @link      https://appliedart.com
 * @copyright Copyright (c) 2022 Applied Art
 */

namespace appliedart\addressfield;

use appliedart\addressfield\fieldlayoutelements\elements\ModifiedAddressesField;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\models\FieldLayout;
use craft\services\Fields;
use craft\events\RegisterComponentTypesEvent;
use craft\fieldlayoutelements\users\AddressesField;

use yii\base\Event;

/**
 * Class AddressFieldPlugin
 *
 * @author    Applied Art
 * @package   AddressField
 * @since     1.0.0
 *
 */
class AddressFieldPlugin extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var AddressField
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public string $schemaVersion = '1.0.0';

    /**
     * @var bool
     */
    public bool $hasCpSettings = false;

    /**
     * @var bool
     */
    public bool $hasCpSection = false;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();
        self::$plugin = $this;

        /*        Event::on(
            Fields::class,
            Fields::EVENT_REGISTER_FIELD_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = AddressField::class;
            }
        );
*/

        Event::on(FieldLayout::class, FieldLayout::EVENT_DEFINE_NATIVE_FIELDS, function (DefineFieldLayoutFieldsEvent $event) {
            /** @var FieldLayout $fieldLayout */
            $fieldLayout = $event->sender;

            switch ($fieldLayout->type) {
                case Category::class:
                case Entry::class:
                    $event->fields[] = AddressesField::class;
                    break;
            }
        });


        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );

        Craft::info(
            Craft::t(
                'address-field',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

}
