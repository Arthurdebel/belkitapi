/**
 * Formulário de Teste de Mensagem com Botão
 * Funcionalidade JavaScript para gerenciar botões dinâmicos e validação
 */

class MessageTestForm {
    constructor() {
        this.maxButtons = 3;
        this.buttonCount = 0;
        this.init();
    }

    init() {
        this.bindEvents();
        this.setupImagePreview();
        this.setupFormValidation();
    }

    bindEvents() {
        // Adicionar botão
        document.getElementById('addButton').addEventListener('click', () => {
            this.addButton();
        });

        // Limpar imagem
        document.getElementById('clearImage').addEventListener('click', () => {
            this.clearImage();
        });

        // Preview da imagem
        document.getElementById('image').addEventListener('change', (e) => {
            this.handleImagePreview(e);
        });

        // Envio do formulário
        document.getElementById('messageForm').addEventListener('submit', (e) => {
            this.handleFormSubmit(e);
        });

        // Event delegation para botões de remoção
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('removeButton')) {
                this.removeButton(e.target.dataset.index);
            }
        });

        // Event delegation para mudança de tipo de botão
        document.addEventListener('change', (e) => {
            if (e.target.classList.contains('buttonType')) {
                this.handleButtonTypeChange(e.target);
            }
        });
    }

    addButton() {
        if (this.buttonCount >= this.maxButtons) {
            this.showAlert('Máximo de 3 botões permitidos!', 'warning');
            return;
        }

        this.buttonCount++;
        const buttonHtml = this.createButtonHtml(this.buttonCount);
        
        document.getElementById('buttonsArea').insertAdjacentHTML('beforeend', buttonHtml);
        
        // Scroll suave para o novo botão
        const newButton = document.getElementById(`buttonGroup${this.buttonCount}`);
        newButton.scrollIntoView({ behavior: 'smooth', block: 'nearest' });

        this.showAlert(`Botão ${this.buttonCount} adicionado!`, 'success');
    }

    createButtonHtml(index) {
        return `
            <div class="button-group" id="buttonGroup${index}">
                <h6>
                    <i class="fas fa-square me-1"></i>
                    Botão ${index}
                </h6>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="buttonType${index}" class="form-label">Tipo do Botão *</label>
                        <select name="button[${index}][type]" class="form-control buttonType" 
                                id="buttonType${index}" data-index="${index}" required>
                            <option value="">Selecione o tipo...</option>
                            <option value="reply">Resposta</option>
                            <option value="call">Ligar</option>
                            <option value="url">URL</option>
                            <option value="copy">Copiar</option>
                        </select>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="buttonDisplayText${index}" class="form-label">Texto do Botão *</label>
                        <input type="text" name="button[${index}][displayText]" 
                               class="form-control" id="buttonDisplayText${index}" 
                               placeholder="Ex: Clique aqui" required>
                    </div>
                </div>

                <div class="additionalFields" id="additionalFields${index}">
                    <!-- Campos adicionais serão inseridos aqui baseado no tipo -->
                </div>

                <div class="text-end">
                    <button type="button" class="btn btn-remove removeButton" 
                            data-index="${index}">
                        <i class="fas fa-trash me-1"></i>
                        Remover Botão
                    </button>
                </div>
            </div>
        `;
    }

    handleButtonTypeChange(selectElement) {
        const index = selectElement.dataset.index;
        const selectedType = selectElement.value;
        const additionalFields = document.getElementById(`additionalFields${index}`);
        
        // Limpar campos existentes
        additionalFields.innerHTML = '';

        if (selectedType === 'call') {
            additionalFields.innerHTML = `
                <div class="row">
                    <div class="col-12">
                        <label for="phoneNumber${index}" class="form-label">Número de Telefone *</label>
                        <input type="tel" name="button[${index}][phoneNumber]" 
                               class="form-control" id="phoneNumber${index}" 
                               placeholder="Ex: +5511999999999" required>
                        <div class="form-text">Formato: +55 (código do país) + DDD + número</div>
                    </div>
                </div>
            `;
        } else if (selectedType === 'url') {
            additionalFields.innerHTML = `
                <div class="row">
                    <div class="col-12">
                        <label for="url${index}" class="form-label">URL *</label>
                        <input type="url" name="button[${index}][url]" 
                               class="form-control" id="url${index}" 
                               placeholder="Ex: https://exemplo.com" required>
                        <div class="form-text">Inclua https:// ou http://</div>
                    </div>
                </div>
            `;
        } else if (selectedType === 'copy') {
            additionalFields.innerHTML = `
                <div class="row">
                    <div class="col-12">
                        <label for="copyText${index}" class="form-label">Texto para Copiar *</label>
                        <input type="text" name="button[${index}][copyCode]" 
                               class="form-control" id="copyText${index}" 
                               placeholder="Ex: Código de desconto: ABC123" required>
                        <div class="form-text">Texto que será copiado quando o botão for clicado</div>
                    </div>
                </div>
            `;
        }
    }

    removeButton(index) {
        const buttonGroup = document.getElementById(`buttonGroup${index}`);
        if (buttonGroup) {
            buttonGroup.remove();
            this.buttonCount--;
            this.showAlert(`Botão ${index} removido!`, 'info');
        }
    }

    setupImagePreview() {
        // Implementação do preview de imagem
    }

    handleImagePreview(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('imagePreview');
        
        if (file) {
            // Validar tamanho (5MB)
            if (file.size > 5 * 1024 * 1024) {
                this.showAlert('A imagem deve ter no máximo 5MB!', 'danger');
                event.target.value = '';
                return;
            }

            // Validar tipo
            if (!file.type.startsWith('image/')) {
                this.showAlert('Por favor, selecione apenas arquivos de imagem!', 'danger');
                event.target.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = (e) => {
                preview.innerHTML = `
                    <img src="${e.target.result}" class="image-preview" alt="Preview da imagem">
                `;
            };
            reader.readAsDataURL(file);
        }
    }

    clearImage() {
        document.getElementById('image').value = '';
        document.getElementById('imagePreview').innerHTML = '';
    }

    setupFormValidation() {
        // Bootstrap validation
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', (event) => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            });
        });
    }

    handleFormSubmit(event) {
        event.preventDefault();
        
        if (!this.validateForm()) {
            this.showAlert('Por favor, corrija os erros no formulário!', 'danger');
            return;
        }

        const formData = this.collectFormData();
        this.showAlert('Formulário validado com sucesso! Dados coletados:', 'success');
        console.log('Dados do formulário:', formData);
        
        // Aqui você pode implementar o envio real dos dados
        this.simulateSendMessage(formData);
    }

    validateForm() {
        let isValid = true;
        
        // Validar campos obrigatórios
        const requiredFields = ['sender', 'receivers', 'message', 'image'];
        requiredFields.forEach(fieldName => {
            const field = document.getElementById(fieldName);
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });

        // Validar botões
        const buttons = document.querySelectorAll('.button-group');
        buttons.forEach(button => {
            const typeSelect = button.querySelector('.buttonType');
            const displayText = button.querySelector('input[name*="[displayText]"]');
            
            if (!typeSelect.value || !displayText.value.trim()) {
                typeSelect.classList.add('is-invalid');
                displayText.classList.add('is-invalid');
                isValid = false;
            } else {
                typeSelect.classList.remove('is-invalid');
                displayText.classList.remove('is-invalid');
            }
        });

        return isValid;
    }

    collectFormData() {
        const formData = {
            sender: document.getElementById('sender').value,
            receivers: document.getElementById('receivers').value.split('|').map(r => r.trim()),
            message: document.getElementById('message').value,
            footer: document.getElementById('footer').value,
            image: document.getElementById('image').files[0],
            buttons: []
        };

        // Coletar dados dos botões
        const buttons = document.querySelectorAll('.button-group');
        buttons.forEach((button, index) => {
            const buttonData = {
                type: button.querySelector('.buttonType').value,
                displayText: button.querySelector('input[name*="[displayText]"]').value
            };

            // Adicionar campos específicos do tipo
            const additionalFields = button.querySelector('.additionalFields');
            if (additionalFields) {
                const phoneField = additionalFields.querySelector('input[name*="[phoneNumber]"]');
                const urlField = additionalFields.querySelector('input[name*="[url]"]');
                const copyField = additionalFields.querySelector('input[name*="[copyCode]"]');

                if (phoneField) buttonData.phoneNumber = phoneField.value;
                if (urlField) buttonData.url = urlField.value;
                if (copyField) buttonData.copyCode = copyField.value;
            }

            formData.buttons.push(buttonData);
        });

        return formData;
    }

    simulateSendMessage(formData) {
        this.showAlert('Simulando envio da mensagem...', 'info');
        
        // Simular delay de envio
        setTimeout(() => {
            this.showAlert(`
                <strong>Mensagem enviada com sucesso!</strong><br>
                <small>Remetente: ${formData.sender}</small><br>
                <small>Destinatários: ${formData.receivers.length}</small><br>
                <small>Botões: ${formData.buttons.length}</small>
            `, 'success');
        }, 2000);
    }

    showAlert(message, type = 'info') {
        const alertContainer = document.getElementById('alertContainer');
        const alertId = 'alert-' + Date.now();
        
        const alertHtml = `
            <div id="${alertId}" class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        
        alertContainer.insertAdjacentHTML('beforeend', alertHtml);
        
        // Auto-remove após 5 segundos para alerts de sucesso/info
        if (['success', 'info'].includes(type)) {
            setTimeout(() => {
                const alert = document.getElementById(alertId);
                if (alert) {
                    alert.remove();
                }
            }, 5000);
        }
    }
}

// Inicializar quando o DOM estiver carregado
document.addEventListener('DOMContentLoaded', () => {
    new MessageTestForm();
});

// Utilitários adicionais
window.MessageTestForm = MessageTestForm;


