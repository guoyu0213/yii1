<?php

class mailInvite extends pluginBase{
	public static function name(){
		return "***插件名称-邮箱邀情注册";
	}
	public static function description(){
		return "实现邮箱邀请注册功能";
	}

	public static function install(){
		$inviteList = new IModel('invite_list');
		if (!$inviteList->exists()) {
			$inviteListArr = array(
				'comment' => '邮箱邀请注册用户别表',
				'column' => array(
					't_user_id' => array(
						'type' => 'int(11)',
						'comment' => '被邀请人的ID,为主键'
					),
					'i_user_id' => array(
						'type' => 'int(11)',
						'comment' => '邀请人ID'
					),
					'create_time' => array(
						'type' => 'int(11)',
						'default' => 0
					)
				),
				'index' => array('primary' => 't_user_id')
			);
			$inviteList -> setData($inviteListArr);
			return $inviteList->createTable();
		}
		return true;
	}

	public static function uninstall(){
		$inviteList = new IModel('invite_list');
		return $inviteList = dropTable();
	}

	public function reg(){
		plugin::reg("onUcenterMenuCreate",function(){
			menuUcenter::$menu['邀情注册']['/ucenter/myInviteUrl'] = '邀情链接';
			menuUcenter::$menu['邀情注册']['/ucenter/myInviteList'] = '邀情列表';
		});
		plugin::reg("onBeforeCreateAction@ucenter@myInviteUrl",function(){
			self::controller()->myInviteUrl = function(){
				$userID = self::controller()->user['user_id'];
				$inviteUrl = "http://localhost/gaoji3/iwebshop/index.php?controller=simple&action=reg&inviteUser=".urlencode(base64_encode($userID));
				$this->redirect('myInviteUrl',['inviteUrl'=>$inviteUrl]);
			};
		});
		plugin::reg("onFinishAction@simple@reg",function(){
			$inviteUser = IFilter::act(IReq::get('inviteUser','get'));
			if (is_string($inviteUser)) {
				$inviteUser = IFilter::act(base64_decode($inviteUser),'int');
				if ($inviteUser) {
echo <<<EOT
	<script>
		$(function(){
			$("table").append("<input type='hidden' name='inviteUser' value='$inviteUser'>");
		})
	</script>						

EOT;
				}
			}
		});
		plugin::reg("userRegFinish",function($arr){
			if ($iUserID = IFilter::act((IReq::get('inviteUser')),'int')) {
				if (is_array($arr) && !empty($arr)) {
					$inviteListM = new IModel('invite_list');
					$inviteListIArr = array(
						't_user_id' => $arr['id'],
						'i_user_id' => $iUserID,
						'create_time' => time()
					);
					$inviteListM->setData($inviteListIArr);
					$inviteListM->add();
					$pointLogM = new IModel('point_log');
					$pointLogIArr = array(
						'user_id' => $iUserID,
						'value' => 10,
						'intro' => '成功邀情'.$arr['username'].'注册，奖励积分',
						'datetime' => date('Y-m-d H:i:s',time())
					);
					$pointLogM ->setData($pointLogIArr);
					if ($pointLogM->add()) {
						//修改member表积分
						$memberM = new IModel('member');
						$memberUArr = array(
							'point' => 'point + 10'
						);
						$memberM -> setData($memberUArr);
						$where = 'user_id ='.$iUserID;
						$memberM -> update($where,['point']);
					}
					
				}
			}
		});

		plugin::reg("onBeforeCreateAction@ucenter@inviteSendMail",$this,'sendmail');
	}

	public function sendmail(){
		$mailPath = IReq::get('mailPath','post');
		$smtp = new SendMail();
		if ($error = $smtp->getError()) {
			$result = array('isError'=>true,'message'=>$error);
		}else{
			$userID = self::controller()->user['user_id'];
			$inviteUrl = "http://localhost/gaoji3/iwebshop/index.php?controller=simple&action=reg&inviteUser=".urlencode(base64_encode($userID));
			$title = 'haha';
			$content = "您好，这是来自啊哈哈的有点贱";
			$smtp->send($mailPath,$title,$content);
		}
		echo '<script>alert("邮件发送成功");window.location("/ucenter/myInviteUrl")</script>';exit;
	}
}