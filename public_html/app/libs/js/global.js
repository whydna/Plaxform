function showNotification(type, message)
{
	// if notification already exists, destroy it first
	if ($('notification') != null) {
		$('notification').destroy();
	}
	
	var notification = new Element('div', {
			'id':'notification',
			'class':type+'_notification',
			'html':message,
			'events':{
				'click':function() { this.destroy(); }
			}
		});
	
	$(document.body).insertBefore(notification,$(document.body).firstChild);
	
	// fade and and destroy after 2 seconds
	fadeOutNotification.delay(2000); 
}

////////////////////////////////////////////////////////////////////////////

function fadeOutNotification()
{
	if ($('notification') != null) {
		$('notification').fade(0).get('tween').chain(function() {
			$('notification').destroy();
		});
	}
}
