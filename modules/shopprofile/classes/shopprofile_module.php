<?

class ShopProfile_Module extends Core_ModuleBase {
	protected function createModuleInfo() {
		$info = new Core_ModuleInfo(
			"Shop Profile",
			"Provides handlers for Shop customer profiles",
			"Eric Muyser"
		);
			
		return $info;
	}
}
