<?php
if ($_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {return;}
$action = $_POST['actionAjax'];
if (empty($action)) {return;}

function getWord($number) {
    $suffix = array("позиция", "позиции", "позиций");
    $keys = array(2, 0, 1, 1, 1, 2);
    $mod = $number % 100;
    $suffix_key = ($mod > 7 && $mod < 20) ? 2: $keys[min($mod % 10, 5)];
    return $suffix[$suffix_key];
}

$cartArray = $_SESSION['minishop2']['cart'];
$n = count($cartArray) - $limit;
$products = '';

$arr = array_slice($cartArray,0,$limit);
foreach ($arr as $val) {
    if ($product = $modx->getObject('msProduct', $val['id'])) {
    	$products .= '<img src="'.$product->get('thumb').'" height="25" class="b-minicart-preview" alt="" title="" />';
    }
}
if($products == ''){
    $products = 'Ваша корзина пуста';
}else{
    $products .= '<a href="/cart" class="btn btn-default">Оформить заказ</a>';
}


$res = '';
switch ($action){
    case 'updateCart':
        if($n > 0){
            $word = getWord($n);
            $res = $products.' и еще '.$n.' '.$word;
        }else{
            $res = $products;
        }
       
    break;
}   
$res = $modx->toJSON(
        array(
            'success' => 'ok',
            'data' => $res
            )
    );

if (!empty($res)) {
    die($res);
}