<?php $counter = new Controller\Display(); ?>
<div id="content">
Currently there are 
<?php foreach ($counter->displayImageCount() as $count) { 
    echo $count; }?> 
    images.
</div>