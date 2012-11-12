<?php
/**
 * Piwik - Open source web analytics
 * 
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @version $Id: Controller.php 6727 2012-08-13 20:26:46Z JulienM $
 * 
 * @category Piwik_Plugins
 * @package Piwik_PDFReports
 */

/**
 *
 * @package Piwik_PDFReports
 */
class Piwik_PDFReports_Controller extends Piwik_Controller
{
	const DEFAULT_REPORT_TYPE = Piwik_PDFReports::EMAIL_TYPE;

	public function index()
	{
		$view = Piwik_View::factory('index');
		$this->setGeneralVariablesView($view);

		$view->countWebsites = count(Piwik_SitesManager_API::getInstance()->getSitesIdWithAtLeastViewAccess());

		// get report types
		$reportTypes = Piwik_PDFReports_API::getReportTypes();
		$view->reportTypes = $reportTypes;
		$view->defaultReportType = self::DEFAULT_REPORT_TYPE;
		$view->defaultReportFormat = Piwik_PDFReports::DEFAULT_REPORT_FORMAT;

		$reportsByCategoryByType = array();
		$reportFormatsByReportType = array();
		$allowMultipleReportsByReportType = array();
		foreach($reportTypes as $reportType => $reportTypeIcon)
		{
			// get report formats
			$reportFormatsByReportType[$reportType] = Piwik_PDFReports_API::getReportFormats($reportType);
			$allowMultipleReportsByReportType[$reportType] = Piwik_PDFReports_API::allowMultipleReports($reportType);

			// get report metadata
			$reportsByCategory = array();
			$availableReportMetadata = Piwik_PDFReports_API::getReportMetadata($this->idSite, $reportType);
			foreach($availableReportMetadata as $reportMetadata)
			{
				$reportsByCategory[$reportMetadata['category']][] = $reportMetadata;
			}
			$reportsByCategoryByType[$reportType] = $reportsByCategory;
		}
		$view->reportsByCategoryByReportType = $reportsByCategoryByType;
		$view->reportFormatsByReportType = $reportFormatsByReportType;
		$view->allowMultipleReportsByReportType = $allowMultipleReportsByReportType;

		$reports = array();
		$reportsById = array();
		if(!Piwik::isUserIsAnonymous())
		{
			$reports = Piwik_PDFReports_API::getInstance()->getReports($this->idSite, $period = false, $idReport = false, $ifSuperUserReturnOnlySuperUserReports = true);
			foreach($reports as &$report)
			{
				$report['recipients'] = Piwik_PDFReports_API::getReportRecipients($report);
				$reportsById[$report['idreport']] = $report;
			}
		}
		$view->reports = $reports;
		$view->reportsJSON = Piwik_Common::json_encode($reportsById);

		$view->downloadOutputType = Piwik_PDFReports_API::OUTPUT_INLINE;

		$periods = array_merge(
			array('never' => Piwik_Translate('General_Never')),
			Piwik_PDFReports::getPeriodToFrequency()
		);
		// Do not display date range in selector
		unset($periods['range']);
		$view->periods = $periods;
		$view->defaultPeriod = Piwik_PDFReports::DEFAULT_PERIOD;

		$view->language = Piwik_LanguagesManager::getLanguageCodeForCurrentUser();

		echo $view->render();
	}
}
