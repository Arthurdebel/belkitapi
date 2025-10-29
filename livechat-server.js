"use strict";

require("dotenv").config();

const path = require("path");
const http = require("http");
const express = require("express");
const bodyParser = require("body-parser");
const { Server } = require("socket.io");
const { io: Client } = require("socket.io-client");

// Configuração do servidor principal da VPS
const VPS_URL = process.env.VPS_URL || "https://candyce-overjudicious-persuasively.ngrok-free.app";
const VPS_PORT = process.env.VPS_PORT || 3100;
const VPS_FULL_URL = `${VPS_URL}:${VPS_PORT}`;

const port = process.env.PORT_LIVECHAT || 3100;

const app = express();
const server = http.createServer(app);
const io = new Server(server, {
  pingInterval: 25000,
  pingTimeout: 10000,
  cors: { origin: "*" },
});

// Cliente Socket.IO para conectar ao servidor principal da VPS
let vpsSocket = null;

// Express middlewares
app.use((req, res, next) => {
  res.set("Cache-Control", "no-store");
  req.io = io;
  next();
});
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false, limit: "50mb", parameterLimit: 100000 }));
app.use("/livechat", express.static(path.join(__dirname, "public/themes/vuexy/livechat")));

// Conecta ao servidor principal da VPS
function connectToVPS() {
  if (vpsSocket) return;
  
  console.log(`[livechat] Conectando ao servidor VPS: ${VPS_FULL_URL}`);
  vpsSocket = Client(VPS_FULL_URL, {
    transports: ['websocket', 'polling'],
    timeout: 20000,
    forceNew: true
  });

  vpsSocket.on('connect', () => {
    console.log('[livechat] Conectado ao servidor VPS:', vpsSocket.id);
  });

  vpsSocket.on('disconnect', () => {
    console.log('[livechat] Desconectado do servidor VPS');
    vpsSocket = null;
    // Reconecta após 5 segundos
    setTimeout(connectToVPS, 5000);
  });

  vpsSocket.on('connect_error', (error) => {
    console.error('[livechat] Erro ao conectar VPS:', error.message);
    vpsSocket = null;
    setTimeout(connectToVPS, 10000);
  });

  // Handlers para receber respostas da VPS
  vpsSocket.on('qr', (data) => {
    console.log('[livechat] QR recebido da VPS:', data.token);
    // Envia para todos os clientes conectados na sala do token
    io.to(`room:${data.token}`).emit('qr', data);
  });

  vpsSocket.on('connected', (data) => {
    console.log('[livechat] Dispositivo conectado na VPS:', data.token);
    io.to(`room:${data.token}`).emit('connected', data);
  });

  vpsSocket.on('disconnected', (data) => {
    console.log('[livechat] Dispositivo desconectado na VPS:', data.token);
    io.to(`room:${data.token}`).emit('disconnected', data);
  });

  vpsSocket.on('message', (data) => {
    console.log('[livechat] Mensagem recebida da VPS:', data);
    io.to(`room:${data.token}`).emit('message', data);
  });
}

// Inicia conexão com VPS
connectToVPS();

// Eventos Socket.IO locais
io.on("connection", (socket) => {
  console.log("[livechat] client connected", socket.id);

  // Salas por token para isolar instâncias
  socket.on("join", (token) => {
    if (token) socket.join(`room:${token}`);
  });

  // Envio de mensagem via socket para facilitar testes do chat em tempo real
  socket.on("chat:send", async ({ token, to, text }) => {
    if (!token || !to || !text) return;
    try {
      // Envia para o servidor VPS
      if (vpsSocket && vpsSocket.connected) {
        vpsSocket.emit('sendText', { token, number: to, text });
      }
    } catch (e) { 
      console.error("[livechat] chat:send error:", e); 
    }
  });

  socket.on("disconnect", () => {
    console.log("[livechat] client disconnected", socket.id);
  });
});

// Helpers
function ok(res, payload) { return res.json(payload); }
function bad(res, message) { return res.status(400).json({ status: false, message }); }

// Função para fazer requisições HTTP ao servidor VPS
async function makeVPSRequest(endpoint, data = {}) {
  try {
    const response = await fetch(`${VPS_URL}/backend-${endpoint}`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(data)
    });
    
    if (!response.ok) {
      throw new Error(`HTTP ${response.status}: ${response.statusText}`);
    }
    
    return await response.json();
  } catch (error) {
    console.error(`[livechat] VPS request error (${endpoint}):`, error.message);
    throw error;
  }
}

// Função para enviar comandos via WebSocket para a VPS
function sendToVPS(event, data) {
  if (vpsSocket && vpsSocket.connected) {
    vpsSocket.emit(event, data);
    return true;
  }
  return false;
}

// Rotas REST que fazem proxy para o servidor VPS
// 1) Registrar número e gerar QR (token = número/identificador)
app.post("/api/register", async (req, res) => {
  const { token } = req.body || {};
  if (!token) return bad(res, "Token (identificador do número) é obrigatório");
  
  try {
    // Tenta usar WebSocket primeiro
    if (sendToVPS('StartConnection', token)) {
      return ok(res, { status: 'processing', message: 'Conectando via WebSocket...' });
    }
    
    // Fallback para HTTP
    const result = await makeVPSRequest('generate-qr', { token });
    return ok(res, result);
  } catch (e) {
    console.error("[livechat] /api/register error:", e);
    return ok(res, { status: false, message: "Erro ao conectar com servidor VPS" });
  }
});

// 2) Status
app.post("/api/status", async (req, res) => {
  const { token } = req.body || {};
  if (!token) return bad(res, "Token obrigatório");
  
  try {
    const result = await makeVPSRequest('generate-qr', { token });
    return ok(res, result);
  } catch (e) {
    return ok(res, { status: false, message: "Erro ao conectar com servidor VPS" });
  }
});

// 3) Logout
app.post("/api/logout", async (req, res) => {
  const { token } = req.body || {};
  if (!token) return bad(res, "Token obrigatório");
  
  try {
    // Tenta usar WebSocket primeiro
    if (sendToVPS('LogoutDevice', token)) {
      return ok(res, { status: true, message: 'Logout enviado via WebSocket' });
    }
    
    // Fallback para HTTP
    const result = await makeVPSRequest('logout', { token });
    return ok(res, result);
  } catch (e) {
    return ok(res, { status: false, message: "Erro ao conectar com servidor VPS" });
  }
});

// 4) Enviar texto
app.post("/api/send-text", async (req, res) => {
  const { token, to, text } = req.body || {};
  if (!token || !to || !text) return bad(res, "Campos token, to e text são obrigatórios");
  
  try {
    const result = await makeVPSRequest('send-text', { token, number: to, text });
    return ok(res, result);
  } catch (e) {
    console.error("[livechat] /api/send-text error:", e);
    return ok(res, { status: false, message: "Erro ao conectar com servidor VPS" });
  }
});

// 5) Página simples de UI
app.get("/", (req, res) => {
  res.redirect("/livechat/");
});

// 6) Health check
app.get("/health", (req, res) => {
  res.json({ 
    status: "ok", 
    vps_connected: vpsSocket ? vpsSocket.connected : false,
    vps_url: VPS_FULL_URL 
  });
});

server.listen(port, () => {
  console.log(`[livechat] listening on :${port}`);
  console.log(`[livechat] VPS URL: ${VPS_FULL_URL}`);
});