<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>error</title>
    <style>
body,
button {
  background: #f5f1e3;
  font-family: "Armata", sans-serif;
}

.errorModule {
  margin: 40px auto 20px;
  text-align: center;
  color: #a80000;
}
.errorModule .errorIcon {
  font-size: 34px;
  margin: 15px;
  animation: animateIcon 5s infinite;
}
.errorModule .errorMsg {
  font-size: 14px;
}
@keyframes animateIcon {
  0% {
    -ms-transform: scale(1);
    -moz-transform: scale(1);
    -webkit-transform: scale(1);
    transform: scale(1);
  }
  50% {
    -ms-transform: scale(2);
    -moz-transform: scale(2);
    -webkit-transform: scale(2);
    transform: scale(2);
  }
  100% {
    -ms-transform: scale(1);
    -moz-transform: scale(1);
    -webkit-transform: scale(1);
    transform: scale(1);
  }
}
        
    </style>
</head>

<body>
    <div class="errorModule">
        <div class="errorIcon">
            <i class="fa fa-unlink"></i>
        </div>
        <div class="errorMsg">مبلغ الدفع غير صحيح</div>
    </div>
</body>

</html>