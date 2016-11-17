<?php

function zbCheckError($param = null)
{
    if ($param) {
        return 'has-error';
    }
}

function zbGetMetaVal($meta_id, $meta_data)
{
    if (isset($meta_data[$meta_id])) {
        return $meta_data[$meta_id];
    }
}

function zbGetCheckboxVal($meta_id, $meta_data)
{
    if (isset($meta_data[$meta_id])) {
        if ($meta_data[$meta_id] == 1) {
            return 'checked';
        }
    }
}

function zbGetSelectVal($meta_id, $meta_data, $option)
{
    if (isset($meta_data[$meta_id])) {
        if ($meta_data[$meta_id] == $option) {
            return 'selected';
        }
    }
}

function zbGetRadioVal($meta_id, $meta_data, $option)
{
    if (isset($meta_data[$meta_id])) {
        if ($meta_data[$meta_id] == $option) {
            return "checked='checked'";
        }
    }
}

function zbGetTitle($item, $old)
{
    if (!empty($old)) {
        return $old;
    }

    if (!empty($item)) {
        return $item->description->s_title;
    }

    return '';
}

function zbGetDescription($item, $old)
{
    if (!empty($old)) {
        return $old;
    }

    if (!empty($item)) {
        return $item->description->s_description;
    }

    return '';
}

function zbCurrencyCheckbox($item, $old, $code)
{
    if (!empty($old)) {
        return $old == $code ? 'checked' : '';
    }

    if (!empty($item)) {
        return $item->fk_c_currency_code == $code ? 'checked' : '';
    }

    if ($code == 'KGS') {
        return $code == 'KGS' ? 'checked' : '';
    }

    return '';
}

function zbCurrencyClass($item, $old, $code)
{
    if (!empty($old)) {
        return $old == $code ? 'active' : '';
    }

    if (!empty($item)) {
        return $item->fk_c_currency_code == $code ? 'active' : '';
    }

    if ($code == 'KGS') {
        return $code == 'KGS' ? 'active' : '';
    }

    return '';
}

/**
 * @param $string
 *
 * @return mixed|string
 */
function stripForMeta($string)
{
    $string = strip_tags($string);
    $string = str_replace("\r", " ", $string);
    $string = str_replace("\n", " ", $string);
    return str_limit($string, 100);
}
