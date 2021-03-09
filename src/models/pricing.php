<?php
/**
 * pricing.php
 *
 *
 *
 * @category
 * @package
 * @subpackage
 * @author Hongyi Chen <hongyi.chen@sovendus.com>
 * @copyright Copyright (c) 2010-2014 Sovendus GmbH (http://www.sovendus.com)
 */
 class pricing extends AppModel
 {

     const PRICING_MODEL_CPL = "CPL";
     const PRICING_MODEL_CPO = "CPO";

     protected $_colums = array(
         'id',             //id
         'name',             // char 255
         'description',            // tiny text
         'created'
     );
 }
/* EOF */