<?php

/* @var $this yii\web\View */

// $this->params['listResumeState'] = $listResumeState;
// $this->params['resumeState'] = $resumeState;
$addressServer = \yii\helpers\Url::to(['/']);

$this->title = 'Создание нового резюме'
?>
    <div class="content p-rel">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mt8 mb40"><a href="<?= \yii\helpers\Url::to(['/']) ?>resume/my-resumes"><img src="<?= \yii\helpers\Url::to(['/']) ?>images/blue-left-arrow.svg" alt="arrow"> Вернуться без
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
                <form  method="get" action="http://localhost/hh-clone/web/resume/create">
                    <div class="row mb32">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Фото</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <div class="profile-foto-upload mb8" id="profile-photo" photo-name="profile-foto.jpg"><img src="#" alt="photo">
                            </div>
                            <label class="custom-file-upload" id="label-photo">
                                <input type="file" id="input-foto"  name="photo-profile" />
                                Изменить фото
                            </label>
                        </div>
                    </div>
                    <div class="row mb16">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Фамилия</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <input type="text" id="surname" class="dor-input w100"  name="surname" value="<?= $user['surname'] ?>">
                        </div>
                    </div>
                    <div class="row mb16">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Имя</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <input type="text" id="name" class="dor-input w100" name="name" value="<?= $user['name'] ?>">
                        </div>
                    </div>
                    <div class="row mb16">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Отчество</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <input type="text" id="patronymic" class="dor-input w100" name="patronymic" value="<?= $user['patronymic'] ?>">
                        </div>
                    </div>
                    <div class="row mb24">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Дата рождения</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <div class="datepicker-wrap input-group date">
                                <input type="text" id="date-birth" class="dor-input dpicker datepicker-input" name="date-birth" value="<?= $user['date_birth'] ?>">
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
                                    <input type="radio" id="gender-male" name="radio-gender[]" value="male" 
                                        <?= ($user['gender']=='male')? 'checked="true"':'' ?> >
                                    <label for="gender-male">Мужской</label>
                                </li>
                                <li>
                                    <input type="radio" id="gender-female" name="radio-gender[]" value="female"
                                     <?= ($user['gender']=='female')? 'checked="true"':'' ?> >
                                    <label for="gender-female">Женский</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row mb16">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Город проживания</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <input type="text" id="city" class="dor-input w100" name="city" value="<?= $user['city'] ?>">
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
                                <input type="text" id="email" class="dor-input w100"  name="email" value="<?= $user['email'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row mb32">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Телефон</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <div style="width: 140px;" class="p-rel mobile-w100">
                                <input type="text" id="telephone" class="dor-input w100" name="telephone" placeholder="+7 ___ ___-__-__"
                                value="<?= $user['telephone'] ?>">
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
                                <select class="nselect-1" id="specialization" name="specialization">
                                 <?php foreach ($listSpecialization as $specialization):?>
                                 	<option value="<?= $specialization['id'] ?>"><?= $specialization['name'] ?></option>
                                 <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <?php if(array_key_exists('resumeName', $errors)): ?>
                        <?= $errors['resumeName'] ?>
                        <?php endif;?>
                    </div>
                    <div class="row mb16">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Зарплата</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <div class="p-rel">
                                <input placeholder="От" type="text" id="salary" class="dor-input w100" name="salary">
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
                            
                                <?php foreach ($typeEmployments as $typeEmployment): ?>
                                	<div class="form-check d-flex">
                                        <input type="checkbox" name="type_employment[]" class="form-check-input" id="<?= 'type_employment'.$typeEmployment['id'] ?>" 
                                        	value="<?= $typeEmployment['id'] ?>">
                                        <label class="form-check-label" for="<?= 'type_employment'.$typeEmployment['id'] ?>"></label>
                                        <label for="<?= 'type_employment'.$typeEmployment['id'] ?>" class="profile-info__check-text job-resolution-checkbox"> <?= $typeEmployment['name'] ?></label>
                                	</div>
                            	<?php endforeach; ?>                            
                            </div>
                        </div>
                    </div>
                    <div class="row mb32">
                        <div class="col-lg-2 col-md-3">
                            <div class="paragraph">График работы</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <div class="profile-info">
                            	<?php foreach ($schedules as $schedule): ?>
                                	<div class="form-check d-flex">
                                        <input type="checkbox" name="type_schedule[]" class="form-check-input" id="<?= 'schedule'.$schedule['id'] ?>"
                                        	value="<?= $schedule['id'] ?>">
                                        <label class="form-check-label" for="<?= 'schedule'.$schedule['id'] ?>"></label>
                                        <label for="<?= 'schedule'.$schedule['id'] ?>" class="profile-info__check-text job-resolution-checkbox"> 
                                        	<?= ($schedule['name'] == 'Полный день')? '+':'' ?> <?= $schedule['name'] ?> </label>
                                    </div>
                        		<?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="row mb32">
                        <div class="col-12">
                            <div class="heading">Опыт работы</div>
                        </div>
                    </div>
                    <div class="row mb32">
                        <div class="col-lg-2 col-md-3">
                            <div class="paragraph">Опыт работы</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <ul class="card-ul-radio profile-radio-list">
                                <li>
                                    <input type="radio" id="radio-experience-no" name="radio-experience[]" value="no">
                                    <label for="radio-experience-no">Нет опыта работы</label>
                                </li>
                                <li>
                                    <input type="radio" id="radio-experience-yes" name="radio-experience[]" value="yes" checked>
                                    <label for="radio-experience-yes">Есть опыт работы</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    
                   <div class="list-job-experience">
                       <div class="job-experience">
                       
