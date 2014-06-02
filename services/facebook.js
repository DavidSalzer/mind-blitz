mindBlitzApp.factory('facebook', [function () {

    window.fbAsyncInit = function () {
        FB.init({
            appId: '1453794104867608',
            xfbml: true,
            version: 'v2.0'
        });
    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) { return; }
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    } (document, 'script', 'facebook-jssdk'));

    return {
        login: function (res) {
            FB.getLoginStatus(function (response) {
                if (response.status === 'connected') {
                    FB.api('/me', function (response) {
						res(response);
                    });
                }
                else {
                    FB.login(function (response) {
						if (response.status === 'connected') {
							FB.api('/me', function (response) {
								res(response);
							});
						}
                    }, { scope: 'email' });
                }
            });
        },
		share:function(m){
			FB.ui(
			{
				method: 'feed',
				name: m.name,
				link: m.link,
				picture: m.picture,
				caption: m.caption,
				description: m.description,
				message: ''
			});
		}
    }
} ]);
