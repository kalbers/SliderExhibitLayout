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
                    
      <!-- Added this check to remove error with metadata(NULL) -AM 7/22/16-->
                    <?php if (isset($item)): ?>
                    
                      <?php if ($description = metadata($item, array('Dublin Core', 'Title'), array('no_escape' => true))): ?>
                          <?php $altText =  $description; ?>
                      <?php endif; ?> 

                          <?php echo file_markup($file, array('imageSize'=>$size,'linkToFile'=>false, 'imgAttributes'=>array('class' => "sp-image", 'alt' =>  "$altText", 'title' => metadata($item, array("Dublin Core", "Title"))))); ?>
                          
                          <?php echo file_markup($file, array('imageSize'=>'square_thumbnail','linkToFile'=>false, 'imgAttributes'=>array('class' => "sp-thumbnail", 'alt' =>  "$altText", 'title' => metadata($item, array("Dublin Core", "Title"))))); ?>
                          
                      <?php if($attachment['caption']): ?>
                          <div class="sp-layer sp-white sp-padding" data-width="100%" data-position="bottomLeft" data-vertical="0" data-show-transition="up" data-hide-transition="down">
                              <span class="caption-title"><?php echo exhibit_builder_link_to_exhibit_item($description, array(), $item); ?></span>
                              <?php #echo $attachment['caption']; ?>
                          </div>
                      <?php endif; ?>
                    
                    <?php endif; ?>
                        
                    <!-- <?php// echo file_markup($file, array('imageSize'=>'thumbnail','linkToFile'=>false, 'imgAttributes'=>array('alt' =>  "$altText", 'class' => 'sp-thumbnail', 'title' => metadata($item, array("Dublin Core", "Title"))))); ?> -->
                

            </div>           
        <?php endforeach; ?>
        
    </div>
        
</div>
<div class="exhibit-page-text">
    <?php echo $text; ?>
</div>

