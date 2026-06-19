import express from 'express';
import http from 'http';
import { Server } from 'socket.io';

const app = express();

const server = http.createServer(app);

const io = new Server(server, {
    cors: {
        origin: '*'
    }
});

io.on('connection', (socket) => {

    console.log('Usuario conectado');

    socket.on('nuevo-ticket', (data) => {

        console.log('Nuevo ticket:', data);

        io.emit('ticket-creado', data);

    });

    socket.on('disconnect', () => {

        console.log('Usuario desconectado');

    });

});
app.use(express.json());

app.post('/nuevo-ticket', (req, res) => {

    const data = req.body;

    io.emit('ticket-creado', data);

    console.log('Ticket enviado desde Laravel:', data);

    res.json({
        success: true
    });

});
server.listen(3001, () => {

    console.log(
        'Socket.IO ejecutándose en puerto 3001'
    );

});
