<?php

namespace app\controllers;

use Yii;
use app\models\ChatMessage;
use app\models\Application;
use app\models\AdminSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * AdminController implements the CRUD actions for Application model.
 */
class AdminController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }
public function actionUpdateCar($id)
{
    $model = \app\models\Car::findOne($id);
    
    if (!$model) {
        throw new \yii\web\NotFoundHttpException();
    }
    
    $categories = \app\models\Category::find()->all();
    $selectedCharacteristics = [];
    foreach ($model->carCharacteristics as $cc) {
        if ($cc->characteristic && $cc->characteristic->category) {
            $selectedCharacteristics[$cc->characteristic->category_id] = $cc->characteristic_id;
        }
    }
    
    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        
        // Обновление характеристик
        \app\models\CarCharacteristic::deleteAll(['car_id' => $model->id]);
        
        $characteristics = Yii::$app->request->post('characteristics');
        if (!empty($characteristics) && is_array($characteristics)) {
            foreach ($characteristics as $categoryId => $characteristicId) {
                if (!empty($characteristicId)) {
                    $carCharacteristic = new \app\models\CarCharacteristic();
                    $carCharacteristic->car_id = $model->id;
                    $carCharacteristic->characteristic_id = $characteristicId;
                    $carCharacteristic->save();
                }
            }
        }
        

        $images = \yii\web\UploadedFile::getInstancesByName('images');
        
        if (!empty($images)) {
            foreach ($images as $file) {
                if ($file && !$file->hasError) {
                    $fileName = '/images/' . uniqid() . '.' . $file->extension;
                    $filePath = Yii::getAlias('@webroot') . $fileName;
                    
                    if ($file->saveAs($filePath)) {
                        $img = new \app\models\CarImage();
                        $img->car_id = $model->id;
                        $img->image_path = $fileName;
                        $img->save();
                    } else {
                        Yii::error('Ошибка сохранения файла: ' . $file->name);
                    }
                }
            }
        }
        
        Yii::$app->session->setFlash('success', 'Информация об автомобиле обновлена');
        return $this->redirect(['/car/index']);
    }
    
    return $this->render('update', [
        'model' => $model,
        'categories' => $categories,
        'selectedCharacteristics' => $selectedCharacteristics,
    ]);
}
public function actionDeleteImage($id)
{
    $image = \app\models\CarImage::findOne($id);
    
    if ($image) {
        $filePath = Yii::getAlias('@webroot') . $image->image_path;

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $image->delete();
        
        Yii::$app->session->setFlash('success', 'Изображение удалено');
    } else {
        Yii::$app->session->setFlash('error', 'Изображение не найдено');
    }
    
    return $this->redirect(Yii::$app->request->referrer);
}
    /**
     * Lists all Application models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AdminSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Application model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Application model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Application();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Application model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Application model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Application model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Application the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Application::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAdmin()
{
    $applications = \app\models\Application::find()
        ->with(['car', 'car.carCharacteristics.characteristic.category', 'status'])
        ->orderBy(['id' => SORT_DESC])
        ->all();

    return $this->render('admin', [
        'applications' => $applications,
    ]);
}

    public function actionChangeStatus($id, $alias)
    {
        $application = \app\models\Application::findOne($id);

        if (!$application) {
            throw new \yii\web\NotFoundHttpException();
        }

        $application->status_id = \app\models\Status::getIdByAlias($alias);
        $application->save(false);

        return $this->redirect(['admin/applications']);
    }

   public function actionApplications()
{
    // Получаем все заявки с подгрузкой связанных данных
    $applications = \app\models\Application::find()
        ->with(['car', 'car.carCharacteristics.characteristic.category', 'status'])
        ->orderBy(['id' => SORT_DESC])
        ->all();
    
    return $this->render('applications', [
        'applications' => $applications,
    ]);
}

    public function actionCreateCarForm()
{
    $model = new \app\models\Car();
    $categories = \app\models\Category::find()
        ->with('characteristics')
        ->all();
    
    if ($model->load(Yii::$app->request->post())) {
        
        // Сохраняем автомобиль
        if ($model->save()) {
            
           
            $characteristics = Yii::$app->request->post('characteristics');
            
            if ($characteristics && is_array($characteristics)) {
                foreach ($characteristics as $categoryId => $characteristicId) {
                    if (!empty($characteristicId)) {
                        $carCharacteristic = new \app\models\CarCharacteristic();
                        $carCharacteristic->car_id = $model->id;
                        $carCharacteristic->characteristic_id = $characteristicId;
                        $carCharacteristic->save();
                    }
                }
            }
            
            // Загрузка фото
            $images = \yii\web\UploadedFile::getInstancesByName('images');
            foreach ($images as $file) {
                $fileName = '/images/' . uniqid() . '.' . $file->extension;
                $file->saveAs(Yii::getAlias('@webroot') . $fileName);
                
                $img = new \app\models\CarImage();
                $img->car_id = $model->id;
                $img->image_path = $fileName;
                $img->save();
            }
            
            Yii::$app->session->setFlash('success', 'Автомобиль успешно создан');
            return $this->redirect(['/car/index']);
        }
    }
    
    return $this->render('create-car-form', [
        'model' => $model,
        'categories' => $categories,
    ]);
}



    public function actionCreateCar()
{
    $model = new \app\models\Car();

    if ($model->load(Yii::$app->request->post()) && $model->save()) {

    


        $characteristics = Yii::$app->request->post('characteristics');

        if ($characteristics) {

            foreach ($characteristics as $categoryId => $characteristicId) {

                if ($characteristicId) {

                    $carCharacteristic = new \app\models\CarCharacteristic();

                    $carCharacteristic->car_id = $model->id;

                    $carCharacteristic->characteristic_id = $characteristicId;

                    $carCharacteristic->save();
                }
            }
        }

      

        $images = UploadedFile::getInstancesByName('images');

        foreach ($images as $file) {

            $fileName = '/images/' . uniqid() . '.' . $file->extension;

            $file->saveAs(
                Yii::getAlias('@webroot') . $fileName
            );

            $img = new \app\models\CarImage();

            $img->car_id = $model->id;

            $img->image_path = $fileName;

            $img->save();
        }

        Yii::$app->session->setFlash(
            'success',
            'Автомобиль успешно создан'
        );

        return $this->redirect(['/car/index']);
    }

    return $this->render('create-car', [
        'model' => $model,
        'categories' => \app\models\Category::find()->all(),
    ]);
}
    






public function actionSpecifications()
{
    $category = new \app\models\Category();
    $characteristic = new \app\models\Characteristic();

    // создание категории
    if ($category->load(Yii::$app->request->post())
        && $category->save()) {

        Yii::$app->session->setFlash(
            'success',
            'Категория создана'
        );

        return $this->refresh();
    }

    // создание характеристики
    if ($characteristic->load(Yii::$app->request->post())
        && $characteristic->save()) {

        Yii::$app->session->setFlash(
            'success',
            'Характеристика добавлена'
        );

        return $this->refresh();
    }

    return $this->render('specifications', [
        'category' => $category,
        'characteristic' => $characteristic,
        'categories' => \app\models\Category::find()->all(),
        'characteristics' => \app\models\Characteristic::find()
            ->with('category')
            ->all(),
    ]);
}





// Удаление автомобиля
public function actionDeleteCar($id)
{
    $car = \app\models\Car::findOne($id);
    
    if (!$car) {
        Yii::$app->session->setFlash('error', 'Автомобиль не найден');
        return $this->redirect(['/car/index']);
    }
    
    // Удаляем связанные изображения
    foreach ($car->carImages as $image) {
        $filePath = Yii::getAlias('@webroot') . $image->image_path;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $image->delete();
    }
    
    // Удаляем связанные характеристики
    \app\models\CarCharacteristic::deleteAll(['car_id' => $car->id]);
    
    // Удаляем автомобиль
    $car->delete();
    
    Yii::$app->session->setFlash('success', 'Автомобиль удален');
    return $this->redirect(['/car/index']);
}

// Скрыть автомобиль (сделать недоступным для бронирования)
public function actionHideCar($id)
{
    $car = \app\models\Car::findOne($id);
    
    if ($car) {
        $car->is_available = 0;
        $car->save();
        Yii::$app->session->setFlash('success', 'Автомобиль скрыт');
    }
    
    return $this->redirect(['/car/index']);
}

// Показать автомобиль (сделать доступным для бронирования)
public function actionShowCar($id)
{
    $car = \app\models\Car::findOne($id);
    
    if ($car) {
        $car->is_available = 1;
        $car->save();
        Yii::$app->session->setFlash('success', 'Автомобиль снова доступен для бронирования');
    }
    
    return $this->redirect(['/car/index']);
}



public function actionChat($id)
{
    $application = Application::findOne($id);

    if (!$application) {
        throw new \yii\web\NotFoundHttpException();
        
    }
ChatMessage::updateAll(
    ['is_read' => 1],
    [
        'application_id' => $id,
        'is_read' => 0
    ]
);
    $message = new ChatMessage();

    if ($message->load(Yii::$app->request->post())) {

        $message->application_id = $application->id;

        $message->user_id = Yii::$app->user->id;

        $message->created_at = date('Y-m-d H:i:s');

        $message->save();

        return $this->refresh();
    }

    $messages = ChatMessage::find()
        ->where([
            'application_id' => $application->id
        ])
        ->orderBy([
            'created_at' => SORT_ASC
        ])
        ->all();

    return $this->render('chat', [
        'application' => $application,
        'messages' => $messages,
        'message' => $message,
    ]);
}
}
