const readline = require('readline').createInterface({
    input: process.stdin,
    output: process.stdout,
});

readline.question(`Enter maximal count:`, count => {
    const number = [];
    for (let i = 0; i < count; i++) {
        number.push(i * (i + 1) / 2 + 1);
    }
    console.log(number.join('-'));
    readline.close();
});
