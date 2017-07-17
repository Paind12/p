<?php
/*
 * Отдельное действие SiteController
 *
 */
namespace common\languages;
 
use Yii;
use common\languages\LanguageKsl;
 
class LanguageAction extends \yii\base\Action
{
    public function run(){
        $language = Yii::$app->request->get('lang');
 
        //предыдущая страница
        $url_referrer = Yii::$app->request->referrer;
        /*
         * разбивает URL на подмассив $match_arr
         * 0. http://site.loc/ru/contact
         * 1. http://site.loc
         * 2. ru или uk или en
         * 3. остальная часть
         */
        $list_languages = LanguageKsl::$url_language; //список языков
 
        preg_match("#^(http:\/\/\w+\.\w+)/($list_languages)(.*)#",$url_referrer, $match_arr);
        // замена идентификатора языка
        $match_arr[2] = '/'.$language;
        // создание нового URL
        $url = $match_arr[1].$match_arr[2].$match_arr[3];
        // перенаправление
        Yii::$app->response->redirect($url);
    }   
}
