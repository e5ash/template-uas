<?php

class AMO {
	public $subdomain;
	public $acc;
	public $last_code;
	private $cookie_name;
	public $logged;
	public $CONTACT_EMAIL_ID;
	public $CONTACT_PHONE_ID;
	public $last_error;
	public $CUSTOM_TYPES=array('TEXT','NUMERIC','CHECKBOX','SELECT','MULTISELECT','DATE','URL','MULTITEXT','TEXTAREA','RADIOBUTTON','STREETADDRESS','SMART_ADDRESS','BIRTHDAY');
	public function __construct($user,$API,$subdomain)
	{
		$this->cookie_name="amo_cookie.txt";
		$this->logged=false;
		$this->subdomain=$subdomain;

		$res=$this->auth($API,$user);

		if(isset($res['response']['auth'])&&$res['response']['auth']==1){
			$this->logged=true;}
			else {
				die("Авторизация в АМО не удалась\n");}

				$this->acc=array();
				$this->acc=$this->get_acc();
				if(isset($this->acc['response']['account']))
				{
					$this->acc=$this->acc['response']['account'];
					$this->CONTACT_EMAIL_ID=$this->acc['custom_fields']['contacts'][2]['id'];
					$this->CONTACT_PHONE_ID=$this->acc['custom_fields']['contacts'][1]['id'];
				}


			}

			public function get_custom_type($id)
			{
				return $this->CUSTOM_TYPES[$id-1];
			}

			public function sendPOST($link,$var,$auth=false)
			{
	    $curl=curl_init(); #Сохраняем дескриптор сеанса cURL
	    #Устанавливаем необходимые опции для сеанса cURL
	    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
	    curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
	    curl_setopt($curl,CURLOPT_URL,$link);
	    curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
	    curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($var));
	    curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
	    curl_setopt($curl,CURLOPT_HEADER,false);
	    if($auth)curl_setopt($curl,CURLOPT_COOKIEJAR,$this->cookie_name);
	    curl_setopt($curl,CURLOPT_COOKIEFILE,$this->cookie_name); #PHP>5.3.6 dirname(__FILE__) -> __DIR__

	    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
	    curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
	    $out=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
	    $code=curl_getinfo($curl,CURLINFO_HTTP_CODE); #Получим HTTP-код ответа сервера
	    $this->last_code=$code;
	    $this->last_error=$out;
	    curl_close($curl); #Завершаем сеанс cURL
	    $Response=json_decode($out,true);
	    return $Response;
	}

	public function sendGET($link,$var=array())
	{
		$link=$link.http_build_query($var);
		$curl=curl_init(); #Сохраняем дескриптор сеанса cURL
	    #Устанавливаем необходимые опции для сеанса cURL
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
		curl_setopt($curl,CURLOPT_URL,$link);
		curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'GET');
		curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
		curl_setopt($curl,CURLOPT_HEADER,false);
	    curl_setopt($curl,CURLOPT_COOKIEFILE,$this->cookie_name); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
	    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
	    curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
	    $out=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
	    $code=curl_getinfo($curl,CURLINFO_HTTP_CODE); #Получим HTTP-код ответа сервера
	    $this->last_code=$code;
	    curl_close($curl); #Завершаем сеанс cURL
	    $Response=json_decode($out,true);
	    return $Response;

	}

	public function auth($API,$user)
	{
		$link='https://'.$this->subdomain.'.amocrm.ru/private/api/auth.php?type=json';
		$user_info=array(
    	'USER_LOGIN'=>$user, #Ваш логин (электронная почта)
    	'USER_HASH'=>$API #Хэш для доступа к API (смотрите в профиле пользователя)
    	);
		$res=$this->sendPOST($link,$user_info,1);
		return $res;
	}

	public function get_acc()
	{
		if(!$this->logged) return -1;
		if(count($this->acc)>0)return $this->acc;
		$link='https://'.$this->subdomain.'.amocrm.ru/private/api/v2/json/accounts/current';
		$res=$this->sendGET($link);
		return $res;
	}

	public function get_contacts($param)
	{
		if(!$this->logged) return -1;
		$link='https://'.$this->subdomain.'.amocrm.ru/private/api/v2/json/contacts/list?';
		$res=$this->sendGET($link,$param);
		if($this->last_code!=200)return -1;
		return $res['response'];
	}

	public function get_emails($contact)
	{

		$result=array();
		$f=$contact['custom_fields'];
		foreach ($f as $key => $value) {
			if($value['id']==$this->CONTACT_EMAIL_ID){
				foreach ($value['values'] as $key1 => $value1) {
					$result[]=strtolower($value1['value']);
				}
			}
		}
		return $result;
	}

