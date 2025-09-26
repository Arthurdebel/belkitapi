@echo off
setlocal enabledelayedexpansion
title WhatsApp Server - Auto Restart (Robust)
color 0A

echo ========================================
echo    WhatsApp Server - Auto Restart
echo ========================================
echo.

REM Verificar se o Node.js está instalado
node --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ERRO: Node.js nao encontrado!
    echo Por favor, instale o Node.js antes de executar este script.
    echo Download: https://nodejs.org/
    pause
    exit /b 1
)

echo Node.js encontrado: 
node --version
echo.

REM Verificar se o arquivo server.js existe
if not exist "server.js" (
    echo ERRO: Arquivo server.js nao encontrado!
    echo Certifique-se de que este arquivo .bat esta na mesma pasta do server.js
    pause
    exit /b 1
)

echo Arquivo server.js encontrado!
echo.
echo Iniciando servidor...
echo Pressione Ctrl+C para parar o servidor completamente
echo.

set restart_count=0

:start
set /a restart_count+=1
echo.
echo ========================================
echo [%date% %time%] Iniciando servidor (tentativa !restart_count!)
echo ========================================

node server.js
set exit_code=%errorlevel%

echo.
echo ========================================
echo [%date% %time%] Servidor parou com codigo: !exit_code!
echo ========================================

if !exit_code! equ 0 (
    echo Servidor encerrado normalmente.
    echo Pressione qualquer tecla para sair...
    pause >nul
    exit /b 0
)

echo.
echo Servidor parou inesperadamente! Reiniciando em 10 segundos...
echo Pressione Ctrl+C para cancelar o reinicio
echo.

REM Contador regressivo
for /l %%i in (10,-1,1) do (
    echo Reiniciando em %%i segundos...
    timeout /t 1 /nobreak >nul
)

echo.
echo Reiniciando servidor...
goto start
