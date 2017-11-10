{**
 * plugins/generic/lucene/templates/settingsForm.tpl
 *
 * Copyright (c) 2014-2017 Simon Fraser University
 * Copyright (c) 2003-2017 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Lucene plugin settings
 *}
<div id="solrSettings">

<!-- <div id="description">{translate key="plugins.generic.solr.description"}</div>
<h3>{translate key="plugins.generic.solr.settings"}</h3> -->

<script>
	$(function() {ldelim}
		// Attach the form handler.
		$('#solrSettingsForm').pkpHandler('$.pkp.controllers.form.AjaxFormHandler');
	{rdelim});
</script>

<form class="pkp_form" id="solrSettingsForm" method="post" action="{url router=$smarty.const.ROUTE_COMPONENT op="manage" category="generic" plugin=$pluginName verb="settings" save=true}">
	{csrf}
	{include file="common/formErrors.tpl"}
	
	{fbvFormArea id="solrSettingsFormArea" title="plugins.generic.solr.settings.solrServerSettings"}

		{fbvElement type="text" id="searchEndpoint" value=$searchEndpoint label="plugins.generic.solr.settings.searchEndpoint" size=$fbvStyles.size.MEDIUM required="true"}
		{fbvElement type="text" id="username" value=$username label="plugins.generic.solr.settings.username" size=$fbvStyles.size.MEDIUM}
		{fbvElement type="text" id="password" value=$password label="plugins.generic.solr.settings.password" size=$fbvStyles.size.MEDIUM}

	{/fbvFormArea}

	{fbvFormArea id="solrSettingsFormArea" title="plugins.generic.solr.settings.searchFeatures"}
		{fbvFormSection for="searchFeatures" list=true description="plugins.generic.solr.settings.searchFeatures.description"}
			{fbvElement type="checkbox" id="autosuggest" value="1" checked=$autosuggest label="plugins.generic.solr.settings.autosuggest"}
			{fbvElement type="checkbox" id="highlighting" value="1" checked=$highlighting label="plugins.generic.solr.settings.highlighting"}
		{/fbvFormSection}
	{/fbvFormArea}

	{fbvFormButtons}
</form>

<p><span class="formRequired">{translate key="common.requiredField"}</span></p>
</div>
