<?php
/*
 * Gerador de QR Code para WhatsApp
 * Baseado no sistema MPWA Whatsapp Gateway
 * 
 * Este arquivo implementa a geração de QR code para números de WhatsApp
 * seguindo o padrão encontrado no sistema original.
 */

class WhatsAppQRCodeGenerator
{
    private $waUrlServer;
    private $deviceToken;
    
    /**
     * Construtor da classe
     * 
     * @param string $waUrlServer URL do servidor WhatsApp (ex: http://localhost:3000)
     * @param string $deviceToken Token do dispositivo WhatsApp
     */
    public function __construct($waUrlServer, $deviceToken)
    {
        $this->waUrlServer = rtrim($waUrlServer, '/');
        $this->deviceToken = $deviceToken;
    }
    
    /**
     * Gera QR code para o dispositivo WhatsApp
     * 
     * @return array Resposta da API com dados do QR code
     * @throws Exception Se houver erro na requisição
     */
    public function generateQRCode()
    {
        try {
            // Validação dos parâmetros
            if (empty($this->waUrlServer)) {
                throw new Exception('URL do servidor WhatsApp não configurada');
            }
            
            if (empty($this->deviceToken)) {
                throw new Exception('Token do dispositivo não fornecido');
            }
            
            // Configuração da requisição
            $url = $this->waUrlServer . '/backend-generate-qr';
            $data = ['token' => $this->deviceToken];
            
            // Configuração do contexto HTTP
            $options = [
                'http' => [
                    'method' => 'POST',
                    'header' => 'Content-type: application/x-www-form-urlencoded',
                    'content' => http_build_query($data),
                    'timeout' => 30
                ],
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false
                ]
            ];
            
            $context = stream_context_create($options);
            
            // Realização da requisição
            $response = file_get_contents($url, false, $context);
            
            if ($response === false) {
                throw new Exception('Erro ao conectar com o servidor WhatsApp');
            }
            
            // Decodificação da resposta JSON
            $result = json_decode($response, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Resposta inválida do servidor: ' . json_last_error_msg());
            }
            
            return $result;
            
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'message' => 'Falha ao gerar QR code'
            ];
        }
    }
    
    /**
     * Verifica se o dispositivo está conectado
     * 
     * @return bool True se conectado, false caso contrário
     */
    public function isDeviceConnected()
    {
        try {
            $url = $this->waUrlServer . '/backend-check-connection';
            $data = ['token' => $this->deviceToken];
            
            $options = [
                'http' => [
                    'method' => 'POST',
                    'header' => 'Content-type: application/x-www-form-urlencoded',
                    'content' => http_build_query($data),
                    'timeout' => 10
                ],
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false
                ]
            ];
            
            $context = stream_context_create($options);
            $response = file_get_contents($url, false, $context);
            
            if ($response === false) {
                return false;
            }
            
            $result = json_decode($response, true);
            return isset($result['connected']) && $result['connected'] === true;
            
        } catch (Exception $e) {
            return false;
        }
    }
    
    /**
     * Gera QR code usando cURL (método alternativo)
     * 
     * @return array Resposta da API
     */
    public function generateQRCodeWithCurl()
    {
        try {
            $url = $this->waUrlServer . '/backend-generate-qr';
            $data = ['token' => $this->deviceToken];
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/x-www-form-urlencoded'
            ]);
            
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            curl_close($ch);
            
            if ($error) {
                throw new Exception('Erro cURL: ' . $error);
            }
            
            if ($httpCode !== 200) {
                throw new Exception('HTTP Error: ' . $httpCode);
            }
            
            $result = json_decode($response, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Resposta inválida: ' . json_last_error_msg());
            }
            
            return $result;
            
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'message' => 'Falha ao gerar QR code'
            ];
        }
    }
}

/**
 * Função auxiliar para gerar QR code rapidamente
 * 
 * @param string $waUrlServer URL do servidor WhatsApp
 * @param string $deviceToken Token do dispositivo
 * @param bool $useCurl Se deve usar cURL (true) ou file_get_contents (false)
 * @return array Resultado da geração
 */
function generateWhatsAppQRCode($waUrlServer, $deviceToken, $useCurl = false)
{
    $generator = new WhatsAppQRCodeGenerator($waUrlServer, $deviceToken);
    
    if ($useCurl) {
        return $generator->generateQRCodeWithCurl();
    } else {
        return $generator->generateQRCode();
    }
}

/**
 * Exemplo de uso da classe
 */
if (basename(__FILE__) == basename($_SERVER['SCRIPT_NAME'])) {
    // Configurações (substitua pelos seus valores)
    $waUrlServer = 'http://localhost:3000'; // URL do seu servidor WhatsApp
    $deviceToken = 'seu_token_aqui'; // Token do dispositivo
    
    echo "=== Gerador de QR Code WhatsApp ===\n\n";
    
    // Verificar se o dispositivo está conectado
    $generator = new WhatsAppQRCodeGenerator($waUrlServer, $deviceToken);
    $isConnected = $generator->isDeviceConnected();
    
    echo "Status do dispositivo: " . ($isConnected ? "Conectado" : "Desconectado") . "\n\n";
    
    if (!$isConnected) {
        echo "Gerando QR code...\n";
        
        // Gerar QR code
        $result = $generator->generateQRCode();
        
        if (isset($result['success']) && $result['success'] === false) {
            echo "Erro: " . $result['error'] . "\n";
        } else {
            echo "QR Code gerado com sucesso!\n";
            echo "Dados recebidos: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";
        }
    } else {
        echo "Dispositivo já está conectado. Não é necessário gerar QR code.\n";
    }
}
