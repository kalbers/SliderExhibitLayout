<?php
$position = isset($options['file-position'])
    ? html_escape($options['file-position'])
    : 'left';
$size = isset($options['file-size'])
    ? html_escape($options['file-size'])
    : 'fullsize';
$captionPosition = isset($options['captions-position'])
    ? html_escape($options['captions-position'])
    : 'center';
?>
<div class="slider-pro <?php echo $position; ?> <?php echo $size; ?> captions-<?php echo $captionPosition; ?>">
    <div class="sp-slides">

        <?php foreach ($attachments as $attachment): ?>
            <div class="sp-slide">
                
                    <?php
                    $item = $attachment->getItem();
                    $file = $attachment->getFile();
                    ?>
                    <?php if ($description = metadata($item, array('Dublin Core', 'Title'), array('no_escape' => true))): ?>
                        <?php $altText =  $description; ?>
                    <?php endif; ?> 

                        <?php echo file_markup($file, array('imageSize'=>$size,'linkToFile'=>false, 'imgAttributes'=>array('class' => "sp-image", 'alt' =>  "$altText", 'title' => metadata($item, array("Dublin Core", "Title"))))); ?>

                    <?php if($attachment['caption']): ?>
                        <div class="sp-caption" >
                            <span class="caption-title"><?php echo exhibit_builder_link_to_exhibit_item($description, array(), $item); ?></span>
                            <?php echo $attachment['caption']; ?>
                        </div>
                    <?php endif; ?>
                        
                    <?php// echo file_markup($file, array('imageSize'=>'thumbnail','linkToFile'=>false, 'imgAttributes'=>array('alt' =>  "$altText", 'class' => 'sp-thumbnail', 'title' => metadata($item, array("Dublin Core", "Title"))))); ?>
                

            </div>           
        <?php endforeach; ?>
        
    </div>
        
</div>
<div class="exhibit-page-text">
    <?php echo $text; ?>
</div>

