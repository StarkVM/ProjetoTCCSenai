<!DOCTYPE html>
<html class="light" lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;family=Space+Grotesk:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tensorflow.js/4.11.0/tf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tensorflow.js/4.11.0/tf-backend-webgl.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/coco-ssd@2.2.2"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/blazeface@0.0.7"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary-container": "#f9a825",
                        "on-secondary-container": "#5a666d",
                        "on-primary-fixed-variant": "#643f00",
                        "surface-variant": "#e5e2e1",
                        "tertiary": "#006687",
                        "on-surface": "#1c1b1b",
                        "on-primary": "#ffffff",
                        "background": "#fcf9f8",
                        "on-tertiary-fixed": "#001e2b",
                        "inverse-surface": "#313030",
                        "surface-dim": "#dcd9d9",
                        "primary": "#835400",
                        "surface-bright": "#fcf9f8",
                        "on-tertiary-container": "#004f69",
                        "outline-variant": "#d7c3ae",
                        "on-error-container": "#93000a",
                        "outline": "#857462",
                        "on-tertiary-fixed-variant": "#004d66",
                        "inverse-on-surface": "#f3f0ef",
                        "secondary": "#546067",
                        "on-primary-fixed": "#2a1800",
                        "inverse-primary": "#ffb957",
                        "on-tertiary": "#ffffff",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-high": "#ebe7e7",
                        "error": "#ba1a1a",
                        "primary-fixed-dim": "#ffb957",
                        "surface-tint": "#835400",
                        "on-error": "#ffffff",
                        "surface-container-highest": "#e5e2e1",
                        "on-primary-container": "#674100",
                        "on-surface-variant": "#524434",
                        "secondary-fixed-dim": "#bbc8d0",
                        "primary-fixed": "#ffddb5",
                        "surface-container-low": "#f6f3f2",
                        "on-secondary-fixed-variant": "#3c494f",
                        "surface": "#fcf9f8",
                        "on-background": "#1c1b1b",
                        "tertiary-fixed-dim": "#71d2ff",
                        "error-container": "#ffdad6",
                        "secondary-container": "#d7e4ec",
                        "tertiary-fixed": "#c0e8ff",
                        "on-secondary": "#ffffff",
                        "secondary-fixed": "#d7e4ec",
                        "tertiary-container": "#2ac6ff",
                        "surface-container": "#f0edec",
                        "on-secondary-fixed": "#111d23"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "fontFamily": {
                        "headline": ["Space Grotesk"],
                        "body": ["Inter"],
                        "label": ["Inter"]
                    }
                },
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .btn-industrial {
            background-color: #835400;
        }
        .detection-overlay {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            border-radius: 50%;
            width: 100%;
            aspect-ratio: 3 / 4;
            max-width: 320px;
            max-height: 420px;
            margin: 0 auto;
            border: 3px dashed #f9a825;
            background-color: #000;
        }
        #camera-feed {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
        }
        .status-indicator {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
        }
        .status-indicator.success {
            background-color: #d4edda;
            color: #155724;
        }
        .status-indicator.warning {
            background-color: #fff3cd;
            color: #856404;
        }
        .status-indicator.error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .pulse {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
        #canvas-capture {
            display: none;
        }
        .hidden-input {
            display: none;
        }
        .quality-bar {
            height: 8px;
            background-color: #e5e2e1;
            border-radius: 0.25rem;
            overflow: hidden;
        }
        .quality-fill {
            height: 100%;
            background: linear-gradient(90deg, #835400, #f9a825);
            transition: width 0.3s ease;
        }
    </style>
</head>
<body class="bg-background text-on-surface font-body selection:bg-primary-container min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-2xl animate-in fade-in zoom-in duration-500">
        <form id="faceForm" method="POST" enctype="multipart/form-data">
            <div class="text-center mb-12">
                <p class="text-primary font-headline font-bold uppercase tracking-widest text-sm mb-2">Verificação de Identidade</p>
                <h2 class="text-6xl font-headline font-black tracking-tighter text-on-surface">Análise Facial</h2>
            </div>

            <!-- Estado: Instrução Inicial -->
            <div id="instruction-stage" class="mb-12">
                <div class="bg-surface-container-lowest rounded-xl border-dashed border-2 border-outline-variant/50 p-12 flex flex-col items-center justify-center text-center shadow-sm">
                    <div class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mb-8">
                        <span class="material-symbols-outlined text-5xl text-primary">face</span>
                    </div>
                    <h3 class="text-2xl font-headline font-black tracking-tight mb-4">Análise de Rosto</h3>
                    <p class="text-on-surface-variant text-sm mb-8 max-w-md">
                        Posicione seu rosto de frente para a câmera em um local bem iluminado. O sistema analisará automaticamente sua imagem e capturará quando tudo estiver perfeito.
                    </p>
                    <div class="flex gap-4 flex-wrap justify-center">
                        <button type="button" id="startBtn" class="group relative overflow-hidden px-8 py-4 rounded-lg font-headline font-bold uppercase tracking-wide text-sm flex items-center gap-3 mx-auto text-black shadow-lg transition-all duration-300 hover:scale-105 active:scale-95"
                        style="background: linear-gradient(135deg, #f2b705, #f9a825); box-shadow: 0 8px 20px rgba(249,168,37,0.4);">
                            <span class="material-symbols-outlined text-lg">videocam</span>
                            Iniciar Câmera
                            <span class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Estado: Análise em Tempo Real -->
            <div id="analysis-stage" class="hidden mb-12">
                <div class="bg-surface-container-lowest rounded-xl border border-outline-variant/50 p-6 flex flex-col items-center justify-center text-center shadow-sm">
                    <div class="detection-overlay mb-8">
                        <video id="camera-feed" class="w-full h-full" autoplay playsinline></video>
                    </div>

                    <!-- Mensagem Dinâmica de Feedback -->
                    <div id="feedback-container" class="w-full mb-6 text-center min-h-[80px] flex flex-col justify-center">
                        <div id="feedback-message" class="text-sm font-headline font-bold text-on-surface-variant mb-3">
                            Carregando modelo de detecção...
                        </div>
                        <div id="quality-info" class="flex justify-between items-center">
                            <span class="text-xs font-body">Qualidade</span>
                            <span id="quality-percentage" class="text-sm font-bold text-primary">0%</span>
                        </div>
                        <div class="quality-bar mt-2">
                            <div id="quality-fill" class="quality-fill" style="width: 0%"></div>
                        </div>
                    </div>

                    <!-- Status Checklist -->
                    <div class="w-full mb-6 space-y-2 bg-surface-container p-4 rounded-lg">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-body">Rosto detectado</span>
                            <span id="status-face" class="text-xs font-bold" style="color: #ba1a1a;">●</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-body">Posicionamento</span>
                            <span id="status-position" class="text-xs font-bold" style="color: #ba1a1a;">●</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-body">Inclinação</span>
                            <span id="status-angle" class="text-xs font-bold" style="color: #ba1a1a;">●</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-body">Iluminação</span>
                            <span id="status-lighting" class="text-xs font-bold" style="color: #ba1a1a;">●</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-body">Tamanho</span>
                            <span id="status-size" class="text-xs font-bold" style="color: #ba1a1a;">●</span>
                        </div>
                    </div>

                    <!-- Status de Envio -->
                    <div id="sending-status" class="hidden mb-6 text-center">
                        <div class="status-indicator success pulse mx-auto">
                            <span class="material-symbols-outlined text-lg">check_circle</span>
                            <span>Capturando foto...</span>
                        </div>
                    </div>

                    <div class="flex gap-4 flex-wrap justify-center w-full">
                        <button type="button" id="cancelBtn" class="group relative overflow-hidden px-8 py-4 rounded-lg font-headline font-bold uppercase tracking-wide text-sm flex items-center gap-3 mx-auto text-white shadow-lg transition-all duration-300 hover:scale-105 active:scale-95 bg-on-surface-variant">
                            <span class="material-symbols-outlined text-lg">close</span>
                            Cancelar
                            <span class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        </button>
                    </div>
                </div>
            </div>

            <input type="file" id="documentoInput" name="documento" accept="image/*" class="hidden-input" />
        </form>

        <!-- Botão Voltar -->
        <div class="mt-12 text-center">
            <a href="../UploadDocumentos/code.html" class="text-on-surface-variant hover:text-primary transition-colors flex items-center gap-2 font-headline font-bold uppercase tracking-tight text-xs justify-center">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Voltar para upload de documentos
            </a>
        </div>
    </div>

    <canvas id="canvas-capture" class="hidden"></canvas>

    <script>
        let stream = null;
        let model = null;
        let detectionRunning = false;
        let qualityMet = false;
        let lastCaptureTime = 0;

        const video = document.getElementById('camera-feed');
        const canvas = document.getElementById('canvas-capture');
        const ctx = canvas.getContext('2d');

        const startBtn = document.getElementById('startBtn');
        const cancelBtn = document.getElementById('cancelBtn');

        const instructionStage = document.getElementById('instruction-stage');
        const analysisStage = document.getElementById('analysis-stage');

        const feedbackMessage = document.getElementById('feedback-message');
        const qualityPercentage = document.getElementById('quality-percentage');
        const qualityFill = document.getElementById('quality-fill');
        const sendingStatus = document.getElementById('sending-status');

        const statusElements = {
            face: document.getElementById('status-face'),
            position: document.getElementById('status-position'),
            angle: document.getElementById('status-angle'),
            lighting: document.getElementById('status-lighting'),
            size: document.getElementById('status-size')
        };

        // Carregar modelo BlazeFace
        async function loadModel() {
            try {
                feedbackMessage.textContent = 'Carregando modelo de detecção...';
                model = await blazeface.load();
                feedbackMessage.textContent = 'Modelo carregado! Posicione seu rosto...';
                return true;
            } catch (err) {
                console.error('Erro ao carregar modelo:', err);
                feedbackMessage.textContent = '❌ Erro ao carregar modelo. Tente novamente.';
                return false;
            }
        }

        // Iniciar câmera
        startBtn.addEventListener('click', async () => {
            try {
                startBtn.disabled = true;
                startBtn.textContent = 'Carregando...';

                if (!model) {
                    const loaded = await loadModel();
                    if (!loaded) {
                        startBtn.disabled = false;
                        startBtn.textContent = 'Iniciar Câmera';
                        return;
                    }
                }

                stream = await navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: 'user',
                        width: { ideal: 1280 },
                        height: { ideal: 720 }
                    }
                });

                video.srcObject = stream;
                instructionStage.classList.add('hidden');
                analysisStage.classList.remove('hidden');

                video.onloadedmetadata = () => {
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
                    setTimeout(startDetection, 500);
                };
            } catch (err) {
                alert('Erro ao acessar câmera: ' + err.message);
                startBtn.disabled = false;
                startBtn.textContent = 'Iniciar Câmera';
            }
        });

        // Iniciar detecção
        function startDetection() {
            detectionRunning = true;
            detectFace();
        }

        // Detectar rosto
        async function detectFace() {
            if (!detectionRunning || !model) {
                if (detectionRunning) {
                    requestAnimationFrame(detectFace);
                }
                return;
            }

            try {
                const predictions = await model.estimateFaces(video, false);
                updateValidationStatus(predictions);
                requestAnimationFrame(detectFace);
            } catch (err) {
                console.error('Erro na detecção:', err);
                requestAnimationFrame(detectFace);
            }
        }

        // Atualizar status de validação
        function updateValidationStatus(predictions) {
            let validationScores = {
                face: false,
                position: false,
                angle: false,
                lighting: false,
                size: false
            };

            let messages = [];

            // Validar detecção de rosto
            const faceDetected = predictions && predictions.length === 1;
            updateStatusDot(statusElements.face, faceDetected);
            validationScores.face = faceDetected;

            if (!faceDetected) {
                if (!predictions || predictions.length === 0) {
                    messages.push('🔍 Nenhum rosto detectado - Aproxime-se da câmera');
                } else {
                    messages.push('👥 Múltiplos rostos - Remova outras pessoas');
                }
                updateQuality(0);
                updateFeedback(messages);
                return;
            }

            const face = predictions[0];
            const start = face.start;
            const end = face.end;

            const faceX = start[0];
            const faceY = start[1];
            const faceWidth = end[0] - start[0];
            const faceHeight = end[1] - start[1];

            const videoWidth = video.videoWidth;
            const videoHeight = video.videoHeight;

            // Validar posicionamento
            const faceHCenter = faceX + faceWidth / 2;
            const faceVCenter = faceY + faceHeight / 2;
            const centerX = videoWidth / 2;
            const centerY = videoHeight / 2;

            const toleranceX = videoWidth * 0.15;
            const toleranceY = videoHeight * 0.15;

            const isPositioned = Math.abs(faceHCenter - centerX) < toleranceX && Math.abs(faceVCenter - centerY) < toleranceY;
            updateStatusDot(statusElements.position, isPositioned);
            validationScores.position = isPositioned;

            if (!isPositioned) {
                if (faceHCenter < centerX) {
                    messages.push('👉 Mova para a direita');
                } else if (faceHCenter > centerX) {
                    messages.push('👈 Mova para a esquerda');
                }
                if (faceVCenter < centerY) {
                    messages.push('⬇️ Mova para baixo');
                } else if (faceVCenter > centerY) {
                    messages.push('⬆️ Mova para cima');
                }
            }

            // Validar inclinação
            const landmarks = face.landmarks;
            let isAngular = true;
            if (landmarks && landmarks.length >= 2) {
                const leftEye = landmarks[0];
                const rightEye = landmarks[1];
                const eyeAngle = Math.atan2(rightEye[1] - leftEye[1], rightEye[0] - leftEye[0]);
                const angleDeg = Math.abs(eyeAngle * 180 / Math.PI);
                isAngular = angleDeg < 15;
                if (!isAngular) {
                    messages.push('🔄 Mantenha a cabeça reta');
                }
            }
            updateStatusDot(statusElements.angle, isAngular);
            validationScores.angle = isAngular;

            // Validar tamanho
            const faceArea = (faceWidth * faceHeight) / (videoWidth * videoHeight);
            const isSizeOk = faceArea > 0.15 && faceArea < 0.6;
            updateStatusDot(statusElements.size, isSizeOk);
            validationScores.size = isSizeOk;

            if (!isSizeOk) {
                if (faceArea < 0.15) {
                    messages.push('➕ Aproxime-se');
                } else {
                    messages.push('➖ Afaste-se');
                }
            }

            // Validar iluminação
            ctx.drawImage(video, 0, 0);
            const imageData = ctx.getImageData(Math.floor(faceX), Math.floor(faceY), Math.floor(faceWidth), Math.floor(faceHeight));
            let brightSum = 0;
            for (let i = 0; i < imageData.data.length; i += 4) {
                brightSum += (imageData.data[i] + imageData.data[i+1] + imageData.data[i+2]) / 3;
            }
            const brightness = brightSum / (imageData.data.length / 4);
            const isLit = brightness > 50 && brightness < 230;
            updateStatusDot(statusElements.lighting, isLit);
            validationScores.lighting = isLit;

            if (!isLit) {
                messages.push(brightness < 50 ? '💡 Mais luz' : '🌞 Menos luz');
            }

            // Calcular qualidade
            const validCount = Object.values(validationScores).filter(v => v).length;
            const quality = (validCount / 5) * 100;
            updateQuality(quality);

            if (validCount === 5) {
                messages = ['✅ Perfeito! Capturando...'];
                if (sendingStatus.classList.contains('hidden')) {
                    sendingStatus.classList.remove('hidden');
                }
                qualityMet = true;

                if (Date.now() - lastCaptureTime > 1500) {
                    lastCaptureTime = Date.now();
                    captureFaceAndSubmit();
                }
            } else {
                qualityMet = false;
                sendingStatus.classList.add('hidden');
            }

            updateFeedback(messages);
        }

        // Atualizar status dot
        function updateStatusDot(element, isValid) {
            element.style.color = isValid ? '#2ac6ff' : '#ba1a1a';
            element.textContent = isValid ? '✓' : '●';
        }

        // Atualizar qualidade
        function updateQuality(quality) {
            qualityPercentage.textContent = Math.round(quality) + '%';
            qualityFill.style.width = quality + '%';
        }

        // Atualizar feedback
        function updateFeedback(messages) {
            if (messages.length === 0) {
                feedbackMessage.textContent = 'Posicione seu rosto...';
            } else {
                feedbackMessage.innerHTML = messages.map(m => `<div>${m}</div>`).join('');
            }
        }

        // Capturar e enviar
        function captureFaceAndSubmit() {
            if (Date.now() - lastCaptureTime < 1000) return;
            
            try {
                detectionRunning = false;

                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                ctx.drawImage(video, 0, 0);

                canvas.toBlob((blob) => {
                    if (!blob) {
                        lastCaptureTime = 0;
                        detectionRunning = true;
                        return;
                    }

                    if (stream) {
                        stream.getTracks().forEach(track => track.stop());
                        stream = null;
                    }

                    const formData = new FormData();
                    formData.append('image', blob, 'foto_rosto.jpg');
                    formData.append('tipo', 'facial');

                    fetch('../Scanner/process-upload.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success) {
                            setTimeout(() => {
                                window.location.href = '../UploadDocumentos/code.html?success=1';
                            }, 500);
                        } else {
                            feedbackMessage.innerHTML = '❌ Erro: ' + (data.error || 'Desconhecido');
                            qualityMet = false;
                            lastCaptureTime = 0;
                            detectionRunning = true;
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        feedbackMessage.innerHTML = '❌ Erro ao enviar. Tente novamente.';
                        qualityMet = false;
                        lastCaptureTime = 0;
                        detectionRunning = true;
                    });

                }, 'image/jpeg', 0.95);
            } catch (err) {
                console.error(err);
                qualityMet = false;
                lastCaptureTime = 0;
                detectionRunning = true;
            }
        }

        // Cancelar
        cancelBtn.addEventListener('click', () => {
            detectionRunning = false;
            qualityMet = false;
            lastCaptureTime = 0;
            
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }
            analysisStage.classList.add('hidden');
            instructionStage.classList.remove('hidden');
            stream = null;
        });

        // Carregar modelo ao iniciar
        window.addEventListener('load', loadModel);
    </script>
