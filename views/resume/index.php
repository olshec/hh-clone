<?php
/* @var $this yii\web\View */

// $this->params['listResumeState'] = $listResumeState;
// $this->params['resumeState'] = $resumeState;
$addressServer = \yii\helpers\Url::to(['/']);

$this->title = 'Список резюме';
?>
        <div class="header-search">
            <div class="container">
                <div class="header-search__wrap">
                    <form class="header-search__form">
                        <a href="#" id="full-text-serch-img"><img src="<?=  \yii\helpers\Url::to(['/']) ?>images/dark-search.svg" alt="search"
                                         class="dark-search-icon header-search__icon"></a>
                        <input id="full-text-serch" class="header-search__input" type="text" placeholder="Поиск по резюме и навыкам">
                        <button id="btn-serch" type="button" class="blue-btn header-search__btn">Найти</button>
                    </form>
                </div>
            </div>
        </div>
    
        <div class="content">
        <div class="container">
            <h1 class="main-title mt24 mb16">PHP разработчики <?= $cityIdSelect == 0? '': 'в '.$cityNameSelect?></h1>
            <button class="vacancy-filter-btn">Фильтр</button>
            <div class="row">
                <div class="col-lg-9 desctop-992-pr-16">
                    <div class="d-flex align-items-center flex-wrap mb8">
                        <span class="paragraph mr16">Найдено <?= count($resumeModels);?> резюме</span>
                        <div class="vakancy-page-header-dropdowns">
                            <div class="vakancy-page-wrap show mr16">
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">За день</a>
                                    <a class="dropdown-item" href="#">За год</a>
                                    <a class="dropdown-item" href="#">За все время</a>
                                </div>
                            </div>
                            <div class="vakancy-page-wrap show"  >
                                <a class="vakancy-page-btn vakancy-btn dropdown-toggle" href="#" role="button"
                                   id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false">
                                    <?= $typeSort ?>
                                    <i class="fas fa-angle-down arrowDown"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" >
                                    <a class="dropdown-item" href="<?= $addressServer?>resume#" onclick="serchTypeSort('new'); return false;">По новизне</a>
                                    <a class="dropdown-item" href="<?= $addressServer?>resume#" onclick="serchTypeSort('inc-salary'); return false;">По возрастанию зарплаты</a>
                                    <a class="dropdown-item" href="<?= $addressServer?>resume#" onclick="serchTypeSort('desc-salary'); return false;">По убыванию зарплаты</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php foreach ($resumeModels as $resume):?>
                    <div class="vakancy-page-block company-list-search__block resume-list__block p-rel mb16">
                        <div class="company-list-search__block-left">
                            <div class="resume-list__block-img mb8">
                                <img src="<?=  $addressServer ?>ResumePhoto/<?= $resume['photo']?>" alt="profile">
                            </div>
                        </div>
                        <div class="company-list-search__block-right">
                            <div class="mini-paragraph cadet-blue mobile-mb12">Обновлено <?= $resume['dateUpdate'] ?> </div>
                            <h3 class="mini-title mobile-off"><?= $resume['name'] ?></h3>
                            <div class="d-flex align-items-center flex-wrap mb8 ">
                                <span class="mr16 paragraph"><?= number_format($resume['salary'], 0, '', ' ');  ?></span>
                                <span class="mr16 paragraph"><?= $resume['experience'] ?></span>
                                <span class="mr16 paragraph"><?= $resume['age'] ?> </span>
                                <span class="mr16 paragraph"><?= $resume['city'] ?></span>
                            </div>
                            <p class="paragraph tbold mobile-off">Последнее место работы</p>
                        </div>
                        <div class="company-list-search__block-middle">
                            <h3 class="mini-title desktop-off">PHP разработчик</h3>
                            <p class="paragraph mb16 mobile-mb32"><?= $resume['infoAboutLastWork'] ?></p>
                        </div>
                    </div>
                   <?php endforeach; ?>
                   	<?= $stringPagination?>
