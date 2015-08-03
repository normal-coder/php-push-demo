<?php
include 'vendor/autoload.php';

use getuisdk\DictionaryAlertMsg;
use getuisdk\IGeTui;
use getuisdk\IGtAPNPayload;
use getuisdk\IGtAPNTemplate;
use getuisdk\IGtAppMessage;
use getuisdk\IGtBatch;
use getuisdk\IGtLinkTemplate;
use getuisdk\IGtListMessage;
use getuisdk\IGtNotificationTemplate;
use getuisdk\IGtNotyPopLoadTemplate;
use getuisdk\IGtSingleMessage;
use getuisdk\IGtTarget;
use getuisdk\IGtTransmissionTemplate;
use getuisdk\RequestException;

define('APPKEY', '');
define('APPID', '');
define('MASTERSECRET', '');
define('HOST', 'http://sdk.open.api.igexin.com/apiex.htm');
define('CID', '');
define('DEVICETOKEN', '');
define('Alias', '请输入别名');
//define('BEGINTIME','2015-03-06 13:18:00');
//define('ENDTIME','2015-03-06 13:24:00');

//getUserStatus();

//stoptask();

//setTag();

//getUserTags();

//pushMessageToSingle();

pushMessageToSingleBatch();

//pushMessageToList();

//pushMessageToApp();

//pushAPN();

//pushAPNL();

//getPushMessageResultDemo();

function getPushMessageResultDemo()
{


//    putenv('gexin_default_domainurl=http://183.129.161.174:8006/apiex.htm');

    $igt = new IGeTui(HOST, APPKEY, MASTERSECRET);

//    $ret = $igt->getPushResult('OSA-0522_QZ7nHpBlxF6vrxGaLb1FA3');
//    var_dump($ret);

//    $ret = $igt->queryAppUserDataByDate(APPID,'20140807');
//    var_dump($ret);

    $ret = $igt->queryAppPushDataByDate(APPID, '20140807');
    var_dump($ret);
}

function pushAPN()
{

    //APN简单推送
//        $igt = new IGeTui(HOST,APPKEY,MASTERSECRET);
//        $template = new IGtAPNTemplate();
//        $apn = new IGtAPNPayload();
//        $alertmsg=new SimpleAlertMsg();
//        $alertmsg->alertMsg='';
//        $apn->alertMsg=$alertmsg;
////        $apn->badge=2;
////        $apn->sound='';
//        $apn->addCustomMsg('payload','payload');
//        $apn->contentAvailable=1;
//        $apn->category='ACTIONABLE';
//        $template->setApnInfo($apn);
//        $message = new IGtSingleMessage();

    //APN高级推送
//        $igt = new IGeTui(HOST,APPKEY,MASTERSECRET);
//        $template = new IGtAPNTemplate();
//        $apn = new IGtAPNPayload();
//        $alertmsg=new DictionaryAlertMsg();
//        $alertmsg->body='body';
//        $alertmsg->actionLocKey='ActionLockey';
//        $alertmsg->locKey='LocKey';
//        $alertmsg->locArgs=array('locargs');
//        $alertmsg->launchImage='launchimage';
////        IOS8.2 支持
//        $alertmsg->title='Title';
//        $alertmsg->titleLocKey='TitleLocKey';
//        $alertmsg->titleLocArgs=array('TitleLocArg');
//
//        $apn->alertMsg=$alertmsg;
//        $apn->badge=7;
//        $apn->sound='test1.wav';
//        $apn->addCustomMsg('payload','payload');
//        $apn->contentAvailable=1;
//        $apn->category='ACTIONABLE';
//        $template->setApnInfo($apn);
//        $message = new IGtSingleMessage();

    //PushApn老方式传参
//    $igt = new IGeTui(HOST,APPKEY,MASTERSECRET);
//    $template = new IGtAPNTemplate();
//    $template->setPushInfo('actionLocKey', 6, 'body', '', 'payload', 'locKey', 'locArgs', 'launchImage',1);
//    $message = new IGtSingleMessage();
////
//    $message->setData($template);
//    $ret = $igt->pushAPNMessageToSingle(APPID, DEVICETOKEN, $message);
//    var_dump($ret);
}

