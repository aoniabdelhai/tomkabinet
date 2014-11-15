<?php
class ModelCatalogBooklanguage extends Model
{
	protected static $map = null;
	
	public function getLanguageCodeByLanguageMeta($metaLanguage)
	{
		$languageCode = 'anders';
		
		$query = $this->db->query("
			SELECT
				language_id
			FROM
				`omnia_norm_lang`
			WHERE `language_desc` = '" . $this->db->escape($metaLanguage) . "'
		");
		if ($query->num_rows)
		{
			$languageCode = $query->row['language_id'];
		}
		
		return $languageCode;
	}
	
	public function getNormalizationMapping()
	{
		$arrMapping = array();
		$query = $this->db->query("
			SELECT
				`language_desc`,
				`language_id`
			FROM
				`omnia_norm_lang`
		");
		foreach ($query->rows as $row)
		{
			$arrMapping[strtolower($row['language_desc'])] = $row['language_id'];
		}
		
		return $arrMapping;
	}
	
	public function getNormalizedLanguageCodes()
	{
		$arrLanguagesCodes = array();
		$query = $this->db->query("
			SELECT
				`language_id`
			FROM
				`omnia_norm_lang`
		");
		foreach ($query->rows as $row)
		{
			$arrLanguagesCodes[] = $row['language_id'];
		}
		
		return $arrLanguagesCodes;
	}
}