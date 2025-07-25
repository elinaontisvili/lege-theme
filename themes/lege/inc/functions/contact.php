<?php
class Legetheme_WP_Mail_From
{
	protected $name;
	
	protected $email;
	
	public function __construct($name = '', $email = '') {
		$this->setEmail($email)->setName($name);
		
	}
	
	public function setEmail($value) {
		$this->email = $value;
		return $this;
	}
	
	public function setName($value) {
		$this->name = $value;
		return $this;
	}
	
	public function filterEmailFrom($content_type) {
		return $this->email;
	}

	public function filterNameFrom($name) {
		return $this->name;
	}
	
	public function addFilters()
	{
		add_filter('wp_mail_from', array($this, 'filterEmailFrom'));
		add_filter('wp_mail_from_name', array($this, 'filterNameFrom'));
		
		return $this;
	}
}
$lege_mail_from = new Legetheme_WP_Mail_From();

/**
 * Send Contact Message
 * 
 * @param array $data
 * @return mixed
 * @throws Exception 
 */
function lege_send_contact($data) {
	$return = true;
	
	try {
		
		if (!wp_verify_nonce($_REQUEST['_wpnonce'], 'lege_contact_form_nonce')) {
			throw new Exception('Something went wrong. Please refresh the page and try again.');
		}
		
		foreach ($data as $k => $val) {
			$data[$k] = wp_filter_nohtml_kses(trim($val));
		}
		
		if (!$data['name']) {
			throw new Exception('Please enter your name.');
		}
		if (!is_email($data['email'])) {
			throw new Exception('Please enter a valid email address.');
		}
		if (!$data['message']) {
			throw new Exception('Please enter your message.');
		}
		
		do_action('lege_contact_form_send', $data);
		
		$redirectUrl = get_permalink();
		$redirectUrl = substr_count($redirectUrl, '?') ? '&success' : '?success';
		wp_redirect($redirectUrl);
		exit;
		/*
        $redirectUrl = add_query_arg('success', '', get_permalink());
        wp_redirect($redirectUrl);
        exit;
		*/

	} catch (Exception $e) {
		$return = array(
			'error' => 1,
			'msg'   => $e->getMessage(),
		);
	}
	
	return $return;
}


/**
 * Send Contact Form Email
 * 
 * @param array $data 
 */
function lege_contact_email_send($data) {
	global $lege_mail_from;
	try {
		$blog = get_bloginfo('name');

		$subject = 'Контактная форма на сайте ' . $blog;

		// $name = __('Имя','legetheme');
		$body = "
			Имя: {$data['name']}

			Почта: {$data['email']}

			Телефон: {$data['tel']}

			Компания: {$data['company']}


			Сообщение:

			{$data['message']}



			------------


			Отправленно с {$blog}
		";

		$lege_mail_from->setName($data['name'])->setEmail($data['email'])->addFilters();
			
		wp_mail(get_option('admin_email'), $subject, $body);
	} catch (Exception $e) {
		
	}
}
add_action('lege_contact_form_send', 'lege_contact_email_send');