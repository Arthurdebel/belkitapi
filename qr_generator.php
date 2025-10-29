<?php
/**
 * Sistema de Geração de QR Code em Tempo Real para WhatsApp
 * Baseado na implementação do projeto WHT
 */

class WhatsAppQRGenerator {
    private $apiUrl;
    private $token;
    private $socket;
    private $isConnected = false;
    
    public function __construct($apiUrl = 'https://candyce-overjudicious-persuasively.ngrok-free.app:3100') {
        $this->apiUrl = rtrim($apiUrl, '/');
        $this->initializeSocket();
    }
    
    /**
     * Inicializa a conexão WebSocket
     */
    private function initializeSocket() {
        // Simulação de WebSocket - em produção use ReactPHP ou similar
        $this->socket = null;
    }
    
    /**
     * Gera um token único para a instância
     */
    public function generateToken() {
        return uniqid('wa_', true);
    }
    
    /**
     * Conecta ao WhatsApp e gera QR Code
     */
    public function connectAndGenerateQR($token = null) {
        if (!$token) {
            $token = $this->generateToken();
        }
        
        $this->token = $token;
        
        // Fazer requisição para gerar QR Code
        $response = $this->makeRequest('/backend-generate-qr', [
            'token' => $token
        ]);
        
        return $this->processQRResponse($response);
    }
    
    /**
     * Processa a resposta do QR Code
     */
    private function processQRResponse($response) {
        if (!$response) {
            return [
                'status' => 'error',
                'message' => 'Erro ao conectar com o servidor',
                'qrcode' => null
            ];
        }
        
        $data = json_decode($response, true);
        
        if (!$data) {
            return [
                'status' => 'error',
                'message' => 'Resposta inválida do servidor',
                'qrcode' => null
            ];
        }
        
        return [
            'status' => $data['status'],
            'message' => $data['message'],
            'qrcode' => $data['qrcode'] ?? null,
            'token' => $this->token
        ];
    }
    
    /**
     * Verifica o status da conexão
     */
    public function checkConnectionStatus($token) {
        $response = $this->makeRequest('/backend-generate-qr', [
            'token' => $token
        ]);
        
        return $this->processQRResponse($response);
    }
    
    /**
     * Faz requisição HTTP para a API
     */
    private function makeRequest($endpoint, $data = []) {
        $url = $this->apiUrl . $endpoint;
        
        $options = [
            'http' => [
                'header' => "Content-type: application/json\r\n",
                'method' => 'POST',
                'content' => json_encode($data),
                'timeout' => 30
            ]
        ];
        
        $context = stream_context_create($options);
        $result = @file_get_contents($url, false, $context);
        
        if ($result === false) {
            error_log("Erro ao fazer requisição para: $url");
            return false;
        }
        
        return $result;
    }
    
    /**
     * Gera QR Code usando biblioteca local (fallback)
     */
    public function generateLocalQR($data) {
        // Requer biblioteca phpqrcode ou similar
        if (class_exists('QRcode')) {
            ob_start();
            QRcode::png($data, null, QR_ECLEVEL_L, 4, 2);
            $image = ob_get_contents();
            ob_end_clean();
            
            return 'data:image/png;base64,' . base64_encode($image);
        }
        
        // Fallback: usar API externa
        return $this->generateExternalQR($data);
    }
    
    /**
     * Gera QR Code usando API externa
     */
    private function generateExternalQR($data) {
        $encodedData = urlencode($data);
        $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=" . $encodedData;
        
        $image = @file_get_contents($qrUrl);
        if ($image) {
            return 'data:image/png;base64,' . base64_encode($image);
        }
        
        return null;
    }
    
    /**
     * Monitora conexão em tempo real (simulação)
     */
    public function monitorConnection($token, $callback) {
        $maxAttempts = 60; // 5 minutos
        $attempt = 0;
        
        while ($attempt < $maxAttempts) {
            $status = $this->checkConnectionStatus($token);
            
            if ($callback && is_callable($callback)) {
                $callback($status);
            }
            
            if ($status['status'] === true) {
                $this->isConnected = true;
                return $status;
            }
            
            if ($status['status'] === false) {
                return $status;
            }
            
            sleep(5); // Aguarda 5 segundos
            $attempt++;
        }
        
        return [
            'status' => 'timeout',
            'message' => 'Timeout na conexão',
            'qrcode' => null
        ];
    }
    
