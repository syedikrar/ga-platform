<?php 
use Illuminate\Support\Facades\Storage;

/**
 * minimize text
 *
 * @param $text, $limit
 * @return $text
 */
function addEllipsis($text, $max = 30)
{
    return strlen($text) > 30 ? mb_substr($text, 0, $max, "UTF-8") . "..." : $text;
}

function saveResizeImage($image, $directory, $type = 'jpg')
{
    if (!Storage::exists($directory)) {
        Storage::makeDirectory("$directory");
    }
    $doc = uniqid() . '.' . $type;
    $path = $directory . '/' . $doc;
    $image->storeAs($directory, $doc, 'public');
    return $path;
}

function getImage($image, $isAvatar = false, $withBaseurl = false)
{
    $errorImage = $isAvatar ? url('/assets/no_avatar.png') : url('images/dashboard/author-img.png');
    return !empty($image)  ? ($withBaseurl ?  url('/storage/' .$image) : Storage::url($image)) : $errorImage;
}
