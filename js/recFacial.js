window.requestFileSystem = window.requestFileSystem || window.webkitRequestFileSystem;

const main = async () => {
    const imageList = document.querySelector('#ListaImagenes');
    const videoContainer = document.getElementById('video');
    //const canvas = document.getElementById('canvas');
    //const context = canvas.getContext('2d');
    const video = await navigator.mediaDevices.getUserMedia({
        video: true,
    })

    await faceapi.nets.tinyFaceDetector.loadFromUri('../../tienda/models/')
    await faceapi.nets.faceLandmark68Net.loadFromUri('../../tienda/models')
    await faceapi.nets.faceExpressionNet.loadFromUri('../../tienda/models')
    await faceapi.nets.faceRecognitionNet.loadFromUri('../../tienda/models')

    videoContainer.srcObject = video;

    const imageDescriptors = [];
    var faceMatcher;

    const processStaticFace = async (image, id) => {
        const detection = await faceapi.detectSingleFace(image, new faceapi.TinyFaceDetectorOptions())
            .withFaceLandmarks()
            .withFaceDescriptor()
        if (detection === undefined) return;

        imageDescriptors.push({
            id,
            detection
        });

        faceMatcher = new faceapi.FaceMatcher(imageDescriptors.map(faceDescriptor => (
            new faceapi.LabeledFaceDescriptors(
                (faceDescriptor.id).toString(),
                [faceDescriptor.detection.descriptor]
            )
        )))
    }

    const syncImages = () => {
        list_images = new Array();

        $.get("procesos/usuarios/get_photos.php", function (result) {
            list_images = JSON.parse(result);
            for (let index = 0; index < list_images.length; index++) {
                const imageContainer = document.createElement('div');
                const label = document.createElement('input');
                const imageElement = document.createElement('img');
                const status = document.createElement('div');
                imageContainer.id = list_images[index].id;
                imageContainer.classList.add('image-container');

                imageElement.src = list_images[index].path.split('tienda/')[1];
                label.value = list_images[index].name;

                imageContainer.appendChild(status);
                imageContainer.appendChild(imageElement);
                imageContainer.appendChild(label);

                imageList.appendChild(imageContainer);
                processStaticFace(imageElement, list_images[index].id);
            }
        });
    }

    const reDraw = async () => {
        context.drawImage(videoContainer, 0, 0, 720, 520)

        //requestAnimationFrame(reDraw)
    }

    const processFace = async () => {
        const detection = await faceapi.detectSingleFace(videoContainer, new faceapi.TinyFaceDetectorOptions())
            .withFaceLandmarks()
            .withFaceDescriptor()
        if (detection === undefined) return;

        //if(!faceMatcher || !descriptor) return;
        const match = faceMatcher.findBestMatch(detection.descriptor);
        [...imageList.children].forEach(image => {
            if (image.id.indexOf(match._label) > -1) {
                $.ajax({
                    type: "POST",
                    data: { id: match._label },
                    url: "procesos/regLogin/login_recFac.php",
                    success: function (r) {
                        if (r == 1) {
                            window.location = "vistas/inicio.php";
                        }
                    }
                });
            }
        })
        console.log(match);
    }

    setInterval(processFace, 1000);
    //requestAnimationFrame(reDraw)
    syncImages();
}

main()