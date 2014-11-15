<?php  
class ControllerModuleMenu extends Controller {
	
	protected function index($setting) {
		static $module = 0;
		$this->load->model('menu/menus');
		$this->load->model('menu/menuitems');
		$menu_id=$setting['menu_id'];
		$menu_data=array();
			
    		$this->data['class']=$this->model_menu_menus->getMenuClass($setting['menu_id']);
    		$menuitem_data = $this->cache->get('menuitems_front.' . (int)$this->config->get('config_language_id') . '.' . (int)$setting['menu_id']);
    		if (!$menuitem_data) {
    			$menuitem_data=$this->model_menu_menuitems->getMenuitems(0,$setting['menu_id']);
    			$this->cache->set('menuitems_front.' . (int)$this->config->get('config_language_id') . '.' . (int)$setting['menu_id'], $menuitem_data);
    		}
    		$this->data['menuitems']=$menuitem_data;
    		$this->data['menu']=$this->drawMenu($this->model_menu_menuitems->getMenuitems(0,$setting['menu_id']));
    		$this->data['module'] = $module++;
			
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/menu.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/module/menu.tpl';
			} else {
				$this->template = 'default/template/module/menu.tpl';
			}
			
			$this->render();
  	}
	
  	public function drawMenu($menuitems, $class=array('ulclass'=>'menu', 'liclass'=>'menu-li' )){
  		$toprint="";
  		foreach($menuitems as $menuitem){
          //Change sponiza
          if (isset($menuitem['menu_link']) && strlen($menuitem['menu_link']) > 5) {
            if (0 === strpos($menuitem['menu_link'], 'internal://'))
            {
              $link = substr($menuitem['menu_link'], 11);
              $route = $link;
              $params = '';
              if (false !== $intPos = strpos($link, '?'))
              {
                $route = substr($link, 0, $intPos);
                $params = substr($link, $intPos + 1);
              }
              
              $toprint.="<li class='".$class['liclass']." ".$menuitem['menu_class']."' ><a href='".$this->url->link($route, $params)."'>".$menuitem['menu_name']."</a>";
            }
            else
            {
  			     $toprint.="<li class='".$class['liclass']." ".$menuitem['menu_class']."' ><a href='".$menuitem['menu_link']."'>".$menuitem['menu_name']."</a>";
            }
          } else {
  			   $toprint.="<li class='".$class['liclass']." ".$menuitem['menu_class']."' >".$menuitem['menu_name'];
          }
  			if(count($menuitem['children'])){
  				$class['liclass'].="-sub";
  				$class['ulclass'].="-sub";
  				$subitem=$this->drawMenu($menuitem['children'], $class);
  				$toprint.="<div><ul class='".$class['ulclass']."'>".$subitem."</ul></div>";  				
  			}
  			$toprint.="</li>";
  		}
  		return $toprint;
  	}
}
?>
