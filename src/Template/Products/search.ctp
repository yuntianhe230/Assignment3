<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>

<div class="products form large-9 medium-8 columns content">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Search Product') ?></legend>
        <?php
            echo $this->Form->control('coo',['label'=>'Country Of Origin']);
            echo $this->Form->control('price',['label'=>'Sale Price']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Search')) ?>
    <?= $this->Form->end() ?>
</div>

<div class="products index large-9 medium-8 columns content">
    <h3><?= __('Products') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('product_id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('product_name') ?></th>
            <th scope="col"><?= $this->Paginator->sort('product_purchase_price') ?></th>
            <th scope="col"><?= $this->Paginator->sort('poduct_sale_price') ?></th>
            <th scope="col"><?= $this->Paginator->sort('product_country_of_origin') ?></th>
            <th scope="col"><?= $this->Paginator->sort('category_id') ?></th>

        </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $this->Number->format($product->product_id) ?></td>
                <td><?= h($product->product_name) ?></td>
                <td><?= $this->Number->format($product->product_purchase_price,['places'=>2,'before'=>'$']) ?></td>
                <td><?= $this->Number->format($product->poduct_sale_price,['places'=>2,'before'=>'$']) ?></td>
                <td><?= h($product->product_country_of_origin) ?></td>
                <td><?= $product->has('category') ? $this->Html->link($product->category->category_name, ['controller' => 'Category', 'action' => 'view', $product->category->category_id]) : '' ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

