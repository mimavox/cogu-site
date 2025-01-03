<?php
/*
	TIMEMACHINE X
	This plugin is delivery with BLUDIT PRO or you can buy it on https://plugins.bludit.com
	This plugin is NOT FREE.
	This plugin is NOT Open Source.
	You can NOT distribute this plugin.
	You can NOT modify this plugin.

	Copyright 2024
	Author: Diego Najar - dignajar@gmail.com
*/
class pluginTimeMachineX extends Plugin
{

	// This variable define if the extension zip is loaded
	private $zip = false;

	// Amount of restore points to keep
	private $amount = 15;

	// List of directories to backup
	private $directoriesToBackup = array(
		PATH_PAGES,
		PATH_DATABASES
	);

	public function init()
	{
		$this->formButtons = false;

		// Check for zip extension installed
		$this->zip = extension_loaded('zip');
	}

	// Call from the form
	public function post()
	{
		if (isset($_POST['idExecution'])) {
			$idExecution = $_POST['idExecution'];

			// Replace the content from the backup directory
			$this->restoreContent($idExecution);

			// Clean backups until the $idExecution
			$this->removeUntilTo($idExecution);

			return true;
		}
		return false;
	}

	public function form()
	{
		global $syslog;
		global $language;

		if ($this->zip) {
			$backups = $this->getBackupsZip();
		} else {
			$backups = $this->getBackupsDirectories();
		}

		$html  = '<div class="alert alert-primary" role="alert">';
		$html .= $this->description();
		$html .= '</div>';
		$html .= '<hr>';

		$html .= '<input name="disableTimemachine" value="true" type="hidden">';
		foreach ($backups as $backup) {
			$idExecution = pathinfo(basename($backup), PATHINFO_FILENAME);
			$information = $syslog->get($idExecution);
			if ($information !== false) {
				$html .= '<div>';
				$html .= '<h5 class="font-weight-normal mb-0">' . $language->get($information['dictionaryKey']) . '</h5>';
				$html .= '<div class="text-muted">' . $information['date'] . '</div>';
				$html .= '<div class="text-muted">' . $language->get('Username') . ': ' . $information['username'] . '</div>';
				$html .= '<button name="idExecution" value="' . $idExecution . '" class="mt-1 btn btn-primary btn-sm" type="submit"><span class="fa fa-rotate-left"></span> ' . $language->get('Go back to this point') . '</button>';
				$html .= '</div>';
				$html .= '<hr>';
			}
		}

		if (empty($backups)) {
			$html .= '<div class="alert alert-primary" role="alert">';
			$html .= $language->get('There are no recovery points');
			$html .= '</div>';
		}

		return $html;
	}

	public function beforeAdminLoad()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if (!isset($_POST['disableTimemachine'])) {
				$this->createRestorePoint();
				$this->removeOldPoints();
			}
		}
	}

	public function adminSidebar()
	{
		return '<a class="nav-link" href="' . HTML_PATH_ADMIN_ROOT . 'configure-plugin/' . $this->className() . '"><span class="fa fa-rotate-left"></span> Timemachine X</a>';
	}

	private function createRestorePoint()
	{
		// Create restore point directory
		$backupDir = $this->workspace() . $GLOBALS['ID_EXECUTION'];
		mkdir($backupDir, 0755, true);

		// Copy all to restore point directory
		foreach ($this->directoriesToBackup as $dir) {
			$destination = $backupDir . DS . basename($dir);
			Filesystem::copyRecursive($dir, $destination);
		}

		// Compress backup directory
		if ($this->zip) {
			if (Filesystem::zip($backupDir, $backupDir . '.zip')) {
				Filesystem::deleteRecursive($backupDir);
			}
		}

		return true;
	}

	// Copy the content from the backup to /bl-content/
	private function restoreContent($idExecution)
	{
		// Remove current files
		foreach ($this->directoriesToBackup as $dir) {
			Filesystem::deleteRecursive($dir);
		}

		// Zip
		$source = $this->workspace() . $idExecution . '.zip';
		if (file_exists($source)) {
			if ($this->zip) {
				return Filesystem::unzip($source, PATH_CONTENT);
			}
		}

		// Directory
		$source = $this->workspace() . $idExecution;
		if (file_exists($source)) {
			$dest = rtrim(PATH_CONTENT, '/');
			return Filesystem::copyRecursive($source, $dest);
		}

		return false;
	}

	// Returns array with all backups directories sorted by date newer first
	private function getBackupsDirectories()
	{
		$workspace = $this->workspace();
		return Filesystem::listDirectories($workspace, $regex = '*', $sortByDate = true);
	}

	// Returns array with all backups zip sorted by date newer first
	private function getBackupsZip()
	{
		$workspace = $this->workspace();
		return Filesystem::listFiles($workspace, $regex = '*', 'zip', $sortByDate = true);
	}

	// Remove old restore points an keep only $this->amount
	private function removeOldPoints()
	{
		if ($this->zip) {
			$backups = $this->getBackupsZip();
		} else {
			$backups = $this->getBackupsDirectories();
		}

		$i = 0;
		foreach ($backups as $backup) {
			$i = $i + 1;
			if ($i > $this->amount) {
				if ($this->zip) {
					Filesystem::rmfile($backup);
				} else {
					Filesystem::deleteRecursive($backup);
				}
			}
		}

		return true;
	}

	// Delete old backups until the $idExecution
	private function removeUntilTo($idExecution)
	{
		if ($this->zip) {
			$backups = $this->getBackupsZip();
		} else {
			$backups = $this->getBackupsDirectories();
		}

		foreach ($backups as $backup) {
			$backupIDExecution = pathinfo(basename($backup), PATHINFO_FILENAME);

			if ($this->zip) {
				Filesystem::rmfile($backup);
			} else {
				Filesystem::deleteRecursive($backup);
			}

			if ($backupIDExecution == $idExecution) {
				return true;
			}
		}

		return true;
	}
}
