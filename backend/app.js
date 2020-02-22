const express = require('express')
const mongoose = require('mongoose')
const config = require('./config.json')

const PORT = process.env.PORT || 5000
const HOST = '0.0.0.0'

const dbUsername = process.env.dbUsername || config.db.username;
const dbPassword = process.env.dbPassword || config.db.password;
mongoose.connect(`mongodb+srv://${dbUsername}:${dbPassword}@cluster0-cerou.mongodb.net/test?retryWrites=true&w=majority`, {
  useNewUrlParser: true,
  useUnifiedTopology: true
}).then(() => {
    console.log('Connected to MongoDB!')
}).catch(() => {
    console.log('MongoDB connection failed!')
})

const app = express()

app.get('/', (req, res) => {
    res.send('Hello World!')
})

app.listen(PORT, () => {
    console.log(`Running at http://${HOST}:${PORT}`)
})