<?

class Contact_Module extends Core_ModuleBase {
	/**
	 * Creates the module information object
	 * @return Core_ModuleInfo
	 */
	protected function createModuleInfo() {
		return new Core_ModuleInfo(
			"Contact",
			"Adds the contact form feature to a store",
			"Eric Muyser"
		);
	}
}