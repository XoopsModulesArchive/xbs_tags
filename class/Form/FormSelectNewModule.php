<?php declare(strict_types=1);

namespace XoopsModules\Xbstags\Form;

//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <https://xoops.org>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
// Author:    Ashley Kitson                                                  //
// Copyright: (c) 2006, Ashley Kitson                                        //
// URL:       http://xoobs.net                                               //
// Project:   The XOOPS Project (https://xoops.org/)                      //
// Module:    XBS MetaTags (TAGS)                                            //
// ------------------------------------------------------------------------- //

/**
 * Classes used by TAGS system to present form data
 *
 * @package       TAGS
 * @subpackage    Form_Handling
 * @author        Ashley Kitson http://xoobs.net
 * @copyright (c) 2006 Ashley Kitson, Great Britain
 */

/**
 * Xoops form objects
 */
require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';

/**
 * Create a name selection list of modules that are not yet in the MetaTags database
 *
 * @package    TAGS
 * @subpackage Form_Handling
 */
class FormSelectNewModule extends \XoopsFormSelect
{
    /**
     * Constructor
     *
     * @param string $caption Caption
     * @param string $name    "name" attribute
     * @param mixed  $value   Pre-selected value (or array of them).
     * @param int    $size    Number of rows. "1" makes a drop-down-list
     * @param bool   $multi   Allow multiple selections
     */
    public function __construct($caption, $name, $value = null, $size = 1, $multi = false)
    {
        global $xoopsDB;

        parent::__construct($caption, $name, $value, $size, $multi);

        //get all loaded modules

        $mod = new \XoopsModuleHandler($xoopsDB);

        $modArray = $mod->getList();

        //get modules that are in MetaTags

        $tagsHandler = \XoopsModules\Xbstags\Helper::getInstance()->getHandler('Page');

        $tagsArray = $tagsHandler->getList();

        //finds the ones we haven't got yet

        $arr = array_diff($modArray, $tagsArray);

        $this->addOptionArray($arr);
    }
}
