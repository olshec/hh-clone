<?php

/* @var $this yii\web\View */

// $this->params['listResumeState'] = $listResumeState;
// $this->params['resumeState'] = $resumeState;

$this->title = 'Резюме PHP разработчик';
?>

    <div class="content p-rel">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mt8 mb32"><a href="#"><img src="<?= \yii\helpers\Url::to(['/']) ?>images/blue-left-arrow.svg" alt="arrow"> Резюме в
                        Кемерово</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-5 mobile-mb32">
                    <div class="profile-foto resume-profile-foto"><img src="<?= \yii\helpers\Url::to(['/']) ?>images/profile-foto.jpg" alt="profile-foto">
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="main-title d-md-flex justify-content-between align-items-center mobile-mb16"><?=  $resume['resume_name']; ?>
                    </div>
                    <div class="paragraph-lead mb16">
                        <span class="mr24"><?= number_format($resume['salary'], 0, '', ' ');  ?> ₽</span>
                        <span><?= $resume['experience']; ?></span>
                    </div>
                    <div class="profile-info company-profile-info resume-view__info-blick">
                        <div class="profile-info__block company-profile-info__block mb8">
                            <div class="profile-info__block-left company-profile-info__block-left">Имя
                            </div>
                            <div class="profile-info__block-right company-profile-info__block-right"><?= $resume['user_surname']; ?> <?= $resume['user_name']; ?>
                                <?= $resume['user_patronymic']; ?> 
                            </div>
                        </div>
                        <div class="profile-info__block company-profile-info__block mb8">
                            <div class="profile-info__block-left company-profile-info__block-left">Возраст
                            </div>
                            <div class="profile-info__block-right company-profile-info__block-right"><?= $resume['age']; ?></div>
                        </div>
                        <div class="profile-info__block company-profile-info__block mb8">
                            <div class="profile-info__block-left company-profile-info__block-left">Занятость</div>
                            <div class="profile-info__block-right company-profile-info__block-right">Полная</div>
                        </div>
                        <div class="profile-info__block company-profile-info__block mb8">
                            <div class="profile-info__block-left company-profile-info__block-left">График работы
                            </div>
                            <div class="profile-info__block-right company-profile-info__block-right">Гибкий график,
                                полный день
                            </div>
                        </div>
                        <div class="profile-info__block company-profile-info__block mb8">
                            <div class="profile-info__block-left company-profile-info__block-left">Город проживания
                            </div>
                            <div class="profile-info__block-right company-profile-info__block-right">Кемерово</div>
                        </div>
                        <div class="profile-info__block company-profile-info__block mb8">
                            <div class="profile-info__block-left company-profile-info__block-left">
                                Электронная почта
                            </div>
                            <div class="profile-info__block-right company-profile-info__block-right"><a
                                    href="#">test@example.com</a></div>
                        </div>
                        <div class="profile-info__block company-profile-info__block mb8">
                            <div class="profile-info__block-left company-profile-info__block-left">
                                Телефон
                            </div>
                            <div class="profile-info__block-right company-profile-info__block-right"><a
                                    href="#">+7 123 456 78 90</a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
