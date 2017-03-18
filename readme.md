How to install this module:


Step1: First clone `shop` in your module folder
```
cd modules_folder
git clone git@gitlab.com:aminkt/yii2-ordering-module.git ordering
```

Step2: Add flowing code into your `bootstrap.php` file in your project.
```
Yii::setAlias('shop', 'PATH_TO_MODULE_DIRECTORY/shop');
```

Step3: Add flowing lines in your application config:

```
'ordering' => [
    'class' => 'shop\Shop',
],
```

> note: This module need aminkt/yii2-ordering-module.
>
> Use bellow link to access ordering module
>
> https://aminkt@gitlab.com/aminkt/yii2-ordering-module.git

Step4: 

Step5: Enjoy from module.