function pushAPNL()
{

    //APN简单推送
//        $igt = new IGeTui(HOST,APPKEY,MASTERSECRET);
//        $template = new IGtAPNTemplate();
//        $apn = new IGtAPNPayload();
//        $alertmsg=new SimpleAlertMsg();
//        $alertmsg->alertMsg='';
//        $apn->alertMsg=$alertmsg;
////        $apn->badge=2;
////        $apn->sound='';
//        $apn->addCustomMsg('payload','payload');
//        $apn->contentAvailable=1;
//        $apn->category='ACTIONABLE';
//        $template->setApnInfo($apn);
//        $message = new IGtSingleMessage();

    //APN高级推送
    $igt = new IGeTui(HOST, APPKEY, MASTERSECRET);
    $template = new IGtAPNTemplate();
    $apn = new IGtAPNPayload();
//        $alertmsg=new DictionaryAlertMsg();
//        $alertmsg->body='body';
//        $alertmsg->actionLocKey='ActionLockey';
//        $alertmsg->locKey='LocKey';
//        $alertmsg->locArgs=array('locargs');
//        $alertmsg->launchImage='launchimage';
////        IOS8.2 支持
//        $alertmsg->title='Title';
//        $alertmsg->titleLocKey='TitleLocKey';
//        $alertmsg->titleLocArgs=array('TitleLocArg');
//        $apn->alertMsg=$alertmsg;

//        $apn->badge=7;
//        $apn->sound='com.gexin.ios.silence';
    $apn->addCustomMsg('payload', 'payload');
//        $apn->contentAvailable=1;
//        $apn->category='ACTIONABLE';
    $template->setApnInfo($apn);
    $message = new IGtSingleMessage();

    //PushApn老方式传参
//    $igt = new IGeTui(HOST,APPKEY,MASTERSECRET);
//    $template = new IGtAPNTemplate();
//    $template->setPushInfo('', 4, '', '', '', '', '', '');
//    $message = new IGtSingleMessage();

    //多个用户推送接口
    putenv('needDetails=true');
    $listmessage = new IGtListMessage();
    $listmessage->setData($template);
    $contentId = $igt->getAPNContentId(APPID, $listmessage);
    //$deviceTokenList = array('3337de7aa297065657c087a041d28b3c90c9ed51bdc37c58e8d13ced523f5f5f');
    $deviceTokenList = array(DEVICETOKEN);
    $ret = $igt->pushAPNMessageToList(APPID, $contentId, $deviceTokenList);
    var_dump($ret);
}

//用户状态查询
function getUserStatus()
{
    $igt = new IGeTui(HOST, APPKEY, MASTERSECRET);
    $rep = $igt->getClientIdStatus(APPID, CID);
    var_dump($rep);
    echo('<br><br>');
}

//推送任务停止
function stoptask()
{

    $igt = new IGeTui(HOST, APPKEY, MASTERSECRET);
    $igt->stop('OSA-0416_n0Oad0AmYq5O4aZ0oyBAt3');
}

//通过服务端设置ClientId的标签
function setTag()
{
    $igt = new IGeTui(HOST, APPKEY, MASTERSECRET);
    $tagList = array('', '中文', 'English');
    $rep = $igt->setClientTag(APPID, CID, $tagList);
    var_dump($rep);
    echo('<br><br>');
}

function getUserTags()
{
    $igt = new IGeTui(HOST, APPKEY, MASTERSECRET);
    $rep = $igt->getUserTags(APPID, CID);
    //$rep.connect();
    var_dump($rep);
    echo('<br><br>');
}

//
//服务端推送接口，支持三个接口推送
//1.PushMessageToSingle接口：支持对单个用户进行推送
//2.PushMessageToList接口：支持对多个用户进行推送，建议为50个用户
//3.pushMessageToApp接口：对单个应用下的所有用户进行推送，可根据省份，标签，机型过滤推送
//

