<?php
/*
 * Exemplo de Uso do Gerador de QR Code WhatsApp
 * 
 * Este arquivo demonstra como usar os geradores de QR code
 * baseados no sistema MPWA Whatsapp Gateway.
 */

// Incluir os arquivos dos geradores
require_once 'qr_code_generator.php';
require_once 'simple_qr_generator.php';

// Configurações do seu sistema
$config = [
    'wa_url_server' => 'http://localhost:3000', // URL do seu servidor WhatsApp
    'device_token' => 'device_123456', // Token do dispositivo
];

echo "=== Exemplo de Uso - Gerador de QR Code WhatsApp ===\n\n";

// Exemplo 1: Usando a classe completa
echo "1. Usando a classe WhatsAppQRCodeGenerator:\n";
echo "--------------------------------------------\n";

$generator = new WhatsAppQRCodeGenerator($config['wa_url_server'], $config['device_token']);

// Verificar status do dispositivo
$isConnected = $generator->isDeviceConnected();
echo "Status do dispositivo: " . ($isConnected ? "Conectado" : "Desconectado") . "\n";

if (!$isConnected) {
    // Gerar QR code
    $result = $generator->generateQRCode();
    
    if (isset($result['success']) && $result['success'] === false) {
        echo "Erro: " . $result['error'] . "\n";
    } else {
        echo "QR Code gerado com sucesso!\n";
        echo "Resposta: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";
    }
} else {
    echo "Dispositivo já conectado. Não é necessário gerar QR code.\n";
}

echo "\n" . str_repeat("=", 50) . "\n\n";

// Exemplo 2: Usando as funções simples
echo "2. Usando as funções simples:\n";
echo "-----------------------------\n";

// Método 1: file_get_contents
echo "Tentando com file_get_contents...\n";
$result1 = generateWhatsAppQR($config['wa_url_server'], $config['device_token']);

if ($result1 !== false) {
    echo "Sucesso! Dados recebidos:\n";
    echo json_encode($result1, JSON_PRETTY_PRINT) . "\n";
} else {
    echo "Falha com file_get_contents.\n";
}

echo "\n";

// Método 2: cURL
echo "Tentando com cURL...\n";
$result2 = generateWhatsAppQRWithCurl($config['wa_url_server'], $config['device_token']);

if ($result2 !== false) {
    echo "Sucesso! Dados recebidos:\n";
    echo json_encode($result2, JSON_PRETTY_PRINT) . "\n";
} else {
    echo "Falha com cURL.\n";
}

echo "\n" . str_repeat("=", 50) . "\n\n";

// Exemplo 3: Função auxiliar
echo "3. Usando a função auxiliar:\n";
echo "----------------------------\n";

$result3 = generateWhatsAppQRCode($config['wa_url_server'], $config['device_token'], false);
echo "Resultado (file_get_contents): " . json_encode($result3, JSON_PRETTY_PRINT) . "\n\n";

$result4 = generateWhatsAppQRCode($config['wa_url_server'], $config['device_token'], true);
echo "Resultado (cURL): " . json_encode($result4, JSON_PRETTY_PRINT) . "\n";

echo "\n" . str_repeat("=", 50) . "\n\n";

// Exemplo 4: Tratamento de erros
echo "4. Exemplo de tratamento de erros:\n";
echo "----------------------------------\n";

function generateQRWithErrorHandling($waUrlServer, $deviceToken)
{
    try {
        $generator = new WhatsAppQRCodeGenerator($waUrlServer, $deviceToken);
        $result = $generator->generateQRCode();
        
        if (isset($result['success']) && $result['success'] === false) {
            throw new Exception($result['error']);
        }
        
        return [
            'success' => true,
            'data' => $result,
            'message' => 'QR code gerado com sucesso'
        ];
        
    } catch (Exception $e) {
        return [
            'success' => false,
            'error' => $e->getMessage(),
            'message' => 'Falha ao gerar QR code'
        ];
    }
}

$resultWithErrorHandling = generateQRWithErrorHandling($config['wa_url_server'], $config['device_token']);
echo "Resultado com tratamento de erros:\n";
echo json_encode($resultWithErrorHandling, JSON_PRETTY_PRINT) . "\n";

echo "\n" . str_repeat("=", 50) . "\n\n";

// Exemplo 5: Integração com banco de dados (simulado)
echo "5. Exemplo de integração com banco de dados:\n";
echo "--------------------------------------------\n";

class QRCodeService
{
    private $waUrlServer;
    
    public function __construct($waUrlServer)
    {
        $this->waUrlServer = $waUrlServer;
    }
    
    public function generateQRForDevice($deviceToken, $userId = null)
    {
        // Simular verificação no banco de dados
        $device = $this->getDeviceFromDatabase($deviceToken);
        
        if (!$device) {
            return [
                'success' => false,
                'error' => 'Dispositivo não encontrado',
                'message' => 'Token do dispositivo inválido'
            ];
        }
        
        if ($device['status'] === 'Connected') {
            return [
                'success' => false,
                'error' => 'Dispositivo já conectado',
                'message' => 'Não é necessário gerar QR code'
            ];
        }
        
        // Gerar QR code
        $generator = new WhatsAppQRCodeGenerator($this->waUrlServer, $deviceToken);
        $result = $generator->generateQRCode();
        
        if (isset($result['success']) && $result['success'] === false) {
            return [
                'success' => false,
                'error' => $result['error'],
                'message' => 'Falha ao gerar QR code'
            ];
        }
        
        // Simular atualização no banco de dados
        $this->updateDeviceStatus($deviceToken, 'Generating QR');
        
        return [
            'success' => true,
            'data' => $result,
            'message' => 'QR code gerado com sucesso',
            'device_id' => $device['id']
        ];
    }
    
    private function getDeviceFromDatabase($deviceToken)
    {
        // Simulação de consulta ao banco de dados
        return [
            'id' => 1,
            'token' => $deviceToken,
            'status' => 'Disconnected',
            'user_id' => 1
        ];
    }
    
    private function updateDeviceStatus($deviceToken, $status)
    {
        // Simulação de atualização no banco de dados
        echo "Atualizando status do dispositivo '$deviceToken' para '$status'\n";
    }
}

$qrService = new QRCodeService($config['wa_url_server']);
$result = $qrService->generateQRForDevice($config['device_token']);

echo "Resultado do serviço:\n";
echo json_encode($result, JSON_PRETTY_PRINT) . "\n";

echo "\n=== Fim dos Exemplos ===\n";
