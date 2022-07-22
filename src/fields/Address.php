<?php
/**
 * Address Field plugin for Craft CMS 3.x
 *
 * Expose address element field.
 *
 * @link      https://appliedart.com
 * @copyright Copyright (c) 2022 Applied Art
 */

namespace appliedart\addressfield\fields;

use appliedart\addressfield\AddressFieldPlugin;
use appliedart\addressfield\assetbundles\addressfield\AddressFieldAsset;

use Craft;
use craft\base\ComponentInterface;
use craft\base\FieldInterface;
use craft\base\ElementInterface;
use craft\elements\Category;
use craft\elements\db\CategoryQuery;
use craft\elements\db\ElementQueryInterface;
use craft\gql\arguments\elements\Category as CategoryArguments;
use craft\gql\interfaces\elements\Category as CategoryInterface;
use craft\gql\resolvers\elements\Category as CategoryResolver;
use craft\helpers\ArrayHelper;
use craft\helpers\ElementHelper;
use craft\helpers\Gql;
use craft\helpers\Gql as GqlHelper;
use craft\models\GqlSchema;
use craft\services\ElementSources;
use craft\services\Gql as GqlService;
use GraphQL\Type\Definition\Type;
use craft\fieldlayoutelements\users\AddressesField;

/**
 * @author    Applied Art
 * @package   AddressField
 * @since     1.0.0
 */
class Address extends AddressesField
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $someAttribute = 'Some Default';

    // Static Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('address-field', 'Addresses');
    }

    /**
     * @inheritdoc
     */
    public static function isSelectable(): bool
    {
        return true;
    }

    public function useFieldset(): bool
    {
        return parent::useFieldset();
    }

    /**
     * @inheritdoc
     */
    protected function inputHtml(?ElementInterface $element = null, bool $static = false): ?string
    {
        if (!$element->id) {
            return null;
        }

        return Cp::addressCardsHtml($element->getAddresses(), [
            'ownerId' => $element->id,
        ]);
    }

}
