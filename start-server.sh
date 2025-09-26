#!/bin/bash

# WhatsApp Server - Auto Restart Script for Ubuntu
# Este script inicia o servidor Node.js e o reinicia automaticamente em caso de erro

echo "========================================"
echo "   WhatsApp Server - Auto Restart"
echo "========================================"
echo ""
echo "Iniciando servidor Node.js..."
echo "Pressione Ctrl+C para parar o servidor"
echo ""

# Função para capturar sinais de interrupção
cleanup() {
    echo ""
    echo "Parando servidor..."
    exit 0
}

# Captura sinais de interrupção (Ctrl+C)
trap cleanup SIGINT SIGTERM

# Loop principal para reiniciar o servidor
while true; do
    echo "[$(date)] Iniciando servidor..."
    
    # Executa o servidor Node.js
    node server.js
    
    # Se chegou aqui, o servidor parou
    echo ""
    echo "[$(date)] Servidor parou! Reiniciando em 5 segundos..."
    echo "Pressione Ctrl+C para cancelar o reinicio"
    
    # Aguarda 5 segundos antes de reiniciar
    sleep 5
    
    echo ""
    echo "Reiniciando servidor..."
done