</body>
</html>
?>
?>
<!DOCTYPE html>
<html class="light" lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;family=Space+Grotesk:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script async defer src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary-container": "#f9a825",
                        "on-secondary-container": "#5a666d",
                        "on-primary-fixed-variant": "#643f00",
                        "surface-variant": "#e5e2e1",
                        "tertiary": "#006687",
                        "on-surface": "#1c1b1b",
                        "on-primary": "#ffffff",
                        "background": "#fcf9f8",
                        "on-tertiary-fixed": "#001e2b",
                        "inverse-surface": "#313030",
                        "surface-dim": "#dcd9d9",
                        "primary": "#835400",
                        "surface-bright": "#fcf9f8",
                        "on-tertiary-container": "#004f69",
                        "outline-variant": "#d7c3ae",
                        "on-error-container": "#93000a",
                        "outline": "#857462",
                        "on-tertiary-fixed-variant": "#004d66",
                        "inverse-on-surface": "#f3f0ef",
                        "secondary": "#546067",
                        "on-primary-fixed": "#2a1800",
                        "inverse-primary": "#ffb957",
                        "on-tertiary": "#ffffff",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-high": "#ebe7e7",
                        "error": "#ba1a1a",
                        "primary-fixed-dim": "#ffb957",
                        "surface-tint": "#835400",
                        "on-error": "#ffffff",
                        "surface-container-highest": "#e5e2e1",
                        "on-primary-container": "#674100",
                        "on-surface-variant": "#524434",
                        "secondary-fixed-dim": "#bbc8d0",
                        "primary-fixed": "#ffddb5",
                        "surface-container-low": "#f6f3f2",
                        "on-secondary-fixed-variant": "#3c494f",
                        "surface": "#fcf9f8",
                        "on-background": "#1c1b1b",
                        "tertiary-fixed-dim": "#71d2ff",
                        "error-container": "#ffdad6",
                        "secondary-container": "#d7e4ec",
                        "tertiary-fixed": "#c0e8ff",
                        "on-secondary": "#ffffff",
                        "secondary-fixed": "#d7e4ec",
                        "tertiary-container": "#2ac6ff",
                        "surface-container": "#f0edec",
                        "on-secondary-fixed": "#111d23"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "fontFamily": {
                        "headline": ["Space Grotesk"],
                        "body": ["Inter"],
                        "label": ["Inter"]
                    }
                },
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .btn-industrial {
            background-color: #835400;
        }
        .detection-overlay {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            border-radius: 50%;
            width: 100%;
            aspect-ratio: 3 / 4;
            max-width: 320px;
            max-height: 420px;
            margin: 0 auto;
            border: 3px dashed #f9a825;
            background-color: #000;
        }
        #camera-feed {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
        }
        #canvas-capture {
            display: none;
        }
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
        }
        .status-indicator.success {
            background-color: #d4edda;
            color: #155724;
        }
        .status-indicator.warning {
            background-color: #fff3cd;
            color: #856404;
        }
        .status-indicator.error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .pulse {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
        .quality-bar {
            height: 8px;
            background-color: #e5e2e1;
            border-radius: 0.25rem;
            overflow: hidden;
        }
        .quality-fill {
            height: 100%;
            background: linear-gradient(90deg, #835400, #f9a825);
            transition: width 0.3s ease;
        }
        .hidden-input {
            display: none;
        }
    </style>
</head>
<body class="bg-background text-on-surface font-body selection:bg-primary-container min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-2xl animate-in fade-in zoom-in duration-500">
        <form id="faceForm" method="POST" enctype="multipart/form-data">
            <div class="text-center mb-12">
                <p class="text-primary font-headline font-bold uppercase tracking-widest text-sm mb-2">Verificação de Identidade</p>
                <h2 class="text-6xl font-headline font-black tracking-tighter text-on-surface">Análise Facial</h2>
            </div>

            <!-- Estado: Instrução Inicial -->
            <div id="instruction-stage" class="mb-12">
                <div class="bg-surface-container-lowest rounded-xl border-dashed border-2 border-outline-variant/50 p-12 flex flex-col items-center justify-center text-center shadow-sm">
                    <div class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mb-8">
                        <span class="material-symbols-outlined text-5xl text-primary">face</span>
                    </div>
                    <h3 class="text-2xl font-headline font-black tracking-tight mb-4">Análise de Rosto</h3>
                    <p class="text-on-surface-variant text-sm mb-8 max-w-md">
                        Posicione seu rosto de frente para a câmera em um local bem iluminado. O sistema analisará automaticamente sua imagem e enviará quando atender aos critérios de qualidade.
                    </p>
                    <div class="flex gap-4 flex-wrap justify-center">
                        <button type="button" id="startBtn" class="group relative overflow-hidden px-8 py-4 rounded-lg font-headline font-bold uppercase tracking-wide text-sm flex items-center gap-3 mx-auto text-black shadow-lg transition-all duration-300 hover:scale-105 active:scale-95"
                        style="background: linear-gradient(135deg, #f2b705, #f9a825); box-shadow: 0 8px 20px rgba(249,168,37,0.4);">
                            <span class="material-symbols-outlined text-lg">videocam</span>
                            Iniciar Câmera
                            <span class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Estado: Análise em Tempo Real -->
            <div id="analysis-stage" class="hidden mb-12">
                <div class="bg-surface-container-lowest rounded-xl border border-outline-variant/50 p-6 flex flex-col items-center justify-center text-center shadow-sm">
                    <div class="detection-overlay mb-8">
                        <video id="camera-feed" class="w-full h-full" autoplay playsinline></video>
                    </div>

                    <!-- Mensagem Dinâmica de Feedback -->
                    <div id="feedback-container" class="w-full mb-6 text-center min-h-[80px] flex flex-col justify-center">
                        <div id="feedback-message" class="text-sm font-headline font-bold text-on-surface-variant mb-3">
                            Iniciando análise...
                        </div>
                        <div id="quality-info" class="flex justify-between items-center">
                            <span class="text-xs font-body">Qualidade</span>
                            <span id="quality-percentage" class="text-sm font-bold text-primary">0%</span>
                        </div>
                        <div class="quality-bar mt-2">
                            <div id="quality-fill" class="quality-fill" style="width: 0%"></div>
                        </div>
                    </div>

                    <!-- Status Checklist -->
                    <div class="w-full mb-6 space-y-2 bg-surface-container p-4 rounded-lg">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-body">Rosto detectado</span>
                            <span id="status-face" class="text-xs font-bold">●</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-body">Posicionamento</span>
                            <span id="status-position" class="text-xs font-bold">●</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-body">Inclinação</span>
                            <span id="status-angle" class="text-xs font-bold">●</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-body">Iluminação</span>
                            <span id="status-lighting" class="text-xs font-bold">●</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-body">Tamanho</span>
                            <span id="status-size" class="text-xs font-bold">●</span>
                        </div>
                    </div>

                    <!-- Status de Envio -->
                    <div id="sending-status" class="hidden mb-6 text-center">
                        <div class="status-indicator success pulse mx-auto">
                            <span class="material-symbols-outlined text-lg">check_circle</span>
                            <span>Capturando foto...</span>
                        </div>
                    </div>

                    <div class="flex gap-4 flex-wrap justify-center w-full">
                        <button type="button" id="cancelBtn" class="group relative overflow-hidden px-8 py-4 rounded-lg font-headline font-bold uppercase tracking-wide text-sm flex items-center gap-3 mx-auto text-white shadow-lg transition-all duration-300 hover:scale-105 active:scale-95 bg-on-surface-variant">
                            <span class="material-symbols-outlined text-lg">close</span>
                            Cancelar
                            <span class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        </button>
                    </div>
                </div>
            </div>

            <input type="file" id="documentoInput" name="documento" accept="image/*" class="hidden-input" />
        </form>

        <!-- Botão Voltar -->
        <div class="mt-12 text-center">
            <a href="../UploadDocumentos/code.html" class="text-on-surface-variant hover:text-primary transition-colors flex items-center gap-2 font-headline font-bold uppercase tracking-tight text-xs justify-center">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Voltar para upload de documentos
            </a>
        </div>
    </div>

    <canvas id="canvas-capture" class="hidden"></canvas>

    <script>
        let stream = null;
        let modelsLoaded = false;
        let detectionRunning = false;
        let qualityMet = false;
        let lastSubmitTime = 0;

        const video = document.getElementById('camera-feed');
        const canvas = document.getElementById('canvas-capture');
        const ctx = canvas.getContext('2d');

        const startBtn = document.getElementById('startBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const faceForm = document.getElementById('faceForm');
        const documentoInput = document.getElementById('documentoInput');

        const instructionStage = document.getElementById('instruction-stage');
        const analysisStage = document.getElementById('analysis-stage');
        const sendingStatus = document.getElementById('sending-status');

        // Elementos de feedback
        const feedbackMessage = document.getElementById('feedback-message');
        const qualityPercentage = document.getElementById('quality-percentage');
        const qualityFill = document.getElementById('quality-fill');

        // Status indicators
        const statusElements = {
            face: document.getElementById('status-face'),
            position: document.getElementById('status-position'),
            angle: document.getElementById('status-angle'),
            lighting: document.getElementById('status-lighting'),
            size: document.getElementById('status-size')
        };

        // Cores para status
        const colors = {
            error: '#ba1a1a',
            warning: '#f9a825',
            success: '#2ac6ff'
        };

        // Carregar modelos Face-api
        async function loadModels() {
            try {
                const MODEL_URL = 'https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/weights/';
                await Promise.all([
                    faceapi.nets.tinyFaceDetector.loadFromUri(MODEL_URL),
                    faceapi.nets.faceLandmarks68Net.loadFromUri(MODEL_URL),
                    faceapi.nets.faceExpressionNet.loadFromUri(MODEL_URL),
                    faceapi.nets.faceDescriptorNet.loadFromUri(MODEL_URL)
                ]);
                modelsLoaded = true;
                console.log('Modelos carregados com sucesso');
            } catch (err) {
                console.error('Erro ao carregar modelos:', err);
                alert('Erro ao carregar modelos de detecção. Tente novamente.');
            }
        }

        // Iniciar câmera
        startBtn.addEventListener('click', async () => {
            try {
                if (!modelsLoaded) {
                    startBtn.disabled = true;
                    startBtn.textContent = 'Carregando modelos...';
                    await loadModels();
                    startBtn.disabled = false;
                    startBtn.textContent = 'Iniciar Câmera';
                }

                stream = await navigator.mediaDevices.getUserMedia({
                    video: { 
                        facingMode: 'user',
                        width: { ideal: 1280 },
                        height: { ideal: 720 }
                    }
                });

                video.srcObject = stream;
                instructionStage.classList.add('hidden');
                analysisStage.classList.remove('hidden');

                video.onloadedmetadata = () => {
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
                    setTimeout(startDetection, 500);
                };
            } catch (err) {
                alert('Não foi possível acessar a câmera. Verifique as permissões.');
                console.error(err);
            }
        });

        // Iniciar detecção
        function startDetection() {
            detectionRunning = true;
            detectFace();
        }

        // Detectar rosto
        async function detectFace() {
            if (!detectionRunning || !modelsLoaded) {
                if (detectionRunning) {
                    requestAnimationFrame(detectFace);
                }
                return;
            }

            try {
                const detections = await faceapi
                    .detectAllFaces(video, new faceapi.TinyFaceDetectorOptions())
                    .withFaceLandmarks()
                    .withFaceExpressions();

                updateValidationStatus(detections);

                requestAnimationFrame(detectFace);
            } catch (err) {
                console.error('Erro na detecção:', err);
                requestAnimationFrame(detectFace);
            }
        }

        // Atualizar status de validação
        function updateValidationStatus(detections) {
            let validationScores = {
                face: false,
                position: false,
                angle: false,
                lighting: false,
                size: false
            };

            let messages = [];

            // Validar detecção de rosto
            const faceDetected = detections.length === 1;
            updateStatusDot(statusElements.face, faceDetected);
            validationScores.face = faceDetected;

            if (!faceDetected) {
                if (detections.length === 0) {
                    messages.push('🔍 Nenhum rosto detectado - Aproxime-se da câmera');
                } else {
                    messages.push('👥 Múltiplos rostos detectados - Remova outras pessoas');
                }
                updateQuality(0);
                updateFeedback(messages);
                return;
            }

            const detection = detections[0];
            const box = detection.detection.box;
            const landmarks = detection.landmarks;

            const videoWidth = video.videoWidth;
            const videoHeight = video.videoHeight;
            const faceLeft = box.x;
            const faceTop = box.y;
            const faceRight = box.x + box.width;
            const faceBottom = box.y + box.height;

            // Validar posicionamento
            const horizontalCenter = videoWidth / 2;
            const verticalCenter = videoHeight / 2;
            const faceHCenter = (faceLeft + faceRight) / 2;
            const faceVCenter = (faceTop + faceBottom) / 2;

            const horizontalTolerance = videoWidth * 0.15;
            const verticalTolerance = videoHeight * 0.15;

            const hDiff = Math.abs(faceHCenter - horizontalCenter);
            const vDiff = Math.abs(faceVCenter - verticalCenter);

            const isPositionedWell = hDiff < horizontalTolerance && vDiff < verticalTolerance;
            updateStatusDot(statusElements.position, isPositionedWell);
            validationScores.position = isPositionedWell;

            if (!isPositionedWell) {
                if (hDiff > horizontalTolerance) {
                    messages.push(faceHCenter < horizontalCenter ? '👈 Mova o rosto para a direita' : '👉 Mova o rosto para a esquerda');
                }
                if (vDiff > verticalTolerance) {
                    messages.push(faceVCenter < verticalCenter ? '⬇️ Mova o rosto para baixo' : '⬆️ Mova o rosto para cima');
                }
            }

            // Validar inclinação
            const leftEye = landmarks.getLeftEye();
            const rightEye = landmarks.getRightEye();

            let isAngleOk = true;
            if (leftEye && rightEye) {
                const leftEyeAvg = leftEye.reduce((a, p) => ({ x: a.x + p.x, y: a.y + p.y }), { x: 0, y: 0 });
                const rightEyeAvg = rightEye.reduce((a, p) => ({ x: a.x + p.x, y: a.y + p.y }), { x: 0, y: 0 });
                
                leftEyeAvg.x /= leftEye.length;
                leftEyeAvg.y /= leftEye.length;
                rightEyeAvg.x /= rightEye.length;
                rightEyeAvg.y /= rightEye.length;

                const eyeAngle = Math.atan2(rightEyeAvg.y - leftEyeAvg.y, rightEyeAvg.x - leftEyeAvg.x);
                const angleDegrees = Math.abs(eyeAngle * 180 / Math.PI);

                isAngleOk = angleDegrees < 15;
                if (!isAngleOk) {
                    messages.push('🔄 Mantenha a cabeça reta e olhando para a câmera');
                }
            }
            updateStatusDot(statusElements.angle, isAngleOk);
            validationScores.angle = isAngleOk;

            // Validar tamanho
            const faceArea = (box.width * box.height) / (videoWidth * videoHeight);
            const isSizeOk = faceArea > 0.20 && faceArea < 0.70;
            updateStatusDot(statusElements.size, isSizeOk);
            validationScores.size = isSizeOk;

            if (!isSizeOk) {
                if (faceArea < 0.20) {
                    messages.push('➕ Aproxime-se mais da câmera');
                } else {
                    messages.push('➖ Afaste-se da câmera');
                }
            }

            // Validar iluminação
            ctx.drawImage(video, 0, 0);
            const imageData = ctx.getImageData(
                Math.floor(Math.max(0, faceLeft)),
                Math.floor(Math.max(0, faceTop)),
                Math.floor(Math.min(box.width, videoWidth - faceLeft)),
                Math.floor(Math.min(box.height, videoHeight - faceTop))
            );

            let brightnessSum = 0;
            let pixelCount = 0;
            for (let i = 0; i < imageData.data.length; i += 4) {
                const r = imageData.data[i];
                const g = imageData.data[i + 1];
                const b = imageData.data[i + 2];
                brightnessSum += (r + g + b) / 3;
                pixelCount++;
            }

            const avgBrightness = pixelCount > 0 ? brightnessSum / pixelCount : 100;
            const isLightingOk = avgBrightness > 60 && avgBrightness < 220;
            updateStatusDot(statusElements.lighting, isLightingOk);
            validationScores.lighting = isLightingOk;

            if (!isLightingOk) {
                if (avgBrightness < 60) {
                    messages.push('💡 O ambiente está muito escuro - Aumente a iluminação');
                } else {
                    messages.push('🌞 Muita luz - Reduza o brilho ou mude de posição');
                }
            }

            // Calcular qualidade
            const validCount = Object.values(validationScores).filter(v => v).length;
            const qualityScore = (validCount / 5) * 100;
            updateQuality(qualityScore);

            // Se todas as validações passaram
            if (validCount === 5) {
                messages = ['✅ Perfeito! Capturando foto...'];
                if (!sendingStatus.classList.contains('hidden') === false) {
                    sendingStatus.classList.remove('hidden');
                }
                qualityMet = true;
                
                if (Date.now() - lastSubmitTime > 1000) {
                    lastSubmitTime = Date.now();
                    setTimeout(() => {
                        if (qualityMet && detectionRunning) {
                            captureFaceAndSubmit();
                        }
                    }, 500);
                }
            } else {
                qualityMet = false;
                if (!sendingStatus.classList.contains('hidden')) {
                    sendingStatus.classList.add('hidden');
                }
            }

            updateFeedback(messages);
        }

        // Atualizar ponto de status
        function updateStatusDot(element, isValid) {
            element.style.color = isValid ? colors.success : colors.error;
            element.textContent = isValid ? '✓' : '●';
        }

        // Atualizar qualidade
        function updateQuality(quality) {
            qualityPercentage.textContent = Math.round(quality) + '%';
            qualityFill.style.width = quality + '%';
        }

        // Atualizar mensagem de feedback
        function updateFeedback(messages) {
            if (messages.length === 0) {
                feedbackMessage.textContent = 'Posicione seu rosto no centro...';
            } else {
                feedbackMessage.innerHTML = messages.map(msg => `<div>${msg}</div>`).join('');
            }
        }

        // Capturar rosto e enviar
        function captureFaceAndSubmit() {
            if (Date.now() - lastSubmitTime < 3000) return;
            lastSubmitTime = Date.now();

            try {
                detectionRunning = false;

                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                ctx.drawImage(video, 0, 0);

                canvas.toBlob((blob) => {
                    if (!blob) {
                        console.error('Erro ao gerar blob');
                        lastSubmitTime = 0;
                        detectionRunning = true;
                        return;
                    }

                    // Parar câmera imediatamente
                    if (stream) {
                        stream.getTracks().forEach(track => {
                            track.stop();
                        });
                        stream = null;
                    }

                    // Preparar dados para upload
                    const formData = new FormData();
                    formData.append('image', blob, 'foto_rosto.jpg');
                    formData.append('tipo', 'facial');

                    // Fazer upload via AJAX
                    fetch('../Scanner/process-upload.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Upload realizado com sucesso', data);
                            // Redirecionar para UploadDocumentos
                            setTimeout(() => {
                                window.location.href = '../UploadDocumentos/code.html?success=1';
                            }, 500);
                        } else {
                            console.error('Erro no upload:', data.error);
                            feedbackMessage.innerHTML = `❌ Erro: ${data.error}`;
                            lastSubmitTime = 0;
                            detectionRunning = true;
                        }
                    })
                    .catch(err => {
                        console.error('Erro na requisição:', err);
                        feedbackMessage.innerHTML = '❌ Erro ao enviar imagem. Tente novamente.';
                        lastSubmitTime = 0;
                        detectionRunning = true;
                    });

                }, 'image/jpeg', 0.95);
            } catch (err) {
                console.error('Erro ao capturar e enviar:', err);
                lastSubmitTime = 0;
                detectionRunning = true;
            }
        }

        // Cancelar
        cancelBtn.addEventListener('click', () => {
            detectionRunning = false;
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }
            analysisStage.classList.add('hidden');
            instructionStage.classList.remove('hidden');
            stream = null;
            qualityMet = false;
            lastSubmitTime = 0;
        });

        // Carregar modelos ao iniciar
        window.addEventListener('load', () => {
            loadModels();
        });
    </script>
</body>
</html>
