<?php

namespace app\controllers;

use Yii;
use app\models\FileGallery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * FilegalleryController implements the CRUD actions for FileGallery model.
 */
class FilegalleryController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'delete' ],
                'rules' => [
                    [
                        'actions' => ['create', 'delete' ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];


    }

    public function actionCreate($gallery_id)
    {
        $model = new FileGallery();
        $model->gallery_id      = $gallery_id;

        if ($model->load(Yii::$app->request->post())) {

            // иначе мне смог сделать проверку на обязательное указание файлов
            $model->image           = 1;
            $model->image_thumb     = 1;

            if ($model->validate()) {

                if ($model->save()) { // сохраним модель для уникальново имени файла картинки $file_thumb->baseName . $model_file->id

                    $file = UploadedFile::getInstance($model, 'image');
                    $patch_file = 'images/gallery/' . md5($file->baseName . $model->id) . '.' . $file->extension;

                    $file_thumb = UploadedFile::getInstance($model, 'image_thumb');
                    $patch_file_thumb = 'images/gallery/' . md5($file_thumb->baseName . $model->id.'thumb') . '.' . $file_thumb->extension;

                    if (($file->saveAs($patch_file)) && ($file_thumb->saveAs($patch_file_thumb))) {
                        $model->filename = $file->baseName . '.' . $file->extension;
                        $model->filepath = $patch_file;
                        $model->image = 1;

                        $model->filename_thumb = $file_thumb->baseName . '.' . $file_thumb->extension;
                        $model->filepath_thumb = $patch_file_thumb;
                        $model->image_thumb = 1;

                        if ($model->save()) {
                            return $this->redirect(['gallery/view',
                                'id' => $gallery_id,
                            ]);
                        }
                    }
                }
            }

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FileGallery model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $file_gallery = $this->findModel( $id );
        $gallery_id = $file_gallery->gallery_id;

        $file_gallery->delete();

        return $this->redirect(['gallery/view', 'id' => $gallery_id]);
    }

    /**
     * Finds the FileGallery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FileGallery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FileGallery::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
