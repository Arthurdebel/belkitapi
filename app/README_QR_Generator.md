# Gerador de QR Code WhatsApp

Este conjunto de arquivos implementa a geração de QR code para dispositivos WhatsApp, baseado no sistema MPWA Whatsapp Gateway.

## Arquivos Incluídos

### 1. `qr_code_generator.php`
Classe completa para geração de QR code com recursos avançados:
- Classe `WhatsAppQRCodeGenerator` com métodos para gerar QR code
- Verificação de status do dispositivo
- Suporte a cURL e file_get_contents
- Tratamento de erros robusto

### 2. `simple_qr_generator.php`
Versão simplificada com funções diretas:
- `generateWhatsAppQR()` - Usa file_get_contents
- `generateWhatsAppQRWithCurl()` - Usa cURL
- Implementação mais leve e direta

### 3. `exemplo_uso_qr.php`
Exemplos práticos de uso:
- Demonstração de todos os métodos
- Tratamento de erros
- Integração com banco de dados (simulado)
- Casos de uso reais

## Como Funciona

O sistema funciona fazendo uma requisição HTTP POST para o servidor WhatsApp com o token do dispositivo:

```php
POST {WA_URL_SERVER}/backend-generate-qr
Content-Type: application/x-www-form-urlencoded

token={DEVICE_TOKEN}
```

## Configuração

### Variáveis Necessárias

```php
$waUrlServer = 'http://localhost:3000'; // URL do seu servidor WhatsApp
$deviceToken = 'seu_token_aqui'; // Token do dispositivo
```

### Dependências

- PHP 7.0 ou superior
- Extensão cURL (recomendado)
- Acesso ao servidor WhatsApp

## Uso Básico

### Usando a Classe Completa

```php
<?php
require_once 'qr_code_generator.php';

$generator = new WhatsAppQRCodeGenerator('http://localhost:3000', 'device_token');

// Verificar se está conectado
if (!$generator->isDeviceConnected()) {
    // Gerar QR code
    $result = $generator->generateQRCode();
    
    if (isset($result['success']) && $result['success'] !== false) {
        echo "QR Code gerado: " . json_encode($result);
    } else {
        echo "Erro: " . $result['error'];
    }
}
```

### Usando as Funções Simples

```php
<?php
require_once 'simple_qr_generator.php';

// Método 1: file_get_contents
$result = generateWhatsAppQR('http://localhost:3000', 'device_token');

// Método 2: cURL (mais confiável)
$result = generateWhatsAppQRWithCurl('http://localhost:3000', 'device_token');

if ($result !== false) {
    echo "Sucesso: " . json_encode($result);
} else {
    echo "Falha na geração";
}
```

### Usando a Função Auxiliar

```php
<?php
require_once 'qr_code_generator.php';

// Com file_get_contents
$result = generateWhatsAppQRCode('http://localhost:3000', 'device_token', false);

// Com cURL
$result = generateWhatsAppQRCode('http://localhost:3000', 'device_token', true);
```

## Estrutura da Resposta

A resposta típica do servidor WhatsApp contém:

```json
{
    "success": true,
    "qr": "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAA...",
    "message": "QR code gerado com sucesso"
}
```

## Tratamento de Erros

### Erros Comuns

1. **Dispositivo já conectado**
   ```json
   {
       "success": false,
       "error": "Device already connected!",
       "message": "Dispositivo já conectado"
   }
   ```

2. **Token inválido**
   ```json
   {
       "success": false,
       "error": "Invalid token",
       "message": "Token do dispositivo inválido"
   }
   ```

3. **Servidor indisponível**
   ```json
   {
       "success": false,
       "error": "Connection failed",
       "message": "Falha ao conectar com o servidor"
   }
   ```

## Integração com Laravel

Para integrar com o sistema Laravel existente:

```php
<?php
// Em um Controller Laravel
use App\Models\Device;

class QRCodeController extends Controller
{
    public function generateQR($deviceId)
    {
        $device = Device::find($deviceId);
        
        if (!$device) {
            return response()->json(['error' => 'Device not found'], 404);
        }
        
        if ($device->status === 'Connected') {
            return response()->json(['error' => 'Device already connected'], 400);
        }
        
        $generator = new WhatsAppQRCodeGenerator(
            env('WA_URL_SERVER'),
            $device->body
        );
        
        $result = $generator->generateQRCode();
        
        return response()->json($result);
    }
}
```

## Testando

Execute o arquivo de exemplo para testar:

```bash
php exemplo_uso_qr.php
```

Ou teste individualmente:

```bash
php qr_code_generator.php
php simple_qr_generator.php
```

## Notas Importantes

1. **Segurança**: Nunca exponha tokens de dispositivo em logs ou mensagens de erro
2. **Timeout**: Configure timeouts apropriados para requisições
3. **SSL**: O código desabilita verificação SSL para desenvolvimento - configure adequadamente em produção
4. **Rate Limiting**: Implemente controle de taxa para evitar spam de requisições

## Troubleshooting

### Problemas Comuns

1. **"Connection failed"**
   - Verifique se o servidor WhatsApp está rodando
   - Confirme a URL do servidor
   - Teste conectividade de rede

2. **"Invalid token"**
   - Verifique se o token do dispositivo está correto
   - Confirme se o dispositivo existe no sistema

3. **"Device already connected"**
   - O dispositivo já está conectado
   - Não é necessário gerar novo QR code

4. **Timeout errors**
   - Aumente o valor de timeout
   - Verifique performance do servidor

## Licença

Baseado no sistema MPWA Whatsapp Gateway - Multi Device
Licenciado sob CC BY-NC-ND 4.0 License
