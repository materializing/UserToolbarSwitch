<?php
/**
 * [HelperEventListener] UserToolbarSwitch
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 */
class UserToolbarSwitchHelperEventListener extends BcHelperEventListener
{
	/**
	 * 登録イベント
	 *
	 * @var array
	 */
	public $events = array(
		'Form.afterForm',
	);
	
	/**
	 * 処理対象とするコントローラー
	 * 
	 * @var array
	 */
	private $targetController = array('users');
	
	/**
	 * 処理対象アクション
	 * 
	 * @var array
	 */
	private $targetAction = array('admin_edit', 'admin_add');
	
	/**
	 * 処理対象フォームID
	 * 
	 * @var array
	 */
	private $targetFormId = array('UserAdminEditForm', 'UserAdminAddForm');
	
	/**
	 * formAfterForm
	 * ユーザー編集・登録画面にユーザーツールバースウィッチ指定欄を追加する
	 * 
	 * @param CakeEvent $event
	 */
	public function formAfterForm (CakeEvent $event)
	{
		if (!BcUtil::isAdminSystem()) {
			return;
		}
		
		$View = $event->subject();
		if (!in_array($View->request->params['controller'], $this->targetController)) {
			return;
		}
		
		if (!in_array($View->request->params['action'], $this->targetAction)) {
			return;
		}
		
		if (in_array($event->data['id'], $this->targetFormId)) {
			echo $View->element('UserToolbarSwitch.admin/user_toolbar_switch_form');
		}
	}
	
}