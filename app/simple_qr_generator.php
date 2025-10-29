<?php
/*
 * Gerador Simples de QR Code para WhatsApp
 * Versão simplificada baseada no sistema MPWA
 */

/**
 * Gera QR code para dispositivo WhatsApp
 * 
 * @param string $waUrlServer URL do servidor WhatsApp (ex: http://localhost:3000)
 * @param string $deviceToken Token do dispositivo
 * @return array|false Dados do QR code ou false em caso de erro
 */
function generateWhatsAppQR($waUrlServer, $deviceToken)
{
    // Validação dos parâmetros
    if (empty($waUrlServer) || empty($deviceToken)) {
        return false;
    }
    
    // URL do endpoint
    $url = rtrim($waUrlServer, '/') . '/backend-generate-qr';
    
    // Dados para envio
    $postData = http_build_query(['token' => $deviceToken]);
    
    // Configuração do contexto HTTP
    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded',
            'content' => $postData,
            'timeout' => 30
        ],
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false
        ]
    ]);
    
    // Realizar requisição
    $response = @file_get_contents($url, false, $context);
    
    if ($response === false) {
        return false;
    }
    
    // Decodificar JSON
    $result = json_decode($response, true);
    
    return $result;
}

/**
 * Gera QR code usando cURL (mais confiável)
 * 
 * @param string $waUrlServer URL do servidor WhatsApp
 * @param string $deviceToken Token do dispositivo
 * @return array|false Dados do QR code ou false em caso de erro
 */
function generateWhatsAppQRWithCurl($waUrlServer, $deviceToken)
{
    // Validação dos parâmetros
    if (empty($waUrlServer) || empty($deviceToken)) {
        return false;
    }
    
    // URL do endpoint
    $url = rtrim($waUrlServer, '/') . '/backend-generate-qr';
    
    // Dados para envio
    $postData = http_build_query(['token' => $deviceToken]);
    
    // Inicializar cURL
    $ch = curl_init();
    
    // Configurações do cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded'
    ]);
    
    // Executar requisição
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    
    curl_close($ch);
    
    // Verificar erros
    if ($error || $httpCode !== 200) {
        return false;
    }
    
    // Decodificar JSON
    $result = json_decode($response, true);
    
    return $result;
}

/**
 * Exemplo de uso
 */
if (basename(__FILE__) == basename($_SERVER['SCRIPT_NAME'])) {
    // Configurações
    $waUrlServer = 'http://localhost:3000'; // Substitua pela URL do seu servidor
    $deviceToken = 'seu_token_aqui'; // Substitua pelo token do dispositivo
    
    echo "=== Gerador Simples de QR Code WhatsApp ===\n\n";
    
    // Tentar gerar QR code com file_get_contents
    echo "Tentando gerar QR code com file_get_contents...\n";
    $result1 = generateWhatsAppQR($waUrlServer, $deviceToken);
    
    if ($result1 !== false) {
        echo "Sucesso! Dados recebidos:\n";
        echo json_encode($result1, JSON_PRETTY_PRINT) . "\n\n";
    } else {
        echo "Falha com file_get_contents. Tentando com cURL...\n";
        
        // Tentar com cURL
        $result2 = generateWhatsAppQRWithCurl($waUrlServer, $deviceToken);
        
        if ($result2 !== false) {
            echo "Sucesso com cURL! Dados recebidos:\n";
            echo json_encode($result2, JSON_PRETTY_PRINT) . "\n";
        } else {
            echo "Falha em ambos os métodos. Verifique:\n";
            echo "- URL do servidor WhatsApp\n";
            echo "- Token do dispositivo\n";
            echo "- Conectividade com o servidor\n";
        }
    }
}
