<!DOCTYPE HTML>
<html lang="{{ app()->getLocale() }}">

<head>
    <title>{{ env('APP_NAME') }}</title>
    <meta name="robots"
          content="noindex, nofollow">
    <link rel="shortcut icon"
          href="/favicon.png">
    <script>
        // Initialize the agent at application startup.
        const fpPromise = new Promise((resolve, reject) => {
                const script = document.createElement('script');
                script.onload = resolve;
                script.onerror = reject;
                script.async = true;
                script.src = "/js/fp.min.js";
                document.head.appendChild(script);
            })
            .then(() => FingerprintJS.load({
                token: "JAQdy9AySNSaanRzPPo3",
                region: "eu",
                endpoint: "https://metrics.goodaff.com"
            }));

        const cookieExpiryDate = new Date(Date.now() + (30 * 1000 * 60 * 60 * 24)).toUTCString(); // 30 days

        const fingerprintJSCookieExists = document.cookie.split(";").some((cookie) => cookie.trim().startsWith("fingerprint="));

        if (!fingerprintJSCookieExists) {
            fpPromise
                .then(fp => fp.get())
                .then(result => {
                    if (result.visitorId) {
                        document.cookie = "fingerprint=" + result.visitorId + ";expires=" + cookieExpiryDate + ";path=/";
                        console.log("Fingerprint set: " + result.visitorId);

                        window.setTimeout(function() {
                            window.location = "{!! $link !!}&s7=" + result.visitorId;
                        }, 100);
                    } else {
                        window.setTimeout(function() {
                            window.location = "{!! $link !!}";
                        }, 100);
                    }
                })
                .catch(error => {
                    console.log("Could not fetch fp!")

                    window.setTimeout(function() {
                        window.location = "{!! $link !!}";
                    }, 100);
                });
        } else {
            const fingerprintJSCookieValue = document.cookie.split("; ").find(row => row.startsWith("fingerprint=")).split("=")[1];

            console.log("Fingerprint already exists: " + fingerprintJSCookieValue)

            window.setTimeout(function() {
                window.location = "{!! $link !!}&s7=" + fingerprintJSCookieValue;
            }, 100);
        }
    </script>
    <script async
            src="https://www.googletagmanager.com/gtag/js?id=G-SXYMH6J6PD"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-SXYMH6J6PD');
    </script>
</head>

<body>
    <div style="text-align:center;"><img src="/loading.gif"
             alt="loading"></div>
</body>

</html>
