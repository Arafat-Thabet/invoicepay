<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Other Tags -->

        <!-- Moyasar Styles -->
        <link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.7.3/moyasar.css">

        <!-- Moyasar Scripts -->
        <script src="https://polyfill.io/v3/polyfill.min.js?features=fetch"></script>
        <script src="https://cdn.moyasar.com/mpf/1.7.3/moyasar.js"></script>

        <!-- Download CSS and JS files in case you want to test it locally, but use CDN in production -->
    </head>
<body style="direction: rtl;">
    <div style="height: 100vh">
        <div class="mysr-form" style="margin: 10%"></div>
    </div>
    <script>
        Moyasar.init({
            element: '.mysr-form',
            // Amount in the smallest currency unit.
            // For example:
            // 10 SAR = 10 * 100 Halalas
            // 10 KWD = 10 * 1000 Fils
            // 10 JPY = 10 JPY (Japanese Yen does not have fractions)
            amount: <?= $_GET['total']*100 ?>,
            currency: "SAR",
            description: 'Coffee Order #1',
            publishable_api_key: 'pk_test_AQpxBV31a29qhkhUYFYUFjhwllaDVrxSq5ydVNui',
            callback_url: 'https://moyasar.com/thanks',
            // methods: ['creditcard'],
            language: 'ar',
            apple_pay: {
            country: 'SA',
            label: 'Awesome Cookie Store',
            validate_merchant_url: 'https://api.moyasar.com/v1/applepay/initiate',
        },
        });
    </script>
</body>
</html>
