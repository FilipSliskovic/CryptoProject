// import io from './node_modules/socket.io-client';
//
// const socket = io('http://external-websocket-server.com');
//
// socket.on('connect', () => {
//     console.log('Connected to WebSocket server');
// });
//
// socket.on('message', (data) => {
//     console.log('Received message:', data);
// });
//
// socket.on('disconnect', () => {
//     console.log('Disconnected from WebSocket server');
// });
// const ws = require('ws')
const w = new WebSocket('wss://api-pub.bitfinex.com/ws/2')

let tabela = document.getElementById('tabela');

w.onmessage =  (msg) => {
    let data = JSON.parse(msg.data)
    console.log(data);
    if (data.event == 'subscribed')
    {
        for (id of ids)
        {
            if (data.pair == id.symbol)
            {
                // console.log(data.pair);
                id.id = data.chanId;
            }
        }

    }
    if (!data.event)
    {
        let chanelId = data[0];

        let brojevi = data[1];
        if (brojevi == 'hb'){
            return;
        }
        for (id of ids)
        {
            if(id.id == chanelId)
            {
                let red = document.getElementById(id.symbol)
                red.innerHTML = `
                            <td> <a href="/${id.symbol}"> ${id.symbol} </a>  </td>
                            <td> ${brojevi[6]} </td>
                            <td> ${brojevi[4]} </td>
                            <td> ${brojevi[5]*100}% </td>
                            <td> ${brojevi[8]} </td>
                            <td> ${brojevi[9]} </td>
                        `
            }
        }
    }
}



// let sym = ["btcusd","ltcusd","ltcbtc","ethusd", "ethbtc"]
let sym = JSON.parse(document.getElementById('symbols').value);
console.log(sym);

let ids = [];

for (s of sym)
{
    ids.push({
        symbol : s.toUpperCase(),
        id : 0
    })
}

for (s of sym)
{
    tabela.innerHTML += `<tr id="${s.toUpperCase()}">
                            <td> ${s} </td>
                            <td> 0 </td>
                            <td> 0 </td>
                            <td> 0 </td>
                        </tr>`
}

// var xhttp = new XMLHttpRequest();
// xhttp.onreadystatechange = function() {
//     if (this.readyState == 4 && this.status == 200) {
//         // Typical action to be performed when the document is ready:
//         console.log(xhttp.responseText);
//     }
// };
// xhttp.open("GET", "https://api.bitfinex.com/v1/symbols/symbols", true);
// xhttp.send();



w.onopen =  () =>{
    for(s of sym)
    {
        let msg = JSON.stringify({
            event: 'subscribe',
            channel: 'ticker',
            symbol: 't' + s.toUpperCase()
        })
        // console.log(s);

        w.send(msg)
    }
    // let msg = JSON.stringify({
    //     event: 'subscribe',
    //     channel: 'ticker',
    //     symbol: 'tBTCUSD'
    // })
    // console.log(s);
    // w.send(msg)


}
