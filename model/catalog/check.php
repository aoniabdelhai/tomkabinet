<?php
class ModelCatalogCheck extends Model
{
	public function addChecked($product_id, $data)
	{
		$strErrorKey = isset($data['errorKey']) ? $data['errorKey'] : 'ok';
		
		$query = $this->db->query("
			INSERT INTO
				`" . DB_PREFIX . "book_check`
			SET
				`product_id`	= " . $this->db->escape($product_id) . ",
				`date`			= NOW(),
				`key`			= '" . $this->db->escape($strErrorKey) . "',
				`source`		= 'upload',
				`accepted`		= 0,
				`deleted`		= 0,
				`isbn`			= '" . ($data['isbn'] ? $this->db->escape($data['isbn']) : '') . "',
				`authorstring`	= '" . ($data['authorstring'] ? $this->db->escape($data['authorstring']) : '') . "',
				`title`			= '" . ($data['title'] ? $this->db->escape($data['title']) : '') . "',
				`watermark`		= " . ($data['hasWatermark'] ? '1' : '0') . ",
				`calibre`		= " . ($data['calibre'] ? '1' : '0') . ",
				`sigil`			= " . ($data['sigil'] ? '1' : '0') . "
		");
		
		if ('ok' !== $strErrorKey)
		{
			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->hostname = $this->config->get('config_smtp_host');
			$mail->username = $this->config->get('config_smtp_username');
			$mail->password = $this->config->get('config_smtp_password');
			$mail->port = $this->config->get('config_smtp_port');
			$mail->timeout = $this->config->get('config_smtp_timeout');				
			
			$mail->setTo($this->config->get('config_email'));
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender($this->config->get('config_name'));
			$mail->setSubject('Acceptatie upload');
			$mail->setText('Product id: ' . $product_id . "\nError: " . $strErrorKey . "\nISBN: " . $data['isbn'] . "\nAuteur en titel: " . $data['authorstring'] . ' - ' . $data['title']);
			//$mail->setHtml($html);
			$mail->send();
		}
	}
}