//单推接口案例
function pushMessageToSingle()
{
    $igt = new IGeTui(HOST, APPKEY, MASTERSECRET);

    //消息模版：
    // 1.TransmissionTemplate:透传功能模板
    // 2.LinkTemplate:通知打开链接功能模板
    // 3.NotificationTemplate：通知透传功能模板
    // 4.NotyPopLoadTemplate：通知弹框下载功能模板

//    	$template = IGtNotyPopLoadTemplateDemo();
//    	$template = IGtLinkTemplateDemo();
//    	$template = IGtNotificationTemplateDemo();
    $template = IGtTransmissionTemplateDemo();

    //个推信息体
    $message = new IGtSingleMessage();

    $message->setIsOffline(true);//是否离线
    $message->setOfflineExpireTime(3600 * 12 * 1000);//离线时间
    $message->setData($template);//设置推送消息类型
//	$message->setPushNetWorkType(0);//设置是否根据WIFI推送消息，1为wifi推送，0为不限制推送
    //接收方
    $target = new IGtTarget();
    $target->setAppId(APPID);
    $target->setClientId(CID);
//    $target->setAlias(Alias);


    try {
        $rep = $igt->pushMessageToSingle($message, $target);
        var_dump($rep);
        echo('<br><br>');

    } catch (RequestException $e) {
        $requstId = $e->getRequestId();
        $rep = $igt->pushMessageToSingle($message, $target, $requstId);
        var_dump($rep);
        echo('<br><br>');
    }

}

function pushMessageToSingleBatch()
{
    putenv('gexin_pushSingleBatch_needAsync=false');

    $igt = new IGeTui(HOST, APPKEY, MASTERSECRET);
    $batch = new IGtBatch(APPKEY, $igt);
    $batch->setApiUrl(HOST);
    //$igt->connect();
    //消息模版：
    // 1.TransmissionTemplate:透传功能模板
    // 2.LinkTemplate:通知打开链接功能模板
    // 3.NotificationTemplate：通知透传功能模板
    // 4.NotyPopLoadTemplate：通知弹框下载功能模板

//    $template = IGtNotyPopLoadTemplateDemo();
    $template = IGtLinkTemplateDemo();
    //$template = IGtNotificationTemplateDemo();
//    $template = IGtTransmissionTemplateDemo();

    //个推信息体
    $message = new IGtSingleMessage();
    $message->setIsOffline(true);//是否离线
    $message->setOfflineExpireTime(12 * 1000 * 3600);//离线时间
    $message->setData($template);//设置推送消息类型
//    $message->setPushNetWorkType(1);//设置是否根据WIFI推送消息，1为wifi推送，0为不限制推送

    $target = new IGtTarget();
    $target->setAppId(APPID);
    $target->setClientId(CID);
    $batch->add($message, $target);
    try {

        $rep = $batch->submit();
        var_dump($rep);
        echo('<br><br>');
    } catch (Exception $e) {
        $rep = $batch->retry();
        var_dump($rep);
        echo('<br><br>');
    }
}

//多推接口案例
function pushMessageToList()
{
    putenv('gexin_pushList_needDetails=true');
    putenv('gexin_pushList_needAsync=true');

    $igt = new IGeTui(HOST, APPKEY, MASTERSECRET);
    //消息模版：
    // 1.TransmissionTemplate:透传功能模板
    // 2.LinkTemplate:通知打开链接功能模板
    // 3.NotificationTemplate：通知透传功能模板
    // 4.NotyPopLoadTemplate：通知弹框下载功能模板


    //$template = IGtNotyPopLoadTemplateDemo();
    //$template = IGtLinkTemplateDemo();
    //$template = IGtNotificationTemplateDemo();
    $template = IGtTransmissionTemplateDemo();
    //个推信息体
    $message = new IGtListMessage();

    $message->setIsOffline(true);//是否离线
    $message->setOfflineExpireTime(3600 * 12 * 1000);//离线时间
    $message->setData($template);//设置推送消息类型
//    $message->setPushNetWorkType(1);	//设置是否根据WIFI推送消息，1为wifi推送，0为不限制推送
//    $contentId = $igt->getContentId($message);
    $contentId = $igt->getContentId($message, 'toList任务别名功能');    //根据TaskId设置组名，支持下划线，中文，英文，数字

    //接收方1
    $target1 = new IGtTarget();
    $target1->setAppId(APPID);
    $target1->setClientId(CID);
//    $target1->setAlias(Alias);

    $targetList[] = $target1;

    $rep = $igt->pushMessageToList($contentId, $targetList);

    var_dump($rep);

    echo('<br><br>');

}