    /**
     * Desconecta dispositivo
     */
    public function disconnect($token) {
        $response = $this->makeRequest('/backend-logout', [
            'token' => $token
        ]);
        
        $data = json_decode($response, true);
        return $data ?: ['status' => false, 'message' => 'Erro ao desconectar'];
    }
    
    /**
     * Verifica se está conectado
     */
    public function isConnected() {
        return $this->isConnected;
    }
}

/**
 * Classe para interface web
 */
class QRWebInterface {
    private $qrGenerator;
    
    public function __construct($apiUrl = 'http://localhost:3000') {
        $this->qrGenerator = new WhatsAppQRGenerator($apiUrl);
    }
    
    /**
     * Renderiza página principal
     */
    public function renderPage() {
        ?>
        <!DOCTYPE html>
        <html lang="pt-BR">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>WhatsApp QR Code Generator</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 20px;
                    background-color: #f5f5f5;
                }
                .container {
                    background: white;
                    padding: 30px;
                    border-radius: 10px;
                    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                    text-align: center;
                }
                .qr-container {
                    margin: 20px 0;
                    padding: 20px;
                    border: 2px dashed #ddd;
                    border-radius: 10px;
                }
                .qr-image {
                    max-width: 300px;
                    height: auto;
                }
                .status {
                    padding: 10px;
                    margin: 10px 0;
                    border-radius: 5px;
                    font-weight: bold;
                }
                .status.connected { background-color: #d4edda; color: #155724; }
                .status.qrcode { background-color: #fff3cd; color: #856404; }
                .status.error { background-color: #f8d7da; color: #721c24; }
                .status.processing { background-color: #d1ecf1; color: #0c5460; }
                .btn {
                    background-color: #007bff;
                    color: white;
                    padding: 10px 20px;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    margin: 5px;
                }
                .btn:hover { background-color: #0056b3; }
                .btn:disabled { background-color: #6c757d; cursor: not-allowed; }
                .hidden { display: none; }
            </style>
        </head>
        <body>
            <div class="container">
                <h1>🔗 Conectar WhatsApp</h1>
                <div id="status" class="status processing">Inicializando...</div>
                
                <div id="qr-container" class="qr-container hidden">
                    <h3>Escaneie o QR Code com seu WhatsApp</h3>
                    <img id="qr-image" class="qr-image" alt="QR Code">
                    <p id="qr-message">Aguarde...</p>
                </div>
                
                <div id="controls">
                    <button id="connect-btn" class="btn" onclick="connect()">Conectar</button>
                    <button id="disconnect-btn" class="btn" onclick="disconnect()" disabled>Desconectar</button>
                    <button id="refresh-btn" class="btn" onclick="refresh()">Atualizar</button>
                </div>
                
                <div id="logs" style="margin-top: 20px; text-align: left;">
                    <h4>Logs:</h4>
                    <div id="log-content" style="background: #f8f9fa; padding: 10px; border-radius: 5px; max-height: 200px; overflow-y: auto;"></div>
                </div>
            </div>

            <script>
                let currentToken = null;
                let monitoring = false;
                
                function log(message) {
                    const logContent = document.getElementById('log-content');
                    const timestamp = new Date().toLocaleTimeString();
                    logContent.innerHTML += `[${timestamp}] ${message}<br>`;
                    logContent.scrollTop = logContent.scrollHeight;
                }
                
                function updateStatus(status, message, qrcode = null) {
                    const statusEl = document.getElementById('status');
                    const qrContainer = document.getElementById('qr-container');
                    const qrImage = document.getElementById('qr-image');
                    const qrMessage = document.getElementById('qr-message');
                    const connectBtn = document.getElementById('connect-btn');
                    const disconnectBtn = document.getElementById('disconnect-btn');
                    
                    statusEl.className = `status ${status}`;
                    statusEl.textContent = message;
                    
                    if (qrcode) {
                        qrContainer.classList.remove('hidden');
                        qrImage.src = qrcode;
                        qrMessage.textContent = 'Escaneie este QR Code com seu WhatsApp';
                        connectBtn.disabled = true;
                        disconnectBtn.disabled = false;
                    } else {
                        qrContainer.classList.add('hidden');
                    }
                    
                    if (status === 'connected') {
                        connectBtn.disabled = true;
                        disconnectBtn.disabled = false;
                    } else if (status === 'error' || status === 'timeout') {
                        connectBtn.disabled = false;
                        disconnectBtn.disabled = true;
                    }
                }
                
                async function connect() {
                    log('Iniciando conexão...');
                    updateStatus('processing', 'Conectando...');
                    
                    try {
                        const response = await fetch('', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                action: 'connect'
                            })
                        });
                        
                        const data = await response.json();
                        currentToken = data.token;
                        
                        if (data.qrcode) {
                            updateStatus('qrcode', data.message, data.qrcode);
                            log('QR Code gerado, aguardando escaneamento...');
                            startMonitoring();
                        } else {
                            updateStatus(data.status, data.message);
                            log(`Status: ${data.message}`);
                        }
                    } catch (error) {
                        log(`Erro: ${error.message}`);
                        updateStatus('error', 'Erro ao conectar');
                    }
                }
                
                async function disconnect() {
                    if (!currentToken) return;
                    
                    log('Desconectando...');
                    updateStatus('processing', 'Desconectando...');
                    
                    try {
                        const response = await fetch('', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                action: 'disconnect',
                                token: currentToken
                            })
                        });
                        
                        const data = await response.json();
                        log(`Desconectado: ${data.message}`);
                        updateStatus('disconnected', 'Desconectado');
                        currentToken = null;
                        monitoring = false;
                    } catch (error) {
                        log(`Erro ao desconectar: ${error.message}`);
                    }
                }
                
