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
        login: function () {
            FB.getLoginStatus(function (response) {
                if (response.status === 'connected') {
                    FB.api('/me', function (response) {
                        console.log(response);
                        console.log('Good to see you, ' + response.name + '.');

                        user = {
                            name: response.first_name,
                            lastName: response.last_name,
                            img: 'https://graph.facebook.com/' + response.id + '/picture'
                        }
                        console.log('Logged in.');
                    });
                }
                else {
                    FB.login(function () {
                    }, { scope: 'email' });
                }
            });
        }
    }
} ]);
