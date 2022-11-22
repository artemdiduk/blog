<?php
$allArticelCategor = $data;
?>

<?php foreach ($allArticelCategor as $article): ?>
<div class="col-md-12 border-bottom">
    <div class="row">
        <div class="col-4">
            <a href="/blog/<?=$article['url']?>"><?=$article['name']?></a>
        </div>
    </div>
</div>
<?php endforeach; ?>