<!--                         <div class="list-month"> -->
                            <div class="row mb24">
                                <div class="col-lg-2 col-md-3 dflex-acenter">
                                    <div class="paragraph">Начало работы</div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-11">
                                    <div class="d-flex justify-content-between">
                                        <div class="citizenship-select w100 mr16">
                                            <select class="nselect-1 job-begin-month" data-title="Январь" name="job-begin-month[]">
                                                <option selected="selected" value="01">Январь</option>
                                                <option value="02">Февраль</option>
                                                <option value="03">Март</option>
                                                <option value="04">Апрель</option>
                                                <option value="05">Май</option>
                                                <option value="06">Июнь</option>
                                                <option value="07">Июль</option>
                                                <option value="08">Август</option>
                                                <option value="09">Сентябрь</option>
                                                <option value="10">Октябрь</option>
                                                <option value="11">Ноябрь</option>
                                                <option value="12">Декабрь</option>
                                            </select>
                                        </div>
                                        <div class="citizenship-select w100">
                                            <input placeholder="2006" type="text" name="job-begin-year[]" class="dor-input w100 job-begin-year">
                                        </div>
                                    </div>
                                </div>
                             </div> 
<!--                            </div> -->
                            
                            <div class="row mb8">
                                <div class="col-lg-2 col-md-3 dflex-acenter">
                                    <div class="paragraph">Окончание работы</div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-11">
                                    <div class="d-flex justify-content-between">
                                        <div class="citizenship-select w100 mr16">
                                            <select class="nselect-1 job-end-month" data-title="Январь" name="job-end-month[]">
                                                <option selected="selected" value="01">Январь</option>
                                                <option value="02">Февраль</option>
                                                <option value="03">Март</option>
                                                <option value="04">Апрель</option>
                                                <option value="05">Май</option>
                                                <option value="06">Июнь</option>
                                                <option value="07">Июль</option>
                                                <option value="08">Август</option>
                                                <option value="09">Сентябрь</option>
                                                <option value="10">Октябрь</option>
                                                <option value="11">Ноябрь</option>
                                                <option value="12">Декабрь</option>
                                            </select>
                                        </div>
                                        <div class="citizenship-select w100">
                                            <input placeholder="2006" type="text" name="job-end-year[]" class="dor-input w100 job-end-year">
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
                                            <input type="checkbox" class="form-check-input job-until-now" id="job-until-now-1" name="job-until-now[]">
                                            <label class="form-check-label" for="job-until-now-1"></label>
                                            <label for="job-until-now-1"
                                                   class="profile-info__check-text job-resolution-checkbox">По настоящее время</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb16">
                                <div class="col-lg-2 col-md-3 dflex-acenter">
                                    <div class="paragraph">Организация</div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-11">
                                    <input type="text" name="organisation[]" class="dor-input w100 organisation">
                                </div>
                            </div>
                            <div class="row mb16">
                                <div class="col-lg-2 col-md-3 dflex-acenter">
                                    <div class="paragraph">Должность</div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-11">
                                    <input type="text" name="position[]" class="dor-input w100 position">
                                </div>
                            </div>
                            <div class="row mb16">
                                <div class="col-lg-2 col-md-3">
                                    <div class="paragraph">Обязанности, функции, достижения</div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 job-container">
                                    <textarea name="about-experient[]" class="dor-input w100 h96 mb8 about-experient"
                                              placeholder="Расскажите о своих обязанностях, функциях и достижениях"></textarea>
                                    <div class="mb24"><a href="#" class="job-experience-link-remove">Удалить место работы</a></div>
                                    <div id="job-node-add"><a href="#" id="job-experience-link-add" >+ Добавить место работы</a></div>
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
                            <textarea id="about-me" name="about-me" class="dor-input w100 h176 mb8"></textarea>
                        </div>
                    </div>
                    <div class="row mb128 mobile-mb64">
                        <div class="col-lg-2 col-md-3">
                        </div>
                        <div class="col-lg-10 col-md-9">
                            <a href="#" class="orange-btn link-orange-btn" id="saveFormButton">Сохранить</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?= $addressServer?>js/resume.js"> </script>
    <script> 
   	window.onload = afterPageLoad();
	</script>
    