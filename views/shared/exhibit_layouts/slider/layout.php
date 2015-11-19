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
<div class="exhibit-items slider-pro <?php echo $position; ?> <?php echo $size; ?> captions-<?php echo $captionPosition; ?>">
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
                    <?php echo file_markup($file, array('imageSize'=>$size,'linkToFile'=>false, 'imgAttributes'=>array('alt' =>  "$altText", 'class' => 'sp-image', 'title' => metadata($item, array("Dublin Core", "Title"))))); ?>

                    <?php echo file_markup($file, array('imageSize'=>'thumbnail','linkToFile'=>false, 'imgAttributes'=>array('alt' =>  "$altText", 'class' => 'sp-thumbnail', 'title' => metadata($item, array("Dublin Core", "Title"))))); ?>
                
                <?php if($attachment['caption']): ?>
                    <div class="sp-layer sp-black sp-padding" data-position="bottomLeft" data-width="100%">
                        <?php echo $attachment['caption']; ?>
                    </div>
                <?php endif; ?>
            </div>
            
        <?php endforeach; ?>
    </div>
        
</div>
<div class="exhibit-page-text">
    <?php echo $text; ?>
</div>

