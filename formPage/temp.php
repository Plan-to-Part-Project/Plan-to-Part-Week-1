

<html>
<head>
    <meta name="google-signin-client_id" content="438333229045-1lqhpbe3iacjq42bfn12895mbp8cv4bp.apps.googleusercontent.com">
</head>
<body>
<div id="abc"></div>
<script>
    function onSuccess(googleUser) {
        console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
        console.log(googleUser.getAuthResponse().id_token);
    }
    function onFailure(error) {
        console.log(error);
    }
    function renderButton() {

        gapi.signin2.render('abc', {
            'scope': 'profile email',
            'width': 240,
            'height': 50,
            'longtitle': true,
            'theme': 'dark',
            'onsuccess': onSuccess,
            'onfailure': onFailure

        });
    }
</script>

<script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
</body>
</html>

