<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-2-12
 * Time: 上午12:52
 */

class FormHelper extends Helper
{

    /**
     * 帮助生成一个表但中类似 value="%" 的字符串。
     * @param $key field name
     * @param array $data  data array
     * @param string $default
     * @return string
     */
    public function value($key, array $data, $default='')
    {
        $patten = " value=\"%s\" ";
        return sprintf($patten,  isset($data[$key]) ? $data[$key] : $default);
    }


    /**
     * 帮助生成表单中select/option 的 select属性字符串.
     * 在$data中搜索字段$key.如果存在，且值包含current value则返回selected
     *
     * @param $key field name $data中需要搜索的的key。如果为空，则把data中的所有值作为观察对象。
     * @param array $data data array 保存
     * @param $currentValue current value 循环中的当前值
     * @return string
     */
    public function selected($key, array $data, $currentValue)
    {
        if (empty($data)) {
            return '';
        }
        if (empty($key)) {
            $value = $data;
        } elseif (isset($data[$key])) {
            $value = $data[$key];
            if (!is_array($value)) {
               $value = array($value);
            }
        } else {
            $value = array();
        }
        if (in_array($currentValue, $value)) {
            return ' selected ';
        }
        return '';
    }




    /**
     * 帮助生成表单中 inpur checkbox 的 checked 属性 字符串。
     * 如果在data中含有名字为key的键。
     *
     * @param $key field name
     * @param array $data data array
     * @param $currentValue current value
     */
    public function checked($key, array $data)
    {
        return (isset($data[$key]) && ($data[$key])) ? 'checked' : '' ;
    }


    /**
     * 帮助生成 textarea中的内容
     *
     * @param $key
     * @param array $data
     * @param string $default
     * @return string
     */
    public function text($key, array $data, $default='')
    {
        return isset($data[$key]) ? $data[$key] : $default;
    }

}