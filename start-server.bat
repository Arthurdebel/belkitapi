@echo off
title WhatsApp Server - Auto Restart
echo ========================================
echo    WhatsApp Server - Auto Restart
echo ========================================
echo.
echo Iniciando servidor Node.js...
echo Pressione Ctrl+C para parar o servidor
echo.

:start
echo [%date% %time%] Iniciando servidor...
node server.js

echo.
echo [%date% %time%] Servidor parou! Reiniciando em 5 segundos...
echo Pressione Ctrl+C para cancelar o reinicio
timeout /t 5 /nobreak >nul

echo.
echo Reiniciando servidor...
goto start
