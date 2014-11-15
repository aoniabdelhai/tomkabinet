<?php
class ModelCatalogTitelbank extends Model
{
	public function isIsbnEbook($isbn)
	{
		$query = $this->book_db->query("
			SELECT
				NULL
			FROM
				`Boeken`
			WHERE `Ean` = '" . $this->book_db->escape($isbn) . "'
			AND
			(
				    `Bindwijze` LIKE '%E-boek%'
				OR  `Bindwijze` IN (
					'Diversen',
					'Boek - ongespecificeerd',
					'Onbekend',
					'digitaal'
				)
			)
		");
		
		return ($query->num_rows) ? true : false;
	}
	
	public function getIsbnLanguage($isbn)
	{
		$query = $this->book_db->query("
			SELECT
				`Taalvermelding`
			FROM
				`Boeken`
			WHERE `Ean` = '" . $this->book_db->escape($isbn) . "'
			AND
			(
				    `Bindwijze` LIKE '%E-boek%'
				OR  `Bindwijze` IN (
					'Diversen',
					'Boek - ongespecificeerd',
					'Onbekend',
					'digitaal'
				)
			)
		");
		
		return ($query->num_rows) ? $query->row['Taalvermelding'] : false;
	}
	
	public function isTitleEbook($title)
	{
		$title = preg_replace('([^\p{L}0-9])u', ' ', $title);
		$title = preg_replace('( +)', ' ', $title);
		$title = trim($title);
		
		$query = $this->book_db->query("
			SELECT
				`Boeken`.`Ean`
			FROM
				`Boeken`
			WHERE `Boeken`.`TitelNormalized` LIKE '%" . $this->book_db->escape($title) . "%'
			AND
			(
				    `Boeken`.`Bindwijze` LIKE '%E-boek%'
				OR  `Boeken`.`Bindwijze` IN (
					'Diversen',
					'Boek - ongespecificeerd',
					'Onbekend',
					'digitaal'
				)
			)
		");
		
		return ($query->num_rows) ? true : false;
	}
	
	public function getIsbn($authorstring, $title)
	{
		$query = $this->book_db->query("
			SELECT
				`Boeken`.`Ean`
			FROM
				`Boeken`
			INNER JOIN `BoekAuteurs` ON `BoekAuteurs`.`Ean` = `Boeken`.`Ean`
			WHERE `BoekAuteurs`.`AuteurVolledigenaam` = '" . $this->book_db->escape($authorstring) . "'
			AND   `Boeken`.`Titel` = '" . $this->book_db->escape($title) . "'
			AND
			(
				    `Boeken`.`Bindwijze` LIKE '%E-boek%'
				OR  `Boeken`.`Bindwijze` IN (
					'Diversen',
					'Boek - ongespecificeerd',
					'Onbekend',
					'digitaal'
				)
			)
		");
		
		if (!$query->num_rows)
		{
			// check reverse naming of author (e.g. Harrison, Kathryn)
			$arrAuthor = explode(', ', $authorstring);
			if (2 === count($arrAuthor))
			{
				$authorstring = $arrAuthor[1] . ' ' . $arrAuthor[0];
				
				$query = $this->book_db->query("
					SELECT
						`Boeken`.`Ean`
					FROM
						`Boeken`
					INNER JOIN `BoekAuteurs` ON `BoekAuteurs`.`Ean` = `Boeken`.`Ean`
					WHERE `BoekAuteurs`.`AuteurVolledigenaam` = '" . $this->book_db->escape($authorstring) . "'
					AND   `Boeken`.`Titel` = '" . $this->book_db->escape($title) . "'
					AND
					(
						    `Boeken`.`Bindwijze` LIKE '%E-boek%'
						OR  `Boeken`.`Bindwijze` IN (
							'Diversen',
							'Boek - ongespecificeerd',
							'Onbekend',
							'digitaal'
						)
					)
				");
				
			}
		}
		
		return ($query->num_rows) ? $query->row['Ean'] : false;
	}
	
	public function getAuthorTitleEbooks($author, $title)
	{
		// check reverse naming of author (e.g. Harrison, Kathryn)
		$author2 = $author;
		$arrAuthor = explode(', ', $author2);
		if (2 === count($arrAuthor))
		{
			$author2 = $arrAuthor[1] . ' ' . $arrAuthor[0];
		}
		
		$title = preg_replace('([^\p{L}0-9])u', ' ', $title);
		$title = preg_replace('( +)', ' ', $title);
		$title = trim($title);
		
		$query = $this->book_db->query("
			SELECT
				`Boeken`.`Ean`,
				`Boeken`.`Samenvatting`,
				`Boeken`.`Taalvermelding`,
				`BoekAuteurs`.`AuteurAchternaam`
			FROM
				`Boeken`
			INNER JOIN `BoekAuteurs` ON `BoekAuteurs`.`Ean` = `Boeken`.`Ean`
			WHERE `Boeken`.`TitelNormalized` LIKE '" . $this->book_db->escape($title) . "%'
			AND   (
				`BoekAuteurs`.`AuteurVolledigenaam` = '" . $this->book_db->escape($author) . "'
					OR
				`BoekAuteurs`.`AuteurVolledigenaam` = '" . $this->book_db->escape($author2) . "'
			)
			AND
			(
				    `Boeken`.`Bindwijze` LIKE '%E-boek%'
				OR  `Boeken`.`Bindwijze` IN (
					'Diversen',
					'Boek - ongespecificeerd',
					'Onbekend',
					'digitaal'
				)
			)
		");
		
		return $query->rows;
	}
	public function getTitleEbooks($title)
	{
		$title = preg_replace('([^\p{L}0-9])u', ' ', $title);
		$title = preg_replace('( +)', ' ', $title);
		$title = trim($title);
		
		$query = $this->book_db->query("
			SELECT
				`Boeken`.`Ean`,
				`Boeken`.`Samenvatting`,
				`Boeken`.`Taalvermelding`,
				`BoekAuteurs`.`AuteurAchternaam`
			FROM
				`Boeken`
			INNER JOIN `BoekAuteurs` ON `BoekAuteurs`.`Ean` = `Boeken`.`Ean`
			WHERE `Boeken`.`TitelNormalized` LIKE '" . $this->book_db->escape($title) . "%'
			AND
			(
				    `Boeken`.`Bindwijze` LIKE '%E-boek%'
				OR  `Boeken`.`Bindwijze` IN (
					'Diversen',
					'Boek - ongespecificeerd',
					'Onbekend',
					'digitaal'
				)
			)
		");
		
		return $query->rows;
	}
}