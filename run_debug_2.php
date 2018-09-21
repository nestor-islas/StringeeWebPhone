<!DOCTYPE html>
<html>
	<head>
		<title>TODO supply a title</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<script type="text/javascript" src="public_html/js/jquery-3.1.0.min.js"></script>
	</head>
	<body>

		<style>
			.display-none {
				display: none !important;
			}

			#header {
				height: 50px;
				position: relative;
			}

			.channels-control {
				background-color: #E9EBED;
				border-radius: 4px;

			}

			#header-call-btn {
				position: absolute;
				right: 900px;
				width: 50px;
				height: 25px;
				cursor: pointer;
			}

			#make-call-btn {
				position: absolute;
				right: 1100px;
				width: 150px;
				height: 25px;
				cursor: pointer;
			}

			.wrap-video {
				left: 360px;
				position: fixed;
				height: 500px;
				width: 1200px;
			}
			.wrap-video .video {
				width: 570px;
				float: left;
				height: 100%;
			}
			.wrap-video .video video {
				width: 550px;
				padding-right: 10px;
				background-color: #434a5c !important;
				height: 100%;
			}
		</style>

		<?php
		//	define('BASE_URL', 'https://test3.stringee.com/tmp/Stringee_WebPhone/public_html/');
		//header("Access-Control-Allow-Origin: *");
		include_once './config.php';

		//build JS===================================================== ==>
		$file1 = file_get_contents('public_html/js/StringeeHashMap.js');
		$file2 = file_get_contents('public_html/StringeeSoftPhone.js');

		$iframeContent = file_get_contents(BASE_URL_LOCAL . 'StringeeSoftphone_iframe.php');
		$iframeContent = str_replace("\r\n", "", $iframeContent);
		$iframeContent = str_replace("\n", "", $iframeContent);

		$file2 = str_replace('IFRAME_CONTENT_REPLACE_BY_PHP', $iframeContent, $file2);

		$all = $file1 . "\r\n" . $file2;

		$fp1 = fopen('public_html/StringeeSoftPhone-' . VERSION . '.js', 'w');
		fwrite($fp1, $all);
		//build JS===================================================== <==
		?>


		<script src="public_html/StringeeSoftPhone-<?= VERSION ?>.js"></script>

		<script>
			var config = {
				showMode: 'full',
				top: 45,
				left: 50,
//				right: 810,

				arrowLeft: 155,
				arrowDisplay: 'top',

				fromNumbers: [{alias: 'Huy-1', number: '+84899199586'}, {alias: 'Huy-2', number: '+2222'}],

				askCallTypeWhenMakeCall: false,

//				appendToElement: 'abc'
			};
			StringeeSoftPhone.init(config);


			//userId = huy1
			var access_token2 = '';

			//userId = huy
			access_token2 = 'eyJjdHkiOiJzdHJpbmdlZS1hcGk7dj0xIiwidHlwIjoiSldUIiwiYWxnIjoiSFMyNTYifQ.eyJqdGkiOiJTS2FKTnN2bHZUaHJoTG5KY205NVZOV05UUG1TbkllYlh1LTE1MzcxNzk1NjciLCJpc3MiOiJTS2FKTnN2bHZUaHJoTG5KY205NVZOV05UUG1TbkllYlh1IiwiZXhwIjoxNTM5NzcxNTY3LCJ1c2VySWQiOiJsdWFuIiwiaWNjX2FwaSI6dHJ1ZX0.Eqw2kmfTseVeA19zpfK9HGBTSw6q_wdVWy0GzJ961ts';

			StringeeSoftPhone.on('displayModeChange', function (event) {
				console.log('displayModeChange', event);
				if (event === 'min') {
					StringeeSoftPhone.config({arrowLeft: 75});
				} else if (event === 'full') {
					StringeeSoftPhone.config({arrowLeft: 155});
				}
			});

			StringeeSoftPhone.on('requestNewToken', function () {
				console.log('requestNewToken+++++++');
				StringeeSoftPhone.connect(access_token2);
			});

			StringeeSoftPhone.on('beforeMakeCall', function (call, callType) {
				console.log('beforeMakeCall: ' + callType);
				return true;
			});

			//neu ko dung video call thi ham nay ko can
			StringeeSoftPhone.on('addlocalstream', function (stream) {
//				console.log('addlocalstream: ', stream);
				localVideo.srcObject = null;
				localVideo.srcObject = stream;
			});

			//neu ko dung video call thi ham nay ko can
			//neu ham nay co thi bat buoc phai set vao remoteVideo cua document nay
			StringeeSoftPhone.on('addremotestream', function (stream) {
//				console.log('addremotestream: ', stream);
				remoteVideo.srcObject = null;
				remoteVideo.srcObject = stream;
			});

			//

			//access token het han
			var access_token1 = 'eyJjdHkiOiJzdHJpbmdlZS1hcGk7dj0xIiwidHlwIjoiSldUIiwiYWxnIjoiSFMyNTYifQ.eyJqdGkiOiJTS0xIb2NCdDl6Qk5qc1pLeThZaUVkSzRsU3NBZjhCSHpyLTE1MzUwMjQ1MzkiLCJpc3MiOiJTS0xIb2NCdDl6Qk5qc1pLeThZaUVkSzRsU3NBZjhCSHpyIiwiZXhwIjoxNTM1MDI0NTI5LCJ1c2VySWQiOiJodXlkbiIsImF0dHJpYnV0ZXMiOiJbXG5cdFx0XHR7YXR0cmlidXRlOiBcIm1hbnVhbF9zdGF0dXNcIiwgdG9waWM6IFwic3RhdHVzX2h1eWRuXCJ9XG5cdFx0XSIsInN1YnNjcmliZSI6InN0YXR1c19sdWFuIiwiaWNjX2FwaSI6dHJ1ZX0.v9wtWfylhgk8sexZ2MA2aV8po-1KpsDt0wZiEAI9FXE';

			//userId = luan1
