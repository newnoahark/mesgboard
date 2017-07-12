<?php
// $Id$

/**
 * Controller_User 控制器
 */
class Controller_User extends Controller_Abstract
{

	function actionIndex()
	{
        // 为 $this->_view 指定的值将会传递数据到视图中
		# $this->_view['text'] = 'Hello!';
	}
	//用户登录
	function actionLogin()
	{

	    $form = new Form_UserLogin(url('user/Login'));
	    $form->_subject = '登录';
	    $loginmsg = "";
	    if ($this->_context->isPOST() && $form->validate($_POST))
	    {
	        try
	        {
	        	 $user = new Users($form->values());
	       	
	            // 使用 acluser 插件的 validateLogin() 方法验证登录并取得有效的 user 对象
	          
	        	$user = Users::meta()->validateLogin($form['username']->value, $form['password']->value);
				
  				
	            // 将登录用户的信息存入 SESSION，以便应用程序记住用户的登录状态
	            $this->_app->changeCurrentUser($user->aclData(), 'MEMBER');
	            // 登录成功后，重定向浏览器
	            
	           //$loginmsg="success".$form['username']->value;
	          
	            return $this->_redirect(url('default/index',array('loginmsg'=>$form['username']->value)));
	        }
	        catch (AclUser_UsernameNotFoundException $ex)
	        {

	           $loginmsg = "您输入的用户名 {$form['username']->value} 不存在";
	          // $form['username']->invalidate("您输入的用户名 {$form['username']->value} 不存在");
	        }
	        catch (AclUser_WrongPasswordException $ex)
	        {
	         	$loginmsg = "您输入的密码不正确";
	            //$form['password']->invalidate("您输入的密码不正确");
	        }
	    }
	 	
	    $this->_view['loginmsg'] = $loginmsg;
	    $this->_viewname = 'register';
	}
	//用户注销
	function actionLogout()
	{
	    // 清除当前用户的登录信息
	    $this->_app->cleanCurrentUser();
	    // 重定向浏览器
	    return $this->_redirect(url('default/index'));
	}
	//用户注册
	function actionregister(){
	    // 构造表单对象
    $form = new Form_UserLogin(url('user/register'));
 	
    if ($this->_context->isPOST() && $form->validate($_POST))
    {
    	
        // 是 POST 提交，并且表单验证通过
        try
        {
            // // 创建 user 对象并保存
            $user = new Users($form->values());
            $user->save();
 
            // // 成功后输出新建用户对象的信息
            // dump($user->username, '新建用户的用户名');
            // dump($user->password, '新建用户的密码');
            // dump($user->id(), '新建用户的ID');
            

        }
        catch (AclUser_DuplicateUsernameException $ex)
        {
            // 捕获 AclUser_DuplicateUsernameException 异常，在表单中指出用户名存在重复问题
            $form['username']->invalidate("您要注册用户名 {$user->username} 已经存在了");
        }
    }
 
    // 将表单对象传递给视图
    $this->_view['form'] = $form;


	}

	function actiontest(){
		if ($this->_context->isGET()){
			echo $_GET["q"];

		}

	}
}

