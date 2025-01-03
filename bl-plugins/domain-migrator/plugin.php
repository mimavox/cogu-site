<?php
/*
	DOMAIN MIGRATOR
	This plugin is delivery with BLUDIT PRO or you can buy it on https://plugins.bludit.com
	This plugin is NOT FREE.
	This plugin is NOT Open Source.
	You can NOT distribute this plugin.
	You can NOT modify this plugin.

	Copyright 2024
	Author: Diego Najar - dignajar@gmail.com
*/
class pluginDomainMigrator extends Plugin
{

	private $directory = false;
	private $error = false;

	public function init()
	{
		$this->dbFields = array(
			'status' => '-1',
			'oldDomain' => '',
			'newDomain' => ''
		);
		$this->formButtons = false;
	}

	public function post()
	{
		$directory = $this->migrationDirectory();
		if ($directory) {
			Filesystem::deleteRecursive($directory);
		}

		if (isset($_POST['createMigration'])) {
			$oldDomain = rtrim($_POST['oldDomain'], '/') . '/';
			$newDomain = rtrim($_POST['newDomain'], '/') . '/';

			if (!$this->validDomain($oldDomain)) {
				Filesystem::deleteRecursive($directory);
				$this->setField('status', '1');
				return true;
			}

			if (!$this->validDomain($newDomain)) {
				Filesystem::deleteRecursive($directory);
				$this->setField('status', '1');
				return true;
			}

			$this->cloneContent();
			$this->searchAndReplace($oldDomain, $newDomain);
			$this->setField('status', '0');
			$this->setField('oldDomain', $oldDomain);
			$this->setField('newDomain', $newDomain);
			return true;
		}

		$this->setField('status', '-1');
		$this->setField('oldDomain', '');
		$this->setField('newDomain', '');
		return true;
	}

	public function form()
	{
		global $L;
		$html = '';

		// Check for errors after POST method
		if ($this->getValue('status') === '0') {
			$directory = $this->migrationDirectory();

			$html .= '<h4 class="mt-4 mb-3">' . $L->g('Information') . '</h4>';
			$html .= '<p>From domain <code>' . $this->getValue('oldDomain') . '</code></p>';
			$html .= '<p>To domain: <code>' . $this->getValue('newDomain') . '</code></p>';

			$html .= '<h4 class="mt-4 mb-3">' . $L->g('Next steps') . '</h4>';
			$html .= '<p>1. Make a new installation of Bludit in the new domain.</p>';
			$html .= '<p>2. From the new installation delete the folder <code>/bl-content/</code>.</p>';
			$html .= '<p>3. From the old installation copy the folder <code>/bl-content-migrator/</code> to the new installation and rename for <code>/bl-content/</code>.</p>';
			$html .= '<p>4. You can find the <code>/bl-content-migrator/</code> on <code>' . $directory . '</code>.</p>';

			$html .= '<div class="mt-4">';
			$html .= '<button name="cleanMigration" value="true" class="btn btn-primary" type="submit">' . $L->get('Delete migration folder and start again') . '</button>';
			$html .= '</div>';

			return $html;
		} elseif ($this->getValue('status') === '1') {
			$this->setField('status', '-1');
			$html .= '<div class="alert alert-primary" role="alert">';
			$html .= 'Invalid domains names. Remember to include the protocol http or https.';
			$html .= '</div>';
		}

		//	$html .= '<h4 class="mt-4 mb-3">Information</h4>';
		$html .= '<p>This plugin creates a new folder with the migration content, do not affect the current installation at all.</p>';
		$html .= '<p>- Migrate from a domain to another.</p>';
		$html .= '<p>- Migrate from a domain to a subdomain.</p>';
		$html .= '<p>- Migrate from HTTP to HTTPS.</p>';

		$html .= '<hr>';
		$html .= '<div class="form-group">';
		$html .= '<label for="oldDomain">Old Domain</label>';
		$html .= '<input type="text" class="form-control" id="oldDomain" name="oldDomain" value="' . DOMAIN_BASE . '">';
		$html .= '<small class="form-text text-muted">The domain is taken from the current Bludit installation. Change it if you think is not correct. Include the protocol http:// or https://.</small>';
		$html .= '</div>';

		$html .= '<div class="form-group">';
		$html .= '<label for="newDomain">New Domain</label>';
		$html .= '<input type="text" class="form-control" id="newDomain" name="newDomain" placeHolder="https://mynewsite.com/bludit/" value="">';
		$html .= '<small class="form-text text-muted">Write the domain or subdomain where it will be migrated. Include the protocol http:// or https://.</small>';
		$html .= '</div>';

		$html .= '<div>';
		$html .= '<button name="createMigration" value="true" class="btn btn-primary" type="submit"><span class="fa fa-play"></span> ' . $L->get('Start') . '</button>';
		$html .= '</div>';

		return $html;
	}

	// Clone the directory /bl-content/
	private function cloneContent()
	{
		return Filesystem::copyRecursive(PATH_CONTENT, $this->migrationDirectory());
	}

	// Search for the old domain and replace for the new domain
	private function searchAndReplace($old, $new)
	{
		$directory = $this->migrationDirectory();

		global $pages;
		foreach ($pages->db as $key => $fields) {
			$contentPath = $directory . 'pages' . DS . $key . DS . FILENAME;
			$content = file_get_contents($contentPath);
			$content = Text::replace($old, $new, $content);
			file_put_contents($contentPath, $content);
		}

		global $site;
		$contentPath = $directory . 'databases' . DS . 'site.php';
		$siteDb = new dbJSON($contentPath);
		$siteDb->db['url'] = Sanitize::html($new);
		$siteDb->save();
	}

	private function validDomain($domain)
	{
		if (!in_array(parse_url($domain, PHP_URL_SCHEME), array('http', 'https'))) {
			return false;
		}
		return true;
	}

	// Returns an string with the directory path where the migration is done
	private function migrationDirectory()
	{
		$directory = PATH_ROOT . 'bl-content-migrator';
		@Filesystem::mkdir($directory);
		if (Filesystem::directoryExists($directory)) {
			return $directory . DS;
		}

		$directory = PATH_CONTENT . 'bl-content-migrator';
		@Filesystem::mkdir($directory);
		if (Filesystem::directoryExists($directory)) {
			return $directory . DS;
		}

		return false;
	}
}