                async function refresh() {
                    if (!currentToken) return;
                    
                    log('Verificando status...');
                    try {
                        const response = await fetch('', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                action: 'status',
                                token: currentToken
                            })
                        });
                        
                        const data = await response.json();
                        updateStatus(data.status, data.message, data.qrcode);
                        log(`Status atualizado: ${data.message}`);
                    } catch (error) {
                        log(`Erro ao verificar status: ${error.message}`);
                    }
                }
                
                function startMonitoring() {
                    if (monitoring) return;
                    monitoring = true;
                    
                    const monitor = setInterval(async () => {
                        if (!monitoring) {
                            clearInterval(monitor);
                            return;
                        }
                        
                        try {
                            const response = await fetch('', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({
                                    action: 'status',
                                    token: currentToken
                                })
                            });
                            
                            const data = await response.json();
                            
                            if (data.status === 'connected') {
                                updateStatus('connected', 'Conectado com sucesso!');
                                log('WhatsApp conectado com sucesso!');
                                monitoring = false;
                                clearInterval(monitor);
                            } else if (data.status === 'error' || data.status === 'timeout') {
                                updateStatus(data.status, data.message);
                                log(`Conexão falhou: ${data.message}`);
                                monitoring = false;
                                clearInterval(monitor);
                            } else if (data.qrcode) {
                                updateStatus('qrcode', data.message, data.qrcode);
                                log('QR Code atualizado');
                            }
                        } catch (error) {
                            log(`Erro no monitoramento: ${error.message}`);
                        }
                    }, 3000); // Verifica a cada 3 segundos
                }
                
                // Inicialização
                log('Sistema inicializado');
                updateStatus('ready', 'Pronto para conectar');
            </script>
        </body>
        </html>
        <?php
    }
    
    /**
     * Processa requisições AJAX
     */
    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }
        
        $input = json_decode(file_get_contents('php://input'), true);
        $action = $input['action'] ?? '';
        
        header('Content-Type: application/json');
        
        switch ($action) {
            case 'connect':
                $result = $this->qrGenerator->connectAndGenerateQR();
                echo json_encode($result);
                break;
                
            case 'status':
                $token = $input['token'] ?? null;
                if (!$token) {
                    echo json_encode(['status' => 'error', 'message' => 'Token necessário']);
                    break;
                }
                $result = $this->qrGenerator->checkConnectionStatus($token);
                echo json_encode($result);
                break;
                
            case 'disconnect':
                $token = $input['token'] ?? null;
                if (!$token) {
                    echo json_encode(['status' => 'error', 'message' => 'Token necessário']);
                    break;
                }
                $result = $this->qrGenerator->disconnect($token);
                echo json_encode($result);
                break;
                
            default:
                echo json_encode(['status' => 'error', 'message' => 'Ação inválida']);
        }
    }
}

// Uso principal
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $interface = new QRWebInterface();
    $interface->handleRequest();
} else {
    $interface = new QRWebInterface();
    $interface->renderPage();
}
?>

