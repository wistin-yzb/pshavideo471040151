<?PHP
    /*
     | Submail addressbook/message/unsubscribe API demo
     | SUBMAIL SDK Version 2.6 --PHP
     | copyright 2011 - 2017 SUBMAIL
     |--------------------------------------------------------------------------
     */
    
    /*
     |载入 app_config 文件
     |--------------------------------------------------------------------------
     */
    require '../app_config.php';
    
    /*
     |载入 SUBMAILAutoload 文件
     |--------------------------------------------------------------------------
     */
    
    require_once('../SUBMAILAutoload.php');
    
    /*
     |初始化 ADDRESSBOOKMessage 类
     |--------------------------------------------------------------------------
     */
    
    $addressbook=new ADDRESSBOOKMessage($message_configs);
    
    /*
     |必选参数
     |--------------------------------------------------------------------------
     |设置退订的联系人号码
     |--------------------------------------------------------------------------
     */
    
    $addressbook->setAddress('1**********');
    
    /*
     |可选参数
     |--------------------------------------------------------------------------
     |设置目标地址薄标识，将联系人从目标地址薄中删除
     |默认值为 unsubscribe 即短信退订地址薄
     |--------------------------------------------------------------------------
     */
    
    $addressbook->setAddressbook('unsubscribe');
    
    /*
     |调用 unsubscribe 方法删除联系人
     |--------------------------------------------------------------------------
     */
    
    
    $unsubscribe=$addressbook->unsubscribe();
    
    
    /*
     |打印服务器返回码
     |--------------------------------------------------------------------------
     */
    
    print_r($unsubscribe);