//群推接口案例
function pushMessageToApp()
{
    $igt = new IGeTui(HOST, APPKEY, MASTERSECRET);
    //消息模版：
    // 1.TransmissionTemplate:透传功能模板
    // 2.LinkTemplate:通知打开链接功能模板
    // 3.NotificationTemplate：通知透传功能模板
    // 4.NotyPopLoadTemplate：通知弹框下载功能模板

    //$template = IGtNotyPopLoadTemplateDemo();
    $template = IGtLinkTemplateDemo();
    //$template = IGtNotificationTemplateDemo();
//    	$template = IGtTransmissionTemplateDemo();

    //个推信息体
    //基于应用消息体
    $message = new IGtAppMessage();

    $message->setIsOffline(true);
    $message->setOfflineExpireTime(3600 * 12 * 1000);//离线时间单位为毫秒，例，两个小时离线为3600*1000*2
    $message->setData($template);
//	$message->setPushNetWorkType(1);	//设置是否根据WIFI推送消息，1为wifi推送，0为不限制推送
//    $message->setSpeed(50);          //控速推送，设置每秒消息的下发量

    $message->setAppIdList(array(APPID));
    //$message->setPhoneTypeList(array('ANDROID'));
    //$message->setProvinceList(array('浙江','北京','河南'));
//	$message->setTagList(array('中文'));

    $rep = $igt->pushMessageToApp($message, 'toApp任务别名');//根据TaskId设置组名，支持下划线，中文，英文，数字


    var_dump($rep);
    echo('<br><br>');
}

//所有推送接口均支持四个消息模板，依次为通知弹框下载模板，通知链接模板，通知透传模板，透传模板
//注：IOS离线推送需通过APN进行转发，需填写pushInfo字段，目前仅不支持通知弹框下载功能

function IGtNotyPopLoadTemplateDemo()
{
    $template = new IGtNotyPopLoadTemplate();

    $template->setAppId(APPID);//应用appid
    $template->setAppKey(APPKEY);//应用appkey
    //通知栏
    $template->setNotyTitle('个推');//通知栏标题
    $template->setNotyContent('个推最新版点击下载');//通知栏内容
    $template->setNotyIcon('');//通知栏logo
    $template->setIsBelled(true);//是否响铃
    $template->setIsVibrationed(true);//是否震动
    $template->setIsCleared(true);//通知栏是否可清除
    //弹框
    $template->setPopTitle('弹框标题');//弹框标题
    $template->setPopContent('弹框内容');//弹框内容
    $template->setPopImage('');//弹框图片
    $template->setPopButton1('下载');//左键
    $template->setPopButton2('取消');//右键
    //下载
    $template->setLoadIcon('');//弹框图片
    $template->setLoadTitle('地震速报下载');
    $template->setLoadUrl('http://dizhensubao.igexin.com/dl/com.ceic.apk');
    $template->setIsAutoInstall(false);
    $template->setIsActived(true);
    //$template->setDuration(BEGINTIME,ENDTIME); //设置ANDROID客户端在此时间区间内展示消息

    return $template;
}

function IGtLinkTemplateDemo()
{
    $template = new IGtLinkTemplate();
    $template->setAppId(APPID);//应用appid
    $template->setAppKey(APPKEY);//应用appkey
    $template->setTitle('请输入通知标题');//通知栏标题
    $template->setText('请输入通知内容');//通知栏内容
    $template->setLogo('');//通知栏logo
    $template->setIsRing(true);//是否响铃
    $template->setIsVibrate(true);//是否震动
    $template->setIsClearable(true);//通知栏是否可清除
    $template->setUrl('http://www.igetui.com/');//打开连接地址
    //$template->setDuration(BEGINTIME,ENDTIME); //设置ANDROID客户端在此时间区间内展示消息
    //iOS推送需要设置的pushInfo字段
//        $apn = new IGtAPNPayload();
//        $apn->alertMsg = 'alertMsg';
//        $apn->badge = 11;
//        $apn->actionLocKey = '启动';
//    //        $apn->category = 'ACTIONABLE';
//    //        $apn->contentAvailable = 1;
//        $apn->locKey = '通知栏内容';
//        $apn->title = '通知栏标题';
//        $apn->titleLocArgs = array('titleLocArgs');
//        $apn->titleLocKey = '通知栏标题';
//        $apn->body = 'body';
//        $apn->customMsg = array('payload'=>'payload');
//        $apn->launchImage = 'launchImage';
//        $apn->locArgs = array('locArgs');
//
//        $apn->sound=('test1.wav');;
//        $template->setApnInfo($apn);
    return $template;
}

