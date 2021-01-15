<?php

/* @var $this yii\web\View */

// $this->params['listResumeState'] = $listResumeState;
// $this->params['resumeState'] = $resumeState;

$this->title = 'Создание нового резюме'
?>
    <div class="content p-rel">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mt8 mb40"><a href="#"><img src="<?= \yii\helpers\Url::to(['/']) ?>images/blue-left-arrow.svg" alt="arrow"> Вернуться без
                        сохранения</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-title mb24">Новое резюме</div>
                </div>
            </div>
            <div class="col-12">
                <form action="#">
                    <div class="row mb32">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Фото</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <div class="profile-foto-upload mb8"><img src="<?= \yii\helpers\Url::to(['/']) ?>images/profile-foto.jpg" alt="foto">
                            </div>
                            <label class="custom-file-upload">
                                <input type="file"/>
                                Изменить фото
                            </label>
                        </div>
                    </div>
                    <div class="row mb16">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Фамилия</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <input type="text" class="dor-input w100">
                        </div>
                    </div>
                    <div class="row mb16">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Имя</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <input type="text" class="dor-input w100">
                        </div>
                    </div>
                    <div class="row mb16">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Отчество</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <input type="text" class="dor-input w100">
                        </div>
                    </div>
                    <div class="row mb24">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Дата рождения</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <div class="datepicker-wrap input-group date">
                                <input type="text" class="dor-input dpicker datepicker-input">
                                <img src="<?= \yii\helpers\Url::to(['/']) ?>images/mdi_calendar_today.svg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="row mb16">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Пол</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <ul class="card-ul-radio profile-radio-list">
                                <li>
                                    <input type="radio" id="test1" name="radio-group" checked>
                                    <label for="test1">Мужской</label>
                                </li>
                                <li>
                                    <input type="radio" id="test2" name="radio-group">
                                    <label for="test2">Женский</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row mb16">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Город проживания</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <input type="text" class="dor-input w100">
                        </div>
                    </div>
                    <div class="row mb16">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="heading">Способы связи</div>
                        </div>
                        <div class="col-lg-7 col-10"></div>
                    </div>
                    <div class="row mb24">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Электронная почта</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <div class="p-rel">
                                <input type="text" class="dor-input w100">
                            </div>
                        </div>
                    </div>
                    <div class="row mb32">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Телефон</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <div style="width: 140px;" class="p-rel mobile-w100">
                                <input type="text" class="dor-input w100" placeholder="+7 ___ ___-__-__">
                            </div>
                        </div>
                    </div>
                    <div class="row mb24">
                        <div class="col-12">
                            <div class="heading">Желаемая должность</div>
                        </div>
                    </div>
                    <div class="row mb16">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Специализация</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <div class="citizenship-select">
                                <select class="nselect-1" data-title="Программист">
                                    <option value="01">Программист</option>
                                    <option value="02">Дизайнер</option>
                                    <option value="03">Повар</option>
                                    <option value="04">Акробат</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb16">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Зарплата</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <div class="p-rel">
                                <input placeholder="От" type="text" class="dor-input w100">
                                <img class="rub-icon" src="<?= \yii\helpers\Url::to(['/']) ?>images/rub-icon.svg" alt="rub-icon">
                            </div>
                        </div>
                    </div>
                    <div class="row mb32">
                        <div class="col-lg-2 col-md-3">
                            <div class="paragraph">Занятость</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <div class="profile-info">
                                <div class="form-check d-flex">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1"></label>
                                    <label for="exampleCheck1" class="profile-info__check-text job-resolution-checkbox">Полная
                                        занятость</label>
                                </div>
                                <div class="form-check d-flex">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck2">
                                    <label class="form-check-label" for="exampleCheck2"></label>
                                    <label for="exampleCheck2" class="profile-info__check-text job-resolution-checkbox">Частичная
                                        занятость</label>
                                </div>
                                <div class="form-check d-flex">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck3">
                                    <label class="form-check-label" for="exampleCheck3"></label>
                                    <label for="exampleCheck3" class="profile-info__check-text job-resolution-checkbox">Проектная/Временная
                                        работа</label>
                                </div>
                                <div class="form-check d-flex">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck4">
                                    <label class="form-check-label" for="exampleCheck4"></label>
                                    <label for="exampleCheck4" class="profile-info__check-text job-resolution-checkbox">Волонтёрство</label>
                                </div>
                                <div class="form-check d-flex">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck5">
                                    <label class="form-check-label" for="exampleCheck5"></label>
                                    <label for="exampleCheck5" class="profile-info__check-text job-resolution-checkbox">Стажировка</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb32">
                        <div class="col-lg-2 col-md-3">
                            <div class="paragraph">График работы</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <div class="profile-info">
                                <div class="form-check d-flex">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck6">
                                    <label class="form-check-label" for="exampleCheck6"></label>
                                    <label for="exampleCheck6" class="profile-info__check-text job-resolution-checkbox">Полный
                                        день</label>
                                </div>
                                <div class="form-check d-flex">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck7">
                                    <label class="form-check-label" for="exampleCheck7"></label>
                                    <label for="exampleCheck7" class="profile-info__check-text job-resolution-checkbox">Сменный
                                        график</label>
                                </div>
                                <div class="form-check d-flex">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck8">
                                    <label class="form-check-label" for="exampleCheck8"></label>
                                    <label for="exampleCheck8" class="profile-info__check-text job-resolution-checkbox">Гибкий
                                        график</label>
                                </div>
                                <div class="form-check d-flex">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck9">
                                    <label class="form-check-label" for="exampleCheck9"></label>
                                    <label for="exampleCheck9" class="profile-info__check-text job-resolution-checkbox">Удалённая
                                        работа</label>
                                </div>
                                <div class="form-check d-flex">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck10">
                                    <label class="form-check-label" for="exampleCheck10"></label>
                                    <label for="exampleCheck10"
                                           class="profile-info__check-text job-resolution-checkbox">Вахтовый
                                        метод</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb32">
                        <div class="col-12">
                            <div class="heading">Опыт работы</div>
                        </div>
                    </div>
                    
                    
                    
                    
                   <div class="list-job-experience">
                       <div class="job-experience">
                            <div class="row mb32">
                                <div class="col-lg-2 col-md-3">
                                    <div class="paragraph">Опыт работы</div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-11">
                                    <ul class="card-ul-radio profile-radio-list">
                                        <li>
                                            <input type="radio" id="test9131" name="radio-group3123" checked="">
                                            <label for="test9131">Нет опыта работы</label>
                                        </li>
                                        <li>
                                            <input type="radio" id="test10242" name="radio-group3123">
                                            <label for="test10242">Есть опыт работы</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row mb24">
                                <div class="col-lg-2 col-md-3 dflex-acenter">
                                    <div class="paragraph">Начало работы</div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-11">
                                    <div class="d-flex justify-content-between">
                                        <div class="citizenship-select w100 mr16">
                                            <select class="nselect-1" data-title="Май">
                                                <option value="01">Июнь</option>
                                                <option value="02">Июль</option>
                                                <option value="03">Август</option>
                                                <option value="04">Сентябрь</option>
                                            </select>
                                        </div>
                                        <div class="citizenship-select w100">
                                            <input placeholder="2006" type="text" class="dor-input w100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb8">
                                <div class="col-lg-2 col-md-3 dflex-acenter">
                                    <div class="paragraph">Окончание работы</div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-11">
                                    <div class="d-flex justify-content-between">
                                        <div class="citizenship-select w100 mr16">
                                            <select class="nselect-1" data-title="Март">
                                                <option value="01">Июнь</option>
                                                <option value="02">Июль</option>
                                                <option value="03">Август</option>
                                                <option value="04">Сентябрь</option>
                                            </select>
                                        </div>
                                        <div class="citizenship-select w100">
                                            <input placeholder="2006" type="text" class="dor-input w100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb32">
                                <div class="col-lg-2 col-md-3">
                                </div>
                                <div class="col-lg-3 col-md-4 col-11">
                                    <div class="profile-info">
                                        <div class="form-check d-flex">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck111">
                                            <label class="form-check-label" for="exampleCheck111"></label>
                                            <label for="exampleCheck111"
                                                   class="profile-info__check-text job-resolution-checkbox">По настоящее
                                                время</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb16">
                                <div class="col-lg-2 col-md-3 dflex-acenter">
                                    <div class="paragraph">Организация</div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-11">
                                    <input type="text" class="dor-input w100">
                                </div>
                            </div>
                            <div class="row mb16">
                                <div class="col-lg-2 col-md-3 dflex-acenter">
                                    <div class="paragraph">Должность</div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-11">
                                    <input type="text" class="dor-input w100">
                                </div>
                            </div>
                            <div class="row mb16">
                                <div class="col-lg-2 col-md-3">
                                    <div class="paragraph">Обязанности, функции, достижения</div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12">
                                    <textarea class="dor-input w100 h96 mb8"
                                              placeholder="Расскажите о своих обязанностях, функциях и достижениях"></textarea>
                                    <div class="mb24"><a href="#">Удалить место работы</a></div>
                                    <div><a href="#" id="add-job-experience">+ Добавить место работы</a></div>
                                </div>
                            </div>
                            <div class="row mb24">
                                <div class="col-lg-2 col-md-3">
                                </div>
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="devide-border"></div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    
                    
                    
                    
                    
                    <div class="row mb32">
                        <div class="col-12">
                            <div class="heading">Расскажите о себе</div>
                        </div>
                    </div>
                    <div class="row mb64 mobile-mb32">
                        <div class="col-lg-2 col-md-3">
                            <div class="paragraph">О себе</div>
                        </div>
                        <div class="col-lg-5 col-md-7 col-12">
                            <textarea class="dor-input w100 h176 mb8"></textarea>
                        </div>
                    </div>
                    <div class="row mb128 mobile-mb64">
                        <div class="col-lg-2 col-md-3">
                        </div>
                        <div class="col-lg-10 col-md-9">
                            <a href="#" class="orange-btn link-orange-btn">Сохранить</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?= $addressServer?>js/resume.js"> </script>
    