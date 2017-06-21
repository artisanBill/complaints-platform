/**
 * Error alert message.
 *
 * @param  string messageAlert
 * @return void
 */
function alertMessage(messageAlert, resulType)
{
	var alertColor;

	switch ( resulType )
	{
		case 'success':
				alertColor = '36, 206, 123';
			break;

		case 'notice':
				alertColor = '255, 164, 0';
			break;

		default:
				alertColor = '255, 50, 64';
			break;
	}
	var $dialogMessageStyle = 'style="position:fixed;top:0;left:0;width:100%;background-color:rgba(' + alertColor + ', .8);padding-top:12px;padding-bottom:12px;text-align:center;color:white"';
	var $messageStyle = 'style="font-size:16px;font-weight:400"';
	var $htmlAlert = '<div id="dialogMessage" ' + $dialogMessageStyle + '><div ' + $messageStyle + '>' + messageAlert + '<div></div>';
	$('body').append($htmlAlert);
	setTimeout(function()
	{
		$('#dialogMessage').remove();
	}, 1500);
}