<?php

function presentPrice($price)
{
    $fmt = new NumberFormatter( 'en-US', NumberFormatter::CURRENCY);
    return numfmt_format_currency($fmt, $price, 'EGP');
}

function returnCustomValidationError($msg, $errors)
{
    $allErrors = [];

    foreach ($errors->toArray() as $key => $error){
           $allErrors[$key]['field'] = $key;
           $allErrors[$key]['message'] = $error[0];
    }

    return response()->json([
        'status' => false,
        'errors' => array_values($allErrors),
    ],422);
}
