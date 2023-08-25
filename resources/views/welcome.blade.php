<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://vjs.zencdn.net/7.15.4/video-js.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.3/css/bootstrap-colorpicker.min.css"
        rel="stylesheet">

    <style>
        .my-video-dimensions.vjs-fluid {
            padding: 0;
            width: 100% !important;
            height: 370px !important;
        }

        section.video_editor_section {
            display: flex;
            align-items: flex-start;
            gap: 20px;
        }

        .video_box {
            max-width: 600px;
            flex: 0 0 600px;
            position: relative;
        }

        .my-video-dimensions.vjs-fluid video {
            width: 100% !important;
            height: 100% !important;
        }

        .video_box input#speed-control {
            position: absolute;
            top: 5px;
            right: 5px;
        }

        .screenshot_editBox {

            align-items: flex-start;
            flex: 0 0 calc(100% - 620px);
            max-width: calc(100% - 620px);
            display: none;
        }

        .screenshotBox {
            height: 370px;
            max-width: 600px;
            flex: 0 0 600px;
        }

        .screenshotBox .canvas-container {
            width: 100% !important;
            height: 100% !important;
        }

        .screenshotBox .canvas-container canvas {
            width: 100% !important;
            height: 100% !important;
        }

        .edit_controls_box_ul {
            max-width: 160px;
            flex: 0 0 160px;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            gap: 0;
            flex-wrap: wrap;
            padding: 0;
            margin: 0;
            list-style: none;
            width: 100%;
            background-color: #121212;
        }

        ul.edit_controls_box_ul li.edit_tool {
            flex: 0 0 calc(50% - 1px);
            max-width: calc(50% - 1px);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 60px;
            color: white;
            font-size: 18px;
            border-bottom: 1px solid #ffffff3b;
        }

        ul.edit_controls_box_ul li.edit_tool:nth-child(odd) {
            border-right: 1px solid #ffffff3b;
        }

        span.text_span {
            background-color: #ffffff14;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        span.text_span:hover {
            background-color: #ffffff24;
        }

        .edit_controls_box {
            background-color: #121212;
            height: 370px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        ul.edit_controls_box_ul li.edit_tool:last-child,
        ul.edit_controls_box_ul li.edit_tool:nth-last-child(3) {
            border-bottom: 0;
        }

        .color_picker_div {
            width: 100%;
            margin: 0 0 10px;
        }

        .color_picker_div .color_picker_span {
            background-color: #ffffff;
            height: 30px;
            width: 83%;
            display: block;
            border-radius: 10px;
            margin: 0 auto;
        }

        .screenshot_btn {
            background-color: #252525;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: 0;
            margin: 15px 0 0;
            cursor: pointer;
        }

        button.screenshot_btn:hover {
            background-color: #333333;
        }
    </style>


</head>

<body>
    <section class="video_editor_section">
        <div class="video_box">
            <video id="my-video" style="width: 500px;height: 300px" class="video-js"></video>
            <input type="range" id="speed-control" min="0.1" max="3" step="0.1" value="1">

            <button class="screenshot_btn" type="button" onclick='screenshot();'><i class="fa-regular fa-images"></i>
                Take Screanshot</button>

        </div>

        <div class="screenshot_editBox">
            <div class="screenshotBox"></div>

            <div class="edit_controls_box">
                <div class="color_picker_div">
                    <label for="#color"></label>
                    <input type="button" class="color_picker_span" id="color">
                </div>
                <ul class="edit_controls_box_ul">
                    <li class="edit_tool">
                        <span class="text_span" id="textsbtn">
                            <i class="fa-solid fa-font"></i>
                        </span>
                    </li>
                    <li class="edit_tool">
                        <span class="text_span" id="line">
                            <i class="fa-solid fa-grip-lines"></i>
                        </span>
                    </li>
                    <li class="edit_tool">
                        <span class="text_span" id="circle">
                            <i class="fa-regular fa-circle"></i>
                        </span>
                    </li>
                    <li class="edit_tool">
                        <span class="text_span" id="rectangle">
                            <i class='bx bx-rectangle'></i>
                        </span>
                    </li>
                    <li class="edit_tool">
                        <span class="text_span" id="toggle-drawing-mode">
                            <i class="fa-solid fa-paintbrush"></i>
                        </span>
                    </li>
                    <li class="edit_tool">
                        <span class="text_span" id="arrow">
                            <i class="fa-solid fa-arrow-right-long"></i>
                        </span>
                    </li>
                    <li class="edit_tool">
                        <span class="text_span" onclick="undo()">
                            <i class="fa-solid fa-rotate-left"></i>
                        </span>
                    </li>
                    <li class="edit_tool">
                        <span class="text_span" onclick="redo()">
                            <i class="fa-solid fa-rotate-right"></i>
                        </span>
                    </li>
                    <li class="edit_tool" id="start_audio">
                        <span class="text_span" id="start">
                            <i class="fa-solid fa-microphone"></i>
                        </span>
                    </li>
                    <li class="edit_tool" id="stop_audio" style="display: none">
                        <span class="text_span" id="stop">
                            <i class="fa-solid fa-microphone-slash"></i>
                        </span>
                    </li>
                    <li class="edit_tool">
                        <span class="text_span" onclick="saveCanvasAsImage()">
                            <i class="fa-solid fa-floppy-disk"></i>
                        </span>
                    </li>
                </ul>


            </div>
        </div>

    </section>
    {{-- <button onclick="SaveAudioVideo()">Save</button> --}}
    <audio id="recorder" muted hidden></audio>
    <audio id="player" controls></audio>
    <video width="320" height="240" controls>
        <source src="video/test1_6989.mp4" type="video/mp4">
      </video>
</body>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script type="text/javascript" src="/html2canvas.js"></script>

<script src="https://vjs.zencdn.net/7.15.4/video.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.4.0/fabric.min.js"></script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.3/js/bootstrap-colorpicker.min.js">
</script>

<script>
    var canvas;
    var selectedColor = '#fff';
    $('#color').colorpicker({});

    function storeCanvas(canvasInstance) {
        canvas = canvasInstance;
    }
    $('#color').on('changeColor', function(event) {
        selectedColor = event.color.toHex();
        $(this).css('background-color', selectedColor);
        $(this).css('color', selectedColor);
        $(this).css('border', 'none');
        canvas.freeDrawingBrush.color = selectedColor;

    });


    function screenshot() {
        $('.screenshotBox').html('');
        $('.screenshot_editBox').css("display", "flex");
        var video = document.getElementById("my-video_html5_api");
        var canvasElement = document.createElement("canvas");
        canvasElement.width = 750;
        canvasElement.height = 460;

        html2canvas(video).then(function(renderedCanvas) {
            canvasElement.id = 'canvas';
            $('.screenshotBox').append(canvasElement);
            canvas = new fabric.Canvas('canvas');
            canvas.freeDrawingBrush.color = selectedColor;
            canvas.freeDrawingBrush.width = 2;
            canvas.setBackgroundImage(renderedCanvas.toDataURL(), canvas.renderAll.bind(canvas));
            canvas.isDrawingMode = false;
            canvas.on('object:added', function() {
                if (!isRedoing) {
                    h = [];
                }
                isRedoing = false;
            });
            storeCanvas(canvas);
        });
    }



    function saveCanvasAsImage() {
        if (canvas) {
            var imageData = document.getElementById("canvas").toDataURL();
            saveImageData(imageData);
        } else {
            console.log("Canvas is not initialized.");
        }
    }
    var isRedoing = false;
    var h = [];

    function undo() {
        if (canvas._objects.length > 0) {
            h.push(canvas._objects.pop());
            canvas.renderAll();
        }
    }

    function redo() {

        if (h.length > 0) {
            isRedoing = true;
            canvas.add(h.pop());
        }
    }

    $('#circle').click(function(e) {

        if (canvas) {
            var circle = new fabric.Circle({
                radius: 20,
                fill: 'transparent',
                stroke: selectedColor,
                left: 100,
                top: 100,
                editable: true,
            });
            console.log(selectedColor);
            canvas.add(circle);
            canvas.isDrawingMode = false;



        } else {
            console.log("Canvas is not initialized.");
        }
    });
    $('#line').click(function(e) {
        if (canvas) {
            var line = new fabric.Line([50, 50, 200, 50], {
                fill: 'transparent',
                stroke: selectedColor,
                strokeWidth: 5,
                editable: true,
            });
            canvas.add(line);
            canvas.isDrawingMode = false;

        } else {
            console.log("Canvas is not initialized.");
        }
    });
    $('#rectangle').click(function(e) {
        if (canvas) {
            var rect = new fabric.Rect({
                width: 100,
                height: 50,
                fill: 'transparent',
                stroke: selectedColor,
                strokeWidth: 2,
                left: 100,
                top: 100,
                editable: true,
            });
            canvas.add(rect);
            canvas.isDrawingMode = false;

        } else {
            console.log("Canvas is not initialized.");
        }
    });
    $('#arrow').click(function(e) {
        if (canvas) {
            var startPoint = {
                x: 50,
                y: 50
            };
            var endPoint = {
                x: 200,
                y: 50
            };

            var line = new fabric.Line([startPoint.x, startPoint.y, endPoint.x, endPoint.y], {
                fill: 'transparent',
                stroke: selectedColor,
                strokeWidth: 2,
                editable: true,
            });

            var arrowHead = new fabric.Triangle({
                width: 15,
                height: 20,
                fill: selectedColor,
                left: endPoint.x - -7,
                top: endPoint.y - 7,
                angle: 90,
                selectable: true,
            });

            const arrowGroup = new fabric.Group([line, arrowHead]);

            canvas.add(arrowGroup);
            line.selectable = true;

            canvas.isDrawingMode = false;

        } else {
            console.log("Canvas is not initialized.");
        }
    });






    $('#textsbtn').click(function(e) {
        e.preventDefault();
        var itext = new fabric.IText('Enter Your Text Here', {
            left: 10,
            top: 60,
            fontSize: 23,
            fontFamily: "Helvetica",
            fontStyle: "italic",
            stroke: selectedColor,
            fill: selectedColor,
        });
        canvas.add(itext);
        canvas.setActiveObject(itext);
        itext.enterEditing();
        itext.selectAll();
        itext.onblur = function() {
            itext.exitEditing();
        };
        canvas.isDrawingMode = false;
    });

    function saveImageData(imageData) {

        const audioElement = document.getElementById('player');
        const audioBlob = fetch(audioElement.src).then(response => response.blob());

        audioBlob.then(blob => {
            let formData = new FormData();
            formData.append('audio', blob, 'audio.mp3');
            formData.append('picture', imageData);
            $.ajax({
                url: '/save-canvas',
                method: 'POST',
                contentType: 'multipart/form-data',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                success: function(response) {
                    console.log(response);
                }
            });
        });
    }

    var toggleDrawingButton = document.getElementById('toggle-drawing-mode');
    var isDrawingMode = false;
    toggleDrawingButton.addEventListener('click', function() {
        console.log(canvas);
        isDrawingMode = !isDrawingMode;
        canvas.isDrawingMode = isDrawingMode;
        canvas.freeDrawingBrush.color = selectedColor;

    });

    var player = videojs('my-video', {
        controls: true,
        autoplay: false,
        preload: 'auto',
        fluid: true,
        sources: [{
            src: 'abc.mp4',
            type: 'video/mp4'
        }, ]
    });

    var speedControl = document.getElementById('speed-control');
    speedControl.addEventListener('input', function() {
        var playbackRate = parseFloat(speedControl.value);
        player.playbackRate(playbackRate);
    });



    class VoiceRecorder {
        constructor() {
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                console.log("getUserMedia supported")
            } else {
                console.log("getUserMedia is not supported on your browser!")
            }

            this.mediaRecorder
            this.stream
            this.chunks = []
            this.isRecording = false

            this.recorderRef = document.querySelector("#recorder")
            this.playerRef = document.querySelector("#player")
            this.startRef = document.querySelector("#start")
            this.stopRef = document.querySelector("#stop")

            this.startRef.onclick = this.startRecording.bind(this)
            this.stopRef.onclick = this.stopRecording.bind(this)

            this.constraints = {
                audio: true,
                video: false
            }

        }

        handleSuccess(stream) {
            this.stream = stream
            this.stream.oninactive = () => {
                console.log("Stream ended!")
            };
            this.recorderRef.srcObject = this.stream
            this.mediaRecorder = new MediaRecorder(this.stream)
            console.log(this.mediaRecorder)
            this.mediaRecorder.ondataavailable = this.onMediaRecorderDataAvailable.bind(this)
            this.mediaRecorder.onstop = this.onMediaRecorderStop.bind(this)
            this.recorderRef.play()
            this.mediaRecorder.start()
        }

        handleError(error) {
            console.log("navigator.getUserMedia error: ", error)
        }

        onMediaRecorderDataAvailable(e) {
            this.chunks.push(e.data)
        }

        onMediaRecorderStop(e) {
            const blob = new Blob(this.chunks, {
                'type': 'audio/mp3; codecs=opus'
            })
            const audioURL = window.URL.createObjectURL(blob)
            this.playerRef.src = audioURL
            this.chunks = []
            this.stream.getAudioTracks().forEach(track => track.stop())
            this.stream = null
        }

        startRecording() {
            $('#stop_audio').css('display', 'block');
            $('#start_audio').css('display', 'none');
            if (this.isRecording) return
            this.isRecording = true

            this.playerRef.src = ''
            navigator.mediaDevices
                .getUserMedia(this.constraints)
                .then(this.handleSuccess.bind(this))
                .catch(this.handleError.bind(this))
        }

        stopRecording() {
            $('#stop_audio').css('display', 'none');
            $('#start_audio').css('display', 'block');
            if (!this.isRecording) return
            this.isRecording = false

            this.recorderRef.pause()
            this.mediaRecorder.stop()
        }

    }

    window.voiceRecorder = new VoiceRecorder();

    // function SaveAudioVideo() {
    //     let formData = new FormData();
    //     formData.append('audio', $('#audio')[0].files[0]);
    //     formData.append('image', $('#image')[0].files[0]);
    //     $.ajax({
    //         type: "post",
    //         url: "{{ url('/add-video') }}",
    //         contentType: 'multipart/form-data',
    //         cache: false,
    //         contentType: false,
    //         processData: false,
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         data: formData,
    //         success: function(data) {

    //         }

    //     })
    // }
</script>


</html>
