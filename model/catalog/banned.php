<?php
class ModelCatalogBanned extends Model
{
	public function isBanned($author, $title)
	{
		$banned = false;
		
		// check reverse naming of author (e.g. Harrison, Kathryn)
		$author2 = $author;
		$arrAuthor = explode(', ', $author2);
		if (2 === count($arrAuthor))
		{
			$author2 = $arrAuthor[1] . ' ' . $arrAuthor[0];
		}
		
		$author2 = preg_replace('([^\p{L}0-9])u', ' ', $author2);
		$author2 = preg_replace('( +)', ' ', $author2);
		$author2 = trim($author2);
		
		$author = preg_replace('([^\p{L}0-9])u', ' ', $author);
		$author = preg_replace('( +)', ' ', $author);
		$author = trim($author);
		
		$title = preg_replace('([^\p{L}0-9])u', ' ', $title);
		$title = preg_replace('( +)', ' ', $title);
		$title = trim($title);
		
		/*
		$authorSql = '';
		foreach (explode(' ', $author) as $authorpart)
		{
			if ('' !== $authorSql) $authorSql .= " OR ";
			$authorSql .= "`author` LIKE '%" . $this->db->escape($authorpart) . "%'";
		}
		
		$query = $this->db->query("
			SELECT
				NULL
			FROM
				`omnia_banned_authors`
			WHERE " . $authorSql . "
		");
		
		$banned = ($query->num_rows) ? true : false;
		*/
		
		$query = $this->db->query("
			SELECT
				NULL
			FROM
				`omnia_banned_authors`
			WHERE `author` LIKE '%" . $this->db->escape($author) . "%'
			OR    `author` LIKE '%" . $this->db->escape($author2) . "%'
		");
		$banned = ($query->num_rows) ? true : false;
		
		if (false === $banned)
		{
			$query = $this->db->query("
				SELECT
					NULL
				FROM
					`omnia_banned_titels`
				WHERE (
					`author` LIKE '%" . $this->db->escape($author) . "%'
						OR
					`author` LIKE '%" . $this->db->escape($author2) . "%'
				)
				AND   `title` LIKE '%" . $this->db->escape($title) . "%'
			");
			
			$banned = ($query->num_rows) ? true : false;
		}
		
		return $banned;
	}
}