
> NOTE: 
>
> This module need aminkt/yii2-ordering-module.
>
> Use bellow link to access ordering module
>
> https://gitlab.com/aminkt/yii2-ordering-module

How to install this module:


Step1: First add flowing codes into project `composer.json`

```
"repositories": [
    {
        "type": "gitlab",
        "url": "https://gitlab.com/aminkt/yii2-shop-module"
    }
],
```

Then add flowing line to require part of `composer.json` :
```
"aminkt/yii2-shop-module": "*",
```

And after that run bellow command in your composer :
```
Composer update aminkt/yii2-shop-module
```

Step2: Add flowing lines in modules part of your application config:

```
'ordering' => [
    'class' => \aminkt\ordering\Order::className(),
    'orderModelName' => models\Order::className(),
    'orderItemModelName' => models\OrderItem::className(),
    'customerProfileModelName' => models\Customer::className(),
    'productModelName' => models\Product::className(),
],

```

Step3: Add flowing lines in module part of your frontend application config:
```
'shop' => [
    'class'=>\aminkt\shop\Shop::className(),
    'productModel' => models\Product::className(),
    'categoryModel' => models\Category::className(),
    'userModel' => models\Member::className(),
    'theme' => [
        'pathMap' => [
            \aminkt\shop\Shop::THEME_PATH =>'@frontendWeb/themes/theme_name/shop',
        ],
        'baseUrl'=>"/themes/theme_name",
    ],
]
```

step4: Add flowing lines in components part of your application config:

```
'order' => [
    'class' => aminkt\ordering\components\Order::className(),
    'orderModel'=> models\Order::className(),
    'orderItemModel'=> models\OrderItem::className(),
],
```

Step5: Implement 
* `aminkt\ordering\interfaces\OrderInterface` in your orders model
* `aminkt\ordering\interfaces\OrderItemInterface` in your orderItems model
* `aminkt\shop\interfaces\CustomerProfileInterface` in you customer users model
* `aminkt\shop\interfaces\ProductInterface` in your products model
* `aminkt\shop\interfaces\CategoryInterface` in your Category model

Step6: Add flowing code into yor product modal.
```
public function getCartPosition()
{
    return \Yii::createObject([
        'class' => ProductCartPosition::className(),
        'id' => $this->id,
    ]);
}
```

Step6: In `@frontendWeb/themes/theme_name/shop` path create your own template of shop.

Step6: Enjoy from module.

[Created by Amin Keshavarz](http://telbit.ir)

[ak_1596@yahoo.com](mailto:ak_1596@yahoo.com)

[Gitlab repo](https://gitlab.com/aminkt/yii2-shop-module)