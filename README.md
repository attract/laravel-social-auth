#using

$redirect_uri = 'http://website.com/verity';
$auther = new SocialAuther(['vk', 'facebook'], $redirect_uri);

//Auth links <br/>
$links = $auther->getAuthUrls();

//If isset $_GET['code']<br/>
if ($auther->authenticate()) {<br/>
	$data = [<br/>
		'token' => $token,<br/>
		'name'  => $auther->getName(),<br/>
		'email' => $auther->getEmail(),<br/>
	];<br/>
}
