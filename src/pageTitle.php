<?php
function render_header($title, $subtitle, $filename) {
?>

<div class="pt-16"></div>
<div class="w-full h-[380px] flex justify-center items-center text-white " style="background-image: url(./image/titleBg/<?php echo $filename; ?>.png);" >
    <div class="flex justify-center items-center flex-col">
        <div id="pageTitle" class="text-[72px] font-semibold tracking-wider"><?php echo $title; ?></div>
        <div id="pageSubTitle" class=""><?php echo $subtitle; ?></div>
    </div>
</div>

<?php
}
?>
