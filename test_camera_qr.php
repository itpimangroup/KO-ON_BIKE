<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <title>QRCode Reader</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>QRコードリーダー</h1>
                    <div>
                        <video autoplay playsinline="true" style="width:100%; height: 100%; object-fit: fill;">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <span id="decoded-value"></span>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-primary" onclick="startReader();">Start</button>
                    <button type="button" class="btn" onclick="stopReader();">Stop</button>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/jsqr@latest/dist/jsQR.min.js"></script>
	<script src="https://static.line-scdn.net/liff/edge/2.1/sdk.js"></script>

    <script>
    class QRCodeReader {
        constructor (videoElement) {
            this.video = videoElement;
            this.canvas = document.createElement("canvas");
            this.context = this.canvas.getContext("2d");
            this.decoderId;
            this.decodedValue;
        }

        // Start QR Code Reader
        start(onCompleted, stopOnComplete) {
            this.decoderId = null;
            this.decodedValue = null;

            // Start camera
            navigator.mediaDevices.getUserMedia({
                audio: false,
                video: {
                    width: 500,
                    height: 500,
                    frameRate: {
                        max: 5  // 5fps
                    },
                    facingMode : {
                        exact : "environment"
                    }
                }
            }).then((mediaStream) => {
                // Bind media stream with video
                this.video.srcObject = mediaStream;
            });

            // Start reading
            this.decoderId = setInterval(() => {
                this.decodeQRCode();
                if (this.decodedValue || this.decodedValue == 0) {
                    if (stopOnComplete) {
                        this.stop();
                    }
                    onCompleted(this.decodedValue);
                }
            }, 200);  // 5fps -> read every 200ms
        };

        // Stop QR Code Reader
        stop() {
            if (this.video.srcObject) {
                // Stop camera
                this.video.srcObject.getVideoTracks().forEach((track) => {
                    track.stop();
                });
                // Stop QR Code decoder
                clearInterval(this.decoderId);
            }
        };

        decodeQRCode() {
            const width = this.video.videoWidth;
            const height = this.video.videoHeight;
            if (width > 0 && height > 0) {
                // Get snapshot from video
                this.canvas.width = width;
                this.canvas.height = height;
                this.context.clearRect(0, 0, width, height);
                this.context.drawImage(this.video, 0, 0, width, height);
                const imageData = this.context.getImageData(0, 0, width, height);
                // Decode QR Code
                const code = jsQR(imageData.data, imageData.width, imageData.height);
                if (code) {
                    this.decodedValue = code.data;
                }
            }
        }
    }

    
</script>
<script>
    // QRコードリーダーの初期化
    const reader = new QRCodeReader(document.querySelector("video"));

    // QRコードリーダー起動処理
    const startReader = () => {
        reader.start((value) => {
            // QRコード読み取り時に実行される処理（valueが読み取り値）
        //  var test  = document.querySelector("#decoded-value").textContent = value;
        // alert(value);
         
        }, false);  // false:読み取り後にリーダーを閉じない
    }

    // QRコードリーダー停止処理
    const stopReader = () => {
        reader.stop();
    }

    // LIFFの初期化
    liff.init({
        liffId: "1654776772-ElXxBR0Q"
    })
    .then(() => {
        accessToken = liff.getAccessToken();
        // AccessTokenの表示。これをサーバーサイドに渡してユーザー情報等を取得
        alert(accessToken);
    })
    .catch((err) => {
        alert(err);
    });
</script>


    </body>
</html>