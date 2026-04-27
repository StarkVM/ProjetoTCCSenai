<?php
session_start();

// Validar tipo de documento
$tipo_documento = isset($_GET['tipo']) ? $_GET['tipo'] : null;
$tipos_validos = ['frente', 'verso'];

if (!in_array($tipo_documento, $tipos_validos)) {
    header('Location: ../UploadDocumentos/code.html?error=invalid_type');
    exit;
}

// Mapeamento de nomes de arquivo
$documento_map = [
    'frente' => 'frente_identidade',
    'verso' => 'verso_identidade'
];

// Processar o upload da imagem capturada
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['documento'])) {
    $upload_dir = __DIR__ . '/../../uploads/documentos/';
    
    // Criar diretório se não existir
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    
    $file = $_FILES['documento'];
    $filename = $documento_map[$tipo_documento] . '_' . uniqid() . '.jpg';
    $filepath = $upload_dir . $filename;
    
    // Validar se é uma imagem
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    
    $allowed_types = ['image/jpeg', 'image/png', 'image/webp'];
    
    if (in_array($mime_type, $allowed_types)) {
        if (move_uploaded_file($file['tmp_name'], $filepath)) {
            // Salvar caminho da imagem na sessão
            $_SESSION[$documento_map[$tipo_documento]] = $filename;
            
            // Redirecionar de volta para upload de documentos
            header('Location: ../UploadDocumentos/code.html?success=1');
            exit;
        }
    }
}
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
        #camera-feed {
            max-width: 100%;
            height: auto;
            border-radius: 0.75rem;
            border: 2px solid #d7c3ae;
        }
        #canvas-capture {
            display: none;
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
                <p class="text-primary font-headline font-bold uppercase tracking-widest text-sm mb-2">Upload de Mídia</p>
                <h2 class="text-6xl font-headline font-black tracking-tighter text-on-surface">
                    <?php echo $tipo_documento === 'frente' ? 'Frente da Identidade' : 'Verso da Identidade'; ?>
                </h2>
            </div>

            <!-- Estado: Instrução Inicial -->
            <div id="instruction-stage" class="mb-12">
                <div class="bg-surface-container-lowest rounded-xl border-dashed border-2 border-outline-variant/50 p-12 flex flex-col items-center justify-center text-center shadow-sm">
                    <div class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mb-8">
                        <span class="material-symbols-outlined text-5xl text-primary">
                            <?php echo $tipo_documento === 'frente' ? 'badge' : 'credit_card'; ?>
                        </span>
                    </div>
                    <h3 class="text-2xl font-headline font-black tracking-tight mb-4">
                        <?php echo $tipo_documento === 'frente' ? 'Escaneie a frente' : 'Escaneie o verso'; ?>
                    </h3>
                    <p class="text-on-surface-variant text-sm mb-8 max-w-md">
                        <?php 
                        if ($tipo_documento === 'frente') {
                            echo 'Posicione a câmera bem iluminada sobre a <strong>frente do seu documento de identidade</strong>. Procure deixar todo o documento visível no frame.';
                        } else {
                            echo 'Posicione a câmera bem iluminada sobre o <strong>verso do seu documento de identidade</strong>. Procure deixar todo o documento visível no frame.';
                        }
                        ?>
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

            <!-- Estado: Câmera Ativa -->
            <div id="camera-stage" class="hidden mb-12">
                <div class="bg-surface-container-lowest rounded-xl border border-outline-variant/50 p-6 flex flex-col items-center justify-center text-center shadow-sm">
                    <video id="camera-feed" class="w-full mb-6" autoplay playsinline></video>
                    
                    <div class="flex gap-4 flex-wrap justify-center w-full">
                        <button type="button" id="captureBtn" class="group relative overflow-hidden px-8 py-4 rounded-lg font-headline font-bold uppercase tracking-wide text-sm flex items-center gap-3 mx-auto text-black shadow-lg transition-all duration-300 hover:scale-105 active:scale-95"
                        style="background: linear-gradient(135deg, #f2b705, #f9a825); box-shadow: 0 8px 20px rgba(249,168,37,0.4);">
                            <span class="material-symbols-outlined text-lg">camera</span>
                            Capturar Foto
                            <span class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        </button>
                        
                        <button type="button" id="stopBtn" class="group relative overflow-hidden px-8 py-4 rounded-lg font-headline font-bold uppercase tracking-wide text-sm flex items-center gap-3 mx-auto text-white shadow-lg transition-all duration-300 hover:scale-105 active:scale-95 bg-on-surface-variant">
                            <span class="material-symbols-outlined text-lg">close</span>
                            Cancelar
                            <span class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Estado: Previsualização -->
            <div id="preview-stage" class="hidden mb-12">
                <div class="bg-surface-container-lowest rounded-xl border border-outline-variant/50 p-6 flex flex-col items-center justify-center text-center shadow-sm">
                    <h3 class="text-lg font-headline font-black tracking-tight mb-6">Prévia da Foto</h3>
                    <canvas id="canvas-capture" class="hidden"></canvas>
                    <img id="preview-image" class="w-full rounded-lg border-2 border-primary mb-6" alt="Prévia da foto"/>
                    
                    <div class="flex gap-4 flex-wrap justify-center w-full">
                        <button type="submit" id="submitBtn" class="group relative overflow-hidden px-8 py-4 rounded-lg font-headline font-bold uppercase tracking-wide text-sm flex items-center gap-3 mx-auto text-black shadow-lg transition-all duration-300 hover:scale-105 active:scale-95"
                        style="background: linear-gradient(135deg, #f2b705, #f9a825); box-shadow: 0 8px 20px rgba(249,168,37,0.4);">
                            <span class="material-symbols-outlined text-lg">check_circle</span>
                            Confirmar Foto
                            <span class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        </button>
                        
                        <button type="button" id="retakeBtn" class="group relative overflow-hidden px-8 py-4 rounded-lg font-headline font-bold uppercase tracking-wide text-sm flex items-center gap-3 mx-auto text-white shadow-lg transition-all duration-300 hover:scale-105 active:scale-95 bg-on-surface-variant">
                            <span class="material-symbols-outlined text-lg">refresh</span>
                            Tirar Outra
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

    <script>
        let stream = null;
        let capturedImage = null;

        const video = document.getElementById('camera-feed');
        const canvas = document.getElementById('canvas-capture');
        const ctx = canvas.getContext('2d');
        const previewImage = document.getElementById('preview-image');

        const startBtn = document.getElementById('startBtn');
        const captureBtn = document.getElementById('captureBtn');
        const stopBtn = document.getElementById('stopBtn');
        const retakeBtn = document.getElementById('retakeBtn');
        const submitBtn = document.getElementById('submitBtn');

        const instructionStage = document.getElementById('instruction-stage');
        const cameraStage = document.getElementById('camera-stage');
        const previewStage = document.getElementById('preview-stage');
        const faceForm = document.getElementById('faceForm');
        const fotoInput = document.getElementById('documentoInput');

        // Iniciar câmera
        startBtn.addEventListener('click', async () => {
            try {
                stream = await navigator.mediaDevices.getUserMedia({
                    video: { 
                        facingMode: 'user',
                        width: { ideal: 1280 },
                        height: { ideal: 720 }
                    }
                });

                video.srcObject = stream;
                instructionStage.classList.add('hidden');
                cameraStage.classList.remove('hidden');
            } catch (err) {
                alert('Não foi possível acessar a câmera. Verifique as permissões.');
                console.error(err);
            }
        });

        // Capturar foto
        captureBtn.addEventListener('click', () => {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            ctx.drawImage(video, 0, 0);

            capturedImage = canvas.toDataURL('image/jpeg', 0.95);
            previewImage.src = capturedImage;

            // Parar stream da câmera
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }

            cameraStage.classList.add('hidden');
            previewStage.classList.remove('hidden');
        });

        // Cancelar captura
        stopBtn.addEventListener('click', () => {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }
            cameraStage.classList.add('hidden');
            instructionStage.classList.remove('hidden');
            stream = null;
        });

        // Tirar outra foto
        retakeBtn.addEventListener('click', async () => {
            try {
                stream = await navigator.mediaDevices.getUserMedia({
                    video: { 
                        facingMode: 'user',
                        width: { ideal: 1280 },
                        height: { ideal: 720 }
                    }
                });

                video.srcObject = stream;
                previewStage.classList.add('hidden');
                cameraStage.classList.remove('hidden');
                capturedImage = null;
            } catch (err) {
                alert('Não foi possível acessar a câmera novamente.');
                console.error(err);
            }
        });

        // Enviar foto
        submitBtn.addEventListener('click', (e) => {
            e.preventDefault();

            if (!capturedImage) {
                alert('Nenhuma imagem foi capturada.');
                return;
            }

            // Converter base64 para blob e enviar
            fetch(capturedImage)
                .then(res => res.blob())
                .then(blob => {
                    const dataTransfer = new DataTransfer();
                    const file = new File([blob], 'foto_rosto.jpg', { type: 'image/jpeg' });
                    dataTransfer.items.add(file);
                    fotoInput.files = dataTransfer.files;

                    faceForm.submit();
                })
                .catch(err => {
                    alert('Erro ao processar a imagem.');
                    console.error(err);
                });
        });
    </script>
</body>
</html>