public function get_phones($contact)
	{

		$result=array();
		$f=$contact['custom_fields'];
		foreach ($f as $key => $value) {
			if($value['id']==$this->CONTACT_PHONE_ID){
				foreach ($value['values'] as $key1 => $value1) {
					$result[]=strtolower($value1['value']);
				}
			}
		}
		return $result;
	}

	public    function get_field($contact,$field_id)
	{

		$result=array();
		$f=$contact['custom_fields'];
		foreach ($f as $key => $value) {
			if($value['id']==$field_id){
				foreach ($value['values'] as $key1 => $value1) {
					$result[]=$value1['value'];
				}
			}
		}
		return $result;
	}

	public    function get_field_enum($contact,$field_id)
	{

		$result=array();
		$f=$contact['custom_fields'];
		foreach ($f as $key => $value) {
			if($value['id']==$field_id){
				foreach ($value['values'] as $key1 => $value1) {
					$result[]=$value1['enum'];
				}
			}
		}
		return $result;
	}

	public function find_emails($email,$type)
	{
		$email=strtolower($email);
		$param=array('query'=>$email,'type'=>$type);
		$contacts=$this->get_contacts($param);
		$c=array();
		if(empty($contacts['contacts']))return $c;
		foreach ($contacts['contacts']  as $value) {
			$e=$this->get_emails($value);
			if(in_array($email, $e))$c[]=$value;
		}
		return $c;
	}

	public function find_emails_lead($email)
	{
		$email=strtolower($email);
		$param=array('query'=>$email);
		$leads=$this->get_leads($param);
		$c=array();
		if(empty($leads['leads']))return $c;
		foreach ($leads['leads']  as $value) {
			$c[]=$value;
		}
		return $c;
	}


	public function find_phones($phone,$type)
	{
		$phone=preg_replace("/[^0-9]/", "", $phone);
		$param=array('query'=>$phone,'type'=>$type);
		$contacts=$this->get_contacts($param);
		$c=array();
		if(empty($contacts['contacts']))return $c;
		return $contacts['contacts'];
	}


	public function get_leads($param)
	{
		if(!$this->logged) return -1;
		$link='https://'.$this->subdomain.'.amocrm.ru/private/api/v2/json/leads/list?';
		$res=$this->sendGET($link,$param);
		if($this->last_code!=200)return -1;
		return $res['response'];

	}

	public function find_lead($id)
	{
		$param=array('id'=>$id);
		$lead=$this->get_leads($param);
		if(!empty($lead['leads']))$lead=$lead['leads'][0];
		return $lead;

	}

	public function find_contact($id)
	{
		$param=array('id'=>$id);
		$contact=$this->get_contacts($param);
		if(!empty($contact['contacts']))$contact=$contact['contacts'][0];
		return $contact;

	}

	public function get_tasks($lead_id)
	{
		if(!$this->logged) return -1;
		$link='https://'.$this->subdomain.'.amocrm.ru/private/api/v2/json/tasks/list?';
		$param=array('type'=>'lead','element_id'=>$lead_id);
		$res=$this->sendGET($link,$param);
		if($this->last_code!=200)return -1;
		return $res['response'];

	}

	public function add_tasks($tasks)
	{
		$link='https://'.$this->subdomain.'.amocrm.ru/private/api/v2/json/tasks/set';
		$param['request']['tasks']['add']=$tasks;
		$res=$this->sendPOST($link,$param);
		if($this->last_code!=200)return -1;
		return $res['response'];
	}

	public function add_tag($contact_id,$tag)
	{
		date_default_timezone_set( 'Europe/Moscow' );
		$link='https://'.$this->subdomain.'.amocrm.ru/private/api/v2/json/contacts/set';
		$param=array('id'=>$contact_id);
		$c=$this->get_contacts($param);
		if(empty($c))return -1;
		$old_tags=$c['contacts'][0]['tags'];
		$tags=array();
		foreach ($old_tags as $value) {
			$tags[]=$value['name'];

		}
		$tags[]=$tag;
		$tags=implode(",", $tags);
		$param['request']['contacts']['update']=array(array('id'=>$contact_id,'tags'=>$tags,'last_modified'=>time()));
		$res=$this->sendPOST($link,$param);
		if($this->last_code!=200)return -1;
		return $res['response'];
	}

	public function link_contact_lead($contact_id,$lead_id)
	{
		$link='https://'.$this->subdomain.'.amocrm.ru/private/api/v2/json/links/set';
		$param['request']['links']['link'] = array(
			array(
				'from' => 'leads',
				'to' => 'contacts',
				'to_id' => $contact_id,
				'from_id' => $lead_id,
				"quantity"=> 1
				
				));
		$res=$this->sendPOST($link,$param);
		if($this->last_code!=200)return -1;
		return $res['response'];
	}

	public function add_contact($contact)
	{

		$link='https://'.$this->subdomain.'.amocrm.ru/private/api/v2/json/contacts/set';
		$param['request']['contacts']['add']=array($contact);
		$res=$this->sendPOST($link,$param);
		if($this->last_code!=200)return -1;
		return $res['response'];
	}

	public function add_lead($lead)
	{
		$link='https://'.$this->subdomain.'.amocrm.ru/private/api/v2/json/leads/set';
		$param['request']['leads']['add']=array($lead);
		$res=$this->sendPOST($link,$param);
		if($this->last_code!=200)return -1;
		return $res['response']['leads']['add'][0]['id'];

	}

	public function edit_lead($lead,$id)
	{
		$link='https://'.$this->subdomain.'.amocrm.ru/private/api/v2/json/leads/set';
		$lead['id']=$id;
		$lead['last_modified']=time();
		$param['request']['leads']['update']=array($lead);
		$res=$this->sendPOST($link,$param);
		if($this->last_code!=200)return -1;
		return $res['response']['leads']['update'][0]['id'];

	}

	public function add_lead_custom($lead,$packet,$food_count,$days='')
	{

		switch ($packet) {
			case 'Яркий Старт':
			$p='Старт';
			break;
			case 'Стандарт':
			$p='Стандарт';
			break;
			case 'Спорт':
			$p='Спорт';
			break;
			case 'Премиум':
			$p='Премиум';
			break;

			default:
    			# code...
			break;
		}
		if($food_count=='Не выбрано')$f='';
		$f=$food_count;
		$d=$days;
		$lead['custom_fields']=array(array('id'=>1923584,'values'=>array(array('value'=>$p))),array('id'=>1923590,'values'=>array(array('value'=>$f))),array('id'=>1923594,'values'=>array(array('value'=>$d))));
		$res=$this->add_lead($lead);
		return $res;
	}

	public function add_contact_info($name,$phone='',$email='',$linked_lead='', $source='')
	{
		$cont=array(
			'name'=>$name,
			'linked_leads_id'=>array($linked_lead),
			'custom_fields'=>array(
				array(
					'id'=>$this->CONTACT_PHONE_ID,
					'values'=>array(
						array(
							'value'=>$phone,
							'enum'=>'MOB'
							)
						)
					),
				array(
					'id'=>442343,
					'values'=>array(
						array(
							'value'=>$source,
							
							)
						)
					),
				array(
					'id'=>$this->CONTACT_EMAIL_ID,
					'values'=>array(
						array(
							'value'=>$email,
							'enum'=>'WORK'
							)
						)
					)
				)
			);
		$res=$this->add_contact($cont);
		return $res['contacts']['add'][0]['id'];

	}

	
}

?>