function IGtNotificationTemplateDemo()
{
    $template = new IGtNotificationTemplate();
    $template->setAppId(APPID);//应用appid
    $template->setAppKey(APPKEY);//应用appkey
    $template->setTransmissionType(1);//透传消息类型
    $template->setTransmissionContent('测试离线');//透传内容
    $template->setTitle('个推');//通知栏标题
    $template->setText('个推最新版点击下载');//通知栏内容
    $template->setLogo('http://wwww.igetui.com/logo.png');//通知栏logo
    $template->setIsRing(true);//是否响铃
    $template->setIsVibrate(true);//是否震动
    $template->setIsClearable(true);//通知栏是否可清除
    //$template->setDuration(BEGINTIME,ENDTIME); //设置ANDROID客户端在此时间区间内展示消息
    //iOS推送需要设置的pushInfo字段
//        $apn = new IGtAPNPayload();
//        $apn->alertMsg = 'alertMsg';
//        $apn->badge = 11;
//        $apn->actionLocKey = '启动';
//    //        $apn->category = 'ACTIONABLE';
//    //        $apn->contentAvailable = 1;
//        $apn->locKey = '通知栏内容';
//        $apn->title = '通知栏标题';
//        $apn->titleLocArgs = array('titleLocArgs');
//        $apn->titleLocKey = '通知栏标题';
//        $apn->body = 'body';
//        $apn->customMsg = array('payload'=>'payload');
//        $apn->launchImage = 'launchImage';
//        $apn->locArgs = array('locArgs');
//
//        $apn->sound=('test1.wav');;
//        $template->setApnInfo($apn);
    return $template;
}

function IGtTransmissionTemplateDemo()
{
    $template = new IGtTransmissionTemplate();
    $template->setAppId(APPID);//应用appid
    $template->setAppKey(APPKEY);//应用appkey
    $template->setTransmissionType(1);//透传消息类型
    $template->setTransmissionContent('测试离线ddd');//透传内容
    //$template->setDuration(BEGINTIME,ENDTIME); //设置ANDROID客户端在此时间区间内展示消息
    //APN简单推送
//        $template = new IGtAPNTemplate();
//        $apn = new IGtAPNPayload();
//        $alertmsg=new SimpleAlertMsg();
//        $alertmsg->alertMsg='';
//        $apn->alertMsg=$alertmsg;
////        $apn->badge=2;
////        $apn->sound='';
//        $apn->addCustomMsg('payload','payload');
//        $apn->contentAvailable=1;
//        $apn->category='ACTIONABLE';
//        $template->setApnInfo($apn);
//        $message = new IGtSingleMessage();

    //APN高级推送
    $apn = new IGtAPNPayload();
    $alertmsg = new DictionaryAlertMsg();
    $alertmsg->body = 'body';
    $alertmsg->actionLocKey = 'ActionLockey';
    $alertmsg->locKey = 'LocKey';
    $alertmsg->locArgs = array('locargs');
    $alertmsg->launchImage = 'launchimage';
//        IOS8.2 支持
    $alertmsg->title = 'Title';
    $alertmsg->titleLocKey = 'TitleLocKey';
    $alertmsg->titleLocArgs = array('TitleLocArg');

    $apn->alertMsg = $alertmsg;
    $apn->badge = 7;
    $apn->sound = '';
    $apn->addCustomMsg('payload', 'payload');
    $apn->contentAvailable = 1;
    $apn->category = 'ACTIONABLE';
    $template->setApnInfo($apn);

    //PushApn老方式传参
//    $template = new IGtAPNTemplate();
//          $template->setPushInfo('', 10, '', 'com.gexin.ios.silence', '', '', '', '');

    return $template;
}
