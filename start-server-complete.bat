@echo off
setlocal enabledelayedexpansion
title WhatsApp Server - Auto Restart (Complete)
color 0A

echo ========================================
echo    WhatsApp Server - Auto Restart
echo    Versao Completa com Auto-Install
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

REM Verificar se node_modules existe
if not exist "node_modules" (
    echo node_modules nao encontrado! Instalando dependencias...
    echo.
    npm install
    if %errorlevel% neq 0 (
        echo ERRO: Falha ao instalar dependencias!
        pause
        exit /b 1
    )
    echo Dependencias instaladas com sucesso!
    echo.
)

REM Verificar se package.json existe e se precisa instalar dependencias
if exist "package.json" (
    echo Verificando dependencias...
    npm list --depth=0 >nul 2>&1
    if %errorlevel% neq 0 (
        echo Instalando dependencias faltantes...
        npm install
        if %errorlevel% neq 0 (
            echo ERRO: Falha ao instalar dependencias!
            pause
            exit /b 1
        )
    )
)

echo.
echo Iniciando servidor...
echo Pressione Ctrl+C para parar o servidor completamente
echo.

set restart_count=0
set max_restarts=100

:start
set /a restart_count+=1
echo.
echo ========================================
echo [%date% %time%] Iniciando servidor (tentativa !restart_count!/!max_restarts!)
echo ========================================

REM Verificar se excedeu o limite de reinicios
if !restart_count! gtr !max_restarts! (
    echo.
    echo ATENCAO: Limite de reinicios atingido (!max_restarts!)!
    echo Verifique os logs para identificar o problema.
    echo.
    pause
    exit /b 1
)

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

if !exit_code! equ 1 (
    echo Erro de sintaxe ou problema no codigo!
    echo Verifique os logs acima para mais detalhes.
    echo.
    pause
    exit /b 1
)

echo.
echo Servidor parou inesperadamente! Reiniciando em 15 segundos...
echo Pressione Ctrl+C para cancelar o reinicio
echo.

REM Contador regressivo
for /l %%i in (15,-1,1) do (
    echo Reiniciando em %%i segundos...
    timeout /t 1 /nobreak >nul
)

echo.
echo Reiniciando servidor...
goto start
