<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\modules\admin\assets\AppAsset;
use app\modules\main\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'На сайт',
                'brandUrl' => Yii::$app->homeUrl,
                'innerContainerOptions'=>['class'=>'container-fluid'],
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-left'],
                'items' => [
                    ['label' => 'Страницы', 'url' => ['/page/page-admin/index']],
                    ['label' => 'Пользователи', 'url' => ['/user/user-admin/index']],
                    [
                        'label' => 'Выход (' . Yii::$app->user->identity->username . ')',
                        'url' => ['/user/default/logout'],
                        'linkOptions' => ['data-method' => 'post']
                    ],
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    [
                        'label' => 'Очистить кеш',
                        'url' => '#',
                        'linkOptions'=>[
                            'class'=>'ajax-button',
                            'data-url'=>\yii\helpers\Url::toRoute(['/admin/ajax/clear-cache']),
                            'data-state'=>'Очистка...',
                            'data-success'=>'Очищено',
                        ]
                    ],
                ],
            ]);
            NavBar::end();
        ?>

        <div class="container-fluid main-container">
            <div class="row">
                <div class="col-sm-3 col-md-2">
                    <?php if(isset($this->params['menu'])): ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">Действия</div>
                            <div class="panel-body">
                                <?= Nav::widget(['options'=>['class'=>'nav nav-pills nav-stacked'], 'items'=>$this->params['menu']]) ?>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
                <div class="col-sm-9 col-md-10">
                    <?= Breadcrumbs::widget([
                        'homeLink'=>[
                            'label'=>'Главная',
                            'url'=>['/admin/default/index']
                        ],
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                    <?= Alert::widget() ?>
                    <?= $content ?>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container-fluid">
            <p class="pull-left">&copy; <?= date('Y') ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
