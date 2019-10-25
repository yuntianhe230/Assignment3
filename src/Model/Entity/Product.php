<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $product_id
 * @property string $product_name
 * @property float $product_purchase_price
 * @property float $poduct_sale_price
 * @property string $product_country_of_origin
 * @property int $category_id
 *
 * @property \App\Model\Entity\Category $category
 */
class Product extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'product_name' => true,
        'product_purchase_price' => true,
        'poduct_sale_price' => true,
        'product_country_of_origin' => true,
        'category_id' => true,
        'category' => true
    ];
}
