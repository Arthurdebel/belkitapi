# Formulário de Teste de Mensagem com Botão

Este é um formulário independente que replica a funcionalidade de "Mensagem de Teste com Botão" do projeto Laravel original, permitindo criar e testar mensagens do WhatsApp com botões interativos.

## 🚀 Funcionalidades

- **Formulário completo** para criação de mensagens de teste
- **Botões dinâmicos** (máximo 3 por mensagem)
- **Tipos de botão suportados**:
  - 📞 **Ligar** - Inicia uma chamada telefônica
  - 🔗 **URL** - Abre um link na web
  - 📋 **Copiar** - Copia texto para a área de transferência
  - 💬 **Resposta** - Botão de resposta rápida
- **Preview de imagem** em tempo real
- **Validação completa** do formulário
- **Interface responsiva** e moderna
- **Múltiplos destinatários** (separados por "|")

## 📁 Arquivos

- `test-message-form.html` - Página principal do formulário
- `test-message-form.js` - Lógica JavaScript e funcionalidades
- `README.md` - Este arquivo de documentação

## 🛠️ Como Usar

### 1. Abrir o Formulário
Simplesmente abra o arquivo `test-message-form.html` em qualquer navegador moderno.

### 2. Preencher os Campos Obrigatórios
- **Remetente**: Número do WhatsApp que enviará a mensagem
- **Destinatários**: Números que receberão a mensagem (separados por "|")
- **Mensagem**: Texto principal da mensagem
- **Imagem**: Arquivo de imagem (JPG, PNG, GIF - máx. 5MB)

### 3. Adicionar Botões (Opcional)
1. Clique em "Adicionar Botão"
2. Selecione o tipo de botão
3. Digite o texto que aparecerá no botão
4. Preencha os campos adicionais conforme o tipo selecionado
5. Repita até 3 botões no total

### 4. Enviar
Clique em "Enviar Mensagem de Teste" para validar e processar o formulário.

## 🎨 Tipos de Botão

### 📞 Ligar
- **Campo adicional**: Número de telefone
- **Formato**: +55 (código do país) + DDD + número
- **Exemplo**: +5511999999999

### 🔗 URL
- **Campo adicional**: Link da web
- **Formato**: Deve incluir https:// ou http://
- **Exemplo**: https://exemplo.com

### 📋 Copiar
- **Campo adicional**: Texto para copiar
- **Uso**: Códigos, textos, informações
- **Exemplo**: Código de desconto: ABC123

### 💬 Resposta
- **Campo adicional**: Nenhum
- **Uso**: Botão de resposta rápida
- **Exemplo**: "Sim", "Não", "Mais informações"

## 🔧 Personalização

### Modificar Limite de Botões
No arquivo `test-message-form.js`, altere a propriedade:
```javascript
this.maxButtons = 3; // Altere para o número desejado
```

### Adicionar Novos Tipos de Botão
1. Adicione a opção no HTML do select
2. Implemente a lógica no método `handleButtonTypeChange()`
3. Adicione os campos adicionais necessários

### Personalizar Validações
Modifique o método `validateForm()` para adicionar suas próprias regras de validação.

## 🌐 Integração com Backend

Para integrar com um backend real (como o Laravel original):

1. **Modifique o método `handleFormSubmit()`** para enviar dados via AJAX
2. **Implemente endpoint** no backend para processar os dados
3. **Adicione autenticação** se necessário
4. **Configure CORS** se o frontend estiver em domínio diferente

### Exemplo de Integração AJAX:
```javascript
async handleFormSubmit(event) {
    event.preventDefault();
    
    if (!this.validateForm()) return;
    
    const formData = this.collectFormData();
    
    try {
        const response = await fetch('/api/send-test-message', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(formData)
        });
        
        const result = await response.json();
        this.showAlert('Mensagem enviada com sucesso!', 'success');
    } catch (error) {
        this.showAlert('Erro ao enviar mensagem: ' + error.message, 'danger');
    }
}
```

## 📱 Responsividade

O formulário é totalmente responsivo e funciona em:
- 💻 Desktop
- 📱 Tablets
- 📱 Smartphones

## 🎯 Compatibilidade

- ✅ Chrome 90+
- ✅ Firefox 88+
- ✅ Safari 14+
- ✅ Edge 90+

## 🔒 Segurança

- Validação client-side e server-side
- Sanitização de inputs
- Limite de tamanho de arquivo
- Validação de tipos de arquivo

## 📝 Notas Técnicas

- **Framework CSS**: Bootstrap 5.3.0
- **JavaScript**: Vanilla JS (sem dependências)
- **Ícones**: Font Awesome 6.0.0
- **Validação**: Bootstrap Validation + Custom

## 🐛 Solução de Problemas

### Imagem não carrega
- Verifique se o arquivo é uma imagem válida
- Confirme se o tamanho está abaixo de 5MB
- Teste com formatos JPG, PNG ou GIF

### Botões não aparecem
- Verifique se o JavaScript está carregado
- Confirme se não há erros no console do navegador
- Teste em um navegador moderno

### Validação não funciona
- Verifique se todos os campos obrigatórios estão preenchidos
- Confirme se os tipos de botão têm campos adicionais preenchidos
- Teste a validação campo por campo

## 📞 Suporte

Para dúvidas ou problemas:
1. Verifique este README
2. Consulte o console do navegador para erros
3. Teste em diferentes navegadores
4. Verifique a compatibilidade do JavaScript

---

**Desenvolvido com ❤️ para facilitar o teste de mensagens do WhatsApp**


