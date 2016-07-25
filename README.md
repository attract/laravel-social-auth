using

$redirect_uri = 'http://website.com/verity';
$auther = new SocialAuther(['vk', 'facebook'], $redirect_uri);

//Auth links

$links = $auther->getAuthUrls();

//If isset $_GET['code']
if ($auther->authenticate()) {
	$data = [
		'token' => $token,
		'name'  => $auther->getName(),
		'email' => $auther->getEmail(),
	];
}
