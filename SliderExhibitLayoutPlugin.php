<?php 

/**
 * @package  Omeka Lightbox
 * @copyright Copyright 2015 Ken Albers
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU GPLv3
 */

class SliderExhibitLayoutPlugin extends Omeka_Plugin_AbstractPlugin
{
    protected $_filters = array('exhibit_layouts');

    public function filterExhibitLayouts($layouts)
    {
        $layouts['slider'] = array(
            'name' => 'Slider Layout',
            'description' => 'A slider layout.'
        );
        return $layouts;
    }

    public function sliderExhibitAttachment($attachment)
    {
        $item = $attachment->getItem();
        $file = $attachment->getFile();
        
        if ($file) {
            if (!isset($fileOptions['imgAttributes']['alt'])) {
                $fileOptions['imgAttributes']['alt'] = metadata($item, array('Dublin Core', 'Title'), array('no_escape' => true));
            }
            
            if ($forceImage) {
                $imageSize = isset($fileOptions['imageSize'])
                    ? $fileOptions['imageSize']
                    : 'square_thumbnail';
                $image = file_image($imageSize, $fileOptions['imgAttributes'], $file);
                $html = exhibit_builder_link_to_exhibit_item($image, $linkProps, $item);
            } else {
                if (!isset($fileOptions['linkAttributes']['href'])) {
                    $fileOptions['linkAttributes']['href'] = exhibit_builder_exhibit_item_uri($item);
                }
                $html = file_markup($file, $fileOptions, null);
            }
        } else if($item) {
            $html = exhibit_builder_link_to_exhibit_item(null, $linkProps, $item);
        }
        // Don't show a caption if we couldn't show the Item or File at all
        if (isset($html)) {
            if (!is_string($attachment['caption']) || $attachment['caption'] == '') {
            return '';
        }
        $html .= '<div class="exhibit-item-caption">'
              . $attachment['caption']
              . '</div>';
        return apply_filters('exhibit_attachment_caption', $html, array(
            'attachment' => $attachment
        ));
        } else {
            $html = '';
        }
        return apply_filters('exhibit_attachment_markup', $html,
            compact('attachment', 'fileOptions', 'linkProps', 'forceImage')
        );
    }
}