<!--                     <ul class="dor-pagination mb128"> -->
<!--                         <li class="page-link-prev"><a href="#"><img class="mr8" -->
<!--                                                                     src="< ?= $addressServer ?>images/mini-left-arrow.svg" alt="arrow"> Назад</a> -->
<!--                         </li> -->
<!--                         <li><a href="#">1</a></li> -->
<!--                         <li><a class="grey" href="#">...</a></li> -->
<!--                         <li class="active"><a href="#">4</a></li> -->
<!--                         <li><a href="#">5</a></li> -->
<!--                         <li><a class="grey" href="#">...</a></li> -->
<!--                         <li><a href="#">10</a></li> -->
<!--                         <li class="page-link-next"><a href="#">Далее <img class="ml8" -->
<!--                                                                           src="< ?= $addressServer ?>images/mini-right-arrow.svg" alt="arrow"></a> -->
<!--                         </li> -->
<!--                     </ul> -->
                </div>
                <div class="col-lg-3 desctop-992-pl-16 d-flex flex-column vakancy-page-filter-block vakancy-page-filter-block-dnone">
                    <div
                            class="vakancy-page-filter-block__row mobile-flex-992 mb24 d-flex justify-content-between align-items-center">
                        <div class="heading">Фильтр</div>
                        <img class="cursor-p" src="<?= $addressServer ?>images/big-cancel.svg" alt="cancel">
                    </div>
                    <div class="signin-modal__switch-btns-wrap resume-list__switch-btns-wrap mb16">
                        <a href="<?= $addressServer ?>resume#"    onclick="serchGender('all'); return false;" class="signin-modal__switch-btn    <?= $gender == 'all'?  'active':'' ?>">Все</a>
                        <a href="<?= $addressServer ?>resume#"    onclick="serchGender('male'); return false;" class="signin-modal__switch-btn    <?= $gender == 'male'?  'active':'' ?>">Мужчины</a>
                        <a href="<?= $addressServer ?>resume#"    onclick="serchGender('female'); return false;" class="signin-modal__switch-btn  <?= $gender == 'female'?'active':'' ?>">Женщины</a>
                    </div>
                    <div class="vakancy-page-filter-block__row mb24">
                        <div class="paragraph cadet-blue" >Город</div>
                        <div class="citizenship-select" onclick="serchCity()">
							 <select class="nselect-1"  >
                             	<?php foreach ($dataCities as $city): ?>
                                    <option <?= ($city['id'] == $cityIdSelect)? 'selected':''?> 
                                    value="<?= $city['id'] ?>"> <?= $city['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="vakancy-page-filter-block__row mb24">
                        <div class="paragraph cadet-blue">Зарплата</div>
                        <div class="p-rel">
                            <input value="<?= $salary!=0? $salary:"" ?>" placeholder="<?= $salary==0? "Любая":"" ?>" type="text" class="dor-input w100" 
                            	 onchange="SerchSalary(this.value)"  >
                            <img class="rub-icon" src="<?= $addressServer ?>images/rub-icon.svg" alt="rub-icon">
                        </div>
                    </div>
                    <div class="vakancy-page-filter-block__row mb24">
                        <div class="paragraph cadet-blue">Специализация</div>
                        <div class="citizenship-select" onclick="serchSpecialization()">
                            <select class="nselect-1">
                            	<?php foreach ($dataSpecializations as $specialization): ?>
                                	  <option <?= ($specialization['id'] == $specializationIdSelect)? 'selected':''?>
                                         value="<?= $specialization['id'] ?>"><?= $specialization['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="vakancy-page-filter-block__row mb24">
                        <div class="paragraph cadet-blue">Возраст</div>
                        <div class="d-flex">
                            <input value="<?= $ageFrom !=0? $ageFrom:"" ?>" placeholder="От" type="text" class="dor-input w100" onchange="SerchAgeFrom(this.value)" >
                            <input value="<?= $ageUp   !=0? $ageUp:  "" ?>" placeholder="До" type="text" class="dor-input w100" onchange="SerchAgeUp(this.value)">
                        </div>
                    </div>
                    <div class="vakancy-page-filter-block__row mb24">
                        <div class="paragraph cadet-blue">Опыт работы</div>
                        <div class="profile-info">
                           <?php foreach ($experience as $typeExperience): ?>
                            <div class="form-check d-flex">
                                <input type="checkbox" name="experience[]" class="form-check-input" id="<?= 'experienceCheck'.$typeExperience['id'] ?>"
                                	onclick="SerchExperience()" value="<?= $typeExperience['id'] ?>" <?= ($typeExperience['checked']==true)? 'checked="true"':'' ?> >
                                <label class="form-check-label" for="<?= 'experienceCheck'.$typeExperience['id'] ?>" ></label>
                                <label for="<?= 'experienceCheck'.$typeExperience['id'] ?>" class="profile-info__check-text"> <?= $typeExperience['name'] ?></label>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="vakancy-page-filter-block__row mb24">
                        <div class="paragraph cadet-blue">Тип занятости</div>
                        <div class="profile-info">
                        	<?php foreach ($typeEmployments as $typeEmployment): ?>
                            	<div class="form-check d-flex">
                                    <input type="checkbox" name="type_employment[]" class="form-check-input" id="<?= 'type_employment'.$typeEmployment['id'] ?>" 
                                    	onclick="SerchTypeEmployment()" value="<?= $typeEmployment['id'] ?>" <?= ($typeEmployment['checked']==true)? 'checked="true"':'' ?> >
                                    <label class="form-check-label" for="<?= 'type_employment'.$typeEmployment['id'] ?>"></label>
                                    <label for="<?= 'type_employment'.$typeEmployment['id'] ?>" class="profile-info__check-text"> <?= $typeEmployment['name'] ?></label>
                            	</div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="vakancy-page-filter-block__row mb24">
                        <div class="paragraph cadet-blue">График работы</div>
                        <div class="profile-info">
                        	<?php foreach ($schedules as $schedule): ?>
                            	<div class="form-check d-flex">
                                    <input type="checkbox" name="type_schedule[]" class="form-check-input" id="<?= 'schedule'.$schedule['id'] ?>"
                                    	onclick="SerchSchedule()"  value="<?= $schedule['id'] ?>"  <?= ($schedule['checked']==true)? 'checked="true"':'' ?> >
                                    <label class="form-check-label" for="<?= 'schedule'.$schedule['id'] ?>"></label>
                                    <label for="<?= 'schedule'.$schedule['id'] ?>" class="profile-info__check-text"> 
                                    	<?= ($schedule['name'] == 'Полный день')? '+':'' ?> <?= $schedule['name'] ?> </label>
                                </div>
                        	<?php endforeach; ?>
                        </div>
                    </div>
                    <div
                            class="vakancy-page-filter-block__row vakancy-page-filter-block__show-vakancy-btns mb24 d-flex flex-wrap align-items-center mobile-jus-cont-center">
                        <a class="link-orange-btn orange-btn mr24 mobile-mb12" href="#">Показать <span>1 230</span>
                            вакансии</a>
                        <a href="#">Сбросить все</a>
                    </div>
                </div>
            </div>
        </div>
    </div>   
    
<script src="<?= $addressServer?>js/serch-resumes.js"> </script>
<script> 
   window.onload = afterPageLoad();
</script>
     