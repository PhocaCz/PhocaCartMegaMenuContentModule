<?php
/* @package Joomla
 * @copyright Copyright (C) Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @extension Phoca Extension
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined('_JEXEC') or die;

$layoutI	= new JLayoutFile('image', null, array('component' => 'com_phocacart'));
$col 		= PhocacartRenderFront::getColumnClass((int)$p['columns']);

echo '<div class="ph-mega-menu-content-module-box'.$moduleclass_sfx .'">';




if ($p['type'] == 1 && !empty($categories)) {

    // CATEGORIES
    $class = 'ph-cat';

    echo '<div class="'.$s['c']['row'].' ph-mega-menu-content-row '.$class.'">';
    $i = 0;
    foreach ($categories as $k => $v) {

        if ($i >= $p['items']) {
            break;
        }

        if ((int)$v['id'] > 0 && $v['title'] != '' && $v['alias'] != '') {

            echo '<div class="'.$s['c']['row-item'].' '.$s['c']["col.xs12.sm{$col}.md{$col}"].' ph-mega-menu-content-row-item '.$class.'">';

            $link = PhocacartRoute::getCategoryRoute($v['id'], $v['alias']);

            if ($p['display_title'] == 1) {

                echo '<h3 class="ph-mega-menu-content-header '.$class.'">';
                echo $p['display_link'] == 1 ? '<a href="' . $link . '">' : '';
                echo $v['title'];
                echo $p['display_link'] == 1 ? '</a>' : '';
                echo '</h3>';
            }



            if ($p['display_image'] == 1 && $v['image'] != '') {

                $image = PhocacartImage::getThumbnailName(PhocacartPath::getPath('categoryimage'), $v['image'], 'small');
                $d = array();
                $d['s'] = $s;
                $d['t'] = $pc;
                $d['src'] = JURI::base(true) . '/' . $image->rel;
                $d['srcset-webp'] = JURI::base(true) . '/' . $image->rel_webp;
                $d['alt-value'] = PhocaCartImage::getAltTitle($v['title'], $image->rel);
                $d['class'] = $s['c']['img-responsive'] . ' ph-image ph-mega-menu-content-image '.$class;

                echo $p['display_link'] == 1 ? '<a href="' . $link . '">' : '';
                echo $layoutI->render($d);
                echo $p['display_link'] == 1 ? '</a>' : '';
            }

            if ($p['display_desc'] == 1 && $v['description'] != '') {
                echo '<div class="ph-mega-menu-content-description '.$class.'">';
                echo $v['description'];
                echo '</div>';

            }

            if ($p['display_subcategories'] == 1 && !empty($v['children'])) {
                echo '<ul class="ph-mega-menu-content-subcategories '.$class.'">';
                foreach ($v['children'] as $k2 => $v2) {

                    if ((int)$v2['id'] > 0 && $v2['title'] != '' && $v2['alias'] != '') {
                        $link = PhocacartRoute::getCategoryRoute($v2['id'], $v2['alias']);
                        echo '<li>';
                        echo '<a href="' . $link . '">';
                        echo $v2['title'];
                        echo '</a>';
                        echo '</li>';
                    }

                }
                echo '</ul>';
            }

            echo '</div>';// end row item
        }

        $i++;

    }

    echo '</div>';// end row


} else if ($p['type'] == 2 && !empty($manufacturers)) {

    // MANUFACTURERES
    $class = 'ph-man';

    echo '<div class="'.$s['c']['row'].' ph-mega-menu-content-row '.$class.'">';
    $i = 0;
    foreach ($manufacturers as $k => $v) {

        if ($i >= $p['items']) {
            break;
        }

        if ((int)$v->id > 0 && $v->title != '' && $v->alias != '') {

            echo '<div class="'.$s['c']['row-item'].' '.$s['c']["col.xs12.sm{$col}.md{$col}"].' ph-mega-menu-content-row-item '.$class.'">';

            $link = PhocacartRoute::getItemsRoute('', '', 'manufacturer', $v->id . '-'.$v->alias);

            if ($p['display_title'] == 1) {

                echo '<h3 class="ph-mega-menu-content-header '.$class.'">';
                echo $p['display_link'] == 1 ? '<a href="' . $link . '">' : '';
                echo $v->title;
                echo $p['display_link'] == 1 ? '</a>' : '';
                echo '</h3>';
            }



            if ($p['display_image'] == 1 && $v->image != '') {


                $d = array();
                $d['s'] = $s;
                $d['t'] = $pc;
                $d['src'] = JURI::base(true) . '/' . $v->image;
                $d['srcset-webp'] = '';//JURI::base(true) . '/' . $image->rel_webp;
                $d['alt-value'] = PhocacartImage::getAltTitle($v->title, $v->image);
                $d['class'] = $s['c']['img-responsive'] . ' ph-image ph-mega-menu-content-image '.$class;

                echo $p['display_link'] == 1 ? '<a href="' . $link . '">' : '';
                echo $layoutI->render($d);
                echo $p['display_link'] == 1 ? '</a>' : '';
            }

            if ($p['display_desc'] == 1 && $v->description != '') {
                echo '<div class="ph-mega-menu-content-description '.$class.'">';
                echo $v->description;
                echo '</div>';

            }

            echo '</div>';// end row item
        }

        $i++;

    }
}







echo '</div>';
?>


