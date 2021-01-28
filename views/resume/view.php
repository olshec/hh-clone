<?php

/* @var $this yii\web\View */

// $this->params['listResumeState'] = $listResumeState;
// $this->params['resumeState'] = $resumeState;
$addressServer = \yii\helpers\Url::to(['/']);

$this->title = 'Резюме PHP разработчик';
?>

    <div class="content p-rel">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mt8 mb32"><a href="<?= $addressServer ?>resume/my-resumes"><img src="<?= $addressServer ?>images/blue-left-arrow.svg" alt="arrow"> Назад</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-5 mobile-mb32">
                    <div class="profile-foto resume-profile-foto"><img src="<?=  $addressServer ?>ResumePhoto/<?= $resume['photo']?>" alt="profile-foto">
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="main-title d-md-flex justify-content-between align-items-center mobile-mb16"><?=  $resume['resume_name']; ?>
                    </div>
                    <div class="paragraph-lead mb16">
                    <?php if($resume['salary'] != 0):?>
                    	<span class="mr24"><?= number_format($resume['salary'], 0, '', ' ');  ?> ₽</span>
                    <?php endif; ?>
                        <span><?= $resume['experience_total']; ?></span>
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
                            <div class="profile-info__block-right company-profile-info__block-right"> <?= $resume['type_employment']; ?></div>
                        </div>
                        <div class="profile-info__block company-profile-info__block mb8">
                            <div class="profile-info__block-left company-profile-info__block-left">График работы
                            </div>
                            <div class="profile-info__block-right company-profile-info__block-right"><?= $resume['schedule']; ?>
                            </div>
                        </div>
                        <div class="profile-info__block company-profile-info__block mb8">
                            <div class="profile-info__block-left company-profile-info__block-left">Город проживания
                            </div>
                            <div class="profile-info__block-right company-profile-info__block-right"><?= $resume['city_name']; ?></div>
                        </div>
                        <div class="profile-info__block company-profile-info__block mb8">
                            <div class="profile-info__block-left company-profile-info__block-left">
                                Электронная почта
                            </div>
                            <div class="profile-info__block-right company-profile-info__block-right"><a
                                    href="#"><?= $resume['email']; ?></a></div>
                        </div>
                        <div class="profile-info__block company-profile-info__block mb8">
                            <div class="profile-info__block-left company-profile-info__block-left">
                                Телефон
                            </div>
                            <div class="profile-info__block-right company-profile-info__block-right"><a
                                    href="#"><?= $resume['telephone']; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="devide-border mb32 mt50"></div>
                    <div class="tabs mb50">
                        <div class="tabs__content active">
                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="row mb16">
                                        <div class="col-lg-12"><h3 class="heading mb16"><?= $resume['experience_total']; ?></h3></div>
                                        <?php foreach ($resume['place_of_work'] as $placeOfWork):?>
                                        <div class="col-md-4 mb16">
                                            <div class="paragraph tbold mb8"><?= $placeOfWork['date_work']; ?> </div>
                                            <div class="mini-paragraph"><?= $placeOfWork['date_experients']; ?></div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="paragraph tbold mb8"><?= $placeOfWork['name_organization']; ?></div>
                                            <div class="paragraph tbold mb8"><?= $placeOfWork['position']; ?>
                                            </div>
                                            <div class="paragraph"><?= $placeOfWork['about']; ?>
                                            </div>
                                        </div>
                                         <?php endforeach; ?>
                                    </div>
                                          
                                </div>
                                <div class="col-lg-7">
                                    <div class="company-profile-text mb64">
                                        <h3 class="heading mb16">Обо мне</h3>
                                        <?= $resume['about_me']; ?>
<!--                                         <p>С 2004 года работал в структурах АФК “Система”, в том числе и в качестве -->
<!--                                             основателя и руководителя компании “СИСТЕМА-ИНФОРМ“. За год работы вывел -->
<!--                                             ее в ТОП 100 ИТ компаний России. Отвечал за создание и развитие ИТ и -->
<!--                                             других бизнес-проектов, включая проекты по информационной безопасности -->
<!--                                             группы компаний АФК “Система”. <br><br> В 2005 году с командой -->
<!--                                             талантливых специалистов из города Твери создал компанию “Network -->
<!--                                             Systems Innovations“, которая разработала первую в России встраиваемую -->
<!--                                             операционную систему “PyrOS” для аппаратных Firewall и систем IDS/IPS -->
<!--                                             (системы обнаружения и предотвращения вторжений). Разработка была высоко -->
<!--                                             оценена специалистами отечественных и зарубежных компаний на -->
<!--                                             международной выставке CeBIT в Ганновере. <br><br> В 2006 году принял -->
<!--                                             участие в реорганизации и реинжиниренге бизнес-процессов компании -->
<!--                                             “РЕНОВА-СЕРВИС“. <br><br> В 2009 году создал и возглавлял -->
<!--                                             бизнес-направление “Ситроникс Системы Безопасности” в компании -->
<!--                                             “Sitronics”. Курировал реализацию различных проектов по ИТ и -->
<!--                                             информационной безопасности (ИБ) в дочерних структурах АФК “Система” -->
<!--                                             (ПАО “МТС”, ПАО “Башнефть”, ПАО “МГТС”, “Комстар-ОТС”, “МТУ-Интел” и -->
<!--                                             др.) <br><br> С 2012 года занялся созданием и развитием собственных -->
<!--                                             бизнес-проектов в области новых информационных технологий и -->
<!--                                             информационной безопасности. <br><br> Многие из решений и продуктов, -->
<!--                                             разработанных на базе запатентованных мною идей, используются тысячами -->
<!--                                             компаниями в России. Некоторые бизнес идеи и венчурные проекты ушли в -->
<!--                                             небытие, но есть и те, которые стали неотъемлемой частью больших -->
<!--                                             корпораций и предприятий. <br> <br> С 2018 года Член Совета ТПП РФ по -->
<!--                                             развитию информационных технологий и цифровой экономики. <br> <br> -->
<!--                                             Участник -->
<!--                                             Всероссийского конкурса “Лидеры России 2018-2020“. <br> <br> Участник и -->
<!--                                             спикер TEDx ForestersPark 2019. Видео на YouTube. <br> <br> Участник и -->
<!--                                             спикер -->
<!--                                             благотворительной ИТ-конференции CISummIT 2019 «Digital Hearts» и Фонда -->
<!--                                             Константина Хабенского. <br> <br> Автор книги “Цифровая трансформация“. -->
<!--                                             <br> -->
<!--                                             <br> На сегодняшний день, сфера моих интересов лежит в области -->
<!--                                             формирования новых уникальных бизнес-проектов в таких областях как: -->
<!--                                             «Цифровое бессмертие», «Робототехника», «Искусственный Интеллект», -->
<!--                                             «Цифровая экономика», «Интернет вещей», «Блокчейн», «Кибербезопасность» -->
<!--                                             и другие.</p> -->
<!--                                         показываются на страницах результатов поиска контекстно заданному поисковому -->
<!--                                         запросу. Небольшую -->
<!--                                         часть дохода Яндекс получает от медийной рекламы. Яндексу принадлежит -->
<!--                                         крупнейшая в России -->
<!--                                         система автоматического размещения рекламы Яндекс.Директ.</p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
            </div>
        </div>
    </div>
