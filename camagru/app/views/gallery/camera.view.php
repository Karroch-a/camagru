<html>
    <head>
    <head>
    <body>
        <video id="video" width="640" height="480" autoplay></video>
        <script type="text/javascript">
            // Grab elements, create settings, etc.
            var video = document.getElementById('video');

            // Get access to the camera!
            if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    // Not adding `{ audio: true }` since we only want video now
            navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
                //video.src = window.URL.createObjectURL(stream);
                video.srcObject = stream;
                video.play();
    });
}
        </script>
    </body>
</html>