//	var access_token = 'eyJjdHkiOiJzdHJpbmdlZS1hcGk7dj0xIiwidHlwIjoiSldUIiwiYWxnIjoiSFMyNTYifQ.eyJqdGkiOiJTS2FKTnN2bHZUaHJoTG5KY205NVZOV05UUG1TbkllYlh1LTE1MzQ2OTcyODciLCJpc3MiOiJTS2FKTnN2bHZUaHJoTG5KY205NVZOV05UUG1TbkllYlh1IiwiZXhwIjoxNTM3Mjg5Mjg3LCJ1c2VySWQiOiJsdWFuMSIsImljY19hcGkiOnRydWV9.mHePxYPAVDPmKrrhfbBrIurzGjsEVD7uPucpJeJ2vkM';


			//test
			//setTimeout(function () {
			// access_token2 = '1';
			StringeeSoftPhone.connect(access_token2);

//				StringeeSoftPhone.show('full');				
//				StringeeSoftPhone.config({fromNumbers: [{alias: 'Huy-1', number: '+1111'}, {alias: 'Huy-2', number: '+2222'}]});
			//}, 500);

//			StringeeSoftPhone.config({fromNumbers: [{alias: 'Huy2', number: '+22222'}]});



//			StringeeSoftPhone.show('full');

//			StringeeSoftPhone.config({arrowDisplay: 'bottom'});
		</script>

		<script>
			$(document).ready(function () {
				$('#make-call-btn').on('click', function () {
					StringeeSoftPhone.makeCall('84123456789', '84986776707', function (res) {
						console.log('res: ', res);
					});
				});

				$('#disconnect-btn').on('click', function () {
					StringeeSoftPhone.disconnect();
				});
			});
		</script>

		<div id="header">
			<button id="make-call-btn" class="channels-control" tabindex="-1" data-ember-action="1866">
				Make call
			</button>

			<button id="disconnect-btn" class="channels-control" tabindex="-1" data-ember-action="1866">
				Disconnect
			</button>

			<button id="header-call-btn" class="channels-control" tabindex="-1" data-ember-action="1866">
				Call
			</button>
		</div>

		<div id="abc" style="position: absolute; left: 100px; top: 200px; background-color: red">
			abc
		</div>

		<div class="wrap-video">
			<div class="video wrapLocalVideo">
				<video id="localVideo" class="flex-item" playsinline="" autoplay="" muted=""></video>

			</div>
			<div class="video wrapRemoteVideo">
				<video id="remoteVideo" class="flex-item" playsinline="" autoplay=""></video>

			</div>
		</div>

	</body>
</html>
