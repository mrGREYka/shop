<?php

use yii\helpers\Html;

$number_row = 0;


foreach ($files_gallery as $file_gallery_item):
    $number_row++; ?>
    <div class="col-lg-3 col-xs-6 col-md-4 col-sm-6">
        <div class="thumbnail">
            <a href="<?= Yii::$app->homeUrl . $file_gallery_item->filepath_thumb ?>"
               class="magnific-popap">
                <img src="<?= Yii::$app->homeUrl . $file_gallery_item->filepath ?>" alt="<?= $file_gallery_item->title ?>">
            </a>

            <div class="caption">
                <?= Html::a('Удалить',
                    ['filegallery/delete', 'id' => $file_gallery_item->id,],
                    ['class' => 'label label-danger',
                        'data' => [
                            'confirm' => 'Вы уверены что хотите удалить картинку?',
                            'method' => 'post',],
                    ]) ?>
            </div>

        </div>
    </div>
<?php endforeach;

