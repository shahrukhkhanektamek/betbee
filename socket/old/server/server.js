// server.js
const express = require("express");
const http = require("http");
const { Server } = require("socket.io");
const cors = require("cors");

const app = express();
const server = http.createServer(app);

// ✅ CORS Middleware for Express
app.use(cors({
  origin: "http://localhost",  // frontend origin (scheme + host)
  methods: ["GET", "POST"]
}));

// ✅ socket.io with CORS
const io = new Server(server, {
  cors: {
    origin: "http://localhost", // frontend origin
    methods: ["GET", "POST"]
  }
});

app.use(express.static("public"));

io.on("connection", (socket) => {
  console.log("✅ Client connected:", socket.id);

  socket.on("startWheel", ({ stopNumber }) => {
    console.log("🎡 Wheel command received → Stop at:", stopNumber);
    io.emit("statusUpdate", "Wheel started...");

    let angle = 0;
    let speed = 0.3;
    const slice = (2 * Math.PI) / 10;
    const targetAngle = (10 - stopNumber) * slice;
    const extraRotations = 5 * 2 * Math.PI;
    const finalAngle = targetAngle + extraRotations;

    const spin = setInterval(() => {
      angle += speed;

      if (angle >= finalAngle) {
        angle = finalAngle;
        clearInterval(spin);
        io.emit("statusUpdate", "Wheel stopped at " + stopNumber);
        io.emit("finalNumber", stopNumber);
      } else {
        if (finalAngle - angle < 2 * Math.PI) {
          speed *= 0.97; // धीरे-धीरे रुकना
        }
      }

      io.emit("rotate", { angle });
    }, 30);
  });

  socket.on("disconnect", () => {
    console.log("❌ Client disconnected:", socket.id);
  });
});

server.listen(3000, () => {
  console.log("🚀 Server running at http://localhost:3000");
});
